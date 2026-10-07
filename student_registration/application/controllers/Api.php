<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
       
    }
    
    public function emailtemplate()
      {
          
       //  Postman   
          
//           $json= file_get_contents("php://input");
//         $data = json_decode($json, true);

    
//       $to = $data['to'][0]['email'];
//     $templateId = $data['templateId'];
//     $params = $data['params'];
//     $apiKey = "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";
//     $recipientName  = "MaRRS";
    
//     $params = [
//     "product_name" =>$params['product_name'],
//     "period_year"=>$params['period_year'],
//     "studentName"=> $params['student_name'],
//     "cin"=> $params['cin'],
//     "competition"=> $params['competition'],
//     "date"=>  $params['date'],
//     "venue"=>  $params['venue'],
//     "venueNote"=> $params['venueNote'],
//     "reportingTime"=> $params['reportingTime'],
//     "category"=>$params['category'],
//     "class"  =>$params['class']
  
// ];

// // Setup cURL
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, [
//     "accept: application/json",
//     "content-type: application/json",
//     "api-key: $apiKey"
// ]);

// // Body data
// $data = [
//     "to" => [
//         ["email" => $to, "name" => $recipientName]
//     ],
//     "templateId" => $templateId,
//     "params" => $params
// ];

// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// // Execute request
// $response = curl_exec($ch);

// if (curl_errno($ch)) {
//     echo "cURL Error: " . curl_error($ch);
// } else {
//     echo "Response: " . $response;
// }

// curl_close($ch);


// die;
    //  Postman data 
        
        $studentdetail= $this->db->join('cin_result', 'cin_result.cin = cin_list.cin')->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel')->get_where('cin_list',array('cin_list.cin'=>'24SJAB10110018'))->row();
//print_r($studentdetail);die;

$apiKey = "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";
// Email details
$templateId = 908; // Replace with your Brevo template ID
$recipientEmail = "anupama.kumari@aviansys-tech.com"; // sending mail to user 
$recipientName  = "MaRRS";

// Data for template placeholders
$params = [
    "product_name" =>$studentdetail->product_name,
    "period_year"=>$studentdetail->period_id,
    "studentName"=> $studentdetail->student_name,
    "cin"=> $studentdetail->cin,
    "competition"=> $studentdetail->level_name,
    "date"=>  $studentdetail->competition_date,
    "venue"=>  $studentdetail->venue,
    "venueNote"=> "No parking in the school lane. Drop off at the gate if needed.",
    "reportingTime"=> "8:00 AM sharp for all categories",
    "category"=>$studentdetail->category_id,
    "class"  =>$studentdetail->class
  
];

// Setup cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "content-type: application/json",
    "api-key: $apiKey"
]);

// Body data
$data = [
    "to" => [
        ["email" => $recipientEmail, "name" => $recipientName]
    ],
    "templateId" => $templateId,
    "params" => $params
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute request
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

curl_close($ch);


die;
    }
    
    public function lunaremail(){
               $studentdetail= $this->db->join('cin_result', 'cin_result.cin = cin_list.cin')->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel')->get_where('cin_list',array('cin_list.cin'=>'24SJAB10110018'))->row();
//print_r($studentdetail);die;

$apiKey = "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";
// Email details
$templateId = 911; // Replace with your Brevo template ID
$recipientEmail = "viswanath.singh@aviansys-tech.com"; // sending mail to user 
$recipientName  = "MaRRS";
 $main_logo="https://marrs.in/images/MaRRS_Rediscover_Logo.png";
 $product_logo="https://marrs.in/images/Lunar_logo.png";
 $access_code = "L267608";
 $email_title = "MaRRS Lunar Skill Tests";
// Data for template placeholders
$params = [
    "main_logo" =>$main_logo,
    "product_logo" =>$product_logo,
    "email_title" =>$email_title,
    "access_code" =>$access_code,
   // "competition_level"=> $studentdetail->level_name,
    "test1_schedule_title"=>" test 1 ",
    "schedule_date1"  => "28-09-2025",
     "test2_schedule_title"=>" test 2 ",
    "schedule_date2"  => "28-09-2025",
     "test3_schedule_title"=>" test 3 ",
    "schedule_date3"  => "28-09-2025",
     "test4_schedule_title"=>" test 4 ",
    "schedule_date4"  => "28-09-2025"
  
];

// Setup cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.brevo.com/v3/smtp/email");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "content-type: application/json",
    "api-key: $apiKey"
]);

// Body data
$data = [
    "to" => [
        ["email" => $recipientEmail, "name" => $recipientName]
    ],
    "templateId" => $templateId,
    "params" => $params
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute request
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

curl_close($ch);

    }
    
    public function school()
    {
        $rawInput = file_get_contents("php://input");
        $data = json_decode($rawInput, true);
    
        if (!$data || !isset($data['id'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            return;
        }
    
        $arr = [
            'school_id' => $data['id'],
            'account_number' => $data['account_number'],
            'bank_name' => $data['bank_name'],
            'ifsc_code' => $data['ifsc_code'],
            'pan_number' => $data['pan_number'],
            'email' => $data['email']
        ];
    
        $this->db->insert('school_bank_details', $arr);
    
        $this->db->where('id', $data['id']);
        $this->db->update('school_new', ['status_new' => 'Active']);
    
        echo json_encode(['status' => 'success']);
    }

    
	public function mode() 
	{
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

    public function index() 
    {
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