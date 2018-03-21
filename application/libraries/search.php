<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Search {
	protected $ci;
	
    function __construct()
    {
        $this->ci =& get_instance();
    }
	
	function query($query){
		$query = trim($query);
		if(is_numeric($query)){
			$this->ci->db->select('*, states.name as state_name, cities.name as city_name, cities.slug as city_slug');
			$this->ci->db->join('states', 'states.abbr = cities.state', 'left');
			$this->ci->db->like('zip_code', $query);
			$dataset = $this->ci->db->get('cities');
			if($dataset->num_rows()>0){			
				//debug($dataset->result());
				return $dataset->result();
			}else{
				return 0;	
			}
		}else{
			$terms = explode(',', $query);
			if(count($terms)==1){
				$this->ci->db->select('*, states.name as state_name, cities.name as city_name, cities.slug as city_slug');
				$this->ci->db->join('states', 'states.abbr = cities.state', 'left');
				$this->ci->db->like('states.name', $terms[0]);
				$this->ci->db->or_like('cities.name', $terms[0]);
				$this->ci->db->or_like('state', $terms[0]);
				$dataset = $this->ci->db->get('cities');
				if($dataset->num_rows()>0){			
					//debug($dataset->result());
					return $dataset->result();
				}else{
					return 0;	
				}
			}else{
				$states=array();
				
					$datos = array();
				foreach($terms as $term){
					$term = trim($term);
					$sql = "SELECT `states`.`abbr` FROM `cities` LEFT JOIN `states` ON cities.state=states.abbr WHERE states.name LIKE '%$term%' OR abbr='$term' GROUP BY abbr";
					$dataset = $this->ci->db->query($sql);
					$dataset = $dataset->result();	
					//debug($dataset);
					foreach($dataset as $data){
						$states[] = $data->abbr;						
					}
					foreach($terms as $term){
						foreach($states as $state){
							$sql2 = "SELECT *, states.name as state_name, cities.name as city_name, cities.slug as city_slug FROM `cities` LEFT JOIN  `states` ON cities.state=states.abbr  WHERE `state`='$state' AND `cities`.`name` LIKE '%$term%' GROUP BY `cities`.`name`";
							$dataset2 = $this->ci->db->query($sql2);
							foreach($dataset2->result() as $record){
								$datos[] = $record;
							}							
						}
					}
				}
				//d($datos);
				return $datos;
			}
		}
	}
	
}