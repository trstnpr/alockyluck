<!DOCTYPE html>
<html lang="en">
	<head>
		<?php load_block('meta_header'); ?>
		<?php load_block('meta_header_frontpage_parallax') ?>
	</head>
<body class="frontpage">
<?php load_block('phtml_header'); ?>
<section id="innerpage">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="uppercase fw-900">
            RESULT
          </h1>
        </div>
      </div>
    </div>
</section>


<section id="content-3">

      <div class="container">

        <div class="row">

          <div class="col-md-8">
              <div class="row">
                <div class="col-md-12">
                    <div class="title" align="left">
                      <h4 class="fw-800">Cities List</h4>
                   </div>
                </div>
              </div>

              <div class="row">

                      <?php if($results = $this->app->cdata('search_result')): ?>
                      <?php $count=0; 
                      $group = 1;
                      $limit = 5;
                      $endlimit = $limit;
                      ?>

                      <?php foreach($results as $result):
                            $result_title = $result->city_name.", ".strtoupper($result->state);
                            $link = base_url($result->slug."/".$result->city_slug);
                            $str = $result->zip_code;
                            $zipcodes = explode(',',$str);

                      ?>
                      <!-- Loop -->
                      <div class="col-md-12 col-xs-12">
                          <div class="search-box">
                              <h3 class="fw-800 uppercase"><?php echo anchor($link, $result_title); ?></h3>
                              <br>
                              <div class="row">
                                  <div class="col-md-6">
                                     <a href="tel: <?php echo $result->phone?$result->phone:get_option('default_phone'); ?>" class="btn btn-warning btn-sm btn-block">
                                        CALL US! <?php echo $result->phone?$result->phone:get_option('default_phone'); ?>
                                     </a>
                                  </div>
                                  <div class="col-md-6">
                                      <br class="visible-xs visible-sm">
                                      <small class="white">ZIP:</small>
                                      <?php foreach ($zipcodes as $zip) { ?>
                                      <a href="<?php echo base_url($result->state.'/'.$result->city_slug) ?>" class="btn btn-outlined btn-sm">
                                          <?php echo $zip; ?>
                                      </a>
                                      <?php } ?>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Loop end -->
  
                       <?php $count++; $group++;?>
                       <?php endforeach;?>
  
                     <?php else: ?>
                         <div class="col-md-12">
                            <h3>
                              No Result found for 
                              <?php 
                                  if (!empty($_GET['location'])){
                                      echo $_GET['location'];
                                  }
                              ?>
                              
                            </h3>
                         </div>
                     <?php endif; ?>
  
                  </div>

              </div>
              <div class="col-md-4">
                <?php load_block('phtml_top_services.php'); ?>
              </div>

          </div>
        </div>
    </section>
    <?php load_block('phtml_content-2') ?>
  </div>
  <br>
  <br>
	
<?php load_block('phtml_footer')?>
<?php load_block('meta_footer')?>
<?php load_block('meta_footer_parallax')?>
</body>
</html>