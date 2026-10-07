<?php 

$state_id=$activate[0];
//print_r($material_free);
//print_r($material_paid);
// print_r($result);
//  echo 'ok';

//   echo $combo1.'ko';
//   echo $combo2.'pkk';
//   echo $combo3.'jj';
//   echo $combo4.'hi';
   
   $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$result['medal_no']+1,'product_name' =>$result['product_name']))->row();
		$nlev=$res->level_name;$level_id=$res->level_id;
//print_r($res);

?>

<style>
.page-container{
    min-height:100vh;
    display:flex;
    flex-direction:column;
    /*background:#f5f7fb;*/
}

.page-content{
    flex:1;
    padding:20px;
}

/* Card */
.form-card{
    background:#fff;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* Heading */
h4{
    font-weight:700;
    color:#006699;
}

/* Buttons */
.btn-custom{
    background:#ff6600;
    color:#fff;
    transition:0.3s;
}
.btn-custom:hover{
    background:#e65c00;
    transform:translateY(-2px);
}

.btn-back{
    background:#6c757d;
    color:#fff;
}
.btn-back:hover{
    background:#5a6268;
}

/* Table */
.table{
    background:#fff;
}
.table th{
    background:#006699;
    color:#fff;
    text-align:center;
}
.table td{
    vertical-align:middle;
}

/* Image */
.evidence-img{
    height:120px;
    width:100px;
    object-fit:cover;
    border-radius:8px;
}

/* Alert */
.success-msg{
    background:green;
    color:#fff;
    padding:10px;
    border-radius:8px;
    text-align:center;
}
</style>

<div class="page-container">
<?php include("header.php"); ?>

<div class="page-content">

    <!-- 🔙 Back -->
    <a href="<?php echo base_url();?>Cin_login" class="btn btn-outline-secondary btn-back mb-3">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>

    <!-- 🧾 FORM -->
    <div class="form-card p-4 mb-4">

        <h4 class="text-center mb-4">Raise Enquiry Ticket</h4>

        <form method="POST" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-3 mb-3">
                    <label>Upload Documentation</label>
                    <input type="file" name="fileToUpload" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Email</label>
                    <input type="text" class="form-control bg-light"
                        value="<?php echo $student->stud_email; ?>" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Mobile</label>
                    <input type="text" class="form-control bg-light"
                        value="<?php echo $student->stud_phone; ?>" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Type</label>
                    <select name="enquiry_type" class="form-control" required>
                        <option value="">-- select type -- 👇</option>
                        <option value="1">General Enquiry</option>
                        <option value="2">Registration Issue</option>
                        <option value="3">Material Issue</option>
                        <option value="4">Orientation Issue</option>
                        <option value="5">Mock Paper Issue</option>
                        <option value="6">Tech Support</option>
                        <option value="7">Combo Purchase Issue</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Your Query</label>
                    <input type="text" name="enquiry" class="form-control" required>
                </div>

            </div>

            <div class="text-center mt-3">
                <button type="submit" name="submit" class="btn btn-outline-success btn-custom px-4">
                    <i class="fa-solid fa-paper-plane"></i> Raise Ticket
                </button>
            </div>

        </form>
    </div>

    <!-- 📋 TABLE -->
    <div class="form-card p-4">

        <h4 class="mb-3">Your Enquiries</h4>

        <?php if(empty($payments)){ ?>
            <div class="alert alert-warning text-center">
                No Enquiries Found
            </div>
        <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Token</th>
                        <th>CIN</th>
                        <th>Type</th>
                        <th>Query</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php $i=1; foreach ($payments as $value) { ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value['student_name']; ?></td>
                        <td><?php echo $value['ticket_number']; ?></td>
                        <td><?php echo $value['cin']; ?></td>
                        <td><?php echo $value['enquiry_name']; ?></td>
                        <td><?php echo $value['enquiry']; ?></td>

                        <td>
                            <?php if(!empty($value['evidence'])){ ?>
                                <img src="https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence'];?>" class="evidence-img">
                            <?php } else { ?>
                                No File
                            <?php } ?>
                        </td>

                        <td>
                            <?php echo $value['status']; ?><br>
                            <small><?php echo $value['date']; ?></small>
                        </td>

                        <td>
                            <?php if($value['status']=='Open'){ ?>
                                <form method="POST">
                                    <button type="submit"
                                        name="delete"
                                        value="<?php echo $value['enquiry_id']; ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            <?php } else { ?>
                                <span class="text-success">Resolved</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>

        <?php } ?>

    </div>

</div>

<?php include("footer.php"); ?>

</div>