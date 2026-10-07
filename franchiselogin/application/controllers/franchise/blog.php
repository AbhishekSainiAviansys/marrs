<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Blog extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model('blogModel');
    }
    public function index() {
        $postID       = '';
        $data['list'] = $this->blogModel->listblogPosts();
        $this->load->view("blogList.php", $data);
    }
    public function add() {
        $data['blogID'] = '';
        $data['mode']   = 'Add';
        if (isset($_POST['submit'])) {
            $data = array(
                'postTitle' => $this->input->post('postTitle'),
                'post' => $this->input->post('post'),
                'postStatus' => $this->input->post('postStatus'),
                'franchise_id' => $this->session->userdata('franchise_id')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('postTitle', 'Title of post', 'required');
            $this->validation->set_rules('post', 'Content for post', 'required');
            $this->validation->set_rules('postStatus', 'Status of post', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->blogModel->insert($data);
                redirect('manage/blog/index/', 'refresh');
            }
        }
        $this->load->view("blogAdd.php", $data);
    }
    public function edit() {
        $data['mode']   = 'Edit';
        $uri            = $this->uri->uri_to_assoc(4);
        $data['blogID'] = $uri['id'];
        if (isset($_POST['submit'])) {
            $data = array(
                'postTitle' => $this->input->post('postTitle'),
                'post' => $this->input->post('post'),
                'postStatus' => $this->input->post('postStatus'),
                'franchise_id' => $this->session->userdata('franchise_id')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('postTitle', 'Title of post', 'required');
            $this->validation->set_rules('post', 'Content for post', 'required');
            $this->validation->set_rules('postStatus', 'Status of post', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->blogModel->insert($data, $uri['id']);
                redirect('manage/blog/index/', 'refresh');
            }
        }
        $data['list'] = $this->blogModel->getblogPosts($uri['id']);
        $this->load->view("blogAdd.php", $data);
    }
    public function view() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $data['list']   = $this->blogModel->getblogPosts($uri['id']);
            $data['mode']   = 'View';
            $data['blogID'] = $uri['id'];
            $this->load->view("blogAdd", $data);
        }
    }
    public function changeStatus() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $res = $this->blogModel->changeStatus($uri['id']);
            redirect('manage/blog/index/', 'refresh');
        }
    }
}