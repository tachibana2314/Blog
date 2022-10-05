@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="layout_detail">
        <div class="layout_main">
          <!-- ページエリア -->
          <div class="area_page">
            <section class="area_back_page">
              <a class="btn_liner_navy" href="{{ route('admin.coupon')}}"></a>
            </section>
            <!-- ボックス -->
            <div class="l">
              <div class="l_9">
                <div class="box">
                  <div class="l nowrap">
                    <div class="l_4 gap">
                      <div class="main_gallery">
                        <div class="img" style="background: url({{ $coupon->product->getImageLabel()->url}})"></div>
                        <div class="main_gallery">
                          <div class="img" style="background: url({{ $url}})"></div>
                        </div>
                      </div>
                    </div>
                    <div class="l_8">
                      <ul class="list head_120">
                        <li>
                          <div class="head">
                            <p class="ttl">クーポンID</p>
                          </div>
                          <div class="data">
                            <p>{{ $coupon->id }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">クーポン名</p>
                          </div>
                          <div class="data">
                            <p>{!! nl2br($coupon->title) !!}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">適用商品</p>
                          </div>
                          <div class="data">
                            <p>{{ $coupon->product->name }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">タイプ</p>
                          </div>
                          <div class="data">
                            <p>{{$coupon->setTypeLabel()}}</p>
                          </div>
                        </li>
                        @if (Arr::get($coupon, 'type') === 1)
                          <li>
                            <div class="head">
                              <p class="ttl">利用可能回数</p>
                            </div>
                            <div class="data">
                              <p>{{ App\Models\Coupon::AVAILABLE_TIMES[$coupon->normal_limit_flg] }}</p>
                            </div>
                          </li>
                        @endif
                        @if(isset($coupon->start_date))
                          <li>
                            <div class="head">
                              <p class="ttl">利用期間</p>
                            </div>
                            <div class="data">
                              <p>{{ date('Y.m.d', strtotime($coupon->start_date)) }} - {{ date('Y.m.d', strtotime($coupon->end_date)) }}</p>
                            </div>
                          </li>
                        @elseif(isset($coupon->target_month))
                          <li>
                            <div class="head">
                              <p class="ttl">誕生日対象月</p>
                            </div>
                            <div class="data">
                              <p>{{$coupon->target_month}}月</p>
                            </div>
                          </li>
                        @endif
                        <li>
                          <div class="head">
                            <p class="ttl">説明文</p>
                          </div>
                          <div class="data">
                            <ul class="list_dot">
                              <p> {!! nl2br($coupon->description) !!}</p>
                            </ul>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">利用規約</p>
                          </div>
                          <div class="data">
                            <ul class="list_dot">
                              <p> {!! nl2br($coupon->terms_of_use) !!}</p>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ステータス -->
              <div class="l_3">
                <div class="box">
                  <div class="body_box">
                    <p class="h4" style="margin: 0 0 12px;">ステータス</p>
                    <p class="{{ $coupon->setStatusClass() }}_large_full"></p>
                  </div>
                  <div class="foot_box">
                    <ul class="list head_80">
                      <li>
                        <div class="head">
                          <p class="ttl">公開日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('Y.m.d', strtotime($coupon->release_date)) }}</p>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="box transparent">
                  <div class="body_box">
                    <div class="btnarea_right_space-bottom">
                      <a href="{{ route('admin.coupon.edit', $coupon) }}" class="btn_line_full_thick">クーポン情報を編集する</a>
                      <div data-remodal-target="modal_delete_coupon" class="btn_red_delete_full_thick">このクーポン情報を削除する</div>
                      @include('admin.element.modal.modal_delete_coupon')
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
