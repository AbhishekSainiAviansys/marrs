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
    <link rel="stylesheet" href="https://marrs.in/lunar/css/custom.css?update1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        a { text-decoration: none !important; }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f8;
            color: #2C3E50;
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        .navbar {
            background: linear-gradient(135deg, #1a2a6c, #2d46b9) !important;
            padding: 10px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .navbar-brand img { filter: brightness(1.1); }
        .nav-profile-img {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.5);
            object-fit: cover;
        }
        .dropdown-toggle { display: flex; align-items: center; gap: 8px; }
        .dropdown-toggle span { color: #fff; font-size: 14px; font-weight: 500; }
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 8px;
            min-width: 180px;
        }
        .dropdown-item {
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 14px;
            color: #2C3E50;
            font-weight: 500;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background: #eef2ff;
            color: #4A5BF5;
            padding-left: 18px;
        }
        .dropdown-item i { width: 18px; margin-right: 6px; color: #4A5BF5; }

        /* ── Page wrapper ── */
        .page-wrapper {
            min-height: calc(100vh - 140px);
            padding: 36px 20px 60px;
        }

        /* ── Section title banner ── */
        .section-banner {
            background: linear-gradient(135deg, #4A5BF5, #7B68EE);
            border-radius: 16px;
            padding: 18px 32px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 8px 24px rgba(74,91,245,0.3);
        }
        .section-banner i {
            font-size: 24px;
            color: rgba(255,255,255,0.85);
        }
        .section-banner h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.3px;
        }

        /* ── Main card ── */
        .main-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .main-card-header {
            background: linear-gradient(135deg, #f8f9fe, #eef2ff);
            border-bottom: 1px solid #e8ecff;
            padding: 22px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .main-card-header .icon-box {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #4A5BF5, #7B68EE);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }
        .main-card-header .icon-box i { color: #fff; font-size: 18px; }
        .main-card-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
        }
        .main-card-header p {
            margin: 2px 0 0;
            font-size: 13px;
            color: #888;
        }
        .main-card-body { padding: 28px; }

        /* ── Form selects ── */
        .form-label-custom {
            font-size: 12px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
            display: block;
        }
        .form-control-custom {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #e8ecff;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            color: #1a1a2e;
            background: #fafbff;
            transition: all 0.25s;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%234A5BF5' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
            cursor: pointer;
        }
        .form-control-custom:focus {
            border-color: #4A5BF5;
            outline: none;
            box-shadow: 0 0 0 4px rgba(74,91,245,0.1);
            background: #fff;
        }

        /* ── Select row ── */
        .select-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        @media (max-width: 640px) { .select-grid { grid-template-columns: 1fr; } }

        /* ── Subject badge ── */
        #subject-display { display: none; margin: 4px 0 20px; }
        .subject-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #4A5BF5, #7B68EE);
            color: #fff;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.4px;
            box-shadow: 0 4px 14px rgba(74,91,245,0.35);
            animation: popIn 0.3s ease;
        }
        @keyframes popIn { from { transform: scale(0.85); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .subject-badge i { font-size: 14px; }

        /* ── Level select ── */
        .level-select-wrap {
            margin-bottom: 20px;
        }

        /* ── Test Detail accordion ── */
        .test-detail-accordion {
            border: 2px solid #e8ecff;
            border-radius: 14px;
            overflow: hidden;
        }
        .test-detail-btn {
            background: linear-gradient(135deg, #f0f3ff, #e8ecff);
            border: none;
            width: 100%;
            padding: 16px 20px;
            text-align: left;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #4A5BF5;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: background 0.2s;
        }
        .test-detail-btn:hover { background: #e4e9ff; }
        .test-detail-btn i { font-size: 18px; transition: transform 0.3s; }
        .test-detail-btn.collapsed i { transform: rotate(0deg); }
        .test-detail-btn:not(.collapsed) i { transform: rotate(180deg); }
        .test-detail-body { background: #fafbff; padding: 0; }

        /* ── Results table ── */
        #untets_topic table,
        #attemtets_topic table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
        #untets_topic table thead tr,
        #attemtets_topic table thead tr {
            background: linear-gradient(90deg, #4A5BF5, #7B68EE) !important;
            color: #fff !important;
        }
        #untets_topic table thead th,
        #attemtets_topic table thead th {
            padding: 13px 16px !important;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.3px;
            border: none !important;
        }
        #untets_topic table tbody tr,
        #attemtets_topic table tbody tr {
            border-bottom: 1px solid #f0f0f0 !important;
            transition: background 0.15s;
        }
        #untets_topic table tbody tr:hover,
        #attemtets_topic table tbody tr:hover { background: #f5f7ff !important; }
        #untets_topic table tbody td,
        #attemtets_topic table tbody td {
            padding: 12px 16px !important;
            border: none !important;
            color: #333;
            vertical-align: middle;
        }

        /* Status badges inside table */
        #untets_topic span[style*="background:#dc3545"],
        #untets_topic span[style*="background:red"],
        #attemtets_topic span[style*="background:#dc3545"],
        #attemtets_topic span[style*="background:red"] {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24) !important;
            border-radius: 20px !important;
            padding: 4px 12px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }
        #untets_topic span[style*="background:#28a745"],
        #attemtets_topic span[style*="background:#28a745"] {
            background: linear-gradient(135deg, #2ECC71, #27AE60) !important;
            border-radius: 20px !important;
            padding: 4px 12px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        /* Buttons inside table */
        #untets_topic button,
        #attemtets_topic button {
            border-radius: 8px !important;
            padding: 7px 16px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            font-family: 'Poppins', sans-serif !important;
            border: none !important;
            cursor: pointer !important;
            transition: transform 0.15s, box-shadow 0.15s !important;
        }
        #untets_topic button:hover,
        #attemtets_topic button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2) !important;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: #aaa;
        }
        .empty-state i { font-size: 40px; color: #d0d5ff; margin-bottom: 12px; display: block; }
        .empty-state p { font-size: 14px; margin: 0; }

        /* ── Progress bar ── */
        .progress-bar-container {
            width: 100%; height: 10px;
            background: #e5e7eb;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 10px;
        }
        .progress-bar-fill {
            height: 100%; width: 0%;
            background: linear-gradient(90deg, #4A5BF5, #7B68EE);
            border-radius: 20px;
            transition: width 0.8s ease-in-out;
        }

        /* ── Footer ── */
        footer {
            background: linear-gradient(135deg, #1a2a6c, #2d46b9);
            padding: 24px 0;
        }
        footer a { color: rgba(255,255,255,0.75) !important; font-size: 14px; transition: color 0.2s; }
        footer a:hover { color: #fff !important; }
        footer small { font-size: 13px; }

        /* ── Modal ── */
        .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
        .modal-header {
            background: linear-gradient(135deg, #4A5BF5, #7B68EE);
            color: #fff;
            border-radius: 16px 16px 0 0;
            border: none;
            padding: 20px 24px;
        }
        .modal-title { font-weight: 700; font-size: 17px; }
        .modal-body { padding: 28px 24px; }
        .modal-footer { border: none; padding: 12px 24px 20px; }

        /* ── Animations ── */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        .main-card { animation: fadeInUp 0.5s ease-out; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src='https://marrs.in/student_registration/certificate_logo/flunar.jpg'
                         class="img-fluid" alt='logo' width="180">
                </a>
                <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                               id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" href="#">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png"
                                     class="nav-profile-img" alt="Profile">
                                <span style="color:#fff;font-weight:500;">Profile</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="https://marrs.in/lunar/Cin_login/index">
                                    <i class="fas fa-user"></i> Profile View</a></li>
                                <li><a class="dropdown-item" href="https://marrs.in/lunar/Cin_login/edit_cin_login">
                                    <i class="fas fa-pen"></i> Profile Edit</a></li>
                                <li><a class="dropdown-item" href="https://marrs.in/lunar/Cin_login/invoice">
                                    <i class="fas fa-file-invoice"></i> Invoice</a></li>
                                <li><a class="dropdown-item" href="https://marrs.in/lunar/Cin_login/resetpassword">
                                    <i class="fas fa-key"></i> Reset Password</a></li>
                                <li><a class="dropdown-item" href="https://marrs.in/lunar/Cin_login/enquiry">
                                    <i class="fas fa-ticket"></i> Support Ticket</a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item text-danger" href="https://marrs.in/lunar/Cin_login/logout">
                                    <i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page -->
    <div class="page-wrapper mb-3">
        <div class="container pb-5" >

           

            <!-- Main Card -->
            <div class="main-card" data-aos="fade-up">

                <!-- Card Header -->
                <div class="main-card-header">
                    <div class="icon-box">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div>
                        <h3>Demo Skill Test — Details</h3>
                        <p>Select your product and subject to view test details</p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="main-card-body">

                    <!-- Row 1: Product + Subject -->
                    <div class="select-grid">
                        <div>
                            <label class="form-label-custom">
                                <i class="fas fa-box" style="color:#4A5BF5;margin-right:5px;"></i>
                                Product
                            </label>
                            <select name="product_name" class="form-control-custom" required>
                                <option value="">Select Product</option>
                                <?php
                                $products = $this->db->where('status','Active')->get('products')->result_array();
                                foreach ($products as $row): ?>
                                    <option value="<?= $row['id'] ?>"
                                        <?= ($product_name == $row['product_name']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['product_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="form-label-custom">
                                <i class="fas fa-book-open" style="color:#4A5BF5;margin-right:5px;"></i>
                                Subject
                            </label>
                            <select name="subject" id="attemsubject" class="form-control-custom" required>
                                <option value="">Select Subject</option>
                                <option value="ENGLISH">ENGLISH</option>
                                <option value="MATH">MATH</option>
                            </select>
                        </div>
                    </div>

                    <!-- Subject Badge -->
                    <div id="subject-display">
                        <span class="subject-badge">
                            <i class="fas fa-book-open"></i>
                            Subject: <span id="subject-name-text"></span>
                        </span>
                    </div>

                    <!-- Level Select -->
                    <div class="level-select-wrap">
                        <label class="form-label-custom">
                            <i class="fas fa-layer-group" style="color:#4A5BF5;margin-right:5px;"></i>
                            Level / Schedule
                        </label>
                        <select name="schedule" id="attemschedule" class="form-control-custom" required>
                            <option value="">-- Select Level --</option>
                        </select>
                    </div>

                    <!-- Test Detail Accordion -->
                    <div class="test-detail-accordion">
                        <button type="button"
                                class="test-detail-btn collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#testDetailBody">
                            <span>
                                <i class="fas fa-list-ul me-2" style="font-size:14px;"></i>
                                Test Detail
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="testDetailBody" class="accordion-collapse collapse show test-detail-body">
                            <div id="untets_topic" style="padding:0;">
                                <!-- Empty state shown by default -->
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>Select a level to view test details</p>
                                </div>
                            </div>
                        </div>
                    </div>

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
                        <h5 class="modal-title">
                            <i class="fas fa-school me-2"></i>Add School Details
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">School Name</label>
                            <input type="text" class="form-control-custom"
                                   id="school_name" name="school_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">School Address</label>
                            <textarea class="form-control-custom"
                                      id="school_address" name="school_address"
                                      rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="student_id" value="87308">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Save Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <div class="mb-2">
                <a href="https://marrs.in" class="p-2">Home</a>
                <a href="https://marrs.in/about.php" class="p-2">About Us</a>
                <a href="https://marrs.in/contact.php" class="p-2">Contact Us</a>
            </div>
            <small class="text-white opacity-75">
                © <a href="#" style="color:orange!important;">Aviansys Technology Pvt. Ltd.</a> 2025–2026
            </small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
    AOS.init({ duration: 600, once: true });

    // ── Helpers ────────────────────────────────────────────
    function showSubjectBadge(subject) {
        if (subject) {
            $("#subject-name-text").text(subject);
            $("#subject-display").show();
        } else {
            $("#subject-display").hide();
        }
    }

    function buildExamTable(exams) {
        if (!exams || exams.length === 0) {
            return '<div class="empty-state"><i class="fas fa-inbox"></i><p>No test data found</p></div>';
        }
        var html = '<table><thead><tr>'
            + '<th>Test Number</th><th>Level</th><th>Status</th><th>Action</th>'
            + '</tr></thead><tbody>';
        $.each(exams, function (i, item) {
            var status = parseInt(item.status || 0);
            html += '<tr>';
            html += '<td><strong>' + item.id_ujian + '</strong></td>';
            html += '<td>' + (item.nama_matkul || '—') + '</td>';
            html += '<td>';
            if (status === 0) {
                html += '<span style="background:linear-gradient(135deg,#ff6b6b,#ee5a24);color:#fff;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Not Attempted</span>';
            } else {
                html += '<span style="background:linear-gradient(135deg,#2ECC71,#27AE60);color:#fff;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">Completed</span>';
            }
            html += '</td><td>';
            var base_url = "https://marrs.in/student_registration/Cin_login/generate_login_url";
            if (status === 0) {
                html += '<form method="POST" action="' + base_url + '" style="margin:0">'
                    + '<input type="hidden" name="series" value="">'
                    + '<input type="hidden" name="product_name" value="' + item.nama_jurusan + '">'
                    + '<input type="hidden" name="status" value="Paid">'
                    + '<input type="hidden" name="exam_id" value="' + item.id_ujian + '">'
                    + '<button type="submit" style="background:linear-gradient(135deg,#2ECC71,#27AE60);color:#fff;border:none;padding:7px 16px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">▶ Start Test</button>'
                    + '</form>';
            } else {
                html += '<form method="POST" action="' + base_url + '" style="margin:0">'
                    + '<input type="hidden" name="exam_id" value="' + item.id_ujian + '">'
                    + '<button type="submit" style="background:linear-gradient(135deg,#4A5BF5,#7B68EE);color:#fff;border:none;padding:7px 16px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">📊 View Score</button>'
                    + '</form>';
            }
            html += '</td></tr>';
        });
        html += '</tbody></table>';
        return html;
    }

    function loadSchedules(subject, restoreValue, afterLoad) {
        if (!subject) return;
        $.ajax({
            url: "https://marrs.in/student_registration/cin_login/attemschedule",
            data: { subject: subject },
            type: 'POST',
            success: function (result) {
                $("#attemschedule").html(result);
                if (restoreValue) $("#attemschedule").val(restoreValue);
                if (typeof afterLoad === 'function') afterLoad();
            },
            error: function () { alert("Error fetching schedules."); }
        });
    }

    // ── On load: restore session ────────────────────────────
    $(document).ready(function () {
        var savedSubject  = sessionStorage.getItem('attemSubject');
        var savedSchedule = sessionStorage.getItem('attemSchedule');
        var savedExamData = sessionStorage.getItem('attemExamData');

        if (savedSubject) {
            $("#attemsubject").val(savedSubject);
            showSubjectBadge(savedSubject);
            loadSchedules(savedSubject, savedSchedule, function () {
                if (savedExamData) {
                    try {
                        var exams = JSON.parse(savedExamData);
                        $("#untets_topic").html(buildExamTable(exams));
                    } catch(e) {}
                }
            });
        }

        $("#success-alert").fadeTo(3000, 500).slideUp(500);
    });

    // ── Subject change ──────────────────────────────────────
    $("#attemsubject").change(function () {
        var subject = this.value;
        sessionStorage.setItem('attemSubject', subject);
        sessionStorage.removeItem('attemSchedule');
        sessionStorage.removeItem('attemExamData');
        showSubjectBadge(subject);
        loadSchedules(subject, null, null);
        $("#untets_topic").html('<div class="empty-state"><i class="fas fa-layer-group"></i><p>Select a level to view tests</p></div>');
    });

    // ── Schedule change ─────────────────────────────────────
    $("#attemschedule").change(function () {
        var series = $(this).find(':selected').data('id');
        sessionStorage.setItem('attemSchedule', $(this).val());

        if (!series) {
            $("#untets_topic").html('<div class="empty-state"><i class="fas fa-layer-group"></i><p>Select a level to view tests</p></div>');
            return;
        }

        $("#untets_topic").html('<div class="empty-state"><i class="fas fa-spinner fa-spin"></i><p>Loading tests...</p></div>');

        $.ajax({
            url: "https://marrs.in/student_registration/cin_login/unscd_description",
            type: "POST",
            dataType: "json",
            data: { series: series },
            success: function (data) {
                var exams = data.data || [];
                sessionStorage.setItem('attemExamData', JSON.stringify(exams));
                $("#untets_topic").html(buildExamTable(exams));
            },
            error: function () {
                $("#untets_topic").html('<div class="empty-state"><i class="fas fa-exclamation-circle" style="color:#ff6b6b"></i><p>Failed to load tests. Please try again.</p></div>');
            }
        });
    });

    // ── Other existing handlers ─────────────────────────────
    $("#subject").change(function () {
        $.ajax({ url: "https://marrs.in/lunar/cin_login/schedule", data: { subject: this.value }, type: 'POST',
            success: function (r) { $("#schedule").html(r); }, error: function () { alert("Error fetching data."); } });
    });
    $("#msubject").change(function () {
        $.ajax({ url: "https://marrs.in/lunar/cin_login/mschedule", data: { subject: this.value }, type: 'POST',
            success: function (r) { $("#mschedule").html(r); }, error: function () { alert("Error fetching data."); } });
    });
    $("#schedule").change(function () {
        var scdid = $(this).find(':selected').data('scdid');
        $.ajax({ url: "https://marrs.in/lunar/cin_login/scd_description", type: "POST", data: { scdid: scdid },
            success: function (res) {
                var data = JSON.parse(res);
                var html = '<table style="width:100%;border:1px solid #000;border-collapse:collapse;">';
                html += '<tr><th style="border:1px solid #000;padding:8px;">Test Number</th><th style="border:1px solid #000;padding:8px;">Topic</th><th style="border:1px solid #000;padding:8px;">Description</th></tr>';
                $.each(data, function (i, item) {
                    html += '<tr><td style="border:1px solid #000;padding:8px;">' + item.title + '</td><td style="border:1px solid #000;padding:8px;">' + item.topic + '</td><td style="border:1px solid #000;padding:8px;">' + item.description + '</td></tr>';
                });
                html += '</table>';
                $("#tets_topic").html(html);
            }
        });
    });
    $("#unsubject").change(function () {
        $.ajax({ url: "https://marrs.in/lunar/cin_login/unschedule", data: { subject: this.value }, type: 'POST',
            success: function (r) { $("#unschedule").html(r); }, error: function () { alert("Error fetching data."); } });
    });

    // ── Progress bars ───────────────────────────────────────
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".progress-bar-fill").forEach(function (bar) {
            bar.style.width = bar.getAttribute("data-percentage") + "%";
        });
    });

    // ── School form ─────────────────────────────────────────
    $("#schoolForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "https://marrs.in/lunar/Cin_login/save_school_details",
            type: "POST", data: $(this).serialize(), dataType: "json",
            beforeSend: function () { $("#schoolForm button[type='submit']").prop("disabled", true).text("Saving..."); },
            success: function (response) {
                if (response.status === "success") { $("#addSchoolModal").modal("hide"); alert("Saved!"); location.reload(); }
                else { alert("Error: " + response.message); }
            },
            error: function () { alert("Something went wrong."); },
            complete: function () { $("#schoolForm button[type='submit']").prop("disabled", false).text("Save Details"); }
        });
    });

    // ── Accordion icon toggle ───────────────────────────────
    document.querySelectorAll('.accordion-collapse').forEach(function (el) {
        el.addEventListener('show.bs.collapse', function () {
            var icon = document.getElementById('icon-' + el.id);
            if (icon) icon.innerHTML = '✕';
        });
        el.addEventListener('hide.bs.collapse', function () {
            var icon = document.getElementById('icon-' + el.id);
            if (icon) icon.innerHTML = '+';
        });
    });
    </script>

</body>
</html>