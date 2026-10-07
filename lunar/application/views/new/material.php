<?php include('header.php');
//  print_r($result);
//  print_r($school);
if($result[0]['clevel']=='3'){
    $lev='State Level';
}
if($result[0]['clevel']=='4'){
    $lev='National Level';
}
?>
<style>
    #corner{
        background-color:white;
        border-radius:20px;
        margin-left:100px;
        margin-right:100px;
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
      text-align: center;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
#heading{
    color:black;
    font-size:18px;
}
</style>
<body>
    <div id='corner'>
        <div style='text-align:center;font-weight:700;'>
             <h2><?php echo $lev;?> Result</h2>
        </div>
        <div style="overflow-x:auto;">
            <table>
                
                   
                
                <tr>
                  <th id='heading'>Student</th>
                  <th id='heading'>Result Details</th>
                
                </tr>
                <tr>
                  <td>CIN</td>
                  <td style='font-size:10px;'><?php echo $result[0]['cin']; ?></td>
                  
                </tr>
                <tr>
                  <td>Product Name</td>
                  <td><?php echo $result[0]['product_name']; ?></td>
                 
                </tr>
                <tr>
                  <td>Grade</td>
                  <td><?php echo $result[0]['grade']; ?></td>
                 
                </tr>
                <tr>
                  <td>Rank</td>
                  <td><?php echo $result[0]['rank']; ?></td>
                 
                </tr>
                <tr>
                  <td>Best Performer</td>
                  <td><?php echo $result[0]['performer']; ?></td>
                 
                </tr>
                <tr>
                    <td>Star Speller</td>
                    <td><?php echo $result[0]['speller']; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $result[0]['status']; ?></td>
                </tr>
                
            </table>
        </div>
        <div>
            <?php 
            if($result[0]['status']=='Q'){
                if(!empty($material)){
                    ?>
                    <div id='corner'>
                        <form method='post' action='<?php echo base_url()?>Neww/paid_material/'>
                            <input style='display:none;' name='file_name' type='text' value='<?php echo $material_free[0]['folder']; ?>' >
                    
                            <div style="overflow-x:auto;">
                                
                                <table style=''>
                                    <tr>
                                        <th id='heading'>Paid Study Material Download</th>
                                        <th id='heading'>Price</th>
                                        <th id='heading'>
                                            <div style='' >
                                                <button type="submit" name="paid" id="paid" class="btn btn-primary" style='width:100%;height:40px;background-color:#ff6600;font-size:15px;'>Buy</button> 
                                            </div>
                                        </th>
                                    </tr>
                                    
                                </table>
                            
                            </div>
                        </form
                    <?php
                }else{
                    ?>
                    <div id='corner'>
                            <form method='post' action='<?php echo base_url()?>Neww/paid_material/'>
                                <input style='display:none;' name='file_name' type='text' value='<?php echo $material_free[0]['folder']; ?>' >
                        
                                <div style="overflow-x:auto;">
                                    
                                    <table style=''>
                                        <tr>
                                            <th id='heading'>Paid Study Material Download</th>
                                            <th id='heading'>=</th>
                                            <th id='heading'>
                                                <div style='' >
                                                    <?php echo 'Material available soon...';?>
                                                </div>
                                            </th>
                                        </tr>
                                        
                                    </table>
                                
                                </div>
                            </form>
                        </div>
                    <?php
                }
                if(!empty($material_free)){
                    ?>
                    <div id='corner'>
                        <form method='post' action='<?php echo base_url()?>Neww/free_material/'>
                            <input style='display:none;' name='file_name' type='text' value='<?php echo $material_free[0]['folder']; ?>' >
                    
                            <div style="overflow-x:auto;">
                                
                                <table style=''>
                                    <tr>
                                        <th id='heading'>Free Study Material Download</th>
                                        <th id='heading'>=</th>
                                        <th id='heading'>
                                            <div style='' >
                                                <button type="submit" name="free" id="free" class="btn btn-primary" style='width:100%;height:40px;background-color:#ff6600;font-size:15px;'>Download</button> 
                                            </div>
                                        </th>
                                    </tr>
                                    
                                </table>
                            
                            </div>
                        </form>
                    </div>
                    <?php
                }
                else{ ?>
                    <div id='corner'>
                            <form method='post' action='<?php echo base_url()?>Neww/free_material/'>
                                <input style='display:none;' name='file_name' type='text' value='<?php echo $material_free[0]['folder']; ?>' >
                        
                                <div style="overflow-x:auto;">
                                    
                                    <table style=''>
                                        <tr>
                                            <th id='heading'>Free Study Material Download</th>
                                            <th id='heading'>=</th>
                                            <th id='heading'>
                                                <div style='' >
                                                    <?php echo 'Material available soon...';?>
                                                </div>
                                            </th>
                                        </tr>
                                        
                                    </table>
                                
                                </div>
                            </form>
                        </div>
                
                <?php 
                }
                
            }
                
                
               
                ?>
            
        </div>
    </div>
</body>

<?php include("footer.php");?>