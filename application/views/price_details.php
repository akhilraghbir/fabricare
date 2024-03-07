<?php 
$total = 0.00;
$grand_total = 0.00;
$loop=0;
foreach($items as $item){
    $loop++;
    $total+=$item['quantity'] * $item['price'];
}
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
    <tr>
        <td>Service Charge</td>
        <td class="text-end"><i class="bi bi-currency-rupee"></i> <?= $this->session->service_charge; ?></td>
    </tr>
    <tr class="border-top">
        <td class="fw-bold h5">Total Amount</td>
        <td class="fw-bold text-end h5"><i class="bi bi-currency-rupee"></i> <span class="grand_total"><?= number_format($total + $service_charge, 2); ?></span></td>
    </tr>
    </tbody>
</table>
</div>