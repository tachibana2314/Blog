@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">クーポン情報の編集</p>
            <p class="description">編集内容を入力の上、反映ボタンを押下してください。</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {!! Form::model($coupon, ['url' => route('admin.coupon.edit', $coupon), 'method' => 'post','enctype'=>'multipart/form-data','files'=> true]) !!}
          <!-- フォームエリア -->
          <ul class="list_form head_140">
            <li class="required">
              <div class="form_head">
                <p class="ttl">クーポン名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::textarea('title', null, ['placeholder' => 'クーポン名を入力', 'rows' => 3]) !!}
                </div>
                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
          </li>
          <!-- 商品ID -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">適用商品</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img">
                  {!! Form::select(
                    'product_id',
                    $all_products,
                    null,
                    ['placeholder' => 'クーポン適用商品を選択してください', 'class' => 'select2'])
                  !!}
                </div>
              </div>
              @error('product_id')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          <!-- バーコード写真 -->
          <li class="">
            <div class="form_head">
              <p class="ttl">バーコード写真</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img_w">
                  {{ Form::file('barcode', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'file_img_preview']) }}
                  {!! Form::hidden('old_image_path[]', isset($coupons->barcode) ? $coupons->id : '' ) !!}
                  <label for="input_eyecatch_main" id="file_preview_main" style="background: url({{ $url }})"></label>
                </div>
                <a class="delete_sub_image">×</a>
                {!! Form::hidden('delete_flg', null) !!}
              </div>
              @error('barcode')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            @include('admin.element.script_image_single')
          </li>
          <!-- 説明文 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">説明文</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                {!! Form::textarea('description', null, ['placeholder' => '説明文等を記入', 'rows' => 5]) !!}
              </div>
              @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          <!-- 利用規約 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">利用規約</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                {!! Form::textarea('terms_of_use', null, ['placeholder' => '利用条件等を記入', 'rows' => 5]) !!}
              </div>
              @error('terms_of_use')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          <!-- 配信先 -->
          <li>
            <div class="form_head">
              <p class="ttl">タイプ</p>
            </div>
            <div class="form_data">
              <div class="wrap_input wrap_radio">
                @foreach(CustomConst::COUPON_TYPE as $key => $val)
                  {{ Form::radio('type',$key,true,['id' => 'radio'.$key]) }}
                  {{ Form::label('radio'.$key, $val) }}
                @endforeach
              </div>
            </div>
          </li>
          {{-- 利用回数 --}}
          <li class="normal_limit_flg">
            <div class="form_head">
              <p class="ttl">利用可能回数</p>
            </div>
            <div class="form_data">
              <div class="wrap_input wrap_radio">
                @foreach(App\Models\Coupon::AVAILABLE_TIMES as $key => $val)
                  {{ Form::radio('normal_limit_flg', $key, $loop->first ? true : false, ['id' => 'normal_limit_flg'.$key]) }}
                  {{ Form::label('normal_limit_flg'.$key, $val) }}
                @endforeach
              </div>
            </div>
          </li>
          <!-- 利用期間 -->
          <li class="required term" style="display:none;">
            <div class="form_head">
              <p class="ttl">利用期間</p>
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
          <!-- 誕生日対象月 -->
          <li class="required month" style="display:none;">
            <div class="form_head">
              <p class="ttl">対象月</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img_w">
                  {!! Form::select('target_month', CustomConst::TARGET_MONTH, null, ['placeholder' => '対象月を選択', 'id' => 'type'])!!}
                </div>
              </div>
              <div>
                @error('target_month')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
          </li>
          <!-- ステータス -->
          <li>
            <div class="form_head">
              <p class="ttl">ステータス</p>
            </div>
            <div class="form_data">
              <div class="form_data">
                <div class="wrap_input wrap_radio">
                  @foreach(CustomConst::COUPON_STATUS as $key => $val)
                    {{ Form::radio('status',$key,true,['id' => 'radio1'.$key]) }}
                    {{ Form::label('radio1'.$key, $val) }}
                  @endforeach
                </div>
              </div>
            </div>
          </li>
          <!-- 公開日 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">公開日</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_calendar">
                  {!! Form::datetime('release_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                  @error('release_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </li>
        </ul>
        @include('admin.element.script_form')
        @include('admin.element.script_radio')
        <div class="btnarea_form">
          <a href="{{ route('admin.coupon.detail', $coupon)}}" class="btn_gray">キャンセル</a>
          {{ Form::button('変更を反映する', ['type' => 'submit' ,'class' => 'btn_']) }}
        </div>
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</section>
<!-- フット_メイン -->
<section class="foot_main"></section>
@endsection
