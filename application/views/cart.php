<section class="cart-page py-5 text-dark">
      <div class="container">
        <div class="h2 text-center mb-4">Bag</div>
        <?php if(is_array($items) && count($items)>0){?>
        <div class="row item-div">
          <div class="col-md-9">
            <div class="cart-products-list">
            <?php
                $service_charge = $this->session->service_charge;
                $total = $loop = 0; foreach($items as $item){ 
                $price = $item['price']*$item['quantity'];
                $total+=$price;
            ?>
              <div class="card product-card product-card_<?= $item['id'];?>">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img src="<?= base_url($item['image']); ?>" alt="product name">
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <div class="d-flex justify-content-between">
                        <span class="h3"><?= $item['product_name'];?></span>
                        <span class="price"><i class="bi bi-currency-rupee"></i> <span class="price_<?= $item['id'];?>"><?= number_format($price,2);?></span></span>
                      </div>
                      <div class="d-flex align-items-center justify-content-between">
                        <span class="service-type"><?= $item['service_name'];?></span>
                        <span class="quantity">
                          <select class="form-select quantity_<?= $item['product_id'];?>_<?= $item['service_id']; ?> " onchange="updatecart(<?= $item['product_id']; ?>,<?= $item['service_id']; ?>,<?= $item['price']; ?>,<?= $item['id'];?>)" aria-label="Default select example">
                            <?php for($i=1;$i<=10;$i++){?>
                                <option value="<?= $i; ?>" <?= ($i==$item['quantity']) ? 'selected' : '';?>><?= $i; ?></option>
                            <?php } ?>
                          </select>
                        </span>
                        <span class="addcart">
                          <a href="javascript:void()" onclick="removeCart(<?= $item['id']; ?>)" class="text-theme-dark2 text-decoration-none">Remove</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $loop++;} ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card shadow-sm mb-4">
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="card-title text-secondary fw-bold d-inline mb-0">Select Address</span>
                  <span><a href="/" class="text-theme-dark2 small text-decoration-none">Add New</a></span>
                </div>
                  <select name="address_id"  id="address_id" class="form-select">
                    <option value="">Select Address</option>
                    <?php if(is_array($address) && count($address)){ 
                      foreach($address as $addr){
                    ?>
                      <option value="<?= $addr['id'];?>"><?= $addr['address_title'];?></option>
                    <?php } }?>
                  </select>
              </div>
            </div>
            <div class="card shadow-sm mb-4">
              <div class="card-header">
                <div class="card-title text-secondary fw-bold">Select Pick Up Date</div>
                  <input type="datetime-local" class="form-control" id="pickup_date" name="pickup_date" min="<?= date('Y-m-d h:i:s'); ?>">
              </div>
            </div>
            <div class="card cart-card card-price-details shadow-sm mb-4">
              <div class="card-header">
                <span class="text-secondary card-title fw-bold">PRICE DETAILS</span>
              </div>
              <div class="card-body ">
                <table class="table table-borderless mb-0">
                  <tbody>
                    <tr>
                      <td>Price <span class="itemscount">(<?= $loop; ?> items)</span></td>
                      <td class="text-end"><i class="bi bi-currency-rupee"></i> <span class="sub_total"><?= number_format($total,2);?></span></td>
                    </tr>
                    <tr>
                      <td>Service Charge</td>
                      <td class="text-end"><i class="bi bi-currency-rupee"></i> <?= $service_charge;?></td>
                    </tr>
                    <tr class="border-top">
                      <td class="fw-bold h5">Total Amount</td>
                      <td class="fw-bold text-end h5"><i class="bi bi-currency-rupee"></i> <span class="grand_total"><?= number_format($total+$service_charge,2);?></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <div class="card-title text-secondary fw-bold">
                  APPLY COUPON
                </div>
              </div>
              <div class="card-body">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control coupon" placeholder="Enter Coupon Here" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-theme" type="button" onclick="applyCoupon()" id="button-addon2">Apply</button>
                  </div>
                  <p class="coupon_response"></p>
              </div>
            </div>
            <button class="btn btn-lg btn-theme my-3 w-100 rounded-pill" onclick="placeOrder()">Place Order</button>
          </div>
        </div>
        <?php } ?>
        <div class="row <?= ($loop>0) ? 'd-none' : '';?> no-item-div bg-light rounded p-4">
            <div class="col-md-12 text-center">
                <img src="<?= base_url('assets/frontend/images/shopping-bag.png') ?>">
                <div class="h5 mt-3">Your Bag is empty</div>
            </div>
        </div>
      </div>
    </section>