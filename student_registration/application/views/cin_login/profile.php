
<?php include('header.php');
                                                // print_r($_SESSION);


        $mess = '';
        
        $cin = $student[0]['cin'];

        // echo $cin;
        $prefixes = ['25SBAJ', '25SAJ', '25SBAU', '25SJAU', '25SBCG', '25SJCG', ];
        // echo $prefixes;

        if (preg_match('/^(25SBAJ|25SAJ|25SBAU|25SJAU|25SBCG|25SJCG)/', $cin)) {            
        //   echo $cin;  
             
            // $mess = '
            //     <div style="font-family: Arial, Helvetica, sans-serif; max-width: 700px; margin: 0 auto; border: 1px solid #e0e0e0; padding: 20px; background-color: #ffffff;">
                    
            //         <h2 style="color: #b30000; margin-top: 0;">
            //             Rescheduling Notice – MaRRS International Spelling Bee &amp; MISB Junior
            //         </h2>
                
            //         <p style="font-size: 14px; color: #333333; line-height: 1.6;">
            //             Please be informed that due to unavoidable circumstances, the
            //             <strong>Interschool Level Prelims</strong> and
            //             <strong>National Prelims</strong> originally scheduled for
            //             <strong>February 8, 2026</strong>, have been postponed to
            //             <strong>April 2026</strong>.
            //         </p>
                
            //         <p style="font-size: 14px; color: #333333; line-height: 1.6;">
            //             The exact dates will be announced shortly. If you have already registered,
            //             <strong>no further action is required</strong>; your registration remains valid
            //             for the new date. New registrations are still being accepted for the April schedule.
            //         </p>
                
            //         <div style="background-color: #fff4e5; border-left: 5px solid #ff9800; padding: 12px; margin: 20px 0;">
            //             <p style="margin: 0; font-size: 14px; color: #444;">
            //                 <strong>Action Required:</strong><br>
            //                 To ensure you receive critical updates, please log in and update your profile
            //                 with a valid <strong>email address</strong> and <strong>mobile number</strong>.
            //                 We cannot communicate further details without these updated contact points.
            //             </p>
            //         </div>
                
            //         <p style="font-size: 13px; color: #777777;">
            //             Thank you for your cooperation.<br>
            //             <strong>MaRRS REDISCOVER Team</strong>
            //         </p>
                
            //     </div>
            // ';
    
        }
    


// print_r($student[0]['cin']);

// $query5 = $this->db->query("SELECT * FROM `competition_product_state` WHERE clevel='{$nlev}' and period_id='{$period}' and product_name='{$product}' and state_id='{$student[0]['state_id']}' and series='{$student[0]['series']}'and subject='{$student[0]['subject']}' and status='Live' ORDER BY competition_product_state.id DESC;");
// // echo $this->db->last_query();
// if(!empty($query5->row_array())){
//     $result = $query5->result();
    
//     foreach($result as $r){
//         $query = $this->db->query("SELECT * FROM `cin_uploade` WHERE comp_id='{$r->id}' and cin='{$student[0]['cin']}' ;");
//         if(!empty($query->row())){
//             $result = $query->result();
//             $exam_id=$result->id;
//             exit;
//         }
//         $exam_id=0;
//     }
    
//     // $exam_id = $result['id'];
//     $exam='Live';    
// }
// else{
//     $exam='Closed';
// }



// $query5 = $this->db->query("
//     SELECT * 
//     FROM `competition_product_state` 
//     WHERE clevel = '{$nlev}' 
//       AND period_id = '{$period}' 
//       AND product_name = '{$product}' 
//       AND state_id = '{$student[0]['state_id']}' 
      
//       AND status = 'Live' 
//     ORDER BY id DESC;
// ");

// echo $product;

// if($product != 'Lunar Skill Test'){
//     $query5 = $this->db->query("
//         SELECT * 
//         FROM `competition_product_state` 
//         WHERE clevel = '{$nlev}' 
//           AND period_id = '{$period}' 
//           AND product_name = '{$product}' 
          
//           AND status = 'Live' 
//         ORDER BY id DESC;
//     ");
// }
// else{
    
    $this->db->select('cin_result.clevel,cin_result.product_name,competition_level_byproduct.level_name');
    $this->db->from('cin_result');
    $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel','left');
    $this->db->where('cin',$student[0]['cin']);
    $this->db->where('cin_result.product_name',$product);
    $this->db->where('cin_result.status !=','');
    $this->db->order_by('cin_result.id','DESC');
    $query = $this->db->get();
    // $clevel = $query->row();
    // $clevel_id = $clevel->clevel;
    // $product_nameee = $clevel->product_name;
    // $level_name = $clevel->level_name;
    $clevel = $query->row();

if ($clevel) {
    $clevel_id = $clevel->clevel;
    $product_nameee = $clevel->product_name;
    $level_name = $clevel->level_name;
} else {
    $clevel_id = '';
    $product_nameee = '';
    $level_name = '';
}
    if(empty($clevel)){
        $nlev=32;
    }
    
    //  print_r($clevel);
    
    $query5 = $this->db->query("
        SELECT * 
        FROM `competition_product_state` 
        WHERE clevel = '{$nlev}' 
          AND period_id = '{$period}' 
          AND product_name = '{$product}' 
          AND status = 'Live' 
        ORDER BY id DESC;
    ");
    
//print_r($query5);
// }

// Debugging: Uncomment to check the generated query

// echo $this->db->last_query();

$exam_id = 0; // Default valu




if ($query5->num_rows() > 0) {
    $result = $query5->result();
    foreach ($result as $r) {
        $query = $this->db->query("
            SELECT * 
            FROM `cin_uploade` 
            WHERE comp_id = '{$r->id}' 
              AND cin = '{$student[0]['cin']}';
        ");
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $cin_result = $query->row();
            $exam_id = $r->id;
            break; 
        }
    }
    $exam = 'Live';

} else {
    $exam = 'Closed';
}
// echo $exam;

// echo $this->db->last_query();

//print_r($query5->result());die;



    $this->db->select('initials');
    $this->db->from('period');
    $this->db->where('period_id',$period);
    $query=$this->db->get();
    // $r=$query->row();
    // $initials=$r->initials;
    $r = $query->row();
    $initials = $r->initials ?? '';
    // echo $initials;

    $str = str_replace($initials, "", $student[0]['cin']); 
    $firstTwoChars = substr($str, 0, 2);
    

    if($period >= 13){
        // echo $firstTwoChars;
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('in13',$firstTwoChars);
        $query=$this->db->get();
        // $r=$query->row();
        
        // $product_name=$r->product_name;
        $r = $query->row();
        $product_name = $r->product_name ?? '';
    }else{
        
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('in13',$firstTwoChars);
        $query=$this->db->get();
        $r=$query->row();
        $product_name=$r->product_name;
        
    }
    
    // echo $product_name;
    if(!$product_name){
        $this->db->select('product_name');
        $this->db->from('cin_result');
        $this->db->where('cin',$student[0]['cin']);
        $query=$this->db->get();
        $r=$query->row();
        $product_name=$r->product_name;
    }
    
    //$pr_ar = ['MaRRS International Math Bee','MaRRS International Spelling Bee','MaRRS Primary Colors - English','MaRRS Primary Colors - Math','MaRRS Primary Colors - Science','MaRRS Primary Colors - Humanities','MaRRS Play 2 Learn','MaRRS Preschool Bee Humanities','MaRRS Preschool Bee Science','MaRRS Preschool Bee Math','MaRRS Preschool Bee English'];
    // echo $period;
    // echo $exam_id;
    if($period <= 14 && $exam_id == 0 && in_array($product_name, $pr_ar)){
        $exa = $this->db
            ->where('cin', $student[0]['cin'])
            ->order_by('comp_id', 'DESC')
            ->get('cin_uploade')
            ->row();
        $exam_id = $exa->comp_id;
        // $exam = 'Live';
        // print_r($exam_id);
        // echo 'ok';

    }


    // print_r($exam_id);
    
    $this->db->select('image_name');
    $this->db->from('certificate_image');
    $this->db->where('product_name',$product_name);
    $query=$this->db->get();
    $r=$query->row();
    
    // echo $this->db->last_query();
    
     
    // if($r->image_name){
    if(!empty($r) && !empty($r->image_name)){
        $image_name='https://marrs.in/student_registration/certificate_logo/'.$image_name=$r->image_name;
    }
   
    
    // echo $exam_id.'ok';
    if($exam_id!=0){
    $this->db->select('revenue_setting_id,competition_product_state.status');
    $this->db->from('competition_product_state');
    $this->db->where('id',$exam_id);
    $query=$this->db->get();
    $compe = $query->row();
    
    $exam = $compe->status;
        // echo $this->db->last_query();

    // print_r($compe);
    }
    // echo $exam.'ok';
    // $this->db->select('*');
    // $this->db->from('rank_list');
    // $this->db->where('period_id',$period);
    // $this->db->where('product_name',$product_name);
    // // $this->db->where('level_name',$level_name);
    // $this->db->where('class',$student[0]['class']);
    // $query = $this->db->get();
    // $rank_list = $query->result();
// 	 $this->db->select('*');
// $this->db->from('rank_list');

// if (!empty($period)) {
//     $this->db->where('period_id', $period);
// }

// if (!empty($product)) {
//     $this->db->where('product_name', $product);
// }

// if (!empty($level)) {
//     $this->db->where('level_name', $level); // or level_id depending DB
// }

// $this->db->where('class', $student[0]['class']);

// $query = $this->db->get();
// $rank_list = $query->result();   
    
    // echo $this->db->last_query();
    
    // echo $compe->revenue_setting_id;
    // class_category_product
    
     // echo $exam_id.'oj';
?>


<script type = "text/JavaScript">
 <!--
    function AutoRefresh() {
       setTimeout("location.reload(true);",'10000');
    }
 //-->
         
</script>
<!--onload="AutoRefresh('10000')"-->
      
<style>

        /* Buttons */
        .top-actions {
            text-align: center;
            margin-top: 20px;
        }
        
        .top-actions a {
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            margin: 5px;
            font-size: 14px;
        }
        
        .btn-blue {
            border: 1px solid #007bff;
            color: #007bff;
        }
        
        .btn-yellow {
            border: 1px solid #ffc107;
            color: #ffc107;
        }
        
        /* Heading */
        .heading {
            text-align: center;
            margin-top: 10px;
        }
        
        .heading h2 {
            font-size: 28px;
            margin: 5px 0;
        }
        
        .heading span {
            font-size: 22px;
            font-weight: bold;
        }
        
        /* Cards Container */
        .rank-wrapper {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        /* Card */
        .rank-card {
            background: #fff;
            width: 180px;
            padding: 20px 10px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        /* Medal Icon */
        .medal {
            font-size: 40px;
            margin-bottom: 10px;
        }
        
        /* Name */
        .name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        /* School */
        .school {
            font-size: 13px;
            color: #555;
            line-height: 1.4;
        }
        
        /* Medal Colors */
        .gold { color: #f4c542; }
        .silver { color: #c0c0c0; }
        .bronze { color: #cd7f32; }
        
        .form-control-custom {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
      .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Modal Container */
        .congratulations-modal {
            background: white;
            border-radius: 30px;
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.3);
            animation: slideUp 0.6s ease-out 0.2s both;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Confetti Background */
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: sparkleMove 20s linear infinite;
        }

        @keyframes sparkleMove {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(30px, 30px) rotate(360deg); }
        }

        /* Trophy Animation */
        .trophy-container {
            font-size: 5rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            animation: trophyBounce 1s ease-in-out infinite;
        }

        @keyframes trophyBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.1); }
        }

        .modal-title {
            color: white;
            font-size: 2rem;
            font-weight: 800;
            text-shadow: 0 4px 15px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
            animation: titlePulse 2s ease-in-out infinite;
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Modal Body */
        .modal-body {
            /*padding: 3rem 2rem;*/
            text-align: center;
        }

        .achievement-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 1rem 0;
            box-shadow: 0 10px 30px rgba(240,147,251,0.4);
            animation: badgeGlow 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        @keyframes badgeGlow {
            0%, 100% {
                box-shadow: 0 10px 30px rgba(240,147,251,0.4);
            }
            50% {
                box-shadow: 0 10px 40px rgba(240,147,251,0.7);
            }
        }

        .achievement-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            20%, 100% { left: 200%; }
        }

        .star-speller {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            box-shadow: 0 10px 30px rgba(255,215,0,0.4);
        }

        .star-speller::before {
            animation: shine 3s infinite 0.5s;
        }

        .best-performer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 10px 30px rgba(102,126,234,0.4);
        }

        .achievement-icon {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            animation: iconSpin 2s ease-in-out infinite;
        }

        @keyframes iconSpin {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }

        .motivational-text {
            color: #4a5568;
            font-size: 1.2rem;
            line-height: 1.8;
            margin-top: 2rem;
            font-weight: 500;
        }

        /* Close Button */
        .close-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 2rem;
            box-shadow: 0 10px 30px rgba(102,126,234,0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .close-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102,126,234,0.6);
        }

        .close-btn:active {
            transform: translateY(-1px);
        }

        /* Floating Stars */
        .floating-stars {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .star {
            position: absolute;
            font-size: 1.5rem;
            animation: floatStar 3s ease-in-out infinite;
        }

        @keyframes floatStar {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.7;
            }
            50% {
                transform: translateY(-30px) rotate(180deg);
                opacity: 1;
            }
        }

        /*.star:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }*/
        /*.star:nth-child(2) { top: 20%; right: 15%; animation-delay: 0.5s; }*/
        /*.star:nth-child(3) { bottom: 20%; left: 15%; animation-delay: 1s; }*/
        /*.star:nth-child(4) { bottom: 15%; right: 10%; animation-delay: 1.5s; }*/
        /*.star:nth-child(5) { top: 50%; left: 5%; animation-delay: 2s; }*/
        /*.star:nth-child(6) { top: 50%; right: 5%; animation-delay: 2.5s; }*/

        /* Fireworks Effect */
        /*.firework {*/
        /*    position: absolute;*/
        /*    width: 4px;*/
        /*    height: 4px;*/
        /*    border-radius: 50%;*/
        /*    background: white;*/
        /*    animation: fireworkExplode 1s ease-out infinite;*/
        /*}*/

        /*@keyframes fireworkExplode {*/
        /*    0% {*/
        /*        transform: translate(0, 0);*/
        /*        opacity: 1;*/
        /*    }*/
        /*    100% {*/
        /*        transform: translate(var(--x), var(--y));*/
        /*        opacity: 0;*/
        /*    }*/
        /*}*/

        /* Responsive */
        @media (max-width: 768px) {
            .congratulations-modal {
                width: 95%;
            }

            .modal-title {
                font-size: 2rem;
            }

            .trophy-container {
                font-size: 4rem;
            }

            .achievement-badge {
                font-size: 1.1rem;
                padding: 1rem 1.5rem;
            }

            .motivational-text {
                font-size: 1.1rem;
            }
        }
      
      .rank-wrapper {
            background: linear-gradient(135deg, #f9f9f9, #ffffff);
            /*padding: 30px;*/
            border-radius: 14px;
            /*box-shadow: 0 10px 25px rgba(0,0,0,0.08);*/
            margin-top: 20px;
        }
        
        .rank-title {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .rank-subtitle {
            color: #666;
            margin-bottom: 20px;
        }
        
        .rank-table th {
            background: #222;
            color: #fff;
            text-align: center;
        }
        
        .rank-table td {
            text-align: center;
            vertical-align: middle;
            font-size: 15px;
        }
        
        .student-name {
            font-weight: 600;
        }
        
        .top-rank {
            background: #fff8e1;
            font-weight: bold;
        }
        
        .top-rank:nth-child(1) { border-left: 5px solid gold; }
        .top-rank:nth-child(2) { border-left: 5px solid silver; }
        .top-rank:nth-child(3) { border-left: 5px solid #cd7f32; }
        
        .promo-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        
        .promo-footer .brand {
            font-size: 13px;
            opacity: 0.8;
        }

      
        body{
          overflow-x:hidden;
        }
      
        .update{
               text-align: center;
        }
          #profileWrapper h3{
              
          }
          #profileWrapper h4{
              font-size: 18px;
          }
          
        .reg_button .btn,
        .reg_button .btn-success,
        .reg_button .btn-warning,
        .reg_button .btn-warning,
        .reg_button .btn-primary {
            color: #fff;
            animation: glow 1.5s infinite;
        }

        /* Common animation */
        @keyframes glow {
            0%   { box-shadow: 0 0 2px var(--glow-color); background-color: var(--glow-dark); }
            50%  { box-shadow: 0 0 30px var(--glow-color); background-color: var(--glow-light); }
            100% { box-shadow: 0 0 2px var(--glow-color); background-color: var(--glow-dark); }
        }
        
        /* Success (Green) */
        .reg_button .btn-success {
            --glow-color: #00ff00;
            --glow-dark: #008000;
            --glow-light: #00ff00;
        }
        .reg_button .btn-danger {
            --glow-color: #e94013;
            --glow-dark: #db531a;
            --glow-light: #f4911d;
        
        }
        /* Warning (Orange) */
        .reg_button .btn-warning {
            --glow-color: #ffa500;
            --glow-dark: #cc8400;
            --glow-light: #ffa500;
        }
        
        /* Primary (Blue) */
        .reg_button .btn-primary {
            --glow-color: #00bfff;
            --glow-dark: #0000ff;
            --glow-light: #00bfff;
        } 
                  
        

        @keyframes slideInScale {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(30px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Animated Background Pattern */
        .registration-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102,126,234,0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: movePattern 20s linear infinite;
            pointer-events: none;
        }

        @keyframes movePattern {
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(30px, 30px) rotate(360deg); }
        }

       
        .banner-content {
            position: relative;
            z-index: 1;
            text-align: center;
            background: #ffffff;
        }

        /* Exciting Message */
        .banner-title {
            font-size: 1.1rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            /*-webkit-text-fill-color: transparent;*/
            background-clip: text;
            margin-bottom: 0.5rem;
            animation: titlePulse 2s ease-in-out infinite;
            /*text-transform: uppercase;*/
            letter-spacing: 1px;
        }

        @keyframes titlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .banner-subtitle {
            color: #2d3748;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }

        .banner-message {
            color: #4a5568;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .exciting-badge {
            display: inline-block;
            background: linear-gradient(135deg, #ff6b6b, #ff8e53);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: bounce 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* Ultra Glowing Button */
        .glow-btn {
            position: relative;
            display: inline-block;
            padding: 1rem 2rem;
            /*font-size: 1.3rem;*/
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            text-decoration: none;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 
                0 0 20px rgba(102,126,234,0.5),
                0 0 40px rgba(118,75,162,0.3),
                0 10px 30px rgba(0,0,0,0.2);
            animation: glowPulse 2s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% {
                box-shadow: 
                    0 0 20px rgba(102,126,234,0.5),
                    0 0 40px rgba(118,75,162,0.3),
                    0 10px 30px rgba(0,0,0,0.2);
            }
            50% {
                box-shadow: 
                    0 0 40px rgba(102,126,234,0.8),
                    0 0 80px rgba(118,75,162,0.6),
                    0 15px 40px rgba(0,0,0,0.3);
            }
        }

        /* Shine Effect */
        .glow-btn::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 100%;
            height: 200%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: skewX(-25deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            20%, 100% { left: 200%; }
        }

        /* Ripple Effect */
        .glow-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .glow-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        .glow-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 0 50px rgba(102,126,234,0.9),
                0 0 100px rgba(118,75,162,0.7),
                0 20px 50px rgba(0,0,0,0.4);
        }

        .glow-btn:active {
            transform: translateY(-2px) scale(1.02);
        }

        /* Button Content */
        .btn-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }

        .btn-icon {
            font-size: 1.5rem;
            animation: rocketShake 1s ease-in-out infinite;
        }

        @keyframes rocketShake {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }

        /* Floating Elements */
        .floating-star {
            position: absolute;
            font-size: 1.5rem;
            animation: floatStar 3s ease-in-out infinite;
            pointer-events: none;
            padding-top:10%;
        }

        .star-1 { top: 10%; left: 5%; animation-delay: 0s; }
        .star-2 { top: 20%; right: 10%; animation-delay: 0.5s; }
        .star-3 { bottom: 15%;margin-top:20%; left: 8%; animation-delay: 1s; }
        .star-4 { bottom: 20%; right: 5%; animation-delay: 1.5s; }

        @keyframes floatStar {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }
            50% { 
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        /* Limited Time Badge */
        .limited-time {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            animation: shake 0.5s ease-in-out infinite;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-3px); }
            75% { transform: translateX(3px); }
        }

        .limited-time i {
            font-size: 1.2rem;
            animation: pulse 1s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .registration-banner {
                padding: 2rem 1.5rem;
            }

            .banner-title {
                font-size: 1rem;
            }

            .banner-subtitle {
                font-size: 1.1rem;
            }

            .banner-message {
                font-size: 0.95rem;
            }

            .glow-btn {
                padding: 1rem 2rem;
                font-size: 1.1rem;
            }

            .floating-star {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .banner-title {
                font-size: 1rem;
            }

            .glow-btn {
                padding: 1rem 1.5rem;
                font-size: 1rem;
            }

            .btn-content {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-icon {
                font-size: 1.3rem;
            }
        }   
          .rank-wrapper {
            background:#fff;
            /*padding:30px;*/
            border-radius:14px;
            /*box-shadow:0 10px 25px rgba(0,0,0,0.08);*/
        }
        
        .rank-title { font-weight:700; }
        
        .rank-table th {
            background:#222;
            color:#fff;
            text-align:center;
        }
        
        .rank-table td { text-align:center; }
        
        .promo-footer { margin-top:20px; font-size:14px; }

</style>

<style>
/* Main card */
.custom-card {
    background: #f4f6f9;
    border-radius: 12px;
}

/* Section header */
.main-title {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    padding: 15px;
    border-radius: 10px 10px 0 0;
    font-weight: 600;
    color: #000;
}

/* Inner box (like screenshot) */
.custom-accordion-item {
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    margin-bottom: 12px;
    overflow: hidden;
}

/* Button style */
.custom-accordion-btn {
    background: #fff;
    border: none;
    width: 100%;
    text-align: left;
    padding: 18px;
    font-size: 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Remove bootstrap arrow */
.accordion-button::after {
    display: none;
}

/* Plus icon */
.plus-icon {
    font-size: 22px;
    font-weight: bold;
}

/* Active state */
.accordion-button:not(.collapsed) {
    background: #eef4ff;
}

/* Mobile */
@media(max-width:768px){
    .custom-accordion-btn {
        font-size: 15px;
        padding: 14px;
    }
}
.profile-card {
    width: 100%;
    border: none;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    overflow: hidden;
    position: relative;
    transition: 0.3s ease;
}

.profile-card:hover {
    transform: translateY(-6px);
}

/* Top gradient */
.profile-header {
    height: 90px;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
}

/* Profile Image */
.profile-img-wrapper {
    position: absolute;
    top: 45px;
    left: 50%;
    transform: translateX(-50%);
}

.profile-img-wrapper img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 4px solid #fff;
    background: #fff;
}

/* Divider */
.divider {
    height: 1px;
    background: #eee;
}

/* Details */
.profile-details .detail-item {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 18px;
}

.profile-details i {
    font-size: 18px;
    color: #6a11cb;
    background: #f3f0ff;
    padding: 10px;
    border-radius: 10px;
}

.profile-details label {
    font-size: 12px;
    color: #888;
    margin: 0;
}

.profile-details p {
    margin: 0;
    font-weight: 500;
    font-size: 14px;
}
.info-card {
    width: 100%;
    border: none;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.info-card:hover {
    transform: translateY(-5px);
}

.card-icon {
    width: 70px;
    display: block;
    margin: 0 auto 10px auto; /* centers horizontally */
}

</style>

<style>
/* Make checkbox BIG and clickable */
.big-checkbox {
    transform: scale(1.5);
    cursor: pointer;
}

/* Colored borders for cards */
.border-1 { border: 2px solid #f87171 !important; border-radius: 12px; } /* red */
.border-2 { border: 2px solid #60a5fa !important; border-radius: 12px; } /* blue */
.border-3 { border: 2px solid #34d399 !important; border-radius: 12px; } /* green */
.border-4 { border: 2px solid #fbbf24 !important; border-radius: 12px; } /* yellow */

/* Hover effect */
.product-card {
    transition: all 0.2s ease;
    cursor: pointer;
}
/* Hover */
.product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* Selected */
.product-card input:checked + .content {
    background: #f0f9ff;
    border-radius: 10px;
    padding: 5px;
}
</style>

<style>
    /* Blinking animation */
    @keyframes borderBlink {
        0%, 100% { box-shadow: 0 0 0px red; }
        50% { box-shadow: 0 0 15px red; }
    }
    
    .blink-border {
        animation: borderBlink 1s infinite;
        transition: box-shadow 0.3s ease-in-out;
    }
</style>

<style>
    .marquee {
      overflow: hidden;
      white-space: nowrap;
      font-weight: bold;
      animation: move 10s linear infinite;
    }
    
    .marquee span {
      color: red;
    }
    
    @keyframes move {
      from { transform: translateX(100%); }
      to   { transform: translateX(-100%); }
    }
</style>


<body >

    <section>
        <div class="container-fluid px-4">
            
            <div class="row">
        <!--   <a href=""><div class="marquee">-->
        <!--  🚨 <span>Attention! MaRRS Primary Colors International Champtionship-Registration Going On. Closeing Date:</span> 26-04-2026 🚨-->
        <!--</div></a>-->
        
        
               
               
               
                <?php if(!empty($this->session->flashdata('message'))) { ?>
    			<div id="success-alert" class="alert alert-success text-center" style="background:#42a142;">
    			 
    						 <h4 style="color:#fff;"><?php echo $this->session->flashdata('message');?></h4>
    						  
    						
    			</div>
    			<?php }?>  
    			
    			
    			
        		
        
                <div class="col-lg-4  ">
                    <div class="container mt-4 d-flex flex-column align-items-center">

                        <!-- PROFILE CARD -->
                        <div class="card profile-card text-center mb-4 mt-2">
                    
                            <div class="profile-header text-white fw-bold fs-5 pt-3" ><?php echo $product; ?></div>
                    
                            <div class="profile-img-wrapper pt-3">
                                <?php if(!empty($student[0]['profile_img'])){ ?>
                                    <img src="<?php echo base_url().'images/student/'.$student[0]['profile_img']; ?>">
                                <?php } else { ?>
                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png">
                                <?php } ?>
                            </div>
                    
                            <div class="p-4 pt-5">
                                <h4 class="fw-bold mb-1 pt-4"><?php echo $student[0]['student_name']; ?></h4>
                                <p class="text-muted small mb-3">CIN: <?php echo $student[0]['cin']; ?></p>
                    
                                <div class="divider mb-3"></div>
                    
                                <div class="text-start profile-details">
                                    <div class="detail-item">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                        <div>
                                            <label>Class</label>
                                            <p><?php echo $student[0]['class']; ?></p>
                                        </div>
                                    </div>
                    
                                    <div class="detail-item">
                                        <i class="fa-solid fa-envelope"></i>
                                        <div>
                                            <label>Email</label>
                                            <p><?php echo $student[0]['stud_email']; ?></p>
                                        </div>
                                    </div>
                    
                                    <div class="detail-item">
                                        <i class="fa-solid fa-phone"></i>
                                        <div>
                                            <label>Mobile</label>
                                            <p><?php echo $student[0]['stud_phone']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- GUARDIAN CARD -->
                        <div class="card info-card mb-4 p-4 text-center">
                    
                            <img src="https://img.icons8.com/bubbles/100/000000/family.png" class="card-icon"/>
                            <h5 class="mb-3 fw-bold">Guardian Details</h5>
                    
                            <div class="text-start profile-details">
                                <div class="detail-item">
                                    <i class="fa-solid fa-user"></i>
                                    <div>
                                        <label>Father Name</label>
                                        <p><?php echo $student[0]['father_name']; ?></p>
                                    </div>
                                </div>
                    
                                <div class="detail-item">
                                    <i class="fa-solid fa-user"></i>
                                    <div>
                                        <label>Mother Name</label>
                                        <p><?php echo $student[0]['mother_name']; ?></p>
                                    </div>
                                </div>
                    
                                <div class="detail-item">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <div>
                                        <label>Address</label>
                                        <p><?php echo $student[0]['address1']; ?></p>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    
                        <!-- SCHOOL CARD -->
                        <div class="card info-card mb-4 p-4 text-center">
                    
                            <img src="https://img.icons8.com/external-victoruler-flat-victoruler/64/000000/external-school-education-and-school-victoruler-flat-victoruler-2.png" class="card-icon"/>
                            <h5 class="mb-3 fw-bold">School Details</h5>
                    
                            <div class="text-start profile-details">
                    
                                <div class="detail-item">
                                    <i class="fa-solid fa-school"></i>
                                    <div>
                                        <label>School Name</label>
                                        <p>
                                            <?php 
                                            if(!empty($student[0]['school_name'])){
                                                echo $student[0]['school_name'];
                                            } else {
                                                echo $this->db->get_where('school_new',array('id'=>$student[0]['school_id']))->row()->school_name;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                    
                                <div class="detail-item">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <div>
                                        <label>Address</label>
                                        <p>
                                            <?php 
                                            if(!empty($student[0]['school_address1'])){
                                                echo $student[0]['school_address1'];
                                            } else {
                                                $add = $this->db->get_where('school_new',array('id'=>$student[0]['school_id']))->row();
                                                echo $add->school_address . ', ' . $add->location . ', ' . $add->city;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                    
                            </div>
                    
                        </div>
                    
                    </div>
                    <div class="accordion inner-accordion" id="mainAccordion2">
                                                <?php    if(!empty($mess)){  ?>
                                                                    <!-- MAIN ACCORDION -->
                                                                    <div class="accordion-item">
                                                                        <h4 class="accordion-header">
                                                                            <button type="button" class="accordion-button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#test">
                                                                                Rescheduling Notice
                                                                            </button>
                                                                        </h4>
                                                                
                                                                        <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion4">
                                                                            <div class="accordion-body">
                                                                                <div id="">	    
                                                                                    
                                                                                       
                                                                                        <div class=" shadow-lg p-3 mb-5 bg-white rounded">
                                                                                            <?php echo $mess; ?>
                                                                                        </div>
                                                                                           
                                                                                        
                                                                                      </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                   
                                                <?php } ?>                                                
                                            </div>
                                            
        		 </div>
        		    
        	    <!-- RIGHT SIDE -->

                <div class='col-lg-8 p-4'>
                    <!--<div class="accordion inner-accordion" id="mainAccordion">-->
                        <div class="accordion" id="mainAccordion">
                            
                            <div class="banner-content row shadow-lg p-2 m-auto rounded mb-4">
                            
                            <!--<div class="exciting-badge">-->
                            <!--    🎉 NEW OPPORTUNITY ALERT!-->
                            <!--</div>-->
        
                           <div class="col-lg-6"> 
                            <h2 class="banner-title mt-3">
                                🚀 Lunar Skill Test Registration Now Open! <span class="banner-subtitle"></span>
                            </h2>
        
                             
                            <p class="banner-message">
                                Join thousands of brilliant students in this exciting journey! 
                                
                            </p>
                             </div>
                             <div class="col-lg-6">
                            <!-- Glowing CTA Button -->
                            <a href="https://marrs.in/lunar/Welcome/landing/L257096" class="btn-sm glow-btn mt-4">
                                <span class="btn-content">
                                    <i class="fas fa-rocket btn-icon"></i>
                                    <span>Register For Lunar Now!</span>
                                </span>
                            </a>
                           </div>
                            <!-- Limited Time Badge -->
                            <!--<div class="limited-time">-->
                            <!--    <i class="fas fa-clock"></i>-->
                            <!--    <span>Limited Seats Available - Register Today!</span>-->
                            <!--</div>-->
                        </div>
                                
                                <div class="shadow-lg p-3 mb-3 my-1 bg-white rounded">

                                    <?php 
$excluded_products = [
    'MaRRS Play 2 Learn',
    'MaRRS Preschool Bee Humanities',
    'MaRRS Preschool Bee Science',
    'MaRRS Preschool Bee Math',
    'MaRRS Preschool Bee English'
];

if (!in_array($product, $excluded_products)) 
{ ?>    
                                        
                                                <div class="col-12 text-center" id="profile">
                                                  <?php $current = $this->db->get_where('cin_result',array('cin'=>$this->session->userdata('cin')))->row();
                                                    $product_img = $this->db->get_where('certificate_image',array('product_name'=>$current->product_name))->row();
                                                    ?> 
                                               <div style="text-align: center;">
                                                    <img src="<?php echo base_url('certificate_logo/' . $product_img->image_name); ?>" 
                                                         alt="Certificate Logo" 
                                                         style="width: 100%; max-width: 340px; height: auto; display: inline-block;">
                                                </div>
                                                
                                            
                                                <?php $cin= $this->session->userdata('cin'); 
                                                 //echo $cin;
                                                    $current = $this->db->get_where('cin_result',array('cin'=>$cin))->row();
                                                     
                                                    $query = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='1';");
                                                    $query1 = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='3' and period_id='11';");
                                                    $queryState = $this->db->query("SELECT * FROM `cin_list` WHERE `cin` LIKE '{$cin}' and state_id='14683'")->row();
                                                    
                                                    $query2 = $this->db->query("SELECT * FROM `cin_result` join cin_list on cin_list.cin=cin_result.cin WHERE cin_list.cin LIKE '{$cin}' and clevel='3' and cin_result.period_id=12 and product_name='MaRRS International Spelling Bee' and state_id=14689;");
                                                    
                                                    //$array1=array();
                                                     foreach ($query->result_array() as $row)
                                                    {
                                                     
                                                      $product_name=$row['product_name'];
                                                     
                                                    }
                                                     foreach ($query1->result_array() as $row)
                                                    {
                                                     
                                                      $product_name_national=$row['product_name'];
                                                     
                                                    }
                                                
                                                // if(!empty($query2->row_array())){
                                                //     echo 'oij';
                                                // }
                                                
                                                //print_r();
                                                //echo $status;
                                                
                                                ?>
                           <div class="reg_button my-4 text-center">
            
                <!-- BUTTON ROW -->
                <!--<div class="d-flex flex-wrap justify-content-center gap-2">-->
            
                    <?php  if($exam=='Live'){
// echo $exam_id;
                        if($exam_id!=0){
            
                            $this->session->set_userdata('exam_id',$exam_id);
            
                            if(!empty($compe->revenue_setting_id)){ ?>
                                
                                <a class="btn btn-danger"
                                   href="<?php echo base_url();?>Cin_login/enroll">
                                   Register for Next Level
                                </a>
                                <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/enroll">Download Learning Material</a>
            
                            <?php } else { ?>
            
                                <a class="btn btn-danger"
                                   href="<?php echo base_url();?>Cin_login/register">
                                   Register for Next Level
                                </a>
                                <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/enroll">Download Learning Material</a>
            
                            <?php }
            
                        } else { ?>
            
                            <span class="text-danger fw-bold">
                                Exam Not Scheduled In Your School
                            </span>
            
                            <a class="btn btn-success"
                               href="<?php echo base_url();?>Cin_login/register_close">
                               Download Learning Material
                            </a>
            
                        <?php }
            
                    
                    } else { 
                        
                        if($period >= '16'){
                    
                        ?>
            
                                <!--<a class="btn btn-danger"-->
                                <!--   href="<?php echo base_url();?>Cin_login/register_school">-->
                                <!--   Buy and Download Material, Mock Paper-->
                                <!--</a>-->
            
            
                            <a class="btn btn-success"
                               href="<?php echo base_url();?>Cin_login/register_close">
                               Download Learning Material
                            </a>
                            
                        <?php }else{ ?>
                            
                        <a class="btn btn-success"
                           href="<?php echo base_url();?>Cin_login/register_close">
                           Download Learning Material
                        </a>
                        
                        
                        
            
                        <?php 
                        }
                    
                    } ?>
            
            
                    <!-- RESULT BUTTON -->
                    <?php if($period=='12'){ ?>
            
                        <a class="btn btn-primary "
                           href="<?php echo base_url();?>Cin_login/result_view22">
                           View Result & Download Certificate
                        </a>
            
                    <?php } else {
                $product = $this->db->get_where('cin_result', array(
                    'cin'    => $student[0]['cin'],
                    'clevel' => '1',
                    'status' => 'Q'
                ))->row();
                
                $is_disabled = empty($product);
                ?>
            
                <a class="btn btn-primary"
                   href="<?php echo base_url(); ?>Cin_login/result_view">
                   View Result & Download Certificate
                </a>
            
            <?php } ?>
            
                <!--</div>-->
            
                <!-- INFO TEXT -->
        <?php
                
                
            $product = $this->db->get_where('cin_result', array('cin' => $student[0]['cin']))->row();
            // ✅ Get schedule (OFFLINE date comes from here)
$schedule = $this->db
    ->where('school_id', $student[0]['school_id'])
    ->where('product_name', $product->product_name)
    ->order_by('competition_schedule_id', 'DESC')
    ->get('competition_schedule')
    ->row();

// ✅ Get product_to_school (ONLINE dates)

         $validDate = $this->db
    ->where('school_id', $student[0]['school_id'])
    ->where('product_name', $product->product_name)
    ->order_by('id', 'DESC') // ✅ MUST come before get()
    ->get('product_to_school')
    ->row();
            
            // echo '<pre>';
            // print_r($validDate);
            
    
            $today = date('Y-m-d');
        
            $has_dates   = ($validDate && !empty($validDate->competition_mode_start_date) && !empty($validDate->competition_mode_end_date));
            $dates_valid = $has_dates && ($validDate->competition_mode_start_date <= $validDate->competition_mode_end_date);
            $show_button = $dates_valid && ($today >= $validDate->start_date && $today <= $validDate->end_date);
        
            $start_display = $has_dates ? date('d M Y', strtotime($validDate->start_date)) : '--';
            $end_display   = $has_dates ? date('d M Y', strtotime($validDate->end_date))   : '--';
            $end_display2   = $has_dates ? date('d M Y', strtotime($validDate->competition_mode_end_date))   : '--';
        
            if (!$has_dates || !$dates_valid) {
                $status_text = 'Not Set';
                $status_class = 'status-muted';
            } elseif ($show_button) {
                $status_text = 'Available';
                $status_class = 'status-available';
            } elseif ($today < $validDate->competition_mode_start_date) {
                $status_text = 'Upcoming';
                $status_class = 'status-upcoming';
            } else {
                $status_text = 'Closed';
                $status_class = 'status-closed';
            }
            
if (!empty($validDate->competition_mode)) {                
                
            ?>
                <div class="container my-4">
                    
                    <div class="card border-primary competition-card">
                        
                        <div class="card-body text-center">
                          <h2 class="card-title text-primary fw-bold mb-3">Competition</h2>
                    
                          <p class="card-text fs-5 mb-3">
                            Registration will be active from
                            <span class="badge bg-light text-dark border date-badge"><?=$start_display?></span>
                            to
                            <span class="badge bg-light text-dark border date-badge"><?=$end_display?></span>
                          </p>
                    
                          <p class="card-text fs-5 mb-0">
                            Competition mode:
                            <?php if ($validDate->competition_mode === 'online') { ?>
                              <span class="badge bg-success mode-badge"><?= $validDate->competition_mode ?></span>
                            <?php } else { ?>
                              <span class="badge bg-secondary mode-badge"><?= $validDate->competition_mode ?></span>
                            <?php } ?>
                            
                          </p>
                          <!--<p class="text-primary mt-2"><b>Submit your test before</b>-->
                            <!--<span class="badge bg-light text-dark border date-badge"><?= $end_display; ?></span></p>-->
                            
                            
 <?php 
$showCompetitionDate = false;

if (!empty($validDate->competition_mode)) {

    if ($validDate->competition_mode === 'offline' && !empty($schedule->competition_date)) {
        $showCompetitionDate = true;
    }

    if (
        $validDate->competition_mode === 'online' &&
        !empty($validDate->competition_mode_start_date) &&
        !empty($validDate->competition_mode_end_date)
    ) {
        $showCompetitionDate = true;
    }
}
?>

<?php if ($showCompetitionDate) { ?>

<p class="card-text fs-5 mb-0 pt-3">

    <?php if ($validDate->competition_mode === 'offline') { ?>

        Competition will be active on:

        <span class="badge bg-secondary mode-badge">
            <?= date('jS M Y', strtotime($schedule->competition_date)); ?>
        </span>

    <?php } elseif ($validDate->competition_mode === 'online') { ?>

        Competition will be active from:

        <span class="badge bg-secondary mode-badge">
            <?= date('jS M Y', strtotime($validDate->competition_mode_start_date)); ?>
        </span>

        to

        <span class="badge bg-secondary mode-badge">
            <?= date('jS M Y', strtotime($validDate->competition_mode_end_date)); ?>
        </span>

    <?php } ?>

</p>

<?php } ?>
                        
                            
                        </div>
                        
                    </div>
                    
                    <div class="mt-3 mt-md-0">
                        <?php if ($show_button) { ?>
                            <a class="btn btn-primary rounded-3 fw-semibold px-4 take-test-btn d-none"
                               href="<?php echo base_url('Cin_login/onlinetest'); ?>">
                               <i class="bi bi-play-fill me-1"></i> Start Test
                            </a>
                        <?php } else { ?>
                            <button class="btn rounded-3 fw-semibold px-4 not-available-btn"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="<?php echo !$has_dates ? 'Competition dates not set yet.' : (!$dates_valid ? 'Date range is invalid.' : 'Test is only available between the dates shown.'); ?>"
                                    disabled>
                                <i class="bi bi-lock-fill me-1"></i> Not Available
                            </button>
                        <?php } ?>
                    </div>
                    
                </div>
            
                <style>
                  .competition-card {
                    border-width: 2px;
                    border-radius: 12px;
                    padding: 10px;
                  }
                  .competition-card .card-title {
                    font-size: 2.2rem;
                  }
                  .date-badge {
                    font-size: 1rem;
                    padding: 8px 14px;
                    border-radius: 6px;
                  }
                  .mode-badge {
                    font-size: 1rem;
                    padding: 8px 16px;
                    border-radius: 6px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                  }
                </style>
        
        <?php } ?>

               <br><p class="px-4 my-2"><strong>Instruction: </strong> "<a class="text-primary"  href="<?php echo base_url();?>Cin_login/edit_cin_login" aria-current="page">Update your email and phone number to stay informed.</a>
                		  Competition schedule will be sent after registration. Incorrect details may prevent communication"</p>
            
                <!-- UPDATE BUTTON (FIXED) -->
                <!--<div class="mt-2">-->
                <!--    <a class="btn btn-warning btn-sm px-3"-->
                <!--       href="<?php echo base_url();?>Cin_login/edit_cin_login">-->
                <!--       Update Contact Details-->
                <!--    </a>-->
                <!--</div>-->
            
            </div>
            
            
            
                                        </div>
                                        
                                        
                                            
                            
                                            <!--<div class="rank-wrapper text-center">-->
                                            
                                            <!--    <button class='btn btn-outline-primary'> -->
                                            <!--        <a href="https://api.aviansys.in/rank_list/<?php //echo $rank_list[0]->level_name.'/'.$rank_list[0]->period_id.'/'.$product; ?>" target="_BLANK"> Download Complete Rank List </a>-->
                                            <!--    </button>-->
                                                
                                            <!--    <button class='btn btn-outline-warning'> -->
                                            <!--        <a href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" target="_BLANK"> View Gallery </a>-->
                                            <!--    </button>-->
                                            <!--    </div>-->
                                                
                                        
                                           <?php
/*
<div class="col-12 text-center my-2">

    <h2 class="rank-title">
        🏆 Top Rank Holders<br>
        <?php print_r($rank_list[0]->level_name); ?>
    </h2>

    <div class="row justify-content-center">

        <?php foreach ($rank_list as $list): ?>
            <?php
                $rankLabel = strtoupper(str_replace('-', ' ', $list->rank));
                if (!in_array($rankLabel, ['RANK 1','RANK 2','RANK 3'])) continue;
            ?>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm p-3">

                    <div style="font-size:32px;">
                        <?= ($rankLabel == 'RANK 1') ? '🥇' : (($rankLabel == 'RANK 2') ? '🥈' : '🥉'); ?>
                    </div>

                    <h6><?= htmlspecialchars($list->student_name) ?></h6>
                    <small><?= htmlspecialchars($list->school) ?></small><br>

                    <?php
                        $isStarSpeller   = (strtoupper($list->speller ?? '') === 'YES');
                        $isBestPerformer = (strtoupper($list->performer ?? '') === 'YES');
                    ?>

                    <medium class="text-muted">

                        <?php if ($isStarSpeller): ?>
                            🌟 You are a <strong class="text-success">STAR SPELLER !</strong><br>
                        <?php endif; ?>

                        <?php if ($isBestPerformer): ?>
                            🏆 You are also a <strong class="text-info">BEST PERFORMER !</strong>
                        <?php endif; ?>

                    </medium>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>
*/
?> 
                                        </div>
                                        
                                        
                                        
                                        
            <div class="col-12 text-center shadow-lg p-2 mb-2 my-1 bg-white rounded d-none">
           
                          
           
                                    <!-- Rank Filter Filters -->
          <h3 class="pt-3 mb-4 text-center text-primary fw-bold">
    Rank Filter with Selected Product Level
</h3>

<form method="POST" action="" class="row justify-content-center g-3 mb-4">

    <!-- Product Dropdown -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Select Product</label>

        <select class="form-select" name="product_name" required>
            <option value="">-- Select Product --</option>

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $p): ?>
                    <option value="<?= htmlspecialchars($p['product_name']); ?>"
                        <?= (isset($_POST['product_name']) && $_POST['product_name'] == $p['product_name']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['product_name']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Level Dropdown -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Select Level</label>

        <select class="form-select" name="level_id" required>
            <option value="">-- Select Level --</option>

            <?php if (!empty($levels)): ?>
                <?php foreach ($levels as $l): ?>
                    <option value="<?= $l['level_id']; ?>"
                        <?= (isset($_POST['level_id']) && $_POST['level_id'] == $l['level_id']) ? 'selected' : '' ?>>
                        <?= $l['level_name']; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Period Dropdown -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Select Period</label>

        <select class="form-select" name="period_id" required>
            <option value="">-- Select Period --</option>

            <option value="16" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '16') ? 'selected' : '' ?>>26/27</option>
            <option value="15" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '15') ? 'selected' : '' ?>>25/26</option>
            <option value="14" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '14') ? 'selected' : '' ?>>24/25</option>
            <option value="13" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '13') ? 'selected' : '' ?>>23/24</option>
            <option value="12" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '12') ? 'selected' : '' ?>>22/23</option>
            <option value="11" <?= (isset($_POST['period_id']) && $_POST['period_id'] == '11') ? 'selected' : '' ?>>21/22</option>
        </select>
    </div>

    <!-- Class Dropdown (NEW) -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Select Class</label>

        <select class="form-select" name="class">
            <option value="">-- All Classes --</option>

            <?php if (!empty($classes)): ?>
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['class']; ?>"
                        <?= (isset($_POST['class']) && $_POST['class'] == $c['class']) ? 'selected' : '' ?>>
                         <?= $c['class']; ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Search Button -->
    <div class="col-md-2 d-grid align-self-end">
        <button type="submit" name="searchBtn" class="btn btn-primary">Search</button>
    </div>

</form>
<!-- Alert message -->
<div id="alertMsg" class="alert d-none text-center" role="alert"></div>

<!-- Table -->
<div class="table-responsive">
<?php
$product_name = $_POST['product_name'] ?? '';
$level_id     = $_POST['level_id'] ?? '';
$period_id    = $_POST['period_id'] ?? '';
$class        = $_POST['class'] ?? ''; // ✅ NEW

$finalData = [];

if (!empty($_POST)) {

    $this->db->select('cr.cin, cr.performer, cr.speller, cr.status, cr.rank, cl.class, cl.student_name');
    $this->db->from('cin_result cr');

    // JOIN for class + student
    $this->db->join('cin_list cl', 'cl.cin = cr.cin', 'left');

    // Filters
    if (!empty($product_name)) {
        $this->db->where('cr.product_name', $product_name);
    }

    if (!empty($level_id)) {
        $this->db->where('cr.clevel', $level_id);
    }

    if (!empty($period_id)) {
        $this->db->where('cr.period_id', $period_id);
    }

    // ✅ CLASS FILTER (MAIN ADDITION)
    if (!empty($class)) {
        $this->db->where('cl.class', $class);
    }

    // valid rows
    $this->db->where('cr.status !=', '');

    // rank filter (since stored as "1,2,3")
    $this->db->group_start();
        $this->db->like('cr.rank', '1');
        $this->db->or_like('cr.rank', '2');
        $this->db->or_like('cr.rank', '3');
    $this->db->group_end();

    $this->db->order_by('cr.rank', 'ASC');

    $query = $this->db->get();
    $finalData = $query->result_array();
}
?>
    <table class="table table-bordered table-striped" id="rankTable">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Rank</th>
                <th>Performer</th>
                <th>Speller</th>
                <!--<th>Status</th>-->
               
            </tr>
        </thead>
       <tbody>
<?php if (!empty($finalData)): ?>
    <?php $i = 1; foreach ($finalData as $row): ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['student_name']; ?></td>
            <td><?= $row['class']; ?></td>
            <td>
<?php
$rank = $row['rank'] ?? '';

if ($rank == '1') {
    echo '<i class="fa-solid fa-medal text-warning"></i> 1'; // Gold
} elseif ($rank == '2') {
    echo '<i class="fa-solid fa-medal text-secondary"></i> 2'; // Silver
} elseif ($rank == '3') {
    echo '<i class="fa-solid fa-medal text-danger"></i> 3'; // Bronze
} elseif (in_array($rank, ['4','5','6','7','8','9','10'])) {
    echo '<i class="fa-solid fa-award text-primary"></i> ' . $rank;
} elseif (strtolower($rank) == 'budding star') {
    echo '<i class="fa-solid fa-star text-success"></i> Budding Star';
} else {
    echo $rank ?: '-';
}
?>
</td>
            <td>
    <?php if (($row['performer'] ?? '') === 'Yes'): ?>
        <span class="badge bg-success">
            <i class="fa-solid fa-trophy"></i> Best Performer
        </span>
    <?php else: ?>
        -
    <?php endif; ?>
</td>

<td>
    <?php if (($row['speller'] ?? '') === 'Yes'): ?>
        <span class="badge bg-info text-dark">
            <i class="fa-solid fa-award"></i> Best Speller
        </span>
    <?php else: ?>
        -
    <?php endif; ?>
</td>
        </tr>
    <?php endforeach; ?>
<?php elseif (!empty($_POST)): ?>
    <tr>
        <td colspan="6" class="text-center text-danger">No data found</td>
    </tr>
<?php endif; ?>
</tbody>
    </table>
</div>
    <div id="paginationWrapper" class="mt-3 mb-4"></div>    
  
           
           
           
           
                                        </div>
                                        
                                        
                                    
                                    
                                    <?php }
                                    
                                    else { 
                                        
                                       
                                            // if ($this->session->userdata('cin') == 'S22A110003') { 
                                                $cin = $this->session->userdata('cin');
                                                $status= $this->session->userdata('status');
                                                // print_r($_SESSION);
                                                // print_r( $student);
                                                //if (!empty($cin) && substr($cin, 0, 1) === 'P' || substr($cin, 0, 1) === 'J22' ) {
                                                $cin = trim($cin);
        //   echo $cin.'ok';  

// 👉 Define allowed prefixes (first 3 characters)
//$allowed_prefixes = ['P22A','P22B','J22A', 'J22B','23SJ','24SJ','22PL','23PL','24PL','22PH','23PH','24PH','22PM','23PM','24PM','22PB','23PB','24PB','22PS','23PS','24PS'];

$prefix = substr($cin, 0, 4);

if (!empty($cin) && in_array($prefix, $allowed_prefixes)) {
    // ✅ MATCHED
    
    

                                            ?>
                                            
                                            <div class="col-sm-12 col-md-12 col-lg-12 text-center" id="profile">
                                                 <div class="d-flex flex-column  align-items-center justify-content-center">
                                                        
                                                <!-- Logo -->
                                                    <img src="<?php echo base_url('images/primary-colors-logo.jpg'); ?>" 
                                                         alt="Primary Colors Logo"
                                                         class="img-fluid mb-1"
                                                         style="max-height: 120px; object-fit: contain;">
                                                
                                                    <!-- Title -->
                                                    <h2 class="fw-bold mb-1" style="color:#1e3a8a;">
                                                        MaRRS     <span class="fw-bold" style="color:#f59e0b;">
                                                        Primary Colors
                                                    </span>
                                                    </h2>
                                                
                                                
                                                
                                                
                                                    </div>

                                            
                                                <?php

                                                    $cin          = $student[0]['cin'];
                                                    $student_name = $student[0]['student_name'];
                                                    $email        = $student[0]['stud_email'];
                                                    $period_id    = $student[0]['period_id'];
                                                    
                                                    // $cins = $this->db
                                                    //     ->select('cin_result.cin, cin_result.product_name')
                                                    //     ->from('cin_list')
                                                    //     ->join('cin_result', 'cin_result.cin = cin_list.cin')
                                                    //     ->where([
                                                    //         'cin_list.stud_email'   => $email,
                                                    //         'cin_list.student_name' => $student_name,
                                                    //         'cin_result.period_id'  => $period_id
                                                    //     ])
                                                    //     ->group_by(['cin_result.product_name','cin_result.cin']) // ✅ important fix
                                                    //     ->get()
                                                    //     ->result();
                                                        
                                                    // print_r($cins);
                                                    
                                                    // $cin_array = array_column($cins, 'cin');

                                                    // print_r($cin_array);
                                                
                                                    $competitions = [];
                                                    // if (!empty($cin_array)) {
                                                        $competitions = $this->db
                                                            ->select('competition_product_state.id as comp_id, competition_product_state.product_name, cin_uploade.cin')
                                                            ->from('competition_product_state')
                                                            ->join('cin_uploade', 'cin_uploade.comp_id = competition_product_state.id')
                                                            ->where('competition_product_state.clevel', '13')
                                                            ->where('cin_uploade.cin', $cin) // ✅ FIXED
                                                            ->get()
                                                            ->result();
                                                    // }
                                                    
                                                    
                                                    // $competition_map = [];
                                                    // foreach ($competitions as $comp) {
                                                    //     $competition_map[$comp->cin] = $comp->comp_id;
                                                    // }
                                                    
                                                    // echo '<pre>';
                                                    // print_r($competitions);
                                                    
                                                        
                                                    ?>

                                                    
                                                    <div class=" d-flex  flex-column my-3 gap-3 align-items-center text-center">
                                                        <!--<div class="col-12 text-center" id="productList">-->
                                                        
                                                        <!--    <h5 class="fw-bold mb-3">Please select this option to proceed with registration.</h5>-->
                                                        
                                                        <!--    <div class="row justify-content-center">-->
                                                        
                                                        <!--        <div class="col-md-5 col-lg-4 mb-3 d-flex justify-content-center">-->
                                                                    
                                                        <!--            <label class="card product-card shadow-sm w-100 border-1">-->
                                                        
                                                        <!--                <div class="card-body d-flex align-items-center">-->
                                                        
                                                                            <!-- Single Checkbox -->
                                                        <!--                   <input type="checkbox" -->
                                                        <!--       name="products[]" -->
                                                        <!--       value="<?php echo $row->comp_id.'/'.$row->cin; ?>" -->
                                                        <!--       class="form-check-input big-checkbox me-3">-->
                                                                            <!-- Content -->
                                                        <!--                    <div class="content text-start">-->
                                                        <!--                        <div class="fw-semibold text-dark">-->
                                                        <!--                            MaRRS Primary Colors-->
                                                        <!--                        </div>-->
                                                        <!--                        <small class="text-muted">-->
                                                        <!--                            Special Program-->
                                                        <!--                        </small>-->
                                                        <!--                    </div>-->
                                                        
                                                        <!--                </div>-->
                                                        
                                                        <!--            </label>-->
                                                        
                                                        <!--        </div>-->
                                                        
                                                        <!--    </div>-->
                                                        
                                                        <!--</div>-->
                                                        <a 
        class="btn btn-success btn-lg w-50 mt-2 blink-border" 
        href="<?php echo base_url('Cin_login/enroll2/'.$comp_id.'/'.$cin); ?>">
        
        Register Now
    </a>
     <a class="btn btn-warning btn-lg w-50 blink-border" href="<?php echo base_url('Cin_login/enroll2/'.$comp_id.'/'.$cin); ?>">View & Download Learning Material</a>
     <a class="btn btn-primary btn-lg w-50 blink-border"
                           href="<?php echo base_url();?>Cin_login/result_view22">
                           View Result & Download Certificate
                        </a>
                                    							 
                                                    
                                            </div>


                                        
                                        
                                    <?php }
                                    
                                        else{ ?>        
                                        
                                        <div class="col-sm-12 col-md-12 col-lg-12 text-center" id="profile">
                                                <?php $current = $this->db->get_where('cin_result',array('cin'=>$this->session->userdata('cin')))->row();
                                                    $product_img = $this->db->get_where('certificate_image',array('product_name'=>$current->product_name))->row();
                                                    ?> 
                                                  <div style="text-align: center;">
                                                        <img src="<?php echo base_url('certificate_logo/' . $product_img->image_name); ?>" 
                                                             alt="Certificate Logo" 
                                                             style="width: 100%; max-width: 340px; height: auto; display: inline-block;">
                                                    </div>
                                            
                                                <?php $cin= $this->session->userdata('cin');
                                                 //echo $cin;
                                                    $current = $this->db->get_where('cin_result',array('cin'=>$cin))->row();
                                                     
                                                    $query = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='1';");
                                                    $query1 = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='3' and period_id='11';");
                                                    $queryState = $this->db->query("SELECT * FROM `cin_list` WHERE `cin` LIKE '{$cin}' and state_id='14683'")->row();
                                                    
                                                    $query2 = $this->db->query("SELECT * FROM `cin_result` join cin_list on cin_list.cin=cin_result.cin WHERE cin_list.cin LIKE '{$cin}' and clevel='3' and cin_result.period_id=12 and product_name='MaRRS International Spelling Bee' and state_id=14689;");
                                                    
                                                    //$array1=array();
                                                     foreach ($query->result_array() as $row)
                                                    {
                                                     
                                                      $product_name=$row['product_name'];
                                                     
                                                    }
                                                     foreach ($query1->result_array() as $row)
                                                    {
                                                     
                                                      $product_name_national=$row['product_name'];
                                                     
                                                    }
                                                
                                                // if(!empty($query2->row_array())){
                                                //     echo 'oij';
                                                // }
                                                
                                                //print_r();
                                                //echo $status;
                                                
                                                ?>
                                            <div class="reg_button my-3" style='text-align:center;'>
                        
                                            <?php  
                                            
                                            // echo $exam.'okj';
                                            
                                            if($exam == 'Live'){
                                                
                                                    // echo $exam.'okj';
                                                    
                                                        if($exam_id != 0){
                                                            // echo $exam_id; 
                                                            
                                                            
                                                            $this->session->set_userdata('exam_id',$exam_id);
                                                            
                                                            // echo $compe->revenue_setting_id;
                                                            
                                                            if(!empty($compe->revenue_setting_id)){
                                                                
                                    							?>
                                    							<a class="btn btn-danger" href="<?php echo base_url();?>Cin_login/enroll">Register for Next Level</a>
                                    							 <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/enroll">Download Learning Material</a>
                                    							 
                                    						<?php }else{ ?>	
                                    							 
                                    							 <a class="btn btn-danger" href="<?php echo base_url();?>Cin_login/register">Register for Next Level</a>
                                    							  <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/register">Download Learning Material</a>
                                    							 
                                    							 
                                    							 
                                    							 <!--<a class=" btn btn-lg btn-outline-danger" href="#">Registration Resume Shortly</a>-->
                                    							    
                                    					<?php
                                    						}
                                    						    
                                    						}else{ 
                                    					    echo 'Please await the State Level schedule.';
                                    					    ?>
                                    					        <br>
                                					        <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/register_close">Material Download </a>
                        						    
                                					    <?php
                                					}
                                					
                                                }
                        						else{
                        						    ?>
                        						    <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/register_close">Material Download </a>
                        						    
                        						    <?php
                        						}
                    
                
                                     
                                            if($period=='12'){?>
                                              
                                                <a class= "btn btn-primary" href="<?php echo base_url();?>Cin_login/result_view22">View Result & Download Certificate</a>
                                                         
                                            <?php }else{?>
                                                <a class= "btn btn-primary" href="<?php echo base_url();?>Cin_login/result_view">View Result & Download Certificate</a>
                                               
                                            <?php }  ?>
                                            
                                                <br>
                                                <?php// echo $this->session->flashdata('message');?>
                                            		<br><p class="px-4"><strong>Instruction: </strong> "<a class="text-primary"  href="<?php echo base_url();?>Cin_login/edit_cin_login" aria-current="page">Update your email and phone number to stay informed.</a>
                		  Competition schedule will be sent after registration. Incorrect details may prevent communication"</p>	
                                         
                                                </div>
            
                    
            
            
                                        </div>
                                        
                                        
                                    <?php } ?>
                                    
                                    
                                    
                                    
                                    
                                    
                                        <!--//--------------------Rank Holder --------------------//-->
                                        
                                         <div class="col-sm-12 col-md-12 col-lg-12 text-center" >
                                              
                                            
                                          <div class="top-actions">
                                              
                                                <a href="#" class="btn-yellow">View Gallery</a>
                                            </div>
                                            
                                            
                                                
                                    <!-- Rank Filter Filters -->
          <h3 class="pt-3 mb-4 text-center text-primary fw-bold">
    Rank Filter with Selected Product Level
</h3>

<form method="POST" action="" class="row justify-content-center g-3 mb-4">

    <!-- Product Dropdown -->
    <div class="col-md-3">
        <label for="product-filter" class="form-label fw-semibold">
            Select Product
        </label>
        <select class="form-select" id="productName" name="product_name" required>
            <option value="">-- Select Product --</option>
            <?php foreach ($products as $p): ?>
    <option value="<?= $p['product_name'] ?>">
        <?= $p['product_name'] ?>
    </option>
<?php endforeach; ?>
        </select>
    </div>

    <!-- Level Dropdown -->
    <div class="col-md-3">
         
        <label for="level-filter" class="form-label fw-semibold">
            Select Level
        </label>
<select class="form-select" name="level_id" required>
    <option value="">-- Select Level --</option>

    <?php foreach ($levels as $level): ?>
        <option value="<?= $level['level_id']; ?>">
            <?= $level['level_name']; ?>
        </option>
    <?php endforeach; ?>
</select>
</div>

    <!-- Period Dropdown -->
    <div class="col-md-3">
        <label for="period-filter" class="form-label fw-semibold">
            Select Period
        </label>
        <select class="form-select" id="period" name="period_id" required>
            <option value="">-- Select Period --</option>
             <option value="16" > 26/27 </option>
             <option value="15" > 25/26 </option>
             <option value="14" > 24/25 </option>
             <option value="13" > 23/24 </option>
             <option value="12" > 22/23                </option>
                            <option value="11"
                    >
            
        </select>
    </div>

    <!-- Search Button -->
    <div class="col-md-2 d-grid align-self-end">
       <button type="button" class="btn btn-primary" id="searchBtn">Search
        </button>
    </div>

</form>
<!-- Alert message -->
<div id="alertMsg" class="alert d-none text-center" role="alert"></div>

<!-- Table -->
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="rankTable">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Category</th>
                <th>Rank</th>
                
            </tr>
        </thead>
        <tbody id="rankTableBody">
            <tr>
                <td colspan="6" class="text-center">No data found</td>
            </tr>
        </tbody>
    </table>
</div>
    <div id="paginationWrapper" class="mt-3 mb-4"></div> 
                                            
                                            <?php /*
<div class="heading">
    <h2>🏆 Rank Listing & School Data</h2>
    <span>
        <?php 
        $this->db->select('cin_result.id,cin_result.rank, 
            cin_result.cin, 
            cin_list.student_name, 
            cin_list.school_id, 
            school_new.school_name');
        $this->db->from('cin_result');

        $this->db->join('cin_list', 'cin_list.cin = cin_result.cin', 'left');
        $this->db->join('school_new', 'school_new.id = cin_list.school_id', 'left');

        $this->db->where('cin_result.clevel', $clevel->clevel);
        $this->db->where('cin_result.product_name', $product);
        $this->db->where_in('cin_result.rank', ['Rank-1','Rank-2','Rank-3']);
        $this->db->where('cin_list.school_id', $student[0]['school_id']);
        $this->db->group_by('cin_result.rank');

        $query = $this->db->get();
        $resultrank = $query->result();

        if(!empty($clevel)){
            echo $clevel->level_name;
        }
        ?>
    </span>  
</div>

<div class="rank-wrapper">
    <?php foreach($resultrank as $val){
        $rank = strtolower(trim($val->rank));

        if ($rank == 'rank-1' || $rank == '1') {
            $medal = "🥇";
        } elseif ($rank == 'rank-2' || $rank == '2') {
            $medal = "🥈";
        } elseif ($rank == 'rank-3' || $rank == '3') {
            $medal = "🥉";
        } else {
            $medal = "❌";
        }
    ?>
        <div class="rank-card">
            <div class="medal"><?= $medal ?></div>
            <div class="name"><?= $val->student_name; ?></div>
            <div class="school"><?= $val->school_name; ?></div>
        </div>
    <?php } ?>
</div>
*/ ?>
                                            
                                            
                             <!--//--------------------Rank Holder --------------------//-->
            
            
                                        </div>
                                        
                                    
                            
                            
                                    <!--<div class="col-sm-12 col-md-12 col-lg-3">-->
                                    
                                    
                                    <!--<?php if($image_name){ ?>-->
                                        
                                    <!--        <div class='mt-3'>-->
                                    <!--            <img src='<?php echo $image_name; ?>'  style='width:50%;'>-->
                                    <!--        </div>-->
                                        
                                    <!--<?php } ?>-->
                                    <!--</div>-->
                                    
                                <?php } ?>   
                            </div>
                        
                        
<!-- <div class="custom-card">-->

<!--<div class="main-title">-->
<!--    Check Your Test Status-->
<!--</div>-->

<!--<div class="p-3">-->

<!--<div class="accordion" id="innerAccordion">-->
<!--                    <div class="form-group mb-3">-->
<!--                    <select name="class" class="form-control-custom" id="classDropdown">-->
                       
<!--                       <option value="">-- Select Class --</option>-->
<!--                        <option value="Class-1" <?= ($student[0]['class'] == 'Class-1') ? 'selected' : '' ?>>Class-1</option>-->
<!--                        <option value="Class-2" <?= ($student[0]['class'] == 'Class-2') ? 'selected' : '' ?>>Class-2</option>-->
<!--                        <option value="Class-3" <?= ($student[0]['class'] == 'Class-3') ? 'selected' : '' ?>>Class-3</option>-->
<!--                        <option value="Class-4" <?= ($student[0]['class'] == 'Class-4') ? 'selected' : '' ?>>Class-4</option>-->
<!--                        <option value="Class-5" <?= ($student[0]['class'] == 'Class-5') ? 'selected' : '' ?>>Class-5</option>-->
<!--                        <option value="Class-6" <?= ($student[0]['class'] == 'Class-6') ? 'selected' : '' ?>>Class-6</option>-->
<!--                        <option value="Class-7" <?= ($student[0]['class'] == 'Class-7') ? 'selected' : '' ?>>Class-7</option>-->
<!--                        <option value="Class-8" <?= ($student[0]['class'] == 'Class-8') ? 'selected' : '' ?>>Class-8</option>-->
<!--                        <option value="Class-9" <?= ($student[0]['class'] == 'Class-9') ? 'selected' : '' ?>>Class-9</option>-->
<!--                        <option value="Class-10" <?= ($student[0]['class'] == 'Class-10') ? 'selected' : '' ?>>Class-10</option>-->
<!--                        <option value="Class-11" <?= ($student[0]['class'] == 'Class-11') ? 'selected' : '' ?>>Class-11</option>-->
<!--                        <option value="Class-12" <?= ($student[0]['class'] == 'Class-12') ? 'selected' : '' ?>>Class-12</option>-->
<!--                    </select>-->
<!--                    </div>-->
                    <!-- MAIN ACCORDION -->
                    <!--<div class="accordion-item">-->
                    <!--    <h4 class="accordion-header">-->
                    <!--        <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#checkStatus">-->
                    <!--            Check Test Status-->
                    <!--        </button>-->
                    <!--    </h4>-->
                         
                    <!--    <div id="checkStatus" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion">-->
                    <!--        <div class="accordion-body">-->
                
                                <!-- INNER ACCORDION -->
                    <!--            <div class="accordion" id="statusAccordion">-->
                
                                    <!-- Unregistered Series -->
                    <!--                <div class="accordion-item position-relative">-->
                    <!--                    <h5 class="accordion-header position-relative">-->
                    <!--                        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#unregistered">-->
                    <!--                            Unregistered Series-->
                    <!--                        </button>-->
                
                    <!--                        <span class="badge bg-danger position-absolute top-50 end-0 translate-middle-y me-3">-->
                    <!--                           Pending Tests: Register Now!-->
                    <!--                        </span>-->
                    <!--                    </h5>-->
                
                    <!--                    <div id="unregistered" class="accordion-collapse collapse" data-bs-parent="#statusAccordion">-->
                                   <!-- SUB 1 -->
<!--                                    <div class="custom-accordion-item">-->
<!--    <button class="accordion-button collapsed custom-accordion-btn"-->
<!--    data-bs-toggle="collapse"-->
<!--    data-bs-target="#sub1">-->

<!--    <span>Unregistered (Action Required) Series</span>-->

<!--    <div class="d-flex align-items-center gap-2">-->
<!--        <span class="badge bg-danger">-->
<!--            Pending Tests: Register Now!-->
<!--        </span>-->
<!--        <span class="plus-icon" id="icon-sub1">+</span>-->
<!--    </div>-->

<!--</button>-->

<!--    <div id="sub1" class="accordion-collapse collapse">-->
<!--                                          <div class="accordion-body">-->
                                                 <!-- Action Section -->
<!--                                            <div class="action-section" data-aos="fade-up">-->
<!--                                                <h3 class="action-title">Lunar Skill Unregistered </h3>-->
                                                
<!--                                                <form method="POST">-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="product" id="product" class="form-control-custom" required>-->
<!--                                                            <option value="8" selected>Lunar Skill Test</option>-->
                                                            
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="subject" id="subject" class="form-control-custom" required>-->
<!--                                                            <option value="">Select subject</option>-->
<!--                                                               <option value="<?php echo "English" ?>"> English</option>-->
<!--                                                                <option value="<?php echo "Math" ?>"> Math</option>-->
                                                               
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                    </div>-->
                                                   
<!--                                                    <div class="form-group">-->
<!--                                                        <select name="schedule" id="schedule" class="form-control-custom" title="Click for Test Details" required>-->
                                                            
<!--                                                        </select>-->
<!--                                                    </div>-->
                                                   
                
<!--                                                        <div class="form-group">-->
<!--                                                           <div class="accordion inner-accordion" id="mainAccordion2">-->
                
                                                            <!-- MAIN ACCORDION -->
<!--                                                            <div class="accordion-item">-->
<!--                                                                <h4 class="accordion-header">-->
<!--                                                                    <button type="button" class="accordion-button"-->
<!--                                                                        data-bs-toggle="collapse"-->
<!--                                                                        data-bs-target="#test">-->
<!--                                                                        Test Detail-->
<!--                                                                    </button>-->
<!--                                                                </h4>-->
                                                        
<!--                                                                <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">-->
<!--                                                                    <div class="accordion-body">-->
<!--                                                                        <div id="test_topic"></div>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                        
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                
                                                    <!--<div class="form-group">-->
                                                    <!--    <button type="submit" class="btn-action btn-primary" name="register" value="1">-->
                                                    <!--        <i class="fas fa-rocket"></i> Register & Download-->
                                                    <!--    </button>-->
                                                    <!--</div>-->
                                                
<!--                                                </form>-->
                                                
                            
<!--                                      </div>-->
                        
<!--                                            </div>-->
<!--                                        </div>-->
                                        
                                        
                                        
<!--                                    </div>-->
                
                
                                    <!-- Unattempted Tests -->
                                    <!--<div class="accordion-item position-relative">-->
                                    <!--    <h5 class="accordion-header position-relative">-->
                                    <!--        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#unattempted">-->
                                    <!--            Unattempted Tests-->
                                    <!--        </button>-->
                
                                    <!--        <span class="badge bg-warning text-dark position-absolute top-50 end-0 translate-middle-y me-3">-->
                                    <!--           Tests Wating: Start Attempt!-->
                                    <!--        </span>-->
                                    <!--    </h5>-->
                
                                    <!--    <div id="unattempted" class="accordion-collapse collapse" data-bs-parent="#statusAccordion">-->
<!--                                    <div class="custom-accordion-item">-->
<!--    <button class="accordion-button collapsed custom-accordion-btn"-->
<!--    data-bs-toggle="collapse"-->
<!--    data-bs-target="#sub2">-->

<!--    <span>Unattempted Test</span>-->

<!--    <div class="d-flex align-items-center gap-2">-->
<!--        <span class="badge bg-warning">-->
<!--            Tests Waiting : Start Attempt!-->
<!--        </span>-->
<!--        <span class="plus-icon" id="icon-sub2">+</span>-->
<!--    </div>-->

<!--</button>-->

<!--    <div id="sub2" class="accordion-collapse collapse">-->
<!--                                            <div class="accordion-body">-->
<!--                                               <div class="action-section" data-aos="fade-up">-->
<!--                                                <h3 class="action-title">Lunar Skill Unattempted </h3>-->
                                                
<!--                                                <form method="POST">-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="product" id="product" class="form-control-custom" required>-->
<!--                                                            <option value="8" selected>Lunar Skill Test</option>-->
                                                            
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="subject" id="unsubject" class="form-control-custom" required>-->
<!--                                                            <option value="">Select subject</option>-->
<!--                                                             <option value="<?php echo "English" ?>"> English</option>-->
<!--                                                                <option value="<?php echo "Math" ?>"> Math</option>-->
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                    </div>-->
                                                   
<!--                                                    <div class="form-group">-->
<!--                                                        <select name="schedule" id="unschedule" class="form-control-custom" title="Click for Test Details" required>-->
                                                           
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                     <div class="form-group">-->
<!--                                                            <div class="accordion inner-accordion" id="mainAccordion3">-->
                
                                                            <!-- MAIN ACCORDION -->
<!--                                                            <div class="accordion-item">-->
<!--                                                                <h4 class="accordion-header">-->
<!--                                                                    <button type="button" class="accordion-button"-->
<!--                                                                        data-bs-toggle="collapse"-->
<!--                                                                        data-bs-target="#test">-->
<!--                                                                        Test Detail-->
<!--                                                                    </button>-->
<!--                                                                </h4>-->
                                                        
<!--                                                                <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">-->
<!--                                                                    <div class="accordion-body">-->
<!--                                                                        <div id="untest_topic"></div>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                        
<!--                                                        </div>-->
<!--                                                    </div>-->
                                                
                                                
                                                
<!--                                                </form>-->
                                                
                            
<!--                                      </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                
                
                                    <!-- Attempted Tests -->
                                    <!--<div class="accordion-item position-relative">-->
                                    <!--    <h5 class="accordion-header position-relative">-->
                                    <!--        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#attempted">-->
                                    <!--            Attempted Tests-->
                                    <!--        </button>-->
                
                                    <!--        <span class="badge bg-success position-absolute top-50 end-0 translate-middle-y me-3">-->
                                    <!--           Test Completed-->
                                    <!--        </span>-->
                                    <!--    </h5>-->
                
                                    <!--    <div id="attempted" class="accordion-collapse collapse" data-bs-parent="#statusAccordion">-->
<!--                                    <div class="custom-accordion-item">-->
<!--    <button class="accordion-button collapsed custom-accordion-btn"-->
<!--        data-bs-toggle="collapse"-->
<!--        data-bs-target="#sub3">-->

<!--        <span>Attempted Test</span>-->
<!--            <div class="d-flex align-items-center gap-2">-->
<!--        <span class="badge bg-success">-->
<!--             Test Completed!-->
<!--        </span>-->
<!--        <span class="plus-icon" id="icon-sub3">+</span>-->
<!--    </div>-->
<!--    </button>-->

<!--    <div id="sub3" class="accordion-collapse collapse">-->
<!--                                            <div class="accordion-body">-->
<!--                                                 <div class="action-section" data-aos="fade-up">-->
<!--                                                <h3 class="action-title">Lunar Skill Attempted </h3>-->
                                                
<!--                                                <form method="POST">-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="product" id="product" class="form-control-custom" required>-->
<!--                                                            <option value="8" selected>Lunar Skill Test</option>-->
                                                            
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                        <div class="col-lg-6"> <div class="form-group">-->
<!--                                                        <select name="subject" id="attemsubject" class="form-control-custom" required>-->
<!--                                                             <option value="<?php echo "English" ?>"> English</option>-->
<!--                                                                <option value="<?php echo "Math" ?>"> Math</option>-->
<!--                                                        </select>-->
<!--                                                    </div></div>-->
<!--                                                    </div>-->
                                                   
<!--                                                    <div class="form-group">-->
<!--                                                        <select name="schedule" id="attemschedule" class="form-control-custom" title="Click for Test Details" required>-->
                                                            <!--<option value="">Select Competition</option>-->
                                                            <?php // foreach ($query5->result() as $row) { ?>
                                                                <!--<option value="<?php //echo $row->series; ?>">-->
                                                                    <?php //echo $row->season.' - '.$row->subject.' - '.$row->series.' - '.$row->type; ?>
                                                                <!--</option>-->
                                                            <?php //} ?>
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                     <div class="form-group">-->
<!--                                                           <div class="accordion inner-accordion" id="mainAccordion3">-->
                
                                                        <!-- MAIN ACCORDION -->
<!--                                                        <div class="accordion-item">-->
<!--                                                            <h4 class="accordion-header">-->
<!--                                                                <button type="button" class="accordion-button"-->
<!--                                                                    data-bs-toggle="collapse"-->
<!--                                                                    data-bs-target="#test">-->
<!--                                                                    Test Detail-->
<!--                                                                </button>-->
<!--                                                            </h4>-->
                                                    
<!--                                                            <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">-->
<!--                                                                <div class="accordion-body">-->
<!--                                                                    <div id="attemtest_topic"></div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
                                                    
<!--                                                    </div>-->
                                                    
                                                    
<!--                                                    </div>-->
                                                
                                                
                                                
<!--                                                </form>-->
                                                
                            
<!--                                      </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
                
<!--                                </div>-->
                                <!-- INNER ACCORDION END -->
                
<!--                            </div>-->
<!--                        </div>-->



                    </div>
                
                   </div>
                    
                    
                </div> 
    		
    		
            
            
            </div>
        
        </div>
        
    </section>
    
    
    <section style="background-color:#ffffff;">
      	
    		
        <!--<div class="container">-->
            
        <!--</div>-->
            
            <div class="row" id="namecard">
                <div class="col-md-12">
                    
            </div>
        </div>
            
            
            
            
        </div>
        
    </section>
    
    
          
     <script>
$(document).ready(function () {
    var allRanks = [];
    var currentPage = 1;
    var rowsPerPage = 10;

    $('#searchBtn').on('click', function () {
        var product_name = $('#productName').val();
        var level_id     = $('#level_id').val();
        var period       = $('#period').val();

        $('#rankTableBody').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
        $('#paginationWrapper').html('');
        hideAlert();

        $.ajax({
            url: '<?php echo base_url(); ?>cin_login/get_rank_holders',
            type: 'POST',
            data: {
                product_name: product_name,
                level_id: level_id,
                period: period
            },
            dataType: 'json',
            success: function (response) {
                if (response.success && response.ranks.length > 0) {
                    allRanks = response.ranks;
                    currentPage = 1;
                    renderTable();
                    renderPagination();
                    showAlert('success', response.message);
                } else {
                    allRanks = [];
                    $('#rankTableBody').html('<tr><td colspan="6" class="text-center text-muted">No rank holders found.</td></tr>');
                    $('#paginationWrapper').html('');
                    showAlert('warning', response.message);
                }
            },
            error: function (xhr, status, error) {
                allRanks = [];
                $('#rankTableBody').html('<tr><td colspan="6" class="text-center text-danger">Server error. Please try again.</td></tr>');
                $('#paginationWrapper').html('');
                showAlert('danger', 'Request failed: ' + error);
            }
        });
    });

    function renderTable() {
        var start = (currentPage - 1) * rowsPerPage;
        var end   = start + rowsPerPage;
        var pageData = allRanks.slice(start, end);
        var html = '';

        $.each(pageData, function (index, row) {
            var globalIndex = start + index + 1;
            html += '<tr>';
            html += '<td>' + globalIndex + '</td>';
            html += '<td>' + row.student_name + '</td>';
            html += '<td>' + row.level_name + '</td>';
            
            html += '<td>' + row.rank + '</td>';
           
            html += '</tr>';
        });

        $('#rankTableBody').html(html);
    }

    function renderPagination() {
        var totalPages = Math.ceil(allRanks.length / rowsPerPage);
        if (totalPages <= 1) {
            $('#paginationWrapper').html('');
            return;
        }

        var html = '<nav><ul class="pagination justify-content-center mb-0">';

        // Previous button
        html += '<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') + '">';
        html += '<a class="page-link" href="#" data-page="' + (currentPage - 1) + '">&laquo;</a></li>';

        // Page numbers with ellipsis
        for (var i = 1; i <= totalPages; i++) {
            if (
                i === 1 ||
                i === totalPages ||
                (i >= currentPage - 1 && i <= currentPage + 1)
            ) {
                html += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '">';
                html += '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                html += '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
        }

        // Next button
        html += '<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') + '">';
        html += '<a class="page-link" href="#" data-page="' + (currentPage + 1) + '">&raquo;</a></li>';

        html += '</ul></nav>';

        // Row count info
        var start = (currentPage - 1) * rowsPerPage + 1;
        var end   = Math.min(currentPage * rowsPerPage, allRanks.length);
        html += '<p class="text-muted text-center small mt-2 mb-0">Showing ' + start + '–' + end + ' of ' + allRanks.length + ' records</p>';

        $('#paginationWrapper').html(html);
    }

    // Pagination click handler (delegated)
    $(document).on('click', '#paginationWrapper .page-link', function (e) {
        e.preventDefault();
        var page = parseInt($(this).data('page'));
        var totalPages = Math.ceil(allRanks.length / rowsPerPage);
        if (isNaN(page) || page < 1 || page > totalPages) return;
        currentPage = page;
        renderTable();
        renderPagination();
    });

    function showAlert(type, message) {
        $('#alertMsg')
            .removeClass('d-none alert-success alert-warning alert-danger alert-info')
            .addClass('alert-' + type)
            .text(message);
    }

    function hideAlert() {
        $('#alertMsg').addClass('d-none').text('');
    }
});
</script>                
    
    
    
     <!-- Modal Overlay -->
    <div class="modal-overlay" id="congratsModal">
        <div class="congratulations-modal">
            <!-- Floating Stars -->
            <div class="floating-stars">
                <span class="star">⭐</span>
                <span class="star">🌟</span>
                <span class="star">✨</span>
                <span class="star">💫</span>
                <span class="star">⭐</span>
                <span class="star">🌟</span>
            </div>

            <!-- Header -->
            <div class="modal-header">
                <div class="trophy-container">
                    🏆
                </div>
                <h1 class="modal-title">Congratulations!</h1>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Star Speller Badge -->
                <div class="achievement-badge star-speller" id="starSpellerBadge" style="display: none;">
                    <span class="achievement-icon">🌟</span>
                    <span>You are a STAR SPELLER!</span>
                </div>

                <!-- Best Performer Badge -->
                <div class="achievement-badge best-performer" id="bestPerformerBadge" style="display: none;">
                    <span class="achievement-icon">🏅</span>
                    <span>You are a BEST PERFORMER!</span>
                </div>

                <!-- Motivational Text -->
                <p class="motivational-text">
                    Keep shining and spelling strong! 💪📚<br>
                    Your hard work and dedication have paid off!
                </p>

                <!-- Close Button -->
                <button class="close-btn" onclick="closeModal()">
                    Continue Your Journey
                </button>
            </div>
        </div>
    </div>
    
<?php
    $StarSpellerRaw   = $StarSpeller   ?? null;
    $BestPerformerRaw = $BestPerformer ?? null;
    
    $isStarSpeller   = (strtolower((string)$StarSpellerRaw) === 'yes');
    $isBestPerformer = (strtolower((string)$BestPerformerRaw) === 'yes');
    
    $isValidPeriod   = ((string)$period === '14');

?>    

<script>
document.getElementById('classDropdown').addEventListener('change', function () {
    var btn = document.getElementById('registerBtn');

    if (this.value !== '') {
        btn.style.pointerEvents = 'auto';
        btn.style.opacity = '1';
    } else {
        btn.style.pointerEvents = 'none';
        btn.style.opacity = '0.6';
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const checkboxes = document.querySelectorAll('input[name="products[]"]');
    const btn = document.getElementById('registerBtn');

    checkboxes.forEach(chk => {
        chk.addEventListener('change', function () {

            // ✅ Uncheck all others
            checkboxes.forEach(c => {
                if (c !== this) c.checked = false;
            });

            // ✅ If checked → enable button
            if (this.checked) {
                btn.style.pointerEvents = 'auto';
                btn.style.opacity = '1';

                // set URL
                btn.href = "<?php echo base_url('Cin_login/enroll2/'); ?>" + this.value;

            } else {
                // ❌ If unchecked → disable button
                btn.style.pointerEvents = 'none';
                btn.style.opacity = '0.6';
                btn.href = "javascript:void(0);";
            }
        });
    });

});
</script>
<script>


    const isStarSpeller   = <?= json_encode($isStarSpeller); ?>;
    const isBestPerformer = <?= json_encode($isBestPerformer); ?>;
    const isValidPeriod   = <?= json_encode($isValidPeriod); ?>;
    
    // alert(isStarSpeller);

    window.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('congratsModal');

        // Default: hide modal
        modal.style.display = 'none';

        // ✅ Step 1: Check period
        if (isValidPeriod === true) {

            modal.style.display = 'none';

            // ✅ Step 2: Check achievements
            if (isStarSpeller === true || isBestPerformer === true) {
               
                
                if (isStarSpeller) {
                    document.getElementById('starSpellerBadge').style.display = 'inline-block';
                }
            
                if (isBestPerformer) {
                    document.getElementById('bestPerformerBadge').style.display = 'inline-block';
                }
    

                modal.style.display = 'flex'; // 🎉 SHOW MODAL
                modal.style.display = 'none';

                
            }
        }
        // else → modal stays hidden
    });

    function closeModal() {
        const modal = document.getElementById('congratsModal');
        modal.style.animation = 'fadeOut 0.5s ease-out forwards';
        setTimeout(() => modal.style.display = 'none', 500);
    }

    function createFireworks() {
        const header = document.querySelector('.modal-header');
        if (!header) return;

        const colors = ['#FFD700', '#FF69B4', '#00CED1', '#FF6347', '#9370DB'];

        const interval = setInterval(() => {
            for (let i = 0; i < 4; i++) {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.style.background = colors[Math.floor(Math.random() * colors.length)];
                firework.style.left = Math.random() * 100 + '%';
                firework.style.top = Math.random() * 100 + '%';
                firework.style.setProperty('--x', (Math.random() - 0.5) * 200 + 'px');
                firework.style.setProperty('--y', (Math.random() - 0.5) * 200 + 'px');

                header.appendChild(firework);
                setTimeout(() => firework.remove(), 1000);
            }
        }, 600);

        setTimeout(() => clearInterval(interval), 4000);
    }

    // Fade animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: scale(0.9);
            }
        }
    `;
    document.head.appendChild(style);
</script>

<!--accordion script start-->
<script>
document.querySelectorAll('.accordion-collapse').forEach(function(el){

    el.addEventListener('show.bs.collapse', function(){
        let id = el.id;
        let icon = document.getElementById('icon-'+id);
        if(icon) icon.innerHTML = '✕';
    });

    el.addEventListener('hide.bs.collapse', function(){
        let id = el.id;
        let icon = document.getElementById('icon-'+id);
        if(icon) icon.innerHTML = '+';
    });

});
</script>
<!--accordion script end-->

</body>


<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    
<script>
    const rankList = [
        <?php 
        foreach($rank_list as $list) {
            echo '{';
            echo 'name: "' . addslashes($list->student_name) . '",';
            echo 'rank: ' . $list->rank . ',';
            echo 'school: "' . addslashes($list->school) . '"';
            echo '},';
        }
        ?>
    ];
</script>    
    
<script>
    $(function () {
    
        const rowsPerPage = 5;
        const rows = $('#rankTable tbody .rank-row');
        const rowsCount = rows.length;
        const pageCount = Math.ceil(rowsCount / rowsPerPage);
    
        function showPage(page) {
            rows.hide();
            rows.slice((page - 1) * rowsPerPage, page * rowsPerPage).show();
            $('#pagination li').removeClass('active');
            $('#pagination li[data-page="' + page + '"]').addClass('active');
        }
    
        for (let i = 1; i <= pageCount; i++) {
            $('#pagination').append(
                '<li class="page-item ' + (i === 1 ? 'active' : '') + '" data-page="' + i + '">' +
                '<a class="page-link" href="#">' + i + '</a></li>'
            );
        }
    
        $('#pagination').on('click', 'li', function (e) {
            e.preventDefault();
            showPage($(this).data('page'));
        });
    
        showPage(1);
    });
</script>

<script>   
    
 $(document).ready(function() {
  $("#success-alert").hide();
  
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
   
  });
});   
</script>

<script>
    
$(document).ready(function(){
        
   $("#edit_guard").change(function(){
      window.location.reload(true);
   });
   $("#edit_guard").click(function(event){
       event.preventDefault();
       if($('.update').is(':hidden')){
           $('.update').show();
       }else{
           $('.update').hide();
       }                                                                                                                
       return false;
   })
   
   
        
            
   
   
   
   
});





</script>


    <script>
        // Add click animation
        // document.querySelector('.glow-btn').addEventListener('click', function(e) {
        //     // Create ripple effect on click
        //     const ripple = document.createElement('span');
        //     ripple.style.position = 'absolute';
        //     ripple.style.width = '20px';
        //     ripple.style.height = '20px';
        //     ripple.style.background = 'rgba(255,255,255,0.6)';
        //     ripple.style.borderRadius = '50%';
        //     ripple.style.transform = 'translate(-50%, -50%)';
        //     ripple.style.animation = 'rippleEffect 0.6s ease-out';
        //     ripple.style.pointerEvents = 'none';
            
            // const rect = this.getBoundingClientRect();
            // ripple.style.left = (e.clientX - rect.left) + 'px';
            // ripple.style.top = (e.clientY - rect.top) + 'px';
            
            // this.appendChild(ripple);
            
            // setTimeout(() => ripple.remove(), 600);
        // });

        // Add dynamic ripple animation
        // const style = document.createElement('style');
        // style.textContent = `
        //     @keyframes rippleEffect {
        //         to {
        //             width: 300px;
        //             height: 300px;
        //             opacity: 0;
        //         }
        //     }
        // `;
        // document.head.appendChild(style);
    </script>
    
    
    
       
    
<?php include("footer.php");?>

<script>
 $("#subject").change(function() {
        var subject = this.value;
        $.ajax({
            url: "https://marrs.in/lunar/cin_login/schedule",
            data: { subject : subject },
            type: 'POST',
            success: function(result) {
                $("#schedule").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
     $("#unsubject").change(function() {
        var subject = this.value;
        $.ajax({
            url: "https://marrs.in/lunar/cin_login/unschedule",
            data: { subject : subject },
            type: 'POST',
            success: function(result) {
                $("#unschedule").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
     $("#attemsubject").change(function() {
        var subject = this.value;
        $.ajax({
            url: "https://marrs.in/lunar/cin_login/attemschedule",
            data: { subject : subject },
            type: 'POST',
            success: function(result) {
                $("#attemschedule").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
            
$(document).ready(function() {

    

    $("#schedule").change(function() {

        var series = $(this).find(':selected').data('id');
         var scdid = $(this).find(':selected').data('scdid');
         
        $.ajax({
            url: "<?= base_url('cin_login/description') ?>",
            type: "POST",
            data: { scdid:scdid },
            success: function(res) {

                var data = JSON.parse(res);  // This is already an array
            
                // Start table
                var html = '<table style="width:100%; border:1px solid #000; border-collapse:collapse;">';
                html += '<tr>';
                html += '<th style="border:1px solid #000; padding:8px;">Title</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Topic</th>'; 
                html += '<th style="border:1px solid #000; padding:8px;">Description</th>'; 
                html += '</tr>';
            
                if(data.length === 0){
                    html += '<tr>';
                    html += '<td colspan="3" style="text-align:center; padding:10px;">No data found</td>';
                    html += '</tr>';
                } else {
            
                    $.each(data, function(i, item) {  // Loop directly over data
            
                        html += '<tr>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ (item.title || '-') +'</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ (item.topic || '-') +'</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ (item.description || '-') +'</td>';
                        html += '</tr>';
            
                    });
            
                }
            
                html += '</table>';
            
                $("#test_topic").html(html);
            
                // ⭐ OPEN ACCORDION AFTER DATA LOAD
               // $("#accordionTests").slideDown();
            
            },
            error:function(err){
                console.log(err);
            }
        });

    });

});

$(document).ready(function() {

    var base_url = "<?= base_url('Cin_login/generate_login_url'); ?>";
    var score_url = "<?= base_url('Cin_login/generate_login_url'); ?>";

    $("#unschedule").change(function() {

        var series = $(this).find(':selected').data('id');

        $.ajax({
            url: "<?= base_url('cin_login/unscd_description') ?>",
            type: "POST",
            data: { series: series },
            success: function(res) {

                var data = JSON.parse(res);

                var html = '<table style="width:100%; border:1px solid #000; border-collapse:collapse;">';
                html += '<tr>';
                html += '<th style="border:1px solid #000; padding:8px;">Test Number</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Week</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Status</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Action</th>';
                html += '</tr>';

                if(data.exams.length === 0){
                    html += '<tr>';
                    html += '<td colspan="4" style="text-align:center; padding:10px;">No data found</td>';
                    html += '</tr>';
                } else {

                    $.each(data.exams, function(i, item) {

                        html += '<tr>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ item.exam_id +'</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ item.week +'</td>';

                        if(item.status == 0){
                            html += '<td style="border:1px solid #000; padding:8px;"><span style="background:red;color:#fff;padding:3px 8px;border-radius:12px;font-weight:bold;">Not Attempted</span></td>';
                        }else{
                            html += '<td style="border:1px solid #000; padding:8px;"><span style="background:green;color:#fff;padding:3px 8px;border-radius:12px;font-weight:bold;">Completed</span></td>';
                        }

                        html += '<td style="border:1px solid #000; padding:8px;">';

                        if(item.status == 0){

                            html += '<form method="POST" action="'+base_url+'">';
                            html += '<input type="hidden" name="series" value="'+data.series+'">';
                            html += '<input type="hidden" name="status" value="Paid">';
                            html += '<input type="hidden" name="exam_id" value="'+item.exam_id+'">';
                            html += '<button type="submit" class="btn btn-success"><i class="fas fa-chalkboard-teacher"></i> Start Test</button>';
                            html += '</form>';

                        }else{

                            html += '<form method="POST" action="'+score_url+'">';
                            html += '<input type="hidden" name="series" value="'+data.series+'">';
                            html += '<input type="hidden" name="exam_id" value="'+item.exam_id+'">';
                            html += '<button type="submit" class="btn btn-info">View Score</button>';
                            html += '</form>';

                        }

                        html += '</td>';
                        html += '</tr>';

                    });

                }

                html += '</table>';

                $("#untest_topic").html(html);

                // ⭐ OPEN ACCORDION AFTER DATA LOAD
                $("#accordionTests").slideDown();

            },
            error:function(err){
                console.log(err);
            }
        });

    });

});

$(document).ready(function() {

    var base_url = "<?= base_url('Cin_login/generate_login_url'); ?>";
    var score_url = "<?= base_url('Cin_login/generate_login_url'); ?>";

    $("#attemschedule").change(function() {

        var series = $(this).find(':selected').data('id');

        $.ajax({
            url: "<?= base_url('cin_login/attemscd_description') ?>",
            type: "POST",
            data: { series: series },
            success: function(res) {

                var data = JSON.parse(res);

                var html = '<table style="width:100%; border:1px solid #000; border-collapse:collapse;">';
                html += '<tr>';
                html += '<th style="border:1px solid #000; padding:8px;">Test Number</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Week</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Status</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Action</th>';
                html += '</tr>';

                if(data.exams.length === 0){
                    html += '<tr>';
                    html += '<td colspan="4" style="text-align:center; padding:10px;">No data found</td>';
                    html += '</tr>';
                } else {

                    $.each(data.exams, function(i, item) {

                        html += '<tr>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ item.exam_id +'</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">'+ item.week +'</td>';

                        if(item.status == 0){
                            html += '<td style="border:1px solid #000; padding:8px;"><span style="background:red;color:#fff;padding:3px 8px;border-radius:12px;font-weight:bold;">Not Attempted</span></td>';
                        }else{
                            html += '<td style="border:1px solid #000; padding:8px;"><span style="background:green;color:#fff;padding:3px 8px;border-radius:12px;font-weight:bold;">Completed</span></td>';
                        }

                        html += '<td style="border:1px solid #000; padding:8px;">';

                        if(item.status == 0){

                            html += '<form method="POST" action="'+base_url+'">';
                            html += '<input type="hidden" name="series" value="'+data.series+'">';
                            html += '<input type="hidden" name="status" value="Paid">';
                            html += '<input type="hidden" name="exam_id" value="'+item.exam_id+'">';
                            html += '<button type="submit" class="btn btn-success"><i class="fas fa-chalkboard-teacher"></i> Start Test</button>';
                            html += '</form>';

                        }else{

                            html += '<form method="POST" action="'+score_url+'">';
                            html += '<input type="hidden" name="series" value="'+data.series+'">';
                            html += '<input type="hidden" name="exam_id" value="'+item.exam_id+'">';
                            html += '<button type="submit" class="btn btn-info">View Score</button>';
                            html += '</form>';

                        }

                        html += '</td>';
                        html += '</tr>';

                    });

                }

                html += '</table>';

                $("#attemtest_topic").html(html);

                // ⭐ OPEN ACCORDION AFTER DATA LOAD
                $("#accordionTests").slideDown();

            },
            error:function(err){
                console.log(err);
            }
        });

    });

});   
    
</script>

<?php $cin = $this->session->userdata('cin');

 $studentdatablank =  $this->db->get_where('cin_list',array('cin'=>$cin))->row();
if(empty($studentdatablank)){  ?>
<script>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#exampleModal').modal('show');
    });
</script>
    
</script>
<?php } ?>

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>