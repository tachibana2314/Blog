<!doctype html>
<html lang="{{ app()->getLocale() }}">
  @include('admin.layout._head')
  <body class="l-body @yield('pageClass')" id="body">
    @include('admin.layout._header')
    <div class="l-base">
      @yield('content')
    </div>
    @include('admin.layout._footer')
    @include('admin.element.project._p-flashMessage')
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/library/remodal.min.js') }}"></script>
    <script src="{{ asset('js/library/photoswipe.min.js') }}"></script>
    <script src="{{ asset('js/library/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('js/library/select2.min.js') }}"></script>
    <script src="{{ asset('js/library/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('js/admin/js-remodal.js') }}"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="{{ asset('js/admin/js-dataHref.js') }}"></script>
    <script src="{{ asset('js/admin/js-overview.js') }}"></script>
    <script src="{{ asset('js/admin/js-photoList.js') }}"></script>
    <script src="{{ asset('js/admin/js-flashMessage.js') }}"></script>
    <script src="{{ asset('js/admin/js-hideMenu.js') }}"></script>
    <script src="{{ asset('js/admin/js-alertMenu.js') }}"></script>
    <script src="{{ asset('js/admin/js-draggable.js') }}"></script>
    <script src="{{ asset('js/admin/js-log.js') }}"></script>
<!--     <script src="{{ asset('js/admin/js-photoSwipe.js') }}"></script> -->
    <script src="{{ asset('js/admin/js-select2.js') }}"></script>
    <script src="{{ asset('js/admin/js-calendar.js') }}"></script>
    <script>
      $('#editor').trumbowyg({
          svgPath: '/img/library/icons.svg',
          fullscreenable: false,
          closable: true,
          btns: ['bold', 'italic', '|', 'insertImage']
      });
    </script>
  </body>
</html>
