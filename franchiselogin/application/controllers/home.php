<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->load->library('session');
        //$this->load->library('validation');
        //$this->load->model('locationModel');
        //$this->load->model('competitioncentermodel');
        //$this->load->model('serviceModel');
        //$this->load->model('competitionlevelModel');
        //$this->load->model('periodmodel');
		//$this->load->model('franchisemodel');
    }
    public function index() 
    {
       redirect('site/index', 'refresh');
    }


}