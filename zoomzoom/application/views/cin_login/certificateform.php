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
    
    <form id="myForm" action="<?php echo base_url();?>cin_login/certificate" method="POST" >
        <div class='container-fluid' id='corner1'>
            <div class='row'>
			
			
<!--<div class="alert alert-success text-center">
			  <?php if(!empty($this->session->flashdata('success'))) {
						 echo $this->session->flashdata('success');}
						  
						 ?>
			</div>-->
			
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h2 class="text-center my-4">Provisional Certificate </h2>  
                    <!--<div class="line"></div>-->
                </div>
               
               <?php   $result = $this->db->get_where('period')->result();   ?>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Period ID</label>
              <select  class="form-control" name="period">
			  <?php foreach($result as $value){ ?>
			  <option value="<?php echo $value->period_id;?>"><?php echo $value->period_name;?></option>
			   <?php }?>
			  
			  </select>
               </div>
              <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
			    <?php   $result = $this->db->get_where('competition_levels')->result();   ?>
               <label class="my-1">Competititon Level</label>
                 <select  class="form-control" name="competition_level">
			  <?php foreach($result as $value){ ?>
			  <option value="<?php echo $value->id;?>"><?php echo $value->level_key;?></option>
			   <?php }?>
			  
			  </select>
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