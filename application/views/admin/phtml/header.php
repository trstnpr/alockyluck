

		<nav class="top-bar">

		  <ul class="title-area">

		    <!-- Title Area -->

		    <li class="name">

		      <h1><a href="<?php echo base_url() ?>">Front End</a></h1>

		    </li>

		  </ul>

		

		  <section class="top-bar-section">

		    <!-- Left Nav Section -->

		    <ul class="left">

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/') ?>">Dashboard</a></li>

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/page') ?>">Pages</a></li>
		      
		      <li class="divider"></li>

		      <li class="has-dropdown" ><a href="<?php echo base_url('admin/article') ?>">Post</a>

		      	<ul class="dropdown">

	              <li><label>Post information</label></li>

	              <li><a href="<?php echo base_url('admin/article') ?>">All Post</a></li>

	              <li><a href="<?php echo base_url('admin/article/add') ?>">Add Post</a></li>

	            </ul>

		      </li>

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/category') ?>">Category</a></li>

		      <!-- <li class="divider"></li>

		      <li class="has-dropdown" ><a href="<?php //echo base_url('admin/post') ?>">Blog</a>

		      	<ul class="dropdown">

	              <li><label>Blog Post information</label></li>

	              <li><a href="<?php //echo base_url('admin/post') ?>">All Blog Post</a></li>

	              <li><a href="<?php //echo base_url('admin/post/add') ?>">Add Post</a></li>

	            </ul>

		      </li> -->

		      <li class="divider"></li>

		      

		      <li class=""><a href="<?php echo base_url('admin/states') ?>">States</a></li>

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/cities') ?>">Cities</a></li>

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/config') ?>">Configuration</a></li>

		      <li class="divider"></li>

		    </ul>

		

		   <ul class="right">

			  <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/maintenance/php_info') ?>">PHP Info</a></li>

		   	  <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/import') ?>">Import</a></li>

		      <li class="divider"></li>

		      <li class=""><a href="<?php echo base_url('admin/logout') ?>">Logout</a></li>

		      

		    </ul>

		  </section>

		</nav>