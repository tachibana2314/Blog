@extends('admin.element.app_admin')

@section('main_class', 'main')
@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="area_page">
        <section class="area_back_page">
          <a class="btn_liner_navy" href="{{ route('admin.store') }}"></a>
        </section>
        <div class="body_page">
          <div class="l">
            <div class="l_9">
              <div class="box">
                <div class="body_box">
                  <div class="area_sales_detail list_left">
                    <ul class="list">
                      <li>
                        <div class="head">
                          <p class="ttl">店舗ID</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->id }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">店舗名</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->name }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">電話番号</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->tel }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">住所</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->address }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl" style="width:150px;">カフェスペース</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->getCafeFlgLabel() }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl" style="width:150px;">ワイン取扱い</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->getWineFlgLabel() }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl" style="width:150px;">焼き立て商品取扱い</p>
                        </div>
                        <div class="data">
                          <p>{{ $store->getOvenFlgLabel() }}</p>
                        </div>
                      </li>
                    </ul>
                    <ul class="list head_100 list_right">
                      <div class="head">
                        <p class="ttl">営業開始時間</p>
                      </div>
                      <li>
                        <div class="head">
                          <p class="ttl">月曜日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->mon_start_time)) }}</p>
                        </div>
                        <span class="">-</span>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->mon_end_time)) }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">火曜日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->tue_start_time)) }}</p>
                        </div>
                        <span class="">-</span>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->tue_end_time)) }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">水曜日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->wed_start_time)) }}</p>
                        </div>
                        <span class="">-</span>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->wed_end_time)) }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">木曜日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->thu_start_time)) }}</p>
                        </div>
                        <span class="">-</span>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->thu_end_time)) }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">金曜日</p>
                        </div>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->fri_start_time)) }}</p>
                        </div>
                        <span class="">-</span>
                        <div class="data">
                          <p>{{ date('H:i', strtotime($store->fri_end_time)) }}</p>
                        </div>
                      </li>
                      @isset($store->sat_start_time)
                        <li>
                          <div class="head">
                            <p class="ttl">土曜日</p>
                          </div>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->sat_start_time)) }}</p>
                          </div>
                          <span class="">-</span>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->sat_end_time)) }}</p>
                          </div>
                        </li>
                      @endisset
                      @isset($store->sun_start_time)
                        <li>
                          <div class="head">
                            <p class="ttl">日曜日</p>
                          </div>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->sun_start_time)) }}</p>
                          </div>
                          <span class="">-</span>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->sun_end_time)) }}</p>
                          </div>
                        </li>
                      @endisset
                      @isset($store->hol_start_time)
                        <li>
                          <div class="head">
                            <p class="ttl">祝日</p>
                          </div>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->hol_start_time)) }}</p>
                          </div>
                          <span class="">-</span>
                          <div class="data">
                            <p>{{ date('H:i', strtotime($store->hol_end_time)) }}</p>
                          </div>
                        </li>
                      @endisset
                    </ul>
                  </div>
                  <div style="padding-top: 50px;">
                    <ul class="list">
                      <li>
                        <div class="head">
                          <p class="ttl">店舗の説明</p>
                        </div>
                        <div class="data">
                          <p> {!! nl2br($store->description) !!}</p>
                        </div>
                      </li>
                    </ul>
                  </div>
                  @if($store->isImage())
                  <div class="l_12 gap">
                    <div class="main_gallery_s">
                        <div class="img" style="background: url({{ $store->url }})"></div>
                    </div>
                  </div>
                  @endif
                  <div>
                    <div class="area_map_store">
                      <div id="map" style="height: 400px; width: 100%">
                        <iframe
                          src="https://maps.google.com/maps?output=embed&q={{ $store['latitude'] }},{{ $store['longitude'] }}&t=m&hl=en&z=18"
                          width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""
                        ></iframe>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="l_3">
              <div class="box">
                <div class="body_box">
                  <p class="h4" style="margin: 0 0 12px;">ステータス</p>
                  <p class="{{ $store->setStatusClass() }}_large_full"></p>
                </div>
                <div class="foot_box">
                  <ul class="list head_120">
                    <li>
                      <div class="head">
                        <p class="ttl">更新日時</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d', strtotime($store->updated_at)) }}</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="box transparent">
                <div class="body_box">
                  <div class="btnarea_">
                    <a class="btn_liner_full_thick" href="{{ route('admin.store.edit', $store) }}">店舗情報を編集する</a>
                    <div data-remodal-target="modal_delete_store" class="btn_red_delete_full_thick">この店舗情報を削除する</div>
                    @include('admin.element.modal.modal_delete_store')
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
