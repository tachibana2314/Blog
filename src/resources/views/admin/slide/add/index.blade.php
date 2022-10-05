@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <section class="body_main">
    <div class="container">
      <div class="box box_800">
        <div class="head_box">
          <div class="text">
            <p class="h1">スライドを追加する</p>
            <p class="description">スライド情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
            <p class="description">公開するには公開ステータスと公開期間を設定してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.slide.add', 'method'=>'post','enctype'=>'multipart/form-data','files'=> true]) }}
          <!-- フォームエリア -->
          <ul class="list_form head_150">
            <!-- タイプ -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">タイプ</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select('type', CustomConst::TYPE, null, ['placeholder' => 'タイプを選択', 'class' => 'select2', 'id' => 'type',"onchange"=>"typeChange();"])!!}
                  </div>
                  @error('type')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </li>
            <!-- 商品ID -->
            <li class="type required" id="type_product" style="display: none;">
              <div class="form_head">
                <p class="ttl">対象商品</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select(
                      'product_id',
                      $all_products,
                      null,
                      ['placeholder' => '商品を選択してください', 'class' => 'select2'])
                    !!}
                  </div>
                </div>
                @error('product_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 店舗ID -->
            <li class="type required" id="type_store" style="display: none;">
              <div class="form_head">
                <p class="ttl">対象店舗</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select(
                      'store_id',
                      $all_stores,
                      null,
                      ['placeholder' => '店舗を選択してください', 'class' => 'select2'])
                    !!}
                  </div>
                </div>
                @error('store_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- クーポンID -->
            <li class="type required" id="type_coupon" style="display: none;">
              <div class="form_head">
                <p class="ttl">対象クーポン</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select(
                      'coupon_id',
                      $all_coupons,
                      null,
                      ['placeholder' => 'クーポンを選択してください', 'class' => 'select2'])
                    !!}
                  </div>
                </div>
                @error('coupon_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- お知らせID -->
            <li class="type required" id="type_information" style="display: none;">
              <div class="form_head">
                <p class="ttl">対象お知らせ</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select(
                      'information_id',
                      $all_informations,
                      null,
                      ['placeholder' => 'お知らせを選択してください', 'class' => 'select2'])
                    !!}
                  </div>
                </div>
                @error('information_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 外部URL -->
            <li class="type required" id="type_url" style="display: none;">
              <div class="form_head">
                <p class="ttl">外部URL</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {{ Form::text('url',null,['placeholder'=>'https://xxxx.com','id' => 'url']) }}
                </div>
                @error('url')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- スタンプ -->
            <li class="type required" id="type_stamp" style="display: none;">
              <div class="form_head">
                <p class="ttl">対象スタンプ</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select(
                      'stamp_id',
                      $all_stamps,
                      null,
                      ['placeholder' => '対象スタンプカードを選択してください', 'class' => 'select2'])
                    !!}
                  </div>
                </div>
                @error('stamp_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 商品写真 -->
            <li class="required type">
              <div class="form_head">
                <p class="ttl">スライド画像</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img_w">
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
              </div>
            </li>
            <!-- 公開期間 -->
            <li class="required term">
              <div class="form_head">
                <p class="ttl">公開期間</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_calendar">
                    {!! Form::datetime('start_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                  </div>
                  <span class="unit_1_center">-</span>
                  <div class="wrap_calendar">
                    {!! Form::datetime('end_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                  </div>
                </div>
                <div>
                  @error('start_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div>
                  @error('end_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </li>
          </ul>
          @include('admin.element.script_image_single')
          @include('admin.element.script_form')
          <div class="btnarea_form">
            <a href="{{ route('admin.slide') }}" class="btn_gray">キャンセル</a>
            {{ Form::button('作成する', ['type' => 'submit' ,'class' => 'btn_']) }}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
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
