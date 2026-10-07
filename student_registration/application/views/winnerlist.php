<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winner's List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--<link rel="stylesheet" href="styles.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<style>
body{
    /*background-color:#ffe6e6;*/
    background-color:#e6f0ff;
    /*background-image:url('https://marrs.in/images/marrszoomzoom (1).png');*/
  background: linear-gradient(90deg, #00C9FF 0%, #d6deef 100%);
}
    .hero-section {
  /*background-image: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDF8fG1hdGh8ZW58MHx8fHwxNjI1NzgzOTM2&ixlib=rb-1.2.1&q=80&w=1080');*/
  
  /*background-image:url('https://marrs.in/images/marrszoomzoom (1).png');*/
  /*background-size: cover;*/
  background-position: center;
  /*margin-top:20%;*/
  height: 80vh;
}
.lead {
    /*margin:20px;*/
    font-size: 1.25rem;
    font-weight: 500;
}
.hero-section .container {
  /*background: rgba(0, 0, 0, 0.6);*/
  padding: 2rem;
  border-radius: 10px;
}

.list-group-item {
  background-color: transparent;
  border: none;
}

footer {
  background-color: #012548;
  height:100%;
  color:#ffffff;
  
}

h1, h2, p {
  font-family: 'Arial', sans-serif;
}

.btn-lg {
  font-size: 1.25rem;
  padding: 0.75rem 1.5rem;
}

.navbar-brand img {
  margin-right: 10px;
}

.text-center {
  margin-bottom: 20px;
}

.logo-image{
    height:400px;
    width:100%;
}
@-webkit-keyframes blinker {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

.blink {
  /*width: 30px;*/
  /*height: 30px;*/
  border-radius: 10px;
  animation: blinker 2s linear infinite;
  background-color: red;
  /*margin: 15px;*/
  color:#ffffff;
}

.content {
  display: flex;
  flex-direction: row;
  align-items: center;
}
</style>


<body>
  
  <img src="https://marrs.in/images/header-011.jpg" alt="MaRRS Zoom Zoom" style="width:100%" height="100">
  
  <?php //print_R($result);?>
  
<section class="container my-5">
    <form method="post" enctype="multipart/form-data" id="dynamic-form">
        <!-- First Row -->
        <div class="row">
            <h2 class="text-center mb-4">Winners List</h2>
            <!-- Period Selection -->
            <div class="col-md-3 mb-3">
                <label for="period">Period:</label>
                <select name="period" id="period" class="form-control" required>
                    <option>-- select period --</option>
                    <?php
                        // Assuming $result['period'] stores the previously selected period.
                        $selected_period_id = isset($result['period']) ? $result['period'] : '';
                        foreach ($periodload as $row) {
                            $selected = ($row->period_id == $selected_period_id) ? 'selected' : '';
                            echo "<option value='{$row->period_id}' $selected>{$row->period_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Product Selection -->
            <div class="col-md-3 mb-3">
                <label for="product">Product:</label>
                <select name="product" id="product" class="form-control" required>
                    <option>-- select product --</option>
                    <?php
                        // Assuming $result['product'] stores the previously selected product.
                        $selected_product = isset($result['product']) ? $result['product'] : '';
                        foreach ($products as $row) {
                            $selected = ($row->product_name == $selected_product) ? 'selected' : '';
                            echo "<option value='{$row->product_name}' $selected>{$row->product_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Level Selection -->
            <div class="col-md-3 mb-3">
                <label for="level">LEVEL:</label>
                <select name="level" id="level" class="form-control" required>
                    <option>-- select level --</option>
                    <?php
                        // Assuming $result['level'] stores the previously selected level.
                        $selected_level = isset($result['level']) ? $result['level'] : '';
                        foreach ($levels as $row) {
                            $selected = ($row->level_id == $selected_level) ? 'selected' : '';
                            echo "<option value='{$row->level_id}' data-level-name='{$row->level_name}' $selected>{$row->level_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Country Selection (Preset to India) -->
            <div class="col-md-3 mb-3 country-section d-none">
                <label for="country">Country:</label>
                <select name="country" id="country" class="form-control">
                    <option value='105' <?php echo (isset($result['country']) && $result['country'] == '105') ? 'selected' : ''; ?>>India</option>
                </select>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row">
            <!-- State Selection -->
            <div class="col-md-3 mb-3 state-section d-none">
                <label for="state_id">State:</label>
                <select name="state_id" id="state_id" class="form-control">
                    <option>-- select state --</option>
                    <?php
                        $selected_state_id = isset($result['state_id']) ? $result['state_id'] : '';
                        foreach ($stateload as $row) {
                            $selected = ($row->state_subdivision_id == $selected_state_id) ? 'selected' : '';
                            echo "<option value='{$row->state_subdivision_id}' $selected>{$row->state_subdivision_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Area Selection -->
            <div class="col-md-3 mb-3 area-section d-none">
                <label for="area">Area Code:</label>
                <select name="area" id="area" class="form-control">
                    <option>-- select area --</option>
                    <?php
                        $selected_area = isset($result['area']) ? $result['area'] : '';
                        foreach ($areas as $row) {
                            $selected = ($row->area_code == $selected_area) ? 'selected' : '';
                            echo "<option value='{$row->area_code}' $selected>{$row->area_code} - {$row->area_code}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- School Selection -->
            <div class="col-md-3 mb-3 school-section d-none">
                <label for="school">School:</label>
                <select name="school" id="school" class="form-control">
                    <option>-- select school --</option>
                    <?php
                        $selected_school = isset($result['school']) ? $result['school'] : '';
                        foreach ($schools as $row) {
                            $selected = ($row->school_name == $selected_school) ? 'selected' : '';
                            echo "<option value='{$row->school_name}' $selected>{$row->school_name}</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-3 mb-3 d-flex align-items-end">
                <button type="submit" name="submit" class="btn btn-primary w-100">
                    Submit
                </button>
            </div>
        </div>
    </form>
</section>


  <section class="container my-5">
    <div class="row">
      <div class="col-md-12">
        
        <style>
    div#example_filter {
    float: right;
    position: relative;
    right: 0px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
    
</style>
  
  

        
        <div class='responsive'>
            <!--<h2 class="text-center mb-4">Grades and Categories</h2>-->
            <?php if(!empty($students)){?>
           <table  id="dataTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>School</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Product Name</th>
                    <th>Level</th>
                    <th>Rank</th>
                    <th>Marks</th>
                    
                    <!--<th>VII</th>-->
                    <!--<th>VIII</th>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $row){ ?>
                <tr>
                    <th><?php echo $row->student_name; ?></th>
                    <td><?php echo $row->class; ?></td>
                    <td><?php echo $row->school_name; ?></td>
                    <td><?php echo $row->father_name; ?></td>
                    <td><?php echo $row->mother_name; ?></td>
                    <td><?php echo $row->product_name; ?></td>
                    <td><?php echo $row->level_name; ?></td>
                    <td><?php echo $row->rank; ?></td>
                    <td><?php echo $row->marks; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            <?php }elseif(isset($students) && empty($students)){ ?>
            <h5 style="height:200px">No Winner Found.</h5>
            <?php } ?>
             <h5 style="height:200px"></h5>
        </div>
        
       
      </div>
    </div>
  </section>
           
       
   
  <footer class="footer text-whote font-weight-bolder">
    <div class="container">
        
      <p class="mb-0 p-3">© Aviansys Technologies Pvt. Ltd.
      <?php
        $currentYear = date("Y");
        $nextYear = $currentYear + 1;
        $yearRange = $currentYear . '-' . substr($nextYear, -2);
        echo $yearRange;
      ?>
      </p>
    </div>
  </footer>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable(); // Initialize the DataTable
        });
    </script>
  
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>

<script>
$(document).ready(function () {
    // Initialize Select2
        $("#school").select2();

        // When the submit button is clicked
        $('#Btnsubmit').click(function (e) {
            e.preventDefault(); // Prevent the default form submission
    
            // Show the loader
            $('#loader').show();
            setTimeout(function () {
                $('#loader').hide(); // Hide loader after 60 seconds
            }, 60000);
    
            // Fetch selected state ID
            var state_id = $('#state_id').val();
    
            // AJAX request to get franchise list based on state_id
            $.ajax({
                url: "<?php echo base_url();?>manage/ajax/franchiseList",
                data: { state_id: state_id },
                type: 'post',
                success: function (result) {
                    // Update franchise dropdown with the result
                    $("#area").html(result);
                },
                error: function (xhr, status, error) {
                    console.error('Error in AJAX request:', error);
                }
            });
        });


    // Handle area code change event
    $("#area").change(function () {
        var area_code = this.value;
        
        // Get the selected period ID value
        var period_id = $("#period").val();  // Assuming the period dropdown has the id 'period'
    
        // Determine the appropriate URL based on the period_id
        var ajaxUrl = (period_id <= 12) ? 
            "https://marrs.in/franchiselogin/manage/ajax/school_list_" : 
            "https://marrs.in/franchiselogin/manage/ajax/school_list" ;
    
        // Perform AJAX request
        $.ajax({
            url: ajaxUrl,
            data: { area_code: area_code },
            type: 'post',
            success: function (result) {
                // Update school dropdown with the result
                $("#school").html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error in AJAX request:', error);
            }
        });
    });

    // Handle state change event
    $("#state_id").change(function () {
        var state_id = this.value;

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getAreaAjax_",
            data: { state_id: state_id },
            type: 'post',
            success: function (result) {
                $("#area").html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error in AJAX request:', error);
            }
        });
    });

    // Handle franchise ID change event
    $("#franchise_id").change(function () {
        var franchise_id = this.value;

        // Update school list based on franchise ID
        $.ajax({
            url: "<?php echo base_url();?>manage/ajax/school_listassign",
            data: { franchise_id: franchise_id },
            type: 'post',
            success: function (result) {
                $("#school").html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error in AJAX request:', error);
            }
        });

        // Update area code based on franchise ID
        $.ajax({
            url: "<?php echo base_url();?>manage/ajax/AreaCode",
            data: { franchise_id: franchise_id },
            type: 'post',
            success: function (result) {
                $("#area").html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error in AJAX request:', error);
            }
        });
    });

    // Handle product change event
    $("#product").change(function () {
        var product_id = this.value;

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/productwiselevelwithName",
            data: { product_id: product_id },
            type: 'post',
            success: function (result) {
                $("#level").html(result);
            },
            error: function (xhr, status, error) {
                console.error('Error in AJAX request:', error);
            }
        });
    });
});


$(document).ready(function() {
    // Initially hide all sections except Period, Product, and Level
    $(".country-section, .state-section, .area-section, .school-section").addClass('d-none');

    // Listen to changes in the Level dropdown
    $("#level").change(function() {
        // Get the selected value (level_id)
        var selectedLevelId = $(this).val();

        // Remove d-none to show sections based on the selected level
        if (selectedLevelId === "1") {
            // Show all sections
            $(".country-section, .state-section, .area-section, .school-section").removeClass('d-none');
        } else if (selectedLevelId === "12") {
            // Hide all sections
            $(".country-section, .state-section, .area-section, .school-section").addClass('d-none');
        } else if (["10", "8", "7", "2", "5", "3"].includes(selectedLevelId)) {
            // Show only country and state sections
            $(".country-section, .state-section").removeClass('d-none');
            $(".area-section, .school-section").addClass('d-none');
        } else {
            // Default behavior: hide all sections
            $(".country-section, .state-section, .area-section, .school-section").addClass('d-none');
        }
    });
});



</script>