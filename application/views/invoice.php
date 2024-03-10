<?php 
$icon = "₹";
$tax = "GST";
if($order_details[0]['payment_status']=='Paid'){
    $paymentR = json_decode($order_details[0]['payment_response']);
}else{
    $paymentR = (object)['id'=>'N/A'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title>Invoice | <?= SITENAME;?></title>
    <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    
    @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      -webkit-text-size-adjust: none;
    }
    
    a {
      color: #3869D4;
    }
    
    a img {
      border: none;
    }
    
    td {
      word-break: break-word;
    }
    
    .preheader {
      display: none !important;
      visibility: hidden;
      mso-hide: all;
      font-size: 1px;
      line-height: 1px;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
    }
    /* Type ------------------------------ */
    
    body,
    td,
    th {
      font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
    }
    
    h1 {
      margin-top: 0;
      color: #333333;
      font-size: 22px;
      font-weight: bold;
      text-align: left;
    }
    
    h2 {
      margin-top: 0;
      color: #333333;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    
    h3 {
      margin-top: 0;
      color: #333333;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    
    td,
    th {
      font-size: 16px;
    }
    
    p,
    ul,
    ol,
    blockquote {
      margin: .4em 0 1.1875em;
      font-size: 16px;
      line-height: 1.625;
    }
    
    p.sub {
      font-size: 13px;
    }
    /* Utilities ------------------------------ */
    
    .align-right {
      text-align: right;
    }
    
    .align-left {
      text-align: left;
    }
    
    .align-center {
      text-align: center;
    }
    /* Buttons ------------------------------ */
    
    .button {
      background-color: #3869D4;
      border-top: 10px solid #3869D4;
      border-right: 18px solid #3869D4;
      border-bottom: 10px solid #3869D4;
      border-left: 18px solid #3869D4;
      display: inline-block;
      color: #FFF;
      text-decoration: none;
      border-radius: 3px;
      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
      -webkit-text-size-adjust: none;
      box-sizing: border-box;
    }
    
    .button--green {
      background-color: #22BC66;
      border-top: 10px solid #22BC66;
      border-right: 18px solid #22BC66;
      border-bottom: 10px solid #22BC66;
      border-left: 18px solid #22BC66;
    }
    
    .button--red {
      background-color: #FF6136;
      border-top: 10px solid #FF6136;
      border-right: 18px solid #FF6136;
      border-bottom: 10px solid #FF6136;
      border-left: 18px solid #FF6136;
    }
    
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
        text-align: center !important;
      }
    }
    /* Attribute list ------------------------------ */
    
    .attributes {
      margin: 0 0 21px;
    }
    
    .attributes_content {
      background-color: #F4F4F7;
      padding: 16px;
    }
    
    .attributes_item {
      padding: 0;
    }
    /* Related Items ------------------------------ */
    
    .related {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .related_item {
      padding: 10px 0;
      color: #CBCCCF;
      font-size: 15px;
      line-height: 18px;
    }
    
    .related_item-title {
      display: block;
      margin: .5em 0 0;
    }
    
    .related_item-thumb {
      display: block;
      padding-bottom: 10px;
    }
    
    .related_heading {
      border-top: 1px solid #CBCCCF;
      text-align: center;
      padding: 25px 0 10px;
    }
    /* Discount Code ------------------------------ */
    
    .discount {
      width: 100%;
      margin: 0;
      padding: 24px;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F4F4F7;
      border: 2px dashed #CBCCCF;
    }
    
    .discount_heading {
      text-align: center;
    }
    
    .discount_body {
      text-align: center;
      font-size: 15px;
    }
    /* Social Icons ------------------------------ */
    
    .social {
      width: auto;
    }
    
    .social td {
      padding: 0;
      width: auto;
    }
    
    .social_icon {
      height: 20px;
      margin: 0 8px 10px 8px;
      padding: 0;
    }
    /* Data table ------------------------------ */
    
    .purchase {
      width: 100%;
      margin: 0;
      padding: 35px 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_content {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    .text-right{
        text-align:right!important;
    }
    .purchase_item {
      padding: 10px 0;
      color: #51545E;
      font-size: 15px;
      line-height: 18px;
    }
    
    .purchase_heading {
      padding-bottom: 8px;
      border-bottom: 1px solid #EAEAEC;
    }
    
    .purchase_heading p {
      margin: 0;
      color: #85878E;
      font-size: 12px;
    }
    
    .purchase_footer {
      padding-top: 15px;
      border-top: 1px solid #EAEAEC;
    }
    
    .purchase_total {
      margin: 0;
      text-align: right;
      font-weight: bold;
      color: #333333;
    }
    
    .purchase_total--label {
      padding: 0 15px 0 0;
    }
    
    body {
      background-color: #F4F4F7;
      color: #51545E;
    }
    
    p {
      color: #51545E;
    }
    
    p.sub {
      color: #6B6E76;
    }
    
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F4F4F7;
    }
    
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    /* Masthead ----------------------- */
    
    .email-masthead {
      padding: 25px 0;
      text-align: center;
    }
    
    .email-masthead_logo {
      width: 94px;
    }
    
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #A8AAAF;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }
    /* Body ------------------------------ */
    
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #FFFFFF;
    }
    
    .email-body_inner {
      width: 650px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #FFFFFF;
    }
    
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .email-footer p {
      color: #6B6E76;
    }
    
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #EAEAEC;
    }
    
    .content-cell {
      padding: 35px;
    }
    /*Media Queries ------------------------------ */
    
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    
    @media (prefers-color-scheme: dark) {
      body,
      .email-body,
      .email-body_inner,
      .email-content,
      .email-wrapper,
      .email-masthead,
      .email-footer {
        background-color: #333333 !important;
        color: #FFF !important;
      }
      p,
      ul,
      ol,
      blockquote,
      h1,
      h2,
      h3,
      span,
      .purchase_item {
        color: #FFF !important;
      }
      .attributes_content,
      .discount {
        background-color: #222 !important;
      }
      .email-masthead_name {
        text-shadow: none !important;
      }
    }
    
    :root {
      color-scheme: light dark;
      supported-color-schemes: light dark;
    }
    .logo{
        width:100px;
    }
    </style>
  </head>
  <body>
    <span class="preheader">This is an invoice for your purchase on {{ purchase_date }}. Please submit payment by {{ due_date }}</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
      <tr>
        <td align="center">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                  <!-- Body content -->
                  <tr>
                    <td class="content-cell">
                      <div class="f-fallback">
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            
                          <tr>
                            <td class="attributes_content">
                              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td colspan="2" class="email-masthead">
                                        <a href="<?= base_url(); ?>" class="f-fallback email-masthead_name">
                                         <img src="<?= base_url(); ?>assets/frontend/images/logo.svg" class="logo" alt="logo">
                                        </a>
                                        <!-- <p>Key To Success Magnetic Silver Pvt Ltd</p>
                                        <p>Shop No. 3-5-90/P/91 , Attapur Hyderguda <br>, Hyderabad , Telangana 500048</p> -->
                                    </td>
                                </tr>
                                 <tr>
                                    <td><hr></td>
                                    <td><hr></td>
                                </tr>
                                <tr class="attributes_item">
                                    <td class="attributes_item">
                                        <span class="f-fallback">
                                              <!-- <p>Gst No. 36AAHCK8538R1ZK </p> -->
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><hr></td>
                                    <td><hr></td>
                                </tr>
                                <tr>
                                  <td class="attributes_item">
                                    <span class="f-fallback">
                                          <strong>Ordered By : </strong><br><?= $user_details[0]['first_name'];?>, <br>
                                          <?= $user_details[0]['username'];?>, <br><?= $user_details[0]['phone_number'];?>
                                    </span>
                                  </td>
                                  <td class="attributes_item">
                                    <span class="f-fallback">
                                          <strong>Payment Status : </strong><br><?php if($order_details[0]['payment_status']=='Paid'){ echo"Paid With ".$order_details[0]['payment_type'];}else{ echo "Not Paid"; }?><br>
                                          <strong>Transaction Id : <br><?= $order_details[0]['payment_response'];?></strong>
                                    </span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        <table class="purchase" width="100%" cellpadding="0" cellspacing="0">
                          <tr>
                            <td>
                              <h3><?= $order_details[0]['reference_number'];?></h3>
                            </td>
                            <td>
                              <h3 class="align-right"><?= date("d-m-Y h:i a",strtotime($order_details[0]['insert_dt']));?></h3>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                  <th class="purchase_heading" align="left">
                                    <p class="f-fallback">Description</p>
                                  </th>
								  
                                  <th class="purchase_heading" align="right">
                                    <p class="f-fallback">Amount</p>
                                  </th>
                                </tr>
                                <?php
                                if(!empty($order_items)){
                                    $sbtotal = 0;
                                    foreach($order_items as $oi){
                                        $sbtotal += $oi->price * $oi->quantity;
                                ?>
                                <tr>
                                  <td width="80%" class="purchase_item"><span class="f-fallback"><?= $oi->product_name;?> - <?= $oi->service_name;?> (<?= $icon.' '.$oi->price;?> x <?= $oi->quantity;?>)</span></td>
                                  <td class="align-right" width="20%" class="purchase_item"><span class="f-fallback"><?= $icon.' '.number_format($oi->price * $oi->quantity,2);?></span></td>
                                </tr>
                                <?php } } ?>
								<tr>
                                  <td width="80%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total purchase_total--label">Sub Total</p>
                                  </td>
                                  <td width="20%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total"><?= $icon.' '.number_format($sbtotal,2);?></p>
                                  </td>
                                </tr>
                                
								<tr>
                                  <td width="80%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total purchase_total--label">Service Charge</p>
                                  </td>
                                  <td width="20%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total"><?= $icon.' '.$order_details[0]['service_charge'];?></p>
                                  </td>
                                </tr>
								
                                <?php if($order_details[0]['coupon_id']!=0){?>
                                <tr>
                                  <td width="80%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total purchase_total--label">Coupon Discount
                                    <small>( <?= $coupon_data[0]['coupon_code'];?> )</small>
                                    </p>
                                  </td>
                                  <td width="20%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total"> - <?= $icon.' '.$order_details[0]['coupon_discount']; ?></p>
                                  </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                  <td width="80%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total purchase_total--label">Total</p>
                                  </td>
                                  <td width="20%" class="purchase_footer" valign="middle">
                                    <p class="f-fallback purchase_total"><?= $icon.' '.$order_details[0]['grand_total'];?></p>
                                  </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p class="text-secondary  text-right"><small><i class="fa fa-info-circle"></i> The above price is inclusive of Tax</small></p>
                                    </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        
						<table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                          <tr>
                            <td class="attributes_content">
                              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                  <td class="attributes_item">
                                    <span class="f-fallback">
              <strong>Pick Up & Delivery To : </strong><br><?= $address[0]['name'];?>, <?= $address[0]['email_address'];?>, <?= $address[0]['phone_number'];?><br><?= $address[0]['address1'];?>,<?= $address[0]['address2'];?>,<?= $address[0]['city'];?>, <?= $address[0]['state'];?>, <?= $address[0]['postal_code'];?>
            </span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>