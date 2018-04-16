<div class="content-wrap">
	<div class="container-fluid">
		<?php if($trips['status'] != 1) { ?>
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $trips['message']; ?>
		</div>
		<?php } else { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $trips['message']; ?>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered datatable">
				<thead>
					<tr>
						<th>#</th>
						<th>User</th>
						<th style="min-width:500px!important;">Details</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($trips['data'] as $trip) { ?>
					<tr>
						<td><?php echo $trip->trip_id; ?></td>
						<td>
							<h5><?php echo $trip->trackee_name; ?></h5>
							<p><?php echo $trip->phone; ?></p>
							<p><?php echo $trip->device_info; ?></p>
						</td>
						<td>
							<?php $details = unserialize($trip->trip_coords)['trip_coords']; ?>
							<dl class="dl-horizontal">
								<dt>Dates</dt>
								<dd><?php echo date_proper($trip->trip_start_datetime).' - '.date_proper($trip->trip_end_datetime); ?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt>From</dt>
								<dd><?php echo $details['from_adress']; ?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt>To</dt>
								<dd><?php echo $details['to_adress']; ?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt>Status Address</dt>
								<dd><?php echo $details['Status_adress']; ?></dd>
							</dl>
							<dl class="dl-horizontal">
								<dt>Status</dt>
								<dd><?php echo $details['statusCoords']; ?></dd>
							</dl>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>
</div>