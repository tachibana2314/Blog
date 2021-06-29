<script>
  $('.calendar').flatpickr({
      'locale': 'ja',
  });
</script>
<!-- 画像プレビュー 一枚-->
<script>
  document.getElementById('postImage__main').addEventListener('change', function(e) {
    // 1枚だけ表示する
    var file = e.target.files[0];
    console.log(file)
    // ファイルのブラウザ上でのURLを取得する
    if (typeof(file) != "undefined") {
      var blobUrl = window.URL.createObjectURL(file);
    }
    // img要素に表示
    var $img = document.getElementById('main-image');
    $img.style.backgroundImage = 'url(' + blobUrl + ')';
  });
</script>
{{-- 画像削除 --}}
<script>
  $('.delete_image').on('click', function() {
    $(this).next().css('background', 'url("{{ asset('img/common/noImage/admin--square.svg') }}")');
    $(this).next().find('[type=file]').val("");
    $(this).next().find('[type=hidden]').val("");
  });
</script>
