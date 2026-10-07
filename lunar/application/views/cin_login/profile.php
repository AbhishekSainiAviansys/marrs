<?php include('header.php'); ?>

<?php
// Check if student data exists
if (!isset($student) || empty($student)) {
    // Handle case when student data is not available
    redirect('login'); // or appropriate error handling
}

 $subject = $student[0]['subject'] ?? '';
 $series = $student[0]['series'] ?? '';
 $type = $student[0]['type'] ?? '';
 $state_id = $student[0]['state_id'] ?? '';




$query6 = $this->db->query("
    SELECT * FROM `lunar_subjects`
    WHERE status = 'Active'
");



// echo $this->db->last_query();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Lunar Assessments</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"/>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!--<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>-->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        :root {
            --primary: #4A5BF5;
            --secondary: #7B68EE;
            --accent: #FF7F50;
            --dark-blue: #1A3A8F;
            --light-blue: #E6F0FF;
            --purple: #9370DB;
            --bg-light: #F8F9FE;
            --text-dark: #2C3E50;
            --text-light: #64748B;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
           
        }

        /* Header with Logo Background */
        .header-banner {
            text-align:center;
            position: relative;
            height: 300px;
            margin-bottom: -80px;
            overflow: hidden;
            border-radius: 0 0 30px 30px;
        }

        .logo-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 70%;
            height: 75%;
            background: url('https://marrs.in/student_registration/certificate_logo/flunar.jpg') center/cover no-repeat;
        }

        .logo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /*background: linear-gradient(135deg, rgba(74, 91, 245, 0.9) 0%, rgba(123, 104, 238, 0.85) 100%);*/
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Profile Card */
        .profile-card {
            position: relative;
            z-index: 10;
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin: 0 auto;
            max-width: 90%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-img-container {
            position: relative;
            margin-top: -30px;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .profile-badge {
            display: inline-block;
            background: var(--light-blue);
            color: var(--primary);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .update-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .update-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 91, 245, 0.4);
            color: white;
        }

        /* Container */
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Section Title */
        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin: 40px 0 20px;
            text-align: center;
        }

        /* Info Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        /* Update these styles in your CSS */

.info-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    word-wrap: break-word; /* Add this */
    overflow: hidden; /* Add this */
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.info-icon {
    font-size: 30px;
    color: var(--primary);
    margin-bottom: 15px;
}

.info-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-light);
    margin-bottom: 5px;
    text-transform: uppercase; /* Add for consistency */
    letter-spacing: 0.5px; /* Add for better readability */
}

.info-value {
    font-size: 16px; /* Reduced from 18px */
    font-weight: 600;
    color: var(--text-dark);
    word-wrap: break-word; /* Add this */
    word-break: break-word; /* Add this */
    overflow-wrap: break-word; /* Add this */
    hyphens: auto; /* Add this for better text breaking */
    line-height: 1.4; /* Add this for better spacing */
}

/* Add responsive adjustments */
@media (max-width: 768px) {
    .info-card {
        padding: 20px 15px; /* Reduce padding on mobile */
    }
    
    .info-icon {
        font-size: 24px; /* Smaller icon on mobile */
        margin-bottom: 10px;
    }
    
    .info-title {
        font-size: 12px;
        margin-bottom: 3px;
    }
    
    .info-value {
        font-size: 14px; /* Smaller text on mobile */
        line-height: 1.3;
    }
}

@media (max-width: 480px) {
    .info-card {
        padding: 15px 10px;
    }
    
    .info-value {
        font-size: 13px;
    }
}

        /* Action Section */
        .action-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .action-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control-custom {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 91, 245, 0.1);
        }

        .btn-action {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(74, 91, 245, 0.4);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            color: white;
        }

        /* Details Section */
        .details-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .detail-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px;
            text-align: center;
        }

        .detail-icon {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .detail-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color:#ffffff;
        }

        .detail-body {
            padding: 20px;
        }

        .detail-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            flex: 0 0 40%;
            font-weight: 600;
            color: var(--text-light);
        }

        .detail-value {
            flex: 1;
            color: var(--text-dark);
        }

        /* Modal */
        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 15px 15px 0 0;
            border: none;
        }

        .modal-title {
            font-weight: 700;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border: none;
            padding: 15px 25px;
        }

        /* Success Alert */
        .alert-success-custom {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-banner {
                height: 200px;
            }
            
            .profile-img {
                width: 120px;
                height: 120px;
            }
            
            .info-grid, .details-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <style>.action-section {
            width: 100%;
            max-width: 1200px;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .exam-wrapper {
            background: white;
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .exam-wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102,126,234,0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            pointer-events: none;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .exam-heading {
            font-size: 2rem;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            position: relative;
            z-index: 1;
        }

        .exam-heading i {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .exam-summary {
            font-size: 1.1rem;
            color: #718096;
            margin-bottom: 2rem;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .exam-summary strong {
            color: #2d3748;
            font-weight: 700;
        }

        /* Progress Stats Row */
        .progress-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .stat-completed .stat-icon {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }

        .stat-pending .stat-icon {
            background: linear-gradient(135deg, #fc8181, #f56565);
            color: white;
        }

        .stat-text {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #a0aec0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2d3748;
        }

        /* Progress Bar */
        .progress-bar-container {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
            border-radius: 25px;
            overflow: hidden;
            height: 20px;
            margin-bottom: 2.5rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
            z-index: 1;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #48bb78 0%, #38a169 100%);
            border-radius: 25px;
            transition: width 1s ease-out;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(72, 187, 120, 0.4);
        }

        .progress-bar-fill::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .progress-percentage {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* Exam Grid */
        .exam-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .exam-card {
            background: linear-gradient(135deg, #f7fafc 0%, #aed6ff 100%);
            padding: 1.8rem 1.5rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .exam-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .exam-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .exam-card:hover::before {
            transform: scaleX(1);
        }

        .exam-card.completed {
            background: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%);
            border-color: rgba(72, 187, 120, 0.3);
        }

        .exam-card.completed::before {
            background: linear-gradient(90deg, #48bb78, #38a169);
        }

        .exam-card.pending {
            background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%);
            border-color: rgba(245, 101, 101, 0.3);
        }

        .exam-card.pending::before {
            background: linear-gradient(90deg, #fc8181, #f56565);
        }

        .exam-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .exam-card.completed .exam-icon {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.3);
        }

        .exam-card.pending .exam-icon {
            background: linear-gradient(135deg, #fc8181, #f56565);
            color: white;
            box-shadow: 0 5px 15px rgba(252, 129, 129, 0.3);
        }

        .exam-card:hover .exam-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .exam-series {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.8rem;
        }

        .exam-status {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
            box-shadow: 0 2px 10px rgba(72, 187, 120, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, #fc8181, #f56565);
            color: white;
            box-shadow: 0 2px 10px rgba(252, 129, 129, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #718096;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .exam-wrapper {
                padding: 2rem 1.5rem;
            }

            .exam-heading {
                font-size: 1.5rem;
            }

            .exam-summary {
                font-size: 1rem;
            }

            .progress-stats {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .exam-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 1rem;
            }

            .exam-card {
                padding: 1.5rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .exam-grid {
                grid-template-columns: 1fr;
            }
        }
/* Add this to your existing styles */
.exam-details {
    font-size: 0.85rem;
    color: #718096;
    margin-bottom: 0.8rem;
    padding: 0.5rem;
    background: rgba(255,255,255,0.5);
    border-radius: 8px;
}
</style>
<style>
.progress-bar-container {
    width: 100%;
    height: 18px;
    background: #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    margin-top: 15px;
}

.progress-bar-fill {
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #4f46e5, #6366f1);
    border-radius: 20px;
    transition: width 0.8s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: #fff;
    font-weight: 600;
}
.accor-cross-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:24px;
    height:24px;
    border:1px solid #dc3545;
    border-radius:50%;
    color:#dc3545;
    font-size:14px;
    cursor:pointer;
}
</style>
<?php
/* ================= API CALL ================= */
$cin = $_SESSION['cin'];
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://grademarker.online/api/GettingTheExam',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode([
        "cin" => $cin
    ]),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ]
]);

$response = curl_exec($curl);
curl_close($curl);

/* ================= PARSE RESPONSE ================= */
$responseArr = json_decode($response, true);
$seriesData = [];

if (!empty($responseArr['data'])) {

    foreach ($responseArr['data'] as $seriesRow) {

        $seriesName = $seriesRow['series'];

        $seriesData[$seriesName] = [
            'attempted' => [],
            'not_attempted' => [],
            'total' => 0,
            'percent' => 0
        ];

        foreach ($seriesRow['exams'] as $exam) {

            $seriesData[$seriesName]['total']++;

            if ($exam['status'] == 1) {
                $seriesData[$seriesName]['attempted'][] = $exam;
            } else {
                $seriesData[$seriesName]['not_attempted'][] = $exam;
            }
        }

        /* CALCULATE PROGRESS */
        $done = count($seriesData[$seriesName]['attempted']);
        $total = $seriesData[$seriesName]['total'];

        $seriesData[$seriesName]['percent'] =
            ($total > 0) ? round(($done / $total) * 100) : 0;
    }
}


?>


</head>
<body>
 

    <div class="container-fluid">
       
      
        <!-- Success Alert -->
        <?php if(!empty($this->session->flashdata('message'))) { ?>
            <div class="alert-success-custom" id="success-alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $this->session->flashdata('message');?>
            </div>
        <?php } ?>

        
        <div class="row  mt-5">

    <!-- LEFT SIDE -->
    <div class="col-lg-6">

        <div class="profile-card" data-aos="fade-up">
            <div class="profile-img-container">
                <?php if(!empty($student[0]['profile_img'])) { ?>
                    <img src="<?php echo base_url().'images/student/'.$student[0]['profile_img']; ?>" 
                         class="profile-img" alt="Profile"/>
                <?php } else { ?>
                    <img src="https://img.icons8.com/bubbles/100/4A5BF5/student-male.png" 
                         class="profile-img" alt="Profile"/>
                <?php } ?>
            </div>
            
            <h2 class="profile-name"><?php echo $student[0]['student_name']; ?></h2>
            <div class="profile-badge">Active Student</div>
            
            <a href="<?php echo base_url();?>Cin_login/edit_cin_login" class="update-btn">
                <i class="fas fa-edit"></i> Update Profile Details
            </a>
        </div>
       <!-- Info Cards -->
        <h3 class="section-title">Student Information</h3>

        <div class="info-grid">
      <div class="info-table-container">
    <div class="info-row" data-aos="fade-up" data-aos-delay="100">
        <div class="info-title"><i class="fas fa-hashtag"></i> CIN</div>
        <div class="info-value"><?php echo $student[0]['cin']; ?></div>
    </div>

    <div class="info-row" data-aos="fade-up" data-aos-delay="200">
        <div class="info-title"><i class="fas fa-graduation-cap"></i> Class</div>
        <div class="info-value"><?php echo $student[0]['class']; ?></div>
    </div>

    <div class="info-row" data-aos="fade-up" data-aos-delay="300">
        <div class="info-title"><i class="fas fa-envelope"></i> Email</div>
        <div class="info-value"><?php echo $student[0]['stud_email']; ?></div>
    </div>

    <div class="info-row" data-aos="fade-up" data-aos-delay="400">
        <div class="info-title"><i class="fas fa-phone"></i> Mobile</div>
        <div class="info-value"><?php echo $student[0]['stud_phone']; ?></div>
    </div>
</div>

<style>
/* Container */
.info-table-container {
    
    margin: 30px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    background: #fff;
    font-family: 'Poppins', sans-serif;
}

/* Each row */
.info-row {
    display: flex;
    justify-content: space-between;
    padding: 18px 25px;
    border-bottom: 1px solid #eee;
    transition: background 0.3s ease, transform 0.3s ease;
    cursor: default;
}

/* Last row no border */
.info-row:last-child {
    border-bottom: none;
}

/* Hover animation */
.info-row:hover {
    background: #f8f9fa;
    transform: translateX(5px);
}

/* Titles */
.info-title {
    font-weight: 600;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1rem;
}

/* Values */
.info-value {
    font-weight: 500;
    color: #212529;
    font-size: 1rem;
}

/* Responsive for mobile */
@media (max-width: 576px) {
    .info-row {
        flex-direction: column;
        align-items: flex-start;
        padding: 12px 18px;
    }
    .info-value {
        margin-top: 5px;
    }
}
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
    color: #ffff;
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
</style>
        </div>
        
          <!-- Details Section -->
        <h3 class="section-title">Additional Details</h3>
        <div class="details-section">
            <!-- Guardian Details -->
            <div class="detail-card" data-aos="fade-right">
                <div class="detail-header">
                    <div class="detail-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="detail-title">Guardian Details</h4>
                </div>
                <div class="detail-body">
                    <div class="detail-row">
                        <div class="detail-label">Father Name</div>
                        <div class="detail-value"><?php echo $student[0]['father_name']; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Mother Name</div>
                        <div class="detail-value"><?php echo $student[0]['mother_name']; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Address</div>
                        <div class="detail-value"><?php echo $student[0]['address1']; ?></div>
                    </div>
                </div>
            </div>

            <!-- School Details -->
            <div class="detail-card" data-aos="fade-left">
                <div class="detail-header">
                    <div class="detail-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <h4 class="detail-title">School Details</h4>
                </div>
                <div class="detail-body">
                    <?php
                    $schoolName = $student[0]['school_name'] ?? '';
                    $schoolId = $student[0]['school_id'] ?? '';
                    $schoolAddress = $student[0]['school_address1'] ?? '';
                    
                    if (empty($schoolName) && !empty($schoolId)) {
                        $school = $this->db->get_where('school_new', ['id' => $schoolId])->row();
                        $schoolName = $school->school_name ?? '';
                        $schoolAddress = ($school->school_address ?? '') . ' ' . 
                                       ($school->location ?? '') . ' ' . 
                                       ($school->city ?? '');
                    }
                    ?>

                    <?php if (!empty($schoolName)) { ?>
                        <div class="detail-row">
                            <div class="detail-label">School Name</div>
                            <div class="detail-value"><?php echo htmlspecialchars($schoolName); ?></div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">School Address</div>
                            <div class="detail-value"><?php echo htmlspecialchars($schoolAddress); ?></div>
                        </div>
                    <?php } else { ?>
                        <div class="text-center py-3">
                            <button type="button" class="btn-action btn-primary" data-toggle="modal" data-target="#addSchoolModal">
                                <i class="fas fa-plus"></i> Add School Details
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="col-lg-6">

   <div class="accordion" id="mainAccordion">
   <!-- MAIN ACCORDION -->
  
   <!--<div class="accordion-item">-->
      <!--<h4 class="accordion-header">-->
      <!--   <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#main1">-->
      <!--   Check Your Test Status-->
      <!--   </button>-->
      <!--   <span class="badge bg-danger position-absolute top-0 end-0 m-2"></span> -->
         
      <!--</h4>-->
      
      <!--<div id="main1" class="accordion-collapse collapse show">-->
      <!--   <div class="accordion-body">-->
            <!-- INNER ACCORDION -->
      <!--      <div class="accordion inner-accordion" id="innerAccordion">-->
      <div class="custom-card">

<div class="main-title">
    Check Your Test Status
    
</div>

<div class="p-3">

<div class="accordion" id="innerAccordion">
    <a class="btn btn-primary">Confirm Your Grade</a>
 <div class="form-group">
<select name="class" class="form-control-custom" id="classDropdown">
   
   <option value="">-- Select Class --</option>
    <option value="Class-1" <?= ($student[0]['class'] == 'Class-1') ? 'selected' : '' ?>>Class-1</option>
    <option value="Class-2" <?= ($student[0]['class'] == 'Class-2') ? 'selected' : '' ?>>Class-2</option>
    <option value="Class-3" <?= ($student[0]['class'] == 'Class-3') ? 'selected' : '' ?>>Class-3</option>
    <option value="Class-4" <?= ($student[0]['class'] == 'Class-4') ? 'selected' : '' ?>>Class-4</option>
    <option value="Class-5" <?= ($student[0]['class'] == 'Class-5') ? 'selected' : '' ?>>Class-5</option>
    <option value="Class-6" <?= ($student[0]['class'] == 'Class-6') ? 'selected' : '' ?>>Class-6</option>
    <option value="Class-7" <?= ($student[0]['class'] == 'Class-7') ? 'selected' : '' ?>>Class-7</option>
    <option value="Class-8" <?= ($student[0]['class'] == 'Class-8') ? 'selected' : '' ?>>Class-8</option>
    <option value="Class-9" <?= ($student[0]['class'] == 'Class-9') ? 'selected' : '' ?>>Class-9</option>
    <option value="Class-10" <?= ($student[0]['class'] == 'Class-10') ? 'selected' : '' ?>>Class-10</option>
    <option value="Class-11" <?= ($student[0]['class'] == 'Class-11') ? 'selected' : '' ?>>Class-11</option>
    <option value="Class-12" <?= ($student[0]['class'] == 'Class-12') ? 'selected' : '' ?>>Class-12</option>
</select>
</div>
               <!-- Sub Accordion 1 -->
               <!--<div class="accordion-item position-relative">-->
               <!--   <h4 class="accordion-header position-relative">-->
               <!--      <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sub1">-->
               <!--      Unregistered (Action Required) Series-->
               <!--      </button>-->
               <!--        <span class="badge bg-danger position-absolute top-50 end-0 translate-middle-y me-3">-->
               <!--         Pending Tests: Register Now!-->
               <!--       </span>-->
         
               <!--   </h4>-->
               <!--   <div id="sub1" class="accordion-collapse collapse" data-bs-parent="#innerAccordion">-->
               <!-- SUB 1 -->
<div class="custom-accordion-item">
    <button class="accordion-button collapsed custom-accordion-btn"
    data-bs-toggle="collapse"
    data-bs-target="#sub1">

    <span>Unregistered (Action Required) Series</span>

    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-danger">
            Tests pending to register
        </span>
        <span class="plus-icon" id="icon-sub1">+</span>
    </div>

    </button>

    <div id="sub1" class="accordion-collapse collapse">
                     <div class="accordion-body">
                        
                        
                        <!-- Action Section -->
                            <div class="action-section" data-aos="fade-up">
                               <h3 class="action-title">Actions</h3>
                                   <form method="POST">
                                   <div class="row">
                                    <div class="col-lg-6">
                                     <select name="product_name"  class="form-control-custom" required>
                                       
                                       
                                        <option value="8" selected>
                                          Lunar Skill Test
                                        </option>
                                       
                                     </select>
                                  </div>
                                  <div class="col-lg-6">
                                     <select name="subject" id="subject" class="form-control-custom" required>
                                        <option value="">Select subject</option>
                                        <?php foreach ($query6->result() as $row) { ?>
                                        <option value="<?php echo $row->subject_key; ?>">
                                           <?php echo $row->subject_key; ?>
                                        </option>
                                        <?php } ?>
                                     </select>
                                  </div>
                                  </div>
                                   <div class="row mt-2">
                                  <div class="form-group">
                                      
                                     <select name="schedule" id="schedule" class="form-control-custom" required title="Click for Test Details">
                                       
                                     </select>
                                  </div>
                                  <div class="form-group">
                                       <!-- StartDetail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                       <div class="accordion inner-accordion" id="mainAccordion3">

                                        <!-- MAIN ACCORDION -->
                                        <div class="accordion-item">
                                            <h4 class="accordion-header">
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#test">
                                                    Test Detail
                                                </button>
                                            </h4>
                                    
                                            <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">
                                                <div class="accordion-body">
                                                    <div id="tets_topic"></div>
                                                  

                                                </div>
                                            </div>
                                        </div>
                                    <div class="text-end mt-2 ">
                                        <span class="border-outline-danger accor-cross-btn"
                                            onclick="closeAndReset('sub1', this)">
                                            ✕
                                        </span>
                                    </div>
                                    
                                    </div>
                                      
                                      <!-- End Detail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                     
                                  </div>
                                  
                                  <div class="form-group">
                                     <button type="submit" class="btn-action btn-primary" name="register" value="1">
                                     Register & Download
                                     </button>
                                  </div>
                               
                               
                               </div>
                               </form>
                            </div>
                      
                
                <div class="action-section" data-aos="fade-up" style="display:none">
        
                    <div class="exam-heading" style="font-size:1.5rem">
                        Lunar Skill Test - Unregistered Series
                    </div>
                
                    <div class="exam-grid">
                
                        <?php if (empty($finalSeries)) : ?>
                
                            <?php foreach ($finalSeries as $series) : ?>
                
                                <?php if (empty($series['isPurchased'])) : 
                                    // Check if registration is available
                                    $sche = $this->db
                                        ->where('series', $series['series'])
                                        ->order_by('id', 'DESC')
                                        ->get('competition_product_state')
                                        ->row();
                                        $level = $this->db
                                        ->where('level_id', $sche->clevel)
                                        ->get('competition_level_byproduct')
                                        ->row();
                                ?>
                
                        <div class="exam-card">
        
                            <!-- Series Name -->
                            <div class="exam-series">
                               <?=$sche->product_name ?>- <?=$sche->subject ?> - Series <?= htmlspecialchars($series['series']); ?> <?=$sche->type ?> - Level -<?=$level->level_name;?>
                            </div>
                            <div id="msg" class="mt-2"></div>
        
                            <div class="register-section">
                                <?php if ($sche) : ?>
                                    <a href="<?= base_url('Cin_login/enroll/'.$sche->id); ?>" class="btn btn-primary">
                                        Register Now
                                    </a>
                                <?php else : ?>
                                    <span class="text-danger">Registration Not Available</span>
                                <?php endif; ?>
                            </div>
        
                        </div>
        
                        <?php endif; ?>
        
                    <?php endforeach; ?>
        
                <?php else : ?>
                    <div>No unregistered exams found.</div>
                <?php endif; ?>
        
            </div>

              </div>
                               
                            
                        
                        
                     </div>
                  </div>
               </div>
               
               
               <div class="custom-accordion-item">
    <button class="accordion-button collapsed custom-accordion-btn"
    data-bs-toggle="collapse"
    data-bs-target="#sub4">

    <span> Study Material, Orientation, Mock Test, Traning(Free/Paid)</span>

    <div class="d-flex align-items-center gap-2"> 
        <span class="badge bg-success">
            Buy and download material
        </span>
        <span class="plus-icon" id="icon-sub4">+</span>
    </div>

    </button>

    <div id="sub4" class="accordion-collapse collapse">
                     <div class="accordion-body">
                        
                        
                        <!-- Action Section -->
                            <div class="action-section" data-aos="fade-up">
                               <h3 class="action-title">Study Material Filter </h3>
                                   <form method="POST">
                                   <div class="row">
                                    <div class="col-lg-6">
                                     <select name="product_name"  class="form-control-custom" required>
                                       
                                       
                                        <option value="8" selected>
                                          Lunar Skill Test
                                        </option>
                                       
                                     </select>
                                  </div>
                                  <div class="col-lg-6">
                                     <select name="subject" id="msubject" class="form-control-custom" required>
                                        <option value="">Select subject</option>
                                        <?php foreach ($query6->result() as $row) { ?>
                                        <option value="<?php echo $row->subject_key; ?>">
                                           <?php echo $row->subject_key; ?>
                                        </option>
                                        <?php } ?>
                                     </select>
                                  </div>
                                  </div>
                                   <div class="row mt-2">
                                  <div class="form-group">
                                      
                                     <select name="schedule" id="mschedule" class="form-control-custom" required title="Click for Test Details">
                                       
                                     </select>
                                  </div>
                                  <!--<div class="form-group">-->
                                       <!-- StartDetail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                    <!--   <div class="accordion inner-accordion" id="mainAccordion3">-->

                                        <!-- MAIN ACCORDION -->
                                    <!--    <div class="accordion-item">-->
                                    <!--        <h4 class="accordion-header">-->
                                    <!--            <button type="button" class="accordion-button"-->
                                    <!--                data-bs-toggle="collapse"-->
                                    <!--                data-bs-target="#test">-->
                                    <!--                Test Detail-->
                                    <!--            </button>-->
                                    <!--        </h4>-->
                                    
                                    <!--        <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">-->
                                    <!--            <div class="accordion-body">-->
                                    <!--                <div id="mtets_topic"></div>-->
                                                  

                                    <!--            </div>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--<div class="text-end mt-2 ">-->
                                    <!--    <span class="border-outline-danger accor-cross-btn"-->
                                    <!--        onclick="closeAndReset('sub1', this)">-->
                                    <!--        ✕-->
                                    <!--    </span>-->
                                    <!--</div>-->
                                    
                                    <!--</div>-->
                                      
                                      <!-- End Detail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                     
                                  <!--</div>-->
                                  
                                  <div class="form-group d-flex justify-content-around">
                                     <button type="submit" class="btn-action btn-primary w-50" name="register" value="1">
                                     Material Buy & Download
                                     </button>
                                  </div>
                               
                               
                               </div>
                               </form>
                            </div>
                      
                
                <div class="action-section" data-aos="fade-up" style="display:none">
        
                    <div class="exam-heading" style="font-size:1.5rem">
                        Lunar Skill Test - Unregistered Series
                    </div>
                
                    <div class="exam-grid">
                
                        <?php if (empty($finalSeries)) : ?>
                
                            <?php foreach ($finalSeries as $series) : ?>
                
                                <?php if (empty($series['isPurchased'])) : 
                                    // Check if registration is available
                                    $sche = $this->db
                                        ->where('series', $series['series'])
                                        ->order_by('id', 'DESC')
                                        ->get('competition_product_state')
                                        ->row();
                                        $level = $this->db
                                        ->where('level_id', $sche->clevel)
                                        ->get('competition_level_byproduct')
                                        ->row();
                                ?>
                
                        <div class="exam-card">
        
                            <!-- Series Name -->
                            <div class="exam-series">
                               <?=$sche->product_name ?>- <?=$sche->subject ?> - Series <?= htmlspecialchars($series['series']); ?> <?=$sche->type ?> - Level -<?=$level->level_name;?>
                            </div>
        
                            <div class="register-section">
                                <?php if ($sche) : ?>
                                    <a href="<?= base_url('Cin_login/enroll/'.$sche->id); ?>" class="btn btn-primary">
                                        Register Now
                                    </a>
                                <?php else : ?>
                                    <span class="text-danger">Registration Not Available</span>
                                <?php endif; ?>
                            </div>
        
                        </div>
        
                        <?php endif; ?>
        
                    <?php endforeach; ?>
        
                <?php else : ?>
                    <div>No unregistered exams found.</div>
                <?php endif; ?>
        
            </div>

              </div>
                               
                            
                        
                        
                     </div>
                  </div>
               </div>
               <!-- Sub Accordion 2 -->
               <!--<div class="accordion-item position-relative">-->
               <!--   <h4 class="accordion-header position-relative">-->
               <!--      <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sub2">-->
               <!--      Unattempted Test-->
               <!--      </button>-->
               <!--      <span class="badge bg-danger position-absolute top-50 end-0 translate-middle-y me-3">-->
               <!--         Tests Wating: Start Attempt!-->
               <!--       </span>-->
               <!--   </h4>-->
               <!--   <div id="sub2" class="accordion-collapse collapse" data-bs-parent="#innerAccordion">-->
               <!-- SUB 2 -->
                <div class="custom-accordion-item">
                    <button class="accordion-button collapsed custom-accordion-btn"
                    data-bs-toggle="collapse"
                    data-bs-target="#sub2">
                
                    <span>Unattempted Test</span>
                
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-warning">
                            Tests Waiting : Start Attempt!
                        </span>
                        <span class="plus-icon" id="icon-sub2">+</span>
                    </div>
                
                </button>

    <div id="sub2" class="accordion-collapse collapse">
                     <div class="accordion-body">
                       <div class="action-section" data-aos="fade-up">

                            <div class="exam-heading" style="font-size:1.5rem">
                                Lunar Skill Test - Unattempted Series
                            </div>
                              
                                   <div class="row">
                                    <div class="col-lg-6">
                                     <select name="product_name"  class="form-control-custom" required>
                                       
                                       
                                        <option value="8" selected>
                                          Lunar Skill Test
                                        </option>
                                       
                                     </select>
                                  </div>
                                  <div class="col-lg-6">
                                     <select name="subject" id="unsubject" class="form-control-custom" required>
                                        <option value="">Select subject</option>
                                        <?php foreach ($query6->result() as $row) { ?>
                                        <option value="<?php echo $row->subject_key; ?>">
                                           <?php echo $row->subject_key; ?>
                                        </option>
                                        <?php } ?>
                                     </select>
                                  </div>
                                  </div>
                                   <div class="row mt-2">
                                  <div class="form-group">
                                     <select name="schedule" id="unschedule" class="form-control-custom" required>
                                       
                                     </select>
                                  </div>
                                  <div class="form-group">
                                      
                                      
                                       <!-- StartDetail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                       <div class="accordion inner-accordion" id="mainAccordion3">
                                   <div class="accordion-item">
                                            <h4 class="accordion-header">
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#test">
                                                    Test Detail
                                                </button>
                                            </h4>
                                    
                                            <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">
                                                <div class="accordion-body">
                                                    <div id="untets_topic"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="text-end mt-2 ">
                                        <span class="border-outline-danger accor-cross-btn"
                                            onclick="closeAndReset('sub2', this)">
                                            ✕
                                        </span>
                                    </div>
                                    </div>
                                      
                                      <!-- End Detail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                     
                                  </div>
                                  </div>
                                  
                              
                               
                          
                        
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Sub Accordion 3 -->
               <!--<div class="accordion-item">-->
               <!--   <h2 class="accordion-header">-->
               <!--      <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sub3">-->
               <!--      Attempted Test-->
               <!--      </button>-->
               <!--   </h2>-->
               <!--   <div id="sub3" class="accordion-collapse collapse" data-bs-parent="#innerAccordion">-->
               <!-- SUB 3 -->
                <div class="custom-accordion-item">
                    <button class="accordion-button collapsed custom-accordion-btn"
                        data-bs-toggle="collapse"
                        data-bs-target="#sub3">
                
                        Attempted Test
                        <span class="plus-icon" id="icon-sub3">+</span>
                    </button>
                
                    <div id="sub3" class="accordion-collapse collapse">
                     <div class="accordion-body">
                      <div class="action-section" data-aos="fade-up">

                        <div class="exam-heading" style="font-size:1.5rem">
                            Lunar Skill Test - Result
                        </div>
                        
                        
                                   <div class="row">
                                    <div class="col-lg-6">
                                     <select name="product_name"  class="form-control-custom" required>
                                       
                                       
                                        <option value="8" selected>
                                          Lunar Skill Test
                                        </option>
                                       
                                     </select>
                                  </div>
                                  <div class="col-lg-6">
                                     <select name="subject" id="attemsubject" class="form-control-custom" required>
                                        <option value="">Select subject</option>
                                        <?php foreach ($query6->result() as $row) { ?>
                                        <option value="<?php echo $row->subject_key; ?>">
                                           <?php echo $row->subject_key; ?>
                                        </option>
                                        <?php } ?>
                                     </select>
                                  </div>
                                  </div>
                                   <div class="row mt-2">
                                  <div class="form-group">
                                     <select name="schedule" id="attemschedule" class="form-control-custom" required>
                                       
                                     </select>
                                  </div>
                                  <div class="form-group">
                                      
                                      
                                       <!-- StartDetail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                       <div class="accordion inner-accordion" id="mainAccordion3">
                                   <div class="accordion-item">
                                            <h4 class="accordion-header">
                                                <button type="button" class="accordion-button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#test">
                                                    Test Detail
                                                </button>
                                            </h4>
                                    
                                            <div id="test" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion2">
                                                <div class="accordion-body">
                                                    <div id="attemtets_topic"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="text-end mt-2 ">
                                        <span class="border-outline-danger accor-cross-btn"
                                            onclick="closeAndReset('sub3', this)">
                                            ✕
                                        </span>
                                    </div>
                                    </div>
                                      
                                      <!-- End Detail ACCORDION Fetch data By Ajax 14-03-2026  -->
                                      
                                     
                                     
                                  </div>
                                  </div>
                    
                       
                    
                    </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- END INNER -->
         </div>
      </div>
   <!--</div>-->
   <!-- END MAIN -->
</div>


           
           
       


    </div>
  
</div>
        
    

      
        
        
    </div>

    <!-- Add School Modal -->
    <div class="modal fade" id="addSchoolModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" id="schoolForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Add School Details</h5>
                        <button type="button" class="close" data-dismiss="modal" style="color: white;">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="school_name">School Name</label>
                            <input type="text" class="form-control" id="school_name" 
                                   name="school_name" required>
                        </div>
                        <div class="form-group">
                            <label for="school_address">School Address</label>
                            <textarea class="form-control" id="school_address" 
                                      name="school_address" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="student_id" value="<?php echo $student[0]['id']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
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
<script>
function closeAndReset(accordionId, btn){
    // Close accordion
    var el = document.getElementById(accordionId);
    if(el){
        var bsCollapse = bootstrap.Collapse.getOrCreateInstance(el);
        bsCollapse.hide();
    }

    // Reset form (find closest form)
    var form = btn.closest('form');
    if(form){
        form.reset();
    }

    // Optional: clear dynamic content (AJAX data)
    var topics = el.querySelectorAll('[id$="tets_topic"]');
    topics.forEach(div => div.innerHTML = '');
}
</script>
    <script>
    $("#schedule").change(function() {

    // get selected series
    var series = $("#schedule").find(':selected').data('id');
    var status = $("#schedule").find(':selected').data('status');
        if (!series) {
        alert("Please select a series first");
        return;
    }
        $("#series_url").val(series || ''); 
        $("#status_paid").val(status || ''); 
        
    });
    
    $("#subject").change(function() {
        var subject = this.value;
        $.ajax({
            url: "https://marrs.in/lunar/cin_login/schedule",
            data: { subject : subject },
            type: 'POST',
            success: function(result) {
                $("#schedule").html(result);
                
                $("#Search_data").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#msubject").change(function() {
        var subject = this.value;
        $.ajax({
            url: "https://marrs.in/lunar/cin_login/mschedule",
            data: { subject : subject },
            type: 'POST',
            success: function(result) {
                $("#mschedule").html(result);
                
                $("#Search_data").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
     $("#schedule").change(function() {
        var series = $(this).find(':selected').data('id');
        var scdid = $(this).find(':selected').data('scdid');
       // alert(scdid);
    $.ajax({
      url: "<?= base_url('cin_login/scd_description') ?>",
      type: "POST",
      data: {
        scdid: scdid
      },
     success: function (res) {

            var data = JSON.parse(res);
            //$("#tets_name").html(data.title);
            
           var html = '<table style="width:100%; border:1px solid #000; border-collapse:collapse;">';
            html += '<tr>';
            html += '<th style="border:1px solid #000; padding:8px;">Test Number</th>';
            html += '<th style="border:1px solid #000; padding:8px;">Topic</th>';
            html += '<th style="border:1px solid #000; padding:8px;">Description</th>';
            html += '</tr>';
            
            $.each(data, function(i, item){
                html += '<tr>';
                html += '<td style="border:1px solid #000; padding:8px;">' + item.title + '</td>';
                html += '<td style="border:1px solid #000; padding:8px;">' + item.topic + '</td>';
                html += '<td style="border:1px solid #000; padding:8px;">' + item.description + '</td>';
                html += '</tr>';
            });
            
            html += '</table>';
            
            $("#tets_topic").html(html);

        }
    });
    
    //================================
    
  
    
    //================================
  
        // $.ajax({
        //     url: "https://marrs.in/lunar/cin_login/schedule",
        //     data: { subject : subject },
        //     type: 'POST',
        //     success: function(result) {
        //         $("#schedule").html(result);
        //     },
        //     error: function() {
        //         alert("An error occurred while fetching data.");
        //     }
        // });
    });
    
    
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Hide success alert after delay
        $(document).ready(function() {
            $("#success-alert").fadeTo(3000, 500).slideUp(500);
        });

        // Register button functionality
        // $("#registerButton").on("click", function() {
        //     var selectedUrl = $("#registerDropdown").val();
        //     if (selectedUrl) {
        //         window.location.href = selectedUrl;
        //     } else {
        //         alert("Please select a competition.");
        //     }
        // });

        // School form submission
        $("#schoolForm").on("submit", function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "<?php echo base_url();?>Cin_login/save_school_details",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $("#schoolForm button[type='submit']").prop("disabled", true).text("Saving...");
                },
                success: function(response) {
                    if (response.status === "success") {
                        $("#addSchoolModal").modal("hide");
                        alert("School details saved successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function() {
                    alert("Something went wrong. Please try again.");
                },
                complete: function() {
                    $("#schoolForm button[type='submit']").prop("disabled", false).text("Save Details");
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
                
                $("#Search_data").html(result);
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
                
                $("#Search_data").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
       
    </script>
  
<script>
$(document).ready(function() {

    // Define base URL for Start Test form
    var base_url = "<?= base_url('Cin_login/generate_login_url'); ?>";

    $("#unschedule").change(function() {
        var series = $(this).find(':selected').data('id');
        var scdid = $(this).find(':selected').data('scdid');

        $.ajax({
            url: "<?= base_url('cin_login/unscd_description') ?>",
            type: "POST",
            data: {
                series: series
            },
            success: function(res) {

                var data = JSON.parse(res);

                var html = '<table style="width:100%; border:1px solid #000; border-collapse:collapse;">';
                html += '<tr>';
                html += '<th style="border:1px solid #000; padding:8px;">Test Number</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Week</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Status</th>';
                html += '<th style="border:1px solid #000; padding:8px;">Action</th>';
                html += '</tr>';

                var notAttemptedCount = 0; // Counter for not attempted exams

                $.each(data.exams, function(i, item) {
                    if (item.status == 0) { // only not attempted
                        notAttemptedCount++;
                        html += '<tr>';
                        html += '<td style="border:1px solid #000; padding:8px;">' + item.exam_id + '</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">' + item.week + '</td>';

                        // Red badge for Not Attempted
                        html += '<td style="border:1px solid #000; padding:8px;">';
                        html += '<span style="background-color:red; color:white; padding:3px 8px; border-radius:12px; font-weight:bold;">Not Attempted</span>';
                        html += '</td>';

                        // Start Test form
                        html += '<td style="border:1px solid #000; padding:8px;">';
                        html += '<form method="POST" action="' + base_url + '">';
                        html += '<input type="hidden" name="series" value="' + data.series + '">';
                        html += '<input type="hidden" name="status" value="Paid">';
                        html += '<input type="hidden" name="exam_id" value="' + item.exam_id + '">';
                        html += '<button type="submit" class="btn btn-success">';
                        html += '<i class="fas fa-chalkboard-teacher"></i> Start Test';
                        html += '</button>';
                        html += '</form>';
                        html += '</td>';

                        html += '</tr>';
                    }
                });

                // If no not-attempted exams, show "No data found"
                if (notAttemptedCount === 0) {
                    html += '<tr>';
                    html += '<td colspan="4" style="text-align:center; padding:10px;">No data found</td>';
                    html += '</tr>';
                }

                html += '</table>';

                $("#untets_topic").html(html);
            },
            error: function(err) {
                console.log('AJAX error:', err);
            }
        });

    });

});

$(document).ready(function() {

    // Base URL for Start Test form
    var base_url = "<?= base_url('Cin_login/generate_login_url'); ?>";

    // Base URL for View Score
    var score_url = "<?= base_url('Cin_login/generate_login_url'); ?>";

    $("#attemschedule").change(function() {
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
                        html += '<td style="border:1px solid #000; padding:8px;">' + item.exam_id + '</td>';
                        html += '<td style="border:1px solid #000; padding:8px;">' + item.week + '</td>';

                        // Status badge
                        if(item.status == 0){
                            html += '<td style="border:1px solid #000; padding:8px;">';
                            html += '<span style="background-color:red; color:white; padding:3px 8px; border-radius:12px; font-weight:bold;">Not Attempted</span>';
                            html += '</td>';
                        } else {
                            html += '<td style="border:1px solid #000; padding:8px;">';
                            html += '<span style="background-color:green; color:white; padding:3px 8px; border-radius:12px; font-weight:bold;">Completed</span>';
                            html += '</td>';
                        }

                        // Action column
                        html += '<td style="border:1px solid #000; padding:8px;">';
                        if(item.status == 0){
                            // Start Test button
                            html += '<form method="POST" action="' + base_url + '">';
                            html += '<input type="hidden" name="series" value="' + data.series + '">';
                            html += '<input type="hidden" name="status" value="Paid">';
                            html += '<input type="hidden" name="exam_id" value="' + item.exam_id + '">';
                            html += '<button type="submit" class="btn btn-success">';
                            html += '<i class="fas fa-chalkboard-teacher"></i> Start Test';
                            html += '</button>';
                            html += '</form>';
                        } else {
                            // View Score button
                            html += '<form method="POST" action="' + score_url + '">';
                            html += '<input type="hidden" name="series" value="' + data.series + '">';
                            html += '<input type="hidden" name="exam_id" value="' + item.exam_id + '">';
                            html += '<button type="submit" class="btn btn-info">';
                            html += ' View Score';
                            html += '</button>';
                            html += '</form>';
                        }
                        html += '</td>';

                        html += '</tr>';
                    });
                }

                $("#attemtets_topic").html(html);
            },
            error: function(err) {
                console.log('AJAX error:', err);
            }
        });

    });

}); 
</script>
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".progress-bar-fill").forEach(function (bar) {
        let percent = bar.getAttribute("data-percentage");
        bar.style.width = percent + "%";
    });
});
</script>


<?php include("footer.php"); ?>