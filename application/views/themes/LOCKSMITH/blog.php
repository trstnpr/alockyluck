<?php 
	$articles1 = $this->app->cdata('articles');
	$title = ($this->uri->segment(2,0)) ?  $this->uri->segment(2,0) : "";
	$title = str_replace('-', ' ', $title);
	$seg_one = $this->uri->segment(1,0);

	
	$categories = get_main_categories();
	$articles = get_main_articles();


	$categories = get_main_categories();

	$author = get_all_articles_author();
    $author = explode(',',$author);
    $allAuthor=array(); //remove duplicate tags
    foreach ($author as $authors):
      if (!in_array(trim($authors), $allAuthor)){
        array_push($allAuthor,trim($authors));
      }	
    endforeach;
	
	
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
            <h2>BLOG</h2>
              <!-- <h2><?php //echo page_header(); ?></h2> -->
              

					<?php 
						$articles = $this->article_model->get_all(array('order_by'=>'created DESC'));
						if($articles == NULL) { ?>

							<!-- <h1 class="page_header" >BLOG</h1> -->

						<?php } 

						else {
							foreach($articles as $article): ?>
							<?php
								$permalink = $article->permalink;
								$content = $article->content;	
								$id = $article->id;
								$title = $article->title;
								$date = date_create($article->created);
								$tagsss = $article->tags;
							?>

							
							<p style="">



								</p>

							<h3 style="margin: 0; margin-bottom: 10px;"><a href="<?php echo base_url($permalink)?>" style=""><?php echo ($title);?></a></h3>

							<p style="">

	                    	<a href="<?php //echo base_url($permalink)?>" style=""><?php echo date_format($date, "F d, Y");?></a> &nbsp · &nbsp

	                    	<span>

	                    					<!-- category -->    

							<?php 
		                      			$allCategory = array(); /*create new array*/
				                          foreach ($articles as $article):
				                          	$articleCategories = explode(",", $article->category); /*convert string to array*/
				                          	foreach ($articleCategories as $articleCategory) {
					                          	if ( !in_array($articleCategory, $allCategory) && isset($article->category) && $article->category != '') { /*check if category is in array created*/
					                          		array_push($allCategory, $articleCategory);/*push element to array*/
					                          	}
				                          	}
				                    ?>	
			                        <?php endforeach; ?>

										  <?php if($categories) { ?>
											<?php foreach ($categories as $category):
													if ( in_array($category->id, $allCategory) ):
											?>
														<!-- <label for="cat_<?php //echo $category->label; ?>" style="display: inline-block;">
															<i><a href="<?php //echo base_url('category/'.$category->permalink) ?>" class="tags"><?php //echo $category->label ?></a></i> · 
														</label> -->
														

														<?php if(have_child($category->id)): ?>
															<?php $children = get_category_children($category->id); ?>

																<?php foreach ($children as $child): ?>

																		<!-- <input type="radio" name="category" value="<?php //echo $child->id; ?>" id="cat_<?php //echo $child->label; ?>">  
																		<label for="cat_<?php //echo $child->label; ?>" style="display: inline-block;"><?php //echo strtoupper($child->label) ?>,</label> -->
																	
																<?php endforeach; ?>
															
														<?php endif; ?>
													<?php 
													endif;
												  endforeach;
												}
												  else {  }?>	
												<!-- category -->                    	
	                    	</span>

	                    	<?php
							    foreach ($allAuthor as $eachAuthor):
							  ?>
								<?php $eachAuthorLink = str_replace(' ', '-', strtolower($eachAuthor));?>
								

							     <a href="<?php echo base_url('author/'.$eachAuthorLink) ?>" class="author"><?php echo $eachAuthor ?></a>
						  <?php
							    endforeach;
							  ?> &nbsp

							</p>
							
								<?php echo word_limiter($content, 80); ?>
						
							<!-- <p style="">
	                              <i><a class="readmore" href="<?php //echo base_url($article->permalink);?>" style="">                 
	                              	Continue reading
	                              </a></i>
	                    	</p> -->

									<hr/>

							<?php endforeach; 

							} 

							?>
				


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
</body>
</html>
