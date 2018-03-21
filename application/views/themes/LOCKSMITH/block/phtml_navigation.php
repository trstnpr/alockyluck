<section id="head">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img class="logo" src="<?php echo theme_uri().'images/logo.png' ?>" alt="">
            </div>
            <div class="col-md-6" align="right">
                <a class="nav-link" href="tel: <?php echo get_option('default_phone'); ?>" class="fw-700" style="color: #ffffff;font-size:1.5em;">Call Us Today: <br class="visible-xs"><?php echo get_option('default_phone'); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- NAVIGATION HERE -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FFD200;">
     <div class="container">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/') ?>">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('about-us') ?>">About Us</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('terms-and-conditions') ?>">Terms & Conditions</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('privacy-policy') ?>">Privacy Policy</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo base_url('contact-us') ?>">Contact Us</a>
          </li>
        </ul>

      </div>
     </div>
</nav>