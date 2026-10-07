<?php $this->load->view('header.php');
// print_R($result);

?>
<body>


<div class='container'>
<div style='font-size:18px;margin-top:40px;height:auto' id='corner'>
    <div class='container-fluid'>
        <div class="row mt-3">
            <div class="col">
           
        <div class="card mb-3" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);background: transparent;">
            <div class="card-body text-center">
                <form class="row gy-2 gx-3 align-items-center"  method='POST'>
                    
                    <div class="col-auto"><p class="mt-2">Enter registered email or mobile number</p></div>
                  <div class="col-auto">
                     <input type="text" class="form-control rounded-2" name="value" id="formGroupExampleInput" placeholder="Without +91" value='<?php if(isset($result['value'])){echo $result['value']; }?>'>
                  </div>
                  <div class="col-auto"><p class="mt-2">Year</p></div>
                  <div class="col-auto">
                    <select name="year" class="form-control rounded-2" required>
                           <option value="24"<?php if(isset($result['year']) && $result['year']=='24'){?> selected="selected" <?php }?>>2024</option>
                           <option value="23" <?php if(isset($result['year']) && $result['year']=='23'){?> selected="selected" <?php }?>>2023</option>
                           <option value="22" <?php if(isset($result['year']) && $result['year']=='22'){?> selected="selected" <?php }?>>2022</option>
                      </select>
                  </div>
                  <div class="col-auto">
                    <input type="submit" name='submit' value="Submit" class="btn btn-danger rounded-2">
                  </div>
                  </form>
            </div>
        </div>
       
</div>
        <!--<div id='top'>-->
           
        <!--        <h1>Enter Email or Mobile</h1>-->
        <!--        <form >-->
        <!--            <input type='text' name='value' placeholder='Without +91'>-->
        <!--            <input type='submit' name='submit' class='btn btn-primary'>-->
        <!--        </form>-->
           
        <!--</div>-->
        
        <?php if(!empty($cin)){ ?>
        <div class='row' >
                       
                        
                         <div class="col-12">
                            <h5>
                            Search Parameter: <?php echo $value; ?>
                        
                        </h5>
                           
                       </div>
            <div class='col-sm-12' >
          
                    <table class="table table-bordered" style="width:100%;border-left: solid 1px #d9d1d1;">
                        
                      <thead>
                        <tr style="">
                            <th  style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Student Name</th>                         
                          
                            <th style=" text-indent:15px; padding-bottom:10px; padding-top:10px;"><b>Product Name</b> </th>
                            <th  style=" text-indent:15px; padding-bottom:10px; padding-top:10px;"><b>CIN</b></th>
                                          
                        </tr>
                        <!--</th>-->
                          
                      </thead>
                      <tbody>
                        <?php foreach($cin as $cins){ //print_r($cins); ?>
                        <tr >
                            <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cins['student_name'];?></td>
                          <td style="padding-top:10px; padding-bottom:10px;"><?php echo $cins['product_name'];?></td>
                          <td style=" padding-top:10px; padding-bottom:10px;"><a style="color:#FFF" href="<?php echo base_url();?>welcome/logintopage/<?php echo $cins['cin'];?>"><?php echo $cins['cin'];?></a></td>
                          
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                     </table>
            </div>  
            
            <div class="col-12" stye='text-align:center;'><h6>If you found some issue or query consult with school or write us mail.</h6></div>
            
                 <a href="https://marrs.in/" style='text-decoration:none;font-size:25px;color:#fff'><h5>BACK TO HOME </h5></a>
               

            
    
            </div>
            <?php }else{ ?>
            <div class="col-12" style='text-align:center;height:60vh;'>
                <?php if($this->session->flashdata('error')){ ?>
                <h6><?php echo $this->session->set_flashdata('error'); ?></h6>
                <?php } ?>
                <h6>No data found, check Email or mobile</h6>
                
            </div>
            
            <?php } ?>
        </div>
    </div>
</div>
</div>

</body>



<?php include("footer.php");?>