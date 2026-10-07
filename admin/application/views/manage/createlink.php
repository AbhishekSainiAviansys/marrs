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
    cursor:pointer;
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
}

/*.step-grid{*/
/*    display:grid;*/
/*    grid-template-columns:repeat(3,1fr);*/
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
.step-card input[type=email],
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

.filter-row{
    display:flex;
    align-items:flex-end;
    gap:12px;
    margin-bottom:16px;
}

.filter-row .filter-field{
    max-width:260px;
}

</style>


<div class="row-fluid sortable">

    <div class="box span12">

        <!-- PAGE HEADER -->
        <div class="lunar-page-head">
            <div class="icon-badge">&#128279;</div>
            <div>
                <h1>Create Affiliate Link</h1>
                <p>Generate a registration link with franchise, affiliate and CRM percentage splits</p>
            </div>
        </div>

        <!-- MESSAGE -->
        <?php if (isset($message) && !empty($message)) { ?>
            <div class="lunar-msg <?php echo (isset($status) && $status == 'success') ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php } ?>

        <!-- SINGLE FORM — everything (franchise/associate/crm/expiry/type/ids) submits together -->
        <form method="POST" id="createLinkForm" action="<?php echo current_url(); ?>">

            <div class="lunar-create-grid">

                <div>

                    <!-- GENERATE LINK PANEL -->
                    <div class="lunar-panel">

                        <div class="lunar-panel-title">Generate Affiliate Link</div>

                        <div class="step-grid row g-3">

                            <!-- STEP 1: FRANCHISE -->
                            <!--<div class="step-card">-->
                                <!--<div class="step-num">1</div>-->
                                <!--<h3>Select Franchise</h3>-->
                                <!--<div class="step-desc">Choose franchise to generate link</div>-->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Franchise</label>
                                <select name="franchise" id="franchise" required>
                                    <option value="">-- Select Franchise --</option>
                                    <?php foreach ($franchise as $fran) { ?>
                                        <option
                                            value="<?php echo $fran->franchise_id; ?>"
                                            data-name="<?php echo htmlspecialchars($fran->franchise_first_name . ' ' . $fran->franchise_last_name, ENT_QUOTES, 'UTF-8'); ?>"
                                        >
                                            <?php echo htmlspecialchars($fran->franchise_first_name . ' - ' . $fran->franchise_last_name . ' - ' . $fran->place, ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                </div>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Franchise %</label>
                                <div class="pct-wrap">
                                    <input type="number" step="0.01" min="0" max="100"
                                        name="franchise_percentage" id="franchise_percentage"
                                        class="pct-input" placeholder="e.g. 10" required>
                                    <span>%</span>
                                </div>
                                </div>
                            <!--</div>-->

                            <!-- STEP 2: ASSOCIATE (fixed, from URL) -->
                            <!--<div class="step-card">-->
                            <!--    <div class="step-num">2</div>-->
                            <!--    <h3>Affiliate</h3>-->
                            <!--    <div class="step-desc">This link is being generated for the affiliate below</div>-->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Affiliate</label>
                                <input
                                    type="text"
                                    id="associate_display"
                                    value="<?php echo htmlspecialchars($associate->first_name . ' ' . $associate->last_name, ENT_QUOTES, 'UTF-8'); ?>"
                                    disabled
                                >
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <input type="hidden" name="associate" id="associate" value="<?php echo $associate->associate_id; ?>">
                                </div>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>Affiliate %</label>
                                <div class="pct-wrap">
                                    <input type="number" step="0.01" min="0" max="100"
                                        name="associate_percentage" id="associate_percentage"
                                        class="pct-input" placeholder="e.g. 10" required>
                                    <span>%</span>
                                </div>
                                </div>
                            <!--</div>-->

                            <!-- STEP 3: CRM -->
                            <!--<div class="step-card">-->
                            <!--    <div class="step-num">3</div>-->
                            <!--    <h3>Select CRM</h3>-->
                            <!--    <div class="step-desc">Choose CRM from available list</div>-->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <label>CRM</label>
                                <select name="crm" id="crm" required>
                                    <option value="">-- Select CRM --</option>
                                    <?php foreach ($crm as $c) { ?>
                                        <option value="<?php echo $c->id; ?>" data-name="<?php echo htmlspecialchars($c->desc, ENT_QUOTES, 'UTF-8'); ?>">
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
                                        class="pct-input" placeholder="e.g. 10" required>
                                    <span>%</span>
                                </div>
                                </div>
                           

<div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                        <label>Date of Link Expiry</label>
                        <input
                            type="date"
                            name="expire_date"
                            required
                            style="max-width:220px; border:1px solid var(--lunar-border); border-radius:8px; padding:8px 10px; font-size:13px;"
                        >
                        </div>
                    </div>


                    <!-- LUNAR / MARRS REGISTRATIONS -->
                    <!--<div class="lunar-panel">-->

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
                                    <option value="marrs" <?php echo (isset($type) && $type == 'marrs') ? 'selected' : ''; ?>>MaRRS</option>
                                    <option value="lunar" <?php echo (isset($type) && $type == 'lunar') ? 'selected' : ''; ?>>Lunar</option>
                                </select>
                            </div>
                        </div>

                        <!-- type travels WITH the main form on final submit -->
                        <input type="hidden" name="type" id="type_hidden" value="<?php echo isset($type) ? htmlspecialchars($type, ENT_QUOTES, 'UTF-8') : ''; ?>">

                        <?php if (isset($type) && $type == 'lunar') { ?>

                            <div class="schedule-list" id="lunar-list">
                                <?php if (!empty($schedules_lunar)) { ?>
                                    <?php foreach ($schedules_lunar as $sch) { ?>
                                        <label class="schedule-row">
                                            <input type="checkbox" value="<?php echo $sch->lunar_schedule_id; ?>"
                                                name="ids[]" class="schedule-check" data-id="<?php echo $sch->lunar_schedule_id; ?>">
                                            <span class="schedule-title">
                                                <?php echo htmlspecialchars($sch->subject . ' - ' . $sch->title . ' - ' . $sch->series, ENT_QUOTES, 'UTF-8'); ?>
                                            </span>
                                        </label>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div style="padding:15px 0; color:var(--lunar-muted); font-size:13px;">
                                        No Lunar registrations found.
                                    </div>
                                <?php } ?>
                            </div>

                        <?php } elseif (isset($type) && $type == 'marrs') { ?>

                            <div class="schedule-list" id="marrs-list">
                                <?php if (!empty($schedules_marrs)) { ?>
                                    <?php foreach ($schedules_marrs as $sch) { ?>
                                        <label class="schedule-row">
                                            <input type="checkbox" value="<?php echo $sch->id; ?>"
                                                name="ids[]" class="schedule-check" data-id="<?php echo $sch->id; ?>">
                                            <span class="schedule-title">
                                                <?php echo htmlspecialchars($sch->product_name, ENT_QUOTES, 'UTF-8'); ?>
                                            </span>
                                        </label>
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
                        
                                            <button type="submit" name="submit" class="btn-generate">Generate Link</button>


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
| Plain JS (not dependent on jQuery load timing). Navigates the page via
| GET so the controller can read $this->input->get('type') and load the
| correct schedule list, WITHOUT triggering the main form's required-field
| validation (since this does not submit #createLinkForm).
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
    | Highlight checked schedule rows
    |--------------------------------------------------------------------------
    */
    $(document).on('change', '.schedule-check', function(){
        $(this).closest('.schedule-row').toggleClass('checked', $(this).is(':checked'));
    });


    /*
    |--------------------------------------------------------------------------
    | Require at least one schedule checked before allowing submit
    |--------------------------------------------------------------------------
    */
    $('#createLinkForm').on('submit', function(e){

        let checkedCount = $('.schedule-check:checked').length;

        if (checkedCount === 0) {
            e.preventDefault();
            alert('Please select at least one schedule before generating the link.');
            return false;
        }

    });

});

</script>

<?php include('footer.php'); ?>