
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133722627-1"></script>


	<meta charset="utf-8">
	<title>SITE NAME</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
    <!-- The styles -->
	<link id="bs-css" href="<?php echo COMMON_VIEW_STYLE;?>bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	  .brand img {
    float: left;
    height: 24px !important
   
    margin-right: 5px;
    width: 100% !important;
}

@media only screen and (max-device-width: 480px) {
   

.col-lg-12 {
    display: grid !important;
}
.col-lg-12 input[type="text"] {
    width: 65% !important;
        margin-top: 10px;
}
}	</style>
	<link href="<?php echo COMMON_VIEW_STYLE;?>bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo COMMON_VIEW_STYLE;?>charisma-app.css" rel="stylesheet">
	<link href="<?php echo COMMON_VIEW_STYLE;?>jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo COMMON_VIEW_STYLE;?>fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>chosen.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>uniform.default.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>colorbox.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>opa-icons.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>uploadify.css' rel='stylesheet'>
	<link href='<?php echo COMMON_VIEW_STYLE;?>jquery.alerts.css' rel='stylesheet'>
    <link href='<?php echo COMMON_VIEW_STYLE;?>jquery.timepicker.css' rel='stylesheet'>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo VIEW_IMAGE;?>favicon.ico">
</head>
<body>
    
    
	<?php
	
	
	if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">

            <div style="display:flex; justify-content:space-between; align-items:center; width:100%;">

                <!-- Left Side -->
                <div>
                    <h3 style='color:white; margin:0;'>
                        <?php 
                        $franchise_id = $this->session->userdata('franchise_id');

                        $query = $this->db->query("
                            SELECT username, company_name, company_address 
                            FROM franchise 
                            WHERE franchise_id = '{$franchise_id}';
                        ");

                        $franchise = $query->result_array();

                        print_r($franchise[0]['company_name']);
                        echo ' ';
                        print_r($franchise[0]['company_address']);
                        ?>
                    </h3>
                </div>

                <!-- Right Side -->
                <div style="display:flex; align-items:center; gap:10px;">

                    <!-- Profile Dropdown -->
                    <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i>
                            <span class="hidden-phone">
                                <?php print_r($franchise[0]['username']); ?>
                            </span>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                        </ul>
                    </div>

                    <!-- Logout Button -->
                    <a href="<?php echo SITE_URL?>login/logout/" class="btn btn-danger">
                        Logout
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- topbar ends -->
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="https://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } /* END of if(!isset(no_visible_elements) || !no_visible_elements)*/ ?>

<ul class="nav nav-pills">
		<!-- ..........Home................-->			   
              <li <?php if(in_array(CONTROLLER,array('index'))){?> class="active"<?php }?>><a href="<?php echo SITE_URL?>index/">Home</a></li>

			  
		<!-- ..........Products.................-->			   
              <!--<li class="dropdown <?php if(in_array(CONTROLLER,array('school'))){?> active<?php }?>">-->
              <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Product<b class="caret"></b></a>-->
              <!--      <ul class="dropdown-menu">-->
                     <!--<li><a href="<?php echo SITE_URL?>school/product_List">product List </a></li>-->
                     <!--<li class="divider"></li>-->
                      <!--<li><a href="<?php echo SITE_URL?>school/product_List">Add Product </a></li>-->
                          
              <!--      </ul>-->
              <!--</li>-->
              <li class="dropdown <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">School<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                          <li><a href="<?php echo SITE_URL?>school/schoolListfranchise">School List</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo SITE_URL?>competitionshedule/schedule_list">Schedule List</a></li>
                          <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>school/new_school">School Add</a></li>
                          <li class="divider"></li>
                          <!--<li><a href="<?php echo SITE_URL?>school/add_new_school" style="pointer-events: none">School Add for new session student register</a></li>-->
                           <!--<li class="divider"></li>-->
                            <!--<li><a href="<?php echo SITE_URL?>content/bulk_upload">Bulk School Add</a></li>-->
                             <li><a href="<?php echo SITE_URL?>content/school_add_bulk">Bulk School Add</a></li>
                           
                            
                          <li class="divider"></li>
                          <li><a href="<?php echo SITE_URL?>content/school_template">Bulk School Add Template Download</a></li>
                           
                            
                          
                    </ul>
                    
              </li>
              
             
              <!--<li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">-->
              <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Price Code View <b class="caret"></b></a>-->
              <!--      <ul class="dropdown-menu">-->
              <!--             <li><a href="<?php echo SITE_URL?>school/PrizeCode_genration" style="pointer-events: none">Price Codes Genration</a></li>-->
              <!--              <li class="divider"></li>-->
              <!--             <li><a href="<?php echo SITE_URL?>school/PrizeCode_view" style="pointer-events: none">View Price Codes</a> </li>-->
              <!--              <li class="divider"></li>-->
    
              <!--      </ul>-->
                    
              <!--</li>-->
              
              
              <!-- <li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">-->
              <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Student<b class="caret"></b></a>-->
              <!--      <ul class="dropdown-menu">-->
              <!--             <li><a href="<?php echo SITE_URL?>school/student_extract">Student CIN Extract</a></li>-->
              <!--              <li class="divider"></li>-->
              <!--             <li><a href="<?php echo SITE_URL?>school/zoomzoom_student" style="pointer-events: none">ZoomZoom Student Extract</a> </li>-->
              <!--              <li class="divider"></li>-->
    
              <!--      </ul>-->
                    
              <!--</li>-->
             
             
             <li class="dropdown  <?php if(in_array(CONTROLLER,array('result'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Result<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                           <li><a href="<?php echo SITE_URL?>result">Result Extract</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>result/search_result">Search Result</a></li>
                           <!--<li><a href="<?php echo SITE_URL?>school/zoomzoom_student" style="pointer-events: none">ZoomZoom Student Extract</a> </li>-->
                            <li class="divider"></li>
    
                    </ul>
                    
              </li>
             
              <!--<li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">-->
              <!--  <a class="dropdown-toggle" data-toggle="dropdown" href="#">School Extract<b class="caret"></b></a>-->
              <!--      <ul class="dropdown-menu">-->
              <!--             <li><a href="<?php echo SITE_URL?>school/school_extract">School List Extract</a></li>-->
              <!--              <li class="divider"></li>-->
                          
              <!--      </ul>-->
                    
              <!--</li>-->
			   <li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration Extract 2023-above<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <li><a href="<?php echo SITE_URL?>school/competition_extraction">Competition Extract </a> </li>
                            <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/mock_extraction">Mock Extract </a> </li>
                            <!--<li><a href="<?php echo SITE_URL?>school/cin_list_export">ALL Extract 2023-24 </a> </li>-->
                            <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/material_extraction">Material Extract </a> </li>
                             <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/orientation_extraction">Orientation Extract </a> </li>
                    </ul>      
                    
              </li>
              
              
               <li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration Extract 2022<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <li><a href="<?php echo SITE_URL?>school/competition_extraction22">Competition Extract </a> </li>
                            <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/orientation_extraction22">Orientation Extract </a> </li>
                            <!--<li><a href="<?php echo SITE_URL?>school/cin_list_export">ALL Extract 2023-24 </a> </li>-->
                            <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/mock_extraction22">Mock Extract </a> </li>
                             <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>school/material_extraction22">Material Extract </a> </li>
                    </ul>      
                    
              </li>
              
              
              <li class="dropdown  <?php if(in_array(CONTROLLER,array('franchise'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">MANAGE CIN<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          <li><a href="<?php echo SITE_URL?>franchise/search_profile">Profile Search</a> </li>
                            <li class="divider"></li>
						   <li><a href="<?php echo base_url()?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN TEMPLATE Extract </a> </li>
                            <!--<li class="divider"></li> -->
                             <!--<li><a href="<?php echo SITE_URL?>franchise/cin_genration">CIN GENERATION </a> </li>-->
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>franchise/cin_list">CIN LIST </a> </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>franchise/cin_delete">Bulk CIN Delete</a> </li>    
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>franchise/cin_profile_update">Update Profile</a></li>
                    </ul>      
                    
              </li>
              
              <li class="dropdown  <?php if(in_array(CONTROLLER,array('franchise'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Competition<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <!--<li><a href="<?php echo base_url()?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN TEMPLATE Extract </a> </li>-->
                            <!--<li class="divider"></li> -->
                             <li><a href="<?php echo SITE_URL?>competitionshedule/competition_list">Live Competition List</a> </li>
                            <!--<li class="divider"></li>-->
                            <!--<li><a href="<?php echo SITE_URL?>franchise/cin_list">CIN LIST </a> </li>-->
                            <li class="divider"></li> 
                            <li><a href="<?php echo SITE_URL?>competitionshedule/add">Competition Schedule</a> </li>
                            <!--<li class="divider"></li> -->
                            <!--<li><a href="<?php //echo SITE_URL?>competitionshedule/search">Competition Schedule List</a> </li>-->
                           
                            
    
                    </ul>      
                    
              </li><li class="dropdown  <?php if(in_array(CONTROLLER,array('franchise'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Offline Payments update<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <!--<li><a href="<?php echo base_url()?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN TEMPLATE Extract </a> </li>-->
         <!--                   <li class="divider"></li> -->
                             <li><a href="<?php echo SITE_URL?>competitionshedule/offline_payments">Search CIN</a> </li>
                            <!--<li class="divider"></li>-->
                            <!--<li><a href="<?php echo SITE_URL?>franchise/cin_list">CIN LIST </a> </li>-->
                            
    
                    </ul>      
                    
              </li>
              
                </li><li class="dropdown  <?php if(in_array(CONTROLLER,array('franchise'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Support Tickets<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <!--<li><a href="<?php echo base_url()?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN TEMPLATE Extract </a> </li>-->
         <!--                   <li class="divider"></li> -->
                             <li><a href="<?php echo SITE_URL?>competitionshedule/cin_enquiries">Enquiries</a> </li>
                            <!--<li class="divider"></li>-->
                            <!--<li><a href="<?php echo SITE_URL?>franchise/cin_list">CIN LIST </a> </li>-->
                            
    
                    </ul>      
                    
              </li>
              
              <li class="dropdown  <?php if(in_array(CONTROLLER,array('school'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">School Registration<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <li><a href="<?php echo SITE_URL?>school/payment_export" >Payment Export</a></li>
                           
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>school/cmsch" >Activate School Registration</a> </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo SITE_URL?>school/school_activate" >Activate School</a> </li>
    
                    </ul>
                    
              </li>
              
		       </li><li class="dropdown  <?php if(in_array(CONTROLLER,array('franchise'))){?> active <?php }?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Study Material<b class="caret"></b></a>
                    <ul class="dropdown-menu"> 
                          
						   <!--<li><a href="<?php echo base_url()?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN TEMPLATE Extract </a> </li>-->
         <!--                   <li class="divider"></li> -->
                             <li><a href="<?php echo SITE_URL?>competitionshedule/search_material">Search Material</a> </li>
                            <!--<li class="divider"></li>-->
                            <!--<li><a href="<?php echo SITE_URL?>franchise/cin_list">CIN LIST </a> </li>-->
                            
    
                    </ul>      
                    
              </li>
 </ul>
<?php }/*End of if(!isset(no_visible_elements) || !no_visible_elements)*/ ?>