<!doctype html>
<html lang="{{ app()->getLocale() }}">
  {{-- ヘッド --}}
  @include('admin.layout._head')
  <body class="l-body @yield('pageClass')" id="body">
    {{-- ベースレイアウト --}}
    <div class="l-base">
      {{-- メイン --}}
      <main class="l-main">
        {{-- コンテンツ --}}
        @yield('content')
      </main>
    </div>
    {{-- フッター --}}
    @include('admin.layout._footer')
    {{-- スクリプト --}}
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
  </body>
</html>
