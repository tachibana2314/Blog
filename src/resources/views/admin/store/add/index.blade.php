@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア -->
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">店舗を追加する</p>
            <p class="description">店舗情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.store.add', 'method'=>'post','enctype'=>'multipart/form-data','files'=> true]) }}
          <!-- フォームリスト -->
          <ul class="list_form head_140">
            <!-- 店舗名 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">店舗名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('name', null, ['placeholder' => '店舗名を入力']) !!}
                </div>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 電話番号 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">電話番号</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('tel', null, ['placeholder' => '09012345678','min' => 0]) !!}
                </div>
                @error('tel')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 住所 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">住所</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('address', null, ['placeholder' => '350 Orchard Road Shaw House Singapore 238868 B1F']) !!}
                </div>
                @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- おしらせ写真 -->
            <li class="">
              <div class="form_head">
                <p class="ttl">写真</p>
              </div>
              <div class="form_data">
                <div class="wrap_img">
                    {{ Form::file('pic_path', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    <label for="input_eyecatch_main" id="file_preview_main"></label>
                </div>
                @error('pic_path')
                <span class=" invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              @include('admin.element.script_image_single')
            </li>
			<li>
              <div class="form_head">
                <p class="ttl">営業時間</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">月曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('mon_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('mon_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('mon_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('mon_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">火曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('tue_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('tue_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('tue_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('tue_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">水曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('wed_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('wed_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('wed_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('wed_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">木曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('thu_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('thu_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('thu_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('thu_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">金曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('fri_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('fri_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('fri_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('fri_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">土曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('sat_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('sat_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('sat_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('sat_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">日曜日：</span>
                  <div class="wrap_input">
                    {!! Form::time('sun_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('sun_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('sun_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                @error('sun_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div class="wrap_input">
                  <span style="color: #FF0000;">*</span>
                  <span class="unit_">祝日　：</span>
                  <div class="wrap_input">
                    {!! Form::time('hol_start_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                  <span class="unit_">-</span>
                  <div class="wrap_input">
                    {!! Form::time('hol_end_time', null, ['placeholder' => '営業終了時間を入力', "class"=>"timepicker","data-time-format"=>"H:i"]) !!}
                  </div>
                </div>
                @error('hol_start_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div></div>
                @error('hol_end_time')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <script>
              $('.timepicker').timepicker();
              $('.timepicker').timepicker('option', 'step', '15');
              </script>
            </li>
            <!-- カフェスペース（店内飲食可能） -->
            <li>
              <div class="form_head">
                <p class="ttl">カフェスペース</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input wrap_checkbox">
                  {!! Form::checkbox('cafe_flg', 1, false, ['id' => 'cafe_flg',] ) !!}
                  <label for="cafe_flg">有り</label>
                </div>
              </div>
            </li>

            <!-- ワインの取り扱い（販売有無） -->
            <li>
              <div class="form_head">
                <p class="ttl">ワイン</p>
              </div>
              <div class="form_data">
                <div class="wrap_input wrap_checkbox">
                  {!! Form::checkbox('wine_flg', 1, false, ['id' => 'wine_flg',] ) !!}
                  <label for="wine_flg">取り扱い有り</label>
                </div>
              </div>
            </li>
            <!-- 焼き立て対象商品の取り扱い -->
            <li>
              <div class="form_head">
                <p class="ttl">焼きたて対象商品</p>
              </div>
              <div class="form_data">
                <div class="wrap_input wrap_checkbox">
                  {!! Form::checkbox('oven_flg', 1, false, ['id' => 'oven_flg',] ) !!}
                  <label for="oven_flg">取り扱い有り</label>
                </div>
              </div>
            </li>
            <!-- 店舗の補足情報 -->
            <li>
              <div class="form_head">
                <p class="ttl">店舗の補足情報</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::textarea('description', null, ['placeholder' => '店舗の補足情報等を記入', 'rows' => 6]) !!}
                </div>
              </div>
            </li>
            <!-- 店舗地図 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">緯度・経度</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <span class="unit_">緯度：</span>
                  {!! Form::text('latitude', null, ['required' => false, 'autofocus' => false,'placeholder'=>"緯度"]) !!}
                </div>
                <div class="wrap_input">
                  <span class="unit_">経度：</span>
                  {!! Form::text('longitude', null, ['required' => false, 'autofocus' => false,'placeholder'=>"経度"]) !!}
                </div>
                @error('latitude')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <div></div>
                @error('longitude')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 公開/非公開 -->
            <li>
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
            <a href="{{ route('admin.store') }}" class="btn_gray">キャンセル</a>
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
