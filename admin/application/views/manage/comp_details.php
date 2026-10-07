<?php include('header.php');
// $dateParts = explode(' ', $result['competition_date']);
// $date = $dateParts[0]; 

print_r($competition_details['id']);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>
					</li>
					<li>
					<a href='#'>Review</a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 

			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo 'Review';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					    <div class="box-content">
						
							<fieldset>
							    
							<div class="page-header">
							  <h1><small>Competition Details</small></h1>
							</div>
							
							<div>
							    <!--<hr>-->
							    <div style='display:flex;'> 
							    <?php  $period = $this->db->get_where('period',array('period_id'=>$competition_details['period_id']))->row_array(); 
							 //   print_r($period);
							    ?>
							    <label>Period : <b><?php echo $period['academic_year']; ?></b></label> &nbsp &nbsp &nbsp &nbsp
							    
							    <label>Country : <b>India</b></label>&nbsp &nbsp &nbsp &nbsp 
							    
							    <?php  $state = $this->db->get_where('states',array('state_subdivision_id'=>$competition_details['state_id']))->row_array(); ?>
							    <label>State : <b><?php echo $state['state_subdivision_name']; ?></b></label>&nbsp &nbsp &nbsp &nbsp
							    
							    <?php  $franchise = $this->db->get_where('franchise',array('franchise_id'=>$split_details['franchise_id']))->row_array(); ?>
							    <label>Franchise : <b><?php echo $franchise['franchise_code'].' '.$franchise['franchise_name']; ?></b></label>
							    </div>
							    
							    <div style='display:flex;'> 
							    <label>Product : <b><?php echo $competition_details['product_name']; ?></b></label> &nbsp &nbsp &nbsp &nbsp
							    <?php  $level_name = $this->db->get_where('competition_level_byproduct',array('level_id'=>$competition_details['clevel']))->row_array(); ?>
							    <label>C-Level : <b><?php echo $level_name['level_name']; ?></b></label>&nbsp &nbsp &nbsp &nbsp
							    <label>Competition Price : <b><?php echo 'Rs. '.$competition_details['product_price']; ?></b></label>&nbsp &nbsp &nbsp &nbsp
							    <label>Competition Date : <b><?php echo $competition_details['close_date']; ?></b></label>
							    </div>
							</div>
							
							<div>
							    <hr>
							    <h4 style='font-weight:700;'>GST Amount :- </h4>
							    
							    
							    <div style='display:flex;'>
    							    <label>Competition : <b><?php echo 'Rs.'.$competition_details['product_price'].'<br>'; 
    							    $total=$competition_details['product_price'];
    							    $base_price_competition= $total /1.18; 
    							    echo 'Base Price => Rs.'.$base_price_competition.'<br>';
    							    $gst_com=$total-$base_price_competition;
    							    echo 'GST cut => Rs.'.$gst_com;
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    
    							    <label>Material - A : <b><?php
    							    if(!empty($split_details['mat_a_price'])){
        							    echo 'Rs. '.$split_details['mat_a_price'].'<br>'; 
        							    $total=$split_details['mat_a_price'];
        							    $base_price_mat_a= $total /1.18; 
        							    $base_price_mat_a = round($base_price_mat_a, 2); 
        							    echo 'Base Price => Rs.'.$base_price_mat_a.'<br>';
        							    $gst_mat_a=$total-$base_price_mat_a;
        							    $gst_mat_a = round($gst_mat_a, 2);
        							    echo 'GST cut => Rs.'.$gst_mat_a;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?>
    							    </b></label>&nbsp &nbsp &nbsp &nbsp
    							    
    							    </b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - B % : <b><?php 
    							     
    							    if(!empty($split_details['mat_b_price'])){
        							    echo 'Rs. '.$split_details['mat_b_price'].'<br>'; 
        							    $total=$split_details['mat_b_price'];
        							    $base_price_mat_b= $total /1.18; 
        							    $base_price_mat_b = round($base_price_mat_b, 2); 
        							    echo 'Base Price => Rs.'.$base_price_mat_b.'<br>';
        							    $gst_mat_b=$total-$base_price_mat_b;
        							    $gst_mat_b = round($gst_mat_b, 2);
        							    echo 'GST cut => Rs.'.$gst_mat_b;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b>
    							    </label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - C % : <b><?php 
    							     
    							    if(!empty($split_details['mat_c_price'])){
        							    echo 'Rs. '.$split_details['mat_c_price'].'<br>'; 
        							    $total=$split_details['mat_c_price'];
        							    $base_price_mat_c= $total /1.18; 
        							    $base_price_mat_c = round($base_price_mat_c, 2); 
        							    echo 'Base Price => Rs.'.$base_price_mat_c.'<br>';
        							    $gst_mat_c=$total-$base_price_mat_c;
        							    $gst_mat_c = round($gst_mat_c, 2);
        							    echo 'GST cut => Rs.'.$gst_mat_c;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Orientation - A : <b><?php if(!empty($split_details['ori_a_price'])){
        							    echo 'Rs. '.$split_details['ori_a_price'].'<br>'; 
        							    $total=$split_details['ori_a_price'];
        							    $base_price_ori_a= $total /1.18; 
        							    $base_price_ori_a = round($base_price_ori_a, 2); 
        							    echo 'Base Price => Rs.'.$base_price_ori_a.'<br>';
        							    $gst_ori_a=$total-$base_price_ori_a;
        							    $gst_ori_a = round($gst_ori_a, 2);
        							    echo 'GST cut => Rs.'.$gst_ori_a;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - B : <b><?php if(!empty($split_details['ori_b_price'])){
        							    echo 'Rs. '.$split_details['ori_b_price'].'<br>'; 
        							    $total=$split_details['ori_b_price'];
        							    $base_price_ori_b= $total /1.18; 
        							    $base_price_ori_b = round($base_price_ori_b, 2); 
        							    echo 'Base Price => Rs.'.$base_price_ori_b.'<br>';
        							    $gst_ori_b=$total-$base_price_ori_b;
        							    $gst_ori_b = round($gst_ori_b, 2);
        							    echo 'GST cut => Rs.'.$gst_ori_b;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - C : <b><?php if(!empty($split_details['ori_c_price'])){
        							    echo 'Rs. '.$split_details['ori_c_price'].'<br>'; 
        							    $total=$split_details['ori_c_price'];
        							    $base_price_ori_c= $total /1.18; 
        							    $base_price_ori_c = round($base_price_ori_c, 2); 
        							    echo 'Base Price => Rs.'.$base_price_ori_c.'<br>';
        							    $gst_ori_c=$total-$base_price_ori_c;
        							    $gst_ori_c= round($gst_ori_c, 2);
        							    echo 'GST cut => Rs.'.$gst_ori_c;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Mock Test : <b><?php if(!empty($split_details['moc_a_price'])){
        							    echo 'Rs. '.$split_details['moc_a_price'].'<br>'; 
        							    $total=$split_details['moc_a_price'];
        							    $base_price_moc_a= $total /1.18; 
        							    $base_price_moc_a = round($base_price_moc_a, 2); 
        							    echo 'Base Price => Rs.'.$base_price_moc_a.'<br>';
        							    $gst_moc_a=$total-$base_price_moc_a;
        							    $gst_moc_a= round($gst_moc_a, 2);
        							    echo 'GST cut => Rs.'.$gst_moc_a;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Combo - 1 : <b><?php if(!empty($split_details['combo_1_price'])){
        							    echo 'Rs. '.$split_details['combo_1_price'].'<br>'; 
        							    $total=$split_details['combo_1_price'];
        							    $base_price_combo_1= $total /1.18; 
        							    $base_price_combo_1 = round($base_price_combo_1, 2); 
        							    echo 'Base Price => Rs.'.$base_price_combo_1.'<br>';
        							    $gst_combo_1=$total-$base_price_combo_1;
        							    $gst_combo_1= round($gst_combo_1, 2);
        							    echo 'GST cut => Rs.'.$gst_combo_1;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 2 : <b><?php if(!empty($split_details['combo_2_price'])){
        							    echo 'Rs. '.$split_details['combo_2_price'].'<br>'; 
        							    $total=$split_details['combo_2_price'];
        							    $base_price_combo_2= $total /1.18; 
        							    $base_price_combo_2 = round($base_price_combo_2, 2); 
        							    echo 'Base Price => Rs.'.$base_price_combo_2.'<br>';
        							    $gst_combo_2=$total-$base_price_combo_2;
        							    $gst_combo_2= round($gst_combo_2, 2);
        							    echo 'GST cut => Rs.'.$gst_combo_2;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 3 : <b><?php if(!empty($split_details['combo_3_price'])){
        							    echo 'Rs. '.$split_details['combo_3_price'].'<br>'; 
        							    $total=$split_details['combo_3_price'];
        							    $base_price_combo_3= $total /1.18; 
        							    $base_price_combo_3= round($base_price_combo_3, 2); 
        							    echo 'Base Price => Rs.'.$base_price_combo_3.'<br>';
        							    $gst_combo_3=$total-$base_price_combo_3;
        							    $gst_combo_3= round($gst_combo_3, 2);
        							    echo 'GST cut => Rs.'.$gst_combo_3;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 4 : <b><?php if(!empty($split_details['combo_4_price'])){
        							    echo 'Rs. '.$split_details['combo_4_price'].'<br>'; 
        							    $total=$split_details['combo_4_price'];
        							    $base_price_combo_4= $total /1.18; 
        							    $base_price_combo_4= round($base_price_combo_4, 2); 
        							    echo 'Base Price => Rs.'.$base_price_combo_4.'<br>';
        							    $gst_combo_4=$total-$base_price_combo_4;
        							    $gst_combo_4= round($gst_combo_4, 2);
        							    echo 'GST cut => Rs.'.$gst_combo_4;
    							    }else{
    							        echo 'Not Included';
    							    } ?></b></label>
							    </div>
							    
							</div>
							
							<div>
							    <hr>
							    <h4 style='font-weight:700;'>Split To Franchise :- <?php if(!empty($competition_details['franchise_split'])){echo $competition_details['franchise_split'];
							    
							    ?></h4>
							    <div style='display:flex;'>
    							    <label>Competition % : <b><?php
    							    echo $comp_franchise_per= $split_details['comp_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_competition.'<br>';
    							 
    							    echo 'Franchise Share : Rs. '.$franchise_comp_rup=$comp_franchise_per/100*$base_price_competition;
    							    
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    
    							    <label>Material - A % : <b><?php
    							    if(!empty($split_details['mat_a_franchise'])){
    							    echo $mata_franchise_per=$split_details['mat_a_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_mat_a.'<br>';
    							    $franchise_mata_rup=round($mata_franchise_per/100*$base_price_mat_a,2);
    							    echo 'Franchise Share : Rs. '.$franchise_mata_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - B % : <b><?php //echo $split_details['mat_b_franchise'].' %'; 
    							    if(!empty($split_details['mat_b_franchise'])){
    							    echo $matb_franchise_per=$split_details['mat_b_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_mat_b.'<br>';
    							    $franchise_matb_rup=round($matb_franchise_per/100*$base_price_mat_b,2);
    							    echo 'Franchise Share : Rs. '.$franchise_matb_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - C % : <b><?php 
    							    if(!empty($split_details['mat_c_franchise'])){
    							    echo $matc_franchise_per=$split_details['mat_c_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_mat_c.'<br>';
    							    $franchise_matc_rup=round($matc_franchise_per/100*$base_price_mat_c,2);
    							    echo 'Franchise Share : Rs. '.$franchise_matc_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							     ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Orientation - A % : <b><?php 
    							    if(!empty($split_details['ori_a_franchise'])){
    							    echo $oria_franchise_per=$split_details['ori_a_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_ori_a.'<br>';
    							    $franchise_oria_rup=round($oria_franchise_per/100*$base_price_ori_a,2);
    							    echo 'Franchise Share : Rs. '.$franchise_oria_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - B % : <b><?php //echo $split_details['ori_b_franchise'].' %';
    							    if(!empty($split_details['ori_b_franchise'])){
    							    echo $orib_franchise_per=$split_details['ori_b_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_ori_b.'<br>';
    							    $franchise_orib_rup=round($orib_franchise_per/100*$base_price_ori_b,2);
    							    echo 'Franchise Share : Rs. '.$franchise_orib_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - C % : <b><?php //echo $split_details['ori_c_franchise'].' %';
    							    if(!empty($split_details['ori_c_franchise'])){
    							    echo $oric_franchise_per=$split_details['ori_c_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_ori_c.'<br>';
    							    $franchise_oric_rup=round($oric_franchise_per/100*$base_price_ori_c,2);
    							    echo 'Franchise Share : Rs. '.$franchise_oric_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Mock Test % : <b><?php //echo $split_details['moc_a_franchise'].' %';
    							    if(!empty($split_details['moc_a_franchise'])){
    							    echo $moca_franchise_per=$split_details['moc_a_franchise'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_moc_a.'<br>';
    							    $franchise_moca_rup=round($moca_franchise_per/100*$base_price_moc_a,2);
    							    echo 'Franchise Share : Rs. '.$franchise_moca_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Combo - 1 % : <b><?php //echo $split_details['com_a_per'].' %';
    							    if(!empty($split_details['com_a_per'])){
    							    echo $coma_franchise_per=$split_details['com_a_per'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_combo_1.'<br>';
    							    $franchise_combo1_rup=round($coma_franchise_per/100*$base_price_combo_1,2);
    							    echo 'Franchise Share : Rs. '.$franchise_combo1_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 2 % : <b><?php //echo $split_details['com_b_per'].' %';
    							    if(!empty($split_details['com_b_per'])){
    							    echo $comb_franchise_per=$split_details['com_b_per'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_combo_2.'<br>';
    							    $franchise_combo2_rup=round($comb_franchise_per/100*$base_price_combo_2,2);
    							    echo 'Franchise Share : Rs. '.$franchise_combo2_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 3 % : <b><?php //echo $split_details['com_c_per'].' %';
    							    if(!empty($split_details['com_c_per'])){
    							    echo $comc_franchise_per=$split_details['com_c_per'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_combo_3.'<br>';
    							    $franchise_combo3_rup=round($comc_franchise_per/100*$base_price_combo_3,2);
    							    echo 'Franchise Share : Rs. '.$franchise_combo3_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 4 % : <b><?php //echo $split_details['com_d_per'].' %';
    							    if(!empty($split_details['com_d_per'])){
    							    echo $comd_franchise_per=$split_details['com_d_per'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_combo_4.'<br>';
    							    $franchise_combo4_rup=round($comd_franchise_per/100*$base_price_combo_4,2);
    							    echo 'Franchise Share : Rs. '.$franchise_combo4_rup;
    							    }else{
    							        echo 'Not Included';
    							    }
    							    ?></b></label>
							    </div>
							    
							   <h4><?php  }else{echo 'No';} ?></h4>
							    
							    
							    
							</div>
							
							<div>
							    <hr>
							    <h4 style='font-weight:700;'>Split To Aviansys :- <?php if(!empty($competition_details['aviansys_split'])){echo $competition_details['aviansys_split'];
							    ?></h4>
							     <div style='display:flex;'>
    							    <label>Competition % : <b><?php //echo $split_details['comp_per'].' %';
    							    echo $comp_avian_per= $split_details['comp_per'].' %<br>';
    							    echo 'Base Price : Rs. '.$base_price_competition.'<br>';
    							 
    							    echo 'Aviansys Share : Rs. '.$avian_comp_rup=$comp_avian_per/100*$base_price_competition;
    							    
    							    
    							    ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    
    							    <label>Material - A % : <b><?php echo $split_details['mat_a_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - B % : <b><?php echo $split_details['mat_b_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Material - C % : <b><?php echo $split_details['mat_c_per'].' %'; ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Orientation - A % : <b><?php echo $split_details['ori_a_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - B % : <b><?php echo $split_details['ori_b_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Orientation - C % : <b><?php echo $split_details['ori_c_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Mock Test % : <b><?php echo $split_details['moc_a_per'].' %'; ?></b></label>
							    </div>
							    <div style='display:flex;'>
    							    <label>Combo - 1 % : <b><?php echo $split_details['com_a_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 2 % : <b><?php echo $split_details['com_b_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 3 % : <b><?php echo $split_details['com_c_per'].' %'; ?></b></label>&nbsp &nbsp &nbsp &nbsp
    							    <label>Combo - 4 % : <b><?php echo $split_details['com_d_per'].' %'; ?></b></label>
							    </div>
							    
							    
							    <h4>
							    <?php 
							    }else{echo 'No';} ?></h4>
							    
							    
							</div>
							
							</fieldset>
							
                        </div>   
                        
                       
					</div>
				</div>
			
			
<?php include('footer.php'); ?>
 