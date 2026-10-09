<?php
require_once __DIR__ . '/env_loader.php';

$servername = marrs_env('DB_HOST', 'localhost');
$username = marrs_env('DB_USERNAME', 'marrscor_marrs');
$password = marrs_env('DB_PASSWORD', '8jN}g7XGRczj');
$database = marrs_env('DB_DATABASE', 'marrscor_marrs');

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>