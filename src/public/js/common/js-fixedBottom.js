function fixedBottom(){
  target = $('.js-target__fixedBottom');
  attachment = 'is-active__fixedBottom--show';
  let topDistance = $('.js-target__fixedBottom').data('distance');
  let scrollTop = $(this).scrollTop();
  let windowHeight = $(this).height();
  let documentHeight = $(document).height();
  let endScroll = scrollTop + windowHeight + 100;
  if(endScroll > documentHeight){
    target.removeClass(attachment);
  }else if(scrollTop >= topDistance) {
    target.addClass(attachment);
  }else  {
    target.removeClass(attachment);
  }
}
$(document).ready(function() {
  fixedBottom();
});
$(window).scroll(function() {
  fixedBottom();
});