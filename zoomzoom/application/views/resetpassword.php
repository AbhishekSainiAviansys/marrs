<?php include('cin_login/header.php');
 //print_r($class);
?>
<style>
h3{
    font-weight:700;
    color:#006699;
}
    #corner{
        background-color:#ffffb3;
        border-radius:20px;
        margin-left:250px;
        margin-right:250px;
        padding-top:0px;
        /*padding-bottom:20px;*/
        font-size:18px;
        color:#3385ff;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border:solid 1px #006699;
      font-size:15px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
label{
    font-weight:500;
    
}
</style>
<body>
    <!--<h1  style='text-align:center;'>Edit Profile Details</h1>--> 
        <div style='text-align:center;color:#006699;'>
            <h1 style='font-weight:700;'></h1>
        </div>
    <div id='' class="card w-75 mx-auto p-4 my-3">
    
    <form id="myForm" action="" method="POST">
        <div class='container-fluid' id='corner1'>
            <div class='row'>
			 <?php if(!empty($this->session->flashdata('success'))) { ?>
			<div class="text-center">
			 <h5 style="background: green;color: #fff;padding:10px"><?php echo $this->session->flashdata('success');?></h5>
			</div>
			 <?php }?>

			
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h4 class="text-center my-4">Reset Password</h4>  
                  
                </div>
               
               <div class="row" style="margin-left:18rem">
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Old Password</label>
              <input type='text' class="form-control" value="" name="old_password">
               </div> </div>
                <div class="row" style="margin-left:18rem">
              <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
               <label class="my-1">New  Password</label>
                <input type='text' class="form-control" value="" name="new_password">
              </div>
              
             </div>
            </div>
            
           
             
            <div class='row' style='padding-top:50px;padding-bottom:50px;'>
            
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary w-25" style='background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                     <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <a href="<?php echo base_url();?>Cin_login" class="btn btn-warning w-25" style='background-color:#ff6600;font-size:20px;'> To Profile</a> 
                    </div>
                   
                </div>
               
            </div>
        </div>
    </form>
</div>


</body>

<?php include("cin_login/footer.php");?>