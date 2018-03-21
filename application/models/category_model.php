<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class Category_model extends CI_Model {
	protected $table='categories';
	protected $key = 'id';
    function __construct()
    {
        parent::__construct();
    }
	
	public function count($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'status'=>null,
			'type'=>'category'
		);
		
		extract($filter,EXTR_SKIP);
		
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		
		if(isset($type)){
			$this->db->where('type',$type);
		}
		return $this->db->count_all_results($this->table);
	}
	
	public function get_title($id,$default='root'){
		$record = $this->get($id,array('fields' => 'label'));
		
		if(isset($record->label)){
			return $record->label;
		}else{
			return $default;
		}
	}
	
	public function get($id,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'fields'=>'*',
			'key'=>null,
			'status'=>null
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);
		
		
		if(isset($key)){
			$this->db->where($key,$id);
		} else {
			$this->db->where($this->key,$id);
		}
		
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
	
	public function get_field($id,$field='label'){
		
		$this->db->select("$field");
		$this->db->where($this->key,$id);
		
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			return $dataset->row()->$field;
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
			'show'=>null,
			'type'=>'category',
			'group'=>null,
			'id'=>null,
			'categories'=>null,
			'parent'=>null
		);
		
		extract($filter,EXTR_SKIP);
		
		$this->db->select($fields);

		if(isset($parent)){
			//$statuses = explode(",",$status);
			$this->db->where_in('parent',$parent);
		}
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		if(isset($show)){
			$shows = explode(",",$show);
			$this->db->where_in('show',$shows);
		}
		
		if(isset($type)){
			$this->db->where('type',$type);
		}
		if(isset($group)){
			$this->db->where('group',$group);
		}
		if(isset($id)){
			$id = explode(",",$id);
			$this->db->where_in('id',$id);
		}
		if(isset($categories) && !empty($categories) && is_array($categories)){
			foreach ($categories as $category ) {
				$this->db->or_where('id', $category);
			}
		} elseif(isset($categories) && !empty($categories) ) {
			$this->db->or_where('id', $categories);
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
	
	public function insert($data){
		$this->load->helper('date'); 
		$data['created'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}
	
	public function update($key,$data){
		$this->load->helper('date'); 
		$data['updated'] = date('Y-m-d H:i:s');
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function is_exists($value,$key=NULL,$options=NULL){
		if(isset($options))extract($options);
		$options = array(
		);
		extract($options,EXTR_SKIP);
		
		$this->db->select('id');
		$this->db->where(isset($key)?$key:$this->key,$value);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function delete($id){
		return $this->db->delete($this->table, array($this->key => $id)); 
	}
	
	
	public function trash($id,$status='trash'){
		$data = array('status'=>$status);
		$this->db->where($this->key,$id);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function untrash($id,$status='publish'){
		$data = array('status'=>$status);
		$this->db->where($this->key,$id);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function get_my_parent($id){
		
	}
	
	
	public function get_children($parent_id, $filter=null ){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC, id DESC',//add comma for multiple order by..
			'fields'=>'*',
			'status'=>null
		);
		
		extract($filter,EXTR_SKIP);
		
		$this->db->select($fields);
		
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		$this->db->where('parent' , $parent_id);
		
		
		
		
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
	
	public function get_child($id,$filter){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC, id DESC',//add comma for multiple order by..
			'fields'=>'*',
			'status'=>null
		);
		
		
		$this->db->select($fields);
		$this->db->where('parent',$id);
	}
	
	
	public function get_sub($id,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'created DESC, id DESC',//add comma for multiple order by..
			'fields'=>'*',
			'status'=>null,
			'recursive'=>FALSE
		);
		extract($filter,EXTR_SKIP);	
		$this->db->select($fields);
		$this->db->where('parent',$id);
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
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
			$categories = $dataset->result();
			
			foreach($categories as $category){
				if($count = $this->count_children($category->id)){
					$category->children = $this->get_sub($category->id);
				}
			}
			return $categories;
		}else{
			return FALSE;
		}
	}
	
	public function count_children($id,$options=null){
		if(isset($options))extract($options);
		$options = array(
			'level'=>1,
			'status'=>null,
			'type'=>null,
			'group'=>null
		);
		extract($options,EXTR_SKIP);
		$this->db->select('id');
		
		if(isset($status)){
			$statuses = explode(",",$status);
			$this->db->where_in('status',$statuses);
		}
		
		if(isset($group)){
			$this->db->where('group' , $group);
		}
		
		$this->db->where('parent' , $id);
		
		$dataset=$this->db->get($this->table);
		return $dataset->num_rows();
	}
	
	public function get_featured_image($id){
		$this->db->select('featured_image');
		$this->db->where('id',$id);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()>0){
			 return $dataset->row()->featured_image;
		}else{
			return null;
		}
	}
	
	public function get_id_using_permalink($permalink){
		$this->db->select('id');
		$this->db->where('permalink',$permalink);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()>0){
			 return $dataset->row()->id;
		}else{
			return null;
		}
	}
}