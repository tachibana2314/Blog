@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script>
    $(function () {
      $('.datepicker').datepicker({dateFormat: "yy/mm/dd",});
    })
  </script>

  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア -->
      <section class="area_page">
        <section class="head_page">
          <div class="area_ttl_page">
            <div class="text">
              <p class="h1 ttl">ダッシュボード</p>
            </div>
          </div>
        </section>
        <section class="body_page">

          <!-- ダッシュボードコンテンツ -->
          <section class="area_dashboard">
            <div class="box transparent">
              <ul class="list_nav_dashboard">
                <!-- 顧客管理 -->
                <li class="users">
                  <article class="box">
                    <div class="text">
                      <p class="ttl">顧客管理</p>
                      <p class="count" data-after="users">
                        {{ number_format($user_count) }}
                      </p>
                    </div>
                    <div class="btnarea">
                      <a href="{{ route('admin.user') }}" class="btn_line_navy">顧客一覧</a>
                      <a href="{{ route('admin.user.add') }}" class="btn_blue">顧客追加</a>
                    </div>
                  </article>
                </li>
                <!-- 商品管理 -->
                <li class="products">
                  <article class="box">
                    <div class="text">
                      <p class="ttl">商品管理</p>
                      <p class="count" data-after="products">
                        {{ number_format($product_count) }}
                      </p>
                    </div>
                    <div class="btnarea">
                      <a href="{{ route('admin.product') }}" class="btn_line_navy">商品一覧</a>
                      <a href="{{ route('admin.product.add') }}" class="btn_blue">商品追加</a>
                    </div>
                  </article>
                </li>
                <!-- クーポン管理 -->
                <li class="coupon">
                  <article class="box">
                    <div class="text">
                      <p class="ttl">クーポン管理</p>
                      <p class="count" data-after="coupons">
                        {{ number_format($coupon_count) }}
                      </p>
                    </div>
                    <div class="btnarea">
                      <a href="{{ route('admin.coupon') }}" class="btn_line_navy">クーポン一覧</a>
                      <a href="{{ route('admin.coupon.add') }}" class="btn_blue">クーポン追加</a>
                      <a href="{{ route('admin.coupon.couponExport') }}" class="btn_navy">CSV（クーポン取得履歴）</a>
                    </div>
                  </article>
                </li>
                <!-- スタンプ管理 -->
                <li class="stamp">
                  <article class="box">
                    <div class="text">
                      <p class="ttl">スタンプカード管理</p>
                      <p class="count" data-after="stamps">
                        {{ number_format($stamp_card_count) }}
                      </p>
                    </div>
                    <div class="btnarea">
                      <a href="{{ route('admin.stamp') }}" class="btn_line_navy" style="font-size: 12px;">スタンプカード一覧</a>
                      <a href="{{ route('admin.stamp.addCoupon') }}" class="btn_blue">スタンプカード追加</a>
                      <a href="{{ route('admin.stamp.stampExport') }}" class="btn_navy">CSV（スタンプ履歴）</a>
                    </div>
                  </article>
                </li>
                <!-- 店舗管理 -->
                <li class="store">
                  <article class="box">
                    <div class="text">
                      <p class="ttl">店舗管理</p>
                      <p class="count" data-after="stores">
                        {{ number_format($store_count) }}
                      </p>
                    </div>
                    <div class="btnarea">
                      <a href="{{ route('admin.store') }}" class="btn_line_navy">店舗一覧</a>
                      <a href="{{ route('admin.store.add') }}" class="btn_blue">店舗追加</a>
                    </div>
                  </article>
                </li>
              </ul>
            </div>

            <div class="box transparent">
              <div class="l">
                <!-- グラフ読み込み -->
                <div class="l_6">
                  <div class="box">
                    <div class="area_graph_dashboard">
                      <div class="head_graph_dashboard">
                        <p class="h3">
                          会員数推移
                        </p>
                        <div class="status">
                          <p class="count" data-before="累計" data-after="人">
                            {{ number_format($user_count_graph) }}
                          </p>
                        </div>
                      </div>
                      <div
                        id="customer_count_conditions"
                        class="head_graph_dashboard"
                      >
                        <select
                          name="type"
                          style="margin-right: 10px;"
                          onchange="updateGraphDataForCustomerCount();"
                        >
                          <option value="monthly">月別</option>
                          <option value="daily">日別</option>
                        </select>
                        {!! Form::datetime('start', date('Y/m/d', strtotime('-6 month')), [
                          "class" => "datepicker",
                          "autocomplete" => "off",
                          "onchange" => "updateGraphDataForCustomerCount()",
                        ]) !!}
                        <div
                          style="margin: 10px;"
                        >~</div>
                        {!! Form::datetime('end', date('Y/m/d'), [
                          "class" => "datepicker",
                          "autocomplete" => "off",
                          "onchange" => "updateGraphDataForCustomerCount()",
                        ]) !!}
                      </div>
                      <div class="body_graph_dashboard">
                        <!-- グラフ描写 -->
                        @include('admin.dashboard._graph')
                      </div>
                    </div>
                  </div>
                </div>

                <div class="l_6">
                  <div class="box ">
                    <div class="head_box">
                      <h3 class="ttl h3">お気に入り商品ランキング<small>（ステータスが公開かつ期間内の商品）</small></h3>
                    </div>
                    <div class="body_box">
                      <ul class="list_rank_product">
                        <?php
                        $rank = 1;
                        $tmp_favorite_count = 0; ?>
                        @foreach($products as $key => $product)
                          <?php
                          if ($tmp_favorite_count !== $product->favorites_count) {
                            $rank = $key + 1;
                          }
                          $tmp_favorite_count = $product->favorites_count;
                          ?>
                          <li class="ranking_{{$rank}}">
                            <article data-rank="{{ $rank }}">
                              <div class="img" style="background:url({{ $product->getImageLabel()->url }})"></div>
                              <div class="text">
                                <p class="name">{{$product->name}}</p>
                                <p class="fav">お気に入り数：<span>{{ number_format($product-> getfavoriteCountLabel()) }}</span></p>
                              </div>
                            </article>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="fot_box">
                      <div class="btnarea_center">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </section>

        </section>
      </section>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
