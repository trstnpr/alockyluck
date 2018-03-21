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
			<div style="text-align: right">
				<a href="<?php echo base_url('admin/category/add') ?>" class="button tiny">Add New Category</a>
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
						<td>Categories</td>
						<td></td>
					</tr>
				</thead>

				<tbody>

					<?php 

					$pages = $this->app->cdata('pages');
					if($pages) {
					foreach($pages as $page): 

					$edit_link = base_url('admin/category/edit/'.$page->id);
					$view_link = base_url('category/'.$page->permalink);
					$del_link = base_url('admin/category/trash/'.$page->id);
					// debug($pages);
					?>

					<tr>
						<td><a href="<?php echo $edit_link;  ?>"><?php echo $page->label ?></a></td>
						<td width="130px">
							<ul class="inline-list" style="font-size: 11px">
							  <li><a href="<?php echo $view_link;  ?>">View</a></li>
							  <li><a href="<?php echo $edit_link;  ?>">Edit</a></li>
							  <li><a href="<?php echo $del_link;  ?>">Delete</a></li>
							</ul>
						</td>
					</tr>

					<?php endforeach; ?>
					<?php } else { ?>
						<h2>No category.</h2>
					<?php } ?>
				</tbody>
			</table>

			<ul class="pagination" style="display: none">
			  <li class="arrow unavailable"><a href="">&laquo;</a></li>
			  <li class="current"><a href="">1</a></li>
			  <li><a href="">2</a></li>
			  <li><a href="">3</a></li>
			  <li><a href="">4</a></li>
			  <li class="unavailable"><a href="">&hellip;</a></li>
			  <li><a href="">12</a></li>
			  <li><a href="">13</a></li>
			  <li class="arrow"><a href="">&raquo;</a></li>
			</ul>
			<!-- /content-->
		</div>
	</div>

<?php $this->admin_template->phtml('footer') ?>

</body>

</html>






