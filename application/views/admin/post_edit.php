<?php
	$default_page_layout=$this->config_model->get('default_page_layout');
	$record = $this->app->cdata('record');
	$created = date_create($record->created);
	$updated = date_create($record->updated);
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
			<div class="row">
				<div class="large-8 columns"><h4>Edit Post</h4></div>
				<div class="large-4 columns" style="text-align: right">
					<a href="<?php echo base_url('admin/post/trash/'.$record->id) ?>" class="button tiny" onclick="return confirm('Are you sure to delete?')">Delete</a>	
					<a href="<?php echo base_url($record->slug) ?>" class="button tiny">View</a>	
					<a href="<?php echo base_url('admin/post/add') ?>" class="button tiny">Add New</a>	
				</div>
			</div>
			<hr>
			<?php if($response=$this->session->flashdata('message')): ?>
				<div data-alert class="alert-box <?php echo $response['type'] ?>">
				  <?php echo $response['message'] ?>
				  <a href="#" class="close">&times;</a>
				</div>
			<?php endif;?>
			<form action="<?php echo base_url('admin/post/edit/'.$record->id) ?>" method="POST" class="custom">
			<div class="row">
				<div class="large-8 columns"><label>Title</label><input type="text" value="<?php echo $record->title ?>" name="title" placeholder="Post Title" /></div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-6 columns"><label>Author</label><input type="text" value="<?php echo $record->creator ?>" name="creator" placeholder="Author" /></div>
						<div class="large-6 columns"><label>Status</label>
							<?php echo form_dropdown('status',$statusses,$record->status) ?>
						</div>
					</div>
				</div>
				
				<div class="large-8 columns"><label>Slug</label><input type="text" value="<?php echo $record->slug ?>" name="slug" placeholder="Slug" /></div>
				<div class="large-4 columns"><label>Layout</label><input type="text" value="<?php echo $record->layout ?>" name="layout" placeholder="Layout" /></div>
				
				<div class="large-4 columns cat-holder">
					<label>Categories</label>
					<input type="hidden" name="categories[]" />
					<div class="display-dd">
						<ul class="inline-tags">
							<li><a class="item">General</a><a class="close-reveal-modal">×</a></li>
						</ul>
					</div>
					<div class="row collapse">
				        <div class="small-9 columns">
				          <input type="text" name="ccat" id="ccat" placeholder="category" class="">
				        </div>
				        <div class="small-3 columns">
				          <a href="#" class="button prefix secondary">Add</a>
				        </div>
				    </div>
				</div>
				<div class="large-4 columns tag-holder">
					<label>Tags</label>
					<input type="hidden" name="tags[]" />
					<div class="display-dd"></div>
					<div class="row collapse">
				        <div class="small-9 columns">
				          <input type="text" name="ctag" id="ctag" placeholder="tag" class="">
				        </div>
				        <div class="small-3 columns">
				          <a href="#" class="button prefix secondary">Add</a>
				        </div>
				    </div>
				</div>
				
				<div class="large-4 columns">
					<label>Created</label>
					<div class="row">
						<div class="large-7 columns"><input type="date" value="<?php echo date_format($created,'Y-m-d') ?>" name="created_date"/></div>
						<div class="large-5 columns"><input type="time" value="<?php echo date_format($created,'H:i') ?>" name="created_time"/></div>
					</div>
					<label>Last Update</label>
					<div class="row">
						<div class="large-7 columns"><input type="date" value="<?php echo date_format($updated,'Y-m-d') ?>" name="updated_date"/></div>
						<div class="large-5 columns"><input type="time" value="<?php echo date_format($updated,'H:i') ?>" name="updated_time"/></div>
					</div>
				</div>
				
				<div class="large-12 columns">
					<label>Content</label>
					<?php echo $this->ckeditor->editor("content",$record->content); ?></br>
				</div>
				
				<div class="large-12 columns">
					<label>Meta Title</label>
					<input type="text" value="<?php echo $record->meta_title ?>" name="meta_title" placeholder="Meta Title" />
					<label>Meta Keywords</label>
					<input type="text" value="<?php echo $record->meta_key ?>" name="meta_keywords" placeholder="Meta keywords" />
					<label>Meta Description</label>
					<textarea name="meta_description" placeholder="Meta Description" ><?php echo $record->meta_description	 ?></textarea>
					<div style="text-align: right">
						<br>
						<input type="submit" name="submit" value="Save Changes" class="button small">
					</div>
				</div>
				
			</div>
			</form>
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
