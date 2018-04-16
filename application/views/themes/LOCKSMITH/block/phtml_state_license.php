<div class="state-license">



<hr>

          <?php
              //debug();
            //$cities = $this->city_model->get_all(array('order_by'=>'state asc','name asc'));
            $cities = $this->city_model->get_all(array('order_by'=>'name asc'));
            $cities = $this->city_model->get_by_state($this->uri->segment(2));
          ?>

          <?php if($cities): ?>

      <h3 style="color: #f38a32">Cities We Serve</h3>
          <div class="state-citieslist-block">
            <div class="itemblock"> 
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
                    <div class="itemblock" style="display: block"><a class="state-city" href="<?php echo base_url($city->state.'/'.$city->slug) ?>" style="color:#333;"><?php echo $city->name?>, <?php //echo strtoupper($city->state)?> - <?php echo $zip; ?></a></div>   
                  <?php } ?>  
              <?php endforeach; ?>
              </div>
            </div>

          </div>

          <?php endif; ?>

      <?php //load_block('phtml_tag_blocks')?>

      <?php //load_block('phtml_tag_blocks_bottom')?>          


  
</div>