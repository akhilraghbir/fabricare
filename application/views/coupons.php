<section class="offers-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-title py-3 text-center font-weight-bold">Coupons</h4>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($coupons)) {
                foreach ($coupons as $coupon) {
            ?>
                    <div class="col-md-3">
                        <div class="card shadow rounded-lg bg-light mb-4">
                            <div class="card-body">
                                <h3><?= $coupon['coupon_title']; ?></h3>
                                <p class="mb-0"><?= $coupon['description']; ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>
                                        <h4 id="p1<?= $coupon['id']; ?>" class="font-weight-bold text-theem-dark2 mb-0"><?= $coupon['promocode']; ?></h4>
                                    </span>
                                    <span>
                                        <button onclick="copyToClipboard('#p1<?= $coupon['id']; ?>')" class="clipboard btn border-dark" title="Click to Copy"><i class="fa fa-copy" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>

            <?php } ?>
        </div>
    </div>
</section>