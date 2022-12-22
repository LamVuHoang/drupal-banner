jQuery(document).ready(function () {
  jQuery(".your-class").slick({
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

  jQuery(".bannerHere").html("Banner is in this place");
});
