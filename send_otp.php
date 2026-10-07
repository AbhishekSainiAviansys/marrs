<?php 
session_start();


    $apiKey = "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";
               // API endpoint
    $url = "https://api.brevo.com/v3/smtp/email";
    
    // Get email from POST
    $email = trim($_POST['email'] ?? '');
    
    if (empty($email)) {
        echo "Email is required";
        exit;
    }
    
   
    
    // Generate OTP and save in session
    $otp = rand(100000, 999999);
    $_SESSION['email_otp'] = $otp;
    $_SESSION['email'] = $email;
    $_SESSION['otp_time'] = time();
    
    // Prepare email data for Brevo
    $emailData = [
        "sender" => [
            "name" => "MaRRS Enquiry",
            "email" => "donotreply@marrs.in"
        ],
        "to" => [
            [
                "email" => $email,
                "name" => "User"
            ]
        ],
        "subject" => "Marrs Email Verification",
        "htmlContent" => "<p>Your one-time email verification code is <strong>$otp</strong>.</p>",
        "textContent" => "Your one-time email verification code is $otp."
    ];
    
    // Convert to JSON
    $jsonData = json_encode($emailData);
    
    // cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "api-key: $apiKey",
        "content-type: application/json"
    ]);
    
    // Execute request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Check API response
    if ($httpCode == 201 || $httpCode == 200) {
        // Only echo "sent" for JS modal
        echo "sent";
    } else {
        // Send error for debugging
        echo "Error: " . $response;
    }



    
            


  ?>