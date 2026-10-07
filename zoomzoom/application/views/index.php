<?php include("header.php") ?>
    
<body style=" background: linear-gradient(to top right, #0066ff 0%, #ff99cc 100%) "> 
      <div class='container-fluid'>
        <div class='row'>
           <div class="col-12">
    <div class="text-start my-2">                
                <a href="https://marrs.in/student_registration/welcome/student" class="btn btn-outline-light btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
            </div>
        </div>
    </div> 
      <div class="card w-75  mb-4 mx-auto  my-5 mb-5 border-0" style="box-shadow:0 3px 10px rgb(0 0 0 / 0.2)">
        <div class="card-body p-0">
        <div class='container-fluid'> 
            <div class='row'>
                
                <div class='col-sm-12 col-md-12 col-lg-7 p-5' style="background:#1365b5;">
                    <div id='heading'>
                    <h4 class="text-center mb-5" style="text-shadow:0px 1px #000;color:#ffff"> <b>Register for the</b>  <span class="text-warning" style="text-shadow:0px 1px #000;">MaRRS Program</span> </h4>

                </div >
                    <div class="text-center"> <img src='<?php echo base_url(); ?>images/schoool.png' class="img-fluid bg-light rounded-2" /></div>
                </div>
                <div class='col-sm-12 col-md-12 col-lg-5 p-5'>
                    <form method="post" class="row g-3" action="<?php echo base_url();?>welcome/schoolcode" id='pad'>
                        <div class="col-12" >
                            <h4> Please Confirm Your Access Code </h4><h5 style='color:#ff9933;'>For Student Registration</h5> 
                        </div>
					
                        <div class="col-12">
                            <input type='text' class="form-control" name="schoolaccesscode" id="schoolaccesscode" value="<?php if(!empty($this->session->flashdata('schoolcode'))) { echo $this->session->flashdata('schoolcode'); } ?>" placeholder='Enter School Code ....' style='height:40px;widh:100%;'>
                        </div>
						
						
							
							
                        <div class="col-12" ><?php if(!empty($this->session->flashdata('schoolerror'))){ ?>

                    
                            <h4 > <?php print_r($this->session->flashdata('schoolname'));?></h4>
                             <h4 > <?php print_r($this->session->flashdata('schooladdress'));?></h4>
                              <h4 > <?php print_r($this->session->flashdata('schooladdress1'));?></h4>
                         <?php  } else {
                             ?>
                             <h5 style='color:red;'> <?php 'Wromg School Code.';?></h5>
                             
                             <?php 
                         }?>
                        
                        </div>
                       <div class='col-sm-12 col-md-12 col-lg-12' style="margin-top: 0px;margin-bottom: 20px;">
                            <h4><strong><?php echo $school->school_name;?></strong></h4>
                            </div>
                            <div class='col-sm-12 col-md-12 col-lg-12'>
                            <button type="submit" id="conform" class="btn btn-danger rounded-5 w-100" name='conform'>Confirm</button>
                        </div>
                        
                        
                        <div class="col-12"><?php if(!empty($this->session->flashdata('schoolerror'))){ ?>
                    
                    
                            <h5 style='color:red;'> <?php echo $this->session->flashdata('schoolerror');?></h5>
                                <?php  } ?>
                        
                        </div>
                        <!--<div id='ok'>-->
                            
                        <!--</div >-->
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
</body>
     
<script type="text/javascript"> 
      
       $("#school_id").change(function(){
		var category_id=this.value;   
		
        $.ajax({
            url:"<?php echo base_url();?>Welcome/get_access_code",
            data:{school_id:category_id},
            type: 'post',
            success:function(result){
				//alert(result);    
			$("input#schoolaccesscode").val(result);
			
        }});
    });
	    
 </script> 
<?php include("student_footer.php");?>   