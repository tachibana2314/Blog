$('.p-sidebar__item').mouseover(function(e) {
  $('.p-sidebar__megaMenu',this).addClass('view');
}).mouseout(function(e) {
  $('.p-sidebar__megaMenu',this).removeClass('view');
});