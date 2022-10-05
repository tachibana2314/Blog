<!DOCTYPE html>
<html lang="en" class="page_auth page_login">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  $cssAdmin = [
    'cssreset-min',
    'fw-layout',
    'fw-cmn',
    'fw-form',
    'fw-page',
    'fw-auth'
  ];
  $css = [
    'cssreset-min',
    'fw-layout',
    'fw-cmn',
    'fw-form',
    'fw-page',
    'layout',
    'style',
    'page',
    'theme',
    'remodal',
    'remodal-default-theme',
  ];
  ?>
  <!-- Scripts -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/jonthornton/jquery-timepicker/3e0b283a/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/remodal-default-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/remodal.css') }}">

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/3e0b283a/jquery.timepicker.min.css">

  @foreach($cssAdmin as $css)
    <link rel="stylesheet" href="{{ asset("/css/$css.css") }}">
  @endforeach

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/hot-sneaks/jquery-ui.css">


  <!-- favicon
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" type="image/png" href="{{ asset('img/logo/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/logo/favicon.png') }}"> -->
  <title>シャトレーゼ</title>
</head>

<!-- ! フラッシュメッセージ ============================== -->
@include('admin.element.flash')

<main class="@yield('main_class')">
  <section class="head_main">
    <div class="container">
      <section class="area_nav_main">

        @yield('content')
      </section>
    </div>
  </section>
</main>

@include('admin.element.footer')
