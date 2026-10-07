<?php 
require_once(APPPATH."libraries/phpqrcode/qrlib.php");



// function getUsernameFromEmail($email) {
// 	$find = '@';
// 	$pos = strpos($email, $find);
// 	$username = substr($email, 0, $pos);
// 	return $username;
// }

    $cin = $this->session->userdata('cin');
    $stud_data = $this->db->get_where('cin_list',array('cin'=> $cin))->row();
   // print_r($stud_data->student_name);
    
	$tempDir = $_SERVER['DOCUMENT_ROOT'].'/student_registration/qrcode/'; 
	$email = $stud_data->student_name;
	$subject =  'marrs registration';
	//$filename =   getUsernameFromEmail($email);
	$filename =  uniqid();
	$body =  $cin;
	$codeContents = 'Cin:'.$cin.'?Student Name='.urlencode($stud_data->student_name).'&body='.urlencode($body); 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
?>

	<body>
	<div class="myoutput">
			
			
			
			<div class="qr-field">
				
				<center>
					<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
							<img src="<?php echo base_url('qrcode/').$filename;?>.png" style="width:200px; height:200px;">
					</div>
					
				</center>
			</div>
			
		</div>
		
	</body>
	
</html>