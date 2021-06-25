
@include('web.layouts.head')
<body>
<!-- ! トップビュー
-------------------------------------------------- -->

<!-- ! メイン--- -->
<main>
<!-- ! ヘッダー -->
@include('web.layouts.header')

<div id="fh5co-title-box" style="background-image: url(images/camila-cordeiro-114636.jpg); background-position: 50% 90.5px;" data-stellar-background-ratio="0.5">
  <div class=""></div>
  <div class="page-title">
    <img src="" alt="Free HTML5 by FreeHTMl5.co">
    <img src="{{asset('img/common/banner/banner__small__line.svg')}}">
    <span>January 1, 2018</span>
    <h2>How to write interesting articles</h2>
  </div>
</div>
<div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
  <div class="container paddding">
    <div class="row mx-0">
      {{-- レフトコンテンツ  --}}
      <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
        @include('web.layouts.left-sidebar-single',[
            'content' => $content
        ])
      </div>
      {{-- ライトコンテンツ  --}}
      <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
        @include('web.layouts.right-sidebar',[
          'content' => $content
        ])
      </div>
    </div>
  </div>
</div>
<div class="container-fluid pb-4 pt-5">
  @include('web.layouts.other')
</div>

</main>
@include('web.layouts.footer')

