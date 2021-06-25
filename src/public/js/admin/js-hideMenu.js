$(document).on('click', '.js-trigger__hideMenu', function(e) {
    let target = $(this).next('.js-target__hideMenu'); 
    $(target).addClass('is-active__show');
    e.stopPropagation();
  }
);
$(window).click(
  function () {
    $('.js-target__hideMenu').removeClass('is-active__show');
  }
);