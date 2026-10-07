<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once(APPPATH."third_party/phpmailer/src/Exception.php");
require_once(APPPATH."third_party/phpmailer/src/PHPMailer.php");
require_once(APPPATH."third_party/phpmailer/src/SMTP.php");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mailtest extends CI_Controller {
    public function __construct() {
        parent::__construct();
         //$this->load->library('email');
       
    }
    public function index() {
        
    
   $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'marrs.in';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'donotreply@marrs.in';                     //SMTP username
    $mail->Password   = '}n,jY6KSpTCt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('donotreply@marrs.in', 'MaRRS');
    $mail->addAddress('viswanath.singh@aviansys-tech.com');     //Add a recipient
    
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'MaRRS Email Verification';
    $mail->Body    = 'Your one time email verification code is 112233';
    //$mail->AltBody = 'Your one time email verification code is';

    $mail->send();
    fastcgi_finish_request();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}   
            
    }
          public function emailsend(){
              
              
              $sender="donotreply@marrs.in";
        // $sender="donotreply@marrs.in";
        $recipient = 'viswanath.singh@aviansys-tech.com';
 
        $subject = "MaRRS Email Verification";
        $message = "Your one time email verification code is ";
        $headers = 'From:' . $sender;
 
        if (mail($recipient, $subject, $message, $headers)) {
            echo  "OTP sent successfully.";
        } else {
            echo "Failed to send OTP.";
        }

           
            die;
            
        }

    

    
}    