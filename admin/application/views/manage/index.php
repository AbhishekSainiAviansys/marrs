<?php include('header.php'); ?>

<?php
// Dashboard Counts
$totalSchools = $this->db->count_all('school_new');

$requestedSchools = $this->db
    ->where('school_status', 'Active') // change condition if needed
    ->count_all_results('school_new');

$totalStudents = $this->db->count_all('cin_list');

$requestedStudents = $this->db
    ->where('status', 'Active') // change condition if needed
    ->count_all_results('cin_list');
?>

<style>
.dashboard-section {
    padding: 20px;
}

.dashboard-card {
    border-radius: 12px;
    padding: 20px;
    color: #fff;
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.card-title {
    font-size: 14px;
    opacity: 0.9;
}

.card-value {
    font-size: 28px;
    font-weight: bold;
}

/* Colors */
.bg-blue { background: #4e73df; }
.bg-green { background: #1cc88a; }
.bg-red { background: #e74a3b; }
.bg-yellow { background: #f6c23e; color:#000; }
</style>

<div class="container-fluid dashboard-section">

    <!-- Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a> <span class="divider">/</span></li>
        <li class="active">Dashboard</li>
    </ul>

    <!-- Row -->
    <div class="row">

        <!-- Total Schools -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="dashboard-card bg-blue">
                <div class="card-title">Total Schools</div>
                <div class="card-value"><?= $totalSchools; ?></div>
            </div>
        </div>

        <!-- Requested Schools -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="dashboard-card bg-green">
                <div class="card-title">Active Schools</div>
                <div class="card-value"><?= $requestedSchools; ?></div>
            </div>
        </div>

        <!-- Total Students -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="dashboard-card bg-red">
                <div class="card-title">Total Students</div>
                <div class="card-value"><?= $totalStudents; ?></div>
            </div>
        </div>

        <!-- Requested Students -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-12 mb-3">
            <div class="dashboard-card bg-yellow">
                <div class="card-title">Active Students</div>
                <div class="card-value"><?= $requestedStudents; ?></div>
            </div>
        </div>

    </div>

</div>

<?php include('footer.php'); ?>