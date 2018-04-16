
<?php 

	$get_articles = get_main_articles();
	$get_articles = $this->article_model->get_all(array('order_by'=>'created DESC'));

?>


<div class="row">

<div class="recent-blog">
	

<h2 class="recent-blog-title"> <i class="fa fa-caret-right" style="color: #ee721e;"></i> Recent Blog</h2>

<ul>

<?php	foreach($get_articles as $article): 

$title = $article->title;
$created = $article->created;
$date = date("m-d-Y", strtotime($created));
$permalink = $article->permalink;

$rcpost = 0;
$limit = 10; //EDIT HERE, set number limit of post

?>

	<!-- <h4><a href="<?php //echo base_url($permalink)?>"> <i class="fa fa-angle-right"></i> <?php echo ($title);?></a></h4>
	 -->
	<li><a href="<?php echo base_url($permalink)?>"> <i class="fa fa-angle-right"></i> <?php echo ($title);?></a><!-- <span><?php //echo ($date);?></span> --></li>

    <?php
    $rcpost++;

    if ($rcpost == $limit){
      break;
    }
    
  endforeach;
  ?>
	</ul>

</div>

</div>