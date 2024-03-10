//preloader js
$(document).ready(function() {
  preloader('hide');
	$(".loader").delay(1000).fadeOut("slow");
  $("#overlayer").delay(1000).fadeOut("slow");
});

//slickslider js
$('.service-slider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 2,
  autoplay: true,
  autoplaySpeed: 2500,
  prevArrow: '<button class="slide-arrow prev-arrow"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i></button>',
  nextArrow: '<button class="slide-arrow next-arrow"> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>',
  responsive: [
  {
    breakpoint: 1024,
    settings: {
      slidesToShow: 3,
      slidesToScroll: 3,
      infinite: true,
      dots: true
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 2
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
  ]
});

//popup modal
$(document).ready(function(){
  if(pincode==null || pincode==''){
    $('#pincodemodal').modal('show');
  }
}); 
$(".carousel-inner .carousel-item").first().addClass('active');

$(".numberOnly,.Onlynumbers").keypress(function (e) {
  if (e.which != 8 && e.which != 0 && e.which != 110 && e.which != 46 && (e.which < 48 || e.which > 57)) {
      $(this).attr("placeholder", "Allows Digits Only");
      return false;
  }
});


function validatePincode(){
   var pincode = $("#pincode").val();
   if(pincode!=null && pincode!='' && pincode!=undefined){
      $.ajax({
        url: baseurl+'validatePincode',
        type: 'POST',
        data: {"pincode": pincode},
        beforeSend:function(){
          $(".validate-pincode-btn").prop('disabled',true);
          $(".pincode-check").addClass('d-none');
        },
        success: function(data) {
            var res = JSON.parse(data);
            $(".validate-pincode-btn").prop('disabled',false);
            if(res.error==0){
              $(".pincode-check-success").removeClass('d-none');
              $('#pincodemodal').modal('hide');
            }else{
              $(".pincode-check-danger").removeClass('d-none');
            }
        },
        error: function(e) {
            console.log(e.message);
        }
    });
   }else{
    $("#pincode").focus();
   }
}
function getProducts(cat_id){
  $.ajax({
    url: baseurl+'getProducts',
    type: 'POST',
    data: {"cat_id": cat_id},
    beforeSend:function(){
      preloader('show');
    },
    success: function(data) {
      preloader('hide');
        var res = JSON.parse(data);
        $(".validate-pincode-btn").prop('disabled',false);
        if(res.error==0){
          $(".tab-content").html(res.html);
        }else{
        }
    },
    error: function(e) {
        console.log(e.message);
    }
  });
}
function showProducts(catid){
  $(".category_tabs").removeClass('active');
  $(".category_tab"+catid).addClass('active');
  if(catid>0){
    $(".product-card").addClass('d-none');
    $(".product_"+catid).removeClass('d-none');
  }else{
    $(".product-card").removeClass('d-none');   
  }
}

function addtocart(pid){
  if(pid!=''){
    var selectedService = $(".product_service_"+pid+" option:selected").val();
    var quantity = $(".quantity_"+pid+" option:selected").val();
    var price = $(".product_service_"+pid+" option:selected").attr('data-price');
    $.ajax({
      url: baseurl+'addtocart',
      type: 'POST',
      data: {product_id: pid,quantity:quantity,service_id:selectedService,price:price},
      beforeSend:function(){
        preloader('show');
      },
      success: function(data) {
        preloader('hide');
          var res = JSON.parse(data);
          if(res.error==0){
            $(".cart-count").text(res.count);
            $(".success-toast-body").text(res.msg);
            $(".success-toast").toast('show');
          }else{
          }
      },
      error: function(e) {
          console.log(e.message);
      }
    });
  }
}
function updatePrice(pid){
  if(pid!=''){
    var price = $(".product_service_"+pid+" option:selected").attr('data-price');
    $(".product_price_"+pid).text(price);
  }
}

function updatecart(pid,sid,price,cart_id){
  var qty = $(".quantity_"+pid+"_"+sid+" option:selected").val();
  var total = qty*price;
  $(".price_"+cart_id).text(total.toFixed(2));
  $.ajax({
    url: baseurl+'updateCart',
    type: 'POST',
    data: {cart_id:cart_id,qty:qty},
    beforeSend:function(){
      preloader('show');
    },
    success: function(data) {
        preloader('hide');
        var res = JSON.parse(data);
        if(res.error==0){
          $(".card-price-details").html(res.html);
        }
    },
    error: function(e) {
        console.log(e.message);
    }
  });
}

function removeCart(cart_id){
  if(cart_id!=''){
    $(".product-card_"+cart_id).fadeOut(100);
    var len = $(".product-card").length;
    if(len==1){
      $(".item-div").addClass('d-none');
      $(".no-item-div").removeClass('d-none');
    }
    $.ajax({
      url: baseurl+'removecart',
      type: 'POST',
      data: {cart_id:cart_id},
      beforeSend:function(){
        preloader('show');
      },
      success: function(data) {
          var res = JSON.parse(data);
          if(res.error==0){
            preloader('hide');
            $(".card-price-details").html(res.html);
            getCartCount();
            applyCoupon();
          }
      },
      error: function(e) {
          console.log(e.message);
      }
    });
  }
}

function getCartCount(){
    $.ajax({
      url: baseurl+'getCartCount',
      type: 'POST',
      data: {},
      beforeSend:function(){
      },
      success: function(data) {
          var res = JSON.parse(data);
          if(res.error==0){
            $(".cart-count").text(res.count);
          }
      },
      error: function(e) {
          console.log(e.message);
      }
    });
}
getCartCount();

function applyCoupon(){
  var coupon = $(".coupon").val();
  var sub_total = $(".sub_total").text();
  if(coupon!=''){
    $.ajax({
      url: baseurl+'applyCoupon',
      type: 'POST',
      data: {coupon:coupon,sub_total:sub_total},
      beforeSend:function(){
        preloader('show');
        $(".coupon_response").html("<span class='text-info'>Please wait...</span>");
      },
      success: function(data) {
          preloader('hide');
          var res = JSON.parse(data);
          if(res.error==0 && res.html!=''){
            $(".card-price-details").html(res.html);
          }
          $(".coupon_response").html(res.msg);
      },
      error: function(e) {
          console.log(e.message);
      }
    });
  }else{
    $(".coupon").focus();
  }
}

function placeOrder(){
  var address_id = $("#address_id").val();
  var pickup_date = $("#pickup_date").val();
  console.log(address_id);
  console.log(pickup_date);
  if(address_id=='' || address_id==null){
    $(".errror-toast-body").text('Please select delivery address');
    $(".error-toast").toast('show');
    return false;
  }
  if(pickup_date=='' || pickup_date==null){
    $(".errror-toast-body").text('Please select pickup date time');
    $(".error-toast").toast('show');
    return false;
  }
  $.ajax({
    url: baseurl+'placeOrder',
    type: 'POST',
    data: {address_id:address_id,pickup_date:pickup_date},
    beforeSend:function(){
      preloader('show');
    },
    success: function(data) {
        preloader('hide');
        var res = JSON.parse(data);
        if(res.error==0 && res.payment!=''){
          window.location.href=res.payment;
        }else{
          $(".errror-toast-body").text('Something went wrong');
          $(".error-toast").toast('show');
        }
    },
    error: function(e) {
        console.log(e.message);
    }
  });
}

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  $(".success-toast-body").text('Coupon Copied...');
  $(".success-toast").toast('show');
}
function preloader(type){
  if(type=='show'){
    $("#data-loader").show();
  }else{
    $("#data-loader").hide();
  }
}