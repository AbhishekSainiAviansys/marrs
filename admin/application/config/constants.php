<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */


//DATA BASE PREFEIX
define('DB_PREFIX','marrs_');

//ENCRYPTION KEY
define('ENC_KEY','THIS IS MY SUPER ENC KEY');
define('CORE_SCHOOL','school');
define('CORE_MANAGE','manage');
define('CORE_FRONTEND','frontend');
define('CORE_SITE','site');
define('CORE_LOGIN','login');
define('CORE_PRINCIPAL','principal');
define('CORE_FRANCHISE','franchise');
define('CORE_EMPLOYEE','employee');
define('CORE_ACCOUNTS','accounts');
define('CORE_INSTITUTE','institute');
define('CORE_STUDENT','student');
define('CORE_PREVIOUSYEAR','previousyear');
define('CORE_GUEST', 'guest');
define('CORE_OPENCHAMPIONSHIP', 'openchampionship');
define('CORE_SCHOOLLEVEL', 'schoollevel');
define('CORE_PAIDSCHOOLLEVEL', 'paidschoollevel');