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
    },
    success: function(data) {
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
      },
      success: function(data) {
          var res = JSON.parse(data);
          if(res.error==0){
            $(".cart-count").text(res.count);
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
}

function removeCart(cart_id){
  if(cart_id!=''){
    var price = $(".price_"+cart_id).text();
    var total = $(".grand_total").text();
    var sub_total = $(".sub_total").text();
    $(".product-card_"+cart_id).remove();
    var ptotal = total - price;
    var st = sub_total - price;
    $(".sub_total").text(st.toFixed(2));
    $(".grand_total").text(ptotal.toFixed(2));
    var len = $(".product-card").length;
    $(".itemscount").text('('+len+' Items)');
    if(len==0){
      $(".item-div").addClass('d-none');
      $(".no-item-div").removeClass('d-none');
    }
    $.ajax({
      url: baseurl+'removecart',
      type: 'POST',
      data: {cart_id:cart_id},
      beforeSend:function(){
        
      },
      success: function(data) {
          var res = JSON.parse(data);
          if(res.error==0){
            getCartCount();
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