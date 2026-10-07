<style>
h3{
    font-weight:700;
    color:#006699;
}
table.d {
  table-layout: fixed;
  width: 100%;  
}
    #corner{
        background-color:white;
        border-radius:20px;
        margin-left:180px;
        margin-right:180px;
        padding-top:0px;
        /*padding-bottom:20px;*/
        margin-top:100px;
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
      padding: 4px;
      border:solid 1px #006699;
      font-size:15px;
      /*width:90px;*/
    }

    /*tr:nth-child(even){background-color: #f2f2f2}*/

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
#heading{
    color:black;
    font-size:17px;
}
#download_free:hover {
  background-color: yellow;
}
</style>
<body>
    <div style='text-align:center;color:#006699;padding-top:40px;'>
             <h1 style='font-weight:700;'>Study Materials</h1>
        </div>
    <div id='corner'>
        <?php 
        if(!empty($material)){ 
                
                ?>
                    <div style="overflow-x:auto;">
                        <form method='post'>
                        <table class="d" >
                            <tr style='text-align:center;background-color:#ffc34d;'>
                                <th id='heading'>Title</th>
                                <th id='heading'>Class</th>
                                <th id='heading'>"Download"</th>
                            </tr>
                             
                                <?php foreach($material as $row){
                               // echo $row['folder'];
                                ?>
                                <tr style=''>
                                   
                                        <!--<input type='text' name='file_name' value='<?php echo $row['folder']; ?>' style='display:none;' >-->
                                        <td><?php echo $row['title']; ?>
                                        
                                        </td>
                                        <td><?php echo 'Class- '.$row['class'];?></td>
                                        <td style='text-align:center;'>
                                            
                                                <div style='padding-left:10px;'><button type="submit" name="download" id="download" class="btn btn-primary" value='<?php echo $row['folder']; ?>' style='width:50%;height:35px;background-color:#ff6600;font-size:15px;'>Download</button></div>
                                                
                                           
                                        </td>
                                   
                                </tr>
                                <?php }?>
                                
                            
                        </table>
                         
                        <div style='padding-top:30px;text-align:center;width:100%;'>
                            <div style='vertical-align: baseline;'>
                                    <button type="submit" name="back" id="back" value='Back' class="btn btn-primary" style='vertical-align: baseline;width:20%;height:35px;background-color:#ff6600;font-size:15px;'><img src='<?php echo base_url();?>images/back.png' style='padding-top:0px;height:30px;'></button>
                                    
                            </div>
                                                
                        </div>
                        </form>
                    </div>
                <?php }?>
    </div>
</body>



