<?php
	$state = $this->app->cdata("state_data");
?>
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
			
			<div class="row">
				<div class="large-8 columns"><h4>Edit State: <?php echo $state->name; ?></h4></div>
				<div class="large-4 columns" style="text-align: right">
					<a href="<?php echo base_url('admin/states/add') ?>" class="button tiny" style="margin-top: 3px" >Add New State</a>
				</div>
			</div>
			<hr style="margin-top:0">
			<div class="row">
				<!-- sidebar -->
				
				<!-- /sidebar -->
				<div class="large-12 columns">
					<?php if($response=$this->session->flashdata('message')): ?>
						<div data-alert class="alert-box <?php echo $response['type'] ?>">
						  <?php echo $response['message'] ?>
						  <a href="#" class="close">&times;</a>
						</div>
					<?php endif;?>
					<form action="<?php echo base_url('admin/states/edit/'.$state->abbr) ?>" method="POST">
					<div class="row">
						<div class="large-12 columns">
								<div class="row">
									<div class="large-12 columns"><label>Name</label><input type="text" value="<?php echo $state->name ?>" name="name" placeholder="State Name" /></div>
									<div class="large-8 columns"><label>Slug</label><input type="text" name="slug" value="<?php echo $state->slug ?>" /></div>
									<div class="large-4 columns"><label>Abbreviation</label><input disabled="disable" type="text" value="<?php echo $state->abbr ?>" /></div>
								</div>	
								
								<label>Content</label>
								<?php echo $this->ckeditor->editor("content",$state->content); ?>
							<br>
							<div style="text-align: right">
								<input type="submit" name="submit" value="Save Changes" class="button small">
							</div>
						</div>
					</div>
					</form>
					<hr>
					
					<?php $city_list = $this->city_model->get_by_state($state->abbr); ?>
					<?php if($city_list): ?>
			     	<h3>Cities of <?php echo $state->name; ?> 	(<?php echo count($city_list); ?>)</h3>
			     	<ul>
			     		<?php foreach($city_list as $city): ?>
					  		<li style="float: left; width: 25%;"><a href="<?php echo base_url('admin/cities/edit/'.$city->id) ?>"><?php echo $city->name ?></a></li>
					  	<?php endforeach; ?>
					</ul>
					<?php else: ?>
						<h3>No City for <?php echo $state->name ?></h3>
					<?php endif;?>
				</div>
				
				
			</div>
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
