<!— ! ヘッダー —————————————————————————————— —>
@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">管理者を追加する</p>
            <p class="description">管理者情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.register', 'method'=>'post']) }}
          <!-- フォームエリア -->
          <ul class="list_form">
            <!-- メールアドレス -->
            <li class="required">
              <div class="form_head">
                <p class="ttl" style="width:200px;">メールアドレス</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::text('email', null, ['placeholder' => 'sample@example.com']) !!}
                </div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <li class="required">
              <div class="form_head">
                <p class="ttl" style="width:200px;">再確認メールアドレス</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input">
                  {{ Form::text('email_confirmation','',['placeholder'=>'メールアドレス確認']) }}
                </div>
                @error('email_confirmation')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
          </ul>
          <div class="btnarea_form">
            <a href="{{ route('admin.member') }}" class="btn_gray">キャンセル</a>
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
