@include('admin.element.header')
<body
  class="
    @if(config('app.env') == 'develop')
      demo
      demo--sg
    @endif
  "
>
  <!-- ! フラッシュメッセージ ============================== -->
  @include('admin.element.flash')
  <section class="layout_page">
    @include('admin.element.aside')
    @include('admin.element.flash')
    <main class="@yield('main_class')">
      @include('admin.element.head_main')
  
      @yield('content')
    </main>
  </section>
</body>
@include('admin.element.footer')
