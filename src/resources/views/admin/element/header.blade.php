<!DOCTYPE html>
@switch(Route::current()->getName())
  @case('admin.login')
  <html lang="en" class="page_auth page_login">
  @break
  @case('admin.home')
  <html lang="en" class="page_home">
  @break
  @case('admin.user')
  <html lang="en" class="page_users">
  @break
  @case('admin.product')
  <html lang="en" class="page_products">
  @break
  @case('admin.product.order')
  <html lang="en" class="page_products">
  @break
  @case('admin.store')
  <html lang="en" class="page_store">
  @break
  @case('admin.coupon')
  <html lang="en" class="page_coupon">
  @break
  @case('admin.information')
  <html lang="en" class="page_informations">
  @break
  @case('admin.slide')
  <html lang="en" class="page_slide">
  @break
  @case('admin.member')
  <html lang="en" class="page_members">
  @break
@endswitch

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=1200">
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
    'jquery-ui',
    'select2'
  ];
  ?>
  <!-- Scripts -->
  <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/remodal.min.js') }}"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/remodal-default-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/remodal.css') }}">

  <!-- favicon -->
  <!-- <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" type="image/png" href="{{ asset('admin/img/logo/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('admin/img/logo/favicon.png') }}"> -->

  <!-- Styles -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/jonthornton/jquery-timepicker/3e0b283a/jquery.timepicker.min.css">
  @foreach($css as $css)
    <link rel="stylesheet" href="{{ asset("/css/$css.css") }}?v=20211227">
  @endforeach
  @switch(url()->current())
    @case(route('admin.login'))
    @foreach($cssAdmin as $css)
      <link rel="stylesheet" href="{{ asset("/css/$css.css") }}?v=20211227">
    @endforeach
    @break
  @endswitch

  <title>シャトレーゼ</title>
  <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}">
  <link rel="apple-touch-icon" type="image/png" href="{{ asset('img/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
</head>
