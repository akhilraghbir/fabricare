<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?= SITENAME ?> | Razorpay Payment</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="https://ktssilverworld.com/assets/frontend/scss/custom.css"/>
</head>
<body class="finalPay-page">
<?php
$description        = 'Product Purchase - '.date("YmdHis");
$txnid              = date("YmdHis");     
$key_id             = RAZORPAY_KEY;
$currency_code      = $currency_code;            
$total              = ($amount* 100); // 100 = 1 indian rupees
$amount             = $amount;
$merchant_order_id  = $order_number;
$card_holder_name   = 'Junaid Shaikh';
$email              = $email;
$phone              = $phno;
$name               = $username;
?>

<section class="py-5 my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card bg-light shadow">
                    <div class="card-body text-center">
                        <form name="razorpay-form" id="razorpay-form"  action="<?php echo $callback_url; ?>" method="POST">
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                            <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                            <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                            <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
                            <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                            <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                            <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                            <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                            <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
                        </form>
                        <div class="payment_wrapper">
                            <h6 class="mb-3">Please click on the <strong>Pay now</strong> to choose the payment method.</h6>
                            <input  id="pay-btn" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-info px-4 rounded-pill" />
                            <p class="mt-3"><strong>Note:</strong> Don't reload or refresh the page </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            key:            "<?php echo $key_id; ?>",
            amount:         "<?php echo $total; ?>",
            name:           "<?php echo $name; ?>",
            description:    "Order # <?php echo $merchant_order_id; ?>",
            netbanking:     true,
            currency:       "<?php echo $currency_code; ?>", // INR
            prefill: {
                name:       "<?php echo $card_holder_name; ?>",
                email:      "<?php echo $email; ?>",
                contact:    "<?php echo $phone; ?>"
            },
            notes: {
                soolegal_order_id: "<?php echo $merchant_order_id; ?>",
            },
            handler: function (transaction) {
                document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
                document.getElementById('razorpay-form').submit();
            },
            "modal": {
                "ondismiss": function(){
                    location.reload()
                }
            }
        };

        var razorpay_pay_btn, instance;
        function razorpaySubmit(el) {
            if(typeof Razorpay == 'undefined') {
                setTimeout(razorpaySubmit, 200);
                if(!razorpay_pay_btn && el) {
                    razorpay_pay_btn    = el;
                    el.disabled         = true;
                    el.value            = 'Please wait...';  
                }
            } else {
                if(!instance) {
                    instance = new Razorpay(options);
                    if(razorpay_pay_btn) {
                    razorpay_pay_btn.disabled   = false;
                    razorpay_pay_btn.value      = "Pay Now";
                    }
                }
                instance.open();
            }
        }  
    </script>
</body>
</html>
