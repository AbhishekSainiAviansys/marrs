<?php include('header.php');
//echo $cin;
//print_r($student);
 $length = count($result_array);
 

?>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src= 
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"> 
    </script>
    <link rel="stylesheet" href= 
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
 <style>
/* h5:hover {*/
/*    background: #ffc107;*/
/*}*/
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
    </style>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
  /*border: 1px solid black;*/
  border-collapse: collapse;
}
#t_head{
    background-color:#9bccfa;
    
}

tr:nth-child(even){background-color: #e6f2ff}
</style>
  <section>
      
<?php 
      
        if(empty($student['stud_email'])){?>
      <marquee><h5 style='color:crimson;'>Please Update your Email... </h5></marquee>
<?php 

        echo $student['stud_email'];
          
        }if(empty($student['stud_phone'])){?>
      <marquee><h5 style='color:crimson;'>Please Update your Mobile... </h5></marquee>
<?php 
            
        } 
            
?>
      

    </section>
    
    
    <section class=' container '>
        <div class='row'>
    <div class='col-6 '>
        
        <table class="table table-striped table-hover" >
            <thead style='font-size:15px;font-weight:500;background-color:#9bccfa;' id="t_head">
              <tr>
                <th>Title :</th>
                <th>Details</th>
                <!--<th>Email</th>-->
              </tr>
            </thead>
            <tbody>
                <tr style='background-color:#e6f2ff;'>
                    <td><h5 class="card-title" >Student Name :</h5></td>
                <td><h5><?php echo $student['student_name']; ?></h5></td>
                    
                </tr> 
                <tr>
                    <td><h5 class="card-title">Student Email :</h5></td>
                    <td><h5 ><?php if(!empty($student['stud_email'])){echo $student['stud_email'];}else{echo 'NA';}  ?></h5></td>
                </tr>
                <tr style='background-color:#e6f2ff;'>
                    <td><h5 class="card-title">Student Mobile :</h5></td>
                    <td><h5 ><?php if(!empty($student['stud_phone'])){echo $student['stud_phone'];}else{echo 'NA';} ?></h5></td>
                </tr>
                <tr>
                    <td><h5 class="card-title">Student Class :</h5></td>
                    <td><h5 ><?php echo $student['class']; ?></h5></td>
                </tr>
                <tr style='background-color:#e6f2ff;'>
                    <td><h5 class="card-title">Student School :</h5></td>
                    <td><h5 ><?php echo $student['school_name']; ?></h5></td>
                </tr>
                <tr>
                    <td><h5 class="card-title">Product Name :</h5></td>
                    <td><h5 ><?php echo $result_array[0]['product_name']; ?></h5></td>
                </tr>
        </table>
        
        
        
        
    </div>
    
    
 
    <div class='col-6'
    
        <div style='padding-top:0px;padding-bottom:150px;' class=''>

    <?php
//   for ($i = 1; $i <= $length; $i++) {.
$i=1;
foreach ($result_array as $row) {
    
   // print_r($row);
    echo '
        <div class="card">
            <div class="card-header" id="heading' . $i . '">
                <h5 class="mb-0 float-right">
                    <button style="text-decoration:none;font-weight:600;font-size:12px;" id="button' . $i . '" class="btn btn-link" data-toggle="collapse" data-target="#collapse' . $i . '" onclick="handleButtonClick(\'button' . $i . '\')">
                         ';
                         $outputString = str_replace("_", " ", $row['level_name']);
                         echo $outputString;
                        //  . $row['level_name'] . 
                         
                         echo ' RESULT ▼
                    </button>
                </h5>
            </div>
            <div id="collapse' . $i . '" class="collapse" aria-labelledby="heading' . $i . '">
                <div class="card-body">
                    <table>
                        <thead id="t_head">
                            <th>Title</th>
                            <th>Details</th>
                        </thead>
                        <tr>
                            <td width="250px" style="font-weight:500;">CIN</td>
                            <td style="color:#1aa3ff;">' . $row["cin"] . '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">GRADE</td>
                            <td style="color:#1aa3ff;">' . $row["grade"] . '</td>
                        </tr>';
                        //echo $row['rank'];
                        if(!empty($row['rank'])  ){
                        echo 
                       ' <tr>
                            <td style="font-weight:500;">RANK</td>
                            <td style="color:#1aa3ff;">'
                            . $row['rank'] .'</td>
                        </tr>';
                        }   
                        
                        
                        
                        
                        if( !empty($row['marks']) or $row['marks']!='0'){ echo
                        
                       '<tr>
                            <td style="font-weight:500;">CHAMPIONSHIP POINTS</td>
                            <td style="color:#1aa3ff;">'
                            
                            . $row["marks"] .'</td>
                        </tr>';
                        }   
                        
                        echo
                        '
                        <tr>
                            <td style="font-weight:500;">BEST PERFORMER</td>
                            <td style="color:#1aa3ff;">';
                            
                            if($row['performer']=='Yes' or $row['performer']=='YES'){
                                 ?>
                                
                                <a href="<?php echo base_url();?>Cin_login/special_certificate/<?php  echo 'P_'.$row['clevel']; ?>" class="btn btn-outline-success my-2" value=''>Download</a>
                            <?php    
                                
                            }else{
                               echo "No";
                           }
                           
                           
                            echo '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">STAR SPELLER</td>
                            <td style="color:#1aa3ff;">';
                            
                            if($row['speller']=='Yes' or $row['speller']=='YES'){ ?>
                                
                                <a href="<?php echo base_url();?>Cin_login/special_certificate/<?php  echo 'S_'.$row['clevel']; ?>" class="btn btn-outline-success my-2" value=''>Download</a>
                            <?php    
                            }else{
                               echo "No";
                           }
                           
                           
                            echo '</td>
                        </tr>
                        <tr>
                            <td style="font-weight:500;">DOWNLOAD CERTIFICATE</td>
                            <td style="color:#1aa3ff;">
                                <a href="';  
                                
                                 echo base_url()."Cin_login/download_certificate/".$row['clevel'];
                                
                                echo ' " class="btn btn-outline-primary my-2">Download</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color:#ffffb3;text-align:center;">';

    $this->db->select("level_name");
    $this->db->from("competition_level_byproduct");
    $this->db->where("product_name", $row["product_name"]);
    $this->db->where("level_id >", $row["clevel"]);
    $this->db->order_by("level_id", "ASC");
    $query = $this->db->get();
    $result = $query->row_array();
    // echo $result["level_name"];
    
    if($row["status"]=='Q'){ ?>
        <h5 style='color:green;'>
       <?php  
       $outputString = str_replace("_", " ", $result["level_name"]);

// Output the result
//echo $outputString;
       echo "Congratulations!!! You have qualified to participate in the ".$outputString."."; ?>
        
        </h5>
        <?php
    }else{
        ?>
       <h5 style='color:crimson;'>
       <?php  echo  "Sorry, Better Luck Next Time!"; ?>
        
        </h5> 
        
        
        <?php 
        
    }
    

    echo '</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>';
    $i = $i + 1;
}

 ?>

</div>
    </div>
</div>
</section>
    
<style>
        /* Override Bootstrap's default background color */
        .btn-link.active {
            background-color: red; /* Change to your desired color */
        }
    </style>
    <script>
        // JavaScript function to handle button clicks
        function handleButtonClick(buttonId) {
            // Remove active class from all buttons
            $(".btn-link").removeClass("active");

            // Add active class to the clicked button
            $("#" + buttonId).addClass("active");
        }
    </script>
    
<style>
.btn-link.active {
        background-color: blue; /* Change to your desired color */
        color:white;
        font-weight:600;
    }
</style>



<?php include("footer.php");?>