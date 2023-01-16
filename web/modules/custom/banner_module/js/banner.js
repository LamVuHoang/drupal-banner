(function (Drupal, $) {
  "use strict";

  Drupal.behaviors.banner = {
    attach: function (context, settings) {
      $(".banner-class").slick({
        //  normal options
        // autoplay: true,
        infinite: true,
        draggable: true,
        dots: true,
        mobileFirst: true,
        slideToShow: 1,
        centerMode: true,

        responsive: [
          {
            // breakpoint: settings.toolbar.breakpoints["toolbar.standard"],
            breakpoint: 851,
          },
          {
            // breakpoint: settings.toolbar.breakpoints["toolbar.narrow"],
            breakpoint: 560,
            settings: {
              arrows: false,
            },
          },
          {
            breakpoint: 1,
            settings: {
              arrows: false,
            },
          },
        ],
      });
    },
  };
})(Drupal, jQuery);
