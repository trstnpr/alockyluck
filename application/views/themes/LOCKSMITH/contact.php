<!DOCTYPE html>
<html lang="en">
	<head>
		<?php load_block('meta_header'); ?>

	</head>
<script src='https://www.google.com/recaptcha/api.js'></script>
<body class="contactpage innerpage">

<div class="probootstrap-page-wrapper">

   <?php load_block('phtml_header'); ?>

      <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
          <div class="row">
            <div class="col-md-12 section-heading probootstrap-animate">
              <h2><?php echo page_header(); ?></h2>
              <?php echo content(); ?>
				<?php //echo send_email(); ?>



				<?php echo contactProcess(); ?>

					<div class="form-wrap">

						<form class="form-horizontal form-contact" method="post" action="<?php echo base_url('contact-us'); ?>">
							<div class="form-group">
								<label class="col-sm-2 control-label">Name *</label>
								<div class="col-sm-10">
									<input type="text" class="form-control name" name="name" placeholder="Your Name ..." required />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Email *</label>
								<div class="col-sm-10">
									<input type="email" class="form-control email" name="email" placeholder="Your Email ..." required />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Subject *</label>
								<div class="col-sm-10">
									<input type="text" class="form-control subject" name="subject" placeholder="Your Subject ..." required />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Message *</label>
								<div class="col-sm-10">
									<textarea type="text" class="form-control message" name="message" rows="5" placeholder="Your Message ..." required ></textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-2">
									<div class="g-recaptcha" data-sitekey="6LeiYEwUAAAAAJBpnO6IlN3GC2Mvv9v2uVT_zeWh"></div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success btn-send">Message Send</button>
								</div>
							</div>
						</form>



					</div>           
            </div>
          </div>
        </div>
      </section>



</div>
	<?php load_block('phtml_footer')?>
  <?php load_block('meta_footer')?>
</body>
</html>