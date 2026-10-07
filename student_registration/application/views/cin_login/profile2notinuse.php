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
    $clevel = $query->row();
    $clevel_id = $clevel->clevel;
    $product_nameee = $clevel->product_name;
    $level_name = $clevel->level_name;
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
    $r=$query->row();
    $initials=$r->initials;
    // echo $initials;

    $str = str_replace($initials, "", $student[0]['cin']); 
    $firstTwoChars = substr($str, 0, 2);
    

    if($period >= 13){
        // echo $firstTwoChars;
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('in13',$firstTwoChars);
        $query=$this->db->get();
        $r=$query->row();
        
        $product_name=$r->product_name;
       
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
    
    $pr_ar = ['MaRRS International Math Bee','MaRRS International Spelling Bee','MaRRS Primary Colors - English','MaRRS Primary Colors - Math','MaRRS Primary Colors - Science','MaRRS Primary Colors - Humanities','MaRRS Play 2 Learn','MaRRS Preschool Bee Humanities','MaRRS Preschool Bee Science','MaRRS Preschool Bee Math','MaRRS Preschool Bee English'];
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
    
    if($r->image_name){
        $image_name='https://marrs.in/student_registration/certificate_logo/'.$image_name=$r->image_name;
    }
    // echo $image_name;
    
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
    $this->db->select('*');
    $this->db->from('rank_list');
    $this->db->where('period_id',$period);
    $this->db->where('product_name',$product_name);
    // $this->db->where('level_name',$level_name);
    $this->db->where('class',$student[0]['class']);
    $query = $this->db->get();
    $rank_list = $query->result();
	    
    
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
    width: 400px;
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
    width: 400px;
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
<body >

    <section>
        <div class="container-fluid px-4">
            
            <div class="row">
   <a href=""><div class="marquee">
  🚨 <span>Attention! MaRRS Primary Colors International Champtionship-Registration Going On. Closeing Date:</span> 26-04-2026 🚨
</div></a>

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

if (!empty($rank_list) && !in_array($product, $excluded_products)) 
{ ?>    
                                        
                                                <div class="col-12 text-center" id="profile">
                                                <h2 class="my-2 text-dark"> MaRRS Competitions  </h2>  
                                            
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
                                
                                <a class="btn btn-success"
                                   href="<?php echo base_url();?>Cin_login/enroll">
                                   Register for Next Level
                                </a>
                                <a class="btn btn-success" href="<?php echo base_url();?>Cin_login/enroll">Download Learning Material</a>
            
                            <?php } else { ?>
            
                                <a class="btn btn-success"
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
            
                    
                    } else { ?>
            
                        <a class="btn btn-success"
                           href="<?php echo base_url();?>Cin_login/register_close">
                           Download Learning Material
                        </a>
            
                    <?php } ?>
            
            
                    <!-- RESULT BUTTON -->
                    <?php if($period=='12'){ ?>
            
                        <a class="btn btn-primary "
                           href="<?php echo base_url();?>Cin_login/result_view22">
                           View Result & Download Certificate
                        </a>
            
                    <?php } else { ?>
            
                        <a class="btn btn-primary "
                           href="<?php echo base_url();?>Cin_login/result_view">
                           View Result & Download Certificate
                        </a>
            
                    <?php } ?>
            
                <!--</div>-->
            
                <!-- INFO TEXT -->
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
                                        
                                        
                                            
                            
                                            <div class="rank-wrapper text-center">
                                            
                                                <button class='btn btn-outline-primary'> 
                                                    <a href="https://api.aviansys.in/rank_list/<?php echo $rank_list[0]->level_name.'/'.$rank_list[0]->period_id.'/'.$product; ?>" target="_BLANK"> Download Complete Rank List </a>
                                                </button>
                                                
                                                <button class='btn btn-outline-warning'> 
                                                    <a href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" target="_BLANK"> View Gallery </a>
                                                </button>
                                                </div>
                                                
                                            <div class="col-12 text-center my-2">
            
                                                <h2 class="rank-title">🏆 Top Rank Holders<br><?php print_r($rank_list[0]->level_name); ?></h2>
                                            
                <div class="row justify-content-center">
                                                    <?php foreach ($rank_list as $list): ?>
                                                        <?php
                                                            $rankLabel = strtoupper(str_replace('-', ' ', $list->rank));
                                                            if (!in_array($rankLabel, ['RANK 1','RANK 2','RANK 3'])) continue;
                                                        ?>
                                                        <div class="col-md-3 mb-3">
                                                            <div class="card shadow-sm p-3">
                                                                <!--<div class="card-body text-center">-->
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
                                                                        <?php if ($isStarSpeller): $StarSpeller = $list->speller; ?>
                                                                            🌟 You are a <strong class='text-success'>STAR SPELLER !</strong><br>
                                                                        <?php endif; ?>
                                                                    
                                                                        <?php if ($isBestPerformer): $BestPerformer = $list->performer;?>
                                                                            🏆 You are also a <strong class='text-info'>BEST PERFORMER !</strong>
                                                                        <?php endif; ?>
                                                                    </medium>
                            
                            
                                                                <!--</div>-->
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            
                                                
                                            
                                            </div>
                                        
                                            
                                        </div>
                                        
                                        
                                        
                                        
            <div class="col-12 text-center shadow-lg p-2 mb-2 my-1 bg-white rounded">
            <div class="col-12 text-center">
                <?php if($image_name){ ?>
                    <div class="mt-3">
                        <img src="<?php echo $image_name; ?>" 
                             class="img-fluid"
                             style="max-width:200px;">
                    </div>
                <?php } ?>
            </div>
                                            <h3 class="rank-title mt-2">All Rank Holders</h3>
                                            
                                                <div class="table-responsive">
                                                    <table class="table rank-table" id="rankTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Rank</th>
                                                                <!--<th>Level</th>-->
                                                                <th>Student</th>
                                                                <th>School</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($rank_list as $list): ?>
                                                            <tr class="rank-row">
                                                                <td><?= htmlspecialchars($list->rank) ?></td>
                                                                <!--<td><?php  //htmlspecialchars($list->level_name) ?></td>-->
                                                                <td><?= htmlspecialchars($list->student_name) ?></td>
                                                                <td><?= htmlspecialchars($list->school) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            
                                                <nav>
                                                    <ul class="pagination justify-content-center" id="pagination"></ul>
                                                </nav>
                                            
                                                <div class="promo-footer">
                                                    <p>✨ Congratulations to all achievers!</p>
                                                    <p class="brand">Powered by <strong>MaRRS REDISCOVER</strong></p>
                                                </div>
                                        </div>
                                        
                                        
                                    
                                    
                                    <?php }
                                    
                                    else { 
                                        
                                       
                                            // if ($this->session->userdata('cin') == 'S22A110003') { 
                                                $cin = $this->session->userdata('cin');
                                                //$status= $this->session->userdata('status');
                                                // print_r($_SESSION);
                                                // print_r( $student);
                                                //if (!empty($cin) && substr($cin, 0, 1) === 'P' || substr($cin, 0, 1) === 'J22' ) {
                                                $cin = trim($cin);
        //   echo $cin.'ok';  

// 👉 Define allowed prefixes (first 3 characters)
$allowed_prefixes = ['P22A','P22B','J22A', 'J22B','23SJ','24SJ','22PL','23PL','24PL','22PH','23PH','24PH','22PM','23PM','24PM','22PB','23PB','24PB','22PS','23PS','24PS'];

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

<?php } }  ?>

      