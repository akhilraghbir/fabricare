<!--location validate-->
<div class="modal fade pincodemodal" id="pincodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-theme">
      <div class="modal-body">
        <button type="button" class="btn-close pull-right" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center my-4">
          <img src="<?= base_url('assets/frontend/') ?>images/pincode.png" class="loaction">
        </div>
        <div class="form-group">
          <input type="text" class="form-control Onlynumbers" maxlength="6" id="pincode" placeholder="Enter your area pincode">
        </div>
        <div class="service-info py-2">
          <span class="d-none pincode-check pincode-check-success bg-dark-subtle p-1 px-3 rounded-5 text-success"><i class="bi bi-info-circle-fill"></i> We are serviceable in this area!</span>
          <span class="d-none pincode-check pincode-check-danger bg-dark-subtle p-1 px-3 rounded-5 text-danger"><i class="bi bi-info-circle-fill"></i> Sorry, Our services are not available in this area.</span>
        </div>
        <div class="text-center mt-3">
          <button type="button" onclick="validatePincode()" class="btn btn-theme validate-pincode-btn rounded-pill px-5">Check</button>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="footer bg-dark pt-5 pb-4">
  <div class="container">
    <div class="row border-bottom">
      <div class="col-md-3">
        <div class="my-4">
          <img src="<?= base_url('assets/frontend/') ?>images/logo.svg" class="img-fluid">
        </div>
      </div>
      <div class="col-md-3 footer-links">
        <div class="footer-title">
          <h3 class="text-white font-weight-bold">Quick Links</h3>
          <div class="footer-divider"></div>
        </div>
        <ul class="list-unstyled">
          <li><a href="<?= base_url(); ?>" class="text-light">Home</a></li>
          <li><a href="<?= base_url('about'); ?>" class="text-light">About Us</a></li>
          <li><a href="<?= base_url('services'); ?>" class="text-light">Our services</a></li>
          <li><a href="<?= base_url('contact'); ?>" class="text-light">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-links">
        <div class="footer-title">
          <h3 class="text-white font-weight-bold">Other Links</h3>
          <div class="footer-divider"></div>
        </div>
        <ul class="list-unstyled">
          <li><a href="<?= base_url(); ?>terms-and-conditions" class="text-light">Terms & conditions</a></li>
          <li><a href="<?= base_url(); ?>privacy-policy" class="text-light">Privacy Policy</a></li>
          <li><a href="<?= base_url(); ?>refund-policy" class="text-light">Refund Policy</a></li>
          <li><a href="<?= base_url(); ?>cancellation-policy" class="text-light">Cancellation Policy</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-links">
        <div class="footer-title">
          <h3 class="text-white font-weight-bold">Contact Us</h3>
          <div class="footer-divider"></div>
        </div>
        <ul class="list-unstyled">
          <li><a href="tel:+91 9988776655" class="text-light"><i class="fa fa-phone"></i> +91 9988776655</a></li>
          <li><a href="mailto:info@thefabricare.in" class="text-light"><i class="fa fa-envelope"></i> info@thefabricare.in</a></li>
          <li><a href="https://maps.app.goo.gl/QCeKS4Mg6Vd2NxhQ6?g_st=ic" target="_black" class="text-light"><i class="fa fa-map-marker"></i> Hyderabad</a></li>
        </ul>
      </div>
    </div>
    <hr class="bg-theme-light" />
    <div class="row">
      <div class="col-md-6">
        <p class="footer-credits1 text-light mb-0">© <?= date('Y'); ?> <?= SITENAME; ?>. All Rights Reserved.</p>
      </div>
      <div class="col-md-6">
        <p class="footer-credits2 text-light mb-0">Design &amp; Developed by <a href="https://webartise.com" class="text-theme-light text-decoration-none" rel="nofollow">WebArtise</a></p>
      </div>
    </div>
  </div>
</section>
<div role="alert" aria-live="assertive" aria-atomic="true" class="bg-success success-toast toast" data-autohide="false">
  <div class="success-toast-body toast-body"></div>
</div>
<div role="alert" aria-live="assertive" aria-atomic="true" class="bg-danger error-toast toast" data-autohide="false">
  <div class="errror-toast-body toast-body"></div>
</div>
<div id="data-loader">
  <div id="data-loader-spinner"></div>
</div>
<!--scripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/frontend/') ?>js/main.js"></script>
</body>

</html>