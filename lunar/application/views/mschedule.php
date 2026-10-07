<option value="">-- select schedule --</option>

<?php
$cin = $_SESSION['cin'];

$purchasedSeries = $this->db
    ->select('series')
    ->where('cin', $cin)
    ->where('status', 'Paid')
    ->get('new_cart')
    ->result_array();

// convert to simple array
$purchasedSeries = array_column($purchasedSeries, 'series');

if (empty($schedule)) {

    echo '<option value="">no schedule</option>';

} else {

    foreach ($schedule as $row) {

        if (!isset($row->series)) continue;

        $series = $row->series;

        // ✅ FIXED CONDITION (check inside array)
        if (!in_array($series, $purchasedSeries)) {
            continue;
        }

        ?>
        <option value="<?= $row->lunar_schedule_id ?>"
                data-id="<?= $series ?>"
                data-scdid="<?= $row->lunar_schedule_id ?>">
            🟢 <?= $row->season . ' - ' . $row->subject . ' - ' . $series . ' - ' . $row->type ?>
        </option>
        <?php
    }
}
?>