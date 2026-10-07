<?php include('header.php');//echo"<pre>"; print_r($state_wise_schools);exit;?>
    <?php echo $this->notifications->display_html();?>
        <div>
            <ul class="breadcrumb">
                <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
                <li>Shool List</li>
            </ul>
        </div>
        <form method="POST">
            <div>

                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> School List</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="control-group">
                            <div class="controls">

                                <table cellpadding="5px">
                                    <tr>

                                        <td valign="top">School Code <span style="color:#F00">*</span>
                                            <br />

                                            <!--    -----------  STATE ---------------    -->
                                            <select name="school_code" id="school_code" style="width:200px;">
                                                <option value="">- Select Code -</option>
                                                <?php

  foreach($schoolcode as $school)
  {

  ?>
                                                    <option value="<?php echo $school['access_code']; ?>">
                                                        <?php echo $school['access_code']; ?>
                                                    </option>
                                                    <?php
}
?>
                                            </select>
                                            <span style="color:#F00"><?php echo $this->validation->show_error('access_code',"school code Required.");?></span>

                                        </td>

                                     
                                        <!--    -----------  FRANCHISE ---------------    -->

                                       

                                        <!--    -----------  SCHOOL ---------------    -->
                                       
                                    </tr>
                                </table>

                                <!--    -----------  BUTTON ---------------    -->
                                <br>
                                <button type="submit" class="btn btn-primary" id="Search" name="Search">Search</button>
                                <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>school/'">Reset</button>
                            </div>
                            <!--End DIV for class="controls" -->
                        </div>
                        <!--End DIV for class="control-group"-->
                        <br>
                        <!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->

                        <?php 
                        $status = $schools['status'];
                        // $status; exit;
      $list = $schools['schools'];
   /* echo "<pre>";print_r($school);exit;*/

       switch($status):

     case "No_data_found":?>

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Information!</strong> No record(s) found.
                            </div>

                            <?php  break;

     case "Data_found" : ?>
                               
                                <div align="right">
                                    <button type="submit" class="btn btn-primary" id="Export" name="Export">Export Excel</button>
                                </div>
                                <table class="table table-bordered" width="75%">
                                    <thead>
                                        <tr>
                                            <th>Slno</th>
                                            <th>School Code</th>
                                            <th>School Name</th>
                                            <th>State</th>
                                            <th>District</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i=1; foreach($list as $value){  ?>
                                            <tr>
                                                <td width="5%">
                                                    <?php echo $i; ?>
                                                </td>
                          
                                                <td width="15%" class="center">
                                                    <?php echo $value['access_code']; ?>
                                                    <input type="hidden" name="code" value="<?php echo $value['access_code']; ?>">
                                                </td>
                                                <td width="15%">
                                                    <?php echo $value['school']; ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $value['state']; ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $value['district']; ?>
                                                </td>
                                                

                                                <!--<td  width="20%"class="center">
                    <a class="btn btn-success" href="<?php echo SITE_URL?>school/view/id/<?php echo $value['school_id']; ?>" title="View" target="_blank">
                       VIEW <i class="icon-zoom-in icon-white"></i> 

                    </a> 
                    <a class="btn btn-info" href="<?php echo SITE_URL?>school/edit/id/<?php echo $value['school_id']; ?>" title="Edit" target="_blank">
                       EDIT <i class="icon-edit icon-white"></i>  

                    </a>

                </td>-->
                                            </tr>
                                            <?php $i=$i+1; } ?>
                                    </tbody>
                                </table>
                                <?php break; endswitch;?>

                    </div>
                    <!--End DIV for class="box-content"-->
                </div>
                <!--/span-->
            </div>
            <!--/row-->
        </form>
        <?php include('footer.php'); ?>
            <?php 
  //$this->confirmation->confirm('delete');
?>
               