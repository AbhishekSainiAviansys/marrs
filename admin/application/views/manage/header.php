<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <style>
         #example_filter{
              display: flex;
        justify-content: flex-end;
      }
    </style>
    <style>
        /* ===== MODERN PAGINATION ===== */
#filterForm{
    border:1px solid gray;
}
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 6px;
}

/* Page items */
.pagination ul li a {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 8px;
    background: #2a2a3b;
    color: #ddd;
    text-decoration: none;
    font-size: 14px;
    transition: 0.2s ease;
    border: 1px solid #3a3a50;
}

/* Hover */
.pagination ul li a:hover {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
    transform: translateY(-1px);
}

/* Active (if you add .active manually later) */
.pagination ul li a.active {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
    font-weight: 600;
}

/* Prev / Next emphasis */
.pagination ul li:first-child a,
.pagination ul li:last-child a {
    background: #1e1e2f;
    font-weight: 500;
}

/* Disabled style (optional if you add class) */
.pagination ul li a.disabled {
    opacity: 0.4;
    pointer-events: none;
}
    </style>
    <style>

/* ===== FORM CONTAINER ===== */
.box-content form {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
}

/* ===== FIELDSET ===== */
fieldset {
    border: 1px solid #eee !important;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
    background: #fff;
}

/* LEGEND STYLE */
legend {
    font-size: 16px;
    font-weight: 600;
    color: #f26522;
    padding: 0 10px;
}

/* ===== FLEX FIX (your existing issue) ===== */
fieldset {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

/* ===== FORM GROUP ===== */
.form-group {
    flex: 1 1 250px;
}

/* ===== LABEL ===== */
.form-group label {
    font-weight: 500;
    margin-bottom: 5px;
    display: block;
    font-size: 13px;
}

/* ===== INPUTS ===== */
.form-control {
    width: 100%;
    height: 36px;
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 13px;
    transition: 0.2s;
}

/* FOCUS EFFECT */
.form-control:focus {
    border-color: #f26522;
    box-shadow: 0 0 0 2px rgba(242, 101, 34, 0.15);
    outline: none;
}

/* TEXTAREA */
textarea.form-control {
    min-height: 80px;
    height: auto;
}

/* ===== BUTTON ===== */
.btn-info, .btn-primary {
    background: #f26522 !important;
    border: none !important;
    padding: 6px 18px;
    border-radius: 6px;
    font-size: 13px;
}

.btn-info:hover, .btn-primary:hover {
    background: #d9531e !important;
}

/* ===== MOBILE RESPONSIVE ===== */
@media (max-width: 768px) {
    fieldset {
        flex-direction: column;
    }

    .form-group {
        flex: 1 1 100%;
    }
}

</style>
    <style>

/* Apply to ALL inputs (form + table) */
input,
select,
textarea {
    width: 100%;
    padding: 8px 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    transition: all 0.2s ease;
    background: #fff;
}

/* Focus (your orange theme 🔥) */
input:focus,
select:focus,
textarea:focus {
    border-color: #f26522;
    box-shadow: 0 0 0 2px rgba(242, 101, 34, 0.15);
}

/* Same height everywhere */
input,
select {
    height: 36px;
}

/* Textarea */
textarea {
    min-height: 80px;
    resize: vertical;
}

/* Disabled */
input:disabled,
select:disabled,
textarea:disabled {
    background: #f5f5f5;
    cursor: not-allowed;
}

/* Placeholder */
input::placeholder,
textarea::placeholder {
    color: #aaa;
    font-size: 13px;
}

</style>
    <style>

/* Container styling */
.box-header {
    background: #ffffff;
    padding: 12px 16px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #f26522; /* 🔥 orange */
    border-radius: 10px;
    margin:1rem 0rem;
}

/* Title */
.box-header h2 {
    font-size: 1.5rem;
    margin: 0;
    font-weight: 600;
    color: #333;

    display: flex;
    align-items: center;
    gap: 8px;
}

/* Icons inside title */
.box-header h2 i {
    font-size: 16px;
    color: #f26522; /* your theme color */
}

/* Right side buttons */
.box-icon {
    display: flex;
    gap: 6px;
}

/* Buttons */
.box-icon .btn {
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 6px;
    background: #f1f1f1;
    border: none;
    color: #333;
    transition: 0.2s;
}

/* Hover effect */
.box-icon .btn:hover {
    background: #f26522;
    color: #fff;
}

/* Remove old styles */
.btn-round {
    border-radius: 6px !important;
}

/* Optional shadow */
.box-header {
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

</style>
    <style>

/* LET CONTENT DECIDE WIDTH */
table {
    width: 100%;
    table-layout: auto; /* 🔥 important (default but force it) */
    border-collapse: collapse;
    font-size: 12px !important;
    margin: 2rem 0rem;
}

/* HEADER */
table thead {
    background: #f26522;
    color: #fff;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

/* 🔥 IMPORTANT: allow wrapping */
th, td {
    white-space: normal;   /* allows text to wrap */
    /*word-break: break-word; */
    /* break long words */
}

/* ROW DESIGN */
table tbody tr:nth-child(even) {
    background: #f9f9f9;
}

table tbody tr:hover {
    background: #fff3e6;
}
/* Make all buttons inside table small */
table .btn {
    padding: 5px 8px !important;
    font-size: 12px !important;
    line-height: 1.2;
    border-radius: 4px;
    text-wrap: nowrap;
}

/* Optional: smaller icons inside buttons */
table .btn i {
    font-size: 12px;
}

/* Optional: reduce spacing between multiple buttons */
table .btn + .btn {
    margin-left: 4px;
}
#content {
    padding: 0rem 1rem !important;
}
/* Inputs inside table */
table input,
table select,
table textarea {
    width: 100%;
    padding: 6px 10px;
    font-size: 13px;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    transition: 0.2s;
    background: #fff;
}

/* Focus effect */
table input:focus,
table select:focus,
table textarea:focus {
    border-color: #f26522;
    box-shadow: 0 0 0 2px rgba(242, 101, 34, 0.15);
}

/* Small height (compact like admin panel) */
table input,
table select {
    height: 32px;
}

/* Textarea */
table textarea {
    resize: vertical;
    min-height: 60px;
}

/* Disabled */
table input:disabled,
table select:disabled {
    background: #f5f5f5;
    cursor: not-allowed;
}

/* Placeholder style */
table input::placeholder {
    color: #aaa;
    font-size: 12px;
}

/* Error state */
table .error {
    border-color: red !important;
}

/* Success state */
table .success {
    border-color: green !important;
}

</style>
    <style>
/* Fix old Bootstrap breadcrumb to look modern */
.breadcrumb {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    margin: 1rem 0rem;
}

/* Remove default list style */
.breadcrumb li {
    list-style: none;
    display: inline-flex;
    align-items: center;
}

/* Style links */
.breadcrumb li a {
    text-decoration: none;
    color: #0d6efd;
    font-weight: 500;
}

/* Active item */
.breadcrumb .active {
    color: #6c757d;
    font-weight: 600;
}

/* Fix divider */
.breadcrumb .divider {
    margin: 0 5px;
    color: #999;
}

/* Optional hover */
.breadcrumb li a:hover {
    text-decoration: underline;
}
.box, .span12{
    padding: 1rem 2rem !important;
}
</style>
    <style>
body {
    padding-top: 0;
    margin: 0;
}

/* ===== TOP NAVBAR ===== */
.navbar-top {
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1030;
}

.navbar-brand {
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #fff !important;
}

.navbar-brand img {
    height: 45px;
}

/* ===== USER DROPDOWN ===== */
.user-dropdown {
    position: relative;
    z-index: 1035;
}

.user-dropdown .btn {
    background-color: rgb(241 99 33);
    border: none;
    color: #fff;
}

.user-dropdown .dropdown-menu {
    right: 0;
    left: auto;
}

/* ===== MENU NAVBAR ===== */
.navbar-menu {
    background: #f8f9fa;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 76px;
    z-index: 1025;
    overflow: visible !important; /* IMPORTANT */
}

.navbar-menu .navbar-nav {
    flex-wrap: wrap;
    width: 100%;
}

.navbar-menu .nav-item {
    position: relative;
}

.navbar-menu .nav-link {
    color: #333 !important;
    font-size: 0.9rem;
    padding: 0.8rem 1rem !important;
    border-bottom: 3px solid transparent;
    font-weight: 500;
    white-space: nowrap;
}

.navbar-menu .nav-link:hover {
    background-color: rgba(242, 101, 34, 0.08);
    border-bottom-color: #f26522;
    color: #f26522 !important;
}

/* ===== DROPDOWN ===== */
.dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    padding: 8px 0;
    min-width: 260px;
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    z-index: 1050;
    display: none;
    overflow: visible !important; /* 🔥 FIX */
}

.dropdown-menu.show {
    display: block;
}

.dropdown-item {
    padding: 0.7rem 1rem;
    font-size: 0.9rem;
    border-radius: 6px;
    margin: 2px 6px;
    cursor: pointer;
}

.dropdown-item:hover {
    background-color: #f1f5f9;
    color: #f26522;
}

/* ===== SUBMENU ===== */
.dropdown-submenu {
    position: relative;
}

 .dropdown-submenu > a {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            font-size: 0.9rem;
            border-radius: 8px;
            margin: 2px 6px;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            background-color: transparent;
        }

.dropdown-submenu > a:hover {
    background-color: #f1f5f9;
    color: #f26522;
}

/* Arrow */
.dropdown-submenu > a::after {
        content: " ▶";
        font-size: 0.7rem;
        transition: transform 0.2s ease;
        float: right;
}

/* SUBMENU POSITION */
.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-left: 5px;
    display: none;
    position: absolute;
    z-index: 1051;
}

/* SHOW SUBMENU */
.dropdown-submenu.show > .dropdown-menu {
    display: block;
}

.dropdown-submenu > .dropdown-menu > li > a {
    padding: 0.75rem 1rem;
    color: #333;
    font-size: 0.9rem;
    border-radius: 8px;
    margin: 2px 6px;
    text-decoration: none;
    cursor: pointer;
    display: block;
}

.dropdown-submenu > .dropdown-menu > li > a:hover {
    background-color: #f1f5f9;
    color: #f26522;
}



.dropdown-submenu.show > a::after {
    transform: rotate(90deg);
}
/* ===== CONTENT ===== */
#content {
    padding: 2rem 1rem;
}



/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .navbar-menu .nav-link {
        font-size: 0.85rem;
        padding: 0.6rem !important;
    }
}

@media (max-width: 576px) {
    .navbar-brand span {
        display: none;
    }

    .navbar-menu .nav-link {
        font-size: 0.75rem;
    }
}
    </style>
    <style>
    .alert-success {
    position: fixed !important;
    bottom: 20px !important;
    right: 20px !important;
    min-width: 280px;
    z-index: 9999 !important;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);

    padding: 12px 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    animation: slideIn 0.4s ease;
}

/* Smooth slide animation */
@keyframes slideIn {
    from {
        transform: translateY(100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Close button styling */
.alert-success .close {
    background: none;
    border: none;
    font-size: 18px;
    float: right;
    cursor: pointer;
}

/* Optional: spacing text */
.alert-success span {
    display: block;
    font-size: 14px;
}

.dropdown-submenu {
    position: relative;
}

.dropdown-submenu > .cin-submenu {
    display: none;
    position: absolute;
    left: 100%;
    top: 0;
    margin-top: -1px;
    min-width: 230px;
}

.dropdown-submenu:hover > .cin-submenu {
    display: block;
}

.dropdown-submenu > .submenu-toggle {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.submenu-arrow {
    font-size: 20px;
    line-height: 1;
    margin-left: 15px;
}

</style>
</head>

<body>

    <!-- ===== TOP NAVBAR (Brand + Profile) ===== -->
    <nav class="navbar navbar-top">
        <div class="container-fluid">
            <!-- Brand / Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://marrs.in/newassets/MaRRS.png" alt="Logo" style="height:45px;">
            </a>

            <!-- Right Side - User Dropdown -->
            <div class="ms-auto user-dropdown">
                <div class="dropdown">
                    <button class="btn btn-sm rounded-pill px-3 d-flex align-items-center gap-2"
                        data-bs-toggle="dropdown" aria-expanded="false" type="button">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                        <span>Admin</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo SITE_URL?>login/logout/">
                                <i class="bi bi-box-arrow-right text-danger"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ===== MENU NAVBAR (SECOND ROW) ===== -->
    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container-fluid">
            <!-- Toggler Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav w-100 mb-0">

                    <!-- Home -->
                    <li class="nav-item" <?php if(in_array(CONTROLLER,array('index'))){?> class="active"<?php }?>>
                        <a class="nav-link active" href="<?php echo SITE_URL?>index/"><i class="bi bi-house-door"></i> Home</a>
                    </li>

                    <!-- Student Registration -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-plus"></i> Student Registration
                        </a>
                        <ul class="dropdown-menu">

                            <!-- CATEGORY 1 -->
                            <li class="dropdown-submenu">
                                <a href="#">
                                    Registered Students (2023+)
                                </a>
                        
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo SITE_URL?>school/competition_extraction">
                                            Competition Extract
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>school/mock_extraction">
                                            Mock Extract
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>school/material_extraction">
                                            Material Extract
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>school/orientation_extraction">
                                            Orientation Extract
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        
                            <li><hr class="dropdown-divider"></li>
                        
                            <!-- CATEGORY 2 -->
                            <li class="dropdown-submenu">
                                <a href="#">
                                    Registered Students (till 2023)
                                </a>
                        
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo SITE_URL?>franchise/Cin_extract">
                                            Competition Extraction List
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>franchise/Cin_extract_orientation">
                                            Orientation Extraction List
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>franchise/Cin_extract_mock">
                                            Mock Test Extraction List
                                        </a>
                                    </li>
                        
                                    <li><hr class="dropdown-divider"></li>
                        
                                    <li>
                                        <a href="<?php echo SITE_URL?>franchise/Cin_extract_material">
                                            Study Material Extraction List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        
                        </ul>
                    </li>

                    <!-- Price Codes -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-tag"></i> Price Codes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/AddPriceCode">Add PriceCode</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/acces_code_apporved">Price Code Approval</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/accesscode_apporvedList">Price Codes Approved List</a></li>
                        </ul>
                    </li>
                    
                    <!-- Product List -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-box"></i> Product List
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/productList">Product List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/addproduct">Add Product</a></li>
                        </ul>
                    </li>
                    
                    <!-- Franchise -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-shop"></i> Franchise
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/Addarea">Add Area Code</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/listAreacode">List Area Code</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/franchiseView">View List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/Addfrachise">Add Franchise</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/assignToFranchise">Assign Product To Franchise</a></li>
                        </ul>
                    </li>
                    
                    <!-- School -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-building"></i> School
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/schooListView">School List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/Add_school">School Add</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/bulk_school_template">Bulk School Template</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/bulk_schooladd">Bulk School Upload</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>school/onlineSchoolRegistrationList">New Online School Registration</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/add">Add Competition Schedule</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/schedule_list">School Level Schedule List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/search_school">Extract School QR Code</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/assign_product">Promotional Schools Assign Products</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/school_list">Promotional School List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/student_list">Promotional Students List</a></li>
                        </ul>
                    </li>
                    
                    <!-- Result -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-graph-up"></i> Result
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url();?>public/template/MARRS_RESULT_UPLOAD_TEMPLATE.csv">Result Template</a></li>
                            <!--<li><hr class="dropdown-divider"></li>-->
                            <!--<li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/student_result_upload1">Result Upload</a></li>-->
                            <!--<li><hr class="dropdown-divider"></li>-->
                            <!--<li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/student_result_edit">Result Edit</a></li>-->
                            <!--<li><hr class="dropdown-divider"></li>-->
                            <!--<li><a class="dropdown-item" href="<?php echo SITE_URL?>result/result_upload_against_schedule">Result Upload Against Schedule</a></li>-->
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/zoomzoom_result_upload">ZoomZoom Result Upload</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/zoomzoomresult_export">Export Result ZoomZoom</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/resultexport">Export Result</a></li>
                            <!--<li><hr class="dropdown-divider"></li>-->
                            <!--<li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/resultcalculate">Eveluate Result</a></li>-->
                        </ul>
                    </li>

                    <!-- Activate -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-play-circle"></i> Activate
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/period">Period</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/level">Competition Level</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/admin_revenue_setting">Admin Revenue Setting</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/launch_new_competition">Launch New Competition</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/competition_list">Live Competition List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/cmsch2">Schedule Assign School</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/search_school1">School QR - Other Than SchoolLevel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-item submenu-toggle">
                                    CIN Registration
                                    <span class="submenu-arrow"></span>
                                </a>
                            
                                <ul class="dropdown-menu cin-submenu">
                                    <li>
                                        <a class="dropdown-item"
                                           href="<?php echo SITE_URL?>competitionshedule/mark_cin">
                                            Mark CIN as registered
                                        </a>
                                    </li>
                            
                                    <li>
                                        <a class="dropdown-item"
                                           href="<?php echo SITE_URL?>competitionshedule/unmark_cin">
                                            Mark CIN as not registered
                                        </a>
                                    </li>
                            
                                    <li>
                                        <a class="dropdown-item"
                                           href="<?php echo SITE_URL?>franchise/clear_cart">
                                            Clear Cart
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_login_activate">Activate Open Championship</a></li>
                            
                        </ul>
                    </li>
                    
                    <!-- Study Material -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-book"></i> Study Material
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/study_material_2021">All Materials Upload</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/search_material">Material Search</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/mock_paper_upload_">Mock Paper Upload</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/mock_paper_search">Mock Paper Search</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/material_maker">Add Makers</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/assign_content">Assign Content</a></li>
                        </ul>
                    </li>
                    
                    <!-- Rank List -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list-ol"></i> Rank List
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>lunar/upload_rank">Upload Rank List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>lunar/filter_rank">Rank List Export</a></li>
                        </ul>
                    </li>
                    
                    <!-- Online Programs -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-laptop"></i> Online Programs
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu">
                                <a href="#">Lunar Skill Tests</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo SITE_URL?>lunar/export_cin_all">CIN Export</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/upload_result">Upload Result</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/export_result">Result Export</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/schedule_lunar">Activate New Programs</a></li>
                                      <li><a href="<?php echo SITE_URL?>lunar/lunar_program_list">Lunar Program List </a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/schedule_list">Active Competition List</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/lunarcompetition_activate">Assign Series To Cart</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/add_subject">Add Subject</a></li>
                                    <li><a href="<?php echo SITE_URL?>lunar/add_varient">Add Variant</a></li>
                                </ul>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-submenu">
                                <a href="#">MaRRS Zoom Zoom Challenge</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo SITE_URL?>zoomzoom/admin_revenue_and_competition">Launch Competition</a></li>
                                    <li><a href="<?php echo SITE_URL?>zoomzoom/schedule_list">Active Competition List</a></li>
                                    <li><a href="<?php echo SITE_URL?>zoomzoom/export_cin_all">CIN Export Registered Online</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Associate -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people"></i> Affiliate
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>lunar/add_associate">Add Affiliate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>lunar/update_associate">Update Affiliate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>lunar/competitionlist_associate">Activate Competition Link</a></li>
                        </ul>
                    </li>
                    
                    <!-- CIN Generation -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-card-checklist"></i> Manage CIN 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url();?>public/template/MARRS_CIN_GENERATIION_TEMPLATE.csv">CIN Template</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_list_recent">List Of recent CIN</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_list_latest">List Of Recent online registered</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_list_export">CIN Extract (2023/24)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_profile_update">CIN Update Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/delete_cin">Delete CIN</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/cin_delete">Bulk Delete CIN</a></li>
                        </ul>
                    </li>
                    
                    <!-- ZoomZoom Extract -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-download"></i> ZoomZoom Extract 22/23
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>franchise/zoomzoom_export">ZoomZoom Export</a></li>
                        </ul>
                    </li>
                    
                    <!-- Extract CIN Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark"></i> Extract CIN Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/profile_extract">Get Profile and Result</a></li>
                        </ul>
                    </li>
                    
                    <!-- Support Enquiry -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-question-circle"></i> Support Enquiry
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL?>competitionshedule/cin_enquiries">Enquiries</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<!-- ===== MAIN CONTENT ===== -->
<div class="container-fluid">
    <div class="row">

        <?php 
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();

        // Show Go Back button on all pages EXCEPT dashboard
        if (!($controller == 'index' && $method == 'index')) { ?>
            
            <div class="backbtn mt-3 mx-3">
                <button type="button" class="btn btn-danger"
                    onclick="if(document.referrer !== '') { window.history.back(); } else { window.location.href='/admin/manage/index/'; }">
                    <i class="bi bi-arrow-left"></i> Go Back
                </button>
            </div>

        <?php } ?>

        <!-- Content Area -->
        <div id="content" class="col-12 my-2">

            <?php 
            // ✅ Show Welcome ONLY on dashboard
            if ($controller == 'index' && $method == 'index') { ?>
                
                <div class="alert alert-info">
                    <h4>Welcome to Dashboard!</h4>
                </div>

            <?php } ?>

        </div>

    </div>
</div>


    <!-- Bootstrap JS -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->

    <!-- Submenu Toggle Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    
        document.querySelectorAll('.dropdown-submenu > a').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
    
                let parent = this.parentElement;
    
                // close others
                document.querySelectorAll('.dropdown-submenu').forEach(function (item) {
                    if (item !== parent) item.classList.remove('show');
                });
    
                // toggle current
                parent.classList.toggle('show');
            });
        });
    
    });    
    </script>

