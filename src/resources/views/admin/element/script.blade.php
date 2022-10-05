<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "選択してください",
      allowClear:true
    });
  });
</script>
<!-- <!— ! テーブルにリンクを貼る —————————————————————————————— —> -->
<script>
$('tr[data-href]').addClass('clickable').click(function() {
  window.location = $(this).attr('data-href');
}).find('a').hover(function() {
  $(this).parents('tr').unbind('click');
}, function() {
  $(this).parents('tr').click(function() {
    window.location = $(this).attr('data-href');
  });
});
</script>
<!-- <!— ! 絞り込みフィルターオンオフ —————————————————————————————— —> -->
<script>
$(document).on('click', '.button_filter', function() {
  $('.area_filter_table').addClass('filter_show');
});
$(document).on('click', '.overlay_filter', function() {
  $('.area_filter_table').removeClass('filter_show');
});
</script>
<script>
  $(document).on('click', '.button_filter2', function() {
    $('.area_filter_table2').addClass('filter_show');
  });
  $(document).on('click', '.overlay_filter2', function() {
    $('.area_filter_table2').removeClass('filter_show');
  });
</script>

<!-- <!— ! タブ切り替え —————————————————————————————— —> -->
<script>
$(function() {
  $('.list_tab_button > li').click(function() {
    let index = $('.list_tab_button > li').index(this);
    $('.list_tab_button > li').removeClass('current_tab');
    $(this).addClass('current_tab');

    // ⑤コンテンツを一旦非表示にし、クリックされた順番のコンテンツのみを表示
    $('.area_tab > .panel_tab').removeClass('show_tab').eq(index).addClass('show_tab');
  });
});
</script>
<!-- ボタン表示用_一時的なスクリプト -->
<script>
$(document).on('click', '.btn_apply', function() {
  $('.area_filter_table').addClass('filter_active');
  $('.area_filter_table').removeClass('filter_show');
});
$(document).on('click', '.btn_reset', function() {
  $('.area_filter_table').removeClass('filter_active');
  $('.area_filter_table').removeClass('filter_show');
});
</script>
<script>
  $(document).on('click', '.btn_apply2', function() {
    $('.area_filter_table2').addClass('filter_active');
    $('.area_filter_table2').removeClass('filter_show');
  });
  $(document).on('click', '.btn_reset2', function() {
    $('.area_filter_table2').removeClass('filter_active');
    $('.area_filter_table2').removeClass('filter_show');
  });
  </script>
<!-- ページネート  -->
<!-- <!— ! CSVアップロード —————————————————————————————— —> -->
<script type="text/javascript">
var waitList = [];

function addWaitList(files) {
  for (var i = 0; i < files.length; i++) {
    var sameName = -1;
    for (var j = 0; j < waitList.length; j++) {
      if (files.item(i).name == waitList[j].name) {
        sameName = j;
        break;
      }
    }
    if (sameName < 0) {
      waitList.push(files.item(i));
      $("#waitingList").append('<li class="waitFileList">' + files.item(i).name + '</li>');
    } else {
      waitList[sameName] = files.item(i);
    }
  }
}
$(function() {
  var obj = $("#DnDBox");
  obj.on('dragenter', function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border-style', 'solid');
  });
  obj.on('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
    //デフォルト
    $(this).css('border-color', '#172858');
  });
  obj.on('drop', function(e) {
    //ドロップした
    $(this).css('background', '#F2F4F7');
    e.preventDefault();
    addWaitList(e.originalEvent.dataTransfer.files);
  });
  $(document).on('dragenter', function(e) {
    e.stopPropagation();
    e.preventDefault();
  });
  $(document).on('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
    //デフォルト
    obj.css('border-style', 'dashed');
  });
  $(document).on('drop', function(e) {
    e.stopPropagation();
    e.preventDefault();
  });

  $('#clearWaitList').on('click', function() {
    $('.waitFileList').remove();
    waitList = [];
  });

  $('#upload').on('click', function() {
    // ファイルを上げに行く
    var fd = new FormData();
    for (var i = 0; i < waitList.length; i++) {
      $("[id^='HiddenFile']").each(function() {
        if ($(this).val() == waitList[i].name) {
          overwriteFiles.push($(this).val());
          return false;
        }
      });
      fd.append('file[' + i + ']', waitList[i]);
    }
    $.ajax({
      url: "upload.php",
      type: "POST",
      contentType: false,
      processData: false,
      cache: false,
      data: fd,
      success: function(data) {
        alert('アップロードに成功しました');
        $('.waitFileList').remove();
        waitList = [];
      },
      error: function(data) {
        alert('アップロードに失敗しました');
      }
    });

  });
});
</script>
<!-- フラッシュを閉じる -->
<script>
$(document).on('click', '.list_flash > li', function() {
  $(this).addClass('flash_remove');
});
</script>
<script>
$(document).on('click', '.list_gallery article', function() {
  let Tag = $('.img', this).attr('style');
  $('.main_gallery .img').attr('style', Tag);
});
</script>
