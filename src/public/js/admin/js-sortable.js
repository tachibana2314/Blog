$(function() {
  $(".js-sortable").sortable({
    helper: helper1,
    placeholder:"p-sortable__placeholder",
    cursor: "move",
    forcePlaceholderSize: true,
    axis:'y',
  });
  function helper1(e, tr) {
  	var $originals = tr.children();
  	var $helper = tr.clone();
  	$helper.children().each(function(index) {
  		$(this).width($originals.eq(index).width());
  	});
  	return $helper;
  }
  $(".js-sortable").bind( "sortupdate", function(event, ui) { 
    $('.p-fixedAction').addClass('is-active__fixedAction--show');
  });
});