
<?php include('header.php');
 //print_r($school['school_code']);die;
?>
<style>


.separator{
  display: flex;
  align-items: center;
}

.separator h3{
  padding: 0 1rem; /* creates the space */
}

.separator .line{
  flex: 1;
  height: 1px;
  background-color: #000;
}
.school_code {
    margin: 10px;
    padding: 10px;
}
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
   
       
    <div id='' class="card w-75 mx-auto p-4 my-3">
    
    <form id="myForm" action="" method="POST">
        <div class='container' id='corner1'>
            <div class='row'>
			     <div>
                   <h2 class="text-center">Registration Form</h2>  
                    
                </div>
                  <div class="school_code">
                    <h4 style='color:#348CCD;'>School Code : <span style='color:crimson;'><?php echo $school['school_code']; ?></span></h4>&emsp;
                    <!--<h4 style='color:#348CCD;'>School Name :<span style='color:crimson;'><?php echo $school['school_name']; ?></span></h4>-->
					<input type="hidden" name="school_code" value="<?php echo $school['school_code']; ?>">
						<input type="hidden" name="school_name" value="<?php echo $school['school_name']; ?>">
                </div>
               </div>
			    <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Student Details</h4>
                    <div class="line"></div>  
                </div><br>
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">First Name</label>
              <input type='text' class="form-control" name="first_name" value="<?php echo $student[0]['student_name']; ?>" Required>
               </div>
              <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
               <label class="my-1">Middle Name</label>
                 <input type='text' class="form-control" value="<?php echo $student[0]['father_name']; ?>" name="middle_name" >
              </div>
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Last Name</label>
                <input type='text' class="form-control" value="<?php echo $student[0]['mother_name']; ?>" name="last_name" Required>
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Personal Details</h4>
                    <div class="line"></div>  
                </div><br>
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Student Class</label>
				<select class="form-control" name="class" Required>
				<?php $class = $this->db->get_where('class')->result_array(); foreach($class as $value){ ?>
				<option value="<?php echo $value['class_id'];?>"><?php echo $value['class_name'];?></option>
				<?php } ?>
				</select>
               
               </div>
			   
			    <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Gender</label>
				<select class="form-control" name="gender" Required>
				
				<option value="male">Male<option>
				<option value="female">FeMale<option>
				</select>
               
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Guardian Details</h4> 
                    <div class="line"></div>  
                </div><br>
			  <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Father Name</label>
                 <input type='text' class="form-control"  name="father_name" Required>
                </div>
                
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Mother Name</label>
                 <input type='text' class="form-control" name="mother_name" Required>
                </div>
				 </div>
				 
				<br>
				 <div class="separator text-center">
                    <div class="line"></div>
                          <h4>Contact Details</h4>
                    <div class="line"></div>  
                </div><br>
				 <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Mobile Number</label>
                    <input type='number' class="form-control" name="mobile" Required>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Whatsapp Number</label>
                    <input type='number' class="form-control" name="whatsapp" >
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Email ID</label>
                    <input type='email' class="form-control"  name="email" Required>
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



