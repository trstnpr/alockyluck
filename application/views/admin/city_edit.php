<?php
	$city = $this->app->cdata("city_data");
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
				<div class="large-8 columns"><h4>Edit City: <?php echo $city->name; ?></h4></div>
				<div class="large-4 columns" style="text-align: right">
					<a href="<?php echo base_url('admin/states/add') ?>" class="button tiny" style="margin-top: 3px; display: none" >Add New State</a>
				</div>
			</div>
			<hr style="margin-top:0">
			<div class="row">
				<div class="large-12 columns">
					<?php if($response=$this->session->flashdata('message')): ?>
						<div data-alert class="alert-box <?php echo $response['type'] ?>">
						  <?php echo $response['message'] ?>
						  <a href="#" class="close">&times;</a>
						</div>
					<?php endif;?>
					<form action="<?php echo base_url('admin/cities/edit/'.$city->id) ?>" method="POST">
					<div class="row">
						<div class="large-12 columns">
								<div class="row">
									<div class="large-9 columns"><label>City Name</label><input type="text" value="<?php echo $city->name ?>" name="name" placeholder="State Name" /></div>
									<div class="large-3 columns"><label>State Abbreviation</label><input  type="text" value="<?php echo $city->state ?>" name="state" /></div>
								</div>
								<div class="row">
									<div class="large-3 columns"><label>Slug</label><input type="text" value="<?php echo $city->slug ?>" name="slug" placeholder="slug" /></div>
									<div class="large-3 columns"><label>Area Code</label><input type="text" value="<?php echo $city->area_code ?>" name="area_code" placeholder="Area Code" /></div>
									<div class="large-6 columns"><label>Phone Number</label><input type="text" value="<?php echo $city->phone ?>" name="phone" /></div>
								</div>
								<label>Zip Codes</label>
								<textarea name="zip_codes" placeholder="Zip Codes"><?php echo $city->zip_code ?></textarea>
								<label>Description</label>
								<?php echo $this->ckeditor->editor("description",$city->description); ?>
							<br>
							<div style="text-align: right">
								<input type="submit" name="submit" value="Save Changes" class="button small">
							</div>
						</div>
					</div>
					</form>
				</div>
				
			</div>
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>