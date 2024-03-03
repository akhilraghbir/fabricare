<section class="contact-details my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?= base_url('assets/frontend/'); ?>images/login.svg" alt="User Login" class="w-75 d-block mx-auto">
            </div>
            <div class="col-md-6">
                <?php if($this->session->flashdata('emsg')!=''): ?>
                <div class='alert alert-danger' role="alert">
                    <?= $this->session->flashdata('emsg'); ?>
                </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('smsg')!=''): ?>
                <div class='alert alert-success' role="alert">
                    <?= $this->session->flashdata('smsg'); ?>
                </div>
                <?php endif; ?>
                <div class="h3 fw-bold text-theme-dark mb-2 pt-3">Login Here</div>
                <div class="theme-divider"></div>
                    <form method="post" action="<?= base_url('login'); ?>" class="w-75 mt-3">
                        <div class="form-group mb-3">
                            <label for="username">Email address:</label>
                                <input type="email" name="username" class="form-control" placeholder="Enter Username" id="username" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password"  name="password" class="form-control"  placeholder="Enter Password" id="password" aria-describedby="password">
                        </div>
                        <button type="submit" class="btn btn-theme rounded-pill px-5 mt-3"> <i class="fa fa-lock" aria-hidden="true"></i> Login</button>
                        <a  class="btn btn-theme rounded-pill px-5 mt-3" href="<?= base_url('register'); ?>"> <i class="fa fa-user" aria-hidden="true"></i>  Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>