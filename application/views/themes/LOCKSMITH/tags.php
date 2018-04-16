<?php
	//$articles = $this->app->cdata('articles');
	$get_articles = $this->app->cdata('articles');
	$title = ($this->uri->segment(2,0)) ?  $this->uri->segment(2,0) : "";
	$title = str_replace('-', ' ', $title);
	$seg_one = $this->uri->segment(1,0);

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<?php load_block('meta_header'); ?>
	</head>
<body class="blog">

<div class="probootstrap-page-wrapper">

   <?php load_block('phtml_header'); ?>

      <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
          <div class="row">
            <div class="col-md-8 section-heading probootstrap-animate">
              <h2><?php echo page_header(); ?></h2>

							<?php if($seg_one == 'tag'): ?>

								<h3 class="page_head" style="">Tag: <?php echo strtolower($title)  ?></h3>

								<hr/>

								<?php load_block('phtml_articles'); ?>
								
		                    <?php endif; ?>


							<?php if($seg_one == 'category'): ?>

								<h3 class="page_head" style="">Category: <?php echo strtolower($title)  ?></h3>

								<hr/>

								<?php load_block('phtml_articles'); ?>
								
		                    <?php endif; ?>


		                	<?php if($seg_one == 'author'): ?>

		                		<h3 class="page_head" style="">Author: <?php echo strtolower($title)  ?></h3>

		                		<hr/>

		                		<?php load_block('phtml_articles'); ?>
								
		                    <?php endif; ?>
						


            </div>

           <div class="col-md-4 probootstrap-animate"> 
            <?php load_block('phtml_sidebar')?>  
           </div>   

          </div>
        </div>
      </section>



</div>
  <?php load_block('phtml_footer')?>
  <?php load_block('meta_footer')?>
</body>
</html>