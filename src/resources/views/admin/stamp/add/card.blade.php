<?php
$pageLevel = '../../';
$page = 'page_products';
?>
@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">スタンプカードを追加する</p>
            <p class="description">スタンプカード情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.stamp.addCard', 'method'=>'post','enctype'=>'multipart/form-data','files'=> true]) }}
          <ul class="list_form head_140">
            <li class="required">
              <div class="form_head">
                <p class="ttl">カード名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('title', null, ['placeholder' => 'スタンプカード名を入力', 'rows' => 3]) !!}
                </div>
                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
          </li>
          <!-- 商品写真 -->
          {{-- <li class="required">
            <div class="form_head">
              <p class="ttl">クーポン写真</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img">
                  {{ Form::file('path_main', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                  <label for="input_eyecatch_main" id="file_preview_main"></label>
                </div>
                <div class="wrap_img" style="padding-left: 10px;">
                  {{ Form::file('path_sub', ['id' => 'input_eyecatch_sub','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                  <label for="input_eyecatch_sub" id="file_preview_sub"></label>
                </div>
              </div>
              @error('path')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li> --}}
          <!-- 利用条件 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">説明文</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                {!! Form::textarea('description', null, ['placeholder' => '利用条件等を記入', 'rows' => 5]) !!}
              </div>
              @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          <!-- バーコード写真 -->
          {{-- <li class="required">
            <div class="form_head">
              <p class="ttl">バーコード写真</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img_w">
                  {{ Form::file('barcode', ['id' => 'input_eyecatch_barcode','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    <label for="input_eyecatch_barcode" id="file_preview_barcode"></label>
                </div>
              </div>
              @error('barcode')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li> --}}
          <!-- 配信先 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">合計スタンプ数</p>
            </div>
            <div class="form_data">
              <div class="wrap_input wrap_select_140">
                {!! Form::number('stamp_count', null, [
                  'placeholder' => '0',
                  "min" => 0,
                  "max" => 100,
                  "step" => 1,
                ]) !!}
              </div>
              @error('stamp_count')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          {{-- <li class="required">
            <div class="form_head">
              <p class="ttl">カード順番</p>
            </div>
            <div class="form_data">
              <div class="wrap_input_140">
                {{ Form::number('set_card_number', null, ['placeholder' => 'カード順番']) }}
              </div>
            </div>
          </li> --}}
          <!-- 利用期間 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">利用期間</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_select">
                  {!! Form::datetime('start_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                </div>
                <span class="unit_1_center">-</span>
                <div class="wrap_select">
                  {!! Form::datetime('end_date', null, ['placeholder' => '日付を選択', "class"=>"datepicker","autocomplete"=>"off"]) !!}
                </div>
              </div>
              @if(
                $errors->has('start_date') ||
                $errors->has('end_date')
              )
                <span class="invalid-feedback" role="alert">
                  <strong>利用期間は入力必須です。</strong>
                </span>
              @enderror
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
        </ul>
          @include('admin.element.script_image')
          @include('admin.element.script_form')
          @include('admin.element.script_radio')
          <div class="btnarea_form">
            <a href="{{ route('admin.stamp') }}" class="btn_gray">キャンセル</a>
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
