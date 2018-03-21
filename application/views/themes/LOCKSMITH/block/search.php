<!DOCTYPE html>

<html lang="en">

  <head>

    <?php load_block('meta_header'); ?>

    <?php //load_block('phtml_slider') ?>

  </head>

<body class="innerpage searchresultspage">

  <?php load_block('phtml_header'); ?>

  <?php load_block('phtml_slider') ?>

<div class="bodywrapper">

  <?php //load_block('phtml_header'); ?>

  <?php //load_block('phtml_innerpage_header'); ?>

  <main id="content" role="main">

      <div class="container">
        <div class="ddboxheadercontainer">
          <div class="col-md-12">
            <h1 class="search_page_header"><?php echo title(); ?></h1>
          </div>
        </div>
      </div>

    <div class="container">
      <div class="col-md-8">
       <div class="content-ddbox">
        <div class=" searchpage">
          <!-- <h1 class="page_header"><?php //echo page_header(); ?></h1> -->
           <h2><?php //echo title();?></h2>

            <?php if($results = $this->app->cdata('search_result')): ?>

              <?php foreach($results as $result):

              $result_title = $result->city_name.", ".strtoupper($result->state);

              $link = base_url($result->slug."/".$result->city_slug);

              ?>

                <div class="products_box">

                  <div class="entry">

                    <h3 class="title"><?php echo anchor($link, $result_title); ?></h3>

                    <h4><strong>Phone : <a href="tel: <?php echo $result->phone?$result->phone:get_option('default_phone'); ?>"> <?php echo $result->phone?$result->phone:get_option('default_phone'); ?></a></strong></h4>
                     <h4><strong>Zip: <?php echo $result->zip_code; ?></strong></h4><br/>
                    <?php

                    $desc = trim_text($result->description,250);

                    $desc = str_replace('[areacode]', $result->area_code, $desc);

                    $desc = str_replace('[phone]', $result->phone, $desc);

                    $desc = str_replace('[city]', $result->name, $desc);

                    $desc = str_replace('[term]', strtoupper($result->state), $desc);

                    $desc = str_replace('[state]', $result->city_name, $desc);

                    echo $desc;//echo anchor($link,"[...]");

                    ?>

                    <?php echo anchor($link, "READ MORE"); ?>

                    <div style="display:block; height:20px;"></div>

                    <div class="clearfix"></div>

                  </div>

                </div>

                <?php endforeach;?>

              <?php else: ?>

                  <h3>No Result found for "<?php echo get_search_query() ?>"</h3>

              <?php endif; ?>

          </div>
        </div>
      </div>

        <div class="col-md-4">

          <div class="content-ddbox">
            <?php load_block('phtml_top_services')?>
          </div><!--sitelinks list-->

        </div>

    </div>

    </div>  

  </main>

  <div class="col-md-12 sitelinks-top hidden-sm hidden-xs">
    <?php load_block('phtml_sitelinks_top')?>
  </div><!--6 services top-->

  <?php load_block('phtml_footer')?>

  <?php load_block('meta_footer')?>

</div>

</body>

</html>