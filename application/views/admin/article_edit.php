<?php

	$page = $this->app->cdata("article_data");
	//$default_page_layout=$this->config_model->get('default_page_layout');
	$article = $this->app->cdata("article_data");
	//$default_page_layout=!empty($article->layout)?$article->layout:$this->config_model->get('default_page_layout');
	$article_layout = $this->config_model->get('default_page_layout')?$this->config_model->get('default_page_layout'):"page.php";
	//$templates = get_templates(array('return_type'=>'drop_down_list'));
    $current_layout = isset($article->layout)?$article->layout:$this->config_model->get('default_page_layout');
	$created = new DateTime($article->created);
	$updated = new DateTime(isset($article->updated) ? $article->updated : $article->created);
	$categories = get_main_categories();
?>

<!DOCTYPE html>

<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->

<!--[if gt IE 8]><!-->

<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
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
<body>

	<?php $this->admin_template->phtml('header'); ?>
	<div class="row">

		<div class="large-12 columns">

			<!-- content -->
			<div class="row">
				<div class="large-8 columns"><h4>Edit Post: <?php echo $page->title; ?></h4></div>

				<div class="large-4 columns" style="text-align: right">

				<a href="<?php echo base_url($page->permalink) ?>" class="button tiny" style="margin-top: 3px" >View Post</a>

					<a href="<?php echo base_url('admin/article/add') ?>" class="button tiny" style="margin-top: 3px" >Add New Post</a>

				</div>
			</div>

			<hr style="margin-top:0">

			<?php if($response=$this->session->flashdata('message')): ?>

				<div data-alert class="alert-box <?php echo $response['type'] ?>">

				  <?php echo $response['message'] ?>

				  <a href="#" class="close">&times;</a>

				</div>

			<?php endif;?>

			<form action="<?php echo base_url('admin/article/edit/'.$article->id) ?>" name="myForm" method="POST" onsubmit="return validateForm()">

			<div class="row">

				<div class="large-8 columns">

					<label>Title</label><input type="text" value="<?php echo $page->title ?>" name="title" id="title" placeholder="Page Title" />

					<div class="row">

						<div class="large-8 columns">
							<label>Permalink</label>
							<input type="text" value="<?php echo $page->permalink ?>" name="permalink" id ="slug" placeholder="Permalink" />
						</div>

						<div class="large-4 columns">
							<label>Layout</label>
							<input type="text" value="<?php echo is_null($page->layout)?$default_page_layout:$page->layout ?>" name="layout" placeholder="Layout" />
						</div>

					</div>

						<label>Content</label>

						<?php echo $this->ckeditor->editor("content",$page->content); ?>

						<br>

						<label>Meta Title</label>

						<input type="text" value="<?php echo $page->meta_title ?>" name="meta_title" placeholder="Meta title" />

						<label>Meta Keywords</label>

						<input type="text" value="<?php echo $page->meta_key ?>" name="meta_keywords" placeholder="Meta keywords" />

						<label>Meta Description</label>

						<textarea name="meta_description" placeholder="Meta Description" ><?php echo $page->meta_description ?></textarea>

						<div style="text-align: right">
							<input type="submit" name="submit" value="Save Changes" class="button small" id="checkBtn"/>
						</div>

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
					<label>Other Info</label>
					<table class="sw">
						<tr>
							<td>Article ID :</td>
							<td><?php echo $article->id; ?></td>
						</tr>
						<tr>
							<td>Created by : Admin</td>
						</tr>
						<tr>
							<td>Published:</td>
							<td><?php echo format_date($article->created,'M d, Y @ H:i:s'); ?></td>
						</tr>
						<tr>
							<td>
								<style>
								.edit_date .content {
								    display: none;
								    padding : 5px;
								}
								</style>
								<div class="edit_date">
								    <div class="btn_edit"><span>Edit</span></div>
								    <div class="content">
								    	<div class="row">
								    		<div class="large-12 columns"><input type="date" value="<?php echo date_format($created, 'Y-m-d'); ?>" name="date"/></div>
								    	</div>
									    <div class="row">
											<div class="large-8 columns"><input type="text" value="<?php echo date_format($created, 'H')?>" name="hours" /></div>
											<div class="large-8 columns"><input type="text" value="<?php echo date_format($created, 'i')?>" name="minutes" /></div>
											<div class="large-8 columns"><input type="text" value="<?php echo date_format($created, 's')?>" name="seconds" /></div>
										</div>
								    </div>
								</div>
							</td>
						</tr>

							<script>
							$(".btn_edit").click(function () {

							    $header = $(this);
							    //getting the next element
							    $content = $header.next();
							    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
							    $content.slideToggle(500, function () {
							        //execute this after slideToggle is done
							        //change text of header based on visibility of content div
							        $header.text(function () {
							            //change text based on condition
							            return $content.is(":visible") ? "Cancel" : "Edit";
							        });
							    });

							});
							</script>
					</table>
					</fieldset>

					<fieldset class="dd-fieldset">
						<label>Category</label>
						<div class="category-list" id="">
						
						<?php 
						// $allCategory = array();
						if($categories){ ?>
							<ul class="main">

							<?php foreach ($categories as $category) { ?>					
								<li><!-- <small class="error"></small> -->

								<input type="checkbox" name="category[]" value="<?php echo $category->id; ?>" id="cat_<?php echo $category->label; ?>"
								<?php echo $article->category==$category->id?'checked':''; ?> > 

								<label for="cat_<?php echo $category->label; ?>" style="display: inline-block;">
								<?php echo $category->label.' '.count_category_child($category->id); ?></label>

								<?php //array_push($allCategory,$article->category); 
									// debug($allCategory);
								?>

									<?php if(have_child($category->id)) { ?>
										<?php $children = get_category_children($category->id); ?>
										<ul>
											<?php foreach ($children as $child) { ?>
												<li><input type="radio" name="category" value="<?php echo $child->id; ?>" id="cat_<?php echo $child->label; ?>" <?php echo $article->category==$child->id?'checked':''; ?>>  <label for="cat_<?php echo $child->label; ?>" style="display: inline-block;"><?php echo $child->label; ?></label></li>
											<?php } ?>
										</ul>
									<?php } ?>
								</li>
							<?php } ?>
							<!-- <a href="<?php //echo base_url('admin/category/add') ?>" class="button tiny" style="margin-top: 3px" >Add New Category</a> -->
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
							<input type="text" id="tags" name="tags" title="separate tags by comma (,)" value="<?php echo $page->tags ?>" >
						</div>

						
					</fieldset>

				</div>

			</div>

			</form>

			<!-- /content-->

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
























