	<div class="row">
		<div class="large-12 columns">
			<!-- content -->
			<h3>Setting Phone numbers to Area Codes</h3>
			<hr>
			<?php
			$that=&get_instance();
			$that->load->library('upload');
			$that->load->model('city_model');
			$config['upload_path'] = FCPATH.'csv/'; 
			$config['allowed_types'] = 'csv';
			$config['max_size']=51200;
			$that->upload->initialize($config);
			
			if($that->upload->do_upload('file')){
			    $data = $that->upload->data();
				$success_ctr=0;$duplicate_ctr=0;$failed_ctr=0;
				$row = 1;
				if (($handle = fopen($data['full_path'], "r")) !== FALSE) {
				    while (($data = fgetcsv($handle,0, ",")) !== FALSE) {
				    	$cdata['area_code']=$data[0];
				    	$cdata['phone_number']=$data[1];
				    	if($that->city_model->update_area_phone($cdata['area_code'],$cdata['phone_number'])){
				    		$cities = $that->city_model->get_by_area_code($cdata['area_code'],array('fields'=>'name,area_code,phone'));
							if($cities){
								foreach($cities as $city){
									echo "Success settting phone number for <strong>".$city->name."</strong> with area code of <strong>".$city->area_code."</strong> is set to <strong>".$city->phone."</strong><br>";
								}
							}
				    	}else{
				    		echo "Failed setting phone number for area code with ".$cdata['area_code']. "(Phone number:".$cdata['phone_number']." )<br>";
				    	}
				    }
				    fclose($handle);
				}

			?>
			
			<?php

			} else {
				//error..
				$data = array('error' => $that->upload->display_errors());
				d($data['error']);
			}
			?>