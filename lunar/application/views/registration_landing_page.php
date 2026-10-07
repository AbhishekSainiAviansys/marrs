
<!DOCTYPE html>
<html>
<head>
    <title>Marrslms</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css?update1">
    <style>
        a{
            text-decoration:none !important;
        }
        
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
              <img src='https://marrs.in/student_registration/certificate_logo/flunar.jpg' class="img-fluid d-inline-block align-text-top" alt='image' width="200">
                </a>
                
                 
            
       
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                   <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              
                        
                        <li class="nav-item dropdown">
                             <a class="navbar-link  dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic" style="width:50px;"/><br/>
                                <span class="text-white">Profile</span>
                             </a>
							
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="https://marrs.in/student_registration/cin_login/index" aria-current="page">Profile</a></li>
							
						
                          </ul>
                        </li>
                      </ul>
              </div>
            </div>
          </nav>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  

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

</style>


</head>
<body>
 

    <div class="container">
       
       <div class="row mt-2 profile-card rounded">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
    
                <!-- LEFT BUTTON -->
                <a href="https://marrs.in/student_registration/cin_login/index" class="update-btn">
                    <i class="fa-solid fa-arrow-left"></i> Go Back
                </a>
    
                <!-- RIGHT BUTTON -->
                <a href="/lunarskil" class="update-btn">
                    <i class="fa-solid fa-arrow-right"></i> Lunar Details....
                </a>
    
            </div>
        </div>
    </div>
    
        <div class="row  mt-2 p-5">

       <div class="col-lg-12">
        <div class="custom-card">
         <div class="accordion-body">
                          <a class="btn btn-primary">Confirm Your Grade</a>
                             <div class="form-group">
                                <select name="class" class="form-control-custom" id="classDropdown">
                                   
                                   <option value="">-- Select Class --</option>
                                    <option value="Class-1" selected>Class-1</option>
                                    <option value="Class-2" >Class-2</option>
                                    <option value="Class-3" >Class-3</option>
                                    <option value="Class-4" >Class-4</option>
                                    <option value="Class-5" >Class-5</option>
                                    <option value="Class-6" >Class-6</option>
                                    <option value="Class-7" >Class-7</option>
                                    <option value="Class-8" >Class-8</option>
                                    <option value="Class-9" >Class-9</option>
                                    <option value="Class-10" >Class-10</option>
                                    <option value="Class-11" >Class-11</option>
                                    <option value="Class-12" >Class-12</option>
                                </select>
                            </div>
                        
                        <!-- Action Section -->
                            <div class="action-section" >
                               <h3 class="action-title">Registration Actions</h3>
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
                                                                                <option value="ENGLISH">
                                           ENGLISH                                        </option>
                                                                                <option value="MATH" selected>
                                           MATH                                        </option>
                                                                             </select>
                                  </div>
                                  </div>
                                   <div class="row mt-2">
                                  <div class="form-group" id="scheduleSeriesList">
                                      
                                     
                                  </div>
                                 
                                  
                                
                               
                               
                               </div>
                               </form>
                            </div>
                      
                
                       
                        
                        
                     </div>
                 
             
      </div>
  
    </div>
  </div>
</div>

 

<script>
$(document).ready(function() {
     var selectedClass = $('#classDropdown').val();
     var selectedSubject = $('#subject').val();
       $.ajax({
            url: "https://marrs.in/lunar/cin_login/scheduleSeriesList",
            type: "POST",
            data: {
                class: selectedClass,
                subject: selectedSubject
            },
            success: function(result) {
                $("#scheduleSeriesList").html(result);
            },
            error: function() {
                alert("Error loading data");
            }
        });
    // STOP FORM RELOAD
    $("#mainForm").submit(function(e){
        e.preventDefault();
    });

    // SUBJECT CHANGE
    $("#subject").change(function() {

        var selectedClass = $('#classDropdown').val();
        var subject = $(this).val();

        if(selectedClass === ""){
            alert("Please select class first");
            return;
        }

        

        $.ajax({
            url: "https://marrs.in/lunar/cin_login/scheduleSeriesList",
            type: "POST",
            data: {
                class: selectedClass,
                subject: subject
            },
            success: function(result) {
                $("#scheduleSeriesList").html(result);
            },
            error: function() {
                alert("Error loading data");
            }
        });

    });
    
    $("#classDropdown").change(function() {

        var selectedSubject = $('#subject').val();
        var selectedClass = $(this).val();

       
        

        $.ajax({
            url: "https://marrs.in/lunar/cin_login/scheduleSeriesList",
            type: "POST",
            data: {
                class: selectedClass,
                subject: selectedSubject
            },
            success: function(result) {
                $("#scheduleSeriesList").html(result);
            },
            error: function() {
                alert("Error loading data");
            }
        });

    }); 

});
</script>
 <footer>
      <div class="container">
        <div class="row" id="footerContent">
          <div class="col-sm-12 col-md-12 col-lg-12  text-center">
               <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in" >Home</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/about.php" >About Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/contact.php" >Contact Us</a>
          </div>
          
          <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                          <small class="text-white">© <a href='#' style="text-decoration: none;color:orange;" >Aviansys Technology Pvt. Ltd. </a>
                          2025-2026</small>

          </div>
        </div>
      </div>
    </footer>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
         <script>
        $("#edit_guard").click(function() {
        $("input.guardetail,textarea.guardetail").attr('disabled', !$("input.guardetail,textarea.guardetail").attr('disabled'));
        });
        </script>
        <script>
        $("#edit_school").click(function() {
        $("input.schooldetail,textarea.schooldetail").attr('disabled', !$("input.schooldetail,textarea.schooldetail").attr('disabled'));
        });
    </script>
    
     <script>
  

</script>
</body>
</html>

