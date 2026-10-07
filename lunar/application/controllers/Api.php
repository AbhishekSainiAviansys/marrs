<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
       
    }
	public function mode() {
    $this->load->model('newmodel');
        $array = $this->input->post();
        $cin=$array['cin'];$clevel=$array['clevel'];$product=$array['product'];

        $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$cin);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['student']=$student= $query->row_array();
            
        
      // echo 'ok'; print_r($student);die;
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('status !=', '');
            $this->db->where('clevel',$clevel);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['result']=$result_array= $query->row_array();
            
            if($result_array['period_id']=='12'){
               
                $this->db->select('level_name,medal_no');
                $this->db->from('competition_level_byproduct');
                $this->db->where('product_name', $product);
                $this->db->where('level_id',$clevel); 
                $query = $this->db->get();
                //echo $this->db->last_query();exit;
                $resul=$query->row_array();
                $nl= $resul['medal_no'];
                // print_r($resul);die;
                
                
                $this->db->select('level_name,medal_no');
                $this->db->from('competition_level_byproduct');
                $this->db->where('product_name', $product);
                $this->db->where('medal_no',$nl+1); 
                $query = $this->db->get();
                //echo $this->db->last_query();exit;
                $resul=$query->row_array();
                
                
                
                $nl= $resul['level_name'];
                $data['nex_level']=$nl;
            // echo $nl;die;
            }
            
            
            
            $this->db->select('medal_no,level_name');
            $this->db->from('competition_level_byproduct');
            $this->db->where('level_id',$clevel);
            $this->db->where('product_name', $data['result']['product_name']);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $res=$query->row_array();
            $data['level_name']=$res['level_name'];
            $data['medal']= $res['medal_no'];
            
            $this->db->select('level_id');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product_name']);
            $this->db->order_by("level_id", "DESC");
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $result= $query->row_array();
            // echo $result['level_id'];die;
            
            
           // echo $result_array['period_id'];die;
            
            if($result_array['period_id']!='12')
            {
                    if($result['level_id']!=$id){
            
            
                        $this->db->select('level_name');
                        $this->db->from('competition_level_byproduct');
                        $this->db->where('product_name',$data['result']['product_name']);
                        $this->db->where('level_id !=', $id);
                        $this->db->where('level_id >=', '1');
                        $this->db->order_by("level_id", "ASC");
                        $query = $this->db->get();
                        //echo $this->db->last_query();exit;
                        $result= $query->row_array();
 	                    //echo $result['level_name'];die;
 	                   
                        $data['nex_level']= $result['level_name'];
                        
                    }   else{
                         $data['nex_level']='';
                    }
            $data['student']=$this->newmodel->get_student_data_cin($cin);
            
            
            }else{
                
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$cin);
            // $this->db->where('status !=', null);
            // $this->db->where('clevel',$id);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['student']= $query->row_array();
         
            }
            
            
       
    //   $this->load->view('current_year/down_certificate', $data);
    }

    // In your Api.php controller

public function index() {
    // Collect POST data
    $array = $this->input->post();
    $cin = $array['cin'];
    $clevel = $array['clevel'];
    $product = $array['product'];

    // Generate PDF content
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Certificate');
    $pdf->SetSubject('Certificate');
    $pdf->SetKeywords('Certificate, PDF, Example');

    // Add a page
    $pdf->AddPage();

    // Set some content to be printed
    $content = "<h1>cin: $cin</h1><h2>clevel: $clevel</h2><h3>product: $product</h3>";

    // Print the content
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF
    $pdfFilePath = FCPATH . 'downloads/certificate.pdf';
    $pdf->Output($pdfFilePath, 'F'); // Save to file

    // Force download of the generated PDF
    if (file_exists($pdfFilePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($pdfFilePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pdfFilePath));
        readfile($pdfFilePath);
        exit;
    } else {
        echo 'PDF file not found.';
    }
}


}
?>