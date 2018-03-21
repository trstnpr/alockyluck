<?php $city = $this->app->cdata('raw'); ?>
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
			<div class="col-md-8">
				<section id="content-1" class="wow bounceIn">
					<div style="padding: 1em 1em;">
						<h2 class="fw-800"><?php echo $city->zip_code;  ?>
              			<?php echo ucwords(get_option('default_city')); ?>
              			<?php echo strtoupper(get_option('default_state_abbr')); ?></h2>
						<div class="line"></div>
						<p><?php echo $city->description; ?></p>
					</div>
				</section>
			</div>
			<div class="col-md-4">
				<!-- SIDEBAR -->
				<?php load_block('phtml_sidebar');?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<?php load_block('phtml_footer'); ?>

<?php load_block('meta_footer')?>
</body>
</html>