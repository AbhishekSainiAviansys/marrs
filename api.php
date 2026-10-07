<?php 


$apiKey = "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"; // Your Brevo API Key

$url = "https://api.brevo.com/v3/whatsapp/sendMessage";

$data = [
    "senderNumber"   => "919995567230",   // ✅ Your registered WhatsApp number
    "contactNumbers" => ["918726534864"], // ✅ MUST be an array
     "text"           => "Hello 👋! Thanks for reaching out. How can we help you today?" // ✅ No templateId needed
];


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "api-key: $apiKey",
    "content-type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// ✅ Handle Response
if (in_array($httpcode, [200, 201, 202])) {
    echo "✅ WhatsApp message sent successfully!";
    echo "\nResponse: " . $response;
} else {
    echo "❌ Failed to send message. HTTP Code: $httpcode\n";
    echo "Response: " . $response;
}

















die;
$apiKey = "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";
// Email details
$templateId = 906; // Replace with your Brevo template ID
$recipientEmail = "viswanath.singh@aviansys-tech.com"; // sending mail to user 
$recipientName  = "MaRRS";

// Data for template placeholders
$params = [
    "product_name" =>"MaRRS International MATH Bee",
    "period_year"=>"2024-25",
    "studentName"=> "Viswanath Singh",
    "cin"=> "24SJAB10110018",
    "competition"=> "State Final & National Prelim",
    "date"=> "Saturday, September 20, 2025",
    "venue"=> "VIBGYOR High, Balewadi, Pune Kirloskar Brothers Limited, Sr. No. 28/2, Sus Village, Baner, Pune 411045",
    "venueNote"=> "No parking in the school lane. Drop off at the gate if needed.",
    "reportingTime"=> "8:00 AM sharp for all categories",
    "category"=>"I",
    "class"  =>"class-1"
  
];

// Setup cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "content-type: application/json",
    "api-key: $apiKey"
]);

// Body data
$data = [
    "to" => [
        ["email" => $recipientEmail, "name" => $recipientName]
    ],
    "templateId" => $templateId,
    "params" => $params
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute request
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

curl_close($ch);


die;


// $apiKey = "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";
// $url = "https://api.brevo.com/v3/whatsappCampaigns";

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//   "accept: application/json",
//   "api-key: $apiKey"
// ]);

// $response = curl_exec($ch);
// curl_close($ch);

// //echo $response;

// $url = "https://api.brevo.com/v3/whatsapp/statistics/events";
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//   "accept: application/json",
//   "api-key: $apiKey"
// ]);
// $response = curl_exec($ch);
// curl_close($ch);
// echo $response;


// die;

$apiKey = "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"; // Your API key
$url = "https://api.brevo.com/v3/whatsapp/sendMessage";

$data =[
        "contactNumbers" => ["918726534864"],
        "templateId"     => 153,
        "senderNumber"   => "919995567230"
    ];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "content-type: application/json",
    "api-key: $apiKey"
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Status: $httpcode\nResponse: $response";





die;

 $apiKey = "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";
    $url = "https://api.brevo.com/v3/whatsapp/sendMessage";
    
    $payload = [
        "contactNumbers" => ["918726534864"],
        "templateId"     => 153,
        "senderNumber"   => "919995567230"
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "content-type: application/json",
        "api-key: $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch);
    } else {
        echo "Status: $httpcode\nResponse: $response\n";
    }
    curl_close($ch);
    
 ?>