@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア -->
      <div class="area_page page_800">
        <section class="area_back_page">
          <a class="btn_line_navy" href="{{ route('admin.information')}}"></a>
        </section>
        <div class="body_page">
          <section class="area_user_detail">
            <div class="layout_main">
              <!-- 新規todo登録 -->
              <div class="box">
                <div class="head_box">
                  <div class="text">
                    <p class="h1">お知らせを追加する</p>
                    <p class="description">お知らせ内容を入力してください</p>
                    <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
                  </div>
                </div>
                <div class="body_box">
                  {{ Form::open(['route'=>'admin.information.add', 'method'=>'post','enctype'=>'multipart/form-data','files'=> true]) }}
                  <ul class="list_form head_150">
                    <!-- タイトル -->
                    <li class="required">
                      <div class="form_head">
                        <p class="ttl">タイトル</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input">
                          {!! Form::text('title', null, ['placeholder' => 'お知らせのタイトル']) !!}
                        </div>
                        @error('title')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </li>
                    <!-- おしらせ写真 -->
                    <li>
                      <div class="form_head">
                        <p class="ttl">写真</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input">
                          <div class="wrap_img">
                            {{ Form::file('pic_path', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                            <label for="input_eyecatch_main" id="file_preview_main"></label>
                          </div>
                        </div>
                        @error('pic_path')
                          <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      @include('admin.element.script_image_single')
                    </li>
                    <li class="required">
                      <div class="form_head">
                        <p class="ttl">本文</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input">
                          {!! Form::textarea('body', null, ['placeholder' => 'お知らせの本文をここに記載', 'rows' => 7]) !!}
                        </div>
                        @error('body')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </li>
                    <li>
                      <div class="form_head">
                        <p class="ttl">対象商品</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input">
                          <div class="wrap_img">
                            {!! Form::select(
                              'product_id',
                              App\Models\Product::open()->pluck('name', 'id')->toArray(),
                              null,
                              ['placeholder' => '商品を選択してください', 'class' => 'select2'])
                            !!}
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- 即時プッシュ -->
                    <li>
                      <div class="form_head">
                        <p class="ttl">プッシュ通知</p>
                      </div>
                      <div class="form_data">
                        <div class="form_data">
                          <div class="wrap_input wrap_checkbox">
                            {!! Form::checkbox('push_flg', 1, false, ['id' => 'push_flg',] ) !!}
                            <label for="push_flg"><span style="color: #FF0000;">＊</span>チェックの場合即時にプッシュ通知が届きます。</label>
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- 公開日時 -->
                    <li class="required release_date">
                      <div class="form_head">
                        <p class="ttl">公開日</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input_140 wrap_calendar">
                          {!! Form::datetime('release_date', null, ['placeholder' => 'YYYY/MM/DD', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                        </div>
                        @error('release_date')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      @include('admin.element.script_form')
                    </li>
                    <!-- 公開/非公開 -->
                    <li class='status'>
                      <div class="form_head">
                        <p class="ttl">公開/非公開</p>
                      </div>
                      <div class="form_data">
                        <div class="wrap_input wrap_radio">
                          @foreach(CustomConst::STATUS as $key => $val)
                            {{ Form::radio('status',$key,true,['id' => 'radio'.$key]) }}
                            {{ Form::label('radio'.$key, $val) }}
                          @endforeach
                        </div>
                        @error('status')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </li>
                  </ul>
                  <div class="btnarea_form">
                    <a href="{{ route('admin.information') }}" class="btn_gray">キャンセル</a>
                    {{ Form::button('作成する', ['type' => 'submit' ,'class' => 'btn_']) }}
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
  <script>
  $('input#push_flg').click(function() {
    if ($(this).is(':checked')) {
      $('.release_date').hide();
      $('.status').hide();
      $('.release_date').find('input').val('');
    } else {
      $('.release_date').show();
      $('.status').show();
    }
  })
</script>
<script>
$('input#push_flg').find(function() {
  var prop = $('#push_flg').prop('checked');
  // もしチェック状態だったら
  if (prop) {
    $('.release_date').hide();
    $('.status').hide();
  } else {
    $('.release_date').show();
    $('.status').show();
  }
});
</script>
<!-- フット_メイン -->
<section class="foot_main"></section>
@endsection
