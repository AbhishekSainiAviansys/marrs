<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li><a href="<?php echo SITE_URL ?>school/">Lunar</a> <span class="divider">/</span></li>
        <li>CIN Export</li>
    </ul>
</div>

<form method="POST" class="table-responsive">
<div>
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> CIN List</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>

        <div class="box-content" style="padding-bottom:100px;">

            <!-- ============ FILTERS ============ -->
            <table cellpadding="5px">
                <tr>
                    <!-- Period -->
                    <td>Period:<br />
                        <select name="period" id="period" style="width:200px;" required>
                            <?php foreach ($periodload as $row) { ?>
                                <option value="<?php echo $row['period_id']; ?>"
                                    <?php if (isset($result['period']) && $result['period'] == $row['period_id']) echo 'selected'; ?>>
                                    <?php echo $row['academic_year']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                    <!-- Subject -->
                    <td>
                        <label>Subject</label>
                        <select name="subject" style="width:200px;" required>
                            <option value="">select Subject</option>
                            <?php foreach ($subject as $res) { ?>
                                <option value="<?php echo $res['sub_id']; ?>"
                                    <?php if (isset($result['subject']) && $result['subject'] == $res['sub_id']) echo 'selected'; ?>>
                                    <?php echo $res['sub_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                    <!-- Program -->
                    <td>
                        <label>Lunar Program</label>
                        <select name="program" style="width:200px;" required>
                            <option value="">select Program</option>
                            <?php foreach ($programs as $res) { ?>
                                <option value="<?php echo $res['id']; ?>"
                                    <?php if (isset($result['program']) && $result['program'] == $res['id']) echo 'selected'; ?>>
                                    <?php echo $res['program_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                    <!-- Class -->
                    <td>Class:<br />
                        <select name="class" style="width:200px;" required>
                            <option value="All"
                                <?php if (isset($result['class']) && $result['class'] == 'All') echo 'selected'; ?>>All Class</option>
                            <?php foreach ($classload as $periodval) { ?>
                                <option value="<?php echo $periodval['class_name']; ?>"
                                    <?php if (isset($result['class']) && $result['class'] == $periodval['class_name']) echo 'selected'; ?>>
                                    <?php echo $periodval['class_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>

                    <td>
                        <br /><input type="submit" class="btn btn-info" name="submit" value="Submit" />
                    </td>
                </tr>
            </table>

            <br />

            <!-- ============ RESULT ============ -->
            <div id="csvResult_uploadLog_div">

                <div style="text-align:center;">
                    <h5 style="color:green;">
                        <?php if (!empty($message)) echo $message; ?>
                    </h5>
                </div>

                <?php if (!empty($pay_list)) { ?>

                    <!-- Export: small, green, right side -->
                    <div style="text-align:right; margin-bottom:10px;">
                        <button type="submit" name="Export" value="Export"
                                style="width:auto; display:inline-block; background:#28a745; color:#fff;
                                       border:0; border-radius:6px; padding:7px 18px;
                                       font-size:13px; font-weight:600; cursor:pointer;">
                            Export
                        </button>
                    </div>

                    <table border="1" width="100%" cellpadding="10px">
                        <tr>
                            <th>SI No</th>
                            <th>PRID</th>
                            <th>CIN</th>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Series</th>
                            <th>Class</th>
                            <th>School</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Associate</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $i = 0;
                        foreach ($pay_list as $details) {

                            if (empty($details->school_name)) {
                                $sc = $this->db->get_where('school_new', array('id' => $details->school_id))->row();
                                $school_name = $sc ? $sc->school_name : '';
                            } else {
                                $school_name = $details->school_name;
                            }
                        ?>
                            <tr>
                                <td align="CENTER"><?php echo ++$i; ?></td>
                                <td align="CENTER"><?php echo $details->prid; ?></td>
                                <td align="CENTER"><?php echo $details->cin; ?></td>
                                <td align="CENTER"><?php echo $details->student_name; ?></td>
                                <td align="CENTER"><?php echo $details->subject; ?></td>
                                <td align="CENTER"><?php echo 'Series-' . $details->series; ?></td>
                                <td align="CENTER"><?php echo $details->class; ?></td>
                                <td align="CENTER"><?php echo $school_name; ?></td>
                                <td align="CENTER"><?php echo $details->stud_phone; ?></td>
                                <td align="CENTER"><?php echo $details->stud_email; ?></td>
                                <td align="CENTER"><?php echo trim($details->first_name . ' ' . $details->last_name); ?></td>
                                <td align="CENTER"><?php echo $details->address1; ?></td>
                                <td align="CENTER">
                                    <button type="button" class="btn btn-danger btn-delete-cin"
                                            data-cin="<?php echo htmlspecialchars($details->cin); ?>">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <!-- footer ke upar extra space -->
                    <div style="height:90px;"></div>

                <?php } elseif (isset($result)) { ?>
                    <h4>No Data Found..</h4>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
</form>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.1.min.js"></script>

<?php include('footer.php'); ?>

<script type="text/javascript">
// ---- Delete CIN (AJAX) ----
$(document).on('click', '.btn-delete-cin', function () {
    var btn = $(this);
    var cin = btn.data('cin');

    if (!confirm('CIN ' + cin + ' delete karna hai? Ye wapas nahi aayega.')) {
        return;
    }

    btn.prop('disabled', true);

    $.post("<?php echo base_url(); ?>manage/lunar/delete_cin", { cin: cin }, function (res) {
        if (res.success) {
            btn.closest('tr').fadeOut(300, function () { $(this).remove(); });
        } else {
            alert(res.message || 'Delete failed');
            btn.prop('disabled', false);
        }
    }, 'json').fail(function () {
        alert('Server error');
        btn.prop('disabled', false);
    });
});
</script>