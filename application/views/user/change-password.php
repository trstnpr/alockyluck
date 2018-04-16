<div class="content-wrap">
	<div class="container-fluid">
		<?php include('includes/_alert.php'); ?>

		<div class="stack-header">
			<h2>Change Password</h2>
		</div>
		<div class="box form-box">
			<form class="form-horizontal form-changepassword" method="post" data-action="<?php echo current_url(); ?>">
				<p><strong>Take Note!</strong> Session will be terminated once password successfully changed.</p>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Current Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" id="password" placeholder="Current Password" required="required" />
					</div>
				</div>
				<div class="form-group">
					<label for="new_password" class="col-sm-2 control-label">New Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" required="required" />
					</div>
				</div>
				<div class="form-group">
					<label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary btn-save">Save Changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>