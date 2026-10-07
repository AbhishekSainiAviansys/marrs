<?php include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - MaRRS</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --accent-color: #ec4899;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1), 0 2px 4px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1), 0 6px 10px rgba(0,0,0,0.08);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-accent: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-light: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-primary);
        }

        /* Header Section */
        .header-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(240,249,255,0.9) 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            box-shadow: var(--shadow-sm);
        }

        /* Banner Styles */
        .registration-banner {
            background: linear-gradient(135deg, #ffecd2 0%, #fff8f6 100%);
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            margin: 2rem 0;
        }

        .registration-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        .floating-star {
            position: absolute;
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .star-1 { top: 10%; left: 10%; animation-delay: 0s; }
        .star-2 { top: 20%; right: 15%; animation-delay: 0.5s; }
        .star-3 { bottom: 20%; left: 20%; animation-delay: 1s; }
        .star-4 { bottom: 10%; right: 10%; animation-delay: 1.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .exciting-badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
            animation: pulse 2s infinite;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: var(--shadow-md); }
            50% { transform: scale(1.05); box-shadow: var(--shadow-lg); }
            100% { transform: scale(1); box-shadow: var(--shadow-md); }
        }

        .banner-title {
            color: var(--text-primary);
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }

        .banner-subtitle {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .banner-message {
            color: var(--text-secondary);
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .glow-btn {
            display: inline-block;
            padding: 1.2rem 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .glow-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .glow-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .glow-btn:hover::before {
            left: 100%;
        }

        /* Profile Card */
        .profile-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .profile-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: var(--shadow-lg);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .profile-name {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Info Cards */
        .info-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover::before {
            transform: scaleX(1);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .info-card h3 {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 600;
        }

        .info-card h3 i {
            color: var(--secondary-color);
            font-size: 1.2rem;
        }

        /* Action Buttons */
        .action-btn {
            display: inline-block;
            padding: 0.9rem 2rem;
            margin: 0.5rem;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .action-btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .action-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .action-btn-secondary {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .action-btn-secondary:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        /* Rank Table */
        .rank-table {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .rank-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .rank-table thead th {
            padding: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            border: none;
        }

        .rank-table tbody tr {
            transition: all 0.3s ease;
        }

        .rank-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            transform: scale(1.01);
        }

        .rank-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .rank-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-sm);
        }

        .rank-1 { 
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); 
            color: white;
        }
        .rank-2 { 
            background: linear-gradient(135deg, #e5e7eb 0%, #9ca3af 100%); 
            color: white;
        }
        .rank-3 { 
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); 
            color: white;
        }

        /* Stats Cards */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.5s ease;
        }

        .stat-card:hover::before {
            transform: scale(1);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        .stat-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 12px;
            border: none;
            box-shadow: var(--shadow-md);
            padding: 1.2rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fed7aa 0%, #fdba74 100%);
            color: #92400e;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
        }

        /* Logout Button */
        .logout-btn {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
            color: white;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-top: 1px solid var(--border-color);
            /*padding: 3rem 0;*/
            margin-top: 5rem;
        }

        footer h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        footer p {
            color: var(--text-secondary);
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .banner-title { font-size: 2.2rem; }
            .banner-subtitle { font-size: 1.6rem; }
            .profile-img { width: 120px; height: 120px; }
            .action-btn { display: block; width: 100%; margin: 0.5rem 0; }
            .registration-banner { padding: 2rem 1.5rem; }
        }

        /* Animations */
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

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</head>


<body>
    <!-- Header Section -->
    <div class="header-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <h3 class="mb-0" style="color: var(--primary-color); font-weight: 700;">
                        <i class="fas fa-graduation-cap me-2"></i>Student Portal
                    </h3>
                </div>
                <a href="<?php echo base_url();?>Cin_login/logout" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container my-4">
        <!-- Alert Messages -->
        <?php if(!empty($this->session->flashdata('message'))): ?>
            <div class="alert alert-success alert-custom alert-dismissible fade show fade-in-up" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $this->session->flashdata('message'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Registration Banner -->
        <div class="registration-banner" data-aos="fade-down">
            <span class="floating-star star-1">⭐</span>
            <span class="floating-star star-2">🌟</span>
            <span class="floating-star star-3">✨</span>
            <span class="floating-star star-4">💫</span>

            <div class="banner-content">
                <div class="exciting-badge">
                    <i class="fas fa-sparkles me-2"></i>NEW OPPORTUNITY ALERT!
                </div>
                <h1 class="banner-title">
                    🚀 Lunar Skill Test
                </h1>
                <h2 class="banner-subtitle">Registration Now Open!</h2>
                <p class="banner-message">
                    <i class="fas fa-star me-2"></i>Join thousands of brilliant students in this exciting journey!<br>
                    <strong>Test your skills, compete nationally, and win amazing prizes!</strong>
                </p>
                <a href="https://marrs.in/lunar/Welcome/landing/L257096" class="glow-btn">
                    <i class="fas fa-rocket me-2"></i>
                    Register For Lunar Now!
                </a>
            </div>
        </div>

        <!-- Error Message -->
        <?php if(!empty($mess)): ?>
            <div class="alert alert-warning alert-custom mt-3 fade-in-up">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $mess; ?>
            </div>
        <?php endif; ?>

        <!-- Profile Section -->
        <div class="row mt-4" id="namecard">
            <div class="col-lg-6">
                <div class="profile-card fade-in-up">
                    <div class="profile-header">
                        <?php if(!empty($student[0]['profile_img'])): ?>
                            <img src="<?php echo base_url().'images/student/'.$student[0]['profile_img']; ?>" 
                                 class="profile-img" alt="Profile">
                        <?php else: ?>
                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" 
                                 class="profile-img" alt="Profile">
                        <?php endif; ?>
                        <h2 class="profile-name"><?php echo $student[0]['student_name']; ?></h2>
                    </div>

                    <div class="card-body p-4">
                        <!-- Action Buttons -->
                        <div class="text-center mb-4">
                            <?php 
                            $cin = $this->session->userdata('cin');
                            $query = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='1';");
                            foreach ($query->result_array() as $row) {
                                $product_name = $row['product_name'];
                            }
                            ?>

                            <?php if($exam == 'Live'): ?>
                                <?php if($exam_id != 0): ?>
                                    <a href="<?php echo base_url();?>Cin_login/register" 
                                       class="action-btn action-btn-primary">
                                        <i class="fas fa-graduation-cap me-2"></i>
                                        Register for Next Level
                                    </a>
                                <?php else: ?>
                                    <div class="alert alert-info alert-custom">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Exam Not Scheduled In Your School
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <a href="<?php echo base_url();?>Cin_login/result_view" 
                               class="action-btn action-btn-secondary">
                                <i class="fas fa-trophy me-2"></i>
                                View Results
                            </a>

                            <a href="<?php echo base_url();?>Cin_login/edit_cin_login" 
                               class="action-btn action-btn-secondary">
                                <i class="fas fa-edit me-2"></i>
                                Update Profile
                            </a>
                        </div>

                        <!-- Stats Grid -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="stat-icon">
                                        <i class="fas fa-hashtag"></i>
                                    </div>
                                    <div class="stat-value"><?php echo $student[0]['cin']; ?></div>
                                    <div class="stat-label">CIN</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                                    <div class="stat-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="stat-value"><?php echo $student[0]['class']; ?></div>
                                    <div class="stat-label">Class</div>
                                </div>
                            </div>
                        
                        </div>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                                    <div class="stat-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="stat-value text-truncate"><?php echo $student[0]['stud_email']; ?></div>
                                    <div class="stat-label">Email</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                                    <div class="stat-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="stat-value"><?php echo $student[0]['stud_phone']; ?></div>
                                    <div class="stat-label">Phone</div>
                                </div>
                            </div>
                        </div>

                        <!-- Rank List Section -->
                        <?php if(!empty($rank_list)): ?>
                            <div class="rank-section" data-aos="fade-up">
                                <h3 class="mb-4">
                                    <i class="fas fa-medal text-warning me-2"></i>
                                    Top Rank Holders - <?php echo $rank_list[0]->level_name; ?>
                                </h3>
                                
                                <div class="table-responsive">
                                    <table class="table rank-table">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Student Name</th>
                                                <th>School</th>
                                                <th>Achievements</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($rank_list as $index => $list): ?>
                                                <tr>
                                                    <td>
                                                        <span class="rank-badge rank-<?php echo $index + 1; ?>">
                                                            <?php echo $list->rank; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($list->student_name); ?></td>
                                                    <td><?php echo htmlspecialchars($list->school); ?></td>
                                                    <td>
                                                        <?php if(strtoupper($list->speller ?? '') === 'YES'): ?>
                                                            <span class="badge bg-success me-1">
                                                                <i class="fas fa-star me-1"></i>Star Speller
                                                            </span>
                                                        <?php endif; ?>
                                                        <?php if(strtoupper($list->performer ?? '') === 'YES'): ?>
                                                            <span class="badge bg-info">
                                                                <i class="fas fa-trophy me-1"></i>Best Performer
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center mt-4">
                                    <a href="https://api.aviansys.in/rank_list/<?php echo $rank_list[0]->level_name.'/'.$rank_list[0]->period_id.'/'.$product; ?>" 
                                       class="action-btn action-btn-secondary" target="_blank">
                                        <i class="fas fa-download me-2"></i>Download Full Rank List
                                    </a>
                                    <a href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" 
                                       class="action-btn action-btn-secondary ms-2" target="_blank">
                                        <i class="fas fa-images me-2"></i>View Gallery
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Details -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="info-card" data-aos="fade-right">
                    <h3><i class="fas fa-user-friends"></i> Guardian Details</h3>
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Father Name:</strong></td>
                            <td><?php echo $student[0]['father_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Mother Name:</strong></td>
                            <td><?php echo $student[0]['mother_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td><?php echo $student[0]['address1']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card" data-aos="fade-left">
                    <h3><i class="fas fa-school"></i> School Details</h3>
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>School Name:</strong></td>
                            <td><?php echo $student[0]['school_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td><?php echo $student[0]['school_address1']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

      
    <!--<footer>-->
    <div style="background-color:#ffccff;" class="p-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i>MaRRS Rediscover</h5>
                    <p>Empowering students through innovative competitions and learning experiences.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <!--<p class="mb-0">&copy; <?php echo date('Y'); ?> MaRRS. All rights reserved.</p>-->
                    <p class="mb-0 small text-muted">All Rights Reserved &copy;Aviansys Technology Pvt Ltd 2018-<?php echo date('Y'); ?></p>
                </div>
            </div>
        </div>
    </div>    
    <!--</footer>-->

<?php //include("footer.php");?>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add ripple effect to buttons
        document.querySelectorAll('.action-btn, .glow-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                this.appendChild(ripple);

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Add ripple effect styles
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s ease-out;
                pointer-events: none;
            }
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>