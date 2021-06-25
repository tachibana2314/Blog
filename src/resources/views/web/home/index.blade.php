
@include('web.layouts.head')
<body>
<!-- ! ヘッダー -->
@include('web.layouts.header')

<!-- ! メイン--- -->
<main>
<div class="container-fluid pb-4 pt-4 paddding">
  <div class="container paddding">
    <div class="row mx-0">
      {{-- レフトコンテンツ  --}}
      <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
        @include('web.layouts.left-sidebar')
      </div>
      {{-- ライトコンテンツ  --}}
      <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
        @include('web.layouts.right-sidebar')
      </div>
    </div>
    {{-- ページネーション  --}}
    @include('web.layouts.pagination')
  </div>
</div>
<div class="container-fluid pb-4 pt-5">
    @include('web.layouts.other')
</div>

</main>
@include('web.layouts.footer')
