
<?php 

error_reporting(0);

	$get_articles = $this->app->cdata('raw');
	$articles = get_main_articles();
	$categories = get_main_categories();

	$date = date_create($get_articles->created);
$permalinks = $get_articles->permalink;

$postid = $get_articles->id;

$author = get_all_articles_author();
$author = explode(',',$author);
$allAuthor=array(); //remove duplicate tags
foreach ($author as $authors):
  if (!in_array(trim($authors), $allAuthor)){
    array_push($allAuthor,trim($authors));
  }	
endforeach;

 
?>



<style type="text/css">

body.blog p img {
    width: 100% !important;
     height: auto !important; 
    border-width: 3px;
    border-style: solid;
    margin: 5px;
    max-width: 400px !important;
    margin: auto !important;
    display: block !important;	
}

</style>



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

<div class='oss-widget-interface'></div>

						<span>

	                    	<a href="<?php //echo base_url($permalinks)?>" style=""><?php echo date_format($date, "F d, Y");?></a> &nbsp · &nbsp

	                    	<?php
							    foreach ($allAuthor as $eachAuthor):
							  ?>
								<?php $eachAuthorLink = str_replace(' ', '-', strtolower($eachAuthor));?>
								

							     <a href="<?php echo base_url('author/'.$eachAuthorLink) ?>" class="author"><?php echo $eachAuthor ?></a>
						  <?php
							    endforeach;
							  ?> &nbsp

							</span>
						 	  



					

							<?php 

                      		  $allCategory = array(); /*create new array*/
	                          foreach ($get_articles as $article):

		                          	$articleCategories = explode(",", $get_articles->category); /*convert string to array*/
		                          	// debug($articleCategories);
		                          	foreach ($articleCategories as $articleCategory) {
			                          	if ( !in_array($articleCategory, $allCategory) && isset($get_articles->category) && $get_articles->category != '') { /*check if category is in array created*/
			                          		array_push($allCategory, $articleCategory);/*push element to array*/
			                          	}
		                          	}
                         	 endforeach;
                        ?>

						
							<?php if ($get_articles->category == 0): ?>
								 <!-- No Category Yet. -->
							<?php else: ?>
								
							  	<?php if($categories): ?>
								<?php foreach ($categories as $category):
										
										if ( in_array($category->id, $allCategory) ):
								?>
											<label for="cat_<?php echo $category->label; ?>" style="display: inline-block;">
												<!-- <a href="<?php //echo base_url('category/'.$category->permalink) ?>" class="category"> <?php //echo strtoupper($category->label) ?></a> ·  -->
												<?php echo strtoupper($category->label) ?> · 
											</label>										

											<?php if(have_child($category->id)): ?>
												<?php $children = get_category_children($category->id); ?>

													<?php foreach ($children as $child): ?>

														<input type="radio" name="category" value="<?php echo $child->id; ?>" id="cat_<?php echo $child->label; ?>">  
														<label for="cat_<?php echo $child->label; ?>" style="display: inline-block;"><?php echo strtoupper($child->label) ?>,</label>
														
													<?php endforeach; ?>
												
											<?php endif; ?>
										
										<?php 
										endif;
									  endforeach; ?>

							   <?php endif; ?>
							<?php
								endif;
							?>

							

						<!-- <h1 class="page_header" ><?php //echo page_header()?></h1> -->



						 	  <?php echo content() ?>


						 	  <hr/>

						 	  <p style=""> 

							<!--Start of Tags-->
							

							  <?php if (empty($get_articles->tags)): ?>
								<i class="fa fa-tags" aria-hidden="true"></i> No Tags
							  <?php else: ?>
							  	<i class="fa fa-tags" aria-hidden="true"></i> 
							  		<?php
									  	 $tags = $get_articles->tags;
										 $tagss = explode(',',$tags);
										 foreach ($tagss as $tag):
									?>
										<?php $eachTagLink = str_replace(' ', '-', $tag) ?>

											<!-- <i><a href="<?php //echo base_url('tag/'.$eachTagLink) ?>" class="tags"> <?php //echo $tag ?></a></i>, -->
											<label><i> <?php echo $tag ?></i>,</label>

										<?php
										endforeach;
								  	endif;
								  ?>
							</p>


						 	  <hr/>

						<div class="row">

							<div class="col-md-6" style="text-align: left;">
								
								<?php

									foreach($articles as $article1) {

										$col_id[] = $article1->id;
									}

									$all_post = $this->db->get('articles');

									$post_count = $all_post->num_rows;

									$current_id = array_search($postid,$col_id);

									$prev_id = $current_id - 1;
									$result = $col_id[$prev_id];

									//echo $result;exit();

									if($result != null) {
										$prev_q = $this->db->get_where('articles', array('id' => $result));
										foreach ($prev_q->result() as $prev)
										{
											?>
										        Previous Post<br/>
										        <i><a href="<?php echo base_url().$prev->permalink ?>"><?php echo $prev->title; ?></a></i>

										    <?php
										}
									}
								?>
									
								<?php  ?>
							</div>

							<div class="col-md-6" style="text-align: right;">
								<?php
									$next_id = $current_id + 1;

									$result = $col_id[$next_id];


									if($result != null) {
										$next_q = $this->db->get_where('articles', array('id' => $result));
										
										foreach ($next_q->result() as $next)
										{
											?>
										        Next Post<br/>
										        <i><a href="<?php echo base_url().$next->permalink ?>"><?php echo $next->title; ?></a></i>

										    <?php
										}
									}								
								?>
							</div>
						</div>						
            </div>

            <div class="col-md-4 probootstrap-animate">
            	<?php load_block('phtml_recent_blog')?>  
            	<?php load_block('phtml_sidebar')?>
            </div>
          </div>
        </div>
      </section>



</div>
  <?php load_block('phtml_footer')?>
  <?php load_block('meta_footer')?>


<script type="text/javascript" src="//sharecdn.social9.com/v2/js/opensocialshare.js"></script><script type="text/javascript" src="//sharecdn.social9.com/v2/js/opensocialsharedefaulttheme.js"></script><link rel="stylesheet" type="text/css" href="//sharecdn.social9.com/v2/css/os-share-widget-style.css"/><script type="text/javascript">var shareWidget = new OpenSocialShare();shareWidget.init({isHorizontalLayout: 1,widgetIconSize: "32",widgetStyle: "square",theme: 'OpenSocialShareDefaultTheme',providers: { top: ["Facebook","GooglePlus","LinkedIn","Twitter"]}});shareWidget.injectInterface(".oss-widget-interface");shareWidget.setWidgetTheme(".oss-widget-interface");</script>


</body>
</html>