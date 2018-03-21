<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class State_model extends CI_Model {
	protected $table='states';
	protected $key = 'abbr';
    function __construct()
    {
        parent::__construct();
    }
	
	public function get($key,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'fields'=>'*',
			'key_by'=>$this->key
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);
		$this->db->where($key_by,$key);
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			return $dataset->row();
		}else{
			return FALSE;
		}
	}
	public function get_value($abbr,$fieldname){
		$record=$this->get($abbr,array('fields'=>$fieldname));
		return $record->$fieldname;
	}
	
	public function get_all($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'abbr ASC',//add comma for multiple order by..
			'fields'=>'*',
			'show_query'=>FALSE
		);
		
		extract($filter,EXTR_SKIP);
		
		$this->db->select($fields);
		
		$order_by = explode(',',$order_by);
		
		foreach($order_by as $ob){
			$obs = explode(" ",$ob);
			$this->db->order_by($obs[0],$obs[1]);
		}
		
		$dataset=$this->db->get($this->table,$limit,$start);
		
		if($show_query){d($this->db->last_query());}
		
		
		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}
	
	public function count(){
		return $this->db->count_all_results($this->table);
	}
	
	public function insert($data){
        return $this->db->insert($this->table, $data);
	}
	
	public function update($key,$data){
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function is_exists($key,$option=null){
		$this->db->select($this->key);
		$this->db->where(isset($option)?$option:$this->key,$key);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()==1){
			return TRUE;//yes it exists
		}else{
			return FALSE;//no it doesnt exists
		}
	}

	public function trash($key){
		$return_flag=1;
		if($this->is_exists($key)){
			$return_flag = $this->db->delete($this->table, array($this->key => $key));
		}else{
			$return_flag = -1;
		}
		return $return_flag;
	}
	public function truncate(){
		return $this->db->truncate($this->table); 
	}
	
}