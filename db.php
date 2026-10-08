<?php
$servername = "localhost";
$username = "marrscor_marrs";
$password = "8jN}g7XGRczj";

// Create connection
$conn = new mysqli($servername, $username, $password,'marrscor_marrs');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>