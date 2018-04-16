<?php
	//$articles = $this->app->cdata('articles');
	$get_articles = $this->app->cdata('articles');
	$title = ($this->uri->segment(2,0)) ?  $this->uri->segment(2,0) : "";
	$title = str_replace('-', ' ', $title);
	$seg_one = $this->uri->segment(1,0);
	$category = get_all_articles_with_categories();
	
	$categories = get_main_categories();
	$articles = get_main_articles();

	$author = get_all_articles_author();
    $author = explode(',',$author);
    $allAuthor=array(); //remove duplicate tags
    foreach ($author as $authors):
      if (!in_array(trim($authors), $allAuthor)){
        array_push($allAuthor,trim($authors));
      }	
    endforeach;
?>


<?php foreach($articles as $article): ?>
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

	                    	<a href="<?php echo base_url($permalink)?>" style=""><?php echo date_format($date, "F d, Y");?></a> &nbsp · &nbsp





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
														<label for="cat_<?php echo $category->label; ?>" style="display: inline-block;">
															<i><a href="<?php echo base_url('category/'.$category->permalink) ?>" class="tags"><?php echo $category->label ?></a></i> · 
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
												  endforeach;
												}
												  else {  }?>






	                    	<?php
							    foreach ($allAuthor as $eachAuthor):
							  ?>
								<?php $eachAuthorLink = str_replace(' ', '-', strtolower($eachAuthor));?>
								

							     <a href="<?php echo base_url('author/'.$eachAuthorLink) ?>" class="author"><?php echo $eachAuthor ?></a
						  <?php
							    endforeach;
							  ?> &nbsp

							</p>
							
								<?php echo word_limiter($content, 80); ?>
						
							<!-- <p style="text-align: center;">
	                              <i><a class="readmore" href="<?php //echo base_url($article->permalink);?>" style="text-align: center;">                 
	                              	Continue reading
	                              </a></i>
	                    	</p> -->

									<hr/>

							<?php endforeach; ?>