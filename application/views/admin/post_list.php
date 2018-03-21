<?php
	$records = $this->app->cdata('records');
	$statusses=array(1=>'Publish',2=>'Draft');
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
			
			<div style="text-align: right">
				<a href="<?php echo base_url('admin/post/add') ?>" class="button tiny">Add New</a>
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
						<td>Post Title</td>
						<td>Created</td>
						<td>Last Update</td>
						<td>Status</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php 
					if($records)://--1
					foreach($records as $record): 
					$edit_link = base_url('admin/post/edit/'.$record->id);
					$view_link = base_url($record->slug);
					$del_link = base_url('admin/post/trash/'.$record->id);
					$created = date_create($record->created);
					$updated = date_create($record->updated);
					?>
					<tr>
						<td><a href="<?php echo $edit_link;  ?>"><?php echo $record->title ?></a></td>
						<td><a href=""><?php echo date_format($created, 'F j, Y') ?></a></td>
						<td><a href=""><?php echo date_format($updated, 'F j, Y @ g:i a') ?></a></td>
						<td><a href=""><?php echo $statusses[$record->status] ?></a></td>
						<td width="130px">
							<ul class="inline-list" style="font-size: 11px">
							  <li><a href="<?php echo $view_link;  ?>">View</a></li>
							  <li><a href="<?php echo $edit_link;  ?>">Edit</a></li>
							  <li><a href="<?php echo $del_link;  ?>" onclick="return confirm('Are you sure to delete?')">Delete</a></li>
							</ul>
						</td>
					</tr>
					<?php endforeach; endif; //--1?>
				</tbody>
			</table>
			<?php echo $this->app->cdata('records_pagingation') ?>
			
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
