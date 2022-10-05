@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->

  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">顧客を追加する</p>
            <p class="description">顧客情報を入力してください。<br>「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {{ Form::open(['route'=>'admin.user.add', 'method'=>'post']) }}
          <!-- フォームエリア -->
          <ul class="list_form head_150">
            <li class="required">
              <div class="form_head">
                <p class="ttl">ニックネーム</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input">
                  <div class="wrap_input">
                    {!! Form::input('text', 'nickname', null, ['placeholder' => 'John Smith']) !!}
                  </div>
                </div>
                <ul>
                  <li>
                    @error('nickname')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </li>
                </ul>
              </div>
            </li>
            <!-- メールアドレス -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">メールアドレス</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input">
                  {!! Form::text('email', null, ['placeholder' => 'メールアドレス','style'=>'width;100px;']) !!}
                </div>
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            {{-- <li class="">
              <div class="form_head">
                <p class="ttl">性別</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input wrap_radio">
                  {!! Form::radio('gender', 1, true,['id' => 'gender_male', ]) !!}
                  <label for="gender_male">男性</label>
                  {!! Form::radio('gender', 2, true,['id' => 'gender_female', ]) !!}
                  <label for="gender_female">女性</label>
                </div>
              </div>
            </li> --}}
            <!-- 生年月日 -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">生年月日</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input wrap_calendar">
                  {!! Form::datetime('birthday', null, ['placeholder' => 'YYYY/MM/DD', "class"=>"inputdate","autocomplete"=>"off"]) !!}
                </div>
                @error('birthday')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              @include('admin.element.script_form')
            </li>
            <!-- パスワード -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">パスワード</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {{ Form::password('password',['placeholder'=>'今回登録するパスワードを入力してください']) }}
                </div>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- 確認パスワード  -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">確認パスワード</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {{ Form::password('password_confirmation',['placeholder'=>'もう一度パスワードを入力してください']) }}
                </div>
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
          </ul>
          <div class="btnarea_form">
            <a href="{{ route('admin.user') }}" class="btn_gray">キャンセル</a>
            {{ Form::button('作成する', ['type' => 'submit' ,'class' => 'btn_']) }}
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
