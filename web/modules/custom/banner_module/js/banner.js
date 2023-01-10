(function (Drupal, $) {
  "use strict";

  Drupal.behaviors.banner = {
    attach: function (context, settings) {
      $(".your-class").slick({
        //  normal options
        autoplay: true,
        infinite: true,
        draggable: true,
        autoplaySpeed: 500,
        dots: true,
        mobileFirst: true,
        slideToShow: 1,
        centerMode: true,

        responsive: [
          {
            breakpoint: 600,
            settings: {
              arrows: true,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: false,
            },
          },
        ],
      });

      $(".bannerHere").html("Banner is in this place");
    }
  }
})(Drupal, jQuery);


