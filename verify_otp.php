<?php 

session_start();
if (!isset($_SESSION['email_otp'])) {
    echo "expired";
    exit;
}

$enteredOtp = trim($_POST['otp'] ?? '');
$sessionOtp = trim($_SESSION['email_otp']);

if ($enteredOtp === $sessionOtp) {
    unset($_SESSION['email_otp']); // prevent reuse
    echo "verified";
} else {
    echo "invalid";
}
?>