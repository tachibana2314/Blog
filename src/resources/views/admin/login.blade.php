@extends('admin.layout.layout--login')
@section('title', $title ?? 'ログイン')
@section('pageClass', 'page_mypage')
@section('content')
  <section class="l-page l-page--login">
    <div class="p-login">
      <div class="p-login__head">
        <img class="p-login__head__logo" src="{{asset('img/common/logo/logo--black.svg')}}">
        <p class="sub c-text__note">基幹システムログイン</p>
      </div>
      <div class="p-login__body">
        {!! Form::open(['route' => ['admin.login'], 'method' => 'post', 'novalidate' => true]) !!}
          <ul class="p-login__list">
            <li>
              <div class="c-input {{ $errors->get('staff_code') ? 'c-input--error' : null }}">
                <input
                  type="email"
                  class="@error('staff_code') is-invalid @enderror"
                  placeholder="社員番号"
                  name="staff_code"
                  value="{{ old('staff_code') }}"
                  required
                  autocomplete="staff_code" autofocus
                >
              </div>
              @error('staff_code')
              <div class="p-formError">
                <p class="message">
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                </p>
              </div>
              @enderror
            </li>
            <li>
              <div class="c-input {{ $errors->get('password') ? 'c-input--error' : null }}">
                <input
                  type="password"
                  class="@error('password') is-invalid @enderror"
                  placeholder="パスワード"
                  name="password"
                  required
                  autocomplete="current-password"
                >
              </div>
              @error('password')
                <div class="p-formError">
                  <p class="message">
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  </p>
                </div>
              @enderror
            </li>
            <li>
              <div class="p-buttonArea">
                <button
                  type="submit"
                  class="c-button c-button--main c-button--large c-button--full"
                >ログイン</button>
              </div>
            </li>
          </ul>
        {!! Form::close() !!}
      </div>
    </div>
  </section>
@endsection
