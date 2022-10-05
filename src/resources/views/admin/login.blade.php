@include('admin.element.header')
<section class="layout_page layout_auth">
  <!-- ヘッダー -->
  <header class="header_auth">
    <img src="{{ asset('img/logo/logo_white.svg') }}">
  </header>
  <!-- メイン  -->
  <main class="main_auth">
    <section class="area_auth">
      <div class="box_login">
        <section class="area_login">
          <div class="head_login">
            <p class="h1 ttl">ログイン</p>
            <p class="description">アプリ管理画面</p>
          </div>
          <!-- ボディ -->
          <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="body_login">
              <ul class="list_form">
                <li>
                  <div class="wrap_input col">
                    <div class="wrap_input">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">
                      </div>
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                      <div class="wrap_input">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="パスワード" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </li>
                  </ul>
                  <div class="btnarea_form">
                    <button type="submit" class="btn_full">
                      {{ __('ログイン') }}
                    </button>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </section>
      </main>
      <!-- フット_メイン -->
      <footer class="footer_auth">
        <div class="text">
          <p class="copyright">© 2020 Chateraise, inc.</p>
        </div>
      </footer>
    </section>
    @include('admin.element.footer')
