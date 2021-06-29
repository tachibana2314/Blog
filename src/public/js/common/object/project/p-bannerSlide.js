//バナーカルーセル
$(document).ready(function(){
  $('.p-bannerSlide__list').slick({
    centerMode: true,
    autoplay: true,
    autoplaySpeed: 4000,
    focusOnSelect: true,
    arrows: true,
    slidesToShow: 3,
    centerPadding: 0,
    responsive: [
      {
        breakpoint: 1080,
        settings: {
          slidesToShow: 1,
          centerPadding: '32%',
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          centerPadding: '24%',
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
          centerPadding: '12%',
        }
      },
    ]
  });
});