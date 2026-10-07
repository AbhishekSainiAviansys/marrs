<style>
 #contian{
    background: linear-gradient(to bottom, rgba(10,62,110,1) 0%, rgba(10,61,108,1) 50%, rgba(3,51,91,1) 51%, rgba(3,50,89,1) 100%);
     text-align:center;
    font-size: 20px;
    padding-top: 18px;
    padding-bottom: 18px;
    
 }
 .sidenav {
    padding: 15px;
    background: #007fff;
    font-size: 16px;
     margin-left: 60px;
    margin-top: 8px;
}
 .sidenav a {
   color:#fff;
}
 #coll a{
     color:white;
 }
/*#coll:hover{*/
/*    background-color:#f4f4f4;*/
/*    text-decoration:none;*/
/*    color:rgba(10,62,110,1);*/
/*    color:black;*/
/*}*/
    #coll a:hover{
     color:white;
     /*color:rgba(10,62,110,1);*/
 }

</style>
<div id='contian'>
    <div class='container-fluid' >
        <div class='row'>
            <div class='col-sm-3' id='coll'>
                <div>
                    <a href="<?php echo base_url();?>welcome/out2/id/<?php echo $prid; ?>">PROFILE</a>
                </div>
            </div>
            <div class='col-sm-3' id='coll'>
                <div>
                    <a href="<?php echo base_url();?>welcome/product_purchase/id/<?php echo $prid; ?>">REGISTER NOW</a>
                </div>
                
            </div>
             <div class='col-sm-3' id='coll'>
                <div>
                    <a href="<?php echo base_url();?>welcome/studymaterial/id/<?php echo $prid; ?>">Study Material</a>
                </div>
            </div>
            <div class='col-sm-3' id='coll'>
                <div>
                    <a href="<?php echo base_url();?>welcome/logout/id/<?php echo $prid; ?>">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
error_reporting(E_ALL ^ E_NOTICE);

$this->db->select('*');
            $this->db->from('student_result');
            $this->db->where('PRID', $_SESSION['prid']);
             $this->db->where('clevel','1');
            $query = $this->db->get();
			//echo current_url();exit;  
            $arrrr=$query->row();
          if($arrrr->result=='Q'){
            ?>
            
<div class='col-md-3 sidenav'><a href="<?php echo base_url();?>welcome/not/id/<?php echo $prid; ?>"> Registration Inter-School Level  </a></div>
<div style="text-align:center;color:#ff9900;padding-bottom:20px;"><h2></h2>
       <!-- <marquee><h4>Please note down your PRID (Participent Registration Number) for student login. Also PRID has been sent to your e-mailbox.</h4></marquee> -->
    </div>   
<?php }  ?>
<?php $this->db->select('*');
            $this->db->from('student_result');
            $this->db->where('PRID', $_SESSION['prid']);
             $this->db->where('clevel','2');
            $query = $this->db->get();
            $arrrr=$query->row();
          if($arrrr->result=='Q'){
            ?>
            
<div class='col-md-3 sidenav'><a href="<?php echo base_url();?>welcome/stalelevel/id/<?php echo $prid; ?>"> Registration State Level  </a></div>

<?php }  ?>
<?php $this->db->select('*');
            $this->db->from('student_result');
            $this->db->where('PRID', $_SESSION['prid']);
             $this->db->where('clevel','3');
            $query = $this->db->get();
            $arrrr=$query->row();
          if($arrrr->result=='Q'){
            ?>
            
<div class='col-md-3 sidenav'><a href="<?php echo base_url();?>welcome/not/id/<?php echo $prid; ?>"> Registration National Level  </a></div>

<?php }  ?>
<?php $this->db->select('*');
            $this->db->from('student_result');
            $this->db->where('PRID', $_SESSION['prid']);
             $this->db->where('clevel','4');
            $query = $this->db->get();
            $arrrr=$query->row();
          if($arrrr->result=='Q'){
            ?>
            
<div class='col-md-3 sidenav'><a href="<?php echo base_url();?>welcome/not/id/<?php echo $prid; ?>"> Registration International Level  </a></div>

<?php }  ?>
