<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>
	<?php $this->admin_template->phtml('header'); ?>
	<div class="row">
		<div class="large-12 columns">
			<!-- content -->
			<h3>Importing Cities...</h3>
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
				    	$cdata['id']=$data[0];
				    	$cdata['name']=$data[1];
				    	$cdata['state']=$data[2];
				    	$cdata['description']=$data[3];
				    	$cdata['phone']=$data[4];
				    	$cdata['area_code']=$data[5];
				    	$cdata['zip_code']=$data[6];
				    	$cdata['slug']=slugify($data[1]);
						if(!$that->city_model->is_exists($cdata['id'])){
							if($that->city_model->insert($cdata)){
					    		echo "<strong>(Row: $row) </strong><span  style='color: green'>Success importing: </span>{$cdata['name']}. Slug set to `{$cdata['slug']}`.<br><hr style='margin: 2px'>";
					    		$success_ctr++;
							}else{
					    		echo "<strong>(Row: $row) </strong><span style='color: #99000'>failed  importing: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
					    		$failed_ctr++;
							}
						}else{
							echo "<strong>(Row: $row) </strong><span style='color: blue'>Duplicate Key: </span>{$cdata['name']}<br><hr style='margin: 2px'>";
							$duplicate_ctr++;
						}
				    	
				    	$row++;
				    }
				    fclose($handle);
					echo "<hr>";
					echo "<strong> ".$success_ctr."</strong> successfull imported records.<br>";
					echo "<strong> ".$duplicate_ctr."</strong> duplicated records.<br>";
					echo "<strong> ".$failed_ctr."</strong> failed importing records.<br>";
					
				}

			?>
			<div class="panel">
				Cleaning table records...Removing record with no name... Removing unwanted name like `city`...<br>
				<?php 
					$r = $that->city_model->clean();
					echo "Current Record Count: ".$that->city_model->count();
				?>
			</div>
			<?php

			} else {
				//error..
				$data = array('error' => $that->upload->display_errors());
				d($data['error']);
			}
			
			//d($data,"data");
			
			
			
			?>
			</br>
			
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
