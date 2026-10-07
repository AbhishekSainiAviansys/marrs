<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Gallery extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->model("galleryModel");
        $this->load->library('validation');
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
        $globalPath       = "/public/uploads/gallery/manage/" . $albumID . "/";
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
            $globalPath = "/public/uploads/gallery/manage/" . $albumID . "/";
            $dirname    = getcwd() . $globalPath;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $dirname . uniqid('Photo_') . $_FILES['file']['name'])) {
                echo 1;
            }else{
				echo 0;
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
        if (isset($_POST['submit'])) {
            $gallery_name = $_POST['album_name'];
            $gallery_desc = $_POST['album_desc'];
            $this->load->model("galleryModel");
            $flag = $this->galleryModel->createAlbum();
            echo "<script>parent.location.reload();</script>";
            redirect('gallery', 'refresh');
        }
        $this->load->view("galleryAddAlbum", $data);
    }
	public function editAlbum() {
		$albumID = $this->uri->segment(5);
        if (isset($_POST['submit'])) {
            $gallery_name = $_POST['album_name'];
            $gallery_desc = $_POST['album_desc'];
            $this->load->model("galleryModel");
            $flag = $this->galleryModel->createAlbum($albumID );
            echo "<script>parent.location.reload();</script>";
            redirect('gallery', 'refresh');
        }
		$result            = $this->galleryModel->getAlbum($albumID);
		$data['result']=$result;
		$data['albumID']=$albumID;
        $this->load->view("galleryAddAlbum", $data);
    }
    public function removeImage() {
		$albumID = $this->uri->segment(6);
		$imageName = $this->uri->segment(5);
		$globalPath = "/public/uploads/gallery/manage/" . $albumID . "/";
		$imageName     = getcwd() . $globalPath.$imageName;
        unlink($imageName);
		$this->notifications->notify('Image Deleted successfully', 'success');
		redirect('manage/gallery/albumList/album_id/'.$albumID, 'refresh');
		  
        
    }
    public function removeAlbum() {
        echo $albumID = $this->uri->segment(5);
        $flag        = $this->galleryModel->deleteAlbum( $albumID);
		$this->notifications->notify('Album Deleted successfully', 'success');
		  redirect('manage/gallery/', 'refresh');

        
    }
}