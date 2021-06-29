$(document).on('click', '.js-trigger__alertMenu', function(e) {
    let target = $(this).next('.js-target__alertMenu'); 
    $(target).addClass('is-active__show');
    e.stopPropagation();
  }
);
$(window).click(
  function () {
    $('.js-target__alertMenu').removeClass('is-active__show');
  }
);