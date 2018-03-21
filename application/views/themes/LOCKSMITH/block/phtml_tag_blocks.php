<div class="container">


<div class="tag-blocks">
	
<div class="row">
	<div class="col-md-6">
		<div class="tb tb1 probootstrap-animate">
			<h2>Residential Services</h2>
			<!-- <div class="content-tb"><p><?php //echo getPageShortContent('residential-lockout',20); ?></p></div> -->
			<div class="content-tb"><p>You wouldn't have to worry about the security of your home, whether it is a lockout, lock change or lock installation, we can do it for you fast and easy!</p></div>
			<button class="tag-btn" data-toggle="modal" data-target="#modal-tb1">View More</button>
			<img src="<?php echo theme_uri()?>images/tb1.png" title="Residential Services">
		</div>		
	</div>

	<div class="col-md-6">
		<div class="tb tb2 probootstrap-animate">
			<h2>Commercial Services</h2>
			<!-- <div class="content-tb"><p><?php //echo getPageShortContent('commercial-lockout',25); ?></p></div> -->
			<div class="content-tb"><p>We can dispatch a team of locksmith experts specialized in working with commercial sectors. They can work on lockouts, lock installation, repair or replacement.</p></div>			
			<button class="tag-btn" data-toggle="modal" data-target="#modal-tb2">View More</button>
			<img src="<?php echo theme_uri()?>images/tb2.png" title="Commercial Services">
		</div>		
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="tb tb1 probootstrap-animate">
			<h2>$75 Business Lock Replacement</h2>
			<div class="content-tb"><p><?php echo getPageShortContent('business-lock-replacement',20); ?></p></div>
			<!-- <div class="content-tb"><p>You wouldn't have to worry about the security of your home, whether it is a lockout, lock change or lock installation, we can do it for you fast and easy!</p></div> -->
			<button class="tag-btn" data-toggle="modal" data-target="#modal-tb1">View More</button>
			<img src="<?php echo theme_uri()?>images/tb-business.png" title="$75 Business Lock Replacement">
		</div>		
	</div>

	<div class="col-md-6">
		<div class="tb tb2 probootstrap-animate">
			<h2>Commercial Services</h2>
			<!-- <div class="content-tb"><p><?php //echo getPageShortContent('commercial-lockout',25); ?></p></div> -->
			<div class="content-tb"><p>We can dispatch a team of locksmith experts specialized in working with commercial sectors. They can work on lockouts, lock installation, repair or replacement.</p></div>			
			<button class="tag-btn" data-toggle="modal" data-target="#modal-tb2">View More</button>
			<img src="<?php echo theme_uri()?>images/tb-image.png" title="Commercial Services">
		</div>		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="tb tb3 probootstrap-animate">
			<h2>Automotive Services</h2>
			<!-- <div class="content-tb"><p><?php //echo getPageShortContent('auto-lockout',35); ?></p></div> -->
			<div class="content-tb"><p>Whatever emergency you are in while in the middle of the road, we can come to the rescue! Flat tire? Locked out? Need a jump start? We'll send technicians immediately!</p></div>			
			<button class="tag-btn" data-toggle="modal" data-target="#modal-tb3">View More</button>
			<img src="<?php echo theme_uri()?>images/tb3.png" title="Automotive Services">
		</div>		
	</div>
</div>

</div>	
</div>


<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="modal-tb1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Residential Services</h4>
      </div>

      <div class="modal-body probootstrap-animate">
	      <ul>
	      	<li><a href="<?php echo base_url('residential-lockout') ?>"><i class="fa fa-check"></i> $75 Residential Lockout</a></li>
			<li><a href="<?php echo base_url('residential-lock-replacement') ?>"><i class="fa fa-check"></i> $50 Residential Lock Replacement</a></li>		   
			<li><a href="<?php echo base_url('mailbox-services') ?>"><i class="fa fa-check"></i> $75 Mailbox Services</a></li>   
	      </ul>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="modal-tb2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Commercial Services</h4>
      </div>
	      <div class="modal-body probootstrap-animate">
		      <ul>
				<li><a href="<?php echo base_url('commercial-lockout') ?>"><i class="fa fa-check"></i> $75 Commercial Lockout</a></li>
				<li><a href="<?php echo base_url('business-lock-replacement') ?>"><i class="fa fa-check"></i> $75 Business Lock Replacement</a></li>
				<li><a href="<?php echo base_url('rekey') ?>"><i class="fa fa-check"></i> $25 Rekey (Minimum 3 Rekeys or Minimun $75 Purchase)</a></li>
		      </ul>
	      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="modal-tb3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Automotive Services</h4>
      </div>
	      <div class="modal-body probootstrap-animate">
		      <ul>
				<li><a href="<?php echo base_url('auto-lockout') ?>"><i class="fa fa-check"></i> $75 Auto Lockout</a></li>
				<li><a href="<?php echo base_url('ignition') ?>"><i class="fa fa-check"></i> $75 Ignition (Call for an instant quote)</a></li>
				<li><a href="<?php echo base_url('flat-tire') ?>"><i class="fa fa-check"></i> $75 Flat Tire</a></li>
				<li><a href="<?php echo base_url('jump-start') ?>"><i class="fa fa-check"></i> $75 Auto Jump Start</a></li>
		      </ul>
	      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>