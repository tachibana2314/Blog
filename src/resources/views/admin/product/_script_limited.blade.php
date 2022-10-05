<script>
$('input#limited_flg').click(function() {
  if ($(this).is(':checked')) {
    $('.term').show();
  } else {
    $('.term').hide();
    $('.start_date').find('input').val('');
    $('.end_date').find('input').val('');
  }
})
</script>
<script>
$('input#limited_flg').find(function() {
  var prop = $('#limited_flg').prop('checked');
  // もしチェック状態だったら
  if (prop) {
    $('.term').show();
  } else {
    $('.term').hide();
  }
});
</script>
