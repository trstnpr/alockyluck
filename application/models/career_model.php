<?php
class career_model extends CI_Model{
function __construct() {
parent::__construct();
}
function career_form_insert($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('career', $data);
}
}
?>