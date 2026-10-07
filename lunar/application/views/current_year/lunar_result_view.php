<?php include('header.php');

// print_r($student['stud_email']);
// print_r($_SESSION);


// echo $cin = $this->session->userdata('cin');
// $this->session->set_userdata('cin',$cin);
       
?>

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
								
								<!--<form method='POST' class="row text-center">-->
								<?php
                                // Safe fallback values
                                $selectedLevel   = $result['level'] ?? '';
                                $selectedSubject = $result['sub_id'] ?? '';
                                $selectedVarient = $result['varient_name'] ?? '';
                                ?>
                                
                                <!--<form method="POST"  class="row text-center">-->
                                <form id="resultSearchForm" class="row text-center">

                                    <div class="col-sm-3">
                                        <select name="level" class="form-control" required>
                                            <option value="">-- select level --</option>
                                
                                            <?php foreach($levels as $level): ?>
                                                <option value="<?= $level['level_id']; ?>"
                                                    <?= ($selectedLevel == $level['level_id']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($level['level_name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                
                                        </select>
                                    </div>
                                
                                
                                    <div class="col-sm-3">
                                        <select name="subject" class="form-control" id="subject" required>
                                
                                            <option value="">-- select subject --</option>
                                
                                            <?php if(!empty($subjects)): ?>
                                                <?php foreach($subjects as $subject): ?>
                                                    <option value="<?= $subject['sub_id']; ?>"
                                                        <?= ($selectedSubject == $subject['sub_id']) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($subject['subject_key']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                
                                        </select>
                                    </div>
                                
                                
                                    <div class="col-sm-3">
                                        <select name="varient_name" class="form-control" id="varient_name" required>
                                
                                            <option value="">-- select varient --</option>
                                
                                            <?php if(!empty($varients)): ?>
                                                <?php foreach($varients as $vari): ?>
                                                    <option value="<?= $vari['varient_name']; ?>"
                                                        <?= ($selectedVarient == $vari['varient_name']) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($vari['varient_name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                
                                        </select>
                                    </div>
                                
                                
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" name="search">Search</button>
                                    </div>
                                
                                </form>
                                

							</div>
						
						</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					
					</div>
			</div>
			
		</div>
		
	</div>



<script src="jquery-1.8.3.min.js"></script>





 <script>

    $(document).ready(function(){
    
        $("#resultSearchForm").on("submit", function(e){
    
            e.preventDefault(); // STOP normal submit
    
            $.ajax({
                url: "<?= base_url('Result/result_view1'); ?>",
                type: "POST",
                data: $(this).serialize(),
    
                success: function(response){
    
                    // OPTION 1 — Replace part of page
                    $("#resultContainer").html(response);
    
                    // OPTION 2 — If returning JSON, parse it
                    // let data = JSON.parse(response);
    
                },
    
                error: function(xhr){
                    console.log(xhr.responseText);
                    alert("Something went wrong.");
                }
    
            });
    
        });
    
    });
    



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