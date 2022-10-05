<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="page_auth page_login">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('admin/css/cssreset-min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/fw-layout.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/fw-cmn.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/fw-form.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/fw-page.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/fw-auth.css') }}" rel="stylesheet">

</head>

<body class="body_page">
  <!— ! ヘッダー —————————————————————————————— —>
  {{-- 成功のフラッシュメッセージ --}}
  @if (session('message'))
    <section class="area_flash">
      <ul class="list_flash">
        <li class="flash_success">
          <article class="link_float">
            <div class="data">
              {{ __(session('message')) }}
            </div>
          </article>
        </li>
      </ul>
    </section>
  @endif
  {{-- 失敗のフラッシュメッセージ --}}
  @if (session('message_error'))
    <section class="area_flash">
      <ul class="list_flash">
        <li class="flash_error">
          <article class="link_float">
            <div class="data">
              {{ __(session('message_error')) }}
            </div>
          </article>
        </li>
      </ul>
    </section>
  @endif

  <section class="layout_page layout_auth">

    @include('element.admin.admin_header')
    @yield('content')

    <!-- フット_メイン -->
    <footer class="footer_auth">
      <div class="text">
        <p class="copyright">© 2020 Chateraise, inc.</p>
      </div>
    </footer>
  </section>
  @include('element.admin.script')
</body>

</html>
