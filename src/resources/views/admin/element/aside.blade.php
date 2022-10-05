<aside class="aside @unless(url()->current() == route('admin.home')) aside_min @endunless">
  <div class="header">
      <!-- ロゴエリア -->
    <section class="area_logo">
      <a href="{{ route('admin.home') }}" class="logo">
      @unless(url()->current() == route('admin.home'))
        <img src="{{ asset('img/logo/logo_min.svg') }}">
      @else
        <img src="{{ asset('img/logo/logo.svg') }}">
      @endunless
      </a>
    </section>
  </div>
    <!-- ナビエリア -->
  <section class="area_nav_aside">
    <ul class="list_nav_aside">
      <li class="home @if (url()->current() == route('admin.home')) current @endif">
        <a href="{{ route('admin.home') }}">
          <span class="tag">
            <span>ダッシュボード</span>
          </span>
        </a>
      </li>
      <li class="users {{ in_array(Route::currentRouteName(), ['admin.user', 'admin.user.add', 'admin.user.edit', 'admin.user.detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.user')}}">
          <span class="tag">
            <span>顧客管理</span>
          </span>
        </a>
      </li>
      <li class="products {{ in_array(Route::currentRouteName(), ['admin.product', 'admin.product.add', 'admin.product.edit', 'admin.product.detail', 'admin.product.order'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.product')}}">
          <span class="tag">
            <span>商品管理</span>
          </span>
        </a>
      </li>
      <li class="store {{ in_array(Route::currentRouteName(), ['admin.store', 'admin.store.add', 'admin.store.edit', 'admin.store.detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.store')}}">
          <span class="tag">
            <span>店舗管理</span>
          </span>
        </a>
      </li>
      <li class="coupon {{ in_array(Route::currentRouteName(), ['admin.coupon', 'admin.coupon.add', 'admin.coupon.edit', 'admin.coupon.detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.coupon')}}">
          <span class="tag">
            <span>クーポン管理</span>
          </span>
        </a>
      </li>
      <li class="informations {{ in_array(Route::currentRouteName(), ['admin.information', 'admin.information.add', 'admin.information.edit', 'admin.information.detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.information')}}">
          <span class="tag">
            <span>お知らせ管理</span>
          </span>
        </a>
      </li>
      <li class="slide {{ in_array(Route::currentRouteName(), ['admin.slide','admin.slide.add', 'admin.slide.edit'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.slide')}}">
          <span class="tag">
            <span>スライド管理</span>
          </span>
        </a>
      </li>
      <li class="stamp {{ in_array(Route::currentRouteName(), ['admin.stamp', 'admin.stamp.addCoupon', 'admin.stamp.edit', 'admin.stamp.coupon_detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.stamp')}}">
          <span class="tag">
            <span>スタンプ管理</span>
          </span>
        </a>
      </li>
      <li class="products {{ in_array(Route::currentRouteName(), ['admin.point_gift.index', 'admin.point_gift.add', 'admin.point_gift.edit', 'admin.point_gift.detail',], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.point_gift.index')}}">
          <span class="tag">
            <span>ポイント景品管理</span>
          </span>
        </a>
      </li>
      <li class="products {{ in_array(Route::currentRouteName(), ['admin.point.index',], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.point.index')}}">
          <span class="tag">
            <span>ポイント管理</span>
          </span>
        </a>
      </li>
      <li class="members {{ in_array(Route::currentRouteName(), ['admin.member', 'admin.member.add', 'admin.member.edit', 'admin.member.detail'], TRUE) ? 'current' : '' }}">
        <a href="{{ route('admin.member')}}">
          <span class="tag">
            <span>管理者管理</span>
          </span>
        </a>
      </li>
    </ul>
  　</section>
</aside>
