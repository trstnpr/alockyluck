<?php
	$default_page_layout=$this->config_model->get('default_post_layout');
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
				<div class="large-8 columns"><h4>Add New Post</h4></div>
				<div class="large-4 columns" style="text-align: right">
				</div>
			</div>
			<hr>
			<?php if($response=$this->session->flashdata('message')): ?>
				<div data-alert class="alert-box <?php echo $response['type'] ?>">
				  <?php echo $response['message'] ?>
				  <a href="#" class="close">&times;</a>
				</div>
			<?php endif;?>
			<form action="<?php echo base_url('admin/post/add/') ?>" method="POST" class="custom">
			<div class="row">
				<div class="large-8 columns"><label>Title</label><input type="text" value="" name="title" placeholder="Page Title" /></div>
				<div class="large-4 columns">
					<div class="row">
						<div class="large-6 columns"><label>Author</label><input type="text" value="" name="creator" placeholder="Author" /></div>
						<div class="large-6 columns"><label>Status</label>
							<select id="status" name="status">
								<option value="1">Publish</option>
								<option value="2">Draft</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="large-8 columns"><label>Slug</label><input type="text" value="" name="slug" placeholder="Slug" /></div>
				<div class="large-4 columns"><label>Layout</label><input type="text" value="<?php echo $default_page_layout ?>" name="layout" placeholder="Layout" /></div>
				
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
					<?php /* ?>
					<label>Created</label>
					<div class="row">
						<div class="large-7 columns"><input type="date" value="" name="created_date"/></div>
						<div class="large-5 columns"><input type="time" value="" name="created_time"/></div>
					</div>
					<label>Last Update</label>
					<div class="row">
						<div class="large-7 columns"><input type="date" value="" name="updated_date"/></div>
						<div class="large-5 columns"><input type="time" value="" name="updated_time"/></div>
					</div>
					<?php */ ?>
				</div>
				
				<div class="large-12 columns">
					<label>Content</label>
					<?php echo $this->ckeditor->editor("content"); ?></br>
				</div>
				
				<div class="large-12 columns">
					<label>Meta Title</label>
					<input type="text" value="" name="meta_title" placeholder="Meta Title" />
					<label>Meta Keywords</label>
					<input type="text" value="" name="meta_keywords" placeholder="Meta keywords" />
					<label>Meta Description</label>
					<textarea name="meta_description" placeholder="Meta Description" ></textarea>
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
