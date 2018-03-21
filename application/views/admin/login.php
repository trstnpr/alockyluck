<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8" />
  	<meta name="viewport" content="width=device-width" />
  	<title>Login</title>
	<link rel="stylesheet" href="<?php echo $this->admin_template->admin_theme_uri('css/normalize.css') ?>" />
	<link rel="stylesheet" href="<?php echo $this->admin_template->admin_theme_uri('css/foundation.css') ?>" />
	<link rel="stylesheet" href="<?php echo $this->admin_template->admin_theme_uri('css/static.css') ?>" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo $this->admin_template->admin_theme_uri('js/vendor/custom.modernizr.js') ?>"></script>
</head>
<body>
	<div style="margin-top: 10%"></div>
	<div class="row">
		<div class="large-3 large-centered columns" style="text-align: center">
		</div>
	</div>
	<div class="row">
		<div class="large-3 large-centered columns">
			<form action="<?php base_url('admin/login') ?>" method="POST" id="login-form">
				<input type="hidden" name="callback_url" value="<?php ?>" />
			    <div class="row">
			      <div class="large-24 columns">
			        <label for="username">Username</label>
			        <input type="text" id="username" name="username" placeholder="Enter Username">
			      </div>
			      <div class="large-24 columns">
			        <label for="password">Password</label>
			        <input type="password" id="password" name="password" placeholder="Enter Password">
			      </div>
			       <div class="large-24 columns">
			        <input type="submit" placeholder="Password" name="submit" class="button small" style="float: right" value="Login" >
			      </div>
			    </div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns large-centered">
			<div id="alert-box" style="text-align: center">
				<?php
					
					if($this->session->flashdata('message')){
						echo '<div data-alert class="alert-box alert">'.$this->session->flashdata('message').'</div>';	
					}
				
				 ?>
			</div>
		</div>
	</div>
	<?php $this->admin_template->block('footer_scripts') ?>
</body>
</html>