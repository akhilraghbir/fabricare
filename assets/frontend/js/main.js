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