<?php
require_once __DIR__ . '/env_loader.php';

$servername = (getenv('DB_HOST') !== FALSE) ? getenv('DB_HOST') : "localhost";
$username = (getenv('DB_USERNAME') !== FALSE) ? getenv('DB_USERNAME') : "marrscor_marrs";
$password = (getenv('DB_PASSWORD') !== FALSE) ? getenv('DB_PASSWORD') : "8jN}g7XGRczj";
$dbname   = (getenv('DB_DATABASE') !== FALSE) ? getenv('DB_DATABASE') : "marrscor_marrs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>