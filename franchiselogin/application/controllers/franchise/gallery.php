<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Gallery extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        } 
        $this->load->model("galleryModel");
    }
    public function index() {
        $data['result'] = $this->galleryModel->listAlbum();
        $this->load->view("albumList", $data);
    }
    public function albumList() {
        $albumID = $this->uri->segment(5);
        $result  = $this->galleryModel->getAlbum($albumID);
        if (empty($result)) {
            redirect(SITE_URL . 'gallery/', 'refresh');
        }
        $albumID          = $result['albumID'];
        $globalPath       = "/public/uploads/gallery/" . $this->session->userdata('franchise_id') . "/" . $albumID . "/";
        $dirname          = getcwd() . $globalPath;
        $sitepath         = BASE_URL . $globalPath;
        $images           = scandir($dirname);
        $data['images']   = $images;
        $data['albumID']  = $albumID;
        $data['sitepath'] = $sitepath;
        $this->load->view("galleryAlbumList", $data);
    }
    public function multipleUpload() {
        $albumID = $this->uri->segment(5);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $globalPath = "/public/uploads/gallery/" . $this->session->userdata('instituteID') . "/" . $albumID . "/";
            $dirname    = getcwd() . $globalPath;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $dirname . uniqid('Photo_') . $_FILES['file']['name'])) {
                echo ($_POST['index']);
            }
            exit;
        } else {
            $data['albumID']   = $albumID;
            $result            = $this->galleryModel->getAlbum($albumID);
            $data['albumName'] = $result['albumName'];
            $this->load->view("galleryMultipleUpload", $data);
        }
    }
    public function addAlbum() {
        $data['instituteID'] = $this->session->userdata('instituteID');
        if (isset($_POST['submit'])) {
            $gallery_name = $_POST['album_name'];
            $gallery_desc = $_POST['album_desc'];
            $this->load->model("galleryModel");
            $flag = $this->galleryModel->createAlbum($gallery_name, $gallery_desc);
            echo "<script>parent.location.reload();</script>";
            redirect('gallery', 'refresh');
        }
        $this->load->view("galleryAddAlbum", $data);
    }
    public function removeImage() {
        if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'remove_image') {
            $albumID     = $_REQUEST['album_id'];
            $imageName   = $_REQUEST['image_name'];
            $instituteID = $this->session->userdata('instituteID');
            $globalPath  = "/public/uploads/gallery/" . $this->session->userdata('instituteID') . "/" . $albumID . "/" . $imageName;
            $dirname     = getcwd() . $globalPath;
            echo unlink($dirname);
            exit;
        }
    }
    public function removeAlbum() {
        if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'remove_album') {
            $albumID     = $_REQUEST['album_id'];
            $instituteID = $this->session->userdata('instituteID');
            $globalPath  = "/public/uploads/gallery/" . $this->session->userdata('instituteID') . "/" . $albumID;
            $dirname     = getcwd() . $globalPath;
            $flag        = $this->galleryModel->deleteAlbum($dirname, $albumID);
            echo $flag;
            exit;
        }
    }
}