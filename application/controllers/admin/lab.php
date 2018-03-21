<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lab extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('app');
		$this->load->library('admin/admin_template');
		$this->load->library('admin/auth');
		$this->load->model('config_model');
	}
	
	public function index(){
		 echo $this->load->library('csvreader');
		 
		// echo FCPATH;
        $result =   $this->csvreader->parse_file(FCPATH.'csv/all.csv');
        $data['csvData'] =  $result;
		d($data);
	}
	
	public function readcsv(){
			$row = 1;
			if (($handle = fopen(FCPATH.'csv/all.csv', "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			        $num = count($data);
			        echo "<p> $num fields in line $row: <br /></p>\n";
			        $row++;
			        for ($c=0; $c < $num; $c++) {
			            //echo $data[$c] . "<br />\n";
			        }
			    }
			    fclose($handle);
			}
	}
	
}