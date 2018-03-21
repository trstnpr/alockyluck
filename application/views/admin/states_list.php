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
			
			<div style="text-align: right">
				<a href="<?php echo base_url('admin/states/truncate') ?>" class="button tiny del-all-records" style="display:	">Delete All Records</a>
				
				<a href="<?php echo base_url('admin/states/add') ?>" class="button tiny" style="display:none">Add New</a>
			</div>
			<?php if($response=$this->session->flashdata('message')): ?>
				<div data-alert class="alert-box <?php echo $response['type'] ?>">
				  <?php echo $response['message'] ?>
				  <a href="#" class="close">&times;</a>
				</div>
			<?php endif;?>
			
			<table style="width: 100%">
				<thead>
					<tr>
						<td>States</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					$states = $this->app->cdata('states');
					if($states):
					foreach($states as $state): 
					$edit_link = base_url('admin/states/edit/'.$state->abbr);
					$view_link = base_url($state->abbr);
					$del_link = base_url('admin/states/trash/'.$state->abbr);
					?>
					<tr>
						<td><a href="<?php echo $edit_link;  ?>"><?php echo $state->name ?></a></td>
						<td width="130px">
							<ul class="inline-list" style="font-size: 11px">
							  <li><a href="<?php echo $view_link;  ?>">View</a></li>
							  <li><a href="<?php echo $edit_link;  ?>">Edit</a></li>
							  <li><a href="<?php echo $del_link;  ?>">Delete</a></li>
							</ul>
						</td>
					</tr>
					<?php endforeach; endif;?>
				</tbody>
				<tfooter>
					<tr>
						<td colspan="10">
							Total: <?php echo $this->app->cdata('states_count'); ?>
						</td>
					</tr>
				</tfooter>
			</table>
			
			<?php echo $this->app->cdata('state_pagingation') ?>
			
			
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
