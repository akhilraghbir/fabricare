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