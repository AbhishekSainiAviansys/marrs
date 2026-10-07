<?php
include('db.php');

$state_id = intval($_GET['state_id']);

$sql = "SELECT id, district_name
        FROM districts
        WHERE state_id = ?
        ORDER BY district_name ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $state_id);
$stmt->execute();
$result = $stmt->get_result();

echo '<option value="">Select City</option>';

while ($row = $result->fetch_assoc()) {
    echo '<option value="'.$row['id'].'">'
       . htmlspecialchars($row['district_name']) .
       '</option>';
}
?>