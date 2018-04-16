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
			<?php dump($profile); ?>
		</div>
		<?php } ?>
	</div>
</div>