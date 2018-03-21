<?php
	$article = $this->app->cdata("article_data");
	$default_page_layout=$this->config_model->get('default_page_layout');
	$categories = get_main_categories();
?>

<!DOCTYPE html>

<!--[if IE 8]> 				 
<html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<style type="text/css">
	ul.main li {
	    list-style: none;
	    text-indent: 5px;
	}
	ul.main {
	    margin-bottom: 0px;
	    margin-top: 10px;
	}
</style>

<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>

	<?php $this->admin_template->phtml('header'); ?>

	<div class="row">

		<div class="large-12 columns">

				<!-- content -->
				<div class="row">
					<div class="large-8 columns"><h4>Add New Post</h4></div>
				<hr>
					<div class="large-4 columns" style="text-align: right"></div>
				</div>

			<form action="<?php echo base_url('admin/article/add/') ?>" method="POST">

				<div class="large-8 columns">


					<?php if($response=$this->session->flashdata('message')): ?>

						<div data-alert class="alert-box <?php echo $response['type'] ?>">

						  <?php echo $response['message'] ?>

						  <a href="#" class="close">&times;</a>

						</div>

					<?php endif;?>

					<div class="row">
						<div class="large-12 columns">
									<label>Post</label><input type="text" value="" name="title" id="title" placeholder="Post Title" />
							<div class="row">
								<div class="large-8 columns">
									<label>Slug</label><input type="text" value="" name="permalink" id ="slug" placeholder="Permalink" />
								</div>
								<div class="large-4 columns">
									<label>Layout</label><input type="text" value="<?php echo $default_page_layout ?>" name="layout" placeholder="Layout" />
								</div>
							</div>
							<label>Content</label>
								<?php echo $this->ckeditor->editor("content"); ?>
							<br>
							<label>Meta Title</label>
								<input type="text" value="" name="meta_title" placeholder="Meta title" />
							<label>Meta Keywords</label>
								<input type="text" value="" name="meta_keywords" placeholder="Meta keywords" />
							<label>Meta Description</label>
								<textarea name="meta_description" placeholder="Meta Description" ></textarea>
							<div style="text-align: right">
								<input type="submit" name="submit" value="Save Changes" class="button small" id="checkBtn">
							</div>

						</div>
					</div>
					<!-- /content-->

					<script type="text/javascript">
						$(document).ready(function(){
						    $('#title').keyup(function(event) { 
						        var lower = $('input#title').val().toLowerCase();
						        var hyp = lower.replace(/ /g,"-");
						        $('input#slug').val(hyp);
						    });
						});
					</script>

				</div>

				<div class="large-4 columns">
					<fieldset class="dd-fieldset">
						<label>Choose a Category</label>
						<div class="category-list">
							<?php 
							if($categories){ ?>
								<ul class="main">

								<?php foreach ($categories as $category) { ?>					
									<li><!-- <small class="error"></small> -->

									<input type="checkbox" name="category[]" value="<?php echo $category->id; ?>" id="cat_<?php echo $category->label; ?>"> 

									<label for="cat_<?php echo $category->label; ?>" style="display: inline-block;">
										<?php echo $category->label; ?>
									</label>

										<?php if(have_child($category->id)) { ?>
											<?php $children = get_category_children($category->id); ?>
											<ul>
												<?php foreach ($children as $child) { ?>
													<li><input type="checkbox" name="category[]" value="<?php echo $child->id; ?>" id="cat_<?php echo $child->label; ?>" <?php echo $article->category==$child->id?'checked':''; ?>>  <label for="cat_<?php echo $child->label; ?>" style="display: inline-block;"><?php echo $child->label; ?></label></li>
												<?php } ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
								</ul>
							<?php } else { ?>
							<ul class="main">
								<li> <h4> No Category Yet. </h4> </li>
								<li><a href="<?php echo base_url('admin/category/add') ?>" class="button tiny" style="margin-top: 3px" >Add New Category</a></li>
							</ul>
							<?php } ?>
						</div>

						<label>Tags</label>
						<br>
						<div class="tag-list">
							<input type="text" id="tags" name="tags" placeholder="Separate tags by comma (,)">
						</div>
					</fieldset>
				</div>

			</form>
		</div>
	</div>

<?php $this->admin_template->phtml('footer') ?>

<script type="text/javascript">
	// $(document).ready(function () {
	//     $('#checkBtn').click(function() {
	//       checked = $("input[type=checkbox]:checked").length;

	//       if(!checked) {
	//         alert("You must check at least one category.");
	//         return false;
	//       }

	//     });
	// });  
 </script>  

</body>

</html>























