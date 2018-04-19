<div class="content-wrap">
	<div class="container-fluid">
		<?php if($profile['status'] != 1) { ?>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $profile['message']; ?>
		</div>
		<?php } else { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $profile['message']; ?>
		</div>
		<div class="box">
			<dl class="dl-horizontal">
				<dt>ID</dt>
				<dd><?php echo $profile['data']->id; ?></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Firstname</dt>
				<dd><?php echo $profile['data']->firstname; ?></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Lastname</dt>
				<dd><?php echo $profile['data']->lastname; ?></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Phone</dt>
				<dd><?php echo $profile['data']->phone; ?></dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Status</dt>
				<dd><?php echo $profile['data']->status; ?></dd>
			</dl>
			<?php //dump($profile); ?>
		</div>
		<?php } ?>
	</div>
</div>