<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta name="description" content="@yield('description')">
  <meta name="keywords" content="@yield('keywords')">
  <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}">
  <link rel="apple-touch-icon" type="image/png" href="{{ asset('img/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
  <style>
      /* A Modern CSS Reset */
      *,*::before,*::after{box-sizing:border-box}body,h1,h2,h3,h4,p,figure,blockquote,dl,dd{margin:0}ul[role="list"],ol[role="list"]{list-style:none}html:focus-within{scroll-behavior:smooth}body{min-height:100vh;text-rendering:optimizeSpeed;line-height:1.5}a:not([class]){text-decoration-skip-ink:auto}img,picture{max-width:100%;display:block}input,button,textarea,select{font:inherit}@media(prefers-reduced-motion:reduce){html:focus-within{scroll-behavior:auto}*,*::before,*::after{animation-duration:.01ms !important;animation-iteration-count:1 !important;transition-duration:.01ms !important;scroll-behavior:auto !important}}
      body {
          position: relative;
          background: url(../img/bg/bg_login_admin.jpg) no-repeat center center;
          background-size: cover !important;
          padding: 30px;
      }
      header {

      }
      header img {
          height: 26px;
      }
      div {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          margin: auto;
          width: 100%;
          height: 120px;
      }
      a {
          margin: 30px auto;
          width: 120px;
          text-align: center;
          text-decoration: none;
          background: #E44063;
          border-color: #E44063;
          color: #fff;
          font: 700 15px/1em "noto sans japanese", sans-serif;
          height: 50px;
          display: flex;
          align-items: center;
          justify-content: center;
          min-width: 200px;
          padding: 0 1em;
          border-radius: 3px;
          user-select: none;
          cursor: pointer;
          transition: .1s;
          box-shadow: 0px 10px 10px rgb(0 0 0 / 30%);
      }
  </style>
</head>
<body>
<header>
  <img src="/img/logo/logo_white.svg">
</header>
<div>
{{--  <a href="{{ $link }}">--}}
{{--    Open App--}}
{{--  </a>--}}
  <a href="https://apps.apple.com/us/app/chateraise-singapore/id1560078823">
    Download App
  </a>
</div>
</body>
</html>