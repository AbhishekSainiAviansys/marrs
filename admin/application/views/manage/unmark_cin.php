<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>
<style>

/* ============================
   MAIN CONTAINER
============================ */

.box-content {
    background: #f8f9fa;
    padding: 24px;
}


/* ============================
   CARDS
============================ */

.box-content .card {
    border-radius: 12px;
    overflow: hidden;
}

.box-content .card-header {
    border-bottom: 1px solid #e9ecef;
}


/* ============================
   FORM
============================ */

.box-content .form-label {
    color: #343a40;
    margin-bottom: 7px;
}

.box-content .form-control,
.box-content .form-select {
    min-height: 43px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: .2s ease;
}

.box-content .form-control:focus,
.box-content .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
}


/* ============================
   SERVICE SECTION
============================ */

.service-section {
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.service-section:last-of-type {
    border-bottom: 0;
}

.section-title {
    font-size: 15px;
    font-weight: 700;
    color: #343a40;
    margin-bottom: 15px;
}


/* ============================
   PAYMENT OPTION
============================ */

.payment-option {
    display: flex;
    align-items: center;

    width: 100%;
    min-height: 70px;

    padding: 12px 15px;

    border: 1px solid #dee2e6;
    border-radius: 10px;

    background: #fff;

    cursor: pointer;

    transition: all .2s ease;
}

.payment-option:hover {
    border-color: #86b7fe;
    background: #f8fbff;
    transform: translateY(-1px);
    box-shadow: 0 3px 10px rgba(0,0,0,.05);
}

.payment-option:has(input[type="checkbox"]:checked) {
    border-color: #0d6efd;
    background: #f0f6ff;
    box-shadow: 0 0 0 2px rgba(13,110,253,.08);
}


/* ============================
   CHECKBOX
============================ */

.payment-option > input[type="checkbox"] {
    width: 19px;
    height: 19px;
    margin-right: 13px;
    flex-shrink: 0;
    cursor: pointer;
}


/* ============================
   PAYMENT CONTENT
============================ */

.payment-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.payment-content strong {
    display: block;
    font-size: 14px;
    color: #212529;
}

.payment-content small {
    display: block;
    color: #6c757d;
    margin-top: 2px;
}


/* ============================
   ICON / LETTER
============================ */

.payment-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #e7f1ff;
    color: #0d6efd;

    font-size: 14px;
    font-weight: 700;

    flex-shrink: 0;
}

.payment-option:has(input[type="checkbox"]:checked) .payment-icon {
    background: #0d6efd;
    color: #fff;
}


/* ============================
   COMPACT OPTIONS
============================ */

.payment-option.compact {
    min-height: 60px;
    padding: 9px 12px;
}

.payment-option.compact .payment-icon {
    width: 32px;
    height: 32px;
}


/* ============================
   UPDATE FOOTER
============================ */

.update-footer {
    margin-top: 25px;
    padding-top: 20px;

    border-top: 1px solid #e9ecef;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.update-footer .btn {
    min-width: 130px;
    border-radius: 8px;
    font-weight: 600;
}


/* ============================
   BADGE
============================ */

.bg-success-subtle {
    background-color: #d1e7dd !important;
}


/* ============================
   RESPONSIVE
============================ */

@media (max-width: 768px) {

    .box-content {
        padding: 12px;
    }

    .box-content .card-body {
        padding: 15px;
    }

    .update-footer {
        flex-direction: column;
        align-items: stretch;
    }

    .update-footer .btn {
        width: 100%;
    }

}

</style>


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
			    <div class='row-fluid p-2 text-sm rounded shadow' style='background-color:#109b10;' >
			        <h5 style='color:#ffffff;'><?php echo $message; ?></h5>
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

    <!-- ================= SEARCH SECTION ================= -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-1 fw-semibold">
                        <i class="bi bi-credit-card me-2"></i>
                        Mark CIN as Paid
                    </h5>

                    <small class="opacity-75">
                        Search CIN and update payment status
                    </small>
                </div>
            </div>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row g-4 align-items-end">

                    <!-- CIN -->
                    <div class="col-lg-3 col-md-6">

                        <label class="form-label fw-semibold">
                            CIN
                        </label>

                        <input
                            type="text"
                            name="cin"
                            class="form-control"
                            placeholder="Enter CIN"
                            <?php if($result['cin']){ ?>
                                value="<?php echo $result['cin']; ?>"
                            <?php } ?>
                            required
                        >

                    </div>


                    <!-- Product -->
                    <div class="col-lg-3 col-md-6">

                        <label class="form-label fw-semibold">
                            Product
                        </label>

                        <select
                            name="product_name"
                            id="product_name"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Product
                            </option>

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
                            C-Level
                        </label>

                        <select
                            name="competition_level_id"
                            id="competition_level_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Level
                            </option>

                            <?php foreach($level as $val) { ?>

                                <option
                                    value="<?php echo $val['level_id'] ?>"
                                    <?php
                                    if(isset($result['competition_level_id']))
                                        if($result['competition_level_id'] == $val['level_id'])
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


                    <!-- Search -->
                    <div class="col-lg-3 col-md-6">

                        <button
                            type="submit"
                            class="btn btn-warning btn-lg w-100"
                            id="submit"
                            name="submit"
                        >
                            <i class="bi bi-search me-1"></i>
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>


    <?php if (!empty($arr)) { ?>

    <?php

        $competition='';
        $study_material_a='';
        $study_material_b='';
        $study_material_c='';
        $orientation_a='';
        $orientation_b='';
        $orientation_c='';
        $mock_test='';

        foreach($arr as $row)
        {
            if($row['status'] == 'Paid')
            {
                $competition='Paid';
            }

            if($row['study_material_a']=='yes')
            {
                $study_material_a='yes';
            }

            if($row['study_material_b']=='yes')
            {
                $study_material_b='yes';
            }

            if($row['study_material_c']=='yes')
            {
                $study_material_c='yes';
            }

            if($row['orientation_a']=='yes')
            {
                $orientation_a='yes';
            }

            if($row['orientation_b']=='yes')
            {
                $orientation_b='yes';
            }

            if($row['orientation_c']=='yes')
            {
                $orientation_c='yes';
            }

            if($row['mock_test']=='yes')
            {
                $mock_test='yes';
            }
        }

    ?>


    <!-- ================= PAYMENT UPDATE ================= -->
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-light py-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>

                    <h5 class="mb-1 fw-semibold">
                        <i class="bi bi-check2-circle text-primary me-2"></i>
                        Payment & Service Status
                    </h5>

                    <small class="text-muted">
                        Select the services that have been paid
                    </small>

                </div>

                <span class="badge bg-success-subtle text-success px-3 py-2">
                    CIN: <?php echo $row['cin']; ?>
                </span>

            </div>

        </div>


        <div class="card-body">

            <form method="POST">


                <!-- ================= COMPETITION ================= -->
                <div class="service-section">

                    <div class="section-title">
                        <i class="bi bi-trophy me-2"></i>
                        Competition
                    </div>

                    <div class="row g-3">

                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="status"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="status"
                                    value="Paid"
                                    <?php echo ($competition == 'Paid') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        <i class="bi bi-trophy"></i>
                                    </span>

                                    <span>
                                        <strong>Competition</strong>
                                        <small>
                                            Competition registration
                                        </small>
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                <!-- ================= STUDY MATERIAL ================= -->
                <div class="service-section">

                    <div class="section-title">
                        <i class="bi bi-book me-2"></i>
                        Study Material
                    </div>


                    <div class="row g-3">

                        <!-- A -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material"
                                    value="yes"
                                    <?php echo ($study_material_a == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        A
                                    </span>

                                    <span>
                                        <strong>Study Material-A</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- B -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_b"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_b"
                                    value="yes"
                                    <?php echo ($study_material_b == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        B
                                    </span>

                                    <span>
                                        <strong>Study Material-B</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- C -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_c"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_c"
                                    value="yes"
                                    <?php echo ($study_material_c == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        C
                                    </span>

                                    <span>
                                        <strong>Study Material-C</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- D -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_c"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_c"
                                    value="yes"
                                    <?php echo ($study_material_d == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        D
                                    </span>

                                    <span>
                                        <strong>Study Material-D</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- E -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_e"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_e"
                                    value="yes"
                                    <?php echo ($study_material_e == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        E
                                    </span>

                                    <span>
                                        <strong>Study Material-E</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- E duplicate - kept exactly as your existing logic -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_e"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_e"
                                    value="yes"
                                    <?php echo ($study_material_e == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        E
                                    </span>

                                    <span>
                                        <strong>Study Material-E</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>


                        <!-- F -->
                        <div class="col-xl-4 col-lg-6">

                            <label class="payment-option">

                                <input
                                    type="hidden"
                                    name="study_material_f"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="study_material_f"
                                    value="yes"
                                    <?php echo ($study_material_f == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        F
                                    </span>

                                    <span>
                                        <strong>Study Material-F</strong>
                                        <small>Paid</small>
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                <!-- ================= ORIENTATION ================= -->
                <div class="service-section">

                    <div class="section-title">
                        <i class="bi bi-easel me-2"></i>
                        Orientation
                    </div>


                    <div class="row g-3">

                        <!-- A -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation"
                                    value="yes"
                                    <?php echo ($orientation_a == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        A
                                    </span>

                                    <strong>Orientation A</strong>

                                </span>

                            </label>

                        </div>


                        <!-- B -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation_b"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation_b"
                                    value="yes"
                                    <?php echo ($orientation_b == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        B
                                    </span>

                                    <strong>Orientation B</strong>

                                </span>

                            </label>

                        </div>


                        <!-- C -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation_c"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation_c"
                                    value="yes"
                                    <?php echo ($orientation_c == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        C
                                    </span>

                                    <strong>Orientation C</strong>

                                </span>

                            </label>

                        </div>


                        <!-- D -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation_d"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation_d"
                                    value="yes"
                                    <?php echo ($orientation_d == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        D
                                    </span>

                                    <strong>Orientation D</strong>

                                </span>

                            </label>

                        </div>


                        <!-- E -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation_e"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation_e"
                                    value="yes"
                                    <?php echo ($orientation_e == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        E
                                    </span>

                                    <strong>Orientation E</strong>

                                </span>

                            </label>

                        </div>


                        <!-- F -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="orientation_f"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="orientation_f"
                                    value="yes"
                                    <?php echo ($orientation_f == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        F
                                    </span>

                                    <strong>Orientation F</strong>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                <!-- ================= MOCK TEST ================= -->
                <div class="service-section">

                    <div class="section-title">
                        <i class="bi bi-pencil-square me-2"></i>
                        Mock Tests
                    </div>


                    <div class="row g-3">

                        <!-- A -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test"
                                    value="yes"
                                    <?php echo ($mock_test == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        A
                                    </span>

                                    <strong>Mock Test A</strong>

                                </span>

                            </label>

                        </div>


                        <!-- B -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test_b"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test_b"
                                    value="yes"
                                    <?php echo ($mock_test_b == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        B
                                    </span>

                                    <strong>Mock Test B</strong>

                                </span>

                            </label>

                        </div>


                        <!-- C -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test_c"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test_c"
                                    value="yes"
                                    <?php echo ($mock_test_c == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        C
                                    </span>

                                    <strong>Mock Test C</strong>

                                </span>

                            </label>

                        </div>


                        <!-- D -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test_d"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test_d"
                                    value="yes"
                                    <?php echo ($mock_test_d == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        D
                                    </span>

                                    <strong>Mock Test D</strong>

                                </span>

                            </label>

                        </div>


                        <!-- E -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test_e"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test_e"
                                    value="yes"
                                    <?php echo ($mock_test_e == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        E
                                    </span>

                                    <strong>Mock Test E</strong>

                                </span>

                            </label>

                        </div>


                        <!-- F -->
                        <div class="col-xl-2 col-lg-4 col-md-6">

                            <label class="payment-option compact">

                                <input
                                    type="hidden"
                                    name="mock_test_f"
                                    value=""
                                >

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="mock_test_f"
                                    value="yes"
                                    <?php echo ($mock_test_f == 'yes') ? 'checked' : ''; ?>
                                >

                                <span class="payment-content">

                                    <span class="payment-icon">
                                        F
                                    </span>

                                    <strong>Mock Test F</strong>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                <!-- ================= HIDDEN IDENTIFICATION ================= -->

                <input
                    type="hidden"
                    name="product_name"
                    value="<?php echo $row['product_name']; ?>"
                >

                <input
                    type="hidden"
                    name="cin"
                    value="<?php echo $row['cin']; ?>"
                >

                <input
                    type="hidden"
                    name="competition_level_id"
                    value="<?php echo $row['clevel']; ?>"
                >


                <!-- ================= UPDATE ================= -->

                <div class="update-footer">

                    <div>
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Review the selected services before updating.
                        </small>
                    </div>

                    <button
                        type="submit"
                        name="update"
                        class="btn btn-primary px-4"
                    >
                        <i class="bi bi-check-circle me-1"></i>
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>

    <?php } ?>

</div>


		</div><!--/span-->
	
	</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
<script type="text/javascript">
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
		//alert(state_id);
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