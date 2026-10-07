<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFING 
| ------------------------------------------------------------------- 
| Configuration of outgoing mail server. 
| */   
/*$config['protocol']='smtp';  
$config['smtp_host']='ssl://smtp.googlemail.com';  
$config['smtp_port']='465';  
$config['smtp_timeout']='30';

$config['smtp_user']='marrsapp@gmail.com';  
$config['smtp_pass']='alkaadithya';
  
/*$config['smtp_user']='info@nationalmathleague.com';  
$config['smtp_pass']='nationalmathleagueinfo';  */
/*$config['mailtype']='html';  
$config['charset']='utf-8';  
$config['newline']="\r\n"; */ 

$config['protocol']='ssmtp';  
$config['smtp_host']='ssl://ssmtp.gmail.com';  
$config['smtp_port']='465';  


$config['smtp_user']='marrsapp@gmail.com';  
$config['smtp_pass']='alkaadithya';
$config['mailtype']='html';
$config['charset']='utf-8';
$config['wordwrap']=TRUE;
  
  
/*$config['smtp_user']='info@nationalmathleague.com';  
$config['smtp_pass']='nationalmathleagueinfo';  */
/*  
  
*/

  
/* End of file email.php */  
/* Location: ./system/application/config/email.php */  