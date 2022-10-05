@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">商品を追加する</p>
            <p class="description">商品情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.product.add', 'method'=>'post','enctype'=>'multipart/form-data','files'=> true]) }}
          <!-- フォームエリア -->
          <ul class="list_form">
            <!-- 商品名 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">商品名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('name', null, ['placeholder' => '商品名を入力']) !!}
                </div>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 商品写真 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">商品写真</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {{ Form::file('path[]', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    <label for="input_eyecatch_main" id="file_preview_main"></label>
                  </div>
                  <div class="wrap_img" style="padding-left: 10px;">
                    {{ Form::file('path[]', ['id' => 'input_eyecatch_sub','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    <label for="input_eyecatch_sub" id="file_preview_sub"></label>
                  </div>
                  <a class="delete_sub_image">×</a>
                  {!! Form::hidden('delete_flg', null) !!}
                  @include('admin.product.detail.edit._delete_image_script')
                </div>
                @error('path')
                  <span class=" invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              @include('admin.element.script_image')
            </li>
            <!-- カテゴリー -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">カテゴリー</p>
              </div>
              <div class="form_data">
                <div class="wrap_input wrap_select">
                  {!! Form::select('m_product_category_id', $m_product_category, null, ['placeholder' => 'カテゴリーを選択', 'id' => 'm_product_category_id'])!!}
                </div>
                @error('m_product_category_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 価格 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">価格</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <span class="unit_">＄</span>
                  {!! Form::number('price', null, ['placeholder' => '価格を入力','min' => 0,'step' => '0.01']) !!}
                </div>
                @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 商品説明 -->
            <li class="">
              <div class="form_head">
                <p class="ttl">商品説明</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::textarea('description', null, ['placeholder' => '商品説明を記入', 'rows' => 6]) !!}
                </div>
                @error('description')
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
              </div>
            </li>
            <!-- オンライン対応 -->
            <li>
              <div class="form_head">
                <p class="ttl">オンライン</p>
              </div>
              <div class="form_data">
                <div class="form_data">
                  <div class="wrap_input wrap_checkbox">
                    {!! Form::checkbox('online_flg', 1, false, ['id' => 'online_flg']) !!}
                    <label for="online_flg">対応</label>
                  </div>
                </div>
              </div>
            </li>
            <!-- 期間限定商品 -->
            <li>
              <div class="form_head">
                <p class="ttl">期間限定商品</p>
              </div>
              <div class="form_data">
                <div class="wrap_input wrap_checkbox">
                  {!! Form::checkbox('limited_flg', 1, false, ['id' => 'limited_flg']) !!}
                  <label for="limited_flg">期間限定商品</label>
                </div>
                <div class="term" style="display: none;">
                  <div class="wrap_input">
                    <span class=" unit_">期間：</span>
                    <div class="wrap_calendar">
                      {!! Form::datetime('start_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                    </div>
                    <span class="unit_">-</span>
                    <div class="wrap_calendar">
                      {!! Form::datetime('end_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                    </div>
                  </div>
                  @error('start_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  @error('end_date')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="wrap_input">
                    <span class="unit_4 ttl">公開日：</span>
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
              </div>
              @include('admin.element.script_form')
              @include('admin.product._script_limited')
            </li>
          </ul>
          <div class="btnarea_form">
            <a href="{{ route('admin.product') }}" class="btn_gray">キャンセル</a>
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
