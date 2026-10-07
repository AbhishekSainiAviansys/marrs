<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
// print_r($competition);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>-->
					</li>
					<li>
						<!--<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>-->
					</li>
				</ul>
			</div>
			

			<div class="row-fluid ">
			 
				<div class="box span12">
				    <?php //echo $this->notifications->display_html();
			if(!empty($message)){
			    ?>
			    <div class='row-fluid' style='background-color:#109b10;height:40px;display:grid;' >
			        <h4 style='color:#ffffff;'><?php echo $message; ?></h4>
			    </div>
			        
			    <?php
			}
			?>
			
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Lunar Competition <?php echo ' Activate';?></h2>
						
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
				
					<form method="POST">
					
					    <div class='table-responsive'>
                            <table cellpadding="5px">
                                <!--<tr>-->
                                <!--    <th>Period</th>-->
                                <!--    <th>Level</th>-->
                                <!--    <th>Subject</th>-->
                                <!--    <th>Action</th>-->
                                <!--</tr>-->
                                <tbody>
                                    <tr>
                                    <td>Period<span style="color:red;">*</span><br>
                                        <select name="period" id="" class="" required>
                                            <option value=''>-- Select Period --</option>
                                            <?php
                                                $query = $this->db->query("SELECT * FROM period WHERE period_id > 12;");
                                                foreach ($query->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->period_id; ?>" 
                                                    <?php if ($result['period'] == $row->period_id) { echo 'selected="selected"'; } ?>>
                                                    <?php echo $row->period_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td>Level<span style="color:red;">*</span><br>
                                        <select name="level" id="" class="" required>
                                            <option value=''>-- Select Level --</option>
                                            <?php
                                                $query = $this->db->query("SELECT * FROM competition_level_byproduct WHERE product_name='Lunar Skill Test';");
                                                foreach ($query->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->level_id; ?>"
                                                    <?php if ($result['level'] == $row->level_id) { echo 'selected="selected"'; } ?>>
                                                    <?php echo $row->level_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td>Subject<span style="color:red;">*</span><br>
                                        <select name="subject" id="" class="" required>
                                            <option value=''>-- Select Subject --</option>
                                            <?php
                                            // print_R($sub);
                                                $query = $this->db->query("SELECT subject_key FROM lunar_subjects where status= 'Active';");
                                                foreach ($query->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->subject_key; ?>"
                                                    <?php if ($result['subject'] == $row->subject_key) { echo 'selected="selected"'; } ?>>
                                                    <?php echo $row->subject_key; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button type='submit' name='search' class='btn btn-danger'>Search</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
					
					
					<div class="box-content" >
						<div>
						    <?php if(!empty($competition)){ ?>
						    
						    <table border="1"  width='100%'>
				                <tr>
				                    <th>
				                        Sr. No.
				                    </th>
						            <th>
						                Period
						            </th>
						            <th>
						                Level
						            </th>
						            <th>
						                Subject
						            </th>
						            <th>
						                Series
						            </th>
						            <th>
						                Type
						            </th>
						            <th>
						                Start Date
						            </th>
						            <th>
						                End Date
						            </th>
						            <th>
						                Action
						            </th>
						        </tr>
						        <tbody>
						            <?php $i=1; foreach($competition as $row){ ?>
						            <tr style="text-align:center;">
						                <td>
						                    <?php echo $i; ?>
						                </td>
						                <td><?php echo $row->academic_year; ?></td>
						                <td><?php echo $row->level_name; ?></td>
						                <td><?php echo $row->subject; ?></td>
						                <td><?php echo $row->series; ?></td>
						                <td><?php echo $row->type; ?></td>
						                <td><?php echo $row->start_date; ?></td>
						                <td><?php echo $row->end_date; ?></td>
						                <td>
						                    <?php 
						                    
						                    $this->db->where('period_id', $row->period_id);
						                    $this->db->where('clevel', $row->level_id);
						                    $this->db->where('subject', $row->subject);
						                    $this->db->where('series', $row->series);
						                    $this->db->where('type', $row->type);
						                    $this->db->where('product_name', $row->product_name);
                                            $res= $this->db->get('competition_product_state')->row();
                                            // print_r($row->lunar_schedule_id);
                                            
                                            // echo $this->db->last_query();
                                            
                                            if ($res) { 
                                                // print_r($row);
                                            ?>
                                                <form method="POST">
                                                    <input type="hidden" name="lunar_id" value="<?php echo $row->lunar_schedule_id; ?>">
                                                    <button type="submit" name='submit' class="btn btn-primary" value='<?php echo $res->id; ?>'>Unassign</button>
                                                </form>
                                                <a href="<?php echo base_url(); ?>manage/lunar/payments_reg/<?php echo $row->id; ?>" target='_BLANK'>Payment Split</a>
                                                
                                            <?php } else { ?>
                                                <a href="<?php echo base_url(); ?>manage/lunar/lunarcompetition_assign/<?php echo $row->lunar_schedule_id; ?>" class="btn btn-warning">Assign</a>
                                            <?php } ?>
                                            
						                </td>
						                
						            </tr>
						            <?php $i=$i+1;} ?>
						        </tbody>
						        
						    </table>
						    <?php } ?>
						    
						</div>
					
					</div>
					
					
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

