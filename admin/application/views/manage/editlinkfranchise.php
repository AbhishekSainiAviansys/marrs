<?php
include('header.php');
?>

<style>

:root{
    --lunar-primary:#4C5FD5;
    --lunar-primary-dark:#3B4BB8;
    --lunar-bg:#F5F6FA;
    --lunar-border:#E7E9F0;
    --lunar-text:#2B2D42;
    --lunar-muted:#8A8FA3;
    --lunar-success:#1FAE6E;
    --lunar-success-bg:#E7F8EF;
    --lunar-danger:#D64545;
    --lunar-danger-bg:#FDECEC;
    --lunar-warning:#B8860B;
    --lunar-warning-bg:#FFF6E0;
}

.lunar-page-head{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:20px;
}

.lunar-page-head .icon-badge{
    width:44px;
    height:44px;
    border-radius:12px;
    background:var(--lunar-primary);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    flex-shrink:0;
}

.lunar-page-head h1{
    font-size:22px;
    font-weight:700;
    color:var(--lunar-text);
    margin:0;
}

.lunar-page-head p{
    margin:2px 0 0;
    color:var(--lunar-muted);
    font-size:13px;
}

.lunar-msg{
    border-radius:10px;
    padding:10px 16px;
    font-size:13px;
    font-weight:600;
    margin-bottom:16px;
    display:inline-block;
}

.lunar-msg.success{
    background:var(--lunar-success-bg);
    color:var(--lunar-success);
}

.lunar-msg.error{
    background:var(--lunar-danger-bg);
    color:var(--lunar-danger);
}

.lunar-msg.warning{
    background:var(--lunar-warning-bg);
    color:var(--lunar-warning);
}

.lunar-create-grid{
    display:block;
}

.lunar-panel{
    background:#fff;
    border:1px solid var(--lunar-border);
    border-radius:14px;
    padding:18px 20px;
    margin-bottom:20px;
    box-shadow:0 1px 2px rgba(20,20,43,0.04);
}

.lunar-panel-title{
    font-size:16px;
    font-weight:600;
    color:#1a1a2e;
    margin-bottom:14px;
    padding-bottom:10px;
    border-bottom:1px solid var(--lunar-border);
}

.type-badge{
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:0.03em;
    background:#eef1ff;
    color:#5b63d3;
    border-radius:20px;
    padding:4px 12px;
}

.filter-row{
    display:flex;
    align-items:flex-end;
    gap:12px;
    margin-bottom:16px;
}

.filter-row .filter-field{
    max-width:260px;
}

/*.step-grid{*/
/*    display:grid;*/
/*    grid-template-columns:repeat(2,1fr);*/
/*    gap:16px;*/
/*}*/

/*@media (max-width:700px){*/
/*    .step-grid{*/
/*        grid-template-columns:1fr;*/
/*    }*/
/*}*/

.step-card{
    border:1px solid var(--lunar-border);
    border-radius:12px;
    padding:16px;
    background:#FBFBFD;
}

.step-num{
    width:26px;
    height:26px;
    border-radius:50%;
    background:var(--lunar-primary);
    color:#fff;
    font-size:13px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:10px;
}

.step-card h3{
    font-size:14px;
    font-weight:700;
    color:var(--lunar-text);
    margin:0 0 4px;
}

.step-card .step-desc{
    font-size:12px;
    color:var(--lunar-muted);
    margin-bottom:12px;
}

.step-card label{
    display:block;
    font-size:12px;
    font-weight:600;
    color:var(--lunar-text);
    margin:10px 0 6px;
}

.step-card select,
.step-card input[type=text],
.step-card input[type=date],
.step-card input[type=number]{
    width:100%;
    border:1px solid var(--lunar-border);
    border-radius:8px;
    padding:8px 10px;
    font-size:13px;
    background:#fff;
    color:var(--lunar-text);
}

.step-card input:disabled{
    background:#F1F2F6;
    color:var(--lunar-muted);
}

.pct-wrap{
    position:relative;
}

.pct-wrap span{
    position:absolute;
    right:10px;
    top:8px;
    color:var(--lunar-muted);
    font-size:12px;
}

.btn-generate{
    width:100%;
    background:var(--lunar-success);
    border:1px solid var(--lunar-success);
    color:#fff;
    border-radius:10px;
    padding:12px;
    font-size:14px;
    font-weight:700;
    margin-top:14px;
    cursor:pointer;
}

.btn-generate:hover{
    opacity:0.92;
    color:#fff;
}

.schedule-list{
    display:flex;
    flex-direction:row;
    gap:8px;
    max-height:340px;
    overflow-y:auto;
}

.schedule-row{
    display:flex;
    align-items:center;
    gap:12px;
    padding:10px 14px;
    border:1px solid var(--lunar-border);
    border-radius:8px;
    background:#fff;
    transition:0.2s;
}

.schedule-row:hover{
    background:#f7f8fc;
    border-color:#c9cdf0;
}

.schedule-row.checked{
    background:#eef1ff;
    border-color:#7b83eb;
}

.schedule-check{
    width:18px;
    height:18px;
    flex-shrink:0;
    cursor:pointer;
    accent-color:#5b63d3;
}

.schedule-title{
    font-size:14px;
    color:#333;
    line-height:1.4;
    flex:1;
    cursor:pointer;
}

.schedule-amount{
    width:110px;
    flex-shrink:0;
    border:1px solid var(--lunar-border);
    border-radius:8px;
    padding:6px 8px;
    font-size:13px;
}

.schedule-amount:disabled{
    background:#F1F2F6;
    color:var(--lunar-muted);
}

.link-type-badge{
    display:inline-block;
    margin-left:8px;
    padding:4px 10px;
    border-radius:20px;
    background:#EEF0FF;
    color:var(--lunar-primary);
    font-size:11px;
    font-weight:700;
}

</style>


<div class="row-fluid sortable">

    <div class="box span12">

        <!-- PAGE HEADER -->
        <div class="lunar-page-head">
            <div class="icon-badge">&#9998;</div>
            <div>
                <h1>
                    Edit Franchise Link
                    <span class="link-type-badge">Franchise Link</span>
                </h1>
                <p>Update expiry, status, splits and program schedules for this franchise link</p>
            </div>
        </div>

        <!-- MESSAGE -->
        <?php if (isset($message) && !empty($message)) { ?>
            <div class="lunar-msg <?php echo (isset($status) && $status == 'success') ? 'success' : ((isset($status) && $status == 'warning') ? 'warning' : 'error'); ?>">
                <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php } ?>

        <form method="POST" id="editLinkForm">

            <div class="lunar-create-grid">

                <div>

                    <!-- LINK DETAILS PANEL -->
                    <div class="lunar-panel">

                        <div class="lunar-panel-title">Franchise Link Details</div>

                        <div class="step-grid row g-3">

                            <!-- FRANCHISE (fixed) -->
                            <!--<div class="step-card">-->
                            <!--    <div class="step-num">1</div>-->
                            <!--    <h3>Franchise</h3>-->
                            <!--    <div class="step-desc">Franchise cannot be changed on an existing link</div>-->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                                <label>Franchise</label>
                                <input
                                    type="text"
                                    id="franchise_display"
                                    value="<?php echo htmlspecialchars($franchise->franchise_first_name . ' - ' . $franchise->franchise_last_name, ENT_QUOTES, 'UTF-8'); ?>"
                                    disabled
                                >
</div>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                                <label>Franchise %</label>
                                <div class="pct-wrap">
                                    <input type="number" step="0.01" min="0" max="100"
                                        name="franchise_percentage" id="franchise_percentage"
                                        value="<?php echo htmlspecialchars($associate_link_data->franchise_percentage, ENT_QUOTES, 'UTF-8'); ?>"
                                        required>
                                    <span>%</span>
                                </div>
</div>
                            <!--<div class="step-card">-->
                            <!--    <div class="step-num">2</div>-->
                            <!--    <h3>CRM</h3>-->
                            <!--    <div class="step-desc">Choose CRM from available list</div>-->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                                <label>CRM</label>
                                <select name="crm" id="crm" required>
                                    <option value="">-- Select CRM --</option>
                                    <?php foreach ($crm as $c) { ?>
                                        <option value="<?php echo $c->id; ?>" <?php echo ($c->id == $associate_link_data->crm_id) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($c->desc, ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php } ?>
                                </select>
</div>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                                <label>CRM %</label>
                                <div class="pct-wrap">
                                    <input type="number" step="0.01" min="0" max="100"
                                        name="crm_percentage" id="crm_percentage"
                                        value="<?php echo htmlspecialchars($associate_link_data->crm_percentage, ENT_QUOTES, 'UTF-8'); ?>"
                                        required>
                                    <span>%</span>
                                </div>
</div>

                       
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Date of Link Expiry</label>
                                <input
                                    type="date"
                                    name="expire_date"
                                    value="<?php echo htmlspecialchars($associate_link_data->expire_date, ENT_QUOTES, 'UTF-8'); ?>"
                                    required
                                    style="border:1px solid var(--lunar-border); border-radius:8px; padding:8px 10px; font-size:13px; width:100%;"
                                >
                            </div>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Status</label>
                                <select name="status" required style="border:1px solid var(--lunar-border); border-radius:8px; padding:8px 10px; font-size:13px; width:100%;">
                                    <?php
                                    $status_options = ['Active', 'Inactive', 'Expired'];
                                    foreach ($status_options as $opt) {
                                    ?>
                                        <option value="<?php echo $opt; ?>" <?php echo ($associate_link_data->status == $opt) ? 'selected' : ''; ?>>
                                            <?php echo $opt; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>




                        <div class="lunar-panel-title mt-2">Program Schedules</div>

                        <div class="filter-row">
                            <div class="filter-field" style="flex:1;">
                                <label>Generation Link</label>
                                <select
                                    id="type_selector"
                                    class="form-control"
                                    onchange="navigateToType(this.value)"
                                >
                                    <option value="">-- Select For --</option>
                                    <option value="marrs" <?php echo ($type == 'marrs') ? 'selected' : ''; ?>>MaRRS</option>
                                    <option value="lunar" <?php echo ($type == 'lunar') ? 'selected' : ''; ?>>Lunar</option>
                                </select>
                            </div>
                        </div>

                        <?php if ($type != $associate_link_data->program_type && !(empty($associate_link_data->program_type) && $type == 'lunar')) { ?>
                            <div class="lunar-msg warning" style="display:block; margin-bottom:14px;">
                                Switching program type clears the schedules currently attached to this link — nothing below is pre-selected. Saving will replace them with whatever you pick here.
                            </div>
                        <?php } ?>

                        <!-- type travels WITH the main form on final submit -->
                        <input type="hidden" name="type" id="type_hidden" value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">

                        <?php if ($type == 'lunar') { ?>

                            <div class="schedule-list" id="lunar-list">
                                <?php if (!empty($schedules_lunar)) { ?>
                                    <?php foreach ($schedules_lunar as $sch) {
                                        $is_checked = in_array($sch->lunar_schedule_id, $selected_ids);
                                        $amt = isset($selected_amounts[$sch->lunar_schedule_id]) ? $selected_amounts[$sch->lunar_schedule_id] : '';
                                    ?>
                                        <div class="schedule-row <?php echo $is_checked ? 'checked' : ''; ?>">
                                            <input type="checkbox" value="<?php echo $sch->lunar_schedule_id; ?>"
                                                name="ids[]" class="schedule-check" data-id="<?php echo $sch->lunar_schedule_id; ?>"
                                                <?php echo $is_checked ? 'checked' : ''; ?>>
                                            <label class="schedule-title">
                                                <?php echo htmlspecialchars($sch->subject . ' - ' . $sch->title . ' - ' . $sch->series, ENT_QUOTES, 'UTF-8'); ?>
                                            </label>
                                           
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div style="padding:15px 0; color:var(--lunar-muted); font-size:13px;">
                                        No Lunar registrations found.
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } elseif ($type == 'marrs') { ?>

                            <div class="schedule-list" id="marrs-list">
                                <?php if (!empty($schedules_marrs)) { ?>
                                    <?php foreach ($schedules_marrs as $sch) {
                                        $is_checked = in_array($sch->id, $selected_ids);
                                        $amt = isset($selected_amounts[$sch->id]) ? $selected_amounts[$sch->id] : '';
                                    ?>
                                        <div class="schedule-row <?php echo $is_checked ? 'checked' : ''; ?>">
                                            <input type="checkbox" value="<?php echo $sch->id; ?>"
                                                name="ids[]" class="schedule-check" data-id="<?php echo $sch->id; ?>"
                                                <?php echo $is_checked ? 'checked' : ''; ?>>
                                            <label class="schedule-title">
                                                <?php echo htmlspecialchars($sch->product_name, ENT_QUOTES, 'UTF-8'); ?>
                                            </label>
                                           
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div style="padding:15px 0; color:var(--lunar-muted); font-size:13px;">
                                        No Marrs registrations found.
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } else { ?>

                            <div style="padding:15px 0; color:var(--lunar-muted); font-size:13px;">
                                Select Lunar or MaRRS above to load program schedules.
                            </div>

                        <?php } ?>

                    <button type="submit" name="submit" class="btn-generate">Update Link</button>
                    </div>


                </div>

            </div>

        </form>
<br><br>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

/*
|--------------------------------------------------------------------------
| Type filter navigation
|--------------------------------------------------------------------------
| Plain JS, navigates via GET so the controller can read $this->input->get('type')
| and reload the correct schedule list, without triggering #editLinkForm's
| required-field validation. The link_id stays in the path — only the query
| string changes.
|--------------------------------------------------------------------------
*/
function navigateToType(selected) {
    if (!selected) {
        return;
    }
    var base = window.location.pathname;
    window.location.href = base + '?type=' + encodeURIComponent(selected);
}


$(document).ready(function(){

    /*
    |--------------------------------------------------------------------------
    | Highlight checked schedule rows + enable/disable their amount field
    |--------------------------------------------------------------------------
    */
    $(document).on('change', '.schedule-check', function(){
        var $row = $(this).closest('.schedule-row');
        var checked = $(this).is(':checked');
        $row.toggleClass('checked', checked);
        $row.find('.schedule-amount').prop('disabled', !checked);
    });


    /*
    |--------------------------------------------------------------------------
    | Require at least one schedule checked before allowing submit
    |--------------------------------------------------------------------------
    */
    $('#editLinkForm').on('submit', function(e){

        let checkedCount = $('.schedule-check:checked').length;

        if (checkedCount === 0) {
            e.preventDefault();
            alert('Please select at least one schedule before updating the link.');
            return false;
        }

    });

});

</script>

<?php include('footer.php'); ?>