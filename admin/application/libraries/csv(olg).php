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
		
} 