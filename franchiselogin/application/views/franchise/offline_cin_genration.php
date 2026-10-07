<?php 
     include('header.php'); 
     echo $this->notifications->display_html();   
?> 
<div class="row-fluid sortable">
    <div class="box span12">
          <div class="box-header well" data-original-title>
               <h2><i class="icon-edit"></i>Upload CSV file </h2>
                   <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                   </div>
          </div>
    <div class="box-content">
        <br>
        <?php if (empty($school_id)): ?>
            <div class="alert alert-error">
                No school found for this competition schedule. Upload disabled.
            </div>
        <?php else: ?>
            <input type="hidden" name="school" value="<?php echo htmlspecialchars($school_id); ?>">
            <input type="hidden" id="csrf_token_name" value="<?php echo $this->security->get_csrf_token_name(); ?>">
            <input type="hidden" id="csrf_token_hash" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <table cellpadding="5px">
                <tr>
                    <td>
                    Student Profile CSV file  <br />
                        <input name="csv" type="file" id="csv" accept=".csv" />
                    </td>
                    <td>
                        <br /><button type="button" id="uploadBtn" class="btn btn-primary">Submit</button>
                    </td>
                </tr>
            </table>

            <div id="progressWrap" style="display:none; margin-top:15px;">
                <div style="background:#eee; border-radius:4px; overflow:hidden; height:20px; width:100%; max-width:500px;">
                    <div id="progressBar" style="background:#5cb85c; height:100%; width:0%; transition:width 0.3s;"></div>
                </div>
                <p id="progressText">0 / 0 rows processed</p>
            </div>
        <?php endif; ?>

        <hr>
        <h4>Upload Results</h4>
        <table class="table table-bordered" id="resultsTable">
            <tr>
                <th>Row</th>
                <th>CIN</th>
                <th>Student Name</th>
                <th>Status</th>
            </tr>
            <tbody id="resultsTableBody">
            <?php if (!empty($csvResult_upoload_logArray)): ?>
                <?php foreach ($csvResult_upoload_logArray as $log): ?>
                    <tr>
                        <td><?php echo $log['row']; ?></td>
                        <td><?php echo $log['cin']; ?></td>
                        <td><?php echo htmlspecialchars($log['stud_name']); ?></td>
                        <td>
                            <?php if (!empty($log['result'])): ?>
                                <span class="label label-success">Success</span>
                            <?php else: ?>
                                <span class="label label-important">Failed</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>
 </div><!--/row-->

<?php if (!empty($school_id)): ?>
<script>
(function () {
    var BATCH_SIZE = 5; // rows per AJAX request — lower this (e.g. 3) if the server still struggles
    var competitionScheduleId = "<?php echo isset($comschid) ? $comschid : ''; ?>";
    var ajaxUrl = "<?php echo base_url('franchise/competitionshedule/ajax_process_cin_batch'); ?>";

    document.getElementById('uploadBtn').addEventListener('click', function () {
        var fileInput = document.getElementById('csv');
        if (!fileInput.files || !fileInput.files[0]) {
            alert('Please choose a CSV file');
            return;
        }

        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var text = e.target.result;
            var lines = text.split(/\r\n|\n/);

            // Skip first 2 header rows, same as original server-side logic
            var dataRows = [];
            for (var i = 2; i < lines.length; i++) {
                var line = lines[i].trim();
                if (!line) continue;
                dataRows.push(line.split(','));
            }

            if (dataRows.length === 0) {
                alert('No data rows found in CSV');
                return;
            }

            processInBatches(dataRows);
        };

        reader.readAsText(file);
    });

    function processInBatches(dataRows) {
        var total = dataRows.length;
        var processed = 0;

        // Clear any old results before a fresh run
        document.getElementById('resultsTableBody').innerHTML = '';

        document.getElementById('progressWrap').style.display = 'block';
        document.getElementById('uploadBtn').disabled = true;
        document.getElementById('progressBar').style.width = '0%';
        document.getElementById('progressText').textContent = '0 / ' + total + ' rows processed';

        var batches = [];
        for (var i = 0; i < dataRows.length; i += BATCH_SIZE) {
            batches.push(dataRows.slice(i, i + BATCH_SIZE));
        }

        var batchIndex = 0;

        function sendNextBatch() {
            if (batchIndex >= batches.length) {
                document.getElementById('progressText').textContent =
                    total + ' / ' + total + ' rows processed — Done!';
                document.getElementById('uploadBtn').disabled = false;
                return;
            }

            var batch = batches[batchIndex];

            var formData = new FormData();
            formData.append('competition_schedule_id', competitionScheduleId);
            formData.append('rows', JSON.stringify(batch));

            // Include CSRF token — CodeIgniter's security library rejects
            // any POST without it if csrf_protection is enabled in config.
            var csrfName = document.getElementById('csrf_token_name').value;
            var csrfHash = document.getElementById('csrf_token_hash').value;
            formData.append(csrfName, csrfHash);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(function (res) {
                if (!res.ok) {
                    throw new Error('Server returned status ' + res.status);
                }
                return res.json();
            })
            .then(function (data) {
                // CI regenerates the CSRF hash after every POST by default —
                // update our stored value so the *next* batch doesn't fail.
                if (data.csrf_hash) {
                    document.getElementById('csrf_token_hash').value = data.csrf_hash;
                }

                if (data.success) {
                    data.results.forEach(function (r) {
                        processed++;
                        appendResultRow(processed, r);
                    });
                } else {
                    appendErrorRow(data.message || 'Unknown error on this batch');
                }

                var pct = Math.round((processed / total) * 100);
                document.getElementById('progressBar').style.width = pct + '%';
                document.getElementById('progressText').textContent =
                    processed + ' / ' + total + ' rows processed';

                batchIndex++;
                sendNextBatch(); // next batch only after this one finishes — keeps each request small
            })
            .catch(function (err) {
                appendErrorRow('Network/server error on batch ' + (batchIndex + 1) + ': ' + err);
                batchIndex++;
                sendNextBatch(); // keep going even if one batch fails
            });
        }

        sendNextBatch();
    }

    function appendResultRow(rowNum, r) {
        var tbody = document.getElementById('resultsTableBody');
        var tr = document.createElement('tr');
        var isSuccess = (r.status || '').toLowerCase().indexOf('success') !== -1;
        var badge = isSuccess
            ? '<span class="label label-success">Success</span>'
            : '<span class="label label-important">Failed</span>';
        tr.innerHTML =
            '<td>' + rowNum + '</td>' +
            '<td>' + escapeHtml(r.cin || '-') + '</td>' +
            '<td>' + escapeHtml(r.stud_name || '') + '</td>' +
            '<td>' + badge + ' ' + escapeHtml(r.status || '') + '</td>';
        tbody.appendChild(tr);
    }

    function appendErrorRow(message) {
        var tbody = document.getElementById('resultsTableBody');
        var tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="4" style="color:red;">' + escapeHtml(message) + '</td>';
        tbody.appendChild(tr);
    }

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }
})();
</script>
<?php endif; ?>

<?php include('footer.php'); ?>