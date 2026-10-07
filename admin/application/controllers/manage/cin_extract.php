<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
    
class Cin_extract extends CI_Controller
 {
	

 public function __construct() 
	{
	
        parent::__construct();
        if (!$this->session->userdata('user_id')) { redirect('manage/login/', 'refresh'); }
        $this->load->library('encrypt');
        $this->load->library('session');
		$this->load->library('csv');
		$this->load->model('periodmodel');
        $this->load->model('locationmodel');
        $this->load->model('schoolmodel');
        $this->load->model('studentsmodel');
        $this->load->model('franchisemodel');
        $this->load->model('cinmodel');
    }

/*================================= ==========================*/

//  FUNCTION 1:-  GENERATE BULK CIN

/*================================= ==========================*/


public function competition_extract(){
    echo 'ok';die;
    $this->load->view('cin_competition_extract');
}

                                                        


} /*END OF CLASS*/
   