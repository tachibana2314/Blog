$(document).on('click', '.js-trigger__burgerMenu', function() {
    let target = $('.js-target__burgerMenu');
    if(target.hasClass('is-active__show')){
      target.removeClass('is-active__show');
      target.addClass('is-active__hide');
    }else {
      target.removeClass('is-active__hide');
      target.addClass('is-active__show');    
    }
  }
);
$(document).on('click', '.js-target__burgerMenu a', function() {
    let target = $('.js-target__burgerMenu');
    target.removeClass('is-active__show');
  }
);
