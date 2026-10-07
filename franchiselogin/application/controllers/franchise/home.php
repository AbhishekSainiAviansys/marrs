<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        }else{
			redirect('franchise/index/', 'refresh');
		}
    }
}
