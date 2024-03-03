<section class="contact-details my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?= base_url('assets/frontend/');?>images/register.svg" alt="User Registration" class="w-75 d-block mx-auto">
            </div>
            <div class="col-md-6">
            <?php if($this->session->flashdata('emsg')!=''): ?>
                <div class='alert alert-danger' role="alert">
                    <?= $this->session->flashdata('emsg'); ?>
                </div>
                <?php endif; ?>
            <div class="h3 fw-bold text-theme-dark mb-2 pt-5">Register Here</div>
                <div class="theme-divider"></div>
                    <form method="post" action="<?= base_url('register'); ?>" class="w-75 mt-3">
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Name:</label>
                            <input type="text" name="first_name" placeholder="Enter Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Email address:</label>
                            <input type="email" name="username" placeholder="Enter Username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Phone Number:</label>
                            <input type="text" name="phno" maxlength="10" placeholder="Enter Mobile No" class="numberOnly form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Set Password:</label>
                            <input type="password" name="password"  class="form-control" placeholder="Enter Password" id="password" aria-describedby="password">
                        </div>
                        <button type="submit" class="btn btn-theme rounded-pill px-5 mt-3"> <i class="fa fa-lock" aria-hidden="true"></i> Register</button>
                    </form>
            </div>
        </div>
    </div>
</section>