function scrollHeader(){
  let scrollTop = $(this).scrollTop();
  if(scrollTop > 1) {
    $('.p-header').addClass('is-active__show__background');
  }else {
    $('.p-header').removeClass('is-active__show__background');
  }
}
$(document).ready(function() {
  scrollHeader();
});
$(window).scroll(function() {
  scrollHeader();
});