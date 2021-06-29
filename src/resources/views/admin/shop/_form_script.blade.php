{{-- 画像プレビュー --}}
<script>
  document.getElementById('postImage__main').addEventListener('change', function(e) {
    // 1枚だけ表示する
    var file = e.target.files[0];
    // ファイルのブラウザ上でのURLを取得する
    if (typeof(file) != "undefined") {
      var blobUrl = window.URL.createObjectURL(file);
    }
    // img要素に表示
    var $img = document.getElementById('main-image');
    $img.style.backgroundImage = 'url(' + blobUrl + ')';
  });
</script>
<script>
  document.getElementById('postImage__lp').addEventListener('change', function(e) {
    // 1枚だけ表示する
    var file = e.target.files[0];
    // ファイルのブラウザ上でのURLを取得する
    if (typeof(file) != "undefined") {
      var blobUrl = window.URL.createObjectURL(file);
    }
    // img要素に表示
    var $img = document.getElementById('lp-image');
    $img.style.backgroundImage = 'url(' + blobUrl + ')';
  });
</script>

{{-- flatpickr --}}
<script>
  $('.calendar').flatpickr({
      'locale': 'ja',
      'disableMobile': true,
  });
</script>
{{-- flatpickr --}}
<script>
 const config = {
  enableTime: true,
  noCalendar: true,
  'disableMobile': true,
  dateFormat: "H:i",
  minDate: "08:00",
  maxDate: "23:30",
  time_24hr: true,
}
flatpickr('.time_picker', config);
</script>

@php($pathname = 'shop')
<script>
  $(document).on('change', '.imageUpload input[type="file"]', function() {
    if (this.files.length == 0) {
      $(this).parent().css('background', 'url("'+$(this).parent().data('current')+'")');
      $(this).parent().find('[type=file]').val("");
      $(this).parent().find('[type=hidden]').val("");
    } else {
      /* Ajax経由で画像登録 */
      var fd = new FormData();
      fd.append('up_file', this.files[0]); // 画像
      fd.append('_token', $('meta[name="csrf-token"]').attr('content')); // 画像
      $.ajax({
        url: "{{ route('admin.uploadImage', $pathname) }}", // 画像登録処理を行うPHPファイル(api)
        type: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        context: $(this).parent(),
      }).done(function (data) {
        const url = data.path;
        var path = (new URL(url)).pathname.slice(1);
        $(this).css('background', 'url("' + url + '")');
        $(this).find('[type=hidden]').val(path);
      }).fail(function (jqXHR, textStatus, errorThrown) {
        $(this).css('background', 'url("{{ asset('img/common/noImage/admin--square.svg') }}")');
        $(this).find('[type=file]').val("");
        $(this).find('[type=hidden]').val("");
        alert("エラーが発生しました。");
      });
    }
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
<script>
$('.shop_type_gender').find(function() {
    var val = $('.shop_type_gender option:selected').val();
    if (val == 3) {
        $('.lp_photo').show();
    } else {
        $('.lp_photo').hide();
        $('.lp_img_preview').val('');
        $('.lp_image').val("");
        $('#postImage__lp').val("");
        $('#lp-image').css('background', 'url("{{ asset('img/common/noImage/admin--square.svg') }}")');
    }
});
  // LP写真表示・非表示
$('.shop_type_gender').change(function() {
    var val = $(this).val();
    if (val == 3) {
        $('.lp_photo').show();
    } else {
        $('.lp_photo').hide();
        $('.lp_img_preview').val('');
        $('.lp_image').val("");
        $('#postImage__lp').val("");
        $('#lp-image').css('background', 'url("{{ asset('img/common/noImage/admin--square.svg') }}")');
    }
});
</script>
{{-- TODO：記述場所変更--}}
<script>
  $(document).ready(function() {
    //開店時間の一括入力
    $(document).on('change', 'input[name="opening_time"]', function(element) {
      $('input[name$="_opening_time"]').val($(element.currentTarget).val());
    });
    //閉店時間の一括入力
    $(document).on('change', 'input[name="closing_time"]', function(element) {
      $('input[name$="_closing_time"]').val($(element.currentTarget).val());
    });
    //受付最終時間の一括入力
    $(document).on('change', 'input[name="last_recepting_time"]', function(element) {
      $('input[name$="_last_recepting_time"]').val($(element.currentTarget).val());
    });
  });
</script>
{{--

<!-- イメージクローン -->
<script>
  $(document).on('click', '.js-trigger__photoList--add', function() {
      $('.js-target__photoList').last().clone().insertBefore('.js-target__photoList--insert');
      let target = $('.js-target__photoList');
      let count = target.length;

      target.find('input').each(function(index, element){
        element.name = element.name.replace(/shop_images\[(|\d+)]/, 'shop_images['+index+']');
      });
      // クローン初期化
      let clone = target.last();
      clone.find('[type=file]').val("");
      clone.find('[type=hidden]').val("");
      clone.find('.imageUpload').css('background', 'url("{{ asset('img/common/noImage/admin--square.svg') }}")');

      if (count !== 1){
        target.find('.c-button').addClass("c-button--remove");
      }
    }
  );
  $(document).on('click', '.js-trigger__photoList--remove', function() {
      $(this).parents('.js-target__photoList').remove();
      let target = $('.js-target__photoList');
      target.find('input').each(function(index, element){
        element.name = element.name.replace(/shop_images\[(|\d+)]/, 'shop_images['+index+']');
      });
      let count = target.length;
      if (count == 1){
        target.find('.c-button').removeClass("c-button--remove");
      }
    }
  );

</script> --}}
