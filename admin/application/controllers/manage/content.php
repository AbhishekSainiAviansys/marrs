<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Content extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model('contentModel');
    }
    public function index() {
        $data['list'] = $this->contentModel->listcontentPosts();
        $this->load->view("contentList.php", $data);
    }
    public function add() {
        $data['contentID'] = '';
        
        if (isset($_POST['submit'])) {
            $data = array(
                'contentTitle' => $this->input->post('contentTitle'),
                'contentKey' => $this->input->post('contentKey'),
                'content' => $this->input->post('content'),
                'contentStatus' => $this->input->post('contentStatus'),
                'contentKey' => $this->input->post('contentKey')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('contentTitle', 'Title of content', 'required');
            $this->validation->set_rules('contentKey', 'Content key', 'required');
            $this->validation->set_rules('content', 'Content', 'required');
            $this->validation->set_rules('contentStatus', 'Status of content', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->contentModel->insert($data);
                redirect('manage/content/index/', 'refresh');
            }
        }
		$data['mode']      = 'Add';
        $this->load->view("contentAdd", $data);
    }
    public function edit() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
       
        if (isset($_POST['submit'])) {
            $data = array(
                'contentTitle' => $this->input->post('contentTitle'),
                'contentKey' => $this->input->post('contentKey'),
                'content' => $this->input->post('content'),
                'contentStatus' => $this->input->post('contentStatus'),
                'contentKey' => $this->input->post('contentKey')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('contentTitle', 'Title of content', 'required');
            $this->validation->set_rules('contentKey', 'Content key', 'required');
            $this->validation->set_rules('content', 'Content', 'required');
            $this->validation->set_rules('contentStatus', 'Status of content', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
			}
		}
	}
    public function view() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
        $data['mode']      = 'View';
        $data['list']      = $this->contentModel->getcontentPosts($uri['id']);
        $this->load->view("contentAdd.php", $data);
    }
    public function delete() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
        $data['list']      = $this->contentModel->changeStatus($uri['id']);
        redirect('manage/content/index/', 'refresh');
    }
}