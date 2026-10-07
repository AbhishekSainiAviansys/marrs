<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>
<style>

/* ================================
   MAIN CARD
================================ */

.box-content {
    background: #f8f9fa;
    padding: 24px;
}


/* ================================
   CARDS
================================ */

.box-content .card {
    border-radius: 12px;
    overflow: hidden;
}

.box-content .card-header {
    border-bottom: 1px solid #e9ecef;
}


/* ================================
   FORM CONTROLS
================================ */

.box-content .form-label {
    color: #343a40;
    margin-bottom: 7px;
}

.box-content .form-control,
.box-content .form-select {
    min-height: 42px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: all .2s ease;
}

.box-content .form-control:focus,
.box-content .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
}


/* ================================
   SERVICE OPTIONS
================================ */

.service-option {
    position: relative;
}

.service-option input {
    position: absolute;
    opacity: 0;
}

.service-option label {
    width: 100%;
    min-height: 72px;

    display: flex;
    align-items: center;
    gap: 14px;

    padding: 12px 15px;

    border: 1px solid #dee2e6;
    border-radius: 10px;

    background: #fff;

    cursor: pointer;

    transition: all .2s ease;
}

.service-option label:hover {
    border-color: #86b7fe;
    box-shadow: 0 3px 12px rgba(0,0,0,.06);
}

.service-option input:checked + label {
    border-color: #0d6efd;
    background: #f0f6ff;
    box-shadow: 0 0 0 2px rgba(13,110,253,.08);
}


/* Service icon */

.service-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 8px;

    background: #e7f1ff;
    color: #0d6efd;

    font-weight: 700;
}

.service-option label strong {
    display: block;
    font-size: 14px;
}

.service-option label small {
    display: block;
    color: #6c757d;
    margin-top: 2px;
}


/* ================================
   CHECKBOXES
================================ */

.simple-check {
    display: flex;
    align-items: center;
    gap: 9px;

    min-height: 48px;

    padding: 10px 12px;

    border: 1px solid #e9ecef;
    border-radius: 8px;

    background: #fff;

    transition: all .2s ease;
}

.simple-check:hover {
    background: #f8f9fa;
    border-color: #ced4da;
}

.simple-check .form-check-input {
    margin: 0;
    width: 18px;
    height: 18px;

    cursor: pointer;
}

.simple-check .form-check-label {
    cursor: pointer;
    font-size: 14px;
}


/* ================================
   SWITCH
================================ */

.form-switch .form-check-input {
    width: 2.5em;
    height: 1.3em;
    cursor: pointer;
}

.form-switch .form-check-label {
    margin-left: 8px;
    cursor: pointer;
}


/* ================================
   BUTTONS
================================ */

.box-content .btn {
    border-radius: 8px;
    font-weight: 500;
}

.box-content .btn-primary {
    box-shadow: 0 3px 8px rgba(13,110,253,.18);
}


/* ================================
   RESPONSIVE
================================ */

@media (max-width: 768px) {

    .box-content {
        padding: 12px;
    }

    .box-content .card-body {
        padding: 15px;
    }

}

</style>

<style>
  .date-picker-wrapper {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    max-width: 220px;
    padding-left: 20px;
  }

  .date-label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
  }

  .input-container {
    position: relative;
  }

  .custom-date-input {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    color: #1f2937;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease-in-out;
    cursor: pointer;
  }

  .custom-date-input:hover {
    border-color: #9ca3af;
  }

  .custom-date-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const dateInput = document.getElementById("close_date");
    const today = new Date().toISOString().split("T")[0];

    // Auto-select today's date
    dateInput.value = today;

    // Block future dates
    dateInput.max = today;
  });
</script>



			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>-->
					</li>
					<li>
						<!--<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>-->
					</li>
				</ul>
			</div>
			

			<div class="row-fluid sortable">
			 
				<div class="box span12">
				    <?php //echo $this->notifications->display_html();
        			if(!empty($message)){
        			    ?>
        			    <div class='row-fluid' style='background-color:#109b10;height:40px;display:grid;' >
        			        <h4 style='color:#ffffff;'><?php echo $message; ?></h4>
        			    </div>
        			        
        			    <?php
        			}
        			?>
			
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Competition <?php echo ' Activate';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">

                        <form method="POST" class="needs-validation" novalidate>
                    
                            <!-- Page Header -->
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h3 class="mb-1 fw-bold text-dark">
                                        <i class="bi bi-credit-card me-2 text-primary"></i>
                                        Mark CIN as Paid
                                    </h3>
                                    <p class="text-muted mb-0">
                                        Update payment and service details for the CIN
                                    </p>
                                </div>
                    
                                <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                    Payment Update
                                </span>
                            </div>
                    
                    
                            <!-- ================= BASIC INFORMATION ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-primary text-white py-3">
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-person-vcard me-2"></i>
                                        Basic Information
                                    </h5>
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-4">
                    
                                        <!-- CIN -->
                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">
                                                CIN <span class="text-danger">*</span>
                                            </label>
                    
                                            <input
                                                type="text"
                                                name="cin"
                                                class="form-control"
                                                placeholder="Enter CIN"
                                                required
                                            >
                                        </div>
                    
                    
                                        <!-- Product -->
                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">
                                                Product <span class="text-danger">*</span>
                                            </label>
                    
                                            <select
                                                name="product_name"
                                                id="product_name"
                                                class="form-select"
                                                required
                                            >
                                                <option value="">Select Product</option>
                    
                                                <?php foreach($product as $val) { ?>
                    
                                                    <option
                                                        value="<?php echo $val['product_id'] ?>"
                                                        <?php
                                                        if(isset($result['product_name']))
                                                            if($result['product_name'] == $val['product_id'])
                                                            {
                                                        ?>
                                                            selected="selected"
                                                        <?php } ?>
                                                    >
                                                        <?php echo $val['product_name'] ?>
                                                    </option>
                    
                                                <?php } ?>
                    
                                            </select>
                                        </div>
                    
                    
                                        <!-- C-Level -->
                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">
                                                C-Level <span class="text-danger">*</span>
                                            </label>
                    
                                            <select
                                                name="competition_level_id"
                                                id="competition_level_id"
                                                class="form-select"
                                                required
                                            >
                                                <option value="">Select Level</option>
                    
                                                <?php foreach($level as $val) { ?>
                    
                                                    <option
                                                        value="<?php echo $val['level_id'] ?>"
                                                        <?php
                                                        if(isset($result['level_name']))
                                                            if($result['level_name'] == $val['level_id'])
                                                            {
                                                        ?>
                                                            selected="selected"
                                                        <?php } ?>
                                                    >
                                                        <?php echo $val['level_name'] ?>
                                                    </option>
                    
                                                <?php } ?>
                    
                                            </select>
                                        </div>
                    
                    
                                        <!-- Amount -->
                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">
                                                Amount
                                            </label>
                    
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                    
                                                <input
                                                    type="text"
                                                    name="product_price"
                                                    class="form-control"
                                                    placeholder="Enter amount"
                                                >
                                            </div>
                                        </div>
                    
                    
                                        <!-- Paid Date -->
                                        <div class="col-lg-3 col-md-6">
                                            <label
                                                for="close_date"
                                                class="form-label fw-semibold"
                                            >
                                                Paid Date
                                            </label>
                    
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="close_date"
                                                name="close_date"
                                                max="<?= date('Y-m-d'); ?>"
                                                value="<?= date('Y-m-d'); ?>"
                                            >
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= LUNAR INFORMATION ================= -->
                            <div id="series" class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-semibold text-dark">
                                        <i class="bi bi-moon-stars me-2 text-primary"></i>
                                        Lunar Information
                                    </h5>
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-4">
                    
                                        <!-- Subject -->
                                        <div class="col-lg-4 col-md-6">
                    
                                            <label class="form-label fw-semibold">
                                                Subject
                                            </label>
                    
                                            <select
                                                name="subject"
                                                id="subject"
                                                class="form-select"
                                            >
                                                <option value="">
                                                    -- Select Subject --
                                                </option>
                    
                                                <?php
                    
                                                $query = $this->db->query(
                                                    "SELECT * FROM lunar_subjects;"
                                                );
                    
                                                foreach ($query->result() as $row)
                                                {
                                                ?>
                    
                                                    <option
                                                        value="<?php echo $row->subject_key;?>"
                                                        <?php
                                                        if($result['subject_key']==$row->subject_key)
                                                        {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>
                                                    >
                                                        <?php echo $row->subject_key;?>
                                                    </option>
                    
                                                <?php } ?>
                    
                                            </select>
                    
                                        </div>
                    
                    
                                        <!-- Lunar Series -->
                                        <div class="col-lg-4 col-md-6">
                    
                                            <label class="form-label fw-semibold">
                                                Lunar Series
                                            </label>
                    
                                            <select
                                                name="serie"
                                                id="serie"
                                                class="form-select"
                                            >
                                                <option value="">
                                                    -- Select Series --
                                                </option>
                                            </select>
                    
                                        </div>
                    
                    
                                        <!-- Lunar Type -->
                                        <div class="col-lg-4 col-md-6">
                    
                                            <label class="form-label fw-semibold">
                                                Lunar Type
                                            </label>
                    
                                            <select
                                                name="type"
                                                id="type"
                                                class="form-select"
                                            >
                                                <option value="">
                                                    -- Select Type --
                                                </option>
                                            </select>
                    
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= REGISTRATION ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-check2-square me-2 text-primary"></i>
                                        Registration
                                    </h5>
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="form-check form-switch fs-6">
                    
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="competition"
                                            id="competition"
                                        >
                    
                                        <label
                                            class="form-check-label fw-semibold"
                                            for="competition"
                                        >
                                            Competition Registration
                                        </label>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= BUNDLES ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-box-seam me-2 text-primary"></i>
                                        Study Material + Training Bundles
                                    </h5>
                    
                                    <small class="text-muted">
                                        Select the applicable bundled services
                                    </small>
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-3">
                    
                                        <!-- A -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_a"
                                                    id="bundle_a"
                                                >
                    
                                                <label for="bundle_a">
                                                    <span class="service-icon">A</span>
                    
                                                    <span>
                                                        <strong>Study Material A</strong>
                                                        <small>+ Training A</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- B -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_b"
                                                    id="bundle_b"
                                                >
                    
                                                <label for="bundle_b">
                                                    <span class="service-icon">B</span>
                    
                                                    <span>
                                                        <strong>Study Material B</strong>
                                                        <small>+ Training B</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- C -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_c"
                                                    id="bundle_c"
                                                >
                    
                                                <label for="bundle_c">
                                                    <span class="service-icon">C</span>
                    
                                                    <span>
                                                        <strong>Study Material C</strong>
                                                        <small>+ Training C</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- D -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_d"
                                                    id="bundle_d"
                                                >
                    
                                                <label for="bundle_d">
                                                    <span class="service-icon">D</span>
                    
                                                    <span>
                                                        <strong>Study Material D</strong>
                                                        <small>+ Training D</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- E -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_e"
                                                    id="bundle_e"
                                                >
                    
                                                <label for="bundle_e">
                                                    <span class="service-icon">E</span>
                    
                                                    <span>
                                                        <strong>Study Material E</strong>
                                                        <small>+ Training E</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- F -->
                                        <div class="col-xl-4 col-md-6">
                                            <div class="service-option">
                                                <input
                                                    type="checkbox"
                                                    name="bundle_f"
                                                    id="bundle_f"
                                                >
                    
                                                <label for="bundle_f">
                                                    <span class="service-icon">F</span>
                    
                                                    <span>
                                                        <strong>Study Material F</strong>
                                                        <small>+ Training F</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= STUDY MATERIAL ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                    
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-book me-2 text-primary"></i>
                                        Study Material Paid
                                    </h5>
                    
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-3">
                    
                                        <?php
                                        $materials = [
                                            'a' => 'Study Material-A Paid',
                                            'b' => 'Study Material-B Paid',
                                            'c' => 'Study Material-C Paid',
                                            'd' => 'Study Material-D Paid',
                                            'e' => 'Study Material-E Paid',
                                            'f' => 'Study Material-F Paid'
                                        ];
                    
                                        foreach($materials as $key => $label)
                                        {
                                        ?>
                    
                                            <div class="col-xl-2 col-lg-4 col-md-6">
                    
                                                <div class="simple-check">
                    
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        name="study_material_<?php echo $key; ?>"
                                                        id="study_material_<?php echo $key; ?>"
                                                    >
                    
                                                    <label
                                                        class="form-check-label"
                                                        for="study_material_<?php echo $key; ?>"
                                                    >
                                                        <?php echo $label; ?>
                                                    </label>
                    
                                                </div>
                    
                                            </div>
                    
                                        <?php } ?>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= ORIENTATION ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                    
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-easel me-2 text-primary"></i>
                                        Orientation
                                    </h5>
                    
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-3">
                    
                                        <?php
                                        foreach(['a','b','c','d','e','f'] as $key)
                                        {
                                        ?>
                    
                                            <div class="col-xl-2 col-lg-4 col-md-6">
                    
                                                <div class="simple-check">
                    
                                                    <input
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        name="orientation_<?php echo $key; ?>"
                                                        id="orientation_<?php echo $key; ?>"
                                                    >
                    
                                                    <label
                                                        class="form-check-label"
                                                        for="orientation_<?php echo $key; ?>"
                                                    >
                                                        Orientation <?php echo strtoupper($key); ?>
                                                    </label>
                    
                                                </div>
                    
                                            </div>
                    
                                        <?php } ?>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= MOCK TEST ================= -->
                            <div class="card border-0 shadow-sm mb-4">
                    
                                <div class="card-header bg-light py-3">
                    
                                    <h5 class="mb-0 fw-semibold">
                                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                                        Mock Tests
                                    </h5>
                    
                                </div>
                    
                                <div class="card-body">
                    
                                    <div class="row g-3">
                    
                                        <!-- A -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test"
                                                    id="mock_test"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test"
                                                >
                                                    Mock Test A
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- B -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test_b"
                                                    id="mock_test_b"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test_b"
                                                >
                                                    Mock Test B
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- C -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test_c"
                                                    id="mock_test_c"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test_c"
                                                >
                                                    Mock Test C
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- D -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test_d"
                                                    id="mock_test_d"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test_d"
                                                >
                                                    Mock Test D
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- E -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test_e"
                                                    id="mock_test_e"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test_e"
                                                >
                                                    Mock Test E
                                                </label>
                                            </div>
                                        </div>
                    
                    
                                        <!-- F -->
                                        <div class="col-xl-2 col-lg-4 col-md-6">
                                            <div class="simple-check">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="mock_test_f"
                                                    id="mock_test_f"
                                                >
                    
                                                <label
                                                    class="form-check-label"
                                                    for="mock_test_f"
                                                >
                                                    Mock Test F
                                                </label>
                                            </div>
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                    
                    
                            <!-- ================= ACTION BUTTONS ================= -->
                            <div class="card border-0 shadow-sm">
                    
                                <div class="card-body d-flex justify-content-end gap-2">
                    
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary px-4"
                                        onclick="history.back()"
                                    >
                                        <i class="bi bi-x-lg me-1"></i>
                                        Cancel
                                    </button>
                    
                                    <button
                                        type="submit"
                                        class="btn btn-primary px-4"
                                        id="submit"
                                        name="submit"
                                    >
                                        <i class="bi bi-check-circle me-1"></i>
                                        Submit
                                    </button>
                    
                                </div>
                    
                            </div>
                    
                        </form>
                    
                    </div>


					
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>

<!--<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">

$(document).ready(function(){
  // Hide initially
    $("#series").hide();

    // On dropdown change
    $("#product_name").on("change", function () {
        var product = $(this).val();

        if (product == '8') {
            $("#series").show();
        } else {
            $("#series").hide();
        }
    });

   

    $("#state_id").change(function(){
        var state_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getStateFranchiseaccount/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
                 $("#franchise_id").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/product_wiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
		$("#franchise_id").change(function(){
        var franchise_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
                 $("#area_id").html(result);
        }});
    }); 
    
    $("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/class_category/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#category_id_").html(result);
        }});
    }); 
    
    
    $("#subject").change(function(){
        var subject_key =this.value;
         //alert(franchise_id);
         var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/getlunar_series_per_subject",
        data:{subject_key:subject_key},
        type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#serie").html(result);
            	 
            
            }});
        });
    
    $("#serie").change(function(){
        var serie = this.value;
         //alert(franchise_id);
         var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/getlunar_type_per_serie",
        data:{serie:serie},
        type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#type").html(result);
            	 
            
            }});
        });
});
    
        
 </script>
 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#period_id").change(function(){
            var period_id = jQuery(this).val();
            if (period_id >= 9) {
                jQuery("#cash").show();
                jQuery("#cash1").show();
            } else {
                jQuery("#cash").hide();
                jQuery("#cash1").hide();
            }
        });
            jQuery("#choice").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    
                       
                    jQuery("#com_per").show();
                           
                }       
                if (cash_id == 'no') {
                    jQuery("#com_per").hide();
                    
                    
            }
                if (cash_id == '') {
                 jQuery("#com_per").hide();
                }
            });
               
            jQuery("#choiceavian").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    jQuery("#com_peravian").show();
                        
                } 
                if (cash_id == 'no') {
                    jQuery("#aviansysper").hide();
                    jQuery("#com_peravian").hide();
                }
                if (cash_id == '') {
                    jQuery("#com_peravian").hide();
                    
                }
            });
            
            
            jQuery("#peravian").hide();
            jQuery("#cashavian").hide();    
            jQuery("#cash").hide();    
            jQuery("#com_per").hide();
            jQuery("#com_peravian").hide();
            jQuery("#cash1").hide();
            jQuery("#aviansysperavian").hide();    
    });
</script>            
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>