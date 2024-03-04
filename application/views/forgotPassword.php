<section class="inner-banner services-banner">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-white">Forgot Password</h1>
          </div>
        </div>
      </div>
    </section>

<section class="login-block mt-5 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form action="<?= base_url('forgot-password');?>" method="post" class="md-float-material form-material">
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="logo-circle">
                                            <img src="<?= base_url(); ?>assets/backend/images/logo.png" alt="logo.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recover your password</h3>
                                        <?php echo $this->messages->getMessageFront(); ?>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="username" class="form-control">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Your Email Address</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset Password</button>
                                    </div>
                                </div>
                                <p class="f-w-600 text-right"><i class="ti-arrow-left"></i> Back to <a href="<?= base_url();?>" style="color:#4099ff">Login.</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/popper_js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/backend/js/common-pages.js"></script>
