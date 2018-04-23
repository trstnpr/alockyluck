<div class="<?php echo $page; ?>-content">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="content-wrap" data-aos="zoom-in">
                        <div class="logo-brand">
                            <img src="<?php echo base_url('assets/themes/LOCKSMITH/images/logo.png'); ?>" class="img-responsive" alt="ALuckyLock" />
                        </div>
                        
                        <?php include('includes/_alert.php'); ?>

                        <div class="step-wizard">
                            <div class="row step-panel">
                                <div class="col-xs-3 step-item">
                                    <span class="step step1 text-muted active" title="Personal Information">
                                        1
                                        <p class="hidden-xs">Personal Information</p>
                                    </span>
                                </div>
                                <div class="col-xs-3 step-item">
                                    <span class="step step2 text-muted" title="Licenses">
                                        2
                                        <p class="hidden-xs">Licenses</p>
                                    </span>
                                </div>
                                <div class="col-xs-3 step-item">
                                    <span class="step step3 text-muted" title="Download Jao">
                                        3
                                        <p class="hidden-xs">Download Jao</p>
                                    </span>
                                </div>
                                <div class="col-xs-3 step-item">
                                    <span class="step step4 text-muted" title="Agreement">
                                        4
                                        <p class="hidden-xs">Agreement</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-wizard">
                            <form class="form-signup" method="post" data-action="<?php echo base_url('user/signup') ?>" enctype="multipart/form-data">
                                <div class="step-content box-shadow active" id="step-1">
                                    <div class="personal-information">
                                        <h1 class="step-header">Personal Information</h1>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="first_name">Firstname</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your Firstname" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="last_name">Lastname</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Lastname" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email Address" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="phone">Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alt_phone">Other Phone Number</label>
                                                    <input type="text" class="form-control" name="alt_phone" id="alt_phone" placeholder="Your Alternative Phone Number" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Your Home Address" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="city">City</label>
                                                    <input type="text" class="form-control" name="city" id="city" placeholder="Your City Address" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="state">State</label>
                                                    <input type="text" class="form-control" name="state" id="state" placeholder="Your State Address" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="zipcode">Zipcode</label>
                                                    <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Your Zipcode Address" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label" for="country">Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" placeholder="Your Country" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="wizard-content-cta">
                                            <div class="form-group">
                                                <button class="btn btn-primary nextBtn" type="button">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content box-shadow" id="step-2">
                                    <div class="licenses">
                                        <h1 class="step-header">Licenses</h1>
                                        <div class="alert alert-info">
                                            <p>We require all the following licenses:</p>
                                            <ul class="fa-ul">
                                                <li><i class="fa fa-li fa-check-circle"></i> Driver's License<li>
                                                <li><i class="fa fa-li fa-check-circle"></i> Technician License<li>
                                                <li><i class="fa fa-li fa-check-circle"></i> Incorporation License<li>
                                                <li><i class="fa fa-li fa-check-circle"></i> Insurance<li>
                                            </ul>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="license">Attach Files</label>
                                            <input type="file" class="license-files" name="license[]" id="license" accept=".jpg, .png" requred="required" multiple="multiple" />
                                            <p class="help-block">Attached .jpg and .png)</p>
                                        </div>
                                        <br/>
                                        <div class="wizard-content-cta">
                                            <div class="form-group">
                                                <button class="btn btn-danger prevBtn" type="button">Previous</button>
                                                <button class="btn btn-primary nextBtn" type="button">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content box-shadow" id="step-3">
                                    <div class="download-jao">
                                        <h1 class="step-header">Download Jao</h1>
                                        <div class="text-center">
                                            <div class="row">
                                                <?php for($x=1;$x<=4;$x++) { ?>
                                                <div class="col-sm-3 col-xs-6">
                                                    <a href="<?php echo base_url('assets/user/img/jao/jao'.$x.'.png'); ?>" data-lity>
                                                        <img src="<?php echo base_url('assets/user/img/jao/jao'.$x.'.png'); ?>" class="img-responsive" />
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <br/>
                                            <p>Available in Google Playstore. Download Now!</p>
                                            <a href="https://play.google.com/store/apps/details?id=com.lookna.onmyway" target="_blank">
                                                <img src="<?php echo base_url('assets/user/img/badge/badge-playstore-564x168.png'); ?>" class="img-responsive" style="margin:auto;width:200px;" />
                                            </a>
                                        </div>
                                        <br/>
                                        <div class="wizard-content-cta">
                                            <div class="form-group">
                                                <button class="btn btn-danger prevBtn" type="button">Previous</button>
                                                <button class="btn btn-primary nextBtn" type="button">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-content box-shadow" id="step-4">
                                    <div class="agreement">
                                        <h1 class="step-header">Agreement</h1>
                                        <div class="terms-agreement">
                                            <p>Nam quis hendrerit massa. Vivamus purus nisi, consectetur id iaculis et, laoreet vel leo. Vestibulum a felis at metus dapibus suscipit. Cras nec enim arcu. Proin massa metus, elementum quis fringilla id, tempus sed elit. Sed dolor dui, eleifend in sodales ac, volutpat vitae turpis. Aenean non lacinia augue, id rhoncus est. Maecenas consequat id ex et varius. In accumsan, est bibendum commodo sodales, nibh risus porta elit, vitae aliquam libero arcu et nulla. Fusce diam lorem, viverra vitae leo sed, viverra tempor lectus. Pellentesque eu ligula pellentesque, tristique purus ut, pulvinar tortor. Quisque neque libero, euismod a nisi sit amet, tempus ultricies velit. Sed scelerisque tellus ac neque pellentesque facilisis.</p>

                                            <p>Vestibulum sed diam ullamcorper sem venenatis iaculis ut non sem. Cras gravida dictum est gravida rutrum. Cras vel diam risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse convallis, mauris at convallis eleifend, dui nunc auctor sem, id egestas enim turpis in velit. Praesent pellentesque sed nisl a imperdiet. Donec eget nulla eu diam euismod interdum. Donec in nibh posuere quam commodo commodo vel eu risus. Nam sed gravida odio. Cras viverra, felis sed pretium egestas, quam nisl accumsan sapien, sed faucibus mauris ex vel quam.</p>

                                            <p>Quisque mattis, ipsum vel porta luctus, nisl nunc tincidunt felis, ac efficitur mauris risus ac felis. Sed non lectus egestas, scelerisque ante quis, tempus arcu. Nulla ut odio tristique, pretium enim vitae, sagittis purus. Vivamus quis enim sapien. Vestibulum nec vehicula ante. Vestibulum fermentum et nisl placerat ullamcorper. Nullam et tincidunt ex. Curabitur egestas magna enim, volutpat dictum mauris rutrum et. Proin sit amet ullamcorper risus, eu aliquam lectus. Donec sit amet diam hendrerit, tincidunt orci eget, mattis quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas egestas efficitur ullamcorper. Sed ultricies lorem in metus venenatis feugiat. Sed ultricies sapien vel purus pretium, in tristique sem finibus.</p>

                                            <p>Cras gravida, dui et porttitor mattis, nisl nibh tempus lorem, eget molestie sem odio a turpis. Fusce nisi metus, placerat at magna id, gravida pellentesque metus. Aenean at elit pretium, hendrerit est in, tempor metus. Vivamus quam leo, finibus eget sapien a, volutpat bibendum dolor. Suspendisse volutpat ligula eget justo fermentum, ut sollicitudin mi rhoncus. Nullam eu justo vulputate, dictum felis et, auctor lorem. Ut ultricies laoreet purus, in ultrices arcu ultrices id. Pellentesque egestas felis at nisl fringilla, ac molestie nulla dictum.</p>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="agreement" required="required" /> I agree to the term of agreement.
                                                </label>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="wizard-content-cta">
                                            <div class="form-group">
                                                <button class="btn btn-danger prevBtn" type="button">Previous</button>
                                                <button class="btn btn-success btn-submit" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url('user/signin'); ?>" class="text-reset">Already have an account?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>