<?php include('header.php');
// print_r($student);
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
			 <?php if(!empty($this->session->flashdata('message'))) { ?>
			<div class="alert alert-success text-center">
			 
						 <h4><?php echo $this->session->flashdata('message');?></h4>
						  
						
			</div>
			 <?php }?>

			
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h4 class="text-center my-4">Student Contact Details</h4>  
                    <!--<div class="line"></div>-->
                </div>
               
               
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Student Name</label>
              <input type='text' class="form-control" value="<?php echo $student[0]['student_name']; ?>" >
               </div>
              <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
               <label class="my-1">Mother Name</label>
                <input type='text' class="form-control" value="<?php echo $student[0]['mother_name']; ?>" name="mother_name" >
              </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Father Name</label>
                
                <input type='text' class="form-control" value="<?php echo $student[0]['father_name']; ?>" name="father_name" >
               </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Student Email</label>
                <input type='email' class="form-control" value="<?php echo $student[0]['stud_email']; ?>" name="stud_email" >
               </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Father Email</label>
                 <input type='email' class="form-control" value="<?php echo $student[0]['father_email']; ?>" name="father_email">
                </div>
                
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                    <label class="my-1">Student Phone</label>
                    <input type='text' class="form-control" value="<?php echo $student[0]['stud_phone']; ?>" name="stud_phone" >
                </div>
            </div>
            
           
             
            <div class='row' style='padding-top:50px;'>
            
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary w-25" style='background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                    <div id='pad' style='color:green;'>
                            <h3><?php 
                            
                            // if(!empty($this->session->flashdata('error'))){
                            // echo $this->session->flashdata('error'); 
                            // }
                            ?></h3>
                    </div>
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    
                </div>
            </div>
        </div>
    </form>
</div>


</body>

<?php include("footer.php");?>