<?php include('header.php');?>
<form method="POST">
	<div>		
        <div class="box span12">
             <div class="box-header well" data-original-title>
                 <h2><i class="icon-user"></i> Password Reset to CIN</h2>
                 <div class="box-icon">
                      <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                       <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                 </div>
			 </div>
			 <?php echo $this->notifications->display_html();?> 
		     <div class="box-content">
 <!--..................................SEARCH CODE.........................................-->                    
                  <div class="control-group">
				     <div class="controls">
                          <table  cellpadding="5px" >
                             <tr id="tr_details" >
                                 <td>Enter CIN:
                                        <input class="input-large focused" id="cin" name="cin" type="text" 
                                         style="width: 170px; padding: 4px" value="<?php if( isset( $result['cin'] ) )echo $result['cin']; ?>"  > 
                                  </td>
                            </tr> 
                         </table>
                         <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                         <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>accounts/'">Reset</button>	
					</div>
                </div>
                              
<?php if($info=="empty" && isset($_POST['Search'])){ ?>
     <div class="notifications">
         <div class="alert alert-info " id="notification-bar">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h4 class="alert-heading">Information!</h4>
            <p style="color:#F00">Please enter CIN</p>
        </div>
    </div>
<?php } ?>
</div>
</div><!--/span-->
</div>
</form>

<?php include('footer.php'); ?>
