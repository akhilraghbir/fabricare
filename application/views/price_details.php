<?php 
$total = 0.00;
$grand_total = 0.00;
$discountPer = $discount = $loop=0;
foreach($items as $item){
    $loop++;
    $total+=$item['quantity'] * $item['price'];
}

if(count($coupons)>0){
    $discounttype = $coupons[0]['promocode_type'];
    if($discounttype == 'Flat'){
        $discount = $coupons[0]['discount_value'];
    }else{
        $discountPer = $coupons[0]['discount_value'];
        $discount = ($total * $discountPer)/100;
    }
}
$grand_total = $total + $service_charge - $discount;
?>
<div class="card-header">
    <span class="text-secondary card-title fw-bold">PRICE DETAILS</span>
</div>
<div class="card-body">
<table class="table table-borderless mb-0">
    <tbody>
    <tr>
        <td>Price <span class="itemscount">(<?= $loop; ?> items)</span></td>
        <td class="text-end"><i class="bi bi-currency-rupee"></i> <span class="sub_total"><?= number_format($total, 2); ?></span></td>
    </tr>
    <?php 
    if($discount>0){
    ?>
    <tr>
        <td>Discount <span class="discountAmt"><?= ($discountPer!=0) ? $discountPer.'%' : ''; ?></span></td>
        <td class="text-end"><i class="bi bi-currency-rupee"></i> <span class="discountAmt"><?= number_format($discount);?></span></td>
    </tr>
    <?php } ?>
    <tr>
        <td>Service Charge</td>
        <td class="text-end"><i class="bi bi-currency-rupee"></i> <?= $this->session->service_charge; ?></td>
    </tr>
    <tr class="border-top">
        <td class="fw-bold h5">Total Amount</td>
        <td class="fw-bold text-end h5"><i class="bi bi-currency-rupee"></i> <span class="grand_total"><?= number_format($grand_total, 2); ?></span></td>
    </tr>
    </tbody>
</table>
</div>