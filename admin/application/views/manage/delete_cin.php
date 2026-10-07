<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 

			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="#">Delete CIN</a> <span class="divider">/</span>
					</li>
					<li>
							<!--<a href="<?php echo SITE_URL?>content/">List</a>-->
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">

    <div class="box span12">

        <!-- ================= HEADER ================= -->

        <div class="box-header well" data-original-title>

            <h2>
                <i class="icon-user"></i>
                Delete CIN
            </h2>

            <div class="box-icon">

                <a href="#" class="btn btn-minimize btn-round">
                    <i class="icon-chevron-up"></i>
                </a>

                <a href="#" class="btn btn-close btn-round">
                    <i class="icon-remove"></i>
                </a>

            </div>

        </div>


        <!-- ================= CONTENT ================= -->

        <div class="box-content">

            <!-- ================= SEARCH FORM ================= -->

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    <div class="row align-items-end g-3">

                        <div class="col-12 col-md-8 col-lg-6">

                            <label
                                for="cin"
                                class="form-label fw-semibold"
                            >
                                Enter CIN
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">
                                    <i class="icon-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="cin"
                                    id="cin"
                                    class="form-control"
                                    <?php if(isset($result)){ ?>
                                        placeholder="<?php echo $result['cin']; ?>"
                                    <?php }else{ ?>
                                        placeholder="Enter CIN"
                                    <?php } ?>
                                >

                            </div>

                        </div>


                        <div class="col-12 col-md-4 col-lg-2">

                            <button
                                type="submit"
                                name="submit"
                                class="btn btn-primary w-100"
                            >
                                <i class="icon-search icon-white"></i>
                                Search
                            </button>

                        </div>

                    </div>

                </div>

            </div>


            <!-- ================= RESULT ================= -->

            <div class="box-content p-0">


                <?php if(empty($student)){ ?>

                    <!-- ================= NO RESULT ================= -->

                    <div
                        class="alert alert-warning d-flex align-items-center shadow-sm"
                        role="alert"
                    >

                        <i
                            class="icon-info-sign me-2"
                            style="font-size:20px;"
                        ></i>

                        <div>

                            <strong>Information!</strong>

                            No CIN found with

                            <strong>
                                <?php
                                if(isset($result)){
                                    echo $result['cin'];
                                }
                                ?>
                            </strong>.

                        </div>

                    </div>


                <?php } else { ?>


                    <!-- ================= RESULT HEADER ================= -->

                    <div
                        class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2"
                    >

                        <div>

                            <h4 class="mb-1">
                                <i class="icon-list"></i>
                                CIN Records
                            </h4>

                            <small class="text-muted">
                                Records matching the searched CIN
                            </small>

                        </div>

                        <span class="badge bg-primary px-3 py-2">

                            <?php echo count($student); ?>

                            Record<?php echo count($student) != 1 ? 's' : ''; ?>

                        </span>

                    </div>


                    <!-- ================= TABLE ================= -->

                    <div class="card border-0 shadow-sm">

                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table
                                    class="table table-bordered table-hover align-middle mb-0"
                                    style="min-width:1000px;"
                                >

                                    <thead class="table-light">

                                        <tr>

                                            <th
                                                class="text-center"
                                                style="width:70px;"
                                            >
                                                Sr. No
                                            </th>

                                            <th>
                                                Student Name
                                            </th>

                                            <th>
                                                CIN
                                            </th>

                                            <th>
                                                School Name
                                            </th>

                                            <th>
                                                Class
                                            </th>

                                            <th>
                                                Email
                                            </th>

                                            <th>
                                                Mobile
                                            </th>

                                            <th
                                                class="text-center"
                                                style="width:120px;"
                                            >
                                                Action
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        <form method="POST">

                                        <?php

                                        $i=1;

                                        foreach ($student as $value) {

                                        ?>

                                            <tr>

                                                <!-- Sr No -->

                                                <td class="text-center fw-semibold">

                                                    <?php
                                                    echo $i;
                                                    ?>

                                                </td>


                                                <!-- Student Name -->

                                                <td>

                                                    <span class="fw-semibold">

                                                        <?php
                                                        echo $value->student_name;
                                                        ?>

                                                    </span>

                                                </td>


                                                <!-- CIN -->

                                                <td>

                                                    <span
                                                        class="badge bg-light text-dark border"
                                                    >

                                                        <?php
                                                        echo $value->cin;
                                                        ?>

                                                    </span>

                                                </td>


                                                <!-- School -->

                                                <td>

                                                    <?php

                                                    if(!empty($value->school_name)){

                                                        echo $value->school_name;

                                                    }else{

                                                        $school =
                                                            $this->db
                                                            ->get_where(
                                                                'school_new',
                                                                array(
                                                                    'id'=>$value->school_id
                                                                )
                                                            )
                                                            ->row();

                                                        echo $school->school_name;

                                                    }

                                                    ?>

                                                </td>


                                                <!-- Class -->

                                                <td>

                                                    <?php
                                                    echo $value->class;
                                                    ?>

                                                </td>


                                                <!-- Email -->

                                                <td>

                                                    <?php
                                                    echo $value->stud_email;
                                                    ?>

                                                </td>


                                                <!-- Mobile -->

                                                <td>

                                                    <?php
                                                    echo $value->stud_phone;
                                                    ?>

                                                </td>


                                                <!-- Action -->

                                                <td class="text-center">

                                                    <button
                                                        type="submit"
                                                        name="delete"
                                                        class="btn btn-danger btn-sm"
                                                        value="<?php echo $value->id; ?>"
                                                        onclick="return confirm('Are you sure you want to delete this CIN?');"
                                                    >

                                                        <i class="icon-trash icon-white"></i>
                                                        Delete

                                                    </button>

                                                </td>

                                            </tr>

                                        <?php

                                            $i++;

                                        }

                                        ?>

                                        </form>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>


                <?php } ?>

            </div>

        </div>

    </div>

</div>
			
			
		
<?php include('footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentTable').DataTable({
                "pageLength": 10
            });
        });
    </script>
    
    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">-->
    <script>
        function copyToClipboard(element) {
            // Create a temporary input element
            let tempInput = document.createElement("input");
            tempInput.value = element.getAttribute("data-copy");
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Change button text to indicate copying
            element.innerText = "Copied!";
            setTimeout(() => { element.innerText = "Copy"; }, 1500);
        }
    </script>
    
<?php 
	$this->confirmation->confirm('delete');
?>