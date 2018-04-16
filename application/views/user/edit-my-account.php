<div class="content-wrap">
	<div class="container-fluid">
		<?php include('includes/_alert.php'); ?>

		<div class="stack-header">
			<h2>Update Informations</h2>
		</div>
		<div class="box form-box">
			<form class="editmyaccount-form" method="post" data-action="<?php echo current_url(); ?>">
				<div class="row">
					<div class="col-md-3 col-md-push-9">
						<div class="dp-wrap">
							<img src="<?php echo (get_user_info()->default_photo != null) ? base_url(get_user_info()->default_photo) : get_gravatar(get_user_info()->email); ?>" class="img-thumbnail preview">
						</div>
						<br/>
						<div class="form-group">
							<label for="profile_photo">Profile Photo</label>
						    <input type="file" id="profile_photo" name="default_photo" accept=".jpg, .png" onchange="readURL(this);">
						    <p class="help-block">Accepts .jpg and .png files only</p>
						</div>
					</div>
					<div class="col-md-9 col-md-pull-3">
						<div class="form-horizontal">
							<div class="form-group" title="Cannot be changed.">
								<label for="email" class="col-sm-3 control-label">Email Address</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" value="<?php echo get_user_info()->email; ?>" disabled="disabled" />
								</div>
							</div>
							<div class="form-group" title="Cannot be changed.">
								<label for="phone" class="col-sm-3 control-label">Phone Number</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" value="<?php echo get_user_info()->phone; ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label for="first_name" class="col-sm-3 control-label">Firstname</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your Firstname" value="<?php echo get_user_info()->first_name; ?>" required="required" />
								</div>
							</div>
							<div class="form-group">
								<label for="last_name" class="col-sm-3 control-label">Lastname</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Lastname" value="<?php echo get_user_info()->last_name; ?>" required="required" />
								</div>
							</div>
							<div class="form-group">
								<label for="alt_phone" class="col-sm-3 control-label">Alt. Phone Number</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="alt_phone" id="alt_phone" value="<?php echo get_user_info()->alt_phone; ?>" placeholder="Your Alternative Phone Number">
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-3 control-label">Address</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="address" id="address" value="<?php echo get_user_info()->address; ?>" placeholder="Your Home Address" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="city" class="col-sm-3 control-label">City</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="city" id="city" value="<?php echo get_user_info()->city; ?>" placeholder="Your City Address" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="state" class="col-sm-3 control-label">State</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="state" id="state" value="<?php echo get_user_info()->state; ?>" placeholder="Your State Address" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="zipcode" class="col-sm-3 control-label">Zipcode</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo get_user_info()->zipcode; ?>" placeholder="Your Zipcode Address" required="required">
								</div>
							</div>
							<div class="form-group">
								<label for="country" class="col-sm-3 control-label">Country</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="country" id="country" value="<?php echo get_user_info()->country; ?>" placeholder="Your Country" required="required">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary btn-save">Save Changes</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>