<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en" > <!--<![endif]-->
<?php $this->admin_template->block('head'); ?>
<body>
	<?php $this->admin_template->phtml('header'); ?>
	<div class="row">
		<div class="large-12 columns">
			<!-- content -->
			<h4>Maintenance</h4>
			<div class="section-container vertical-tabs" data-section="vertical-tabs">
			  <section>
			    <p class="title" data-section-title><a href="#">Fix Cities Url</a></p>
			    <div class="content" data-section-content>
					<h5>Fix Cities Url</h5>
					<p>Clicking on the Fix button will automatic detect cities with same slug. Every city with detected same slug, state abbr will be concatinared.</p>
			    	<form action="<?php echo base_url('admin/maintenance/fix_city_url') ?>" method="POST" >
			    		<input name="submit" type="submit" class="button small" value="Fix Now" />
			    	</form>
			    </div>
			  </section>
			</div>
			
			<!-- /content-->
		</div>
	</div>
<?php $this->admin_template->phtml('footer') ?>
</body>
</html>
