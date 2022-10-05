<section class="head_main">
  <div class="container">
    <section class="area_nav_main">
      <!-- パンクズ -->
      <?php
      $bread = array(
        'ダッシュボード' => route('admin.home'),
        isset($title) && $title === '表示順設定' ? '商品管理' : '' => route('admin.product'),
        isset($title) && $title ? $title : '' => url()->full(),
      );
      $bread = array_filter($bread);
      ?>
      <div class="area_bread">
        <ul class="list_bread">
          @foreach ($bread as $key => $val)
            @if ($key)
              <li>
                <a href="{{ $val }}">{{ $key }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
      <div class="area_user">
        <a class="button" href="{{ route('admin.logout') }}">ログアウト</a>
      </div>
    </section>
  </div>
</section>
