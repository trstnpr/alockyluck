<!DOCTYPE html>
<html lang="en">
	<head>
		<?php load_block('meta_header'); ?>
	</head>
<body class="frontpage">

	<!-- NAVIGATION -->
	<?php load_block('phtml_navigation'); ?>

	<?php load_block('phtml_tagline'); ?>
	<!-- CONTENT -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<!-- SIDEBAR -->
				<?php load_block('phtml_sidebar');?>
			</div>
			<div class="col-md-8">
				<?php load_block('phtml_content-1'); ?>

				<?php load_block('phtml_zipcodes'); ?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<?php load_block('phtml_footer'); ?>

<?php load_block('meta_footer')?>
</body>
</html>