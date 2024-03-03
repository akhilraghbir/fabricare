<section class="inner-banner schedule-banner">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-white">Schdule Pickup</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="price-list py-5 text-dark">
      <div class="container">
        <nav class="category-items">
          <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
              <img src="<?= base_url('assets/frontend/'); ?>images/li1.png" class="list-cat-icon">
              Clothes
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
              <img src="<?= base_url('assets/frontend/'); ?>images/li2.png" class="list-cat-icon">
              Household
            </button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
              <img src="<?= base_url('assets/frontend/'); ?>images/li3.png" class="list-cat-icon">
              Curtains
            </button>
            <button class="nav-link" id="nav-shoes-tab" data-bs-toggle="tab" data-bs-target="#nav-shoes" type="button" role="tab" aria-controls="nav-shoes" aria-selected="false">
              <img src="<?= base_url('assets/frontend/'); ?>images/li4.png" class="list-cat-icon">
              Shoes Cleaning
            </button>
          </div>
        </nav>
        <div class="tab-content p-3" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
              <div class="col-md-3 left-nav">
                <nav class="sub-category">
                  <div class="nav nav-tabs mb-3 border-0" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-sub1-tab" data-bs-toggle="tab" data-bs-target="#nav-sub1" type="button" role="tab" aria-controls="nav-sub1" aria-selected="true">
                      Apparels
                    </button>
                    <button class="nav-link" id="nav-sub2-tab" data-bs-toggle="tab" data-bs-target="#nav-sub2" type="button" role="tab" aria-controls="nav-sub2" aria-selected="false">
                      Linens
                    </button>
                    <button class="nav-link" id="nav-sub3-tab" data-bs-toggle="tab" data-bs-target="#nav-sub3" type="button" role="tab" aria-controls="nav-sub3" aria-selected="false">
                      Premium/Wedding Wear
                    </button>
                    <button class="nav-link" id="nav-sub4-tab" data-bs-toggle="tab" data-bs-target="#nav-sub4" type="button" role="tab" aria-controls="nav-sub4" aria-selected="false">
                      Woolen/Silks
                    </button>
                  </div>
                </nav>
              </div>
              <div class="col-md-9">
                <div class="tab-content p-3" id="nav-tabContent2">
                  <div class="tab-pane fade active show" id="nav-sub1" role="tabpanel" aria-labelledby="nav-sub1-tab">
                    <div class="main-products-list">
                      <div class="card product-card">
                        <div class="card-body">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="<?= base_url('assets/frontend/'); ?>images/product1.png" alt="product name">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <div class="d-flex justify-content-between">
                                <span class="h3">Shirt</span>
                                <span class="price"><i class="bi bi-currency-rupee"></i> 100</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                                <span class="service-type">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Wash only</option>
                                    <option value="1">Wash only</option>
                                    <option value="2">Wash & Iron</option>
                                    <option value="3">Dry Clean</option>
                                  </select>
                                </span>
                                <span class="quantity">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                  </select>
                                </span>
                                <span class="addcart">
                                  <button class="btn btn-theme rounded-circle"><i class="bi bi-bag-plus"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card product-card">
                        <div class="card-body">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="<?= base_url('assets/frontend/'); ?>images/product2.png" alt="product name">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <div class="d-flex justify-content-between">
                                <span class="h3">Tshirt</span>
                                <span class="price"><i class="bi bi-currency-rupee"></i> 70</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                                <span class="service-type">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Wash only</option>
                                    <option value="1">Wash only</option>
                                    <option value="2">Wash & Iron</option>
                                    <option value="3">Dry Clean</option>
                                  </select>
                                </span>
                                <span class="quantity">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                  </select>
                                </span>
                                <span class="addcart">
                                  <button class="btn btn-theme rounded-circle"><i class="bi bi-bag-plus"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card product-card">
                        <div class="card-body">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="<?= base_url('assets/frontend/'); ?>images/product3.png" alt="product name">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <div class="d-flex justify-content-between">
                                <span class="h3">Jeans Pant</span>
                                <span class="price"><i class="bi bi-currency-rupee"></i> 90</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                                <span class="service-type">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Wash only</option>
                                    <option value="1">Wash only</option>
                                    <option value="2">Wash & Iron</option>
                                    <option value="3">Dry Clean</option>
                                  </select>
                                </span>
                                <span class="quantity">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                  </select>
                                </span>
                                <span class="addcart">
                                  <button class="btn btn-theme rounded-circle"><i class="bi bi-bag-plus"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card product-card">
                        <div class="card-body">
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="<?= base_url('assets/frontend/'); ?>images/product4.png" alt="product name">
                            </div>
                            <div class="flex-grow-1 ms-3">
                              <div class="d-flex justify-content-between">
                                <span class="h3">Jacket</span>
                                <span class="price"><i class="bi bi-currency-rupee"></i> 120</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-between">
                                <span class="service-type">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Wash only</option>
                                    <option value="1">Wash only</option>
                                    <option value="2">Wash & Iron</option>
                                    <option value="3">Dry Clean</option>
                                  </select>
                                </span>
                                <span class="quantity">
                                  <select class="form-select" aria-label="Default select example">
                                    <option selected>Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                  </select>
                                </span>
                                <span class="addcart">
                                  <button class="btn btn-theme rounded-circle"><i class="bi bi-bag-plus"></i></button>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav-sub2" role="tabpanel" aria-labelledby="nav-sub2-tab">
                      Sub category tab 2
                  </div>
                  <div class="tab-pane fade" id="nav-sub3" role="tabpanel" aria-labelledby="nav-sub3-tab">
                      Sub category tab 3
                  </div>
                  <div class="tab-pane fade" id="nav-sub4" role="tabpanel" aria-labelledby="nav-sub4-tab">
                      Sub category tab 4
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              Main category tab 2
          </div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                Main category tab 3
          </div>
          <div class="tab-pane fade" id="nav-shoes" role="tabpanel" aria-labelledby="nav-shoes-tab">
                Main category tab 3
          </div>
        </div>
      </div>
    </section>