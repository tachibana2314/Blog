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
              <a class="btn_liner_navy" href="{{ route('admin.stamp')}}"></a>
            </section>
            <!-- ボックス -->
            <div class="l">
              <div class="l_9">
                <div class="box">
                  <div class="l nowrap">
                    <div class="l_4 gap">
                      <div class="main_gallery">
                        <div class="img" style="background: url({{ $main_url }})"></div>
                      </div>
                      <ul class="list_gallery">
                        <li>
                          <article>
                            <div class="img" style="background: url({{ $main_url }})"></div>
                          </article>
                        </li>
                        <li>
                          <article>
                            <div class="img" style="background: url({{ $barcode_url }})"></div>
                          </article>
                        </li>
                      </ul>
                    </div>
                    <div class="l_8">
                      <ul class="list head_120">
                        <li>
                          <div class="head">
                            <p class="ttl">クーポン名</p>
                          </div>
                          <div class="data">
                            <p>{{ $stamp_coupon['title'] }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">スタンプ数</p>
                          </div>
                          <div class="data">
                            <p>{{ $stamp_coupon['stamp_count'] }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">適用カード</p>
                          </div>
                          <div class="data">
                            <p>{{ $stamp_card['title'] }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">利用期間</p>
                          </div>
                          <div class="data">
                            <p>{{ $stamp_coupon['use_period']}}日間</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">説明文</p>
                          </div>
                          <div class="data">
                            <ul class="list_dot">
                              <p> {!! nl2br($stamp_coupon['description']) !!}</p>
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
                    <p class="{{ $stamp_coupon->setStatusClass() }}_large_full"></p>
                  </div>
                </div>
                <div class="box transparent">
                  <div class="body_box">
                    <div class="btnarea_right_space-bottom">
                      <a href="{{ route('admin.stamp.coupon_edit', $stamp_coupon) }}" class="btn_line_full_thick">クーポン情報を編集する</a>
                      <div data-remodal-target="modal_delete_stamp_coupon" class="btn_red_delete_full_thick">クーポン情報を削除する</div>
                      @include('admin.element.modal.modal_delete_stamp_coupon')
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
