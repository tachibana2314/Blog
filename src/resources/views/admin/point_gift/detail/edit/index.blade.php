@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">ポイント景品情報の編集</p>
            <p class="description">編集内容を入力の上、反映ボタンを押下してください。</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {!! Form::model($point_gift, ['url' => route('admin.point_gift.edit', $point_gift), 'method' => 'post','enctype'=>'multipart/form-data','files'=> true]) !!}
          <!-- フォームエリア -->
          <ul class="list_form">
            <!-- ポイント景品名 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">景品名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('name', null, ['placeholder' => 'ポイント景品名を入力']) !!}
                </div>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 写真 -->
            <li class="">
              <div class="form_head">
                <p class="ttl">写真</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <div class="wrap_img">
                    {{ Form::file('path[]', ['id' => 'input_eyecatch_main','accept' => 'image/*', 'enctype' => 'multipart/form-data','class' => 'file_img_preview']) }}
                    <label for="input_eyecatch_main" id="file_preview_main" style="background: url({{ isset($image[0]) ? $image[0]->url : '' }})"></label>
                  </div>
                  @if (isset($image[1]))
                    <a class="delete_sub_image" data-point_gift_picture_id="{{ $image[1]['id'] }}">×</a>
                    {!! Form::hidden('delete_image_id', null) !!}
                    @include('admin.point_gift.detail.edit._delete_image_script')
                  @endif
                </div>
                @error('path')
                  <span class=" invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              @include('admin.element.script_image')
            </li>
            <!-- ポイント -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">ポイント</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::number('point', null, ['placeholder' => 'ポイントを入力','min' => 0, 'step' => "1"]) !!}
                </div>
                @error('point')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 説明 -->
            <li class="">
              <div class="form_head">
                <p class="ttl">説明</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::textarea('description', null, ['placeholder' => 'ポイント景品説明を記入', 'rows' => 6]) !!}
                </div>
                @error('description')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- ステータス -->
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
              @include('admin.element.script_form')
              @include('admin.point_gift._script_limited')
            </li>
          </ul>
          <div class="btnarea_form">
            <a class="btn_gray" href="{{ route('admin.point_gift.detail', $point_gift) }}">キャンセル</a>
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
