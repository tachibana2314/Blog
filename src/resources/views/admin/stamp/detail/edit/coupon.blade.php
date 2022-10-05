@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">スタンプクーポン情報の編集</p>
            <p class="description">編集内容を入力の上、反映ボタンを押下してください。</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {!! Form::model($stamp_coupon, ['url' => route('admin.stamp.coupon_edit', $stamp_coupon), 'method' => 'post','enctype'=>'multipart/form-data','files'=> true]) !!}
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
          <!-- 商品写真 -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">クーポン写真</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img">
                  {{ Form::file('path_main', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                  {!! Form::hidden('old_path_main', isset($stamp_coupon->path_main) ? $stamp_coupon->path_main : '' ) !!}
                  <label for="input_eyecatch_main" id="file_preview_main" style="background: url({{ $main_url }})"></label>
                </div>
                {{-- <div class="wrap_img" style="padding-left: 10px;">
                  {{ Form::file('path_sub', ['id' => 'input_eyecatch_sub','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                  {!! Form::hidden('old_path_sub', isset($stamp_coupon->path_sub) ? $stamp_coupon->path_sub : '' ) !!}
                  <label for="input_eyecatch_sub" id="file_preview_sub" style="background: url({{ $sub_url }})"></label>
                </div> --}}
                <a class="delete_sub_image">×</a>
                {!! Form::hidden('delete_flg', null) !!}
              </div>
              @error('path_main')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <script>
              $('.delete_sub_image').on('click', function() {
                $("#file_preview_main").css('background', '');
                if ($(this).data('picture_id')) {
                  $('input:hidden[name="delete_image_id"]').val($(this).data('picture_id'));
                } else {
                  $('input:hidden[name="delete_flg"]').val(true);
                }
              });
            </script>
          </li>
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
          <li class="required">
            <div class="form_head">
              <p class="ttl">バーコード写真</p>
            </div>
            <div class="form_data">
              <div class="wrap_input">
                <div class="wrap_img_w">
                  {{ Form::file('barcode', ['id' => 'input_eyecatch_barcode','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'file_img_preview']) }}
                  {!! Form::hidden('old_image_path[]', isset($coupons->barcode) ? $coupons->id : '' ) !!}
                  <label for="input_eyecatch_barcode" id="file_preview_barcode" style="background: url({{ $barcode_url }})"></label>
                </div>
                <a class="delete_barcode_image">×</a>
                {!! Form::hidden('delete_barcode_flg', null) !!}
              </div>
              @error('barcode')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </li>
          <!-- セットクーポン -->
          <li class="required">
            <div class="form_head">
              <p class="ttl">セットクーポン</p>
            </div>
            <div class="form_data">
              <p>カード</p>
              <div class="wrap_input">
                <div class="wrap_select">
                  {!! Form::select('card_id',  $all_card, null, ['class' => 'form-control select2']) !!}
                  {{-- {!! Form::select('card_id[]',  $all_card, null, ['class' => 'form-control select2', 'multiple' => 'multiple',]) !!} --}}
                </div>
              </div>
              <p>交換適用クーポン数</p>
              <div class="wrap_input">
                <div class="wrap_select">
                  {!! Form::selectRange('stamp_count',  1, 30, null, ['class' => 'form-control select2']) !!}
                  {{-- {!! Form::selectRange('stamp_count[]',  0, 30, null, ['class' => 'form-control select2', 'multiple' => 'multiple',]) !!} --}}
                </div>
              </div>
              @error('stamp_count')
                <span class=" invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
         </li>
         <!-- 利用期間 -->
         <li class="required">
          <div class="form_head">
            <p class="ttl">利用期間</p>
          </div>
          <div class="form_data">
            <div class="wrap_input">
              <div class="wrap_select_100">
                {!! Form::text('use_period', null, ['placeholder' => '期間', "class"=>"","autocomplete"=>"off"]) !!}
              </div>
              <p class="unit_1_center">日</p>
            </div>
            <div>
              @error('use_period')
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
        </ul>
        @include('admin.element.script_form')
        @include('admin.element.script_radio')
        @include('admin.element.script_image')
        @include('admin.element.script_image_single')
        <div class="btnarea_form">
          <a href="{{ route('admin.stamp.coupon_detail', $stamp_coupon)}}" class="btn_gray">キャンセル</a>
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
