
(function ($) {
  $(function () {
    var $hero = $('.js-hero-slider');
    if (!$hero.length || typeof $.fn.slick !== 'function') return;

    if ($hero.hasClass('slick-initialized')) {
      $hero.slick('unslick');
    }

    $hero.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      speed: 650,
      fade: false,
      arrows: true,
      dots: true,
      adaptiveHeight: false,
      prevArrow: '<button type="button" class="slick-prev" aria-label="Previous slide"></button>',
      nextArrow: '<button type="button" class="slick-next" aria-label="Next slide"></button>',
    });
  });
})(jQuery);
