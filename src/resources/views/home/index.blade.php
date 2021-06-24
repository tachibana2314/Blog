
@include('layouts.head')
<body>
<!-- ! ヘッダー -->
@include('layouts.header')

<!-- ! メイン--- -->
<main>
<div class="container-fluid pb-4 pt-4 paddding">
  <div class="container paddding">
    <div class="row mx-0">
      {{-- レフトコンテンツ  --}}
      <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
        @include('layouts.left-sidebar')
      </div>
      {{-- ライトコンテンツ  --}}
      <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
        @include('layouts.right-sidebar')
      </div>
    </div>
    {{-- ページネーション  --}}
    @include('layouts.pagination')
  </div>
</div>
<div class="container-fluid pb-4 pt-5">
    @include('layouts.other')
</div>

</main>
@include('layouts.footer')
