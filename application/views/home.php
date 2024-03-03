
    <section class="slider-section">
      <div id="carouselExampleCaptions" class="carousel slide">
        <!-- <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
          <?php if(!empty($sliders)){ 
            foreach($sliders as $slider){
          ?>
          <div class="carousel-item">
            <img src="<?= base_url($slider['banner_img']) ?>" class="d-block w-100" alt="...">
            <div class="bg-overley"></div>
            <div class="carousel-caption">
              <div class="h1 fw-bold"><?= ($slider['banner_title']) ? $slider['banner_title'] : ''; ?></div>
              <p class="sub-title"><?= ($slider['banner_sub_title']) ? $slider['banner_sub_title'] : ''; ?></p>
              <?php if(!empty($slider['action_link'])) { ?>
              <p><a href="<?= $slider['action_link']; ?>" class="btn btn-theme rounded-pill px-4 fw-semibold">Schedule Pickup</a></p>
              <?php } ?>
            </div>
          </div>
          <?php } } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>
    <section class="about-sec my-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="img-box1">
              <div class="img1"><img src="<?= base_url('assets/frontend/') ?>images/about_1.jpg" alt="About" class="rounded-5"></div>
              <div class="img2"><img src="<?= base_url('assets/frontend/') ?>images/about_2.jpg" alt="About"></div>
              <div class="th-experience jump">
                <h3 class="experience-year"><span class="counter-number">24</span>+</h3>
                <p class="experience-text">Years</p>
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="ps-xl-4">
              <div class="mb-2"><span class="sub-title">About Us</span>
                <div class="h1">Experience the Pinnacle of Laundry Excellence</div>
                <p class="text-secondary">Specify the range of services your laundry offers, including wash and fold, dry cleaning, ironing, stain removal, and any specialized treatments for delicate fabrics or special garments.</p>
              </div>
              <div class="checklist">
                <ul class="list-unstyled">
                  <li>Pickup and Delivery Service</li>
                  <li>Energy-Efficient Machines</li>
                  <li>Same-Day or Express Service</li>
                  <li>Folding Preferences</li>
                  <li>Hanging or Bagging Options</li>
                  <li>Satisfaction Guarantee</li>
                </ul>
              </div>
              <a href="<?= base_url(); ?>about" class="btn btn-theme rounded-pill px-4 fw-semibold shadow-sm">More About Us</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="feature-area">
      <div class="container">
        <div class="row py-4 j dflex ustify-content-center">
          <div class="col-md-4">
            <div class="feature-item ">
              <div class="feature-item_icon"><img src="<?= base_url('assets/frontend/') ?>images/feature_1_1.svg" alt="icon"></div>
              <div class="media-body">
                <h3 class="box-title">100% Happiness Guarantee</h3>
                <p class="feature-item_text">Emphasize the use of high-quality detergents, fabric softeners.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-item">
              <div class="feature-item_icon"><img src="<?= base_url('assets/frontend/') ?>images/feature_1_2.svg" alt="icon"></div>
              <div class="media-body">
                <h3 class="box-title">Free Collection &amp; Delivery</h3>
                <p class="feature-item_text">Emphasize the use of high-quality detergents, fabric softeners.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-item">
              <div class="feature-item_icon"><img src="<?= base_url('assets/frontend/') ?>images/feature_1_3.svg" alt="icon"></div>
              <div class="media-body">
                <h3 class="box-title">24/7 Dedicated Support</h3>
                <p class="feature-item_text">Emphasize the use of high-quality detergents, fabric softeners.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="services-sec bg-light py-5 mt-5">
      <div class="container">
        <div class="text-center text-dark h1 fw-bold">Our Best Laundry Services For You!</div>
        <div class="service-slider py-3">
          <?php if(!empty($services)){
            foreach($services as $service){
          ?>
          <div class="service-box">
            <div class="service-box_wrapper">
              <div class="service-box_img"><img src="<?= base_url($service['web_banner']); ?>" alt="img"></div>
              <div class="service-box_icon"><img src="<?= base_url($service['web_image']) ?>" alt="Icon"></div>
            </div>
            <div class="box-content background-image" style="background-image: url('images/service_shape_1.png');">
              <h3 class="box-title"><a href="<?= base_url(); ?>schedule-pickup"><?= $service['service_name'] ?></a></h3>
              <p class="service-box_text"><?= $service['description'];?></p><a href="<?= base_url(); ?>schedule-pickup" class="btn btn-theme px-4 rounded-pill">Order Now</a>
            </div>
          </div>
          <?php } } ?>
        </div>
      </div>
    </section>
    <section class="bg-theme py-5 overflow-hidden">
      <div class="container-sm">
        <div class="text-center text-theme-light h1 fw-bold">How We Work It!</div>
        <div class="step-wrap">
          <div class="process-line"></div>
          <div class="row py-4 justify-content-center">
              <div class="col-md-4">
                  <div class="process-card">
                      <div class="box-icon"><img src="<?= base_url('assets/frontend/') ?>images/p1.png" alt="icon"></div>
                      <div class="box-content">
                          <div class="box-top">
                              <p class="box-number">Step - 01</p>
                              <h3 class="box-title">Schedule Your Service</h3>
                          </div>
                          <p class="box-text">Begin by scheduling your laundry service. You can choose from our convenient options</p>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="process-card active">
                      <div class="box-icon"><img src="<?= base_url('assets/frontend/') ?>images/p2.png" alt="icon"></div>
                      <div class="box-content">
                          <div class="box-top">
                              <p class="box-number">Step - 02</p>
                              <h3 class="box-title">Expert Cleaning Process</h3>
                          </div>
                          <p class="box-text">Once we receive your laundry, our skilled team takes over. Your cloth are sorted based.</p>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="process-card">
                      <div class="box-icon"><img src="<?= base_url('assets/frontend/') ?>images/p3.png" alt="icon"></div>
                      <div class="box-content">
                          <div class="box-top">
                              <p class="box-number">Step - 03</p>
                              <h3 class="box-title">Packaging and Delivery</h3>
                          </div>
                          <p class="box-text">We take pride in using eco-friendly packaging materials. If you've opted for our pickup.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
    </section>