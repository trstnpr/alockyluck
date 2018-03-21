<?php

	$page = $this->app->cdata("category_data");
	//$default_page_layout=$this->config_model->get('default_page_layout');
	$category = $this->app->cdata("category_data");
	//$default_page_layout=!empty($category->layout)?$category->layout:$this->config_model->get('default_page_layout');
	$article_layout = $this->config_model->get('default_page_layout')?$this->config_model->get('default_page_layout'):"page.php";
	//$templates = get_templates(array('return_type'=>'drop_down_list'));
    $current_layout = isset($category->layout)?$category->layout:$this->config_model->get('default_page_layout');
	//$created = new DateTime($category->created);
	//$updated = new DateTime(isset($category->updated) ? $category->updated : $category->created);
	$categories = get_main_categories();
?>

<!DOCTYPE html>

<!--[if IE 8]> 				 
<html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->

<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>

	<?php $this->admin_template->phtml('header'); ?>
	<div class="row">

		<div class="large-12 columns">
			<!-- content -->
			<div class="row">
				<div class="large-8 columns"><h4>Edit Category: <?php echo $page->label; ?></h4></div>
				<div class="large-4 columns" style="text-align: right">
					<a href="<?php echo base_url('admin/category/add') ?>" class="button tiny" style="margin-top: 3px" >Add New Category</a>
				</div>
			</div>

			<hr style="margin-top:0">

			<?php if($response=$this->session->flashdata('message')): ?>

				<div data-alert class="alert-box <?php echo $response['type'] ?>">
				  <?php echo $response['message'] ?>
				  <a href="#" class="close">&times;</a>
				</div>

			<?php endif;?>

			<form action="<?php echo base_url('admin/category/edit/'.$category->id) ?>" name="myForm" method="POST">
				<div class="row">
					<div class="large-12 columns">

						<label>Title</label>
						<input type="text" value="<?php echo $page->label ?>" name="label" id="label" placeholder="Page Title" />

						<label>Permalink</label>
						<input type="text" value="<?php echo $page->permalink ?>" name="permalink" id ="permalink" placeholder="Permalink" />

							<label>Description</label>
							<?php echo $this->ckeditor->editor("content",$page->description); ?>
							<br>
							<div style="text-align: right">
								<input type="submit" name="submit" value="Save Changes" class="button small" />
							</div>
							<script type="text/javascript">
								$(document).ready(function(){
								    $('#label').keyup(function(event) { 
								        var lower = $('input#label').val().toLowerCase();
								        var hyp = lower.replace(/ /g,"-");
								        $('input#permalink').val(hyp);
								    });
								});
							</script>
					</div>
				</div>
			</form>
			<!-- /content-->
		</div>
	</div>

<?php $this->admin_template->phtml('footer') ?>

</body>

</html>
























