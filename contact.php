

<?php include("header.php");
 ?>
 <style>
.vl {
  border-left: 2px solid ;
  height:50px;
}
#imgggg img {
   width: 300px; 
   height: 300px; 
}

@media (max-width:767px){
#imgggg img {
   width: 200px; 
   height: 200px; 
 }
}
@media only screen and (max-width: 600px){
    #corner {
        width: 100%;
        text-align: center;
        margin:0;
        padding:0;
    }
    #product h1{
        font-size:15px;
    }
   
}
}
</style> 
<div style='padding-top:0px;'></div>
<div id='corner'>
    
    <!--<div  id='product' >-->
     <h1>Contact Us</h1>
    <!--</div>-->
    
    <div class='container-fluid'id='pad'>
        <div class='row'>
            <div class='col-sm-6' style='text-align:left;'>
                <div style='padding-top:30px;' id='imgggg'>
                    <img src='images/contact111.jpg'> 
                </div>
                <div>
                    
                   <h4>Coral ventures <br>
                   Building No. 32/336, Honest Lane,<br>
                   Unichira, Kochi - 682033 

<!--FIRST FLOOR, 8/1798B2, TOWNHALL ROAD, <br>KOOVAPADAM, KOCHI, Ernakulam, Kerala, 682002-->
                  </h4>
                    <h4>E-mail : enquiry@marrs.in</h4>
                    <h4>Mobile No : +91 7012706817</h4> 
                </div>
            </div>
           
            <div class='col-sm-6'>
                <!--<div style='display:flex;'>-->
                    
                    <div>
                        <h3>Your Name</h3>
                        <input type="text" placeholder="Enter your name..."  id="user" name="user"value=""  style='width:70%;height:40px;'>
                    </div>
                    <div>
                        <h3>Your Email</h3>
                        <input type="email" placeholder="Enter your email..."  id="email" name="email"value=""  style='width:70%;height:40px;'>
                    </div>
                <!--</div>-->
                <div>
                    <h3>Your Query</h3>
                    <textarea id="query" name="query" rows="4" cols="50" placeholder='Write Query ..'></textarea>
                </div>
                <div style='text-align:center;padding-top:40px;padding-bottom:40px;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary" style='width:30%;height:40px;background-color:#ff6600;font-size:18px;'>
                        Submit</button> 
                    </div>
            </div>
        </div>
        <!--<div class='row'>-->
            
        <!--</div>-->
        
        <!--<div class='row'>-->
        <!--    <div class='col-sm-6'>-->
        <!--        <h3>Your Name</h3>-->
        <!--        <input type="text" placeholder="Enter name..."  id="user" name="user"value=""  style='width:70%;height:40px;'>-->
        <!--    </div>-->
        <!--    <div class='col-sm-6'>-->
        <!--        <h3>Your Email</h3>-->
        <!--        <input type="email" placeholder="Enter email..."  id="email" name="user"value=""  style='width:70%;height:40px;'>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class='row'>-->
        <!--    <h3>Your Query</h3>-->
        <!--        <textarea id="query" name="query" rows="10" cols="153" ></textarea>-->
        <!--</div>-->
        <!--<div class='row'>-->
        <!--    <div style='text-align:center;padding-top:40px;padding-bottom:40px;' >-->
        <!--                <button type="submit" name="submit" id="submit" class="btn btn-primary" style='width:30%;height:40px;background-color:#ff6600;font-size:18px;'>-->
        <!--                Submit</button> -->
        <!--            </div>-->
        <!--</div>-->
    </div>

     
</div>


<?php include("footer.php"); ?>