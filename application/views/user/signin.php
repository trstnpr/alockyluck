<div class="<?php echo $page; ?>-content">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="content-wrap" data-aos="zoom-in">
                        <div class="logo-brand">
                            <img src="<?php echo base_url('assets/themes/LOCKSMITH/images/logo.png'); ?>" class="img-responsive" alt="ALuckyLock" />
                        </div>
                        
                        <?php include('includes/_alert.php'); ?>

                        <div class="form-wrap box-shadow">
                            <h1 class="form-header">Sign In</h1>
                            <form class="form-signin" method="post" data-action="<?php echo current_url(); ?>">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your email" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your password" />
                                </div>
                                <br/>
                                <div class="form-cta">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-submit">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url('user/signup'); ?>" class="text-reset">No account yet?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>