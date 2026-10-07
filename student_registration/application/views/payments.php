
<?php

$platform = $_GET['platform'] ?? 'all';
$payments = $payments ?? [];
$result   = $result ?? [];

// If search submitted, filter $payments accordingly
// if(isset($_POST['submit'])){
//     $startDate = $_POST['start_date'];
//     $endDate   = $_POST['end_date'];
//     $type      = $_POST['type'];

//     if($type == 'competition'){
//         $this->db->select('*');
//         $this->db->from('payment_split');
//         $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
//         $this->db->where('payment_split.status','1');
//         $this->db->where('date_of_payment >=', $startDate);
//         $this->db->where('date_of_payment <=', $endDate);
//         $this->db->order_by('pay_id','DESC');
//         $this->db->group_by('payment_split.payment_id');
//         $query = $this->db->get();
//         $payments = $query->result_array();
//     }
//     elseif($type == 'school'){
//         $this->db->select('*');
//         $this->db->from('payment_split_prid');
//         $this->db->where('date_of_payment >=', $startDate);
//         $this->db->where('date_of_payment <=', $endDate);
//         $this->db->order_by('pay_id','DESC');
//         $query = $this->db->get();
//         $payments = $query->result_array();
//     }

//     $result = $_POST;
// } else {
//     // default last 100 competition payments
//     $this->db->select('*');
//     $this->db->from('payment_split');
//     $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
//     $this->db->where('payment_split.status','1');
//     $this->db->order_by('pay_id','DESC');
//     $this->db->group_by('payment_split.payment_id');
//     $this->db->limit(100);
//     $query = $this->db->get();
//     $payments = $query->result_array();
//     $result = [];
// }

// Prepare monthly aggregation for chart
$monthly = [];
$chart_labels = [];
$chart_data   = [];
$all_total = 0; 
$tot_franchise = 0; 
$tot_gst = 0; 
$tot_crm = 0; 
$tot_razor = 0; 
$tot_management = 0; 
$tot_balance = 0; 
$tot_aviansys = 0; 
$tot_crm_aviansys = 0; 
$tot_maker = 0;
$tot_it = 0;


foreach($payments as $value){

    // Platform filter
    if($platform != 'all' && isset($value['platform']) && strtolower($value['platform']) != $platform){
        continue;
    }

    // Use correct table data
    // if(isset($result['type']) && $result['type'] == 'school'){
    //     $res = (object)$value; // school payments, no join needed
    // } else {
    //     $res = $this->db->get_where('payment_split',[
    //         'comp_id'=>$value['comp_id'],
    //         'cin'=>$value['cin'],
    //         'payment_id'=>$value['payment_id']
    //     ])->row();
    // }
    
    $rowType = $value['type'] ?? ($result['type'] ?? 'competition');

    if ($rowType == 'school') {
        $res = (object)$value;
    } else {
        $res = $this->db->get_where('payment_split', [
            'comp_id'    => $value['comp_id'],
            'cin'        => $value['cin'],
            'payment_id' => $value['payment_id']
        ])->row();
    }

    // Maker calculation
    $maker = 0;
    if(!empty($value['revenue_setting_id'])){
        $rows = $this->db->get_where('makers_splits',[
            'comp_id'=>$value['comp_id'],
            'revenue_setting_id'=>$value['revenue_setting_id'],
            'order_id'=>$value['payment_id'],
            'transaction_id !='=>null
        ])->result();
        foreach($rows as $r){ $maker += $r->price; }
    }

    // Monthly aggregation
    $month = date('Y-m', strtotime($value['date_of_payment']));
    if(!isset($monthly[$month])){
        $monthly[$month] = [
            'revenue'=>0,'franchise'=>0,'aviansys'=>0,'maker'=>0,
            'crm'=>0,'management'=>0,'gst'=>0
        ];
    }

    


    // $monthly[$month]['revenue']    += $res->total_amount ?? 0;
    // $monthly[$month]['franchise']  += !empty($res->franchise_tranfer_id)?$res->franchise_amount:0;
    // $monthly[$month]['aviansys']   += !empty($res->aviansys_tranfer_id)?$res->aviansys_amount:0;
    // $monthly[$month]['maker']      += $maker;
    // $monthly[$month]['crm']        += !empty($res->crm_fix_tranfer_id)?$res->crm_fix:0;
    // $monthly[$month]['management'] += !empty($res->management_tranfer_id)?$res->management_amount:0;
    // $monthly[$month]['gst']        += !empty($res->gst_tranfer_id)?$res->gst_amount:0;


    $monthly[$month]['revenue']    += $res->total_amount ?? 0;
    $monthly[$month]['franchise']  += $res->franchise_amount ?? 0;
    $monthly[$month]['aviansys']   += $res->aviansys_amount ?? 0;
    $monthly[$month]['maker']      += $maker;
    $monthly[$month]['crm']        += $res->crm_fix ?? 0;
    $monthly[$month]['management'] += $res->management_amount ?? 0;
    $monthly[$month]['gst']        += $res->gst_amount ?? 0;
    
    $monthly[$month]['it_fix']        += $res->it_fix;

    // Chart arrays
    $chart_labels[] = $value['date_of_payment'];
    $chart_data[]   = $res->total_amount ?? 0;
    
    $franchise_val = $res->franchise_amount ?? 0; 
    $gst_val = $res->gst_amount ?? 0; 
    $crm_val = $res->crm_fix ?? 0;
    $it = $res->it_fix ?? 0;
    $razor_val = $res->razpay_service ?? 0; 
    $management_val = $res->management_amount ?? 0; 
    $balance_val = $res->MaRRS_bal ?? 0; 
    $aviansys_val = $res->aviansys_amount ?? 0;
    
    $all_total += $res->total_amount ?? 0; 
    $tot_franchise += $franchise_val; 
    $tot_gst += $gst_val; 
    $tot_it += $it;
    $tot_crm += $crm_val;
    $tot_razor += $razor_val; 
    $tot_management += $management_val; 
    $tot_balance += $balance_val; 
    $tot_aviansys += $aviansys_val; 
    $tot_maker += $maker;
}

// Prepare chart datasets
$labels     = array_keys($monthly);
$revenue    = array_column($monthly, 'revenue');
$franchise  = array_column($monthly, 'franchise');
$aviansys   = array_column($monthly, 'aviansys');
$maker_arr  = array_column($monthly, 'maker');
$crm        = array_column($monthly, 'crm');
$it        = array_column($monthly, 'it');
$management = array_column($monthly, 'management');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { background:#f4f6fb; }
.card { border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.05); }
.table { border-collapse: separate; border-spacing: 0 10px; }
.table tbody tr { background: #fff; border-radius: 10px; }
.table tbody td {
    border-top: none !important;
    font-size: 13px;     
    white-space: nowrap;
    padding: 5px;
}
.table thead th {
    font-size: 13px;       
    white-space: nowrap;
}
.dataTables_paginate .paginate_button { border-radius:50% !important; padding:5px 5px !important; margin:2px; }
.dataTables_paginate .current { background:#4e73df !important; color:#fff !important; }
.platform-btn { border-radius:20px; }

.logout-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    border-radius: 20px;
}
</style>

</head>
<body>
<div style="position: absolute; top: 20px; right: 20px;">
    <a href="<?php echo base_url('manage/login/logout'); ?>" 
       class="btn btn-danger btn-sm">
       <i class="fa fa-sign-out-alt"></i> Logout
    </a>
</div>
<!-- PLATFORM FILTER -->
<div class="container mt-3 text-center text-primary">
<h2>Payment Split Dashboard</h2>
<div class="d-flex justify-content-center gap-2 flex-wrap">
<a href="?platform=all" class="btn platform-btn <?= $platform=='all'?'btn-success':'btn-outline-success' ?>">All</a>
<a href="?platform=marrs" class="btn platform-btn <?= $platform=='marrs'?'btn-primary':'btn-outline-primary' ?>">MaRRS</a>
<a href="?platform=lunar" class="btn platform-btn <?= $platform=='lunar'?'btn-dark':'btn-outline-dark' ?>">Lunar</a>
<a href="?platform=zoomzoom" class="btn platform-btn <?= $platform=='zoomzoom'?'btn-warning':'btn-outline-warning' ?>">ZoomZoom</a>
</div>
</div>

<!-- FILTER FORM -->
<div class="container mt-4">
<div class="row g-3 align-items-stretch">
<div class="col-md-7">
<div class="card p-3 h-100">
<form method="POST" class="row g-3">

    <!-- Inputs Row -->
    <div class="col-12 d-flex flex-wrap gap-3">
        <!-- Payment Type -->
        <div class="flex-grow-1" style="min-width: 150px;">
            <label class="form-label">Select Payment Type</label>
            <select name="type" class="form-select">
                <option value="">Select</option>
                <option value="competition" <?= (isset($result['type']) && $result['type']=='competition')?'selected':'' ?>>Competition</option>
                <option value="school" <?= (isset($result['type']) && $result['type']=='school')?'selected':'' ?>>School</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="flex-grow-1" style="min-width: 150px;">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="<?= $result['start_date'] ?? '' ?>">
        </div>

        <!-- End Date -->
        <div class="flex-grow-1" style="min-width: 150px;">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="<?= $result['end_date'] ?? '' ?>">
        </div>
    </div>

    <!-- Buttons Row -->
    <div class="col-12 d-flex gap-2 my-3">
        <button type="submit" name="submit" class="btn btn-primary flex-fill">Search</button>
        <a href="?" class="btn btn-secondary flex-fill">Reset</a>
    </div>

</form>
</div>
</div>

<!-- CHART -->
<div class="col-md-5">
<div class="card p-3 h-100">
<h6 class="text-center mb-3">Revenue Chart</h6>
<canvas id="chart"></canvas>
</div>
</div>
</div>
</div>

<!-- TABLE -->
<div class="container mt-4">
<div class="row">
<div class="col-md-12">
<div class="card p-3">

<?php if(empty($payments)){ ?>
<div class="alert alert-warning text-center">No Payment Found</div>
<?php } else { ?>

<div class="d-flex justify-content-between align-items-center mb-2">
<h6 class="mb-0">Payment List</h6>
<form method="POST">
<input type="hidden" name="export_csv" value="1">
<input type="hidden" name="start_date" value="<?= $result['start_date'] ?? '' ?>">
<input type="hidden" name="end_date" value="<?= $result['end_date'] ?? '' ?>">
<input type="hidden" name="type" value="<?= $result['type'] ?? '' ?>">
<button class="btn btn-success btn-sm">Export CSV</button>
</form>
</div>

<div class="table-responsive mb-3">
<table id="paymentTable" class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>CIN</th>
<th>Total</th>
<th>Franchise Pay</th>
<th>MaRRS GST Pay</th>
<th>CRM Kochi Pay</th>
<th>IT Pay</th>
<th>Razorpay Charges</th>
<th>Management Pay</th>
<th>Balance(Coral Venture)</th>
<th>Aviansys Pay</th>
<th>CRM Aviansys</th>

<th>Maker Pay</th>
</tr>
</thead>
<thead style=" font-size: small; font-weight: 600; text-wrap:nowrap;"> 
<tr> 
<td colspan="4" class="text-end">₹ <?= $all_total?></td> 
<td>₹ <?= $tot_franchise ?></td> 
<td>₹ <?= $tot_gst ?></td> 
<td>₹ <?= $tot_crm ?></td> 
<td>₹ <?= $tot_it ?></td> 
<td>₹ <?= $tot_razor ?></td> 
<td>₹ <?= $tot_management ?></td> 
<td>₹ <?= $tot_balance ?>
</td> <td>₹ <?= $tot_aviansys ?></td> 
<td>₹ <?= $tot_crm_aviansys ?></td> 
<td>₹ <?= $tot_maker ?></td> 
</tr> 
</thead>
<tbody>
<?php
$i=1;
foreach($payments as $value){
    if($platform != 'all' && isset($value['platform']) && strtolower($value['platform']) != $platform) continue;
    if(isset($result['type']) && $result['type']=='school'){
        $res = (object)$value;
    } else {
        $res = $this->db->get_where('payment_split',[
            'comp_id'=>$value['comp_id'],
            'cin'=>$value['cin'],
            'payment_id'=>$value['payment_id']
        ])->row();
    }

    $maker=0;
    if(!empty($value['revenue_setting_id'])){
        $rows=$this->db->get_where('makers_splits',[
            'comp_id'=>$value['comp_id'],
            'revenue_setting_id'=>$value['revenue_setting_id'],
            'order_id'=>$value['payment_id'],
            'transaction_id !='=>null
        ])->result();
        foreach($rows as $r){ $maker += $r->price; }
    }
?>
<tr>
<td><?= $i++ ?></td>
<td><?= $value['date_of_payment'] ?></td>

<td>
    <?= $value['cin'] ?: $value['prid'] ?>
    <br>
    CIN:<br>
    <?php 
    if($result['type']=='school'){
        
        $rows=$this->db->get_where('cin_list',[
            'prid'=>$value['prid']
        ])->result();
        
        foreach($rows as $r){ 
            echo $r->cin.'<br>'; 
        }
    }
    ?>
    
</td>

<td><?= $res->total_amount ?? 0 ?></td>
<td><?= !empty($res->franchise_tranfer_id)?$res->franchise_amount:0 ?></td>
<td><?= !empty($res->gst_tranfer_id)?$res->gst_amount:0 ?></td>
<td><?= !empty($res->crm_fix_tranfer_id)?$res->crm_fix:0 ?></td>
<td><?= !empty($res->it_fix_tranfer_id)?$res->it_fix:0 ?></td>
<td><?= $res->razpay_service ?? 0 ?></td>
<td><?= !empty($res->management_tranfer_id)?$res->management_amount:0 ?></td>
<td><?= $res->MaRRS_bal ?? 0 ?></td>
<td><?= !empty($res->aviansys_tranfer_id)?$res->aviansys_amount:0 ?></td>
<td></td>
<td><?= $maker ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<?php } ?>

</div>
</div>
</div>
</div>

<!-- SCRIPTS -->
<script>
$(document).ready(function(){
    $('#paymentTable').DataTable({ pageLength:10, scrollX:true, ordering:true, autoWidth:false });

    new Chart(document.getElementById('chart'),{
        type:'line',
        data:{
            labels: <?= json_encode($labels) ?>,
            datasets:[
                { label:'Revenue', data: <?= json_encode($revenue) ?>, borderWidth:2 },
                { label:'Franchise', data: <?= json_encode($franchise) ?>, borderWidth:2 },
                { label:'Aviansys', data: <?= json_encode($aviansys) ?>, borderWidth:2 },
                { label:'Maker', data: <?= json_encode($maker_arr) ?>, borderWidth:2 },
                { label:'CRM', data: <?= json_encode($crm) ?>, borderWidth:2 },
                { label:'IT', data: <?= json_encode($it) ?>, borderWidth:2 },
                { label:'Management', data: <?= json_encode($management) ?>, borderWidth:2 }
            ]
        },
        options:{ responsive:true, plugins:{ legend:{ position:'top' } } }
    });
});
</script>

</body>
</html>