<?php
$subject = $student[0]['subject'];
$series = $student[0]['series'];
$type = $student[0]['type'];
$state_id = $student[0]['state_id'];

$period_id = $student[0]['period_id'];

$today_date = date('Y-m-d');
// $query5 = $this->db->query("SELECT * FROM `competition_product_state` WHERE product_name='MaRRS Lunar Olympiads' and status='Live' ;");

$this->db->select('competition_product_state.*,competition_level_byproduct.level_name');
$this->db->from('competition_product_state');
$this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_product_state.clevel');
$this->db->where('competition_product_state.product_name', 'MaRRS Math Zoom Zoom Challenge');
$this->db->where('status', 'Live');
$this->db->where('period_id', $period_id);
$this->db->group_by('clevel');
$this->db->order_by('clevel', 'DESC');

$query5 = $this->db->get();


// echo $this->db->last_query();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaRRS Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Top Header */
        .top-header {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .top-header img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Logo Section */
        .logo-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .logo-section::before {
            content: '';
            position: absolute;
            width: 300%;
            height: 300%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveGrid 20s linear infinite;
            opacity: 0.3;
        }

        @keyframes moveGrid {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .zoom-logo {
            max-width: 450px;
            width: 100%;
            height: auto;
            filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));
            animation: float 3s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Success Alert */
        .success-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            animation: slideInRight 0.5s ease-out;
            max-width: 400px;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Profile Card */
        .profile-section {
            padding: 2rem 0;
        }

        .profile-card {
            background: white;
            border-radius: 30px;
            padding: 2rem;
            /*box-shadow: 0 20px 60px rgba(0,0,0,0.15);*/
            animation: fadeInUp 0.8s ease-out;
            position: relative;
            overflow: hidden;
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

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 150px;
            /*background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);*/
            border-radius: 30px 30px 0 0;
            z-index: 0;
        }

        .profile-content {
            position: relative;
            z-index: 1;
        }

        .profile-image-container {
            text-align: center;
            margin-bottom: 1rem;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            object-fit: cover;
        }

        .profile-name {
            color: #0c1ae7;
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* Action Buttons */
        .action-section {
            margin-top: 2rem;
        }

        .action-title {
            color: #2d3748;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .action-title span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .competition-selector {
            background: linear-gradient(135deg, #f6f9fc 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .form-select {
            border-radius: 15px;
            padding: 0.8rem 1.2rem;
            border: 2px solid #e2e8f0;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
        }

        .action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 15px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102,126,234,0.3);
            text-decoration: none;
            /*display: inline-block;*/
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102,126,234,0.4);
            color: white;
        }

        .result-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .result-btn:hover {
            box-shadow: 0 10px 25px rgba(245,87,108,0.4);
        }

        .update-btn {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(250,112,154,0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(250,112,154,0.4);
            color: white;
        }

        /* Info Cards Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #eae266, #ff4848);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .info-icon {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .info-label {
            color: #718096;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
            word-break: break-word;
        }

        /* Detail Cards */
        .detail-section {
            background: white;
            padding: 3rem 0;
            margin-top: 3rem;
            border-radius: 30px 30px 0 0;
        }

        .detail-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            transition: all 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .detail-card-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .detail-card-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem;
        }

        .detail-card-title {
            color: #2d3748;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .detail-table {
            width: 100%;
        }

        .detail-table th {
            color: #667eea;
            font-weight: 600;
            padding: 0.8rem;
            text-align: left;
            width: 40%;
        }

        .detail-table td {
            color: #4a5568;
            padding: 0.8rem;
        }

        .detail-table tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-table tr:last-child {
            border-bottom: none;
        }

        .add-school-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            border-radius: 15px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-school-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102,126,234,0.4);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 700;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem;
            border: 2px solid #e2e8f0;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 2rem 0;
            text-align: center;
            margin-top: 3rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .zoom-logo {
                max-width: 280px;
            }

            .profile-card {
                padding: 1.5rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-btn {
                width: 100%;
                margin-bottom: 1rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        
        /*.row>* {*/
        /*    flex: auto;*/
            /* width: 100%; */
        /*    max-width: 100%;*/
            /* padding-right: calc(var(--bs-gutter-x) * .5); */
        /*    padding-left: calc(var(--bs-gutter-x) * .5);*/
        /*    margin-top: var(--bs-gutter-y);*/
        /*}*/
        
        
    </style>
</head>
<body>

    <!-- Header -->
    <div class="top-header">
        <img src="https://marrs.in/images/header-011.jpg" alt="MaRRS Header">
    </div>

    <!-- Logo Section -->
    <section class="logo-section">
        <div class="container">
            <div class="text-center py-4">
                <img src="https://marrs.in/images/zoomlandinglogo.png" alt="Math Zoom Zoom Logo" class="zoom-logo">
            </div>
        </div>
       
    </section>

    <!-- Success Alert (Hidden by default) -->
    <div id="success-alert" class="alert alert-success success-alert" style="display: none;">
        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>Registration Successful!</h5>
    </div>

    <!-- Update Button -->
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="#" class="update-btn">
                <i class="fas fa-edit me-2"></i>Update Contact Details
            </a>
              <a href="<?php echo base_url();?>cin_login/logout" class="update-btn">
                <i class="fas fa-sign-out-alt me-2"></i>logout
            </a>
        </div>
         
    </div>

    <!-- Profile Section -->
    <section class="profile-section">
        <div class="container">
            
            <div class="profile-card">
                <div class="profile-content">
                    <div class="row">
                        <!-- Profile Image and Name -->
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <div class="profile-image-container">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" 
                                     alt="Profile" class="profile-image">
                                <h2 class="profile-name"><?php echo $student[0]['student_name']; ?></h2>
                            </div>
                        </div>

                        <!-- Action Section -->
                        <div class="col-lg-9">
                            <div class="action-section">
                                <h3 class="action-title"></h3>
                                
                                <div class="competition-selector">
                                    <div class="row g-3 align-items-end">
                                        
                                        <form method="POST">
                                            <div class="col-lg-5">
                                                
                                                <label class="form-label">Select Competition</label>
                                                <select class="form-select" name="schedule" required>
                                                    <option value="">Select Competition</option>
                                                    <?php foreach ($query5->result() as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>">
                                                            <?php echo $row->level_name; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            
                                            </div>
                                        
                                            <div class="col-lg-4 mt-2">
                                                <button type="submit" class="action-btn w-100" name="register" value="1">
                                                    <i class="fas fa-rocket me-2"></i>Register & Download
                                                </button>
                                            </div>
                                            
                                        </form>

                                    </div>
                                    
                                    <div class="row g-3 align-items-end mt-2">

                                        <div class="col-lg-5">
                                            <a href="#" class="action-btn result-btn w-100">
                                                <i class="fas fa-trophy me-2"></i>View Results
                                            </a>
                                        </div>
                        
                                        <div class="col-lg-4">
                                            <form method="POST" action="https://grademarker.online/auth/autologin">
                                                <a href="<?php echo base_url();?>Cin_login/generate_login_url" class="action-btn result-btn w-100">
                                                    <i class="fas fa-chalkboard-teacher me-2"></i>Start Test
                                                </a>
                                            </form>
                                        </div>
                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <div class="info-label">CIN Number</div>
                    <div class="info-value"><?php echo $student[0]['cin']; ?></div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="info-label">Class</div>
                    <div class="info-value"><?php echo $student[0]['class']; ?></div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo $student[0]['stud_email']; ?></div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info-label">Mobile Number</div>
                    <div class="info-value"><?php echo $student[0]['stud_phone']; ?></div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Detail Section -->
    <section class="detail-section">
        <div class="container">
            <div class="row g-4">
                <!-- Guardian Details -->
                <div class="col-lg-6">
                    <div class="detail-card">
                        <div class="detail-card-header">
                            <img src="https://img.icons8.com/bubbles/100/000000/family.png" 
                                 alt="Family" class="detail-card-icon">
                            <h4 class="detail-card-title">Guardian Details</h4>
                        </div>
                        <table class="detail-table">
                            <tbody>
                                <tr>
                                    <th>Father's Name</th>
                                    <td><?php echo $student[0]['father_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mother's Name</th>
                                    <td><?php echo $student[0]['mother_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $student[0]['address1']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- School Details -->
                <div class="col-lg-6">
                    <div class="detail-card">
                        <div class="detail-card-header">
                            <img src="https://img.icons8.com/external-victoruler-flat-victoruler/64/000000/external-school-education-and-school-victoruler-flat-victoruler-2.png" 
                                 alt="School" class="detail-card-icon">
                            <h4 class="detail-card-title">School Details</h4>
                        </div>
                        
                        <?php
                                    $schoolName = $student[0]['school_name'] ?? '';
                                    $schoolId = $student[0]['school_id'] ?? '';
                                    $schoolAddress = $student[0]['school_address1'] ?? '';
            
                                    if (empty($schoolName)) {
                                        // Fetch default school if ID exists
                                        if (!empty($schoolId)) {
                                            $school = $this->db->get_where('school_new', ['id' => $schoolId])->row();
                                            $schoolName = $school->school_name ?? '';
                                            $schoolAddress = $school->school_address . ' ' . $school->location . ' ' . $school->city ?? '';
                                        }
                                    }
                        ?>
                        
                        <!-- If school exists -->
                        <table class="detail-table">
                            <tbody>
                                <tr>
                                    <th>School Name</th>
                                    <td><?php echo $schoolName; ?></td>
                                </tr>
                                <tr>
                                    <th>School Address</th>
                                    <td><?php echo $schoolAddress; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <!-- If no school (uncomment to show add button) -->
                        <!-- <div class="text-center py-4">
                            <button type="button" class="add-school-btn" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                                <i class="fas fa-plus-circle me-2"></i>Add School Details
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-2"><strong>A Product Of MaRRS Intellectual Services Pvt. Ltd.</strong></p>
            <p class="mb-0">© Aviansys Technologies Pvt. Ltd. 2024-25</p>
        </div>
    </footer>

    <!-- Add School Modal -->
    <div class="modal fade" id="addSchoolModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-school me-2"></i>Add School Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="schoolForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="school_name" class="form-label">School Name *</label>
                            <input type="text" class="form-control" id="school_name" 
                                   name="school_name" required placeholder="Enter school name">
                        </div>
                        <div class="mb-3">
                            <label for="school_address" class="form-label">School Address *</label>
                            <textarea class="form-control" id="school_address" 
                                      name="school_address" rows="3" required 
                                      placeholder="Enter complete school address"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="action-btn" id="saveSchoolBtn">
                            <i class="fas fa-save me-2"></i>Save Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Register button functionality
        document.getElementById('registerBtn').addEventListener('click', function() {
            const select = document.getElementById('competitionSelect');
            if (select.value) {
                // Show success message
                const alert = document.getElementById('success-alert');
                alert.style.display = 'block';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
                
                // Here you would normally redirect or handle the registration
                console.log('Registering for competition:', select.value);
            } else {
                alert('Please select a competition first!');
            }
        });

        // School form submission
        document.getElementById('schoolForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('saveSchoolBtn');
            const originalText = btn.innerHTML;
            
            // Show loading state
            btn.innerHTML = '<span class="loading"></span> Saving...';
            btn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('addSchoolModal'));
                modal.hide();
                
                // Show success message
                const alert = document.getElementById('success-alert');
                alert.innerHTML = '<h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>School details saved successfully!</h5>';
                alert.style.display = 'block';
                
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
                
                // Reset button
                btn.innerHTML = originalText;
                btn.disabled = false;
                
                // Reset form
                this.reset();
            }, 1500);
        });

        // Auto-hide success alert if shown on page load
        window.addEventListener('load', function() {
            const alert = document.getElementById('success-alert');
            if (alert.style.display === 'block') {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</body>
</html>