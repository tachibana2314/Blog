
{{---- 画像プレビュー 一枚--> --}}
<script>
  document.getElementById('postImage__main').addEventListener('change', function(e) {
    // 1枚だけ表示する
    var file = e.target.files[0];
    console.log(file)
    // ファイルのブラウザ上でのURLを取得する
    if (typeof(file) != "undefined") {
      var blobUrl = window.URL.createObjectURL(file);
      console.log(blobUrl)
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

{{-- datepicker --}}
<script>
  $('.calendar').flatpickr({
    'disableMobile': true,
      'locale': 'ja',
  });
</script>

@php($pathname = 'news')
{{-- エディター関係 --}}
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
<script>
  var quill = new Quill('#quillEditor', {
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        ['link'],
        ['image'],
        ['video'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],     // superscript/subscript
        [{ 'align': [] }],
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        ['clean']
      ]
    },
    theme: 'snow'
  });

  // /**
  //  * Step1. select local image
  //  *
  //  */
  function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('name', 'up_file');
    input.click();

    // Listen upload local image and save to server
    input.onchange = () => {
      const file = input.files[0];
      // file type is only image.
      if (/^image\//.test(file.type)) {
        saveToServer(file);
      } else {
        console.warn('You could only upload images.');
      }
    };
  }

  // /**
  //  * Step2. save to server
  //  */

  function saveToServer(file) {
    /* Ajax経由で画像登録 */
    var fd = new FormData();
    fd.append('up_file', file); // 画像
    fd.append('_token', $('meta[name="csrf-token"]').attr('content')); // 画像
    fd.append('access', 'public'); // 画像
    $.ajax({
      url:"{{ route('admin.uploadImage', $pathname) }}", // 画像登録処理を行うPHPファイル(api)
      type: 'POST',
      data: fd,
      cache: false,
      contentType: false,
      processData: false,

    }).done(function (data) {
      const url = data.path;
      insertToEditor(url);
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.log('ERROR', jqXHR, textStatus, errorThrown);
    });
    return false;
  }

  // /**
  //  * Step3. insert image url to rich editor.
  //  *
  //  * @param {string} url
  //  */
  function insertToEditor(url) {
    // push image url to rich editor.
    const range = quill.getSelection();
    quill.insertEmbed(range.index, 'image', url);
  }

  // quill editor add image handler
  //画像が選択されたら↑の関数がstep1~順番に走る
  quill.getModule('toolbar').addHandler('image', () => {
    selectLocalImage();
  });

  //プロジェクトを投稿する際にエディター内のものを#project_contents_innerに入れる。
  $(function () {
    $("#form").on("submit", function () {
      $("#bodyInput").val($(".ql-editor").html());
    })
  })
</script>
