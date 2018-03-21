<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends CI_Controller {
		
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
	}
	
	function backup_db(){
		$this->load->database();
		$this->load->helper('file');
		$this->load->dbutil();
		$backup =& $this->dbutil->backup();
		$file_name = date("F-j-Y g.i.s a");
		$file_name = "database backup $file_name.sql.gz";
		$success = write_file(FCPATH."application/views/maintenance/backup_database/$file_name", $backup);
		
		if($success){
			$data = array(
				'header'=>'Backup Database',
				'content'=>'<p>Success database backup</p><p>Filename: '.$file_name
			);
		}else{
			$data = array(
				'header'=>'Backup Database',
				'content'=>'<p>Failed database backup</p>'
			);
		}
		
		$this->load->view('maintenance/index',$data);
	}
	
	function install_db(){
		$this->load->helper('directory');
		$this->load->database();
		$this->load->helper('file');
		$this->load->dbutil();
		
		$dir = FCPATH."application/views/maintenance/datastructure.sql";
		if(file_exists($dir)){
			$backup =& $this->dbutil->backup();
			$file_name_date = date("F-j-Y g.i.s a");
			$file_name = "Auto install database backup $file_name_date.sql.gz";
			$success = write_file(FCPATH."application/views/maintenance/backup_database/$file_name", $backup);
			
			if($success){
				$response = "<p>Success db backup. This is to ensure you have a backup in case of any trouble.</p>";
			}
			
			$sql = file_get_contents($dir);
			
			$query_array = explode(";", $sql);
			foreach($query_array as $query){
				$s = $this->db->query($query);
				$response .= "<pre><p>".$query."</p></pre>";
			}
			
			
			
			$data = array(
				'header'=>'Installing Database Structure and Default Data',
				'content'=>$response
			);
		}else{
			$data = array(
			'header'=>'Datastructure not exists'
			);
		}
		$this->load->view('maintenance/index',$data);
	}
}