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
				<div class="large-8 columns"><h4>Add State</h4></div>
				<div class="large-4 columns" style="text-align: right">
					<a href="<?php echo base_url('admin/page/add') ?>" class="button tiny" style="margin-top: 3px" >Add New State</a>
				</div>
			</div>
			<hr style="margin-top:0">
			<div class="row">
				<!-- sidebar -->
				<div class="large-3 columns">
					
				</div>
				<!-- /sidebar -->
				<div class="large-12 columns">
					<?php if($response=$this->session->flashdata('message')): ?>
						<div data-alert class="alert-box <?php echo $response['type'] ?>">
						  <?php echo $response['message'] ?>
						  <a href="#" class="close">&times;</a>
						</div>
					<?php endif;?>
					<form action="<?php echo base_url('admin/states/add') ?>" method="POST">
					<div class="row">
						<div class="large-12 columns">
								
								<div class="row">
									<div class="large-12 columns"><label>Name</label><input type="text" value="" name="name" placeholder="State Name" /></div>
									<div class="large-8 columns"><label>Slug</label><input type="text" name="slug" value="" /></div>
									<div class="large-4 columns"><label>Abbreviation</label><input type="text" value="" /></div>
								</div>
								
								<label>Content</label>
								<?php echo $this->ckeditor->editor("content"); ?>
							<br>
							<div style="text-align: right">
								<input type="submit" name="submit" value="Save" class="button small">
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
