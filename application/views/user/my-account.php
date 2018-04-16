<div class="content-wrap">
	<div class="container-fluid">
		<?php include('includes/_alert.php'); ?>
		<div class="form-group clearfix">
			<a href="<?php echo base_url('user/my-account/edit'); ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-pencil-square"></i> Edit Informations</a>
		</div>
		<div class="user-info">
			<div class="avatar-wrap data-img" data-bg="<?php echo base_url('assets/user/img/banner/banner-2.jpg'); ?>">
				<div class="overlay">
					<img src="<?php echo (get_user_info()->default_photo != null) ? base_url(get_user_info()->default_photo) : get_gravatar(get_user_info()->email); ?>" />
				</div>
			</div>
			<div class="user-details">
				<div class="detail-stack">
					<ul>
						<li class="name"><?php echo get_user_info()->first_name.' '.get_user_info()->last_name; ?></li>
						<li class="address text-muted"><?php echo get_user_info()->city.', '.get_user_info()->state.' '.get_user_info()->zipcode; ?></li>
						<li class="token text-muted"><?php echo get_user_info()->token; ?></li>
					</ul>
				</div>
				<hr/>
				<div class="detail-stack">
					<div class="stack-header">
						<h2>Basic Informations</h2>
					</div>
					<div class="detail-list">
						<dl class="dl-horizontal">
							<dt>Full Name</dt>
							<dd><?php echo get_user_info()->first_name.' '.get_user_info()->last_name; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Email Address</dt>
							<dd><?php echo get_user_info()->email; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Phone</dt>
							<dd><?php echo get_user_info()->phone; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Alternative Phone</dt>
							<dd><?php echo get_user_info()->alt_phone; ?></dd>
						</dl>
					</div>
				</div>
				<div class="detail-stack">
					<div class="stack-header">
						<h2>User Location</h2>
					</div>
					<div class="detail-list">
						<dl class="dl-horizontal">
							<dt>Address</dt>
							<dd><?php echo get_user_info()->address; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>City</dt>
							<dd><?php echo get_user_info()->city; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>State</dt>
							<dd><?php echo get_user_info()->state; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Zip</dt>
							<dd><?php echo get_user_info()->zipcode; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Country</dt>
							<dd><?php echo get_user_info()->country; ?></dd>
						</dl>
					</div>
				</div>
				<div class="detail-stack">
					<div class="stack-header">
						<h2>Credentials</h2>
					</div>
					<div class="detail-list">
						<dl class="dl-horizontal">
							<dt>All Licenses</dt>
							<?php
								$x = 0;
								foreach(unserialize(get_user_info()->documents) as $license) {
									$x++;
							?>
							<dd><a href="<?php echo base_url($license); ?>" data-lity>License <?php echo $x; ?></a></dd>
							<?php } ?>
						</dl>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>