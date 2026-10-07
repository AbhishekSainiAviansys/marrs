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
$completedSeriesIds = [];

if (!empty($responseArr['data'])) {
    foreach ($responseArr['data'] as $seriesRow) {
        $series = $seriesRow['series'];
        $allExams = $seriesRow['exams'] ?? [];

        // Extract statuses
        $statuses = array_column($allExams, 'status');

        // Check if all statuses are 1
        if (!empty($statuses) && !in_array(0, $statuses, true)) {
            $completedSeriesIds[] = $series;
        }
    }
}

if (empty($schedule)) {
    echo '<option value="">Error: no schedule</option>';
} else {
    $hasUnattempted = false; // Track if any series is printed

    foreach ($schedule as $row) {

        // Check if this series is in the completedSeriesIds array
        if (in_array($row->series, $completedSeriesIds)) {
            $hasUnattempted = true;
            ?>
            <option value="<?= $row->lunar_schedule_id ?>"
                    data-id="<?= $row->series ?>"
                    data-scdid="<?= $row->lunar_schedule_id ?>">
                ✅ <?= $row->season . ' - ' . $row->subject . ' - ' . $row->series . ' - ' . $row->type ?>
            </option>
            <?php
        }
    }

    // If nothing displayed
    if (!$hasUnattempted) {
        echo '<option value="">Please Complete All Test In The Seriesto view Result</option>';
    }
}
?>