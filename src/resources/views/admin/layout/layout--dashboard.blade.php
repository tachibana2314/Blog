<!doctype html>
<html lang="{{ app()->getLocale() }}">
  @include('admin.layout._head')
  <body class="l-body @yield('pageClass')" id="body">
    @include('admin.layout._header')
    <div class="l-base">
      @include('admin.layout._sidebar')
      <main class="l-main l-main--dashboard">
        @yield('content')
      </main>
    </div>
    @include('admin.layout._footer')
    @include('admin.element.project._p-flashMessage')
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/library/remodal.min.js') }}"></script>
    <script src="{{ asset('js/admin/js-remodal.js') }}"></script>
    <script src="{{ asset('js/admin/js-dataHref.js') }}"></script>
    <script src="{{ asset('js/admin/js-overview.js') }}"></script>
    <script src="{{ asset('js/admin/js-headerMenu.js') }}"></script>
    <script src="{{ asset('js/admin/js-megaMenu.js') }}"></script>
    <script src="{{ asset('js/admin/js-flashMessage.js') }}"></script>
    <script src="{{ asset('js/admin/js-hideMenu.js') }}"></script>
    <script src="{{ asset('js/admin/js-alertMenu.js') }}"></script>
    
    <!-- chart js -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <!-- chart js - ダッシュボード売り上げ -->
    <script src="{{ asset('js/admin/js-chart__attendance.js') }}"></script>
    <script src="{{ asset('js/admin/js-chart__user.js') }}"></script>
  </body>
</html>
