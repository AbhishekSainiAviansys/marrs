<?php include('header.php'); ?>

<style>
/* ==========================================
   LUNAR PROGRAM MODERN UI
   ========================================== */

.lunar-modern,
.lunar-modern * {
    box-sizing: border-box;
}

.lunar-modern {
    width: 100%;
    padding: 25px 28px 40px;
    background: #f5f8fc;
    min-height: calc(100vh - 250px);
    font-family: Arial, Helvetica, sans-serif;
}

/* HEADER */

.lunar-modern-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    gap: 20px;
    margin-bottom: 22px !important;
}

.lunar-modern-title h1 {
    margin: 0 0 7px !important;
    padding: 0 !important;
    font-size: 28px !important;
    line-height: 1.2 !important;
    font-weight: 700 !important;
    color: #17233c !important;
}

.lunar-modern-title p {
    margin: 0 !important;
    font-size: 13px !important;
    color: #7b879a !important;
}

.lunar-modern-tools {
    display: flex !important;
    gap: 10px !important;
}

.lunar-modern-search {
    width: 300px !important;
    height: 42px !important;
    padding: 0 15px !important;
    border: 1px solid #dce3ed !important;
    border-radius: 9px !important;
    background: #fff !important;
    color: #333 !important;
    box-shadow: 0 2px 8px rgba(30,50,80,.04) !important;
}

.lunar-modern-filter {
    width: 145px !important;
    height: 42px !important;
    padding: 0 12px !important;
    border: 1px solid #dce3ed !important;
    border-radius: 9px !important;
    background: #fff !important;
}

/* ==========================================
   STAT CARDS
   ========================================== */

.lunar-stats {
    display: grid !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    gap: 16px !important;
    margin-bottom: 22px !important;
}

.lunar-stat {
    min-height: 112px !important;
    padding: 20px !important;
    background: #fff !important;
    border: 1px solid #e2e8f1 !important;
    border-radius: 13px !important;
    box-shadow: 0 4px 14px rgba(30,50,80,.05) !important;
    display: flex !important;
    align-items: center !important;
}

.lunar-stat-icon {
    width: 52px !important;
    height: 52px !important;
    min-width: 52px !important;
    border-radius: 13px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-right: 15px !important;
    font-size: 23px !important;
    font-weight: 700 !important;
}

.stat-blue .lunar-stat-icon {
    background: #eaf3ff !important;
    color: #2478df !important;
}

.stat-green .lunar-stat-icon {
    background: #e9faf1 !important;
    color: #18a05d !important;
}

.stat-purple .lunar-stat-icon {
    background: #f2ebff !important;
    color: #7847dc !important;
}

.stat-orange .lunar-stat-icon {
    background: #fff2e4 !important;
    color: #f47b20 !important;
}

.lunar-stat-label {
    font-size: 13px !important;
    color: #758197 !important;
    margin-bottom: 5px !important;
}

.lunar-stat-value {
    font-size: 25px !important;
    line-height: 1 !important;
    font-weight: 700 !important;
    color: #17233c !important;
}

/* ==========================================
   PROGRAM CARD
   ========================================== */

.lunar-program {
    background: #fff !important;
    border: 1px solid #dfe6ef !important;
    border-radius: 14px !important;
    margin-bottom: 15px !important;
    overflow: hidden !important;
    box-shadow: 0 4px 15px rgba(30,50,80,.05) !important;
}

.lunar-program-head {
    min-height: 92px !important;
    padding: 18px 22px !important;
    display: flex !important;
    align-items: center !important;
    cursor: pointer !important;
    background: #fff !important;
}

.lunar-program-head:hover {
    background: #f9fbff !important;
}

.lunar-program-icon {
    width: 52px !important;
    height: 52px !important;
    min-width: 52px !important;
    border-radius: 14px !important;
    background: #edf5ff !important;
    color: #2879dc !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 22px !important;
    font-weight: 700 !important;
    margin-right: 16px !important;
}

.lunar-program-info {
    flex: 1 !important;
}

.lunar-program-name {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #17233c !important;
    margin-bottom: 7px !important;
}

.lunar-program-meta {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    font-size: 12px !important;
    color: #7c8799 !important;
}

.lunar-active {
    display: inline-block !important;
    padding: 4px 11px !important;
    border-radius: 20px !important;
    background: #dcf7e7 !important;
    color: #15964d !important;
    font-weight: 600 !important;
}

.lunar-counts {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    margin-right: 25px !important;
}

.lunar-count {
    padding: 7px 13px !important;
    border-radius: 20px !important;
    font-size: 12px !important;
    font-weight: 600 !important;
}

.lunar-plan-count {
    background: #eaf4ff !important;
    color: #1670d2 !important;
}

.lunar-component-count {
    background: #f3edff !important;
    color: #7343d5 !important;
}

.lunar-total {
    width: 125px !important;
    text-align: right !important;
}

.lunar-total-label {
    display: block !important;
    font-size: 11px !important;
    color: #8a95a7 !important;
    margin-bottom: 4px !important;
}

.lunar-total-value {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #17233c !important;
}

.lunar-arrow {
    width: 35px !important;
    margin-left: 12px !important;
    text-align: center !important;
    font-size: 18px !important;
    color: #2679dd !important;
}

/* ==========================================
   PROGRAM BODY
   ========================================== */

.lunar-program-body {
    display: none !important;
    padding: 20px !important;
    border-top: 1px solid #e5eaf1 !important;
    background: #f9fbfd !important;
}

.lunar-program-body.open {
    display: block !important;
}

.lunar-details {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 18px !important;
}

/* ==========================================
   DETAIL BOX
   ========================================== */

.lunar-detail-box {
    background: #fff !important;
    border: 1px solid #e0e6ef !important;
    border-radius: 10px !important;
    overflow: hidden !important;
}

.lunar-detail-head {
    height: 48px !important;
    padding: 0 15px !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    font-size: 14px !important;
    font-weight: 700 !important;
}

.lunar-plans-head {
    background: #edf6ff !important;
    color: #1266ba !important;
}

.lunar-components-head {
    background: #f3edff !important;
    color: #6940c9 !important;
}

.lunar-detail-head span {
    font-size: 11px !important;
    font-weight: 600 !important;
}

/* ==========================================
   TABLE
   ========================================== */

.lunar-detail-table {
    width: 100% !important;
    margin: 0 !important;
    border-collapse: collapse !important;
}

.lunar-detail-table th {
    padding: 11px 13px !important;
    background: #fafbfd !important;
    color: #748096 !important;
    border-bottom: 1px solid #e6ebf2 !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    text-align: left !important;
}

.lunar-detail-table td {
    padding: 11px 13px !important;
    color: #344159 !important;
    border-bottom: 1px solid #edf0f5 !important;
    font-size: 12px !important;
}

.lunar-detail-table tr:last-child td {
    border-bottom: 0 !important;
}

.lunar-amount {
    text-align: right !important;
    font-weight: 700 !important;
    color: #17233c !important;
    white-space: nowrap !important;
}

/* ==========================================
   REVENUE SPLIT
   ========================================== */

.lunar-revenue-box {
    margin-top: 18px !important;
}

.lunar-revenue-grid {
    display: grid !important;
    grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    gap: 12px !important;
    padding: 15px !important;
}

.lunar-revenue-item {
    background: #fafbfd !important;
    border: 1px solid #e6ebf2 !important;
    border-radius: 9px !important;
    padding: 12px !important;
    text-align: center !important;
}

.lunar-revenue-label {
    font-size: 11px !important;
    color: #7b879a !important;
    margin-bottom: 5px !important;
    text-transform: uppercase !important;
    font-weight: 600 !important;
}

.lunar-revenue-value {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #17233c !important;
}

.lunar-revenue-head {
    background: #fff2e4 !important;
    color: #b55c0f !important;
}

.lunar-cin-btn {
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    padding: 6px 12px !important;
    border: 1px solid #2679dd !important;
    border-radius: 20px !important;
    background: #fff !important;
    color: #2679dd !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    white-space: nowrap !important;
}

.lunar-cin-btn:hover {
    background: #edf6ff !important;
}

@media(max-width: 900px) {
    .lunar-revenue-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
}

/* ==========================================
   PROGRAM TOTAL
   ========================================== */

.lunar-program-total {
    margin-top: 18px !important;
    padding: 14px 17px !important;
    background: #edf6ff !important;
    border-radius: 9px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.lunar-program-total-title {
    color: #1468bd !important;
    font-size: 14px !important;
    font-weight: 700 !important;
}

.lunar-program-total-sub {
    display: block !important;
    margin-top: 3px !important;
    color: #7b879a !important;
    font-size: 11px !important;
}

.lunar-program-total-price {
    padding: 9px 17px !important;
    border-radius: 22px !important;
    background: #d8ebff !important;
    color: #0965c2 !important;
    font-size: 16px !important;
    font-weight: 700 !important;
}

/* ==========================================
   EMPTY
   ========================================== */

.lunar-empty {
    background: #fff !important;
    border: 1px solid #e1e7ef !important;
    border-radius: 12px !important;
    padding: 45px !important;
    text-align: center !important;
    color: #7d899b !important;
}

/* ==========================================
   RESPONSIVE
   ========================================== */

@media(max-width: 1100px) {

    .lunar-stats {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    .lunar-details {
        grid-template-columns: 1fr !important;
    }
}

@media(max-width: 700px) {

    .lunar-modern {
        padding: 15px !important;
    }

    .lunar-modern-header {
        display: block !important;
    }

    .lunar-modern-tools {
        margin-top: 15px !important;
    }

    .lunar-modern-search {
        width: 100% !important;
    }

    .lunar-stats {
        grid-template-columns: 1fr !important;
    }

    .lunar-program-head {
        padding: 15px !important;
    }

    .lunar-counts {
        display: none !important;
    }

    .lunar-total {
        display: none !important;
    }
}
</style>


<div class="lunar-modern">

    <!-- HEADER -->
    <div class="lunar-modern-header">

        <div class="lunar-modern-title">
            <h1>Lunar Program List</h1>
            <p>
                View all Lunar programs with their plans and components
            </p>
        </div>

        <div class="lunar-modern-tools">

            <input
                type="text"
                id="lunarSearch"
                class="lunar-modern-search"
                placeholder="Search program, plan or component..."
            >

            <select id="lunarFilter" class="lunar-modern-filter">
                <option value="all">All Programs</option>
                <option value="active">Active</option>
            </select>

        </div>

    </div>


    <?php

    $total_programs = !empty($list) ? count($list) : 0;
    $total_plans = 0;
    $total_components = 0;
    $total_value = 0;

    if (!empty($list)) {

        foreach ($list as $program) {

            if (!empty($program['items'])) {

                foreach ($program['items'] as $item) {

                    if ($item['item_type'] == 'Plan') {
                        $total_plans++;
                    }

                    if ($item['item_type'] == 'Component') {
                        $total_components++;
                    }

                    $total_value += (float)$item['amount'];
                }
            }
        }
    }

    ?>


    <!-- STATISTICS -->

    <div class="lunar-stats">

        <div class="lunar-stat stat-blue">
            <div class="lunar-stat-icon">▦</div>
            <div>
                <div class="lunar-stat-label">Total Programs</div>
                <div class="lunar-stat-value">
                    <?php echo $total_programs; ?>
                </div>
            </div>
        </div>


        <div class="lunar-stat stat-green">
            <div class="lunar-stat-icon">▤</div>
            <div>
                <div class="lunar-stat-label">Total Plans</div>
                <div class="lunar-stat-value">
                    <?php echo $total_plans; ?>
                </div>
            </div>
        </div>


        <div class="lunar-stat stat-purple">
            <div class="lunar-stat-icon">◇</div>
            <div>
                <div class="lunar-stat-label">Total Components</div>
                <div class="lunar-stat-value">
                    <?php echo $total_components; ?>
                </div>
            </div>
        </div>


        <div class="lunar-stat stat-orange">
            <div class="lunar-stat-icon">₹</div>
            <div>
                <div class="lunar-stat-label">Total Value</div>
                <div class="lunar-stat-value">
                    ₹ <?php echo number_format($total_value, 2); ?>
                </div>
            </div>
        </div>

    </div>


    <!-- PROGRAMS -->

    <?php if (!empty($list)) { ?>

        <?php foreach ($list as $program) { ?>

            <?php

            $plans = [];
            $components = [];
            $program_total = 0;

            if (!empty($program['items'])) {

                foreach ($program['items'] as $item) {

                    if ($item['item_type'] == 'Plan') {
                        $plans[] = $item;
                    }

                    if ($item['item_type'] == 'Component') {
                        $components[] = $item;
                    }

                    $program_total += (float)$item['amount'];
                }
            }

            ?>

            <div
                class="lunar-program"
                data-search="<?php
                    echo htmlspecialchars(
                        strtolower(
                            $program['program_name'] . ' ' .
                            json_encode($program['items'])
                        )
                    );
                ?>"
            >

                <!-- PROGRAM HEADER -->

                <div
                    class="lunar-program-head"
                    onclick="lunarToggle(this)"
                >

                    <div class="lunar-program-icon">
                        ✦
                    </div>

                    <div class="lunar-program-info">

                        <div class="lunar-program-name">
                            <?php
                            echo htmlspecialchars(
                                $program['program_name']
                            );
                            ?>
                        </div>

                        <div class="lunar-program-meta">

                            <span class="lunar-active">
                                <?php
                                echo htmlspecialchars(
                                    $program['program_status']
                                );
                                ?>
                            </span>

                            <span>
                                Program ID:
                                <?php echo $program['program_id']; ?>
                            </span>

                        </div>

                    </div>


                    <div class="lunar-counts">

                        <span class="lunar-count lunar-plan-count">
                            <?php echo count($plans); ?>
                            <?php echo count($plans) == 1 ? 'Plan' : 'Plans'; ?>
                        </span>

                        <span class="lunar-count lunar-component-count">
                            <?php echo count($components); ?>
                            <?php echo count($components) == 1 ? 'Component' : 'Components'; ?>
                        </span>

                    </div>


                    <div class="lunar-total">

                        <span class="lunar-total-label">
                            Total Value
                        </span>

                        <div class="lunar-total-value">
                            ₹ <?php echo number_format($program_total, 2); ?>
                        </div>

                    </div>


                    <div class="lunar-arrow">
                        <span>⌄</span>
                    </div>

                </div>


                <!-- DETAILS -->

                <div class="lunar-program-body">

                    <div class="lunar-details">


                        <!-- PLANS -->

                        <div class="lunar-detail-box">

                            <div class="lunar-detail-head lunar-plans-head">

                                <span>▤ &nbsp; Plans</span>

                                <span>
                                    <?php echo count($plans); ?> Plans
                                </span>

                            </div>

                            <?php if (!empty($plans)) { ?>

                                <table class="lunar-detail-table">

                                    <thead>
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th>Plan Name</th>
                                            <th style="text-align:right;">
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php $p = 1; ?>

                                    <?php foreach ($plans as $plan) { ?>

                                        <tr>

                                            <td>
                                                <?php echo $p++; ?>.
                                            </td>

                                            <td>
                                                <strong>
                                                    <?php
                                                    echo htmlspecialchars(
                                                        $plan['plan_name']
                                                    );
                                                    ?>
                                                </strong>
                                            </td>

                                            <td class="lunar-amount">
                                                ₹ <?php
                                                echo number_format(
                                                    (float)$plan['amount'],
                                                    2
                                                );
                                                ?>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                    </tbody>

                                </table>

                            <?php } else { ?>

                                <div class="lunar-empty">
                                    No active plans found.
                                </div>

                            <?php } ?>

                        </div>


                        <!-- COMPONENTS -->

                        <div class="lunar-detail-box">

                            <div class="lunar-detail-head lunar-components-head">

                                <span>◇ &nbsp; Components</span>

                                <span>
                                    <?php echo count($components); ?>
                                    Components
                                </span>

                            </div>

                            <?php if (!empty($components)) { ?>

                                <table class="lunar-detail-table">

                                    <thead>
                                        <tr>
                                            <th style="width:50px;">#</th>
                                            <th>Component Name</th>
                                            <th style="text-align:right;">
                                                Amount
                                            </th>
                                            <th>CIN List</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php $c = 1; ?>

                                    <?php foreach ($components as $component) { ?>

                                        <tr>

                                            <td>
                                                <?php echo $c++; ?>.
                                            </td>

                                            <td>
                                                <strong>
                                                    <?php
                                                    echo htmlspecialchars(
                                                        $component['component_name']
                                                    );
                                                    ?>
                                                </strong>
                                            </td>

                                            <td class="lunar-amount">
                                                ₹ <?php
                                                echo number_format(
                                                    (float)$component['amount'],
                                                    2
                                                );
                                                ?>
                                            </td>

                                            <td>
                                                <button class="lunar-cin-btn">
                                                    CIN List
                                                </button>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                    </tbody>

                                </table>

                            <?php } else { ?>

                                <div class="lunar-empty">
                                    No active components found.
                                </div>

                            <?php } ?>

                        </div>

                    </div>


                    <!-- REVENUE SPLIT -->

                    <div class="lunar-detail-box lunar-revenue-box">

                        <div class="lunar-detail-head lunar-revenue-head">
                            <span>₹ &nbsp; Revenue Split</span>
                            <span>7 Fields</span>
                        </div>

                        <div class="lunar-revenue-grid">

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Franchise %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['franchise_percentage']) && $program['franchise_percentage'] !== null && $program['franchise_percentage'] !== '') ? number_format((float)$program['franchise_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Associate %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['franchise_cut']) && $program['franchise_cut'] !== null && $program['franchise_cut'] !== '') ? number_format((float)$program['franchise_cut'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Management %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['management_percentage']) && $program['management_percentage'] !== null && $program['management_percentage'] !== '') ? number_format((float)$program['management_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Aviansys %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['aviansys_percentage']) && $program['aviansys_percentage'] !== null && $program['aviansys_percentage'] !== '') ? number_format((float)$program['aviansys_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Maker %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['maker_percentage']) && $program['maker_percentage'] !== null && $program['maker_percentage'] !== '') ? number_format((float)$program['maker_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">Associate (New) %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['associate_percentage']) && $program['associate_percentage'] !== null && $program['associate_percentage'] !== '') ? number_format((float)$program['associate_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">IT %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['it_percentage']) && $program['it_percentage'] !== null && $program['it_percentage'] !== '') ? number_format((float)$program['it_percentage'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                            <div class="lunar-revenue-item">
                                <div class="lunar-revenue-label">CRM %</div>
                                <div class="lunar-revenue-value">
                                    <?php echo (isset($program['crm_per']) && $program['crm_per'] !== null && $program['crm_per'] !== '') ? number_format((float)$program['crm_per'], 2) . '%' : '—'; ?>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- TOTAL -->

                    <div class="lunar-program-total">

                        <div>

                            <div class="lunar-program-total-title">
                                Total Program Value
                            </div>

                            <span class="lunar-program-total-sub">
                                Sum of all plans and components
                            </span>

                        </div>

                        <div class="lunar-program-total-price">
                            ₹ <?php echo number_format($program_total, 2); ?>
                        </div>

                    </div>

                </div>

            </div>

        <?php } ?>

    <?php } else { ?>

        <div class="lunar-empty">
            <strong>No Lunar Programs Found</strong>
            <br><br>
            There are currently no active Lunar programs.
        </div>

    <?php } ?>

</div>


<script>

function lunarToggle(header)
{
    var body = header.nextElementSibling;
    var arrow = header.querySelector('.lunar-arrow span');

    if (body.classList.contains('open')) {

        body.classList.remove('open');
        arrow.innerHTML = '⌄';

    } else {

        body.classList.add('open');
        arrow.innerHTML = '⌃';

    }
}


/* SEARCH */

document.getElementById('lunarSearch').addEventListener(
    'keyup',
    function () {

        var value = this.value.toLowerCase().trim();

        document.querySelectorAll('.lunar-program').forEach(
            function (card) {

                var text =
                    card.getAttribute('data-search') || '';

                card.style.display =
                    text.indexOf(value) !== -1
                    ? ''
                    : 'none';
            }
        );
    }
);

</script>

<?php include('footer.php'); ?>