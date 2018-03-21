<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App{
	
	protected $data;
	protected $ci;
	protected $cdata;
	
	function __construct(){
		$this->ci =& get_instance();
		//load libraries..
		$this->ci->load->library('template');
		$this->ci->load->model('config_model');
		$this->ci->load->library('user_agent');
		
		/*		 * if($this->ci->agent->is_mobile()){			$data['theme_name']='mobile-'.$this->ci->config_model->get('theme');// make it autofetch in database..		}else{			$data['theme_name']=$this->ci->config_model->get('theme');// make it autofetch in database..		}		 */		 		 		$data['theme_name']=$this->ci->config_model->get('theme');// make it autofetch in database..
		
		$data['theme']='themes/'.$data['theme_name'].'/';
		$data['theme_uri']=base_url('/assets/themes/'.$data['theme_name']."/");
		$data['theme_app_path']=FCPATH."application/views/themes/".$data['theme_name'].'/';
		$data['theme_asset_path']=FCPATH."assets/themes/".$data['theme_name'].'/';
		//d($data);
		$this->data = $data;
		
		$this->add_meta('keywords', $this->ci->config_model->get('meta_keywords'));
		$this->add_meta('description', $this->ci->config_model->get('meta_descriptions'));
	}	   	
	public function meta(){
		return $this->cdata['meta'];
	}
	
	public function render_meta_tags($echo=true){
		if($this->cdata['meta']){
			$return="";
			foreach($this->cdata['meta'] as $meta){
				$return.="<meta name='{$meta['name']}' content='{$meta['content']}'>";
			}
			
			if($echo)
				echo $return;
			else
				return $return;
		}
	}
	
	public function add_meta($name, $content){
		$this->cdata['meta'][]=array('name'=>$name,'content'=>$content);
	}
	
	public function data($key,$options=null){
		return isset($this->data[$key])?array_to_object($this->data[$key]):"";
	}
	public function data_all(){
		return $this->data;
	}
	public function set_data($key,$value){
		$this->data[$key]=$value;
		return array_to_object($this->data[$key]);
	}
	
	public function del_data($key){
		if(isset($this->data[$key])){
			unset($this->data[$key]);
		}
	}
	
	public function set_cdata($key,$value){
		$this->cdata[$key] = null;
		$this->cdata[$key]=$value;
		return array_to_object($this->cdata[$key]);
	}
	
	public function cdata_all(){
		return array_to_object($this->cdata);
	}
	
	public function del_cdata($key,$value){
		if(isset($this->cdata[$key])){
			unset($this->data[$key]);
		}
	}
	
	public function cdata($key,$options=null){
		return isset($this->cdata[$key])?array_to_object($this->cdata[$key]):"";
	}
	
	function theme_uri($pathFile=null){
		return $this->data('theme_uri').'/'.$pathFile;
	}

	function admin_theme_uri($pathFile=null){
		return base_url('assets/admin/'.$pathFile);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */