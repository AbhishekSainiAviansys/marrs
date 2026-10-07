<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 

<style>
	.upload-card {
		background: #fff;
		border-radius: 6px;
		box-shadow: 0 1px 3px rgba(0,0,0,0.08);
		overflow: hidden;
	}

	.upload-card .box-header {
		background: linear-gradient(to bottom, #fafafa, #f2f2f2);
		padding: 14px 20px;
		margin: 0;
	}

	.upload-card .box-header h2 {
		font-size: 18px;
		font-weight: 600;
		color: #333;
		margin: 0;
	}

	.upload-card .box-header h2 i {
		color: #3a87ad;
		margin-right: 8px;
	}

	.upload-card .box-content {
		padding: 24px;
	}

	.uf-field-group {
		display: flex;
		flex-wrap: wrap;
		gap: 20px;
		align-items: flex-end;
		margin-bottom: 20px;
	}

	.uf-field {
		flex: 1 1 220px;
		min-width: 200px;
	}

	.uf-field label {
		display: block;
		font-size: 12px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.03em;
		color: #666;
		margin-bottom: 6px;
	}

	.uf-field select,
	.uf-field input[type="file"] {
		width: 100%;
		padding: 7px 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		font-size: 13px;
		background: #fff;
		box-sizing: border-box;
	}

	.uf-field select:focus {
		border-color: #3a87ad;
		outline: none;
		box-shadow: 0 0 0 2px rgba(58,135,173,0.15);
	}

	.uf-submit-wrap {
		flex: 0 0 auto;
	}

	.uf-submit-wrap input[type="submit"] {
		background: #3a87ad;
		color: #fff;
		border: none;
		padding: 9px 26px;
		border-radius: 4px;
		font-size: 13px;
		font-weight: 600;
		cursor: pointer;
		transition: background 0.15s ease;
	}

	.uf-submit-wrap input[type="submit"]:hover {
		background: #2f6f8f;
	}

	.uf-format-note {
		background: #f0f7fb;
		border: 1px solid #d0e6f2;
		border-left: 4px solid #3a87ad;
		border-radius: 4px;
		padding: 12px 16px;
		font-size: 13px;
		color: #385f73;
		margin-bottom: 24px;
	}

	.uf-format-note strong {
		color: #235272;
	}

	.uf-format-note .uf-cols {
		display: flex;
		flex-wrap: wrap;
		gap: 6px 18px;
		margin-top: 8px;
	}

	.uf-format-note .uf-cols span {
		background: #fff;
		border: 1px solid #cfe3ef;
		border-radius: 3px;
		padding: 2px 9px;
		font-size: 12px;
		color: #2c5a76;
	}

	.uf-log-title {
		font-size: 15px;
		font-weight: 700;
		color: #333;
		margin: 4px 0 12px;
		padding-bottom: 8px;
		border-bottom: 2px solid #eee;
	}

	.uf-log-table {
		width: 100%;
		border-collapse: collapse;
		font-size: 13px;
	}

	.uf-log-table th {
		background: #f7f7f7;
		text-align: center;
		padding: 10px 8px;
		font-size: 11px;
		text-transform: uppercase;
		letter-spacing: 0.03em;
		color: #666;
		border-bottom: 2px solid #e5e5e5;
	}

	.uf-log-table td {
		padding: 9px 8px;
		text-align: center;
		border-bottom: 1px solid #eee;
	}

	.uf-log-table tr:hover td {
		background-color: #fafafa;
	}

	.uf-status-cell {
		font-weight: 600;
		border-radius: 3px;
	}

	.uf-status-error {
		background-color: #f8d7da !important;
		color: #721c24;
	}

	.uf-status-success {
		background-color: #d4edda !important;
		color: #1e5e2f;
	}

	@media (max-width: 700px) {
		.uf-field-group {
			flex-direction: column;
			align-items: stretch;
		}
		.uf-submit-wrap input[type="submit"] {
			width: 100%;
		}
	}
</style>

<div class="row-fluid sortable">
	<div class="box span12 upload-card">
	<!-------------->
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV Result File</h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->
	<div class="box-content">

		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

			<div class="uf-field-group">

				<div class="uf-field">
					<label for="product_name">Product</label>
					<select name="product_name" id="product_name" required>
						<option value="">-- Select Product --</option>
						<?php foreach ($product_load as $row): ?>
							<option value='<?php echo $row->product_id; ?>' <?php if (isset($result['product_name']) && $result['product_name'] == $row->product_id) { echo 'selected'; } ?>>
								<?php echo $row->product_id . ' - ' . $row->product_name; ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="uf-field">
					<label for="competition_level_id">Competition Level</label>
					<select name="level" id="competition_level_id" required>
						<option value="">-- Select Level --</option>
						<?php if (isset($level_load)): ?>
							<?php foreach ($level_load as $row): ?>
								<option value='<?php echo $row->level_id; ?>' <?php if (isset($result['level']) && $result['level'] == $row->level_id) { echo 'selected'; } ?>>
									<?php echo $row->level_id . ' - ' . $row->level_name; ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div class="uf-field">
					<label for="csv">CIN Result CSV File</label>
					<input name="csv" type="file" id="csv" />
				</div>

				<div class="uf-submit-wrap">
					<input type="submit" name="submit" value="Submit" />
				</div>

			</div>

			<div class="uf-format-note">
				<strong>CSV column format</strong> — your file should follow this column order:
				<div class="uf-cols">
					<span>1. CIN</span>
					<span>2. Status (Q/NQ)</span>
					<span>3. Grade</span>
					<span>4. Rank</span>
					<span>5. Marks</span>
					<span>6. Performer</span>
					<span>7. Speller</span>
				</div>
			</div>

			<!-------------->
			<div id="csvResult_uploadLog_div">
				<?php if (!empty($csvResult_upoload_logArray)): ?>

					<div class="uf-log-title">Result Upload — Error Log</div>

					<table class="uf-log-table">
						<tr>
							<th>SI No</th>
							<th>CIN</th>
							<th>Product Name</th>
							<th>Level</th>
							<th>Upload Report</th>
						</tr>

						<?php
						$i = 0;
						foreach ($csvResult_upoload_logArray as $details):
							$message = $details[3] ?? '';
							$statusClass = '';
							if (stripos($message, 'error') !== false) {
								$statusClass = 'uf-status-error';
							} elseif (stripos($message, 'success') !== false) {
								$statusClass = 'uf-status-success';
							}
						?>
						<tr>
							<td><?php echo ++$i; ?></td>
							<td><?php echo $details[0] ?? ''; ?></td>
							<td><?php echo $details[1] ?? ''; ?></td>
							<td><?php echo $details[2] ?? ''; ?></td>
							<td class="uf-status-cell <?php echo $statusClass; ?>"><?php echo $message; ?></td>
						</tr>
						<?php endforeach; ?>

					</table>

				<?php endif; ?>
			</div>
	<!-------------->
	</form>
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<script type="text/javascript">
	$(document).ready(function(e) {
        $("#product_name").change(function(){
            var product_id=this.value;
    		var BASE_URL = "<?php echo base_url();?>";
            $.ajax({
                url:BASE_URL+"manage/ajax/productwiselevel/",
                data:{product_id:product_id},
                type: 'post',
                success:function(result){
                     $("#competition_level_id").html(result);
            }});
        }); 
    });

</script>