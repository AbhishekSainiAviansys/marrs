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
            <h1 style='font-weight:700;'>Edit Profile Details</h1>
        </div>
    <div id='corner' style='text-align:center;'>
    
    <form id="myForm" action="" method="POST">
        <div class='container-fluid' id='corner1'>
            <div class='row'>
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h3>Student Details</h3>
                    <div class="line"></div>
                </div>
               
               
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Student Name</label>
                    <input type='text' value="<?php echo $student[0]['student_name']; ?>" >
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Mother Name</label>*
                    <input type='text' value="<?php echo $student[0]['father_name']; ?>" name="father_name" required>
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Father Name</label>*
                    <input type='text' value="<?php echo $student[0]['mother_name']; ?>" name="mother_name" required>
                </div>
            </div>
            
            <div class='row'>
                
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h3>Contact Details</h3>
                    <div class="line"></div>
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Student Email</label>*
                    <input type='email' value="<?php echo $student[0]['stud_email']; ?>" name="stud_email" >
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Father Email</label>
                    <input type='email' value="<?php echo $student[0]['father_email']; ?>" name="father_email">
                </div>
                
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Student Phone</label>*
                    <input type='text' value="<?php echo $student[0]['stud_phone']; ?>" name="stud_phone" required>
                </div>
                
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <label>Father Phone</label>
                    <input type='text' value="<?php echo $student[0]['mother_phone']; ?>" name="mother_phone" >
                </div>
            </div>
             
            <div class='row' style='padding-top:50px;'>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                    <div style='padding-top:0px;padding-bottom:10px;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary" style='width:90%;height:40px;background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                    <div id='pad' style='color:green;'>
                            <h3><?php echo $this->session->flashdata('error'); ?></h3>
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