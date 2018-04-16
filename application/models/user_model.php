<?php
class User_model extends CI_Model {

    protected $table = 'users';
	protected $key = 'id';

    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
		return $this->db->get($this->table)->result();
	}

    public function resolve_user_login($email, $password) {
    	$this->db->select('password');
		$this->db->from($this->table);
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		return $this->db->get()->row();
    }

    public function get_user_id_from_email($email) {
		$this->db->where('email', $email);
		return $this->db->get($this->table)->row('id');
	}

	public function get_user($user_id) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
	}

    public function add_user($data) {
    	$data['password'] = md5($data['password']);
    	$data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
	}

	public function email_check($data) {
		$this->db->where('email', $data);
		$dataset = $this->db->get($this->table);
		if($dataset->num_rows()){
			return $dataset->result();
		} else {
			return FALSE;
		}
	}

	public function update_user($id, $data) {
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function update_password($id, $data) {
		$data['updated_at'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}
}