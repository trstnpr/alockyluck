<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class Config_model extends CI_Model {
	protected $table='options';
	protected $key = 'key';
    function __construct()
    {
        parent::__construct();
    }
	
	public function get($key){
		$this->db->where($this->key,$key);
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			$dataset = $dataset->row();
			return $dataset->value;
		}else{
			return "";
		}
	}
	
	public function get_all(){
		$this->db->order_by('key','DESC');
		$dataset=$this->db->get($this->table);
		
		return $dataset->result();
	}
	
	public function set_option($key,$value,$label=null){
		if($this->is_key_exists($key)){
			$data['value']=$value;
			return $this->update_option($key,$data);
		}else{
			return $this->add_option($key,$value);
		}
	}
	
	public function add_option($key,$value,$label=null){
		$data=array(
			'key'=>$key,
			'value'=>$value,
			'label'=>$label
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function update_option($key,$data){
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	/**
     * Check option key if it is exists
     * @param string $key 
     * @return TRUE the keys already exists
     * @return FALSE key not exists 
     */
	public function is_key_exists($key){
		$this->db->select('key');
		$this->db->where($this->key,$key);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}