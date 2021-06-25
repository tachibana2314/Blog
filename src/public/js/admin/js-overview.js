//右からスライドしてくるエリア
// $(document).on('click', '.js-trigger__overview--open', function() {
//     $('.js-target__overview').addClass('is-active__overview--show');
//     target.css('display', 'show')
//   }
// );
//閉じる

$(document).on('click', '.js-trigger__overview--close', function() {
    $('.js-target__overview').removeClass('is-active__overview--show');
  }
);
/*
$(document).click(function(event) {
  if(!$(event.target).closest('.p-overview').length) {
    $('.js-target__overview').removeClass('is-active__overview--show');
  } else {
  }
});
*/