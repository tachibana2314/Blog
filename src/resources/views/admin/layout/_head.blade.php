<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | {{ config('app.name').' 基幹システム' }}</title>
  <meta name="description" content="">

  <!— ! faviconなど各種 —————————— —>
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/admin/foundation/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/admin/foundation/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/admin/foundation/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('img/admin/foundation/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('img/admin/foundation/safari-pinned-tab.svg') }}" color="#91A6BE">
  <meta name="msapplication-TileColor" content="#91A6BE">
  <meta name="theme-color" content="#91A6BE">

  <!— ! cssの読み込み —————————— —>
  <link href="{{ asset('css/style--admin.css') }}" rel="stylesheet">

  <!— ! fontの読み込み —————————— —>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  {{-- <link href="{{asset('css/common/flat.picker.css')}}" rel="stylesheet"> --}}

  <!-- スクリプトの読み込み-->
  <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>

  {{-- flatpickr --}}
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
  {{-- flatpickr --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- flatpickrの月選択プラグイン --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>

  {{-- 住所自動入力 --}}
  <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
  <script type="text/javascript" src="{{asset('/js/flatpickr.js')}}"></script>
  {{-- fullcalendar（従業員詳細） --}}
  <script src="{{ asset('js/library/fullcalendar/main.min.js') }}"></script>
</head>
