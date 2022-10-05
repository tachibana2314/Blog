@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_800">
        <div class="head_box">
          <div class="text">
            <p class="h1">スライドの編集</p>
            <p class="description">編集内容を入力の上、反映ボタンを押下してください。</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
            <p class="description">公開するには公開ステータスと公開期間を設定してください。</p>
          </div>
        </div>
        <div class="body_box">
          <!-- フォームエリア -->
          {!! Form::model($slide, ['url' => route('admin.slide.edit', $slide), 'method' => 'post','enctype'=>'multipart/form-data','files'=> true]) !!}
          <ul class="list_form head_150">
            <!-- タイプ -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">タイプ</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {!! Form::select('type', CustomConst::TYPE, null, ['placeholder' => 'タイプを選択','class' => 'select2', 'id' => 'type',"onchange"=>"typeChange();"])!!}
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
                  {{ Form::text('url',null,['placeholder'=>'https://xxxx.com']) }}
                </div>
                @error('url')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- スタンプカード -->
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
            <!-- スライド画像 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">スライド画像</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img_w">
                    {{ Form::file('pic_path', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    {!! Form::hidden('old_image_path[]', isset($slide->pic_path) ? $slide->id : '' ) !!}
                    <label for="input_eyecatch_main" id="file_preview_main" style="background: url({{ $slide->slide_url }})"></label>
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
                  {!! Form::hidden('old_status', isset($slide->status) ? $slide->status : '' ) !!}
                </div>
              </div>
            </li>
            <!-- 公開期間 -->
            <li class="term">
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
          @include('admin.element.script_form')
          <div class="btnarea_form">
            <a class="btn_gray" href="{{ route('admin.slide', $slide) }}">キャンセル</a>
            <a>{!! Form::submit('変更を反映する', ['type' => 'submit','class' => 'btn_']) !!}</a>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
