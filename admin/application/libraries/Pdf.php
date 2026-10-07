<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * PDF library(CI)
 * 
 * Released under MIT License.
 *
 * @author		Vinoy V George
 * @version		v1.0
 * @license		-
 */
require_once('pdf/html2pdf.class.php');
class PDF{
	
	//* Page Orientation: Landscape (L) & Portrait (P)
	private $orientation='P';
	
	//* Paper Size: A4,A3, ...
	private $paperSize='A4';
	
	//* Language :en,fr ..
	private $langauge='en';
	
	//* Created File: this file for sudden dowload purpose
	private $currentFile;
	/* 
	Contructor : ob_start — Turn on output buffering
		This function will turn output buffering on. While output buffering 
		is active no output is sent from the script (other than headers), 
		instead the output is stored in an internal buffer.
	*/
	public function __construct() {
		ob_start();
	}
	/*
	setPage() Function to set the orientation & paper size of the specified PDF(output PDF)
	*/
	public function setPage($orientation='P',$paperSize='A4',$langauge='en'){
		$this->orientation	=	$orientation;
		$this->paperSize	=	$paperSize;
		$this->langauge		=	$langauge;
	}
	/*
	export() is the key function of the PDF library, To output the 
	*/
	public export($inputFile,$outputFile='output.pdf',$showOnBrowser=true)
	{
		$this->currentFile=$outputFile;
		$content = ob_get_clean();
		$content = file_get_contents(stripslashes($inputFile));
		try{
			$html2pdf = new HTML2PDF('P', 'A4', 'en');
			$html2pdf->writeHTML($content,isset($_GET['vuehtml']));
			if($showOnBrowser){
				$html2pdf->Output($outputFile);
			}
			else{
				$html2pdf->Output($outputFile,'F');
			}
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}
	}
	/*
	download() is the function to download the PDF file. 
	*/
	function download(){
		header('Content-disposition: attachment; filename='.$this->currentFile);
		header('Content-type: application/pdf');
		readfile($this->currentFile);
	}
}
?>