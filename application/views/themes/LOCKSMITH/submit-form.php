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
              <h2><?php echo page_header(); ?></h2>
              <?php //echo content(); ?>

<hr/>

<div id="">
<?php echo form_open('career_form'); ?>
<h1 class="submit-form-title" style="color:#333;">Personal Information</h1>
<?php if (isset($message)) { ?>
<CENTER><h3 style="color:green;">Data inserted successfully</h3></CENTER><br>
<?php } ?>
<?php echo form_label('Student Name :'); ?> <?php echo form_error('dname'); ?><br />
<?php echo form_input(array('id' => 'dname', 'name' => 'dname')); ?><br />

<?php echo form_label('Student Email :'); ?> <?php echo form_error('demail'); ?><br />
<?php echo form_input(array('id' => 'demail', 'name' => 'demail')); ?><br />

<?php echo form_label('Student Mobile No. :'); ?> <?php echo form_error('dmobile'); ?><br />
<?php echo form_input(array('id' => 'dmobile', 'name' => 'dmobile', 'placeholder' => '10 Digit Mobile No.')); ?><br />

<?php echo form_label('Student Address :'); ?> <?php echo form_error('daddress'); ?><br />
<?php echo form_input(array('id' => 'daddress', 'name' => 'daddress')); ?><br />

<?php echo form_submit(array('id' => 'submit', 'value' => 'Submit')); ?>
<?php echo form_close(); ?><br/>
<div id="fugo">

</div>
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