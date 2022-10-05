
<!-- スライド -->
<script>
$(function() {
  $('.wrap_radio').change(function() {
    var val1 = $('#radio1').prop('checked');
    var val2 = $('#radio2').prop('checked');
    if (val1) {
      $('.slides').show();
    } else if (val2) {
      $('.slides').hide();
      $('.slides').find('select').val('');
    }
  });
});
</script>

<!-- 初期値設定チェック状態だったら -->
<script>
$('.wrap_radio').find(function() {
  var prop = $('#radio1').prop('checked');
  if (prop) {
    $('.slides').show();
  } else {
    $('.slides').hide();
  }
});
</script>

<!-- クーポン -->
<script>
$(function() {
  $('.wrap_radio').change(function() {
    var val1 = $('#radio1').prop('checked');
    var val2 = $('#radio2').prop('checked');
    if (val1) {
      $('.term').show();
      $('.month').hide();
      $('.month').find('select').val('');
      $('.normal_limit_flg').show();
    } else if (val2) {
      $('.term').hide();
      $('.month').show();
      $('.term').find('input').val('');
      $('.normal_limit_flg').hide();
    }
  });
});
</script>

<!-- 初期値設定チェック状態だったら -->
<script>
$('.wrap_radio').find(function() {
  var prop = $('#radio1').prop('checked');
  if (prop) {
    $('.term').show();
  } else {
    $('.term').hide();
  }
});
</script>
<!-- 初期値設定チェック状態だったら -->
<script>
$('.wrap_radio').find(function() {
  var prop = $('#radio2').prop('checked');
  if (prop) {
    $('.month').show();
  } else {
    $('.month').hide();
  }
});
</script>
