<!DOCTYPE html>

<html lang="en">

	<head>

		<?php load_block('meta_header'); ?>

	</head>

<body class="innerpage">

<div class="probootstrap-page-wrapper">

   <?php load_block('phtml_header'); ?>

      <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
          <div class="row">
            <div class="col-md-12 section-heading probootstrap-animate">
              <h2>State of <?php echo page_header() ?></h2>
              <?php echo content(); ?>
            </div>
          </div>
        </div>
      </section>



</div>
  <?php load_block('phtml_footer')?>
  <?php load_block('meta_footer')?>
</body>
</html>