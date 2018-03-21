<?php

	$page = $this->app->cdata("page_data");

	$default_page_layout=$this->config_model->get('default_page_layout');

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

				<div class="large-8 columns"><h4>Edit Page: <?php echo $page->title; ?></h4></div>

				<div class="large-4 columns" style="text-align: right">

					<a href="<?php echo base_url('admin/page/add') ?>" class="button tiny" style="margin-top: 3px" >Add New Page</a>

				</div>

			</div>

			<hr style="margin-top:0">

			<?php if($response=$this->session->flashdata('message')): ?>

				<div data-alert class="alert-box <?php echo $response['type'] ?>">

				  <?php echo $response['message'] ?>

				  <a href="#" class="close">&times;</a>

				</div>

			<?php endif;?>

			<form action="<?php echo base_url('admin/page/edit/'.$page->id) ?>" method="POST">

			<div class="row">

				<div class="large-12 columns">

						<label>Title</label><input type="text" value="<?php echo $page->title ?>" name="title" placeholder="Page Title" />

						<div class="row">

							<div class="large-8 columns">

							<label>Slug</label><input type="text" value="<?php echo $page->slug ?>" name="slug" placeholder="Slug" />

						</div>

						<div class="large-4 columns">

							<label>Layout</label><input type="text" value="<?php echo is_null($page->layout)?$default_page_layout:$page->layout ?>" name="layout" placeholder="Layout" />

						</div>

						</div>

						<label>Content</label>

						<?php echo $this->ckeditor->editor("content",$page->content); ?>

					</br>

					<label>Meta Title</label>

					<input type="text" value="<?php echo $page->meta_title ?>" name="meta_title" placeholder="Meta title" />

					<label>Meta Keywords</label>

					<input type="text" value="<?php echo $page->meta_key ?>" name="meta_keywords" placeholder="Meta keywords" />

					<label>Meta Description</label>

					<textarea name="meta_description" placeholder="Meta Description" ><?php echo $page->meta_description ?></textarea>

					<div style="text-align: right">

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

