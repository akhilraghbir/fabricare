  <section class="orders-page">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h4 class="page-title py-3 text-center font-weight-bold">My Orders</h4>
              </div>
              <div class="col-md-12">
                  <?php if (!empty($orders)) { ?>
                      <div class="order-items">
                          <?php
                            foreach ($orders as $order) {
                                $oid = $order["id"];
                                $oclass = $cancel = '';
                                $curdate = date_create(date('Y-m-d'));
                                $ordate = date_create($order['created_on']);
                                if ($order['status'] == 'Pending') {
                                    $oclass = "text-warning";
                                    $cancel = "<button onclick='cancel_order($oid)' class='btn btn-sm btn-danger'><i class='bi bi-x-square-fill'></i> Cancel</button>";
                                } else if ($order['status'] == 'Pending' || $order['status'] == 'Picked') {
                                    $oclass = "text-info";
                                } else if ($order['status'] == 'Delivered') {
                                    $oclass = "text-success";
                                } else if ($order['status'] == 'Cancelled') {
                                    $oclass = "text-danger";
                                }
                            ?>
                              <div class="card shadow-sm mb-3">
                                  <div class="card-body">
                                      <div class="items">
                                          <div class="media">
                                              <img src="<?= base_url('assets/frontend/'); ?>images/order_image.jpg" class="mr-3 rounded-lg" alt="item name">
                                              <div class="media-body">
                                                  <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                      <span>
                                                          <h5 class="mt-0"><?= $order['reference_number']; ?></h5>
                                                      </span>
                                                      <span>
                                                          <h6 class="<?= $oclass; ?> font-weight-bold"><?= $order['status']; ?></h6>
                                                      </span>
                                                  </div>
                                                  <div class="d-flex align-items-center justify-content-between wl-proSpecs mt-2">
                                                      <span class="fl-div">
                                                          <p class="text-secondary mb-0 font-weight-bold">Ordered on : <?= date('l jS , F Y', strtotime($order['insert_dt'])); ?></p>
                                                      </span>
                                                      <span class="fl-div">
                                                          <p class="text-dark mb-0 font-weight-bold">Total : <i class="<?= $currency; ?>" aria-hidden="true"></i> <?= $order['grand_total']; ?></p>
                                                      </span>
                                                      <?php if ($order['payment_status'] == 'Pending' && $order['status'] != 'Cancelled') { ?>
                                                          <span class="fl-div">
                                                              <span class="item-cartPrice font-weight-bold"> <a href="<?= base_url('payment/' . base64_encode($order['reference_number'])); ?>"><button class='btn btn-sm btn-warning'><i class='bi bi-cash-stack'></i> Complete Payment</button></a> </span>
                                                          </span>
                                                      <?php } ?>
                                                      <span class="fl-div">
                                                          <a class="btn btn-sm  btn-info rounded-pill invoice" target="_blank" href="<?= base_url('view-invoice/' . base64_encode($order['reference_number'])); ?>"><i class="bi bi-file-earmark-pdf"></i> View invoice</a>
                                                      </span>

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <?php } ?>
                      </div>
                  <?php } else { ?>
                      <img class="img-fluid image_center_div" src="<?= base_url('assets/frontend/images/empty-concept-illustration_114360-1253.jpg'); ?>">
                  <?php } ?>
              </div>
          </div>
      </div>
      <div class="modal fade" id="cancelorder_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" id="cancelorder">
                          <div class="form-group">
                              <label for="message-text" class="col-form-label">Reason for cancellation:</label>
                              <textarea class="form-control" id="message" required name="message" placeholder="Reason for cancellation"></textarea>
                              <input type="hidden" name="orderid" class="orderid" value="">
                          </div>
                          <div class="form-group">
                              <button type="submit" name="submit" class="cobtn btn btn-primary"><i class="bi bi-check"></i> Submit</button>
                          </div>
                      </form>
                  </div>

              </div>
          </div>
      </div>
  </section>