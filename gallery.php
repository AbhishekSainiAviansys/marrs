<?php include('headertest.php');?>
<style>


/* Title */

.gallery-hero {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #012c55, #001c39);
  z-index: 1;
}

/* Dotted pattern (CSS only) */
.gallery-hero::before {
  content: "";
  position: absolute;
  inset: 0;

  background-image: radial-gradient(rgba(255,255,255,0.15) 1px, transparent 1px);
  background-size: 18px 18px;

  opacity: 0.6;
  z-index: 0;
}

/* Light glow overlay */
.gallery-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.15), transparent 40%),
              radial-gradient(circle at 80% 70%, rgba(245,124,53,0.25), transparent 50%);
  z-index: 0;
}

/* Content above layers */
.gallery-hero .container {
  position: relative;
  z-index: 1;
}

/* Heading polish */
.gallery-hero h1 {
  letter-spacing: 1px;
  text-shadow: 0 4px 15px rgba(0,0,0,0.4);
}

/* Filter Buttons */
.filter-button {
    border: 1px solid #ddd;
    background: #fff;
    color: #555;
    padding: 8px 18px;
    margin: 5px;
    border-radius: 50px;
    font-size: 14px;
    transition: 0.3s;
}

.filter-button:hover,
.filter-button.active {
    background: #F57C35;
    color: #fff;
    border-color: #F57C35;
    box-shadow: 0 4px 12px rgba(245,124,53,0.3);
}

/* Card Style */
/*.gallery_product {*/
/*    position: relative;*/
/*    border-radius: 14px;*/
/*    overflow: hidden;*/
/*    background: #fff;*/
/*    box-shadow: 0 8px 20px rgba(0,0,0,0.06);*/
/*    transition: 0.3s;*/
/*}*/

/*.gallery_product:hover {*/
/*    transform: translateY(-6px);*/
/*}*/

/* Image */
/*.gallery_product img {*/
/*    width: 100%;*/
/*    height: 220px;*/
/*    object-fit: cover;*/
/*    transition: 0.4s;*/
/*}*/

/* Zoom effect */
/*.gallery_product:hover img {*/
/*    transform: scale(1.08);*/
/*}*/

/* Overlay */
/*.img-info {*/
/*    position: absolute;*/
/*    inset: 0;*/
/*    background: linear-gradient(to top, rgba(0,0,0,0.75), rgba(0,0,0,0.2));*/
/*    color: #fff;*/
/*    display: flex;*/
/*    align-items: flex-end;*/
/*    justify-content: center;*/
/*    text-align: center;*/
/*    opacity: 0;*/
/*    transition: 0.3s;*/
/*    padding: 15px;*/
/*}*/

/*.gallery_product:hover .img-info {*/
/*    opacity: 1;*/
/*}*/

/*.img-info h4 {*/
/*    font-size: 14px;*/
/*    font-weight: 500;*/
/*}*/

/* Caption link */
/*.gallery a:last-child {*/
/*    display: block;*/
/*    margin-top: 8px;*/
/*    font-size: 14px !important;*/
/*    font-weight: 500;*/
/*    color: #333;*/
/*    text-decoration: none;*/
/*    transition: 0.3s;*/
/*}*/

/*.gallery a:last-child:hover {*/
/*    color: #F57C35;*/
/*}*/

/* Banner */
/*.banner {*/
/*    background: #fff;*/
/*    border-radius: 14px;*/
/*    padding: 10px;*/
/*    box-shadow: 0 6px 20px rgba(0,0,0,0.05);*/
/*}*/

/* Responsive spacing */
/*@media (max-width: 768px) {*/
/*    .gallery-title {*/
/*        font-size: 22px;*/
/*    }*/
/*}*/
/* COLLAGE GRID */
.gallery-grid {
  column-count: 4;
  column-gap: 16px;
  padding: 10px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
  .gallery-grid { column-count: 3; }
}

@media (max-width: 768px) {
  .gallery-grid { column-count: 2; }
}

@media (max-width: 480px) {
  .gallery-grid { column-count: 1; }
}

/* EACH ITEM */
.gallery-item {
  break-inside: avoid;
  margin-bottom: 16px;
}

/* IMAGE */
.gallery_product img {
  width: 100%;
  height: auto;   /* 🔥 important for collage */
  border-radius: 14px;
}
/* FIX ITEM WRAPPER */
.gallery-item,
.filter {
  break-inside: avoid;
  margin-bottom: 16px;
}

/* IMAGE CARD */
.gallery_product {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
}

/* IMAGE */
.gallery_product img {
  width: 100%;
  height: auto;
  display: block;
  transition: 0.4s;
}

/* OVERLAY TEXT ON IMAGE */
.img-info {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: flex-end;
  padding: 16px;

  background: linear-gradient(
    to top,
    rgba(0,0,0,0.75),
    rgba(0,0,0,0.3),
    transparent
  );

  opacity: 0;
  transition: 0.3s ease;
}

/* SHOW TEXT ON HOVER */
.gallery_product:hover .img-info {
  opacity: 1;
}

/* TEXT STYLE */
.img-info h4 {
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  margin: 0;

  transform: translateY(20px);
  transition: 0.3s;
}

.gallery_product:hover .img-info h4 {
  transform: translateY(0);
}

/* IMAGE ZOOM */
.gallery_product:hover img {
  transform: scale(1.08);
}

/* 🔥 HIDE BELOW TEXT (DON’T REMOVE HTML) */
.gallery > a:last-child,
.filter > a:last-child {
  display: none;
}
</style>
<section class="gallery-hero py-5 text-center text-white">
  <div class="container">
    <h1 class="fw-bold display-6">Learning Programs for All Grades</h1>
  </div>
</section>
<section class="my-3">
	<div align="center">
		<button class="filter-button" data-filter="all">All</button>
		<button class="filter-button" data-filter="category1">MISB</button>
		<button class="filter-button" data-filter="category2">MIMB</button>
		<button class="filter-button" data-filter="category3">MISBJ</button>
		<button class="filter-button" data-filter="category4">P2L</button>
		<button class="filter-button" data-filter="category5">PSB</button>
		<button class="filter-button" data-filter="category6">SE</button>
		<button class="filter-button" data-filter="category7">Primary Color</button>
		
	</div>
</section>
<section class="portfolio" id="portfolio" style="padding:20px">
	<div class="container-fluid">
	   
		<div class="gallery-grid">

			<br/>
			<div class="filter gallery-item">
                <div class="gallery_product">
                <a  rel="ligthbox" href="https://photos.app.goo.gl/7cVE3QsY4qSMHVzy8" target="_blank"> 
                    <img class="img-responsive" alt="" src="/images/school_gallery/IMG_5012.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>MaRRS Rediscover International Championship 2024-25</h4>
					
                    </div>
                </a> <br>
             
            </div>
             <a href="https://photos.app.goo.gl/7cVE3QsY4qSMHVzy8" style="font-size:18px" target="_blank">MaRRS National Championship 2024-25 @ Bangalore</a>
                
            </div>
            <div class="filter gallery-item category1 category2">
                <div class="gallery_product">
                <a  rel="ligthbox" href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" target="_blank"> 
                    <img class="img-responsive" alt="" src="/images/school_gallery/SRI02612.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>MaRRS National Championship 2024-25  @ Bangalore</h4>
					
                    </div>
                </a> <br>
             
            </div>
             <a href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" style="font-size:18px" target="_blank">MaRRS National Championship 2024-25 @ Bangalore</a>
                
            </div>
            <div class="gallery-item filter category1">
            <div class="gallery_product">
                <a  rel="ligthbox" href="https://photos.app.goo.gl/LfgDcLC2E3C9b1kBA">
                    <img class="img-responsive" alt="" src="/images/school_gallery/IMG_7061-misb.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>MISB International Championship 17-18@Thane</h4>
					
                    </div>
                </a> <br>
             
            </div>
             <a href="https://photos.app.goo.gl/LfgDcLC2E3C9b1kBA" style="font-size:18px" target="_blank">MISB International Championship 17-18@Thane</a>
                
            </div>
           <div class="filter gallery-item category1">
            <div class="gallery_product">
                <a  rel="ligthbox" href="https://photos.app.goo.gl/3oE255SZSMgYaccB9">
                    <img class="img-responsive" alt="" src="/images/school_gallery/DSC_0288-misb.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>MISB National Championship 17-18 @ Bangalore</h4>
					
                    </div>
                </a>
                <br>	
            </div>
             <a style="font-size:18px" href="https://photos.app.goo.gl/3oE255SZSMgYaccB9" target="_blank">MISB National Championship 17-18 @ Bangalore</a>
           
            </div>
            <div class="filter gallery-item category1">
            <div class="gallery_product ">
                 <a  rel="ligthbox" href="https://photos.app.goo.gl/AVP6Xop2EhX5QYEw7">
                    <img class="img-responsive" alt="" src="/images/school_gallery/9D0A0571-misb.JPG" />
                    <div class='img-info'>
                        <br> 
                        <h4>MISB INTERNATIONAL PRELIMS 18-19 @ DAYANANDA SAGAR COLLEGE</h4>
					
                    </div>
                </a><br>
               
            </div>
            
            
              <a style="font-size:18px" href="https://photos.app.goo.gl/AVP6Xop2EhX5QYEw7" target="_blank">MISB INTERNATIONAL PRELIMS 18-19 @ DAYANANDA SAGAR COLLEGE</a>
           
            </div>
             <div class="filter gallery-item category1">
            <div class="gallery_product">
                 <a  rel="ligthbox" href="https://goo.gl/photos/Guv8v7bX9cKsGCRc8">
                    <img class="img-responsive" alt="" src="/images/school_gallery/SAM_4135-misb.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>GCC Finals 15-16 @ Dubai</h4>
					
                    </div>
                </a><br>
            
            </div>
               <a style="font-size:18px" href="https://goo.gl/photos/Guv8v7bX9cKsGCRc8" target="_blank">GCC Finals AND International Prelims 15-16 @ Dubai</a>
           
         </div>
            <div class="filter gallery-item category2">
         <div class="gallery_product">
                 <a  rel="ligthbox" href="https://photos.app.goo.gl/PQtKAY8CSuKDfh8x7">
                    <img class="img-responsive" alt="" src="/images/school_gallery/OW2A0122-mimb.JPG" />
                    <div class='img-info'>
                        <br>
                        <h4>MIMB International Championship 18/19 @ Bangalore</h4>
					
                    </div>
                </a><br>
             
            </div>
                <a style="font-size:18px" href="https://photos.app.goo.gl/PQtKAY8CSuKDfh8x7" target="_blank">MIMB International Championship 18/19 @ Bangalore</a>
           
            </div>
            <div class="filter gallery-item category7">
             <div class="gallery_product ">
                             <a  rel="ligthbox" href="https://photos.google.com/share/AF1QipNW5IBE50xRCAkDf12cX-vmJoPlngbiJwon8h8YDFEM4HJ5jZowLlOb55o0F_L9Yw?key=cExYWUh6c0dwSkpvRGJPWWpvQy02WjR2UGxzZDFB">
                                <img class="img-responsive" alt="" src="/images/school_gallery/IMG_1089_primary_color.JPG" />
                                <div class='img-info'>
                                    <br>
                                    <h4>Primary Colors International Championship 2021-22 A.M Naik School Powai</h4>
            					
                                </div>
                            </a><br>
                        
                        </div>
                    <a style="font-size:18px" href="https://photos.google.com/share/AF1QipNW5IBE50xRCAkDf12cX-vmJoPlngbiJwon8h8YDFEM4HJ5jZowLlOb55o0F_L9Yw?key=cExYWUh6c0dwSkpvRGJPWWpvQy02WjR2UGxzZDFB" target="_blank">Primary Colors International Championship 2021-22 A.M Naik School Powai</a>
                       
           </div>
            <div class="filter gallery-item category6">
                      <div class="gallery_product ">
                         <a  rel="ligthbox" href="https://photos.google.com/share/AF1QipO3w-OuMZfoq_Sk_7_lAvD3OX9qWARAYp8lNAOHDgw1JFJGeULuErpBcIuG61AHWA?key=SDVBNEMxX0FiU2NHbzZjQVpiRUk5SXVxbEZZVVFR">
                            <img class="img-responsive" alt="" src="/images/school_gallery/IMG_9680_se.JPG" />
                            <div class='img-info'>
                                <br>
                                <h4>SE National Championship 18/19 @Mumbai</h4>
        					
                            </div>
                        </a><br>
                       
                    </div>
                    <a style="font-size:18px" href="https://photos.google.com/share/AF1QipO3w-OuMZfoq_Sk_7_lAvD3OX9qWARAYp8lNAOHDgw1JFJGeULuErpBcIuG61AHWA?key=SDVBNEMxX0FiU2NHbzZjQVpiRUk5SXVxbEZZVVFR" target="_blank">SE National Championship 18/19 @Mumbai</a>
                   
            </div>
         <div class="filter gallery-item category3">
          <div class="gallery_product ">
                         <a  rel="ligthbox" href="https://photos.google.com/share/AF1QipOQqQNaGdS_KUa8OrmnYWx7-Ynz_52Xhit0TIk8FnsHGkkJJ23eX6cwCL6s7cBSSQ/photo/AF1QipOe0GuyLV_4FFdX_H8lPVeAkolzI3vfd0EqRtp3?key=cm1YM3BHX1l3dUg4MGpkRDJkLU9BWktoVkhPTV93">
                            <img class="img-responsive" alt="" src="/images/school_gallery/IMG_8300_misbj.JPG" />
                            <div class='img-info'>
                                <br>
                                <h4>MISB Junior & PSB National Championship 2021-22</h4>
        					
                            </div>
                        </a><br>
                    
                    </div>
              <a style="font-size:18px" href="https://photos.google.com/share/AF1QipOQqQNaGdS_KUa8OrmnYWx7-Ynz_52Xhit0TIk8FnsHGkkJJ23eX6cwCL6s7cBSSQ/photo/AF1QipOe0GuyLV_4FFdX_H8lPVeAkolzI3vfd0EqRtp3?key=cm1YM3BHX1l3dUg4MGpkRDJkLU9BWktoVkhPTV93" target="_blank">MISB Junior & PSB National Championship 2021-22</a>
                   
            </div>



		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php include('footertest.php');?>

	
	<script>
	    $(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }

	        	if ($(".filter-button").removeClass("active")) {
			$(this).removeClass("active");
		    }
		    	$(this).addClass("active");
	    	});
});
/*	end gallery */

$(document).ready(function(){
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
	</script>









