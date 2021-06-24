<!-- ! ヘッダー ============================== -->
<header>
  {{-- header_top --}}
  <div class="container-fluid fh5co_header_bg">
    <div class="container">
      <div class="row">
        <div class="col-12 fh5co_mediya_center"><a href="#" class="color_fff fh5co_mediya_setting"><i
                class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Friday, 5 January 2018</a>
          <div class="d-inline-block fh5co_trading_posotion_relative"><a href="#" class="treding_btn">Trending</a>
            <div class="fh5co_treding_position_absolute"></div>
          </div>
          <a href="#" class="color_fff fh5co_mediya_setting">Instagram’s big redesign goes live with black-and-white app</a>
        </div>
      </div>
    </div>
  </div>

  {{-- header_middle --}}
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-3 fh5co_padding_menu">
          <img src="images/logo.png" alt="img" class="fh5co_logo_width"/>
        </div>
        <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
          <div class="text-center d-inline-block">
              <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-search"></i></div></a>
          </div>
          <div class="text-center d-inline-block">
              <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div></a>
          </div>
          <div class="text-center d-inline-block">
              <a class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div></a>
          </div>
          <div class="text-center d-inline-block">
              <a href="https://twitter.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div></a>
          </div>
          <div class="text-center d-inline-block">
              <a href="https://fb.com/fh5co" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div></a>
          </div>
          <!--<div class="d-inline-block text-center"><img src="images/country.png" alt="img" class="fh5co_country_width"/></div>-->
          <div class="d-inline-block text-center dd_position_relative ">
            <select class="form-control fh5co_text_select_option">
              <option>English </option>
              <option>French </option>
              <option>German </option>
              <option>Spanish </option>
            </select>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>

  {{-- header_low --}}
  <div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
      <nav class="navbar navbar-toggleable-md navbar-light ">
        <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
        <a class="navbar-brand" href="#"><img src="images/logo.png" alt="img" class="mobile_logo_width"/></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('home')}}">ホーム <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('show')}}">プロフィール <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{ route('show')}}" id="dropdownMenuButton2" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">プログラミング<span class="sr-only">(current)</span></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                <a class="dropdown-item" href="#">PHP</a>
                <a class="dropdown-item" href="#">Laravel</a>
                <a class="dropdown-item" href="#">AWS</a>
                <a class="dropdown-item" href="#">React.js</a>
                <a class="dropdown-item" href="#">JavaScript/jQuery</a>
                <a class="dropdown-item" href="#">Node.js</a>
                <a class="dropdown-item" href="#">Linux</a>
                <a class="dropdown-item" href="#">git</a>
                <a class="dropdown-item" href="#">ウェブサービス</a>
                <a class="dropdown-item" href="#">アプリ</a>
                <a class="dropdown-item" href="#">サーバー</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{ route('show')}}" id="dropdownMenuButton2" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">キャリア<span class="sr-only">(current)</span></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                  <a class="dropdown-item" href="#">転職活動</a>
                  <a class="dropdown-item" href="#">面接対策</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="{{ route('home')}}" id="dropdownMenuButton2" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">イベントレポート<span class="sr-only">(current)</span></a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                  <a class="dropdown-item" href="#">勉強会</a>
                  <a class="dropdown-item" href="#">コミュニティイベント</a>
              </div>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('contact') }}">お問い合わせ <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

</header>
