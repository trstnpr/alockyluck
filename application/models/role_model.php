<?php

	class Role_model extends CI_Model {
	    protected $table = 'roles';
		protected $key = 'id';

	    function __construct() {
	        parent::__construct();
	    }

		public function get_admin_from_role($role) {
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id', $role);
			if($role == 1) {
				return $this->db->get()->row();
			} else {
				return false;
			}
		}

		public function get_user_from_role($role) {
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id', $role);
			if($role == 2) {
				return $this->db->get()->row();
			} else {
				return false;
			}
		}
	}