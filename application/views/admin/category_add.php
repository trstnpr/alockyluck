<?php

	$default_page_layout=$this->config_model->get('default_page_layout');
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
					<div class="large-8 columns"><h4>Add New Category</h4></div>
				<hr>
					<div class="large-4 columns" style="text-align: right"></div>
				</div>

			<form action="<?php echo base_url('admin/category/add/') ?>" method="POST">

				<div class="large-12 columns">

					<?php if($response=$this->session->flashdata('message')): ?>
						<div data-alert class="alert-box <?php echo $response['type'] ?>">
						  <?php echo $response['message'] ?>
						  <a href="#" class="close">&times;</a>
						</div>
					<?php endif;?>

					<div class="row">
						<div class="large-12 columns">
							<label>Title</label>
							<input type="text" value="" name="label" id="label" placeholder="Category Title" />

							<label>Permalink</label>
							<input type="text" value="" name="permalink" id ="permalink" placeholder="Permalink" />

							<label>Content</label>
								<?php echo $this->ckeditor->editor("content"); ?>
							<br>

							<div style="text-align: right">
								<input type="submit" name="submit" value="Save Changes" class="button small">
							</div>
						</div>
					</div>
					<!-- /content-->

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
			</form>
		</div>
	</div>

<?php $this->admin_template->phtml('footer') ?>

</body>

</html>

