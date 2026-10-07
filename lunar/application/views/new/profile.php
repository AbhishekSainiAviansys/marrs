<?php include('header.php');
// print_r($student);
?>
<style>
#bl{
    color:#000000;
}
table.d {
  table-layout: fixed;
  width: 100%;  
}
th{
    color:#006699;
}
    #corner{
        background-color:white;
        border-radius:40px;
        margin-left:250px;
        margin-right:250px;
        padding-top:0px;
        /*padding-bottom:20px;*/
        font-size:18px;
        color:#3385ff;
        /*border:solid 1px #006699;*/
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
        
    }

    th, td {
      text-align: center;
      padding: 0.5%;
      /*border:solid 1px #006699;*/
      font-size:18px;
      font-weight: 400;
    }

    tr:nth-child(even){background-color: #ffcc80}
    tr:nth-child(odd){background-color: #ffffb3}
    

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
#register{
    background-color:#ffcc80;
    margin-top:5%;
    border-radius:5px;
    padding-left: 7px;
}
</style>
<body>
    <div id='corner'>
        <div style='text-align:center;color:#006699;'>
            <h1 style='font-weight:700;'>Student Profile</h1>
        </div>
        <div>
            <marquee>
                <div style='text-align:center;color:#006699;display:flex;'>
                    <div><h3 style='font-weight:700;'>Registration are open now -- </h3></div>
                    <form method='post' style="padding:2%;">
                        <div id='register'><input type="submit" value="Click Here" name='register' ></div>
                    </form>
                </div>
            </marquee>
        </div>
        <div class="table-responsive" style="overflow-x:auto;">
            <table class="d">
                <!--<tr>-->
                  <!--<th></th>-->
                  <!--<th> Details</th>-->
                
                <!--</tr>-->
                <tr>
                  <th id='bl'>CIN</th>
                  <td><?php echo $student[0]['cin']; ?></td>
                  
                </tr>
                <tr>
                  <th id='bl'>Student Name</th>
                  <td><?php echo $student[0]['student_name']; ?></td>
                 
                </tr>
                <tr>
                  <th id='bl'>Student Class</th>
                  <td><?php echo $student[0]['class']; ?></td>
                 
                </tr>
                <tr>
                  <th id='bl'>Student E-mail</th>
                  <td><?php echo $student[0]['stud_email']; ?></td>
                 
                </tr>
                <tr>
                  <th id='bl'>Student Phone</th>
                  <td><?php echo $student[0]['stud_phone']; ?></td>
                 
                </tr>
                <tr>
                  <th id='bl'>Father Name</th>
                  <td><?php echo $student[0]['father_name']; ?></td>
                 
                </tr>
                <tr>
                    <th id='bl'>Mother Name</th>
                    <td><?php echo $student[0]['mother_name']; ?></td>
                </tr>
                <tr>
                    <th id='bl'>Address</th>
                    <td><?php echo $student[0]['address1']; ?></td>
                </tr>
                <tr>
                    <th id='bl'>School Name</th>
                    <td><?php echo $student[0]['school_name']; ?></td>
                </tr>
                <tr>
                    <th id='bl'>School Address</th>
                    <td><?php echo $student[0]['school_address1']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <!--<div style='text-align:center;padding-bottom:20px;'>-->
    <!--    <div style='text-align:center;color:#006699;'>-->
    <!--        <h2 style='font-weight:700;'>To Register</h2>-->
    <!--    </div>-->
    <!--    <button type="submit" name="register" id="register" class="btn btn-primary" style='width:20%;height:40px;background-color:#ff6600;font-size:15px;'>Click Here</button> -->
    <!--</div>-->
</body>

<?php include("footer.php");?>