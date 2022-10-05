<!-- 画像プレビュー -->
<script>
document.getElementById('input_eyecatch_main').addEventListener('change', function(e) {
  // 1枚だけ表示する
  var file = e.target.files[0];
  // ファイルのブラウザ上でのURLを取得する
  if (typeof(file) != "undefined") {
    var blobUrl = window.URL.createObjectURL(file);
  }
  // img要素に表示
  var $img = document.getElementById('file_preview_main');
  $img.style.backgroundImage = 'url(' + blobUrl + ')';
});

document.getElementById('input_eyecatch_sub').addEventListener('change', function(e) {
  // 1枚だけ表示する
  var file = e.target.files[0];
  // ファイルのブラウザ上でのURLを取得する
  if (typeof(file) != "undefined") {
    var blobUrl = window.URL.createObjectURL(file);
  }
  // img要素に表示
  var $img = document.getElementById('file_preview_sub');
  $img.style.backgroundImage = 'url(' + blobUrl + ')';
  $('input:hidden[name="delete_flg"]').val(null);
});
</script>
<!-- バーコード プレビュー-->
<script>
document.getElementById('input_eyecatch_barcode').addEventListener('change', function(e) {
  // 1枚だけ表示する
  var file = e.target.files[0];
  // ファイルのブラウザ上でのURLを取得する
  if (typeof(file) != "undefined") {
    var blobUrl = window.URL.createObjectURL(file);
  }
  // img要素に表示
  var $img = document.getElementById('file_preview_barcode');
  $img.style.backgroundImage = 'url(' + blobUrl + ')';
});
</script>
<script>
  $('.delete_sub_image').on('click', function() {
    $("#file_preview_sub").css('background', '');
    if ($(this).data('picture_id')) {
      $('input:hidden[name="delete_image_id"]').val($(this).data('picture_id'));
    } else {
      $('input:hidden[name="delete_flg"]').val(true);
    }
  });
</script>
  