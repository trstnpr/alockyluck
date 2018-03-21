<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class Article_model extends CI_Model {
	protected $table='articles';
	protected $key = 'id'; 
    function __construct()
    {
        parent::__construct();
    }
	
	public function count($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'status'=>null
		);
		
		extract($filter,EXTR_SKIP);
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		
		return $this->db->count_all_results($this->table);
	}
	
	public function get($key,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'fields'=>'*',
			'key_by'=>$this->key,
			'status'=>null
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);
		$this->db->where($key_by,$key);
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			return $dataset->row();
		}else{
			return FALSE;
		}
	}
	
	public function get_all($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC, id DESC',//add comma for multiple order by..
			'fields'=>'*',
			'status'=>null,
			'category'=>null
		);
		
		extract($filter,EXTR_SKIP);
		
		$this->db->select($fields);

		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}

		if(isset($category)){
			//$statuses = explode(",",$status);
			$this->db->where_in('category',$category);
		}
		
		$order_by = explode(',',$order_by);
		
		foreach($order_by as $ob){
			$ob = rtrim($ob," "); 
			$ob = ltrim($ob," "); 
			$obs = explode(" ",$ob);
			
			$this->db->order_by($obs[0],$obs[1]);	
		}
		
		$dataset=$this->db->get($this->table,$limit,$start);
		
		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
		
	}

	public function get_all_articles_with_tags($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC',//add comma for multiple order by..
			'fields'=>'*',
			'tag'=>null,
			'status'=>null
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);

		$tag = str_replace('-', ' ', $tag);

		if(isset($tag)){
			$this->db->like('tags',$tag, 'both');
		}

		$order_by = explode(',',$order_by);

		foreach($order_by as $ob){
			$obs = explode(" ",$ob);
			$this->db->order_by($obs[0],$obs[1]);	
		}

		$dataset=$this->db->get($this->table);

		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}
	public function get_all_articles_with_categories($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC',//add comma for multiple order by..
			'fields'=>'*',
			'category'=>null,
			'status'=>null
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);

		$category = str_replace('-', ' ', $category);

		if(isset($category)){

			$this->db->where('category', $category);
			$this->db->or_where("(category LIKE '%,{$category}' OR category LIKE '{$category},%' OR category LIKE '%,{$category},%' )");

		}

		$order_by = explode(',',$order_by);

		foreach($order_by as $ob){
			$obs = explode(" ",$ob);
			
			$this->db->order_by($obs[0],$obs[1]);	
		}

		$dataset=$this->db->get($this->table);

		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}




	public function get_by($data, $key,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'fields'=>'*',
			'key_by'=>$key,
			'status'=>null
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);
		$this->db->where($key_by,$data);
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			return $dataset->row();
		}else{
			return FALSE;
		}
	}
	
	
	public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}
	
	public function update($key,$data){
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function is_exists($value, $key=NULL,$options=NULL){
		if(isset($options))extract($options);
		$options = array(
		);
		extract($options,EXTR_SKIP);
		
		$this->db->select('id');
		$this->db->where(isset($key)?$key:$this->key,$value);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	

	public function trash($key){
		$return_flag=1;
		if($this->is_exists($key)){
			//$return_flag = $this->update($key, array('status'=>3));
			$return_flag = $this->db->delete($this->table, array('id' => $key));
		}else{
			$return_flag = -1;
		}
		return $return_flag;
	}
	
}