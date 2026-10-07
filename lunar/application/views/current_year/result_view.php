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

<body>
    
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
					
					
					<div class="card">
						<div class="card-body">

							<div class="row my-2">
								
								<div class="col-sm-12 ">
									<h4 class="text-primary"><?php echo 'Search Result'; ?></h4>
								</div>
								
								<form method='POST' class="row text-center">
								    
    								<div class="col-sm-3">
    								   <select name='level' class="form-control" required>
    								       <option value=''>-- select level --</option>
    								       <?php foreach($levels as $level){?>
    								            <option value='<?php echo $level['level_id']; ?>' <?php if($level['level_id'] == $result['level']){ ?> selected="selected" <?php } ?> ><?php echo $level['level_name']; ?></option>
    								       <?php } ?>
    								   </select>
    								</div>
    								
    								<div class="col-sm-3">
    								   <select name='subject' class="form-control"  id='subject' required>
    								       
    								       <?php
    								       if(!empty($subjects)){ ?>
    								       <option value=''>-- select subject --</option>
    								       <?php
    								            foreach($subjects as $subject){?>
    								            <option value='<?php echo $subject['sub_id']; ?>' <?php if($subject['sub_id'] == $result['subject']){ ?> selected="selected" <?php } ?> ><?php echo $subject['subject_key']; ?></option>
    								       <?php 
    								        
    								            } 
    								       }
    								       ?> 
    								       
    								   </select>
    								</div>
    								
    								<div class="col-sm-3">
    								   <select name='varient_name' class="form-control" id='varient_name' required>
    								       
    								       <?php
    								       if(!empty($varients)){ ?>
    								       <option value=''>-- select varient --</option>
    								       <?php
    								            foreach($varients as $vari){?>
    								            <option value='<?php echo $vari['varient_name']; ?>' <?php if($vari['varient_name'] == $result['varient_name']){ ?> selected="selected" <?php } ?> ><?php echo $vari['varient_name']; ?></option>
    								       <?php 
    								        
    								            } 
    								       }
    								       ?> 
    								       
    								   </select>
    								</div>
    								
    								
    								<div class="col-sm-3">
    								   <button type="submit" class="btn btn-primary" name="search">Search</button>
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
                                    
                                    
                                        if (!empty($result_array)) {
                                        
                                            $row = $result_array;
                                        
                                            echo "<h5 class='d-flex align-items-center mb-3'>Results</h5>";
                                        
                                            if (empty($row['show'])) {
                                        
                                        ?>
                                        
                                        <div class="accordion">
                                            <div class="accordion-item">
                                        
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse">
                                                        <?= str_replace("_", " ", $row['level_name']) ?> RESULT
                                                    </button>
                                                </h2>
                                        
                                                <div class="accordion-body">
                                        
                                                    <table class="table">
                                        
                                                        <tr>
                                                            <td width="250"><b>CIN</b></td>
                                                            <td style="color:#1aa3ff;"><?= $row["cin"] ?></td>
                                                        </tr>
                                        
                                                        <tr>
                                                            <td><b>GRADE</b></td>
                                                            <td style="color:#1aa3ff;"><?= $row["grade"] ?></td>
                                                        </tr>
                                        
                                                        <tr>
                                                            <td><b>RANK</b></td>
                                                            <td style="color:#1aa3ff;"><?= $row["rank"] ?></td>
                                                        </tr>
                                        
                                                        <tr>
                                                            <td><b>CHAMPIONSHIP POINTS</b></td>
                                                            <td style="color:#1aa3ff;"><?= $row["marks"] ?></td>
                                                        </tr>
                                        
                                                        <tr>
                                                            <td><b>BEST PERFORMER</b></td>
                                                            <td>
                                        
                                                                <?php if (strtoupper($row['performer']) === 'YES'): ?>
                                        
                                                                    <a href="<?= base_url("Cin_login/api_callb/{$row['clevel']}/{$row['competition_schedule_id']}") ?>"
                                                                       class="btn btn-outline-warning my-2">Download</a>
                                        
                                                                <?php else: ?>
                                                                    No
                                                                <?php endif; ?>
                                        
                                                            </td>
                                                        </tr>
                                        
                                        
                                                        <tr>
                                                            <td><b>STAR SPELLER</b></td>
                                                            <td>
                                        
                                                                <?php if (strtoupper($row['speller']) === 'YES'): ?>
                                        
                                                                    <a href="<?= base_url("Cin_login/api_calls/{$row['clevel']}/{$row['competition_schedule_id']}") ?>"
                                                                       class="btn btn-outline-danger my-2">Download</a>
                                        
                                                                <?php else: ?>
                                                                    No
                                                                <?php endif; ?>
                                        
                                                            </td>
                                                        </tr>
                                        
                                        
                                                        <tr>
                                                            <td><b>DOWNLOAD CERTIFICATE</b></td>
                                                            <td>
                                        
                                                                <?php if (!empty($row['status'])): ?>
                                        
                                                                    <a href="<?= base_url("Cin_login/api_call_lunar/{$row['clevel']}/{$row['competition_schedule_id']}") ?>"
                                                                       class="btn btn-outline-primary my-2">Download</a>
                                        
                                                                <?php else: ?>
                                                                    No Status Available
                                                                <?php endif; ?>
                                        
                                                            </td>
                                                        </tr>
                                        
                                        
                                                        <tr>
                                                            <td colspan="2" style="background:#ffffb3;text-align:center;">
                                        
                                                                <?php if ($row["status"] === 'Q'): ?>
                                        
                                                                    <h5 style="color:green;">
                                                                        Congratulations!!! You are winner at <?= $row['level_name'] ?>.
                                                                    </h5>
                                        
                                                                <?php else: ?>
                                        
                                                                    <h5 style="color:crimson;">
                                                                        Great Effort! Every Challenge Makes You Stronger 🚀
                                                                        <br>Keep practicing and come back stronger!
                                                                    </h5>
                                        
                                                                <?php endif; ?>
                                        
                                                            </td>
                                                        </tr>
                                        
                                                    </table>
                                        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                            } else {
                                        
                                                if ($row['status'] !== 'NQ') {
                                        
                                                    echo "<h4>Promoted To :- {$row['level_name']}</h4>";
                                                }
                                            }
                                        
                                        } else {
                                        
                                            echo "No result found.";
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



<script src="jquery-1.8.3.min.js"></script>


<script>

    $("#subject").change(function(){
    		   
    	//alert(this.value);
        var sub_id=this.value;
        $.ajax({
            url: "https://marrs.in/lunar/result/getsubjectvarient/",
            data:{sub_id:sub_id},
            type: 'post',
            success:function(result){
    			// alert(result);
                 $("#varient_name").html(result);
        }});
    });
    
</script>

</body>

<?php include("footer.php");?>