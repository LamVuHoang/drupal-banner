jQuery(document).ready(function () {
  jQuery("#hit-me").click(function (e) {
    e.preventDefault();
    jQuery("#show-me").toggleClass("hidden");
  });
});
