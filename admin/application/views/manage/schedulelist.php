<?php
/*
|--------------------------------------------------------------------------
| Partial: schedule list
|--------------------------------------------------------------------------
| Expects: $type, $schedules_lunar, $schedules_marrs
| Used both by createlink.php (initial page render) and by the AJAX
| endpoint get_schedule_list() (re-render on type change, no reload).
|--------------------------------------------------------------------------
*/
?>

<?php if ($type == 'lunar') { ?>

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

<?php } elseif ($type == 'marrs') { ?>

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