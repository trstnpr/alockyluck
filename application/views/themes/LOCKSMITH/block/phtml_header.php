
<div class="header">
  


      <div class="probootstrap-header-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
              <span><i class="icon-location2"></i>Malibu, California 90265</span>
              <span><i class="icon-phone2"></i><?php echo get_option('default_phone'); ?></span>
              <!-- <span><i class="icon-mail"></i>info@probootstrap.com</span> -->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
              <!-- <ul>
                <li><a href="#"><i class="icon-twitter"></i></a></li>
                <li><a href="#"><i class="icon-facebook2"></i></a></li>
                <li><a href="#"><i class="icon-instagram2"></i></a></li>
                <li><a href="#"><i class="icon-youtube"></i></a></li>
                <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i class="icon-search"></i></a></li> 
              </ul> -->
            </div>
          </div>
        </div>
      </div>

	

  <div class="header-box">
        <nav class="navbar navbar-default probootstrap-navbar">
        <div class="container">

    <div class="col-md-4 col-sm-3">
    <a href="<?php echo base_url('/') ?>"><img class="logo" src="<?php echo theme_uri()?>images/logo.png" alt=""></a>
    <h2 class="phone visible-xs"><a href="tel:<?php echo get_option('default_phone') ?>"><i class="icon-phone2"></i><?php echo get_option('default_phone'); ?></a></h2>
    </div>

    <div class="col-md-8 col-sm-9">
          <div class="navbar-header">
            <div class="btn-more js-btn-more visible-xs">
              <a href="#"><i class="icon-dots-three-vertical "></i></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <!-- <a class="navbar-brand" href="index.html" title="ProBootstrap:Enlight"></a> -->
          </div>

          <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="<?php echo base_url('/') ?>">Home</a></li>
              <li><a href="<?php echo base_url('about-us') ?>">About Us</a></li>
              <li><a href="<?php echo base_url('terms-and-conditions') ?>">Terms & Conditions</a></li>
              <li><a href="<?php echo base_url('privacy-policy') ?>">Privacy Policy</a></li>
<!--               <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Pages</a>
                <ul class="dropdown-menu">
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="courses.html">Courses</a></li>
                  <li><a href="course-single.html">Course Single</a></li>
                  <li><a href="gallery.html">Gallery</a></li>
                  <li class="dropdown-submenu dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Sub Menu</span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                      <li><a href="#">Second Level Menu</a></li>
                    </ul>
                  </li>
                  <li><a href="news.html">News</a></li>
                </ul>
              </li> -->
              <li><a href="<?php echo base_url('contact-us') ?>">Contact Us</a></li>
            </ul>
          </div>    
          <h2 class="phone hidden-xs"><a href="tel:<?php echo get_option('default_phone') ?>"><i class="icon-phone2"></i><?php echo get_option('default_phone'); ?></a></h2>
      </div>


        </div>
      </nav>
  </div>

</div>

	<!-- <img src="<?php //echo theme_uri() ?>images/bgmain.jpg" width="100%"> -->


<?php load_block('phtml_banner_services'); ?>


