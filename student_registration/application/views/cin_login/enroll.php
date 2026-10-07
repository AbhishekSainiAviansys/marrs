<?php include('header.php');



// echo $open_modal;

// print_r($result);die;

$state_id = $activate[0];
// echo count($comps);
$av_ad = 'no'; // Default value

// foreach($comps as $row) {
    // echo $row->id;
    
    // $res = $this->db->get_where('exam_centers', array('comp_id' => $_SESSION['exam_id']))->row();
    
    // if (!empty($res)) {
    //     $av_ad = 'yes';
    //     break;
    // }
    
    
// }

//   echo $av_ad;

// print_r($activate[0]);

// print_r($student['cin']);
//  echo 'ok';

//   echo $combo1.'ko';
//   echo $combo2.'pkk';
//   echo $combo3.'jj';
//   echo $combo4.'hi';

    $student_all_data = $this->db->get_where('cin_list',array('cin' =>$result['cin']))->row();
  
    $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$result['medal_no']+1,'product_name' =>$result['product_name']))->row();
    
		$nlev=$res->level_name;$level_id=$res->level_id;
		
		
		$competi=$this->db->get_where('competition_product_state',array('id' =>$_SESSION['exam_id']))->row();
		
		
		$wolah = $this->db->get_where('new_cart', array('period_id' => $competi->period_id,'cin'=>$cin,'clevel'=>$competi->clevel,'comp_date !='=>''))->row();
		
// 		echo $this->db->last_query();


                                if(!empty($wolah->comp_date)){
                                    $close_date =$wolah->comp_date;
                                }else{
                                    $close_date = $activate[0]['close_date'];
                                }
                                
                            // echo "Close Date: " . $close_date . "<br>";
                            
                            // Calculate three days before close date
                            $date = new DateTime($close_date);
                            $date->modify('-3 days');
                            $three_days_before = $date->format('Y-m-d');
                            // echo "Three Days Before: " . $three_days_before . "<br>";
                            
                            // Calculate five days before close date
                            $date_five_days = new DateTime($close_date);
                            $date_five_days->modify('-5 days');
                            $date_five_days_formatted = $date_five_days->format('Y-m-d');
                            // echo "Five Days Before: " . $date_five_days_formatted . "<br>";
                            
                            // Calculate seven days before close date
                            $date_seven_days = new DateTime($close_date); // Create DateTime object
                            $date_seven_days->modify('-7 days'); // Subtract 7 days
                            $date_seven_days_formatted = $date_seven_days->format('Y-m-d'); // Format as YYYY-MM-DD
                            
                            $date = new DateTime($close_date);
                            $date->modify('-2 days');
                            $two_days_before = $date->format('Y-m-d');
                            
                            $date = new DateTime($close_date);
                            $date->modify('-1 days');
                            $one_days_before = $date->format('Y-m-d');
                            
                            
                            // Get today's date
                            $today = date('Y-m-d');

// Output the results
// echo "Seven Days Before: " . $date_seven_days_formatted . "<br>";
// echo "Today's Date: " . $one_days_before . "<br>";
                                                                    
// if ($today < $date_seven_days_formatted) {
//     echo "The date has not passed.";
// } else {
//     echo "The date has passed.";
// }



$exam_center = $this->db->get_where('exam_centers', array('comp_id' => $_SESSION['exam_id']))->result();

 function formatBundleName($bundle) {
    $map = [
        'study_material_a' => 'Learning Material A',
        'orientation_a'    => 'Training A',
        'study_material_b' => 'Learning Material B',
        'orientation_b'    => 'Training B',
        'study_material_c' => 'Learning Material C',
        'orientation_c'    => 'Training C',
    ];

    $parts = explode(' + ', $bundle);
    $formatted = [];

    foreach ($parts as $part) {
        $formatted[] = $map[$part] ?? $part;
    }

    return implode(' + ', $formatted);
}
// echo $activate[0]['id'];

// print_r($_SESSION['exam_id']);

// echo $close_date;
// $is_registered = (!empty($wolah) && !empty($wolah->comp_date)) ? 1 : 0;

// $show_modal = ($competition == 'Yes' && $is_registered == 0) ? 1 : 0;




?>
 <style>
 a{
         text-decoration: none !important;
 }
 #productWrapper h4{
     font-size:18px;
 }
      #certificateWrapper h1 {
        font-size: 70px;
        font-family: Snell Roundhand, cursive;
        font-weight: 500;
        color: #ffffff;
      }
      .sign {
        position: absolute;
        bottom: 0;
        padding: 5% 5% 0% 5%;
        right: 0;
        font-weight: 700;
        color: #676b6d;
      }
      #certificateWrapper th {
        white-space: nowrap;
        font-size: 12px;
        font-weight: 700;
        color: #707475;
      }
      #certificateWrapper td {
        font-size: 15px;
        font-weight: 700;
        color: #676b6d;
        white-space: nowrap;

      }
      .partcip-detail b {
        color: #5c5d60;
      }
      #certificateWrapper {
        align-items: center;
        min-height: 100vh;
      }
      #certificateWrapper .card {
        background-image: url("../images/bg.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: none;
      }
      #certificateWrapper .card .card-body {
        border: 4px solid #f8c913;
      }
	 
	 
	.custom-alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            z-index: 1000;
            font-family: Arial, sans-serif;
        }

        .custom-alert p {
            margin: 0;
        }

        /* Style for overlay (to make it look like a modal) */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        } 
	 #nav-tab {
    background: transparent;
}

.nav-tabs .nav-link:hover {
    color: #0a58ca;
    background: transparent;
}

/* Active tab EXACT like your image */
.nav-tabs .nav-link.active {
    color: #495057;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-bottom: 1px solid #fff;
}

/* Content */
.tab-content {
    background: #fff;
    padding: 20px 0;
}

/* ===== Cards (Keep Clean Minimal Look) ===== */
.card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    box-shadow: none;
    transition: all 0.2s ease;
}

.card:hover {
    border-color: #0d6efd;
}
.price {
    font-size: 18px;
    font-weight: 700;
    color: #2563eb;
    margin: 8px 0;
}

/* Badge */
.badge {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 6px;
}

/* Button */
.btn-primary {
    border-radius: 8px;
    font-weight: 600;
    padding: 6px 12px;
}
.card-title {
    font-size: 15px;
    font-weight: 600;
}

.cart-footer {
    background: transparent;
    border-top: 1px solid #f1f1f1;
    display: flex;
    gap: 10px;
}

/* Buttons simple clean */
.btn {
    border-radius: 6px;
    font-size: 13px;
    padding: 6px 12px;
}

.btn-warning {
    background: #ffc107;
    border: none;
    color: #000;
}

.btn-danger {
    background: #dc3545;
    border: none;
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .nav-tabs {
        flex-wrap: wrap;
    }

    .nav-tabs .nav-link {
        padding: 8px 10px;
        font-size: 13px;
    }
}
.btn-invoice {
    background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
    color: #fff !important;
    border: none;
    border-radius: 0px !important;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.25s ease;
    text-decoration: none;
}

/* Hover */
.btn-invoice:hover {
    background: linear-gradient(135deg, #1d4ed8, #2563eb);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(37,99,235,0.3);
}

/* Icon animation (subtle) */
.btn-invoice i {
    transition: transform 0.2s ease;
}

.btn-invoice:hover i {
    transform: scale(1.1);
}
.list-group-item h5{
    font-size:1rem !important;
    padding:0.5rem 0.8rem;
}
    </style>

   <section>
<!--<marquee><h3 style='color:crimson;'>Due to some server issue. Study Materials will be downloadable by tommarow morning... </h3></marquee>-->
<!--<marquee><h3 style='color:crimson;'>Due to some techinical issue. Payments will be enable in some time... </h3></marquee>-->

        <div id="productWrapper" class="container">
            <div class="row text-center my-2 mx-2" id="result">
                
                <div class="text-start " style="
    display: flex !important;
    flex-wrap: nowrap;
    justify-content: space-between;
">   
                
                    <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                    <a href="" class="btn btn-outline-secondary btn-sm text-start fw-bold"><?php 
                    $reos = $this->db->get_where('period',array('period_id' => $result['period_id'] ))->row();
                    echo $reos->academic_year; ?></a>  
                    
                    
                </div>
                
                
                
              <div class="col-12 my-2 mx-2">
                  
               <h1 class='mb-2' style='color:#f26522;'><?php  echo $result['product_name']; 
                                                        ?> </h1>
                                                        <h2><?php echo $result['level_name']; ?> RESULT</h2>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">CIN</h3>
                  <h4><?php if(!empty($result['cin'])){ echo $result['cin'];}else{echo $student['cin'];} ?></h4>
                </div>
              </div>
                <h3></h3>
               
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Grade</h3>
                  <h4><?php if(!empty($result['grade'])){ echo $result['grade'];}else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Rank</h3>
                  <h4><?php if($result['rank']==''){echo 'No Rank';}else{echo $result['rank'];} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Star Speller</h3>
                  <h4><?php if(!empty($result['speller'])){echo $result['speller'];}else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Best Performer</h3>
                  <h4><?php if(!empty($result['performer'])){ echo $result['performer']; }else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Status</h3>
                  <h4><?php if(!empty($result['status'])){ echo $result['status'];}else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
            </div>
        </div>
    </section>
    
<div class="modal fade" id="closeDateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-3">
      <h5 class="mb-3">Select Competition Date</h5>
      <select id="closeDateSelect" class="form-control mb-3"></select>
      <div class="text-end">
        <button class="btn btn-primary" onclick="submitCloseDate()">Confirm</button>
      </div>
    </div>
  </div>
</div>


    
    <section style='padding-bottom:110px;'>
        <div class="container col">
            
            
            
            <div class="row" id="reg_download">
                
                
                <?php 
               
                    
                    //if($result['status']=='Q' && $student_all_data->franchise_id !='68'){ 
                    
                    if($result['status']=='Q' || $result['status'] == ''){ ?> 
                    
                        <div class="col-12 mx-2 text-center">   
                            <h3 style="padding:10px"><span style="color:#006699;">Congratulations!! You are qualified to register for the </span><span style="color:crimson;font-family: 'FontAwesome';font-size: 16px;letter-spacing:2px;"> <?php echo $nlev; ?></span><span style="color:#006699;"> Championship..</span></h3> 
                        </div>
                        
                    <div class='col-sm-8'>  
                    <div ><h4 style='color:green;'>Please choose your option and pay</h4></div>
                        <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Competition</button>
                            <!--<button class="nav-link" id="nav-bundle-tab" data-bs-toggle="tab" data-bs-target="#nav-bundle" type="button" role="tab" aria-controls="nav-bundle" aria-selected="false">Learning Material + Training</button>-->
                            <!--<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Paid Study Material</button>-->
                            <!--<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Training(Orientation)</button>-->
<?php 
$bundle_active = (
    $activate[0]['bundle_a'] == 'study_material_a + orientation_a' ||
    $activate[0]['bundle_b'] == 'study_material_b + orientation_b' ||
    $activate[0]['bundle_c'] == 'study_material_c + orientation_c' ||
    $activate[0]['bundle_d'] == 'study_material_d + orientation_d' ||
    $activate[0]['bundle_e'] == 'study_material_e + orientation_e' ||
    $activate[0]['bundle_c'] == 'study_material_c + orientation_c'
);
?>

<?php if(!empty($bundle_active)){ ?>
    <button class="nav-link" id="nav-bundle-tab" data-bs-toggle="tab" data-bs-target="#nav-bundle" type="button" role="tab" aria-controls="nav-bundle" aria-selected="false">Learning Material + Training</button>
<?php } 

if($activate[0]['study_material_a'] == 'study_material_a') { ?>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Paid Study Material</button>
<?php } 
if($activate[0]['orientation_a'] == 'orientation_a' ) { ?>    
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Training(Orientation)</button>
<?php } ?>


                            <button class="nav-link" id="nav-mock-tab" data-bs-toggle="tab" data-bs-target="#nav-mock" type="button" role="tab" aria-controls="nav-mock" aria-selected="false">Mock Test</button>
                            
                            
                            <!--<button class="nav-link" id="nav-combo-tab" data-bs-toggle="tab" data-bs-target="#nav-combo" type="button" role="tab" aria-controls="nav-combo" aria-selected="false">COMBOs</button>-->
                            
                          <?php 
                          $res = $this->db->get_where('new_cart',array('cin' =>$result['cin'],'clevel'=>$level_id))->result_array(); 
                          //echo $this->db->last_query();
                          if(!empty($res)){
                          ?>
                          
                <a href="<?php echo base_url(); ?>cin_login/api_callinvoice/<?php echo $level_id; ?>" 
                   class="btn btn-invoice">
                   <i class="fa-solid fa-file-invoice"></i> Invoice
                </a>
                                          
          <!--                  <form method='POST'>-->
          <!--                      <button type="submit" name="invoice"  class="btn btn-primary btn-mg " id='pay-button' style='font-size:12px;font-weight:700;' value='<?php echo $level_id; ?>'>Invoice</button> -->
    						<!--</form>-->
						<?php } ?>
						
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class=" tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div>
                            
                                <?php if($activate[0]['status']=='Live'){  ?>
                                        <div class="tab-content row" id="myTabContent">
                                            
                                            <div    class="d-flex tab-pane gap-3 bg-white fade show active" id="competition-tab" role="competition-tab" aria-labelledby="competition-tab" >
                                                <?php
                                                // $close_date = $activate[0]['close_date']; 
                                                //             $date = new DateTime($close_date);
                                                //             $date->modify('-3 days');
                                                            
                                                //             $three_days_before = $date;
                                                //             $today = new DateTime();
                                                  
                                                // echo $competition;  
        
                                                if($competition=='Yes'){ 
                                               
                                                ?> 
                                            
                                                    <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                            <div class="card-body" style='padding-bottom:0px;'>
                                                                <h5 class="card-title"><?php  echo $result['product_name']; 
                                                                ?></h5>
                                                                
                                                            </div>
                                                            <div class="card-body" style='padding-top:0px;'>
                                                                <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['product_price']; ?></a>
                                                                
                                                            </div>
                                                            
                                                            
                                                            <div class="card-footer">
                                                                <?php    
                                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                                $this->db->select('*');
                                                                $this->db->from('amount_cart');
                                                                $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
                
                                                                $query = $this->db->get();
                                                               // echo $this->db->last_query();
                                                                $res= $query->result_array();
                                                               
                                                                if( $activate[0]['product_price']!='0'){
                                                                    
                                                                    $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
                						                
                            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                            						              //  print_R($center);
                            						                $date_close='';
                            						                
                            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                            						                    $date_close=$center[0]['exam_date'];
                            						                }
                            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                            						                    $date_close=$center1[0]['exam_date'];
                            						                }
                            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                            						                    $date_close=$activate[0]['close_date'];
                            						                }
                            						              // print_r($activate[0]);
                            						              //  if(!empty($date_close)){
                            						                  //  echo 'Competition Date: '.$date_close.'<br>';
                            						              //  }
                            						                $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                            						              //  echo $date_close.' '.$sevenDaysBefore;
                                                                    $today = date("Y-m-d");
                                                                  
                                                                    $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                    
                                                                    if(empty($cen->exam_close) or $cen->exam_close == 0){
                                                                        // if ($two_days_before >= $today ) 
                                                                        // echo $today;
                                                                        
                                                                        if($one_days_before >= $today)
                                                                        
                                                                        { ?>
                                                                       
                                                            
                                                                    <a href="#" class="btn btn-warning btn-sm" onClick="preCheckCompetition(this);" id="<?php echo $activate[0]['product_price'].'+'.'Competition'; ?>">
                                                                        <i class="fa-solid fa-cart-plus"></i>
                                                                    </a>
                                                                    
                                                                    <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['product_price'].'+'.'Competition'; ?>">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </a>
        
                                                                    <!--<a href="#" class="btn btn-warning btn-sm" onClick="test_cartrevenue(this.id);" id="<?php echo $activate[0]['product_price'].'+'.'Competition';?>"> </a>-->
                                                        
                                                            
                                                                    <?php
                                                            
                                                                
                                                                
                                                                        }else{
                                                                             
                                                                            echo 'Registration Closed.';
                                                                        }
                                                                
                                                                
                                                                    }else{
                                                                       echo 'Registration Closed.';
                                                                    }
                        						               
                                                                } ?>
                                                            
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                            
                                                
                                                <?php 
                                                    
                                                }else{ //echo 'ok';
                                                 
                                                       
                                                    
                                                                            
                        
                                                 ?>
                                                 
                                                 
                                                        <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                            <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                                <div class="card-body" style='padding-bottom:0px;'>
                                                                    <h5 class="card-title"><?php
                                                                    // print_r($result['clevel']);
                                                                    echo $result['product_name']; ?></h5>
                                                                </div>
                                                                <div class="card-body" style='padding-top:0px;'>
                                                                    <a href="#" class="card-link">Admit Card: </a>
                                                                 <?php 
                                                                 if($admit_card_av=='yes'){
                                                                    echo 'Exam Date';
                                                                 }else{
                                                                     echo 'Exam Date';
                                                                 }
                                                                 echo '<br>'.$close_date;
                                                                 ?>
                                                                </div>
                                                                <div class="card-footer">
                                                                    
                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1"> Admit Card will be Avilable Soon</a>-->
                                                                     <!--<a href="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1"> Admit Card</a> -->
                                                                   <?php 
                                                                   
                                                                // print_r($exam_center);
                                                                  
                                                                   if($admit_card_av=='yes' or $av_ad == 'yes' or !empty($exam_center)){
                                                                       
                                                                    //   echo $today.$three_days_before;
                                                                       
                                                                    if ($today >= $three_days_before) {
                                                                       
                                                                //   if ($today==  $today) {
                                                                
                                                                   ?>
                                                                   Download 
                                                                   <a href="<?php echo base_url();?>cin_login/api_calladmit_card/<?php echo $clevel; ?>" class="btn btn-warning btn-sm my-1" > <i class="fa-solid fa-download"></i></a>
                                                                    
                                                                        <!--<form method='post' action="<?php echo base_url()?>cin_login/admitcard_download" >-->
                                                                        <!--    <button name="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1" value='<?php echo $admit_id;?>'> <i class="fa-solid fa-download"></i></button>-->
                                                                        <!--</form>  -->
                                                                        
                                                                   <?php }else{
                                                                       echo 'Available On '.$three_days_before;
                                                                   }
                                                                   }else{ 
                                                                   echo 'Available On '.$three_days_before;
                                                                   
                                                                   } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                        
                                                        <!-- ============ free material =============== -->
                                                        <?php 
                                                        
                                                        //  print_r($material_free_a);
                                                        
                                                        if(!empty($material_free_a)){ 
                                                        ?>
                                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                            
                                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                                        <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                        <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                            <input type='text' name='mat_id' value="<?php echo $material_free_a->id; ?>" style='display:none;' >
                                                                            
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">Study Material A- Free</h5>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <a href="#" class="card-link">Price: Free</a>
                                                                                <?php if(!empty($material_free_a)){?>
                                                                                <a href="#" class="card-link">Available</a>
                                                                                <?php }else{ echo 'Available Soon.'; }?>
                                                                            </div>
                                                                            <div class="card-footer p-1">
                                                                                <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                                <?php if(!empty($material_free_a)){?>
                                                                                <!--<a href="#" class="card-link">Available</a>-->
                            
                                                                                <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                          <?php } ?> 
                                                                               
                                                                                <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                            </div>
                                                                        </form>
                                                                        </div>
                                                                
                                                                    </div>
                                                        <?php }
                                                        
                                                        
                                                        // print_r($material_free_b);
                                                        if(!empty($material_free_b)){
                                                        
                                                        
                                                        ?>
                                                        
                                                       <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                            <input type='text' name='mat_id' value="<?php echo $material_free_b->id; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material B- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free </a>
                                                                        <?php if(!empty($material_free_b)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_b)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    
                                                    
                                                        <?php }
                                            
                                            
                                                        if(!empty($material_free_c)){?>
                                                        
                                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                            <input type='text' name='mat_id' value="<?php echo $material_free_c->id; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material C- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free </a>
                                                                        <?php if(!empty($material_free_c)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_c)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    
                                                    
                                                        <?php }
                                            
                                            
                                                        if(!empty($material_free_d)){ ?>
                                                        
                                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                            <input type='text' name='mat_id' value="<?php echo $material_free_d->id; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material D- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free </a>
                                                                        <?php if(!empty($material_free_d)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_d)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    
                                                    
                                                        <?php }
                                            
                                                        
                                                        if(!empty($material_free_e)){?>
                                                        
                                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                            <input type='text' name='mat_id' value="<?php echo $material_free_e->id; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material E- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free </a>
                                                                        <?php if(!empty($material_free_e)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_e)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    
                                                    
                                                        <?php }
                                            
                                                        
                                                        if(!empty($material_free_f)){?>
                                                        
                                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_down" >
                                                                            
                                                                    <input type='text' name='mat_id' value="<?php echo $material_free_f->id; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material F- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free </a>
                                                                        <?php if(!empty($material_free_f)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_f)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    
                                                    
                                                        <?php }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        ?>
                                            
                                                
                                            
                                                <?php } 
                                            
                                        } ?>
                                        
            
                                    </div>
                            
                            
                            
                                </div>
                            </div> 
                          
                          
                          
                          </div>
                          
                          
                          <!-- ======================= BUNDLES ======================== -->
                        <div class="tab-pane fade" id="nav-bundle" role="tabpanel" aria-labelledby="nav-bundle-tab">
                            <div class="row">
                                
                                <?php
                                
                                if($activate[0]['bundle_a'] == 'study_material_a + orientation_a') { 
                                    
                                    
                                    // $bundle_a_paid = $this->db->get_where('new_cart', array(
                                    //     'cin'              => $result['cin'],
                                    //     'clevel'           => $level_id,
                                    //     'status'           => 'Paid',
                                    //     'study_material_a' => 'Yes',
                                    //     'orientation_a'    => 'Yes'
                                    // ))->row();
                                    
                                    $bundle_a_paid = $this->db
                                        ->where('cin', $result['cin'])
                                        ->where('clevel', $level_id)
                                        // ->where('status', 'Paid')
                                        ->group_start()
                                            ->where("LOWER(study_material_a) = 'yes'", null, false)
                                            ->or_where("LOWER(orientation_a) = 'yes'", null, false)
                                        ->group_end()
                                        ->get('new_cart')
                                        ->row();
                            
                                    // echo $this->db->last_query();
                            
                                    if($bundle_a=='Yes' && empty($bundle_a_paid)){ ?>
                                        <!-- BUY CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            <div class="card my-2 mx-2 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_a']); ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['bundle_price_a']; ?></a>
                                                </div>
                                                <div class="card-footer">
                                                    <?php if($activate[0]['bundle_price_a']!='0'){
                                                        $center  = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
                                                        $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                                                        $date_close='';
                                                        if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){ $date_close=$center[0]['exam_date']; }
                                                        if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){ $date_close=$center1[0]['exam_date']; }
                                                        if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){ $date_close=$activate[0]['close_date']; }
                                                        $today = date("Y-m-d");
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        if(empty($cen->close_bundle_a) or $cen->close_bundle_a == 0){
                                                            if($close_date >= $today){ ?>
                                                                <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['bundle_price_a'].'+'.'Learning Material A Training A';?>"><i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['bundle_price_a'].'+'.'Learning Material A Training A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php }else{ echo 'Bundle-A Purchase Close.'; }
                                                        }else{ echo 'Bundle-A Purchase Close.'; }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                            
                                    <?php } else { ?>
                                        <!-- DOWNLOAD CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_a']); ?> - Paid</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php if(!empty($material_paid_a)){ echo 'Available'; }else{ echo 'Available Soon.'; } ?></a>
                                            </div>
                                            <div class="card-footer p-1">
                                                <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                    <input type='text' name='mat_id' value='<?php if(!empty($material_paid_a)){ echo $material_paid_a->id; } ?>' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                    <?php if(!empty($material_paid_a)){ ?>
                                                        <button type="submit" name="download_paid" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                    <?php }else{ ?>
                                                        <button type="button" class="btn btn-secondary btn-sm my-1" style="pointer-events:none;"><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>
                                                </form>
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                    <input type='text' name='type' value='A' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Training</a>
                                                    <button type="submit" name="download_slip" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    <?php } 
                                } ?>
                            
                                <!-- ================= Bundle B ================= -->
                                <?php
                                
                                
                                
                                if($activate[0]['bundle_b'] == 'study_material_b + orientation_b') {
                                    
                                    $bundle_b_paid = $this->db
                                        ->where('cin', $result['cin'])
                                        ->where('clevel', $level_id)
                                        // ->where('status', 'Paid')
                                        ->group_start()
                                            ->where("LOWER(study_material_b) = 'yes'", null, false)
                                            ->or_where("LOWER(orientation_b) = 'yes'", null, false)
                                        ->group_end()
                                        ->get('new_cart')
                                        ->row();
                                        
                                    // $bundle_b_paid = $this->db->get_where('new_cart', array(
                                    //     'cin'              => $result['cin'],
                                    //     'clevel'           => $level_id,
                                    //     'status'           => 'Paid',
                                    //     'study_material_b' => 'Yes',
                                    //     'orientation_b'    => 'Yes'
                                    // ))->row();
                            
                                    if($bundle_b=='Yes' && empty($bundle_b_paid)){ ?>
                                        <!-- BUY CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_b']); ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['bundle_price_b']; ?></a>
                                            </div>
                                            <div class="card-footer">
                                                <?php if($activate[0]['bundle_price_b']!='0'){
                                                    $center  = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
                                                    $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                                                    $date_close='';
                                                    if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){ $date_close=$center[0]['exam_date']; }
                                                    if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){ $date_close=$center1[0]['exam_date']; }
                                                    if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){ $date_close=$activate[0]['close_date']; }
                                                    $today = date("Y-m-d");
                                                    $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    if(empty($cen->close_bundle_b) or $cen->close_bundle_b == 0){
                                                        if($close_date >= $today){ ?>
                                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['bundle_price_b'].'+'.'Learning Material B Training B';?>"><i class="fa-solid fa-cart-plus"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['bundle_price_b'].'+'.'Learning Material B Training B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                        <?php }else{ echo 'Bundle-B Purchase Close.'; }
                                                    }else{ echo 'Bundle-B Purchase Close.'; }
                                                } ?>
                                            </div>
                                        </div>
                                        </div>
                            
                                    <?php } else { ?>
                                        <!-- DOWNLOAD CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_b']); ?> - Paid</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php if(!empty($material_paid_b)){ echo 'Available'; }else{ echo 'Available Soon.'; } ?></a>
                                            </div>
                                            <div class="card-footer p-1">
                                                <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                    <input type='text' name='mat_id' value='<?php if(!empty($material_paid_b)){ echo $material_paid_b->id; } ?>' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                    <?php if(!empty($material_paid_b)){ ?>
                                                        <button type="submit" name="download_paid" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                    <?php }else{ ?>
                                                        <button type="button" class="btn btn-secondary btn-sm my-1" style="pointer-events:none;"><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>
                                                </form>
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                    <input type='text' name='type' value='B' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Training</a>
                                                    <button type="submit" name="download_slip" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    <?php }
                                } ?>
                            
                                <!-- ================= Bundle C ================= -->
                                <?php
                                if($activate[0]['bundle_c'] == 'study_material_c + orientation_c') {
                                    $bundle_c_paid = $this->db->get_where('new_cart', array(
                                        'cin'              => $result['cin'],
                                        'clevel'           => $level_id,
                                        'status'           => 'Paid',
                                        'study_material_c' => 'Yes',
                                        'orientation_c'    => 'Yes'
                                    ))->row();
                            
                                    if($bundle_c=='Yes' && empty($bundle_c_paid)){ ?>
                                        <!-- BUY CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_c']); ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['bundle_price_c']; ?></a>
                                            </div>
                                            <div class="card-footer">
                                                <?php if($activate[0]['bundle_price_c']!='0'){
                                                    $center  = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
                                                    $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                                                    $date_close='';
                                                    if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){ $date_close=$center[0]['exam_date']; }
                                                    if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){ $date_close=$center1[0]['exam_date']; }
                                                    if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){ $date_close=$activate[0]['close_date']; }
                                                    $today = date("Y-m-d");
                                                    $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    if(empty($cen->close_bundle_c) or $cen->close_bundle_c == 0){
                                                        if($close_date >= $today){ ?>
                                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['bundle_price_c'].'+'.'Learning Material C Training C';?>"><i class="fa-solid fa-cart-plus"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['bundle_price_c'].'+'.'Learning Material C Training C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                        <?php }else{ echo 'Bundle-C Purchase Close.'; }
                                                    }else{ echo 'Bundle-C Purchase Close.'; }
                                                } ?>
                                            </div>
                                        </div>
                                        </div>
                            
                                    <?php } else { ?>
                                        <!-- DOWNLOAD CARD -->
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo formatBundleName($activate[0]['bundle_c']); ?> - Paid</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php if(!empty($material_paid_c)){ echo 'Available'; }else{ echo 'Available Soon.'; } ?></a>
                                            </div>
                                            <div class="card-footer p-1">
                                                <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                    <input type='text' name='mat_id' value='<?php if(!empty($material_paid_c)){ echo $material_paid_c->id; } ?>' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                    <?php if(!empty($material_paid_c)){ ?>
                                                        <button type="submit" name="download_paid" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                    <?php }else{ ?>
                                                        <button type="button" class="btn btn-secondary btn-sm my-1" style="pointer-events:none;"><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>
                                                </form>
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                    <input type='text' name='type' value='C' style='display:none;'>
                                                    <a href="#" class="btn btn-warning btn-sm my-1">Training</a>
                                                    <button type="submit" name="download_slip" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    <?php }
                                } ?>
                            
                            </div>
                            
                        </div>
                        
                        
                         <?php //print_r($activate[0]); ?> 
                        <!-- ======================= Study Material ======================== -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class='row'>
                              
                            <?php
                            
                            // print_r($activate[0]);
                            
                            // echo $activate[0]['study_material_a'];
                            
                            // echo $study_material_a;
                            
                            // echo '<pre>';
                            // print_r($material_paid_a);
                             
                            if($activate[0]['study_material_a'] == 'study_material_a' and !empty($material_paid_a)) { 
                                
                                // echo 'ok';
                                
                                if($study_material_a == 'Yes' && !empty($material_paid_a)){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material A - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_a_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query(); 
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_a_price']!='0' ){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
						                
            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
            						                
            						                $date_close='';
            						                
            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center[0]['exam_date'];
            						                }
            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center1[0]['exam_date'];
            						                }
            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
            						                    $date_close=$activate[0]['close_date'];
            						                }
            						              //  echo $date_close;
            						                $today=date('Y-m-d');
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						               // $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                //   echo $today.' '.$date_close;
                                                    // if ($date_close >= $today) {
                                            
                                            
                                            // echo $close_date;        
                                                    
                                            $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    
                                                    
                                            // print_r($cen);        
                                                    
                                            if(empty($cen->close_material_a) or $cen->close_material_a == 0){        
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id == '14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                                                        <!--<a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                        <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                        
                                                                        <?php
                                                                    // } else {
                                                                        // echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        
                                                    // }    else{
                                                            
                                                                 
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                        
                                            <?php  //  }  
                                                    }else{
                                                         
                                                        echo 'Material-A Purchase Close.';
                                                    } 
                                                    
                                            }else{
                                                         
                                                echo 'Material-A Purchase Close.';
                                            }      
                                                    
                                        } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                else{
                                ?>
                                    <?php 
                                    // print_r($material_paid_a->id);
                                    //if(!empty($material_paid_a)){ //echo $material_paid_a->folder;  
                                        //print_r($material_paid_a);
                                    ?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php print_r($material_paid_a->id); ?>' style='display:none;' >
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material A- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_a)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_a)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>    
                                                </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                
                                }
                            } 
                            
                            
                            ?>
                            
                            
                                
                            <!-- ======================== Material B ==================     -->
                             <?php
                             //echo 'ok';
                            if($activate[0]['study_material_b'] == 'study_material_b' and !empty($material_paid_b)) { 
                                //echo $study_material;
                                if($study_material_b=='Yes' && !empty($material_paid_b)){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material B - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_b_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_b_price']!='0'){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
						                
            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
            						                
            						                $date_close='';
            						                
            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center[0]['exam_date'];
            						                }
            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center1[0]['exam_date'];
            						                }
            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
            						                    $date_close=$activate[0]['close_date'];
            						                }
            						                
            						                
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                    $today = date("Y-m-d");
                                                    // if ($date_close >= $today) {
                                                 
                                            $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    
                                                if(empty($cen->close_material_b) or $cen->close_material_b == 0){  
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                        //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                                                                                                    <!--<a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                        //             } else {
                                                        //                 echo 'Purchase Closed';
                                                        //             }
                                                        // }           
                                                        // else{
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //}
                                                
                                                    }else{
                                                         
                                                        echo 'Material-B Purchase Close.';
                                                    } 
                                                    
                                                }else{
                                                         
                                                    echo 'Material-B Purchase Close.';
                                                } 
                                                    
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php  print_r($material_paid_b->id); ?>' style='display:none;' >
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material B- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_b)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_b)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                            }
                            ?>    
                                
                                
                            <!-- ======================== Material C ==================     -->
                             <?php
                             //echo 'ok';
                            if($activate[0]['study_material_c'] == 'study_material_c' and !empty($material_paid_c)) { 
                                //echo $study_material;
                                if($study_material_c=='Yes' && !empty($material_paid_c)){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material C - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_c_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_c_price']!='0'){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
						                
            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
            						                
            						                $date_close='';
            						                
            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center[0]['exam_date'];
            						                }
            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center1[0]['exam_date'];
            						                }
            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
            						                    $date_close=$activate[0]['close_date'];
            						                }
            						                $today = date("Y-m-d");
            						                
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                   
                                                    // if ($date_close >= $today) {
                                                    
                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    
                                            if(empty($cen->close_material_c) or $cen->close_material_c == 0){              
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                            <!--                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                            <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                                    // } else {
                                                                    //     echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        // else{
                                                        
                                                        
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //} 
                                                
                                                    }else{
                                                         
                                                        echo 'Material-C Purchase Close.';
                                                    }
                                                    
                                                }else{
                                                     
                                                    echo 'Material-C Purchase Close.';
                                                }    
                                                    
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php  print_r($material_paid_c->id); ?>' style='display:none;' >
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material C- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_c)){
                                                        echo 'Available';
                                                        
                                                    }else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_c)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                                    
                            }
                            ?>    
                              
                            
                            <!-- ======================== Material D ==================     -->
                            <?php
                             //echo 'ok';
                            if($activate[0]['study_material_d'] == 'study_material_d' and !empty($material_paid_d)) { 
                                //echo $study_material;
                                if($study_material_d=='Yes' && !empty($material_paid_d)){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material D - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_d_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_d_price']!='0'){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
						                
            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
            						                
            						                $date_close='';
            						                
            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center[0]['exam_date'];
            						                }
            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center1[0]['exam_date'];
            						                }
            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
            						                    $date_close=$activate[0]['close_date'];
            						                }
            						                $today = date("Y-m-d");
            						                
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                   
                                                    // if ($date_close >= $today) {
                                                    
                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    
                                            if(empty($cen->close_material_d) or $cen->close_material_d == 0){              
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                            <!--                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                            <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                                    // } else {
                                                                    //     echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        // else{
                                                        
                                                        
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_d_price'].'+'.'Material D';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_d_price'].'+'.'Material D';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //} 
                                                
                                                    }else{
                                                         
                                                        echo 'Material-D Purchase Close.';
                                                    }
                                                    
                                                }else{
                                                     
                                                    echo 'Material-D Purchase Close.';
                                                }    
                                                    
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php  print_r($material_paid_d->id); ?>' style='display:none;' >
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material D- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_d)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_d)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                                
                            }
                            ?>    
                                
                             
                            <!-- ======================== Material E ==================     -->
                            <?php
                             //echo 'ok';
                            if($activate[0]['study_material_e'] == 'study_material_e' and !empty($material_paid_e)) { 
                                //echo $study_material;
                                if($study_material_e == 'Yes' && !empty($material_paid_e)){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material E - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_e_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_e_price']!='0'){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
						                
            						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
            						                
            						                $date_close='';
            						                
            						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center[0]['exam_date'];
            						                }
            						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
            						                    $date_close=$center1[0]['exam_date'];
            						                }
            						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
            						                    $date_close=$activate[0]['close_date'];
            						                }
            						                $today = date("Y-m-d");
            						                
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                   
                                                    // if ($date_close >= $today) {
                                                    
                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                    
                                            if(empty($cen->close_material_e) or $cen->close_material_e == 0){              
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                            <!--                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                            <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                                    // } else {
                                                                    //     echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        // else{
                                                        
                                                        
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_e_price'].'+'.'Material E';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_e_price'].'+'.'Material E';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //} 
                                                
                                                    }else{
                                                         
                                                        echo 'Material-E Purchase Close.';
                                                    }
                                                    
                                                }else{
                                                     
                                                    echo 'Material-E Purchase Close.';
                                                }    
                                                    
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php print_r($material_paid_e->id); ?>' style='display:none;' >
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material E- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_e)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_e)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                            }
                            ?>    
                                  
                            
                            
                            <!-- ======================== Material F ==================     -->
                            <?php
                             //echo 'ok';
                                if($activate[0]['study_material_f'] == 'study_material_f' and !empty($material_paid_f)) { 
                                    //echo $study_material;
                                    if($study_material_f == 'Yes' && !empty($material_paid_f)){
                                    ?>
                                
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Study Material F - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_f_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer">
                                                <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                $this->db->select('*');
                                                $this->db->from('amount_cart');
                                                $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
    
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                                $res= $query->result_array();
                                                //print_r($res);
                                                if( $activate[0]['study_material_f_price']!='0'){
                                                    $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
    						                
                						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                						                
                						                $date_close='';
                						                
                						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center[0]['exam_date'];
                						                }
                						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center1[0]['exam_date'];
                						                }
                						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                						                    $date_close=$activate[0]['close_date'];
                						                }
                						                $today = date("Y-m-d");
                						                
                						              //  if(!empty($date_close)){
                						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                						              //  }
                						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                       
                                                        // if ($date_close >= $today) {
                                                        
                                            $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        
                                                if(empty($cen->close_material_f) or $cen->close_material_f == 0){              
                                                        
                                                        if ($close_date >= $today) {
                                                            
                                                            // if($state_id =='14686'){
                                                                
                                                                        // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                            ?>
                                                <!--                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                            <?php
                                                                        // } else {
                                                                        //     echo 'Purchase Closed';
                                                                        // }
                                                            // }           
                                                            // else{
                                                            
                                                            
                                                ?>
                                                <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_f_price'].'+'.'Material F';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_f_price'].'+'.'Material F';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <?php //} 
                                                    
                                                        }else{
                                                             
                                                            echo 'Material-F Purchase Close.';
                                                        }
                                                        
                                                    }else{
                                                         
                                                        echo 'Material-F Purchase Close.';
                                                    }    
                                                        
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }else{ //echo 'pk';
                                    
                                    
                                    // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                      
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new_down">
                                                        
                                                        <input type='text' name='mat_id' value='<?php echo  print_r($material_paid_f->id); ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo 'Study Material F- Paid'; ?></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($material_paid_f)){
                                                        echo 'Available';}else{
                                                            echo 'Available Soon.';
                                                        }
                                                        
                                                        ?></a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                            <a href="#" class="btn btn-warning btn-sm my-1">Paid Material F</a>
                                                         <?php   if(!empty($material_paid_f)){
                                                        ?>
                                                           <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                        <?php } ?>  
                                                        </div>
                                                      </form>
                                                </div>
                                            </div>
                                          
                                        <?php //} 
                                        
                                        }
                                }
                            ?>    
                             
                                
                        </div>
                          
                        </div>
                        
                        
                        
                        <!-- ======================= Orientation    ======================== -->  
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class='row'>
                                   <!--// =========== orientation A ============== //-->
                                <?php
                                // print_r($activate[0]);
                                
                                if($activate[0]['orientation_a'] == 'orientation_a'){ 
                                    // echo 'ok'; 
                                if($orientation_a=='Yes'){
                                    // echo 'ok';
                                    
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training A - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_a_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-3">
                                                <?php    
                                                $this->db->select('orientation_a_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                // echo $this->db->last_query();
                                                $res= $query->row_array();
                                               // echo $activate[0]['id'].'---';
                                                $orientation_a_date = $res['orientation_a_date'];
                                                
                                                
                                                if(!empty($res['orientation_a_date'])){
                                                    if($orientation_a_date!='0000-00-00' or $orientation_a_date!=''){
                                                    // echo $orientation_a_date.'koo';
                                                    $oa='check';
                                                    }else{
                                                         $stoa='open';
                                                    }
                                                }else{
                                                        $stoa='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($oa=='check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_a_date = new DateTime($orientation_a_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_a_date < $current_date_obj) {
                                                            $stoa='open';
                                                        } else {
                                                            $stoa='close';
                                                        }
                                                    }else{
                                                        $stoa='open';
                                                    }
                                                    
                                            
                                                if( $activate[0]['orientation_a_price']!='0' or $activate[0]['orientation_a_price'] != NULL){
                                                    
                                                    if($stoa=='open'){
                                                        
                                                        $resort = $this->db->get_where('amount_cart', array('cin' => $student['cin'], 'title' => 'Orientation A','amount'=>$activate[0]['orientation_a_price']))->row();
                                
                                                        // echo $this->db->last_query();
                                                        // print_r($resort);
                                                        $study_material_a= strtoupper($study_material_a);
                                                        if(!empty($resort) or $study_material_a != 'YES'){    
                                                    
                                                          //   echo $study_material_a;
                                                          //      $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
        						                
                    						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                    						                
                    						              //  $date_close='';
                    						                
                    						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                    						              //      $date_close=$center[0]['exam_date'];
                    						              //  }
                    						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                    						              //      $date_close=$center1[0]['exam_date'];
                    						              //  }
                    						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                    						              //      $date_close=$activate[0]['close_date'];
                    						              //  }
                    						              //  $today=date('Y-m-d');
                    						                
                    						              //  if(!empty($date_close)){
                    						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                    						              //  }
                    						              
                    						              //echo $date_seven_days_formatted.' '.$today;
                    						              
                            						        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                            // print_r($cen);   
                                                            
                                                                
                                                            if(empty($cen->close_orientation_a) or $cen->close_orientation_a == 0){  
                                                                    if(!empty($date_close)){
                            						                    $threeDaysBefore = date("Y-m-d", strtotime($close_date. " -7 days"));
                                                                    }else{
                                                                        $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                                    }
                                                                    $today = date("Y-m-d");
                                                                    
                                                                    // echo $threeDaysBefore;
                                                                    // echo $date_seven_days_formatted;
                                                                    
                                                                    // if ($date_seven_days_formatted > $today) {
                                                                    // if($today < $date_seven_days_formatted){
                                                                        
                                                                        if($one_days_before >= $today){
                                                                        
                                                                    // echo 'ok';
                                                                                // if($state_id =='14686'){
                                                                            
                                                                                //     if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                        ?>
                                                                                         <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                        <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                   
                                                                                        <?php
                                                                        //             } else {
                                                                        //                 echo 'Purchase Closed';
                                                                        //             }
                                                                        // }           
                                                                        // else{
                                                                        
                                                                // if($activate[0]['id']!=230){  
                                                                
                                                                // if(!$state_id =='14686'){
                                                            ?>  
                                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php 
                                                                // }else{
                                                                //         echo 'Orientation is over.';   
                                                                //     }
                                                            
                                                                     //   }
                                                                    }else{
                                                                        echo 'Training is over.';   
                                                                    }
                                                            }else{
                                                                echo 'Training is over.';   
                                                            }
                                                    
                                                        }else{  
                                                        ?>
                                                           <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-A for Training(Orientation)-A.'
                                                        <?php
                                                        }
                                                
                                                    }else{
                                                        echo 'Training is over.';
                                                    }
                                                } ?>
                                    </div>
                                </div>
                            </div>
                       
                       
                       <?php } else { ?>
                       
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
        
                                <div class="card my-2 mx-2 p-1 w-100">
                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                        <input type='text' name='type' value='<?php echo "A"; ?>' style='display:none;' >
                                    <div class="card-body">
                                        <h5 class="card-title">Training A Slip</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                        
                                    </div>
                                    <div class="card-footer p-1">
                                        <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                       <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " ><i class="fa-solid fa-download"></i></button>
                                    </div>
                                     </form>
                                </div>
                                 
                            </div>
                       
                       <?php } } ?>
                       
                               <!-- ================ orientation B ==================== -->
                               <?php
                                if($activate[0]['orientation_b'] == 'orientation_b'){ 
                                    if($orientation_b=='Yes'){
                                        
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training B - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_b_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                               $this->db->select('orientation_b_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                               // echo $activate[0]['id'];
                                                $res= $query->row_array();
                                                $orientation_b_date = $res['orientation_b_date'];
                                                if($orientation_b_date!='0000-00-00'){
                                                    $ob='check';
                                                }    
                                                    if(!empty($res['orientation_b_date'])){
                                                    if($orientation_b_date!='0000-00-00' or $orientation_b_date!=''){
                                                    // echo $orientation_a_date.'koo';
                                                    $oa='check';
                                                    }else{
                                                         $stoa='open';
                                                    }
                                                }else{
                                                        $stoa='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($oa=='check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_b_date = new DateTime($orientation_b_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_b_date < $current_date_obj) {
                                                            $stob='open';
                                                        } else {
                                                            $stob='close';
                                                        }
                                                    }else{
                                                        $stob='open';
                                                    }
                                                    
                                                if( $activate[0]['orientation_b_price']!='0'){
                                                    if($stob=='open'){
                                                    $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Orientation B','amount'=>$activate[0]['orientation_b_price']))->row();
                            
                                                    $study_material_b = strtoupper($study_material_b);
                                                    // echo $study_material_b;
                                                    if(!empty($resort) or $study_material_b != 'YES'){ 
                                            //                     $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						                
                        						              //  $date_close='';
                        						                
                        						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center1[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						              //      $date_close=$activate[0]['close_date'];
                        						              //  }
                        						                
                        						                
                        						              //  if(!empty($date_close)){
                        						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                        						              //  }
                        						                $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -3 days"));
                                                                 $today = date("Y-m-d");
                                                                 //echo $date_close;die;
                                                                // if ($threeDaysBefore > $today) {
                                                                
                                                                
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                        if(empty($cen->close_orientation_b) or $cen->close_orientation_b == 0){          
                                                                
                                                                // if($today < $date_seven_days_formatted){
                                                                if($one_days_before >= $today){
                                                                // if($date_seven_days > $today){
                                                                    //  if($state_id =='14686'){
                                                                        
                                                                    //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                    ?>
                                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                                    <?php
                                                                    //             } else {
                                                                    //                 echo 'Purchase Closed';
                                                                    //             }
                                                                    // }           
                                                                    // else{
                                                        // if($activate[0]['id']!=230){  
                                                        // if(!$state_id =='14686'){
                                                ?> 
                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                
                                                <?php 
                                                        // }else{
                                                        //     echo 'Orientation is over.';
                                                        // }
                                                
                                                       //   }
                                                                } else{
                                                                    echo 'Training is over.';
                                                                    
                                                                }
                                                                
                                                        } else{
                                                            echo 'Training is over.';
                                                            
                                                        }
                                                        
                                                        
                                                        
                                                        
                                                        
                                                                }else{  
                                                        ?>
                                                       <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-B for Training(Orientation)-B.'
                                                        <?php
                                                    }   } else{
                                                        echo 'Orientation is over.';
                                                } }?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } else { ?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                <input type='text' name='type' value='<?php echo "B"; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Training B Slip</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Training</a>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                               <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " ><i class="fa-solid fa-download"></i></button>
                                            </div>
                                             </form>
                                        </div>
                                         
                                    </div>
                               
                               <?php } } ?>
                               
                               
                               <!-- =================== orientation C ======================== -->
                               <?php
                                if($activate[0]['orientation_c']=='orientation_c'){ //echo 'ok'; 
                                if($orientation_c=='Yes'){
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training C - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_c_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                               $this->db->select('orientation_c_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                                $res= $query->row_array();
                                                $orientation_c_date = $res['orientation_c_date'];
                                                if($orientation_c_date!='0000-00-00'){
                                                    $ob='check';
                                                }    
                                                    if(!empty($res['orientation_c_date'])){
                                                    if($orientation_c_date!='0000-00-00' or $orientation_c_date!=''){
                                                    // echo $orientation_a_date.'koo';
                                                    $oc='check';
                                                    }else{
                                                         $stoc='open';
                                                    }
                                                }else{
                                                        $stoc='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($oc=='check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_c_date = new DateTime($orientation_c_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_c_date < $current_date_obj) {
                                                            $stoc='open';
                                                        } else {
                                                            $stoc='close';
                                                        }
                                                    }else{
                                                        $stoc='open';
                                                    }
                                                    
                                                if( $activate[0]['orientation_c_price'] != '0'){
                                                    if($stoc=='open'){
                                                    $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Orientation C','amount'=>$activate[0]['orientation_c_price']))->row();
                            
                                                    $study_material_c = strtoupper($study_material_c);
                            
                                                    if(!empty($resort) or $study_material_c != 'YES'){ 
                                            //                     $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						                
                        						              //  $date_close='';
                        						                
                        						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center1[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						              //      $date_close=$activate[0]['close_date'];
                        						              //  }
                        						                
                        						                
                        						              //  if(!empty($date_close)){
                        						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                        						              //  }
                        						                $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -3 days"));
                                                                $today = date("Y-m-d");
                                                                
                                                                
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                        if(empty($cen->close_orientation_c) or $cen->close_orientation_c == 0){          
                                                          
                                                                    
                                                    
                                                                // if($today < $date_seven_days_formatted){
                                                               if($one_days_before >= $today) {
                                                                // if($date_seven_days > $today){
                                                                    
                                                                    //  if($state_id =='14686'){
                                                                        
                                                                    //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                    ?>
                                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                                    <?php
                                                                    //             } else {
                                                                    //                 echo 'Purchase Closed';
                                                                    //             }
                                                                    // }           
                                                                    // else{
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                
                                                                <?php //}
                                                                }else{
                                                                echo 'Training is over.';
                                                                }         
                                                                    
                                                        }else{
                                                            echo 'Training is over.';
                                                        }
                                                                    
                                                                }else{  
                                                        ?>
                                                       <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-C for Training(Orientation)-C.'
                                                        <?php
                                                    }   }else{
                                                        echo 'Training is over.';
                                                } } ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } else { ?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                <input type='text' name='type' value='<?php echo "C"; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Training C Slip</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Training C</a>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                               <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " <i class="fa-solid fa-download"></i></button>
                                            </div>
                                             </form>
                                        </div>
                                         
                                    </div>
                               
                               <?php } } ?>
                               
                               
                               <!-- =================== orientation D ======================== -->
                               <?php
                                if($activate[0]['orientation_d'] == 'orientation_d'){ //echo 'ok'; 
                                
                                
                                    if($orientation_d == 'Yes'){
                                        
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training D - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_d_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                                
                                                $this->db->select('orientation_d_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                                $res= $query->row_array();
                                                $orientation_d_date = $res['orientation_d_date'];
                                                
                                                if($orientation_d_date != '0000-00-00' or empty($orientation_d_date)){
                                                    $od='check';
                                                }    
                                                    if(!empty($res['orientation_d_date'])){
                                                        if($orientation_d_date!='0000-00-00' or empty($orientation_d_date)){
                                                        // echo $orientation_a_date.'koo';
                                                        $od ='check';
                                                        }else{
                                                             $stod='open';
                                                        }
                                                    }else{
                                                        $stod='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($od == 'check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_d_date = new DateTime($orientation_d_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_d_date < $current_date_obj) {
                                                            $stod='open';
                                                        } else {
                                                            $stod='close';
                                                        }
                                                    }else{
                                                        $stod='open';
                                                    }
                                                    
                                                if( $activate[0]['orientation_d_price'] != '0'){
                                                   
                                                    
                                                    if($stod =='open'){
                                                        $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Orienatation D','amount'=>$activate[0]['orientation_d_price']))->row();
                                
                                                        $study_material_d = strtoupper($study_material_d);
                                                        
                                                        // echo $study_material_d;
                                        
                                                        if(!empty($resort) or $study_material_d != 'YES'){ 
                                            //                     $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						                
                        						              //  $date_close='';
                        						                
                        						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center1[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						              //      $date_close=$activate[0]['close_date'];
                        						              //  }
                        						                
                        						                
                        						              //  if(!empty($date_close)){
                        						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                        						              //  }
                        						                $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -3 days"));
                                                                $today = date("Y-m-d");
                                                                
                                                                
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                        if(empty($cen->close_orientation_d) or $cen->close_orientation_d == 0){          
                                                          
                                                                    
                                                    
                                                                // if($today < $date_seven_days_formatted){
                                                               if($one_days_before >= $today) {
                                                                // if($date_seven_days > $today){
                                                                    
                                                                    //  if($state_id =='14686'){
                                                                        
                                                                    //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                    ?>
                                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                                    <?php
                                                                    //             } else {
                                                                    //                 echo 'Purchase Closed';
                                                                    //             }
                                                                    // }           
                                                                    // else{
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_d_price'].'+Orientation D';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_d_price'].'+Orientation D';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                
                                                                <?php //}
                                                                }else{
                                                                echo 'Training is over.';
                                                                }         
                                                                    
                                                        }else{
                                                            echo 'Training is over.';
                                                        }
                                                                    
                                                                }else{  
                                                        ?>
                                                            <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-D for Training(Orientation)-D.'
                                                        <?php
                                                        }   
                                                        
                                                    }else{
                                                        echo 'Training is over.';
                                                    } 
                                                    
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } else { ?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                <input type='text' name='type' value='<?php echo "D"; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Training D Slip</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Training D</a>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                               <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " <i class="fa-solid fa-download"></i></button>
                                            </div>
                                             </form>
                                        </div>
                                         
                                    </div>
                               
                                   <?php } 
                                   
                                } ?>
                               
                               
                                <!-- =================== orientation E ======================== -->
                               <?php
                                if($activate[0]['orientation_e']=='orientation_e'){ //echo 'ok'; 
                                
                                
                                    if($orientation_e == 'Yes'){
                                        
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training E - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_e_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                                
                                                $this->db->select('orientation_e_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                                $res= $query->row_array();
                                                $orientation_e_date = $res['orientation_e_date'];
                                                
                                                if($orientation_e_date != '0000-00-00' or empty($orientation_e_date)){
                                                    $oe='check';
                                                }    
                                                    if(!empty($res['orientation_e_date'])){
                                                        if($orientation_e_date!='0000-00-00' or empty($orientation_e_date)){
                                                        // echo $orientation_a_date.'koo';
                                                        $oe ='check';
                                                        }else{
                                                             $stoe ='open';
                                                        }
                                                    }else{
                                                        $stoe ='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($oe == 'check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_e_date = new DateTime($orientation_e_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_e_date < $current_date_obj) {
                                                            $stoe ='open';
                                                        } else {
                                                            $stoe ='close';
                                                        }
                                                    }else{
                                                        $stoe ='open';
                                                    }
                                                    
                                                if( $activate[0]['orientation_e_price'] != '0'){
                                                   
                                                    
                                                    if($stoe =='open'){
                                                        $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Orientation E','amount'=>$activate[0]['orientation_e_price']))->row();
                                
                                                        $study_material_e = strtoupper($study_material_e);
                                                        
                                                        if(!empty($resort) or $study_material_e != 'YES'){ 
                                            //                     $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						                
                        						              //  $date_close='';
                        						                
                        						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center1[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						              //      $date_close=$activate[0]['close_date'];
                        						              //  }
                        						                
                        						                
                        						              //  if(!empty($date_close)){
                        						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                        						              //  }
                        						                $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -3 days"));
                                                                $today = date("Y-m-d");
                                                                
                                                                
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                        if(empty($cen->close_orientation_e) or $cen->close_orientation_e == 0){          
                                                          
                                                                    
                                                    
                                                                // if($today < $date_seven_days_formatted){
                                                               if($one_days_before >= $today) {
                                                                // if($date_seven_days > $today){
                                                                    
                                                                    //  if($state_id =='14686'){
                                                                        
                                                                    //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                    ?>
                                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                                    <?php
                                                                    //             } else {
                                                                    //                 echo 'Purchase Closed';
                                                                    //             }
                                                                    // }           
                                                                    // else{
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_e_price'].'+Orientation E';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_e_price'].'+Orientation E';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                
                                                                <?php //}
                                                                }else{
                                                                    echo 'Training is over.';
                                                                }         
                                                                    
                                                        }else{
                                                            echo 'Training is over.';
                                                        }
                                                                    
                                                                }else{  
                                                        ?>
                                                            <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-E for Training(Orientation)-E.'
                                                        <?php
                                                        }   
                                                        
                                                    }else{
                                                        echo 'Training is over.';
                                                    } 
                                                    
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } else { ?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                <input type='text' name='type' value='<?php echo "E"; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Training E Slip</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Training E</a>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                               <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " <i class="fa-solid fa-download"></i></button>
                                            </div>
                                             </form>
                                        </div>
                                         
                                    </div>
                               
                                   <?php } 
                                   
                                } ?>
                               
                               
                               <!-- =================== orientation F ======================== -->
                               <?php
                                if($activate[0]['orientation_f']=='orientation_f'){ //echo 'ok'; 
                                
                                
                                    if($orientation_f == 'Yes'){
                                        
                                    ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Training F - Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_f_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                                
                                                $this->db->select('orientation_f_date');
                                                $this->db->from('closing_competition_details');
                                                $this->db->where("competition_id",$activate[0]['id']);
                                                $query = $this->db->get();
                                                //echo $this->db->last_query();
                                                $res= $query->row_array();
                                                $orientation_f_date = $res['orientation_f_date'];
                                                
                                                if($orientation_f_date != '0000-00-00' or empty($orientation_f_date)){
                                                    $oe='check';
                                                }    
                                                    if(!empty($res['orientation_f_date'])){
                                                        if($orientation_f_date != '0000-00-00' or empty($orientation_f_date)){
                                                        // echo $orientation_a_date.'koo';
                                                        $of ='check';
                                                        }else{
                                                             $stof ='open';
                                                        }
                                                    }else{
                                                        $stof ='open';
                                                    }  
                                                
                                                // echo $oa.'ok'.$stoa;
                                                    if($of == 'check'){
                                                    $current_date = date("Y-m-d");
                                                    
                                                    $orientation_f_date = new DateTime($orientation_f_date);
                                                    $current_date_obj = new DateTime($current_date);
                                                    
                                                        if ($orientation_f_date < $current_date_obj) {
                                                            $stof ='open';
                                                        } else {
                                                            $stof ='close';
                                                        }
                                                    }else{
                                                        $stof ='open';
                                                    }
                                                    
                                                if( $activate[0]['orientation_f_price'] != '0'){
                                                   
                                                    
                                                    if($stof =='open'){
                                                        $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Orientation F','amount'=>$activate[0]['orientation_f_price']))->row();
                                
                                                        $study_material_f = strtoupper($study_material_f);
                                                        
                                                        if(!empty($resort) or $study_material_f != 'YES'){ 
                                            //                     $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						              //  $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						                
                        						              //  $date_close='';
                        						                
                        						              //  if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						              //      $date_close=$center1[0]['exam_date'];
                        						              //  }
                        						              //  if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						              //      $date_close=$activate[0]['close_date'];
                        						              //  }
                        						                
                        						                
                        						              //  if(!empty($date_close)){
                        						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                        						              //  }
                        						                $threeDaysBefore = date("Y-m-d", strtotime($date_close . " -3 days"));
                                                                $today = date("Y-m-d");
                                                                
                                                                
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                                
                                                        if(empty($cen->close_orientation_f) or $cen->close_orientation_f == 0){          
                                                          
                                                                    
                                                    
                                                                // if($today < $date_seven_days_formatted){
                                                               if($one_days_before >= $today) {
                                                                // if($date_seven_days > $today){
                                                                    
                                                                    //  if($state_id =='14686'){
                                                                        
                                                                    //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                    ?>
                                                                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                                
                                                                                    <?php
                                                                    //             } else {
                                                                    //                 echo 'Purchase Closed';
                                                                    //             }
                                                                    // }           
                                                                    // else{
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_f_price'].'+Orientation F';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_f_price'].'+Orientation F';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                
                                                                <?php //}
                                                                }else{
                                                                echo 'Training is over.';
                                                                }         
                                                                    
                                                        }else{
                                                            echo 'Training is over.';
                                                        }
                                                                    
                                                                }else{  
                                                        ?>
                                                            <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-F for Training(Orientation)-F.'
                                                        <?php
                                                        }   
                                                        
                                                    }else{
                                                        echo 'Training is over.';
                                                    } 
                                                    
                                                } 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } else { ?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>Cin_login/orientation_new">
                                                <input type='text' name='type' value='<?php echo "F"; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Training F Slip</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Training F</a>
                                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                               <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " <i class="fa-solid fa-download"></i></button>
                                            </div>
                                             </form>
                                        </div>
                                         
                                    </div>
                               
                                   <?php } 
                                   
                                } ?>
                               
                               
                       </div>
                   
                        </div>
                   
                   
                   
                        <!-- ======================== Mock Test      ======================== -->
                        <div class="tab-pane fade" id="nav-mock" role="tabpanel" aria-labelledby="nav-mock-tab">
                            <div class='row'>
                                
                                <!-- ======================= Mock Test A ======================== -->
                                <?php
                                
                                // echo $activate[0]['mock_test_a'];
                                // echo $activate[0]['mock_test'];
                                
                                // print_r($activate[0]['mock_test_a']);
                                // echo $_SESSION['exam_id'];
                                // print_r($mock_av);
                                
                                
                                if($activate[0]['mock_test'] == 'mock_test' or $activate[0]['mock_test_a'] == 'mock_test_a' and !empty($mock_av)){ 
                                     
                                    //  echo 'ok';echo $mock_test_a;
                                    if($mock_test_a == 'Yes' ){
                                        // echo 'okkss';
                                    ?>
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            <div class="card my-2 mx-2 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Mock Test -A Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_a_price']; ?></a>
                                                    
                                                </div>
                                        
                                        
                                        
                                       
                                        <div class="card-footer p-3">
                                            <?php    
                                            
                                            $this->db->select('mocktest_a_date');
                                            $this->db->from('closing_competition_details');
                                            $this->db->where("competition_id",$activate[0]['id']);
                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->row_array();
                                            $mocktest_a_date = $res['mocktest_a_date'];
                                            
                                            if($mocktest_a_date != '0000-00-00' or empty($mocktest_a_date)){
                                                $oa='check';
                                            }    
                                                if($oa=='check'){
                                                $current_date = date("Y-m-d");
                                                
                                                $mocktest_a_date = new DateTime($mocktest_a_date);
                                                $current_date_obj = new DateTime($current_date);
                                                
                                                    if ($mocktest_a_date > $current_date_obj) {
                                                        $stoa='open';
                                                    } else {
                                                        $stoa='close';
                                                    }
                                                }else{
                                                    $stoa='open';
                                                }
                                            
                                           // echo $stoa;
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                           $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
        
                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            
                                            if( $activate[0]['mock_test_a_price']!='0'){
                                                
                                                
                                                // if($stoa=='open'){
                                                    // echo 'okk';
                                                    $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
        						                
                    						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                    						                
                    						                $date_close='';
                    						                
                    						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                    						                    $date_close=$center[0]['exam_date'];
                    						                }
                    						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                    						                    $date_close=$center1[0]['exam_date'];
                    						                }
                    						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                    						                    $date_close=$activate[0]['close_date'];
                    						                }
                    						                
                    						                
                    						              //  if(!empty($date_close)){
                    						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                    						              //  }
                    						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                             $today = date("Y-m-d");
                                                             
                                                             
                                                            $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                            
                                                            if(empty($cen->close_mock_a) or $cen->close_mock_a == 0){          
                                                      
                                                             
                                                                //  echo $one_days_before;
                                                                // if ($oneDaysBefore > $today) {
                                                                if($one_days_before >= $today){
                                                                // echo 'ok';
                                                                //  if($state_id =='14686'){
                                                                    
                                                                            // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                ?>
                                                                                <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_price'].'+MockTest';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_price'].'+MockTest';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                          
                                                                                <?php
                                                                            // } else {
                                                                            //     echo 'Purchase Closed';
                                                                            // }
                                                                // }  
                                                                
                                                                // else
                                                                
                                                                if ($close_date >= $today) {
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest A';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                <?php 
                                                                                    }    
                                                                                }
                                                                    else{
                                                                    echo 'Mock Closed.';
                                                                }
                                                            }else{
                                                                echo 'Mock Closed.';
                                                            }
                                            }
                                            ?>
                                        </div>
                                        
                                    </div>
                                </div>
                           
                           
                                    <?php } else { //print_r($mock_av);?>
                           
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                
                                            <input type='text' name='paper_id' value='<?php echo $mock_av->paper_id; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Mock Test A Paid</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php 
                                                if(!empty($mock_av)){
                                                    echo 'Available';
                                                    
                                                }else{
                                                echo 'The Mock Test can be downloaded by evening today.'; } 
                                                ?>
                                                </a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                            <a href="#" class="btn btn-warning btn-sm my-1">Mock Test A</a>
                                            <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                            <?php 
                                            if(!empty($mock_av)){ 
                                            ?>
                                           <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                           
                                           <?php } else { ?>
                                           
                                           <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                       
                                           <?php }
                                           ?>
                                        </div>
                                         </form>
                                    </div>
                                     
                                </div>
                                    
                                        <?php if(!empty($mock_av_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_av_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test A Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_av_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test A</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_av_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>    
                                        
                                    <?php } 
                                    
                                }
                                ?>
                       
                       
                                <!-- ======================= Mock Test B ======================== -->
                                <?php
                                if($activate[0]['mock_test_b']=='mock_test_b' && !empty($mock_bv)){ 
                                     
                                    if($mock_test_b == 'Yes' ){
                                        // echo 'okk';
                                    ?>
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            <div class="card my-2 mx-2 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Mock Test -B Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_b_price']; ?></a>
                                                    
                                                </div>
                                        
                                        
                                        
                                       
                                        <div class="card-footer p-3">
                                            <?php    
                                            
                                            $this->db->select('mocktest_b_date');
                                            $this->db->from('closing_competition_details');
                                            $this->db->where("competition_id",$activate[0]['id']);
                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->row_array();
                                            $mocktest_b_date = $res['mocktest_b_date'];
                                            
                                            if($mocktest_b_date != '0000-00-00' or empty($mocktest_b_date)){
                                                $ob ='check';
                                            }    
                                                if($ob =='check'){
                                                $current_date = date("Y-m-d");
                                                
                                                $mocktest_b_date = new DateTime($mocktest_b_date);
                                                $current_date_obj = new DateTime($current_date);
                                                
                                                    if ($mocktest_b_date > $current_date_obj) {
                                                        $stob ='open';
                                                    } else {
                                                        $stob ='close';
                                                    }
                                                }else{
                                                    $stob ='open';
                                                }
                                            
                                           // echo $stoa;
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                           $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
        
                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            
                                            if( $activate[0]['mock_test_b_price']!='0'){
                                                
                                                
                                                // if($stoa=='open'){
                                                    // echo 'okk';
                                                    $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
        						                
                    						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                    						                
                    						                $date_close='';
                    						                
                    						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                    						                    $date_close=$center[0]['exam_date'];
                    						                }
                    						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                    						                    $date_close=$center1[0]['exam_date'];
                    						                }
                    						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                    						                    $date_close=$activate[0]['close_date'];
                    						                }
                    						                
                    						                
                    						              //  if(!empty($date_close)){
                    						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                    						              //  }
                    						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                             $today = date("Y-m-d");
                                                             
                                                             
                                                            $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                            
                                                            if(empty($cen->close_mock_b) or $cen->close_mock_b == 0){          
                                                      
                                                             
                                                                //  echo $one_days_before;
                                                                // if ($oneDaysBefore > $today) {
                                                                if($one_days_before >= $today){
                                                                // echo 'ok';
                                                                //  if($state_id =='14686'){
                                                                    
                                                                            // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                                ?>
                                                                                <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                          
                                                                                <?php
                                                                            // } else {
                                                                            //     echo 'Purchase Closed';
                                                                            // }
                                                                // }  
                                                                
                                                                // else
                                                                
                                                                if ($close_date >= $today) {
                                                                ?>  
                                                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_b_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_b_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                <?php 
                                                                                    }    
                                                                                }
                                                                    else{
                                                                    echo 'Mock Closed.';
                                                                }
                                                            }else{
                                                                echo 'Mock Closed.';
                                                            }
                                            }
                                            ?>
                                        </div>
                                        
                                    </div>
                                </div>
                           
                           
                                    <?php } else { //print_r($mock_av);?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                            
                                                <input type='text' name='paper_id' value='<?php echo $mock_bv->paper_id; ?>' style='display:none;' >
                                        <div class="card-body">
                                            <h5 class="card-title">Mock Test B Paid</h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link"><?php 
                                            if(!empty($mock_bv)){
                                                echo 'Available';
                                                
                                            }else{
                                            echo 'The Mock Test can be downloaded by evening today.'; } 
                                            ?>
                                            </a>
                                            
                                        </div>
                                        <div class="card-footer p-1">
                                            <a href="#" class="btn btn-warning btn-sm my-1">Mock Test B</a>
                                            <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                            <?php 
                                            if(!empty($mock_bv)){ 
                                            ?>
                                           <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                           
                                           <?php } else { ?>
                                           
                                           <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                       
                                           <?php }
                                           ?>
                                        </div>
                                     </form>
                                </div>
                                 
                            </div>
                       
                                    <?php if(!empty($mock_bv_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_bv_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test B Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_bv_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test B</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_bv_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>  
                                    
                                <?php } 
                                    
                                } 
                                ?>
                       
                                
                                <!-- ======================= Mock Test C ======================== -->
                                <?php
                                if($activate[0]['mock_test_c']=='mock_test_c' and !empty($mock_cv)){ 
                                     
                                    if($mock_test_c == 'Yes'){
                                    // echo 'okk';
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Mock Test -C Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_c_price']; ?></a>
                                                
                                            </div>
                                    
                                    
                                    
                                   
                                    <div class="card-footer p-3">
                                        <?php    
                                        
                                        $this->db->select('mocktest_c_date');
                                        $this->db->from('closing_competition_details');
                                        $this->db->where("competition_id",$activate[0]['id']);
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->row_array();
                                        $mocktest_c_date = $res['mocktest_c_date'];
                                        
                                        if($mocktest_c_date != '0000-00-00' or empty($mocktest_c_date)){
                                            $oc ='check';
                                        }    
                                            if($oc =='check'){
                                            $current_date = date("Y-m-d");
                                            
                                            $mocktest_c_date = new DateTime($mocktest_c_date);
                                            $current_date_obj = new DateTime($current_date);
                                            
                                                if ($mocktest_c_date > $current_date_obj) {
                                                    $stoc ='open';
                                                } else {
                                                    $stoc ='close';
                                                }
                                            }else{
                                                $stoc ='open';
                                            }
                                        
                                       // echo $stoa;
                                       // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                        $this->db->select('*');
                                        $this->db->from('amount_cart');
                                       $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
    
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->result_array();
                                        //print_r($res);
                                        
                                        if( $activate[0]['mock_test_c_price']!='0'){
                                            
                                            
                                            // if($stoa=='open'){
                                                // echo 'okk';
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
    						                
                						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                						                
                						                $date_close='';
                						                
                						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center[0]['exam_date'];
                						                }
                						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center1[0]['exam_date'];
                						                }
                						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                						                    $date_close=$activate[0]['close_date'];
                						                }
                						                
                						                
                						              //  if(!empty($date_close)){
                						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                						              //  }
                						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                         $today = date("Y-m-d");
                                                         
                                                         
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        
                                                        if(empty($cen->close_mock_c) or $cen->close_mock_c == 0){          
                                                  
                                                         
                                                            //  echo $one_days_before;
                                                            // if ($oneDaysBefore > $today) {
                                                            if($one_days_before >= $today){
                                                            // echo 'ok';
                                                            //  if($state_id =='14686'){
                                                                
                                                                        // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                            ?>
                                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                            <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                      
                                                                            <?php
                                                                        // } else {
                                                                        //     echo 'Purchase Closed';
                                                                        // }
                                                            // }  
                                                            
                                                            // else
                                                            
                                                            if ($close_date >= $today) {
                                                            ?>  
                                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_c_price'].'+MockTest C';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_c_price'].'+MockTest C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php 
                                                                                }    
                                                                            }
                                                                else{
                                                                echo 'Mock Closed.';
                                                            }
                                                        }else{
                                                            echo 'Mock Closed.';
                                                        }
                                        }
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                       
                       
                       <?php } else { //print_r($mock_av);?>
                       
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                            
                                                            <input type='text' name='paper_id' value='<?php echo $mock_cv->paper_id; ?>' style='display:none;' >
                                        <div class="card-body">
                                            <h5 class="card-title">Mock Test C Paid</h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link"><?php 
                                            if(!empty($mock_cv)){
                                                echo 'Available';
                                                
                                            }else{
                                            echo 'The Mock Test can be downloaded by evening today.'; } 
                                            ?>
                                            </a>
                                            
                                        </div>
                                        <div class="card-footer p-1">
                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test C</a>
                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                        <?php 
                                        if(!empty($mock_cv)){ 
                                        ?>
                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                       
                                       <?php } else { ?>
                                       
                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                   
                                       <?php }
                                       ?>
                                    </div>
                                    </form>
                                </div>
                                 
                            </div>
                       
                                        <?php if(!empty($mock_cv_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_cv_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test C Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_cv_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test C Free</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_cv_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>  
                            
                                    <?php } 
                                        
                                } 
                                ?>
                       
                       
                                <!-- ======================= Mock Test D ======================== -->
                                <?php
                                if($activate[0]['mock_test_d']=='mock_test_d' and !empty($mock_dv)){ 
                                     
                                if($mock_test_d == 'Yes'){
                                    // echo 'okk';
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Mock Test -D Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_d_price']; ?></a>
                                                
                                            </div>
                                    
                                    
                                    
                                   
                                    <div class="card-footer p-1">
                                        <?php    
                                        
                                        $this->db->select('mocktest_d_date');
                                        $this->db->from('closing_competition_details');
                                        $this->db->where("competition_id",$activate[0]['id']);
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->row_array();
                                        $mocktest_d_date = $res['mocktest_d_date'];
                                        
                                        if($mocktest_d_date != '0000-00-00' or empty($mocktest_d_date)){
                                            $od ='check';
                                        }    
                                            if($od =='check'){
                                            $current_date = date("Y-m-d");
                                            
                                            $mocktest_d_date = new DateTime($mocktest_d_date);
                                            $current_date_obj = new DateTime($current_date);
                                            
                                                if ($mocktest_d_date > $current_date_obj) {
                                                    $stod ='open';
                                                } else {
                                                    $stod ='close';
                                                }
                                            }else{
                                                $stod ='open';
                                            }
                                        
                                       // echo $stoa;
                                       // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                        $this->db->select('*');
                                        $this->db->from('amount_cart');
                                       $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
    
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->result_array();
                                        //print_r($res);
                                        
                                        if( $activate[0]['mock_test_d_price']!='0'){
                                            
                                            
                                            // if($stoa=='open'){
                                                // echo 'okk';
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
    						                
                						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                						                
                						                $date_close='';
                						                
                						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center[0]['exam_date'];
                						                }
                						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center1[0]['exam_date'];
                						                }
                						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                						                    $date_close=$activate[0]['close_date'];
                						                }
                						                
                						                
                						              //  if(!empty($date_close)){
                						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                						              //  }
                						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                         $today = date("Y-m-d");
                                                         
                                                         
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        
                                                        if(empty($cen->close_mock_d) or $cen->close_mock_d == 0){          
                                                  
                                                         
                                                            //  echo $one_days_before;
                                                            // if ($oneDaysBefore > $today) {
                                                            if($one_days_before >= $today){
                                                            // echo 'ok';
                                                            //  if($state_id =='14686'){
                                                                
                                                                        // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                            ?>
                                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                            <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                      
                                                                            <?php
                                                                        // } else {
                                                                        //     echo 'Purchase Closed';
                                                                        // }
                                                            // }  
                                                            
                                                            // else
                                                            
                                                            if ($close_date >= $today) {
                                                            ?>  
                                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_d_price'].'+MockTest D';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_d_price'].'+MockTest D';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php 
                                                                                }    
                                                                            }
                                                                else{
                                                                echo 'Mock Closed.';
                                                            }
                                                        }else{
                                                            echo 'Mock Closed.';
                                                        }
                                        }
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                       
                       
                       <?php } else { //print_r($mock_av);?>
                       
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
            
                                    <div class="card my-2 mx-2 p-1 w-100">
                                        <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                
                                                <input type='text' name='paper_id' value='<?php echo $mock_dv->paper_id; ?>' style='display:none;' >
                                        <div class="card-body">
                                            <h5 class="card-title">Mock Test D Paid</h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link"><?php 
                                            if(!empty($mock_dv)){
                                                echo 'Available';
                                                
                                            }else{
                                            echo 'The Mock Test can be downloaded by evening today.'; } 
                                            ?>
                                            </a>
                                            
                                        </div>
                                        <div class="card-footer p-1">
                                            <a href="#" class="btn btn-warning btn-sm my-1">Mock Test D</a>
                                            <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                            <?php 
                                            if(!empty($mock_dv)){ 
                                            ?>
                                           <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                           
                                           <?php } else { ?>
                                           
                                           <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                       
                                           <?php }
                                           ?>
                                        </div>
                                         </form>
                                    </div>
                                     
                                </div>
                           
                                        <?php if(!empty($mock_dv_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_dv_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test D Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_dv_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test D Free</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_dv_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>  
                           
                                <?php } 
                                    
                                } 
                                ?>
                       
                       
                                <!-- ======================= Mock Test E ======================== -->
                                <?php
                                if($activate[0]['mock_test_e']=='mock_test_e' and !empty($mock_ev)){ 
                                     
                                if($mock_test_e == 'Yes'){
                                    // echo 'okk';
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Mock Test -E Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_e_price']; ?></a>
                                                
                                            </div>
                                    
                                    
                                    
                                   
                                    <div class="card-footer p-1">
                                        <?php    
                                        
                                        $this->db->select('mocktest_e_date');
                                        $this->db->from('closing_competition_details');
                                        $this->db->where("competition_id",$activate[0]['id']);
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->row_array();
                                        $mocktest_e_date = $res['mocktest_e_date'];
                                        
                                        if($mocktest_e_date != '0000-00-00' or empty($mocktest_e_date)){
                                            $oe ='check';
                                        }    
                                            if($oe =='check'){
                                            $current_date = date("Y-m-d");
                                            
                                            $mocktest_e_date = new DateTime($mocktest_e_date);
                                            $current_date_obj = new DateTime($current_date);
                                            
                                                if ($mocktest_e_date > $current_date_obj) {
                                                    $stoe ='open';
                                                } else {
                                                    $stoe ='close';
                                                }
                                            }else{
                                                $stoe ='open';
                                            }
                                        
                                       // echo $stoa;
                                       // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                        $this->db->select('*');
                                        $this->db->from('amount_cart');
                                       $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
    
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->result_array();
                                        //print_r($res);
                                        
                                        if( $activate[0]['mock_test_e_price']!='0'){
                                            
                                            
                                            // if($stoa=='open'){
                                                // echo 'okk';
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
    						                
                						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                						                
                						                $date_close='';
                						                
                						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center[0]['exam_date'];
                						                }
                						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center1[0]['exam_date'];
                						                }
                						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                						                    $date_close=$activate[0]['close_date'];
                						                }
                						                
                						                
                						              //  if(!empty($date_close)){
                						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                						              //  }
                						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                         $today = date("Y-m-d");
                                                         
                                                         
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        
                                                        if(empty($cen->close_mock_e) or $cen->close_mock_e == 0){          
                                                  
                                                         
                                                            //  echo $one_days_before;
                                                            // if ($oneDaysBefore > $today) {
                                                            if($one_days_before >= $today){
                                                            // echo 'ok';
                                                            //  if($state_id =='14686'){
                                                                
                                                                        // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                            ?>
                                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                            <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                      
                                                                            <?php
                                                                        // } else {
                                                                        //     echo 'Purchase Closed';
                                                                        // }
                                                            // }  
                                                            
                                                            // else
                                                            
                                                            if ($close_date >= $today) {
                                                            ?>  
                                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_e_price'].'+MockTest E';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_e_price'].'+MockTest E';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php 
                                                                                }    
                                                                            }
                                                                else{
                                                                echo 'Mock Closed.';
                                                            }
                                                        }else{
                                                            echo 'Mock Closed.';
                                                        }
                                        }
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                       
                       
                       <?php } else { //print_r($mock_av);?>
                       
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                        <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_ev->paper_id; ?>' style='display:none;' >
                                            <div class="card-body">
                                                <h5 class="card-title">Mock Test E Paid</h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link"><?php 
                                                if(!empty($mock_ev)){
                                                    echo 'Available';
                                                    
                                                }else{
                                                echo 'The Mock Test can be downloaded by evening today.'; } 
                                                ?>
                                                </a>
                                                
                                            </div>
                                        <div class="card-footer p-1">
                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test E</a>
                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                        <?php 
                                        if(!empty($mock_ev)){ 
                                        ?>
                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                       
                                       <?php } else { ?>
                                       
                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                   
                                       <?php }
                                       ?>
                                    </div>
                                     </form>
                                </div>
                                 
                            </div>
                            
                                    <?php if(!empty($mock_ev_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_ev_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test E Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_ev_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test E Free</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_ev_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>  
                       
                                <?php } 
                                    
                                } 
                                ?>
                       
                       
                                <!-- ======================= Mock Test F ======================== -->
                                <?php
                                if($activate[0]['mock_test_f']=='mock_test_f' and !empty($mock_fv)){ 
                                     
                                if($mock_test_f == 'Yes'){
                                    // echo 'okk';
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Mock Test -F Paid'; ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_f_price']; ?></a>
                                                
                                            </div>
                                    
                                    
                                    
                                   
                                    <div class="card-footer p-1">
                                        <?php    
                                        
                                        $this->db->select('mocktest_f_date');
                                        $this->db->from('closing_competition_details');
                                        $this->db->where("competition_id",$activate[0]['id']);
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->row_array();
                                        $mocktest_f_date = $res['mocktest_f_date'];
                                        
                                        if($mocktest_f_date != '0000-00-00' or empty($mocktest_f_date)){
                                            $of ='check';
                                        }    
                                            if($of =='check'){
                                            $current_date = date("Y-m-d");
                                            
                                            $mocktest_f_date = new DateTime($mocktest_f_date);
                                            $current_date_obj = new DateTime($current_date);
                                            
                                                if ($mocktest_f_date > $current_date_obj) {
                                                    $stof ='open';
                                                } else {
                                                    $stof ='close';
                                                }
                                            }else{
                                                $stof ='open';
                                            }
                                        
                                       // echo $stoa;
                                       // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                        $this->db->select('*');
                                        $this->db->from('amount_cart');
                                       $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");
    
                                        $query = $this->db->get();
                                        //echo $this->db->last_query();
                                        $res= $query->result_array();
                                        //print_r($res);
                                        
                                        if( $activate[0]['mock_test_f_price']!='0'){
                                            
                                            
                                            // if($stoa=='open'){
                                                // echo 'okk';
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
    						                
                						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                						                
                						                $date_close='';
                						                
                						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center[0]['exam_date'];
                						                }
                						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                						                    $date_close=$center1[0]['exam_date'];
                						                }
                						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                						                    $date_close=$activate[0]['close_date'];
                						                }
                						                
                						                
                						              //  if(!empty($date_close)){
                						              //      echo 'Competition Close Date: '.$date_close.'<br>';
                						              //  }
                						                $oneDaysBefore = date("Y-m-d", strtotime($date_close . " -1 days"));
                                                         $today = date("Y-m-d");
                                                         
                                                         
                                                        $cen = $this->db->get_where('exam_centers',array('comp_id'=>$_SESSION['exam_id'],'exam_date'=>$close_date))->row();
                                                        
                                                        if(empty($cen->close_mock_f) or $cen->close_mock_f == 0){          
                                                  
                                                         
                                                            //  echo $one_days_before;
                                                            // if ($oneDaysBefore > $today) {
                                                            if($one_days_before >= $today){
                                                            // echo 'ok';
                                                            //  if($state_id =='14686'){
                                                                
                                                                        // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                            ?>
                                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                            <!--<a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_a_price'].'+MockTest B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                      
                                                                            <?php
                                                                        // } else {
                                                                        //     echo 'Purchase Closed';
                                                                        // }
                                                            // }  
                                                            
                                                            // else
                                                            
                                                            if ($close_date >= $today) {
                                                            ?>  
                                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_f_price'].'+MockTest F';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_f_price'].'+MockTest F';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                            <?php 
                                                                                }    
                                                                            }
                                                                else{
                                                                echo 'Mock Closed.';
                                                            }
                                                        }else{
                                                            echo 'Mock Closed.';
                                                        }
                                        }
                                        ?>
                                    </div>
                                    
                                </div>
                            </div>
                       
                       
                               <?php } else { //print_r($mock_av);?>
                               
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                    <div class="card my-2 mx-2 p-1 w-100">
                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                        <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                       
                                            <input type='text' name='paper_id' value='<?php echo $mock_fv->paper_id; ?>' style='display:none;' >
                                    <div class="card-body">
                                        <h5 class="card-title">Mock Test F Paid</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link"><?php 
                                        if(!empty($mock_fv)){
                                            echo 'Available';
                                            
                                        }else{
                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                        ?>
                                        </a>
                                        
                                    </div>
                                    <div class="card-footer p-1">
                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test F</a>
                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                        <?php 
                                        if(!empty($mock_fv)){ 
                                        ?>
                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                       
                                       <?php } else { ?>
                                       
                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                   
                                       <?php }
                                       ?>
                                    </div>
                                     </form>
                                </div>
                                 
                            </div>
                       
                                    <?php if(!empty($mock_fv_free)){ ?>
                                        
                                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid d-block mx-auto w-50" alt="...">
                                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper_new">
                                                    
                                                    <input type='text' name='paper_id' value='<?php echo $mock_fv_free->paper_id; ?>' style='display:none;' >
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mock Test F Free</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" class="card-link"><?php 
                                                        if(!empty($mock_fv_free)){
                                                            echo 'Available';
                                                            
                                                        }else{
                                                        echo 'The Mock Test can be downloaded by evening today.'; } 
                                                        ?>
                                                        </a>
                                                        
                                                    </div>
                                                    <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Mock Test F</a>
                                                        <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                                        <?php 
                                                        if(!empty($mock_fv_free)){ 
                                                        ?>
                                                       <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                       
                                                       <?php } else { ?>
                                                       
                                                       <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                                                   
                                                       <?php }
                                                       ?>
                                                    </div>
                                                 </form>
                                                </div>
                                     
                                            </div>
                                    
                                        <?php } ?>  
                       
                                <?php }
                                } 
                                ?>
                                
                       
                            </div>
                                  
                        </div>
                              
                          
                          
                        <!-- ======================= Combos         ======================== -->  
                        <div class="tab-pane fade" id="nav-combo" role="tabpanel" aria-labelledby="nav-combo-tab">
                            <div class='row'>
                                 <!-- =============== Combo-1 =============== -->
                               <?php
                               
                                if($activate[0]['combo_1']!=''){ 
                                    if($combo1=='Yes'){
                                    //print_r($activate[0]['combo_1']);
                                    $c1=explode("+",$activate[0]['combo_1']);
                                    foreach($c1 as $r){
                                        
                                        $cin = $this->session->userdata('cin');
                                        $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                        
                                        
                                    }
                                    
                                    
                                //if($mock_test!=''){
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid d-block mx-auto w-50" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Combo-1'; ?></h5>
                                                
                                                <h5 class="card-title">
                                                <?php 
                                                    foreach($c1 as $r){
                                                        print_r($r);
                                                        echo '<br>';
                                                    }
                                                ?>
                                                
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_1_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                
                                                
                                                <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                               
                                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						              //  print_R($center);
                        						                $date_close='';
                        						                
                        						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center[0]['exam_date'];
                        						                }
                        						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center1[0]['exam_date'];
                        						                }
                        						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						                    $date_close=$activate[0]['close_date'];
                        						                }
                        						                
                        						              //  if(!empty($date_close)){
                        						                    echo 'Competition Date: '.$date_close.'<br>';
                        						              //  }
                        						                $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                        						                //echo $date_close.' '.$sevenDaysBefore;
                                                                $today = date("Y-m-d");
                                                                if ($sevenDaysBefore >= $today) {?>
                                                ?>
                                              
                                                    <a href="#" class="btn btn-warning btn-sm my-1 add1"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_1_price'].'+Combo-1';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm my-1 rev1"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_1_price'].'+Combo-1';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <?php 
                                                                }else{
                                                                    
                                                                echo 'Combo-1 Purchase Closed.';
                                                                }
                                                ?>
                                            
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               
                               
                               <?php } } ?>
                               
                               <!-- =============== Combo-2 =============== -->
                               <?php
                               
                               
                                if($activate[0]['combo_2']!=''){ 
                                    if($combo2=='Yes'){
                                    //print_r($activate[0]['combo_1']);
                                    $c1=explode("+",$activate[0]['combo_2']);
                                    foreach($c1 as $r){
                                        
                                        // if($r['mat_A']){
                                        //     echo $material_a;
                                        // }
                                    }
                                    
                                    
                                //if($mock_test!=''){
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                            <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid d-block mx-auto w-50" alt="...">
                                           <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Combo-2'; ?></h5>
                                                
                                                <h5 class="card-title">
                                                <?php 
                                                    foreach($c1 as $r){
                                                        print_r($r);
                                                        echo '<br>';
                                                    }
                                                ?>
                                                
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_2_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                
                                                <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                
                                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						              //  print_R($center);
                        						                $date_close='';
                        						                
                        						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center[0]['exam_date'];
                        						                }
                        						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center1[0]['exam_date'];
                        						                }
                        						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						                    $date_close=$activate[0]['close_date'];
                        						                }
                        						                
                        						              //  if(!empty($date_close)){
                        						                    echo 'Competition Date: '.$date_close.'<br>';
                        						              //  }
                        						                $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                        						                //echo $date_close.' '.$sevenDaysBefore;
                                                                $today = date("Y-m-d");
                                                                if ($sevenDaysBefore >= $today) {?>
                                                ?> 
                                                <a href="#" class="btn btn-warning btn-sm my-1 add2"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_2_price'].'+Combo-2';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm my-1 rev2"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_2_price'].'+Combo-2';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            
                                                <?php }else{
                                                    echo 'Combo-2 Purchase Closed.';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } } ?>
                               
                               
                               <!-- =============== Combo-3 =============== -->
                               <?php
                                if($activate[0]['combo_3']!=''){ 
                                    if($combo3=='Yes'){
                                    //print_r($activate[0]['combo_1']);
                                    $c1=explode("+",$activate[0]['combo_3']);
                                    foreach($c1 as $r){
                                        
                                        // if($r['mat_A']){
                                        //     echo $material_a;
                                        // }
                                    }
                                    
                                    
                               // if($mock_test!=''){
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                           <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid d-block mx-auto w-50" alt="...">
                                           <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Combo-3'; ?></h5>
                                                
                                                <h5 class="card-title">
                                                <?php 
                                                    foreach($c1 as $r){
                                                        print_r($r);
                                                        echo '<br>';
                                                    }
                                                ?>
                                                
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_3_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                               <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                
                                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						              //  print_R($center);
                        						                $date_close='';
                        						                
                        						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center[0]['exam_date'];
                        						                }
                        						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center1[0]['exam_date'];
                        						                }
                        						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						                    $date_close=$activate[0]['close_date'];
                        						                }
                        						                
                        						              //  if(!empty($date_close)){
                        						                    echo 'Competition Date: '.$date_close.'<br>';
                        						              //  }
                        						                $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                        						                //echo $date_close.' '.$sevenDaysBefore;
                                                                $today = date("Y-m-d");
                                                                if ($sevenDaysBefore >= $today) {?>
                                                ?> 
                                                <a href="#" class="btn btn-warning btn-sm my-1 add3"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_3_price'].'+Combo-3';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm my-1 rev3"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_3_price'].'+Combo-3';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <?php }else{
                                                    echo 'Combo-3 Purchase Closed.';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php }} ?>
                               
                                     
                               <!-- =============== Combo-4 =============== -->
                               <?php
                                if($activate[0]['combo_4']!=''){ 
                                    if($combo4=='Yes'){
                                    //print_r($activate[0]['combo_1']);
                                    $c1=explode("+",$activate[0]['combo_4']);
                                    foreach($c1 as $r){
                                        //print_r($r);
                                    }
                                    
                                    
                               // if($mock_test!=''){
                                ?>
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                        <div class="card my-2 mx-2 w-100">
                                           <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid d-block mx-auto w-50" alt="...">
                                           <div class="card-body">
                                                <h5 class="card-title"><?php echo 'Combo-4'; ?></h5>
                                                
                                                <h5 class="card-title">
                                                <?php 
                                                    foreach($c1 as $r){
                                                        print_r($r);
                                                        echo '<br>';
                                                    }
                                                ?>
                                                
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_4_price']; ?></a>
                                                
                                            </div>
                                            <div class="card-footer p-1">
                                                <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                
                                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$activate[0]['id']))->result_array();
            						                
                        						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$activate[0]['id']))->result_array();
                        						              //  print_R($center);
                        						                $date_close='';
                        						                
                        						                if(!empty($center[0]['exam_date']) && $center[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center[0]['exam_date'];
                        						                }
                        						                if(!empty($center1[0]['exam_date']) && $center1[0]['exam_date']!='0000-00-00'){
                        						                    $date_close=$center1[0]['exam_date'];
                        						                }
                        						                if(!empty($activate[0]['close_date']) && $activate[0]['close_date']!='0000-00-00'){
                        						                    $date_close=$activate[0]['close_date'];
                        						                }
                        						                
                        						              //  if(!empty($date_close)){
                        						                    echo 'Competition Date: '.$date_close.'<br>';
                        						              //  }
                        						                $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                        						                //echo $date_close.' '.$sevenDaysBefore;
                                                                $today = date("Y-m-d");
                                                                if ($sevenDaysBefore >= $today) {?>
                                                ?> 
                                                <a href="#" class="btn btn-warning btn-sm my-1 add4"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_4_price'].'+Combo-4';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm my-1 rev4"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_4_price'].'+Combo-4';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                <?php }else{
                                                    echo 'Combo-1 Purchase Closed.';
                                                }
                                                ?>    
                                            
                                            </div>
                                        </div>
                                    </div>
                               
                               
                               <?php } }?>
                   
                            </div>
                              
                        </div>
                         
                         
                          
                    </div>
                   
                </div>    
                    
            <div class='col-sm-4'>
                    
                    
     <!--    ========== cart section ==========   -->
                 <?php  if($all_paid_new==''){?>
    
    
                        
						
						
                    <div class="">
                    
                       <?php $cin = $this->session->userdata('cin');
                       $re = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                        //print_r($re);
                        $res = $this->db->get_where('amount_cart',array('cin' =>$cin,'ini'=>''))->result_array();
                        
                        
                        $amount_total1=0;$amount_total2=0;$amount_total=0;
                       foreach($res as $value){
                           //print_r($value['amount']);die;
                           $amount_total1  = $value['amount']+$amount_total1;
                       }
                        
                        
                        $this->db->distinct();
                        $this->db->select('ini,amount');
                        $this->db->from('amount_cart');
                        $this->db->where('cin', $cin);
                        $this->db->where('ini !=', '');
                        $result = $this->db->get()->result_array();
                        
                        //echo $this->db->last_query();die;
                        foreach($result as $row)
                        {
                            $amount_total2 = $row['amount'] + $amount_total2;
                        }
                        $amount_total = $amount_total1 + $amount_total2;
                        //echo $amount_total;
                       
                       
                       
                        ?>
                        
                        <div class="card w-100 my-2">
                            <div class="card-body">
                                <h4 class="card-title text-center">Items Added To Cart</h4><br>
                                <!--<h5>If you purchase combo, other item in cart will remove automatic. Purchase them next time.</h5>-->
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0 my-2" id='amount'><?php if($amount_total==0){  ?>
                                    </li>
                                    </ul>
                                    <?php
                                }else{ 
                                
                                    foreach($re as $row){ ?>
                                
                                        <h5>
                                        <?php 
                                            
                                            if($row['title']){
                                                //echo $row['title'].' - Rs.'.$row['amount'];
                                                $title = preg_replace('/Orientation/i', 'Training', $row['title']);
                                                echo $title.' - Rs. '.$row['amount'];
                                            }
                                            if(!empty($row['ini']))
                                            {
                                                echo ' '.$row['ini'];
                                            } 
                                            if(!empty($row['sch_id']))
                                            {
                                                echo ' Exam Date: '.$row['sch_id'];?>  <i class="fa fa-briefcase fa-spin fa-2x fa-fw primary" aria-hidden="true"></i>
                                            <?php  
                                            } 
                    
                                        ?> 
                                        
                                        </h5>
                                    
                                        
                                    <?php }
                                    
                                }
                                
                                ?>
    
                         <?php 
                         
                         $out = $this->db->get_where('cin_result',array('cin' =>$cin))->row();
                         
                        //  print_R($out->product_name);
                         
                         
                         $idd = $this->session->userdata('cin');
                                    ?>
                            <div class="card-footer cart-footer text-end">
                                    <a href="#" class="card-link my-2" style="text-decoration:none;">Total Amount <span class="card-link ms-2" id='amount'> ₹ <?php echo $amount_total; ?></span></a>
                                    
                                <div id="myDIV"></div>
                                <?php  
                                if($activate[0]['franchise_split']=='yes'){
                                    $paid_idd = $this->db->get_where('cin_list',array('cin' =>$idd))->row();
                                    $franchise_percentage=$activate[0]['com_per'];
                                    
                                }
                                if($activate[0]['aviansys_split']=='yes'){
                                    $avian_percentage=$activate[0]['com_peravian'];
                                }
                                // echo $franchise_percentage.' '.$avian_percentage;
                                $ar_state=array('14694');
                                //if($franchise_percentage or $avian_percentage  && $student['period_id'] >='12'){
                                ?>
                                <form method='post' action="<?php echo base_url()?>razorpay/pay2">
                                    
                                    
                                    
                                    <?php
                                    // }else{  ?>
                                    <!--<form method='post' action="<?php echo base_url()?>razorpay/pay">-->
                                        <?php
                                    // }
                                        
                                        
                                        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$idd))->row();
                                        //print_r($paid_idd);?>
                                        
                                    <input type="hidden" name="cin" value="<?php echo $paid_idd->cin;?>">
                                    <input type="hidden" name="name" value="<?php echo $paid_idd->student_name;?>">
                                    <input type="hidden" name="contact" value="<?php echo $paid_idd->stud_phone;?>">
                                    <input type="hidden" name="email" value="<?php echo $paid_idd->stud_email;?>">
                                    <input type="hidden" name="clevel" value="<?php echo $clevel;?>">
                                    <input type='text' name='product_name' value='<?php echo $out->product_name;?>' style='display:none;' >
                                    
                                    <input type='text' name='amount' value='<?php print_r($amount_total); ?>' style='display:none;' >
                                    <input type='text' name='price_code' value='<?php echo $product['price_code']; ?>' style='display:none;' >
    								<?php if(empty($amount_total)){  ?>
    								
    								    <p>Nothing in cart !!! </p>
                                      <?php if (strtotime(date('Y-m-d')) > strtotime($activate[0]['close_date'])): ?>
    
                                        <!-- Registration Closed Button -->
                                        <p class="btn btn-warning btn-lg my-3"
                                           style="font-size:15px;font-weight:700;"
                                           onclick="showClosedMessage()">
                                            Proceed To Register
                                        </p>
                                    
                                        <script>
                                            function showClosedMessage() {
                                                alert("Stay tuned! New championship registrations will open shortly.");
                                            }
                                        </script>
                                    
                                    <?php else: ?>
                                    
                                        <!-- Registration Open Button -->
                                        <p class="btn btn-warning btn-lg my-3"
                                           id="pay-button"
                                           style="font-size:15px;font-weight:700;">
                                            Proceed To Register
                                        </p>
                                    
                                    <?php endif; ?>
                                         
    								<?php }else{
    								
    								?>
    								    
    								        
    								        <!--<p style='color:red;'>Payments will be back shortly we are in maintinance...</p>-->
    									    <button type="submit" name="pay" id="pay" class="btn btn-warning btn-lg my-3" id='pay-button' style='font-size:15px;font-weight:700;' >Proceed To Register</button> 
    									 
    									
    									 
    								<?php } ?>
                                        <!--<a href="#" class="btn btn-warning">Proceed To Register </a>-->
                                </form>
                            </div>
                            </div>
                            
                        </div>
                        
                        
                        
                        
                        
                       
                        
                        
                        
                    <?php } ?>
                    
                   
                </div>
                <?php 
                
                // print_r($activate[0]);
                
                if($exam_center){ ?>
                    <div class='col-sm-12 my-3'> 
                    
                        <?php if($activate[0]['pemplate']){ ?>
                          <a href="https://marrs.in/admin/uploads/<?php echo $activate[0]['pemplate']; ?>" 
                             target="_BLANK" 
                             class="btn btn-danger btn-sm">
                             <i class="fa-solid fa-download me-1"></i> Download Circular
                          </a>
                        <?php } ?>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
        
                            <h3 class="text-primary mb-2 mb-md-0">
                              Assessment Schedule
                            </h3>
                
                        
                
                        </div>
                        
                        
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <!--<th>Sr No.</th>-->
                                        <th>Center Name</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    foreach($exam_center as $row){ 
                                        
                                            // if (!empty($wolah->comp_date) && $row->exam_date == $wolah->comp_date) {
                                            //     $color = 'green;font-weight:600;';
                                            // } 
                                            // $colour='';
                                    //print_r($row); ?>
                                    <tr style="color: <?= $color; ?>">
                                        <!--<td><?php echo $i; ?></td>-->
                                        <td><?php echo $row->center_name; ?></td>
                                        <td><?php echo $row->center_address; ?></td>
                                        <td><?php echo $row->exam_date; ?></td>
                                        <td><?php echo $row->exam_time; ?></td>
                                    </tr>
                                    <?php $i=$i+1;} ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div> 
                   
                <?php } ?>   
                   
                    <?php  
                    // echo 'ok';
                    } elseif($student_all_data->franchise_id =='68'){?>
                     <div class="col-12 mx-2 text-center">   
                            <h3 style="padding:10px"><span style="color:#006699;">Congratulations!! You are qualified to register for the </span><span style="color:crimson;font-family: 'FontAwesome';font-size: 16px;letter-spacing:2px;"> <?php echo $nlev; ?></span><span style="color:#006699;"> Championship..</span></h3> 
                        </div>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;"> "Registration Will Open Soon"</span><span style="color:crimson;"></span><span style="color:#006699;">...</span></h3> 
                    </div>
                
               
                  <?php }else{?>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;"> "Sorry, you are not qualified to the next level. Better Luck Next Time!"</span><span style="color:crimson;"></span><span style="color:#006699;">...</span></h3> 
                    </div>
                
                <?php }?>
                </div>
                
               
           </div>     
                
    </section>
    
    <div class="overlay" id="overlay"></div>
    <div class="custom-alert" id="custom-alert">
        <h5 id="alert-message" style='color:#4d79ff;'></h5>
    </div>
                        
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    
    
    

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script-->
<!--      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"-->
<!--      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="-->
<!--      crossorigin="anonymous"-->
<!--      referrerpolicy="no-referrer"-->
<!--    ></script>-->
<!--<script>-->
<!--    function misb(id) {-->
    
<!--        var amount = id;-->
        <!--//alert(amount);-->
   
<!--        $.ajax({-->
<!--                url: "<?php base_url();?>net_abc___",-->
<!--                type: 'POST',-->
<!--                data: {id: amount},-->
<!--                success: function (response) {-->
<!--                    showAlert(response);-->
<!--                    location.reload();-->
               
<!--                }-->
<!--        });-->
<!--    }-->
 
<!--    function remove_misb(id) {-->
    
<!--        var amount = id;-->
        <!--// alert(amount);-->
   
<!--        $.ajax({-->
<!--                url: "<?php base_url();?>cart_remove___",-->
<!--                type: 'POST',-->
<!--                data: {id: amount},-->
<!--                success: function (response) {-->
<!--                showAlert(response);-->
<!--                location.reload();-->
<!--                }-->
<!--        });-->
<!--    }-->
 

<!--</script>-->
<!--Helper function for bundle name change-->

<script>
/* ========= GLOBAL ========= */
var selectedAmountId = '';
var competitionCenters = <?php echo json_encode($centers ?? []); ?>;
var openModal = <?php echo (!empty($open_modal) && $open_modal == 1) ? '1' : '0'; ?>;
// var openModal = <?php echo isset($open_modal) ? $open_modal : 0; ?>;
var new_id = <?php echo isset($new_id) ? $new_id : 0; ?>;
/* ========= MODAL (BS5) ========= */
function showModal(id) {
    var el = document.getElementById(id);
    if (!el) return;
    bootstrap.Modal.getOrCreateInstance(el).show();
}

function hideModal(id) {
    var el = document.getElementById(id);
    if (!el) return;
    bootstrap.Modal.getOrCreateInstance(el).hide();
}

/* ========= READY ========= */
// document.addEventListener('DOMContentLoaded', function () {
//     if (openModal == 1 && competitionCenters.length > 0) {
//         populateCloseDateOptions(competitionCenters);
//         showModal('closeDateModal');
//     }
// });

document.addEventListener('DOMContentLoaded', function () {
    if (openModal == 1 && competitionCenters.length > 0) {
        populateCloseDateOptions(competitionCenters);
        showModal('closeDateModal');
    }
});

function preCheckCompetition(el) {
    var id = el.id;

    if (openModal == 0) {
        misb(id);
        return;
    }

    if (id.indexOf('Competition') !== -1 && competitionCenters.length > 0) {
        selectedAmountId = id;
        populateCloseDateOptions(competitionCenters);
        showModal('closeDateModal');
    } else {
        misb(id);
    }
}
function populateCloseDateOptions(centers) {
    var select = document.getElementById('closeDateSelect');
    if (!select) return;

    var html = '<option value="">-- Select Competition Date --</option>';
    centers.forEach(function (c) {
        html += '<option value="' + c.exam_date + '">' + c.exam_date + '</option>';
    });
    select.innerHTML = html;
}

function submitCloseDate() {
    var selectedDate = document.getElementById('closeDateSelect').value;
    if (!selectedDate) {
        alert('Please select a date.');
        return;
    }

    $.ajax({
        url: "<?= base_url('cin_login/save_selected_close_date') ?>",
        method: "POST",
        data: {
            close_date: selectedDate,
            new_id: <?= (int)$new_id ?>
        },
        success: function () {
            hideModal('closeDateModal');
            misb(selectedAmountId);
            setTimeout(function () {
                location.reload();
            }, 300);
        }
    });
}

/* ========= CART ========= */
function misb(id) {
    $.post("<?= base_url('cin_login/net_abc___') ?>", { id: id }, function (res) {
        showAlert(res);
        location.reload();
    });
}

function remove_misb(id) {
    $.post("<?= base_url('cin_login/cart_remove___') ?>", { id: id }, function (res) {
        showAlert(res);
        location.reload();
    });
}


/* ========= ALERT ========= */
function showAlert(message) {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('custom-alert').style.display = 'block';
    document.getElementById('alert-message').textContent = message;
    setTimeout(closeAlert, 9000);
}

function closeAlert() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('custom-alert').style.display = 'none';
}
  

</script>


<?php include("footer.php");?>