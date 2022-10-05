@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="box box_600">
        <div class="head_box">
          <div class="text">
            <p class="h1">管理者を編集する</p>
            <p class="description">管理者情報を入力してください</p>
            <p class="description">「<span style="color: #FF0000;">*</span>」は必須項目ですので必ず入力してください。</p>
          </div>
        </div>
        <div class="body_box">
          {!! Form::model($admin, ['url' => route('admin.member.edit', $admin), 'method' => 'post']) !!}
          <!-- フォームエリア -->
          <ul class="list_form">
            <li class="required">
              <div class="form_head">
                <p class="ttl">氏名</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <span class="unit_2_right">姓</span>
                  <div class="wrap_input">
                    {!! Form::input('text', 'last_name', null, ['placeholder' => '山田']) !!}
                  </div>
                  <span class="unit_2_right">名</span>
                  <div class="wrap_input">
                    {!! Form::input('text', 'first_name', null, ['placeholder' => '太郎']) !!}
                  </div>
                </div>
                <ul>
                  <li>
                    @error('last_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </li>
                  <li>
                    @error('first_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </li>
                </ul>
              </div>
            </li>
            <!-- フリガナ -->
            <li class="required">
              <div class="form_head">
                <p class="ttl">フリガナ</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  <span class="unit_2_right">セイ</span>
                  <div class="wrap_input">
                    {!! Form::input('text', 'last_name_kana', null, ['placeholder' => 'ヤマダ']) !!}
                  </div>
                  <span class="unit_2_right">メイ</span>
                  <div class="wrap_input">
                    {!! Form::input('text', 'first_name_kana', null, ['placeholder' => 'タロウ']) !!}
                  </div>
                </div>
                <ul>
                  <li>
                    @error('last_name_kana')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </li>
                  <li>
                    @error('first_name_kana')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </li>
                </ul>
              </div>
            </li>
            <!-- メール -->
            <li class="required">
              <div class="form_head">
                <p class="ttl" style="width:200px;">メールアドレス</p>
              </div>
              <div class=" form_data">
                <div class="wrap_input">
                  {{ Form::text('email',$admin['email'],['placeholder'=>'メールアドレス','readonly'=>true,'required'=>true]) }}
                </div>
              </div>
            </li>
            <!-- 部署 -->
            <li>
              <div class="form_head">
                <p class="ttl" style="width:200px;">部署</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::input('text', 'department', null, ['placeholder' => '部署名']) !!}
                </div>
              </div>
            </li>
            <!-- 役職 -->
            <li>
              <div class="form_head">
                <p class="ttl" style="width:200px;">役職</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {!! Form::input('text', 'position', null, ['placeholder' => '役職名']) !!}
                </div>
              </div>
            </li>
          </ul>
          <ul class="list_form">
            <div class="head_box">
              <div class="text">
                <p class="description"><span style="color: #FF0000;">*</span>パスワード変更する時のみ入力してください。</p>
              </div>
            </div>
            <!-- 現在パスワード -->
            <li class="">
              <div class="form_head">
                <p class="ttl" style="width:200px;">現在パスワード</p>
              </div>
              <div class="form_data">
                <div class="wrap_input">
                  {{ Form::password('old_password',['placeholder'=>'現在のパスワードを入力してください']) }}
                </div>
                @error('old_password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </li>
            <!-- パスワード -->
            <li class="">
              <div class="form_head">
                <p class="ttl" style="width:200px;">パスワード</p>
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
            <li class="">
              <div class="form_head">
                <p class="ttl" style="width:200px;">確認パスワード</p>
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
            <a href="{{ route('admin.member.detail',$admin) }}" class="btn_gray">キャンセル</a>
            <div class="">{!! Form::submit('変更を反映する', ['class' => 'btn_']) !!}</div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
