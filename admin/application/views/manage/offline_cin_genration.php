<?php include('header.php'); ?>

<?php if ($this->session->flashdata('alert_success')): ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('alert_success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('alert_error')): ?>
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('alert_error'); ?>
    </div>
<?php endif; ?>

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
        <?php echo form_open_multipart('manage/competitionshedule/offline_cin_genration/' . $comschid, ['name' => 'form1', 'id' => 'form1']); ?>
            <input type="hidden" name="school" value="<?php echo htmlspecialchars($school_id); ?>">
            <table cellpadding="5px">
                <tr>
                    <td>
                    Student Profile CSV file  <br />
                        <input name="csv" type="file" id="csv" accept=".csv" />
                    </td>
                    <td>
                        <br /><input type="submit" class='btn btn-primary' name="submit" value="Submit" />
                    </td>
                </tr>
            </table>
        <?php echo form_close(); ?>
        <?php endif; ?>
        <?php if (!empty($csvResult_upoload_logArray)): ?>
            <hr>
            <h4>Upload Results</h4>
            <table class="table table-bordered mb-5" >
                <tr>
                    <th>Row</th>
                    <th>CIN</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($csvResult_upoload_logArray as $log): ?>
                    <tr>
                        <td><?php echo $log['row']; ?></td>
                        <td><?php echo $log['cin']; ?></td>
                        <td><?php echo htmlspecialchars($log['stud_name']); ?></td>
                        <td>
                            <?php if ($log['result']): ?>
                                <span class="label label-success">Success</span>
                            <?php else: ?>
                                <span class="label label-important">
                                    <?php echo !empty($log['error']) ? htmlspecialchars($log['error']) : 'Failed'; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    </div>
 </div><!--/row-->
<?php include('footer.php'); ?>