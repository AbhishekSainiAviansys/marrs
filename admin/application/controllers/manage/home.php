<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        }else{
			redirect('manage/index/', 'refresh');
		}
    }
}
