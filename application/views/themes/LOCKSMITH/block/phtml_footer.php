
      
      <section class="probootstrap-cta">
        <div class="container">
          <div class="row">

            <div class="col-md-12">
              <div class="probootstrap-animate" data-animate-effect="fadeInBottom"><?php load_block('phtml_social')?></div>
              
            </div>
          </div>
        </div>
      </section>


      <footer class="probootstrap-footer probootstrap-bg">
        <div class="container">
          <div class="row">

            <div class="col-md-6">
              <div class="probootstrap-footer-widget call probootstrap-animate">
                <!-- <h3>Contact Info</h3> -->
                <h3>Contact <span>Us</span></h3>
                <ul class="probootstrap-contact-info">
                  <li><i class="icon-location2"></i> <span>22609 Pacific Coast Hwy, Malibu, CA 90265</span></li>
                   <li><i class="icon-mail"></i><span><?php echo get_option('email_admin'); ?></span></li> 
                   <li><i class="fa fa-globe"></i><span>www.aLuckyLuck.com</span></li>
                  <!-- <li><i class="icon-phone2"></i><span><?php //echo get_option('default_phone'); ?></span></li> -->                  
                  <li><a href="tel:<?php echo get_option('default_phone') ?>"><h3 class="footer-call"><i class="icon-phone2"></i><span><?php echo get_option('default_phone'); ?></span></h3></a></li>               
                </ul>
              </div>
            </div>

            <div class="col-md-6">
              <div class="probootstrap-footer-widget probootstrap-animate">
                <!-- <h3>Map</h3> -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d826.5371917232291!2d-118.6679574708064!3d34.040054798788084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2a0813297e55f%3A0xfbb9b5c9fd7561eb!2s22609+Pacific+Coast+Hwy%2C+Malibu%2C+CA+90265%2C+USA!5e0!3m2!1sen!2sph!4v1520854998145" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

              </div>
            </div>


           
          </div>
          <!-- END row -->
          
        </div>

        <div class="probootstrap-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8 text-left">
                <p>ALL RIGHTS RESERVED &copy; <?php echo '<a style="" href="'.base_url().'">'.get_option('site_title').'</a> '.date('Y'); ?></p>
              </div>
              <div class="col-md-4 probootstrap-back-to-top">
                <p><a href="#" class="js-backtotop">Back to top <i class="icon-arrow-long-up"></i></a></p>
              </div>
            </div>
          </div>
        </div>
      </footer>


      <div class="footer_buttons visible-xs">

       <div class="callus_area">
         <a href="tel: <?php echo get_option('default_phone') ?>" style="display: block;"><span class="blink_me">  <img src="<?php echo theme_uri()?>/images/phone.png" border="0" height="50" width="50"> CALL US NOW!</span></a>
       </div>

      </div>  
