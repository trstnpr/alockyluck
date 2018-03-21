
      <section class="cities probootstrap-section-colored" style="">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center section-heading probootstrap-animate">
              <h2 class="city-title">Cities We Serve</h2>
            </div>
            <div class="col-md-12 probootstrap-animate">
			<div class="">
				<div class="side-bar-title" align="center">
					<!-- <p class="fw-800">CITIES WE SERVE</p> -->
					<br>
				</div>
				<div class="service-list">

					<?php
					    //debug();
						//$cities = $this->city_model->get_all(array('order_by'=>'state asc','name asc'));
					 	$cities = $this->city_model->get_all(array('order_by'=>'name asc'));
					?>

					<?php if($cities): ?>
					<!-- block: phtml_citieslist -->


					<div class="citieslist-block">
						<div class="itemblock-container">	
							<div class="city">
							<?php 
								$total = count($cities);
								$counter = 0;
								$column = round($total / 1);
							?>
							<?php foreach($cities as $city): ?>
								<?php if($counter == $column) { echo '</div><div class="col-md-12">'; $counter = 0; } ?>
								<?php $counter++; ?>
									<?php
									$str = $city->zip_code;
									$zipcodes = explode(',',$str);

									foreach ($zipcodes as $zip) { ?>
										<div class="itemblock" style="display: block"><a class="zip-code" href="<?php echo base_url($city->state.'/'.$city->slug) ?>"><?php echo $city->name?>, <?php //echo strtoupper($city->state)?> - <?php echo $zip; ?></a></div>		
									<?php } ?>  
							<?php endforeach; ?>
							</div>
						</div>

					</div>

					<!-- /block: phtml_citieslist -->
					<?php endif; ?>
				</div>
			</div>

            </div>            
          </div>        
        </div>
      </section>