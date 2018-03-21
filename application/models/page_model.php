<?php if ( ! defined('BASEPATH')) exit('Access Denied...');



class Page_model extends CI_Model {

	protected $table='pages';

	protected $key = 'id';

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

	

	public function get_all($filter=null){

		if(isset($filter))extract($filter);

		$filter = array(

			'limit'=>9999,

			'start'=>0,

			'order_by'=>'date_added DESC',//add comma for multiple order by..

			'fields'=>'*',

			'status'=>null

		);

		

		extract($filter,EXTR_SKIP);

		

		$this->db->select($fields);

		

		if(isset($status)){

			$statuses = $status;

			if(count($statuses = explode(",",$status))){

				foreach($statuses as $key=>$status){

					switch($status){

						case 'publish': $statuses[$key] = 1; break;

						case 'draft': $statuses[$key] = 1; break;

						case 'trash': $statuses[$key] = 1; break;

					}

				}

			}

			$this->db->where_in('status',$statuses);

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

	

	public function is_exists($key,$options=null){

		$this->db->select('id');

		$this->db->where(isset($options)?$options:$this->key,$key);

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


	public function search($keyword)
	{
	    $this->db->like('content',$keyword, 'both');
	    $dataset=$this->db->get($this->table);
		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}


	

}