<option value="">-- select schedule --</option>
<?php
$cin = $_SESSION['cin'];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://grademarker.online/api/GettingTheExam',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode([
        "cin" => $cin
    ]),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ]
]);

$response = curl_exec($curl);
curl_close($curl);

$responseArr = json_decode($response, true);
$incompleteSeriesIds = [];

if (!empty($responseArr['data'])) {
    foreach ($responseArr['data'] as $seriesRow) {

        $series = $seriesRow['series'];
        $allExams = $seriesRow['exams'] ?? [];

        $statuses = array_column($allExams, 'status');

        // if any exam status is 0
        if (in_array(0, $statuses, true)) {
            $incompleteSeriesIds[] = $series;
        }
    }
}


$purchasedSeries = $this->db
    ->select('series')
    ->where('cin', $cin)
    ->where('status', 'Paid')
    ->get('new_cart')
    ->result_array();
$purchasedSeries = array_map('strval', array_column($purchasedSeries, 'series'));

if (empty($schedule)) {

    echo '<option value="">Error: no schedule</option>';

} else {
 $hasUnattempted = false;
    foreach ($schedule as $row) {

        if (!isset($row->series)) continue;

        $series = (string)$row->series;

        // 1️⃣ Skip if not purchased
        if (!in_array($series, $purchasedSeries, true)) {
            continue;
        }

        // 2️⃣ Skip if series not in incomplete list
        if (!in_array($series, $incompleteSeriesIds, true)) {
            continue;
        }
       $hasUnattempted = true; 
        
?>
<option value="<?= $row->lunar_schedule_id ?>"
        data-id="<?= $series ?>"
        data-scdid="<?= $row->lunar_schedule_id ?>">
    🟢 <?= $row->season . ' - ' . $row->subject . ' - ' . $row->series . ' - ' . $row->type ?>
</option>
<?php
    }
 
   if (!$hasUnattempted) {
        echo '<option value="">No Unattempted series</option>';
    }

}

?>