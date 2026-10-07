<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CSV
{
	//* Stores the csv content as array.
	private $csv = array();
	
	//* Functions to get the contents from CSV file.
	public function getContent($file) {
		$handle = fopen($file, 'r');  
		while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
				array_push($this->csv,$data);
			}
		return $this->csv;
	}
	
	
	public function exports_new($data)
	{
            //$data[] = array('x'=> $x, 'y'=> $y, 'z'=> $z, 'a'=> $a);
             header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"test".".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            foreach ($data as $item) {
                fputcsv($handle, $item);
            }
                fclose($handle);
            exit;
        }
	
	
	
	
	
	public function export($data=array(), $columns=array(),$file_name='data.csv')
	{

//echo "<pre>";print_r($data);exit;

ob_clean();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$file_name);
 
		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, $columns);

		foreach($data as $item){
			fputcsv($output, $item);
		}
	}
	
	
	public function export_download($data=array(),$heading=array(), $columns=array(),$file_name='data.csv'){

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$file_name);
 
		// create a file pointer connected to the output stream
		$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, $heading);
        fputcsv($output, $columns);


		foreach($data as $item){
			fputcsv($output, $item);
		}
	}	
	
	
	
    /*public function getContent($file) {
		$handle = fopen($file, 'r');  
		while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
				array_push($this->csv,$data);
			}
		return $this->csv;
	}*/

	
	public function save_export($data=array(), $columns=array(),$file_name='data.csv')
	{
	    
     /* header("Content-type: text/csv");
      header("Content-Disposition: attachment; filename=file.csv");
      header("Pragma: no-cache");
      header("Expires: 0");
      $data = array(
          array("data12", "data16", "data17"),
          array("data2", "data33", "data25"),
          array("data31", "data32", "data23")
      );   
      $file = fopen('php://output', 'w');                              
      fputcsv($file, array('Description', 'Click', 'CTR'));      
      while ($data as $row) {
        fputcsv($file, $row);              
      }
      exit(); 	*/	
		
		/*header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$file_name);
 
		/*header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");*/
		 
		/*//this line is important its makes the file name
		header("Content-Disposition: attachment;filename=export_".$file_name);
		header("Content-Transfer-Encoding: binary ");
		*/
		// create a file pointer connected to the output stream
		
		/*$output = fopen('php://output', 'w');

		// output the column headings
		fputcsv($output, $columns);

		foreach($data as $item){
			fputcsv($output, $item);
		}
		
		
		/*echo tempnam("sys_get_temp_dir()","csv");*/
		
		/*	$fp = fopen('php://input', 'w');
			foreach ( $data as $line ) {
				$val = explode(",", $line);
				fputcsv($fp, $val);
			}
			fclose($fp);
		
		
		/*
		echo ":----------------";print_r($output);
	        $file = $file_name;
			$data = file_get_contents($output);
			
				echo ":&&&&&&&&&&&&&&&&&&&";print_r($data);
			
			/*if (!copy($file_name, "public/uploads/" . $file_name)) {
				echo "failed to copy $file...\n";
			}*/
			
		/*	chmod($file ,7777);
			file_put_contents("public/uploads/" . $file, $data);*/
		/*
		header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Type: application/force-download');
header('Content-Type: application/octet-stream');
header('Content-Type: application/download');
header("Content-Disposition: attachment;filename=attendance.xlsx");
header('Content-Transfer-Encoding: binary');

		
		$fp = fopen('php://output', 'R');
		$uploads_dir = '/public/cin_email_requests';
        move_uploaded_file("$uploads_dir/$output");	*/	

			
	}
	
		 
		
} 