<section class="inner-banner contact-banner">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-white">CONTACT US</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="contact-details-in py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="contact-content mb-3">
              <div class="contact-address"> 
                <img src="<?= base_url('assets/frontend/'); ?>images/location.png" class="c-icon mb-3">                               
                <div class="details">
                  <h3 class="text-secondary">Our Address</h3>
                  <p><?= $details[0]['address']; ?></p>
                </div>
              </div>
            </div>
            <div class="contact-content mb-3">
              <div class="contact-address">  
                <img src="<?= base_url('assets/frontend/'); ?>images/mail.png" class="c-icon mb-3" alt="call us">
                <div class="details">
                  <h3 class="text-secondary">Mail Us</h3>
                  <p><a href="mailto:<?= $details[0]['contact_email']; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?= $details[0]['contact_email']; ?></a></p>
                </div>
              </div>
            </div>
            <div class="contact-content mb-3">
              <div class="contact-address">  
                <img src="<?= base_url('assets/frontend/'); ?>images/call.png" class="c-icon mb-3" alt="call us">
                <div class="details">
                  <h3 class="text-secondary">Call us</h3>
                  <p class="mb-1 mt-3"><a href="tel:<?= $details[0]['contact_phno']; ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?= $details[0]['contact_phno']; ?></a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 offset-md-1">
            <div class="contact-form">
              <h1 class="text-center mb-5">Give us a shout. <br>Speak to an expert.</h1>
              <?php if($this->session->flashdata('smsg')!=''): ?>
                <div class='alert alert-success' role="alert">
                    <?= $this->session->flashdata('smsg'); ?>
                </div>
                <?php endif; ?>
              <form action="<?= base_url('contact') ?>" method="post">
                <div class="mb-3">
                  <label for="fullname" class="form-label">Full Name:</label>
                  <input type="text" name="name" placeholder="Enter Name" class="form-control" id="fullname">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address:</label>
                  <input type="email"  name="email_id" placeholder="Enter Email" class="form-control" id="exampleFormControlInput1" >
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone Number:</label>
                  <input type="text"  name="phno" placeholder="Enter Number" maxlength="10" class="numberOnly form-control" id="phone" >
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Message:</label>
                  <textarea class="form-control" name="message" placeholder="Enter Message Here" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="text-center">
                  <button class="btn btn-theme rounded-pill px-4" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>  
    </section>