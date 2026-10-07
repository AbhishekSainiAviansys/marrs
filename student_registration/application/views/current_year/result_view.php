<?php include('header.php');

    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_agent, 'Windows') !== false) {
        $take='large';
    } else {
        $take='small';
    }
?>

<style>
    /* ================== GLOBAL CARD ================== */
.card {
    border-radius: 18px;
    border: none;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}

/* ================== PROFILE HEADER ================== */
.profile-header {
    background: linear-gradient(135deg, #2196F3, #3F51B5);
    padding: 30px 15px 20px;
    text-align: center;
    position: relative;
}
.profile-header img {
    border-radius: 50%;
    border: 5px solid #fff;
    box-shadow: 0 5px 12px rgba(0,0,0,0.15);
}
.profile-header h4 {
    margin-top: 12px;
    font-size: 20px;
    font-weight: 600;
    color: #fff;
}
.profile-header p {
    font-size: 13px;
    color: rgba(255,255,255,0.9);
    margin-bottom: 0;
}

/* ================== LIST ================== */
.list-group {
    margin: 0;
}
.list-group-item {
    border: none;
    padding: 14px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f1f1;
    transition: 0.2s;
}
.list-group-item:last-child {
    border-bottom: none;
}
.list-group-item:hover {
    background: #fafafa;
}

/* ================== LABEL ================== */
.list-group-item h6 {
    font-size: 13px;
    color: #666;
    font-weight: 600;
    display: flex;
    align-items: center;
    margin: 0;
}

/* ================== ICON ================== */
.list-group-item i {
    font-size: 14px;
    margin-right: 8px;
    color: #ffffff;
    background: #3F51B5;
    padding: 7px;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    text-align: center;
}

/* ================== VALUE ================== */
.detail {
    font-weight: 600;
    color: #222;
    font-size: 13px;
    text-align: right;
    max-width: 180px;
    word-break: break-word;
}

/* ================== BUTTON ================== */
.btn-outline-secondary {
    border-radius: 5px;
    font-size: 13px;
    padding: 6px 14px;
    transition: all 0.3s ease;
}
.btn-outline-secondary:hover {
    background: #6c757d;
    color: #fff;
}

/* ================== ALERT MARQUEE ================== */
marquee h5 {
    margin: 5px 0;
    font-size: 14px;
    font-weight: 600;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 768px) {
    .profile-header {
        padding: 25px 10px 15px;
    }
    .profile-header h4 {
        font-size: 18px;
    }
    .detail {
        font-size: 12px;
        max-width: 120px;
    }
    .list-group-item {
        padding: 12px 12px;
    }
}


.styled-result {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

.styled-result tr {
  border-bottom: 1px solid #dcdfe3;
}

.styled-result td {
  padding: 0.5rem;
  font-size: 1rem;
}

/* LEFT SIDE (Title) */
.styled-result td:first-child {
  font-weight: 700;
  color: #2d2f31;
  width: 45%;
  letter-spacing: 0.5px;
}

/* RIGHT SIDE (Details) */
.styled-result td:last-child {
  color: #1e88e5;
  font-weight: 500;
}

/* Button styling like image */
.styled-result .btn {
  padding: 6px 16px;
  border-radius: 10px;
  font-size: 14px;
  border: 2px solid #1e66f5;
  color: #1e66f5;
  background: transparent;
  transition: 0.3s ease;
}

.styled-result .btn:hover {
  background: #1e66f5;
  color: #fff;
}
.success-banner {
  margin-top: 10px;
  background: #ffffb3;
  padding: 0.8rem;
  text-align: center;
  border-radius: 4px;
}

.success-banner h5 {
  margin: 0;
  color: #0a7a0a;
  font-size: 1.25rem;
  font-weight: 600;
}

.rtab-header {
  display: flex;
  gap: 8px;
  margin-bottom: 12px;
  flex-wrap: wrap;
  padding:0.8rem;
}

/* Tab buttons */
.rtab-title {
  padding: 8px 16px;
  font-size: 14px;
  font-weight: 600;
  color: #666;
  background: #f3f4f6;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.25s ease;
  border: 1px solid transparent;
}

/* Hover */
.rtab-title:hover {
  background: #e8edf5;
  color: #1e66f5;
}

/* Active tab (MAIN STYLE) */
.rtab-title.active {
  background: #1e66f5;
  color: #fff;
  border: 1px solid #1e66f5;
  box-shadow: 0 2px 6px rgba(30, 102, 245, 0.2);
}

/* Optional: smooth press effect */
.rtab-title:active {
  transform: scale(0.97);
}
.rtab-panel {
    display: none;
}

.rtab-panel.active {
    display: block;
}
</style>

<section>
<?php 
    if(empty($student['stud_email'])){?>
    <marquee><h5 style='color:crimson;'>Please Update your Email... </h5></marquee>
<?php 
    echo $student['stud_email'];
    }
    if(empty($student['stud_phone'])){?>
    <marquee><h5 style='color:crimson;'>Please Update your Mobile... </h5></marquee>
<?php 
    } 
?>
</section>

<div class="container my-3">
    <div class="main-body">
        <div class="row">
            <div class="text-start my-3">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start">
                    <i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK
                </a>  
            </div>

            <div class="col-lg-4">
               
                <div class="card">
    <div class="card-body p-0">

        <!-- Header -->
        <div class="d-flex flex-column align-items-center text-center profile-header">
            <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" 
                 alt="Admin" 
                 class="rounded-circle p-1 bg-light" 
                 width="110">
            <div class="mt-2 text-white">
                <h4><?php echo $student['student_name']; ?></h4>
                <p class="mb-0"><i class="fa-solid fa-user-graduate"></i> Student</p>
            </div>
        </div>

        <!-- Details -->
        <ul class="list-group list-group-flush mt-2">

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h6><i class="fa-solid fa-chalkboard-user"></i> Class</h6>
                <span class="detail"><?php echo $student['class']; ?></span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h6><i class="fa-solid fa-layer-group"></i> Category</h6>
                <span class="detail">
                    <?php 
                        $this->db->select('initials');
                        $this->db->from('period');
                        $this->db->where('period_id',$student['period_id']);
                        $query=$this->db->get();
                        $r=$query->row();
                        $initials=$r->initials;

                        $str = str_replace($initials, "", $student['cin']); 
                        $firstTwoChars = substr($str, 0, 2);

                        $this->db->select('product_name');
                        $this->db->from('products');
                        $this->db->where('in13',$firstTwoChars);
                        $query=$this->db->get();
                        $r=$query->row();
                        $product_name=$r->product_name;

                        $this->db->select('category');
                        $this->db->from('class_category_product');
                        $this->db->where('product_name',$product_name);
                        $this->db->where('class',$student['class']);
                        $query=$this->db->get();
                        $d=$query->row();
                        echo ($d) ? $d->category : '-';
                    ?>
                </span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h6><i class="fa-solid fa-school"></i> School</h6>
                <span class="detail"><?php echo $student['school_name']; ?></span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h6><i class="fa-solid fa-mobile-screen"></i> Mobile</h6>
                <span class="detail">
                    <?php echo (!empty($student['stud_phone'])) ? $student['stud_phone'] : 'NA'; ?>
                </span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h6><i class="fa-solid fa-envelope"></i> Email</h6>
                <span class="detail">
                    <?php echo (!empty($student['stud_email'])) ? $student['stud_email'] : 'NA'; ?>
                </span>
            </li>

        </ul>
    </div>
</div>
            </div><!-- /col-lg-4 -->

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-sm-12 text-center">
                                <h4 class="text-danger"><?php 
                                    $res = $this->db->get_where('cin_result', array('cin' => $student['cin']))->row();
                                    echo $res->product_name;
                                    if($student['series']!=''){
                                        echo ' -Series-'.$student['series'].'-';
                                        echo $student['subject'];
                                    }
                                ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">Results</h5>

                                <?php
                                if(!empty($result_array)){

                                    $i = 1;
                                    foreach ($result_array as $row) {

                                        if($row['grade'] != 'AB'){

                                            /* ══════════════════════════════════════════
                                               CASE: clevel = 13  →  FOUR-TAB LAYOUT
                                            ══════════════════════════════════════════ */
                                            if($row['clevel'] == 13){

                                                /* ── Fetch all products for this CIN at clevel=13 ── */
                                                $prod = $this->db->get_where('new_cart', array('cin' => $row['cin'], 'clevel' => '13'))->result();

                                                /*
                                                 * Build a lookup: subject-keyword (lowercase) => product row
                                                 * product_name examples:
                                                 *   "MaRRS Primary Colors - Science"
                                                 *   "MaRRS Primary Colors - Math"
                                                 *   "MaRRS Primary Colors - English"
                                                 *   "MaRRS Primary Colors - Humanities"
                                                 * We extract the part after the last " - " and lowercase it.
                                                 */
                                                $prod_map = [];
                                                foreach($prod as $p){
                                                    $parts = explode(' - ', $p->product_name);
                                                    $subject_key = strtolower(trim(end($parts))); // e.g. "science"
                                                    $prod_map[$subject_key] = $p;
                                                }

                                                /*
                                                 * Four fixed tabs — only show a tab if the student
                                                 * has that product in new_cart (paid).
                                                 * Tab label  =>  subject key to match product_name suffix
                                                 */
                                                $all_tabs = [
                                                    'English'    => 'english',
                                                    'Mathematics'=> 'math',
                                                    'Science'    => 'science',
                                                    'Humanities' => 'humanities',
                                                ];

                                                /* Keep only tabs the student actually purchased */
                                                $active_tabs = [];
                                                foreach($all_tabs as $label => $key){
                                                    if(isset($prod_map[$key])){
                                                        $active_tabs[$label] = $key;
                                                    }
                                                }

                                                /* Unique IDs */
                                                $uid     = 'rtab_' . $i;
                                                $acc_id  = 'acc13_' . $i;
                                                $body_id = 'accBody13_' . $i;
                                                $level_display = str_replace("_", " ", $row['level_name']);
                                                ?>

                                                <!-- ── ACCORDION WRAPPER for clevel=13 (closed by default) ── -->
                                                <div class="accordion mb-2" id="<?php echo $acc_id; ?>">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed"
                                                                    type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#<?php echo $body_id; ?>"
                                                                    aria-expanded="false"
                                                                    aria-controls="<?php echo $body_id; ?>">
                                                                <?php echo 'MaRRS Primary Colors International Championship'; ?>
                                                            </button>
                                                        </h2>
                                                        <div id="<?php echo $body_id; ?>"
                                                             class="accordion-collapse collapse"
                                                             data-bs-parent="#<?php echo $acc_id; ?>">
                                                            <div class="accordion-body p-0">

                                                                <!-- ── 4-TAB CARD ── -->
                                                                <div class="result-tabs-wrap" id="<?php echo $uid; ?>">

                                                                    <!-- Tab buttons (only purchased subjects) -->
                                                                    <div class="rtab-header">
                                                                        <?php
                                                                        $t = 0;
                                                                        foreach($active_tabs as $label => $key){
                                                                            $active_class = ($t === 0) ? ' active' : '';
                                                                            echo '<div class="rtab-title'.$active_class.'" onclick="switchRTab(\''.htmlspecialchars($uid).'\','.$t.')">'
                                                                                 .htmlspecialchars($label)
                                                                                 .'</div>';
                                                                            $t++;
                                                                        }
                                                                        ?>
                                                                    </div>

                                                                    <div class="rtab-body">
                                                                        <?php
                                                                        $t = 0;
                                                                        foreach($active_tabs as $label => $key){
                                                                            $p = $prod_map[$key]; // new_cart row for this subject

                                                                            /* Fetch result row for this specific product_name + cin */
                                                                            $res13 = $this->db->get_where('cin_result', array(
                                                                                'cin'          => $row['cin'],
                                                                                
                                                                                'clevel'       => '13'
                                                                            ))->row();

                                                                            /* Grade / Rank / Marks / Performer / Speller / Status */
                                                                            $r_grade  = $res13->grade  ?? '-';
                                                                            $r_rank   = $res13->rank   ?? '-';
                                                                            $r_marks  = $res13->marks  ?? '-';
                                                                            $r_status = $res13->status ?? '';
                                                                            $r_perf   = $res13->performer ?? '';
                                                                            $r_spell  = $res13->speller   ?? '';
                                                                            $r_comp_schedule = $res13->competition_schedule_id ?? $row['competition_schedule_id'];

                                                                            /* Best Performer link */
                                                                            if($r_perf == 'Yes' || $r_perf == 'YES'){
                                                                                $perf_url = base_url()."Cin_login/api_callp/".$p->id.'/'.$r_comp_schedule;
                                                                                $performer_html = '<a href="'.$perf_url.'" class="btn btn-outline-warning btn-sm">Download</a>';
                                                                            } else {
                                                                                $performer_html = 'No';
                                                                            }

                                                                            /* Star Speller link */
                                                                            if($r_spell == 'Yes' || $r_spell == 'YES'){
                                                                                $spell_url = base_url()."Cin_login/api_calls/13/".$r_comp_schedule;
                                                                                $speller_html = '<a href="'.$spell_url.'" class="btn btn-outline-danger btn-sm">Download</a>';
                                                                            } else {
                                                                                $speller_html = 'No';
                                                                            }

                                                                            /* Certificate link */
                                                                            if($r_status != ''){
                                                                                if($take == 'large'){
                                                                                    $cert_url = base_url()."Cin_login/download_certificate_primary/".$p->id;
                                                                                } else {
                                                                                    $cert_url = base_url()."Cin_login/api_call/13/".$r_comp_schedule;
                                                                                }
                                                                                $cert_html = '<a href="'.$cert_url.'" class="btn btn-outline-primary btn-sm">Download</a>';
                                                                            } else {
                                                                                $cert_html = 'No Status Available.';
                                                                            }

                                                                            /* Status banner text */
                                                                            if($r_status == 'Q'){
                                                                                $banner_html = '<h5 style="margin:0;color:green;">Congratulations!!! You have successfully qualified for the (next level) of the MaRRS (Championship). We wish you every success as you continue your journey towards excellence.  </h5>';
                                                                            } elseif($r_status == 'NQ'){
                                                                                $banner_html = '<h5 class="nq" style="margin:0;">Great Effort! Every Challenge Makes You Stronger 🚀<br>Experience + Persistence = Future Success.<br>While you didn\'t move to the next level this time, keep practicing, keep learning, and we\'ll see you at the next challenge!</h5>';
                                                                            } else {
                                                                                $banner_html = '<h5 class="nq" style="margin:0;">No status available.</h5>';
                                                                            }

                                                                            $panel_class = ($t === 0) ? 'rtab-panel active' : 'rtab-panel';
                                                                        ?>
                                                                        <div class="<?php echo $panel_class; ?>">
                                                                            <!-- Product name heading -->
                                                                            <p style="font-size:20px;font-weight:600;color:#555;margin:0 0 8px;padding: 0.5rem;border-bottom:1px solid #f0f0f0;">
                                                                                <?php echo htmlspecialchars($p->product_name); ?>
                                                                            </p>
                                                                            <table class="rtab-table styled-result">
                                                                                <tr><td>CIN</td><td><?php echo htmlspecialchars($row['cin']); ?></td></tr>
                                                                                <tr><td>GRADE</td><td><?php echo htmlspecialchars($r_grade); ?></td></tr>
                                                                                <tr><td>RANK</td><td><?php echo htmlspecialchars($r_rank); ?></td></tr>
                                                                                <tr><td>CHAMPIONSHIP POINTS</td><td><?php echo htmlspecialchars($r_marks); ?></td></tr>
                                                                                <tr><td>BEST PERFORMER</td><td><?php echo $performer_html; ?></td></tr>
                                                                                <tr><td>STAR SPELLER</td><td><?php echo $speller_html; ?></td></tr>
                                                                                <tr><td>DOWNLOAD CERTIFICATE</td><td><?php echo $cert_html; ?></td></tr>
                                                                            </table>
                                                                            <!-- Status banner inside each tab -->
                                                                            <div class="rtab-congrats success-banner" style="border-radius:0;margin-top:8px;">
                                                                                <?php echo $banner_html; ?>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                            $t++;
                                                                        } // end foreach active_tabs
                                                                        ?>
                                                                    </div><!-- /rtab-body -->

                                                                </div><!-- /result-tabs-wrap -->

                                                            </div><!-- /accordion-body -->
                                                        </div><!-- /accordion-collapse -->
                                                    </div><!-- /accordion-item -->
                                                </div><!-- /accordion -->

                                                <?php

                                            /* ══════════════════════════════════════════
                                               CASE: clevel != 13  →  ORIGINAL ACCORDION
                                            ══════════════════════════════════════════ */
                                            } else {

                                                if($row['show'] == ''){

                                                    echo '
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item' . $i . '">
                                                            <h2 class="accordion-header">
                                                              <button class="accordion-button ' . $i . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapseOne">
                                                                ';
                                                    $outputString = str_replace("_", " ", $row['level_name']);
                                                    echo $outputString . ' RESULT';
                                                    echo '
                                                              </button>
                                                            </h2>
                                                            <div id="collapse' . $i . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                <table class="table">
                                                                    <thead id="t_head">
                                                                        <th>Title</th>
                                                                        <th>Details</th>
                                                                    </thead>
                                                                    <tr>
                                                                        <td width="250px" style="font-weight:500;">CIN</td>
                                                                        <td style="color:#1aa3ff;">' . $row["cin"] . '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">GRADE</td>
                                                                        <td style="color:#1aa3ff;">' . $row["grade"] . '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">RANK</td>
                                                                        <td style="color:#1aa3ff;">' . $row["rank"] . '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">CHAMPIONSHIP POINTS</td>
                                                                        <td style="color:#1aa3ff;">' . $row["marks"] . '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">BEST PERFORMER</td>
                                                                        <td style="color:#1aa3ff;">';

                                                    if ($row['performer'] == 'Yes' || $row['performer'] == 'YES') {
                                                        if ($take == 'large') {
                                                            $perf_url = base_url()."Cin_login/api_callb/".$row['clevel'].'/'.$row['competition_schedule_id'];
                                                            echo '<a href="'.$perf_url.'" class="btn btn-outline-warning my-2">Download</a>';
                                                        } else {
                                                            $perf_url = base_url()."Cin_login/api_callb/".$row['clevel'].'/'.$row['competition_schedule_id'];
                                                            echo '<a href="'.$perf_url.'" class="btn btn-outline-warning my-2">Download</a>';
                                                        }
                                                    } else {
                                                        echo 'No';
                                                    }

                                                    echo '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">STAR SPELLER</td>
                                                                        <td style="color:#1aa3ff;">';

                                                    if($row['speller'] == 'Yes' || $row['speller'] == 'YES'){
                                                        if ($take == 'large') {
                                                            $spell_url = base_url()."Cin_login/api_calls/".$row['clevel'].'/'.$row['competition_schedule_id'];
                                                            echo '<a href="'.$spell_url.'" class="btn btn-outline-danger my-2">Download</a>';
                                                        } else {
                                                            $spell_url = base_url()."Cin_login/api_calls/".$row['clevel'].'/'.$row['competition_schedule_id'];
                                                            echo '<a href="'.$spell_url.'" class="btn btn-outline-danger my-2">Download</a>';
                                                        }
                                                    } else {
                                                        echo 'No';
                                                    }

                                                    echo '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="font-weight:500;">DOWNLOAD CERTIFICATE</td>
                                                                        <td style="color:#1aa3ff;">';

                                                    if($row['status'] != ''){
                                                        if ($take == 'large') {
                                                            $cert_url = base_url()."Cin_login/download_certificate/".$row['clevel'];
                                                            echo '<a href="'.$cert_url.'" class="btn btn-outline-primary my-2">Download</a>';
                                                        } else {
                                                            $cert_url = base_url()."Cin_login/api_call/".$row['clevel'].'/'.$row['competition_schedule_id'];
                                                            echo '<a href="'.$cert_url.'" class="btn btn-outline-primary my-2">Download</a>';
                                                        }
                                                    } else {
                                                        echo 'No Status Available.';
                                                    }

                                                    echo '</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" style="background-color:#ffffb3;text-align:center;">';

                                                    /* Next-level lookup */
                                                    $this->db->select("level_name");
                                                    $this->db->from("competition_level_byproduct");
                                                    $this->db->where("product_name", $row["product_name"]);
                                                    $this->db->where("level_id >", $row["clevel"]);
                                                    $this->db->order_by("level_id", "ASC");
                                                    $query = $this->db->get();
                                                    $result = $query->row_array();

                                                    
                                                    if($row["status"] == 'Q'){ ?>
                                                        <h5 style='color:green;'>Congratulations! You have successfully qualified for the <?php echo $result['level_name']; ?> of the MaRRS (Championship). We wish you every success as you continue your journey towards excellence.  </h5>
                                                    <?php
                                                    } else {
                                                        ?>
                                                        <h5 style='color:crimson;'>
                                                        <?php
                                                        if($row["status"] == 'NQ'){
                                                            echo "Great Effort! Every Challenge Makes You Stronger 🚀<br>
                                                            Experience + Persistence = Future Success.<br>
                                                            While you didn't move to the next level this time, keep practicing,
                                                            keep learning, and we'll see you at the next challenge!";
                                                        } else {
                                                            echo 'No status Available.';
                                                        }
                                                        ?>
                                                        </h5>
                                                    <?php
                                                    }

                                                    echo '</td>
                                                                    </tr>
                                                                </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';

                                                } else {

                                                    if($row['status'] != 'NQ'){
                                                        echo '
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="accordion-item' . $i . '">
                                                                <h2 class="accordion-header">
                                                                  <button class="accordion-button ' . $i . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapseOne">
                                                                    ';
                                                        $outputString = str_replace("_", " ", $row['level_name']);
                                                        echo $outputString . ' RESULT';
                                                        echo '
                                                                  </button>
                                                                </h2>
                                                                <div id="collapse' . $i . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body">';

                                                        $this->db->select("level_name");
                                                        $this->db->from("competition_level_byproduct");
                                                        $this->db->where("product_name", $row["product_name"]);
                                                        $this->db->where("level_id >", $row["clevel"]);
                                                        $this->db->order_by("level_id", "ASC");
                                                        $query = $this->db->get();
                                                        $result = $query->row_array();
                                                        echo 'Promoted To :- ' . $result["level_name"];

                                                        echo '
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>';
                                                    }
                                                }

                                            } // end clevel != 13

                                        } else {
                                            /* grade == AB */
                                            echo '
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item' . $i . '">
                                                    <h2 class="accordion-header">
                                                      <button class="accordion-button ' . $i . '" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="true" aria-controls="collapseOne">
                                                        ';
                                            $outputString = str_replace("_", " ", $row['level_name']);
                                            echo $outputString . ' RESULT';
                                            echo '
                                                      </button>
                                                    </h2>
                                                    <div id="collapse' . $i . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            You were not present for this level of the competition.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                        }

                                        $i = $i + 1;
                                    } // end foreach

                                } else {
                                    echo '"Results will be announced soon."';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /col-lg-8 -->

        </div>
    </div>
</div>

<!-- Tab switcher for clevel=13 cards -->
 <script>
function switchRTab(uid, idx) {
    var wrap = document.getElementById(uid);
    wrap.querySelectorAll('.rtab-title').forEach(function(b, i){
        b.classList.toggle('active', i === idx);
    });
    wrap.querySelectorAll('.rtab-panel').forEach(function(p, i){
        p.classList.toggle('active', i === idx);
    });
}
 </script>

<?php include("footer.php"); ?>