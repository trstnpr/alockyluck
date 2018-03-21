<?php if ( ! defined('BASEPATH')) exit('Access Denied...');



class Post_model extends CI_Model {

	protected $table='posts';

	protected $key = 'id';

    function __construct()

    {

        parent::__construct();

    }

	public function count(){

		return $this->db->count_all_results($this->table);

	}

	public function get($id,$filter=null){

		if(isset($filter))extract($filter);

		$filter = array(

			'fields'=>'*',

			'primary_key'=>$this->key,

			'status'=>null

		);

		extract($filter,EXTR_SKIP);

		$this->db->select($fields);

		$this->db->where($primary_key,$id);

		

		if(isset($status)){

			$statuses = $status;

			if(count($statuses = explode(",",$status))){

				foreach($statuses as $key=>$status){

					switch($status){

						case 'trash': $statuses[$key] = 0; break;

						case 'publish': $statuses[$key] = 1; break;

						case 'draft': $statuses[$key] = 2; break;

					}

				}

			}

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

			'limit'=>99999,

			'start'=>0,

			'order_by'=>'created DESC,id DESC',//add comma for multiple order by..

			'fields'=>'*',

			'status'=>null,

			'category'=>null

		);

		

		extract($filter,EXTR_SKIP);

		

		$this->db->select($fields);

		

		if(isset($status)){

			$statuses = $status;

			if(count($statuses = explode(",",$status))){

				foreach($statuses as $key=>$status){

					switch($status){

						case 'trash': $statuses[$key] = 0; break;

						case 'publish': $statuses[$key] = 1; break;

						case 'draft': $statuses[$key] = 2; break;

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

		

		$dataset=$this->db->get($this->table,$limit,$start);

		

		if($dataset->num_rows()){

			return $dataset->result();

		}else{

			return FALSE;

		}

		

	}

	

	public function insert($data){

        if($this->db->insert($this->table, $data)){

        	return $this->db->insert_id();

        }else{

        	return false;

        }

	}

	

	public function update($key,$data){

		$this->db->where($this->key,$key);

        if($this->db->update($this->table,$data)){

            return true;

        }else{

            return false;

        }

	}

	

	public function is_key_exists($key){

		$this->db->select('id');

		$this->db->where($this->key,$key);

		$dataset=$this->db->get($this->table);

		if($dataset->num_rows()==1){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	public function is_exists($id,$key){

		$this->db->select('id');

		$this->db->where(isset($key)?$key:$this->key,$id);

		$dataset=$this->db->get($this->table);

		if($dataset->num_rows()==1){

			return TRUE;

		}else{

			return FALSE;

		}

	}

	

	/**

     * Delete record in the database

     * @param string $id 

     * @return 1 success

     * @return 0 failed 

     * @return -1 not exists

     * @return 1 success delete

     */

	public function trash($id){

		$return_flag=1;

		if($this->is_key_exists($id)){

			$return_flag = $this->db->delete($this->table, array('id' => $id));

		}else{

			$return_flag = -1;

		}

		return $return_flag;

	}


public function search($keyword)
{
    $this->db->like('item_name',$keyword);
    $query  =   $this->db->get('bracelets');
    return $query->result();
}
	

}