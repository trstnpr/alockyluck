<div class="content-wrap">
	<div class="container-fluid">
		<?php include('includes/_alert.php'); ?>
		<div class="form-group clearfix">
			<a href="<?php echo base_url('user/password-management/change'); ?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-pencil-square"></i> Change Password</a>
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
						<h2>Account Security</h2>
					</div>
					<div class="detail-list">
						<dl class="dl-horizontal">
							<dt>Email Address</dt>
							<dd><?php echo get_user_info()->email; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Account Token</dt>
							<dd><?php echo get_user_info()->token; ?></dd>
						</dl>
						<dl class="dl-horizontal">
							<dt>Password</dt>
							<dd>*******************</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>