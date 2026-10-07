<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
		
		$this->addCommonHelperCustomFunction();	
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
	public function addCommonHelperCustomFunction()
	{
		$this->load->helper('url');
	 	$this->load->library('session');
		$this->load->library('notifications');
		$this->load->library('confirmation');
		switch($this->uri->segment(1)){
			case CORE_MANAGE: 	
				$clientView=CORE_MANAGE;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_MANAGE); break;
			case CORE_PRINCIPAL: 	
				$clientView=CORE_PRINCIPAL;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_PRINCIPAL); break;
			case CORE_FRANCHISE: 	
				$clientView=CORE_FRANCHISE;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_FRANCHISE); break;
			case CORE_STUDENT: 	
				$clientView=CORE_STUDENT;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_STUDENT); break;
			case CORE_EMPLOYEE: 	
				$clientView=CORE_EMPLOYEE;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_EMPLOYEE); break;
			case CORE_SITE: 	
				$clientView=CORE_SITE;
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_SITE); break;
			default:
				$clientView=CORE_FRONTEND;
				/*define('SITE_URL', 	base_url());*/
				define('SITE_URL', 	base_url().$clientView."/");
				$this->load->setFolderPath(CORE_FRONTEND); break;
		}
		define('VIEW_SCRIPT',	base_url()."public/default/".$clientView."/js/");
		define('VIEW_STYLE', 	base_url()."public/default/".$clientView."/css/");
		define('VIEW_IMAGE', 	base_url()."public/default/".$clientView."/images/");
		
		define('COMMON_VIEW_SCRIPT',	base_url()."public/default/common/js/");
		define('COMMON_VIEW_STYLE', 	base_url()."public/default/common/css/");
		define('COMMON_VIEW_IMAGE', 	base_url()."public/default/common/images/");
		
		
		define('BASE_URL', base_url());
		define('ACTION',$this->router->fetch_method());
		define('CONTROLLER',$this->router->fetch_class());
		//$this->redirect($this->uri->segment(1),$this->uri->segment(2));
	}
	/* private function redirect($controller,$action){
		switch($controller){
			case 'manage':
				if($action==''){
					redirect('manage/login/','refresh');
				}
				break;
			default:
				return true;
		}
	} */
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */