<?php include('header.php');

// print_r($student['stud_email']);
// print_r($_SESSION);
?>
 <!--<a href="<?php echo base_url();?>cin_login/api_call/<?php echo '1';?>" class="btn btn-outline-success my-2">Ok</a>-->
                                
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


body{
    background: #f7f7ff;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
.detail{
    width:200px;
        font-size: 0.8rem;
    padding-left: 3%;
}
/*.detail:hover{*/
/*    width:100%;*/
/*}*/

</style>
  <section>
      
<?php 
      
        if($student['stud_email'] == ''){?>
      <marquee><h5 style='color:crimson;'>Please Update your Email... </h5></marquee>
<?php 

        echo $student['stud_email'];
          
        }if($student['stud_phone'] == ''){?>
      <marquee><h5 style='color:crimson;'>Please Update your Mobile... </h5></marquee>
<?php 
            
        } 
            
?>
      

    </section>

</section>
    <div class="container my-3">
		<div class="main-body">
			<div class="row">
			    <div class="text-start">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
                
                <div class="row my-2">
								
								<div class="col-sm-12  text-center">
									<h4 class="text-danger"><?php echo 'Lunar Skill Test'; ?></h4>
								</div>
							</div>
                
                
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center mb-2" style="border-bottom: 1px solid #ffc107;">
								<img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="Admin" class="rounded-circle p-1 bg-light" width="110">
								<div class="mt-3">
									<h4><?php echo $student['student_name']; ?></h4>
									<p class="text-secondary mb-1">Student</p>

								</div>
							</div>
							<ul class="list-group list-group-flush">
							    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0 d-flex align-items-center"><i class="fa-solid fa-chalkboard-user"></i>&nbsp;&nbsp;Class</h6>
									<span class="text-secondary detail"><?php echo $student['class']; ?></span>
								</li>
							    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0 d-flex align-items-center"><i class="fa-solid fa-school"></i>&nbsp;&nbsp;School</h6>
									<span class="text-secondary detail"><?php echo $student['school_name']; ?></span>
								</li>
							    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0 d-flex align-items-center">&nbsp;<i class="fa-solid fa-mobile-screen"></i>&nbsp;&nbsp;&nbsp;Mobile</h6>
									<span class="text-secondary detail"><?php if(!empty($student['stud_phone'])){echo $student['stud_phone'];}else{echo 'NA';} ?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h6 class="mb-0 d-flex align-items-center"><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email</h6>
									<span class="text-secondary detail"><?php if(!empty($student['stud_email'])){echo $student['stud_email'];}else{echo 'NA';}  ?></span>
								</li>
						
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<!--<div class="card">-->
					<!--	<div class="card-body">-->

					<!--		<div class="row my-2">-->
								
					<!--			<div class="col-sm-12  text-center">-->
					<!--				<h4 class="text-danger"><?php echo 'MaRRS Lunar Olympiads'; ?></h4>-->
					<!--			</div>-->
					<!--		</div>-->
						
					<!--	</div>-->
					<!--</div>-->
					
					
					<div class="card">
						<div class="card-body">

							<div class="row my-2">
								
								<div class="col-sm-12 ">
									<h4 class="text-primary"><?php echo 'Search Result'; ?></h4>
								</div>
								<form method='POST' class="row text-center">
    								<div class="col-sm-4">
    								   <select name='level' class="form-control" required>
    								       <option value=''>-- select level --  ▼</option>
    								       <?php foreach($levels as $level){?>
    								            <option value='<?php echo $level['level_id']; ?>' <?php if($level['level_id']==$result['level']){ ?> selected="selected" <?php } ?> ><?php echo $level['level_name']; ?></option>
    								       <?php } ?>
    								   </select>
    								</div>
    								
    								<div class="col-sm-4">
    								   <select name='series' class="form-control" required>
    								       
    								       <?php
    								       if(!empty($series)){ ?>
    								       <option value=''>-- select series -- ▼</option>
    								       <?php
    								            foreach($series as $level){?>
    								            <option value='<?php echo $level['series']; ?>' <?php if($level['series']==$result['series']){ ?> selected="selected" <?php } ?> ><?php echo $level['subject'].'-'.$level['series'].' '.$level['type']; ?></option>
    								       <?php 
    								       
    								            } 
    								       }else{
    								       ?>
    								       <option value=''>Error: No Result available.</option>
    								       <?php } ?>
    								   </select>
    								</div>
    								
    								<div class="col-sm-4">
    								   <button type="submit" class="btn btn-primary" name="submit">Search</button>
    								</div>
							    </form>	
							</div>
						
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
								    
								    								    <?php
//   for ($i = 1; $i <= $length; $i++) {.
// print_r($result_array);
if (!empty($result_array)) {
    $row = $result_array; // Assuming $result_array contains a single row.

    ?>
    <h5 class="d-flex align-items-center mb-3">Results</h5>
    <?php

    if ($row['show'] == '') {
        echo '
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        ' . str_replace("_", " ", $row['level_name']) . ' RESULT
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table">
                            <thead id="t_head">
                                <tr>
                                    <th>Title</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tr>
                                <td width="250px" style="font-weight:500;">CIN</td>
                                <td style="color:#1aa3ff;">' . $row["cin"] . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">GRADE</td>
                                <td style="color:#1aa3ff;">' . $row["grade"] . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">RANK</td>
                                <td style="color:#1aa3ff;">' . $row["rank"] . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">CHAMPIONSHIP POINTS</td>
                                <td style="color:#1aa3ff;">' . $row["marks"] . '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">BEST PERFORMER</td>
                                <td style="color:#1aa3ff;">';
                                
        if ($row['performer'] == 'Yes' || $row['performer'] == 'YES') {
            echo '<a href="' . base_url() . "Cin_login/api_callb/" . $row['clevel'] . '/' . $row['competition_schedule_id'] . '" class="btn btn-outline-warning my-2">Download</a>';
        } else {
            echo 'No';
        }

        echo '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">STAR SPELLER</td>
                                <td style="color:#1aa3ff;">';

        if ($row['speller'] == 'Yes' || $row['speller'] == 'YES') {
            echo '<a href="' . base_url() . "Cin_login/api_calls/" . $row['clevel'] . '/' . $row['competition_schedule_id'] . '" class="btn btn-outline-danger my-2">Download</a>';
        } else {
            echo 'No';
        }

        echo '</td>
                            </tr>
                            <tr>
                                <td style="font-weight:500;">DOWNLOAD CERTIFICATE</td>
                                <td style="color:#1aa3ff;">';

        if ($row['status'] != '') {
            echo '<a href="' . base_url() . "Cin_login/api_call_lunar/" . $row['clevel'] . '/' . $row['competition_schedule_id'] . '" class="btn btn-outline-primary my-2">Download</a>';
        } else {
            echo 'No Status Available.';
        }

        echo '</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="background-color:#ffffb3;text-align:center;">';

        $this->db->select("level_name");
        $this->db->from("competition_level_byproduct");
        $this->db->where("product_name", $row["product_name"]);
        $this->db->where("level_id >", $row["clevel"]);
        $this->db->order_by("level_id", "ASC");
        $query = $this->db->get();
        // echo $this->db->last_query();
        $result = $query->row_array();

        if ($row["status"] == 'Q') {
            
            if($row["rank"]!=''){
                echo "<h5 style='color:green;'>Congratulations!!! You are winner at " . str_replace("_", " ", $row['level_name']) . ".</h5>";
            }
            
        } else {
            echo "<h5 style='color:crimson;'>";
            echo ($row["status"] == 'NQ') ? "Sorry, Better Luck Next Time!" : "No Status Available.";
            echo "</h5>";
        }

        echo '</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>';
    } else {
        if ($row['status'] != 'NQ') {
            echo '
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ' . str_replace("_", " ", $row['level_name']) . ' RESULT
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">';

            $this->db->select("level_name");
            $this->db->from("competition_level_byproduct");
            $this->db->where("product_name", $row["product_name"]);
            $this->db->where("level_id >", $row["clevel"]);
            $this->db->order_by("level_id", "ASC");
            $query = $this->db->get();
            $result = $query->row_array();

            echo 'Promoted To :- ' . $row['level_name'];

            echo '
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
elseif($ok=='show'){
    echo '"Results will be announced soon."';
}

elseif($ok=='') {
    echo '"Select Level And Series."';
    
}


 ?>


									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




<?php include("footer.php");?>