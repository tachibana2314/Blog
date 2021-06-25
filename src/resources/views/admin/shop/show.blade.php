@extends('admin.layout.layout--detail')
@section('title', $title ?? '店舗詳細')
@section('pageClass', 'page_mypage')
@section('content')
  @include('admin.layout._sidebar--shop', ['shop' => $shop])
  <main class="l-main l-main--detail">
    <div class="l-page l-page--detail">
      <div class="p-page">
        <div class="p-page__head p-page__head--detail">
          <div class="l-container">
            <h1 class="c-heading--lv2">店舗詳細</h1>
          </div>
        </div>
        <div class="p-page__body">
          <div class="l-container">
            <div class="l-12 l-12--nowrap l-12--start l-12--gap8">
              <div class="l-12__fix240">
                {{-- 基本情報 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                    基本情報
                  @endslot
                  @slot('action')
                    <div class="p-buttonArea">
                      <a href="{{ $is_virtual ? route('admin.virtual_shop.edit', $shop) : route('admin.shop.edit', $shop) }}" class="c-button c-button--line c-button--small">
                        編集
                      </a>
                    </div>
                  @endslot
                  @slot('body')
                    <ul class="p-list">
                      <li>
                        <div class="p-list__label">店舗名</div>
                        <div class="p-list__data">
                          @if(!$is_virtual)
                            {{ $shop->disp_name_with_abbreviation ?? '---'}}
                          @else
                            {{ $shop->name ?? '---'}}
                          @endif
                        </div>
                      </li>
                      <li>
                        <div class="l-12">
                          @if(!$is_virtual)
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">店舗区分</div>
                              <div class="p-list__data">{{ $shop->disp_shop_type ?? '---'}}</div>
                            </div>
                          </div>
                          @endif
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">利用者性別</div>
                              <div class="p-list__data">{{ $shop->disp_shop_type_gender ?? '---'}}</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="l-12">
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">店舗コード</div>
                              <div class="p-list__data">{{ $shop->shop_id ?? '---'}}</div>
                            </div>
                          </div>
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">店舗グループ</div>
                              <div class="p-list__data">{{ Arr::get($mShopGroups, $shop->shop_group_id ?? '---')  }}</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="l-12">
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">電話番号</div>
                              <div class="p-list__data">{{ $shop->tel ?? '---'}}</div>
                            </div>
                          </div>
                          <div class="l-12__6">
                            <div>
                              <div class="p-list__label">FAX番号</div>
                              <div class="p-list__data">{{ $shop->fax ?? '---'}}</div>
                            </div>
                          </div>
                        </div>
                      </li>
                      @if(false)
                        <li>
                          <div class="p-list__label">パスワード</div>
                          <div class="p-list__data"></div>
                        </li>
                      @endif
                      <li>
                        <div class="p-list__label">メールアドレス</div>
                        <div class="p-list__data">{{ $shop->mail ?? ''}}</div>
                      </li>
                      @if($shop->disp_address_main)
                        <li>
                          <div class="p-list__label">住所</div>
                          <div class="p-list__data">{{ $shop->zipcode ?? ''}}<br>{{ $shop->disp_address_main ?? ''}}<br>{{ $shop->disp_address_sub ?? ''}}
                            <iframe
                              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDLmchwoNhpKsLQGobcmVhrgw0atPmr9ms&zoom=14&q={{ $shop->disp_address_main ?? ''}}"
                              style="width: 100%; margin-top: 10px; border: none;"
                              loading="lazy"
                            ></iframe>
                          </div>
                        </li>
                      @endif
                      @if(!$is_virtual)
                      <li>
                        <div class="p-list__label">
                          周辺アクセス（半径500m）
                        </div>
                        <div class="p-list__data">
                          <div
                            id="map"
                            style="height: 200px;"
                          ></div>
                          <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLmchwoNhpKsLQGobcmVhrgw0atPmr9ms&libraries=visualization&callback=initMap">
                          </script>
                          <script>
                            $(function () {
                              /* Data points defined as an array of LatLng objects */
                              var heatmapData = [
                                @foreach($gpsLogs as $gpsLog)
                                  new google.maps.LatLng({{ data_get($gpsLog, 'lat') }}, {{ data_get($gpsLog, 'lng') }}),
                                @endforeach
                              ];
                              var center = {
                                lat: {{ data_get($shop, 'lat') }}, // 緯度
                                lng: {{ data_get($shop, 'lng') }} // 経度
                              };
                              map = new google.maps.Map(document.getElementById('map'), {
                                center: center,
                                zoom: 14,
                                mapTypeId: 'roadmap',
                                styles: [
                                  {
                                    "featureType": "all",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                      {
                                        "weight": "2.00"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "all",
                                    "elementType": "geometry.stroke",
                                    "stylers": [
                                      {
                                        "color": "#9c9c9c"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "all",
                                    "elementType": "labels.text",
                                    "stylers": [
                                      {
                                        "visibility": "on"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "landscape",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "color": "#f2f2f2"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "landscape",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                      {
                                        "color": "#ffffff"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "landscape.man_made",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                      {
                                        "color": "#ffffff"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "poi",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "visibility": "off"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "saturation": -100
                                      },
                                      {
                                        "lightness": 45
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                      {
                                        "color": "#eeeeee"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road",
                                    "elementType": "labels.text.fill",
                                    "stylers": [
                                      {
                                        "color": "#7b7b7b"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road",
                                    "elementType": "labels.text.stroke",
                                    "stylers": [
                                      {
                                        "color": "#ffffff"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road.highway",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "visibility": "simplified"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "road.arterial",
                                    "elementType": "labels.icon",
                                    "stylers": [
                                      {
                                        "visibility": "off"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "transit",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "visibility": "off"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "water",
                                    "elementType": "all",
                                    "stylers": [
                                      {
                                        "color": "#46bcec"
                                      },
                                      {
                                        "visibility": "on"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "water",
                                    "elementType": "geometry.fill",
                                    "stylers": [
                                      {
                                        "color": "#c8d7d4"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "water",
                                    "elementType": "labels.text.fill",
                                    "stylers": [
                                      {
                                        "color": "#070707"
                                      }
                                    ]
                                  },
                                  {
                                    "featureType": "water",
                                    "elementType": "labels.text.stroke",
                                    "stylers": [
                                      {
                                        "color": "#ffffff"
                                      }
                                    ]
                                  }
                                ],
                              });
                              // ヒートマップ
                              var heatmap = new google.maps.visualization.HeatmapLayer({
                                data: heatmapData
                              });
                              heatmap.setMap(map);
                              // マーカー
                              var marker = new google.maps.Marker({
                                map: map,
                                position: map.getCenter(),
                                draggable: true
                              });
                              marker.addListener( "dragend", function ( argument ) {
                                let lat = argument.latLng.lat();
                                let lng = argument.latLng.lng();
                                $("span.lat_input").text(lat);
                                $("span.lng_input").text(lng);
                                $(".latlng_href").attr("href", "{{ route("admin.shop.geolocation", $shop) }}?lat="+lat+"&lng="+lng);
                              });
                              var circle = new google.maps.Circle({
                                center: map.getCenter() ,
                                map: map ,
                                radius: 500,  // 半径（m）
                                fillColor: "#4AD1A2",     // 塗りつぶし色
                                fillOpacity: 0.5,    // 塗りつぶし透過度（0: 透明 ⇔ 1:不透明）
                                strokeColor: "#4AD1A2",    // 外周色
                                strokeOpacity: 1,  // 外周透過度（0: 透明 ⇔ 1:不透明）
                                strokeWeight: 1    // 外周太さ
                              });
                              circle.bindTo("center", marker, "position");
                            })
                          </script>
                        </div>
                      </li>
                      <li>
                        <div class="p-list__data">
                          <p class="c-text__note" style="font-size: 10px;">緯度：<span class="lat_input">{{ data_get($shop, 'lat') }}</span></p>
                          <p class="c-text__note" style="font-size: 10px;">経度：<span class="lng_input">{{ data_get($shop, 'lng') }}</span></p>
                          <a
                            class="c-button c-button--line c-button--small latlng_href"
                            style="margin-top: 5px;"
                            href="{{ route("admin.shop.geolocation", $shop) }}?lat={{ data_get($shop, 'lat') }}&lng={{ data_get($shop, 'lng') }}"
                          >
                            座標を登録
                          </a>
                        </div>
                      </li>
                      @endif
                    </ul>
                  @endslot
                @endcomponent
                {{-- 基本情報 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                    日付情報
                  @endslot
                  @slot('action')
                    <div class="p-buttonArea">
                      <a href="{{ $is_virtual ? route('admin.virtual_shop.edit', $shop) : route('admin.shop.edit', $shop) }}" class="c-button c-button--line c-button--small">
                        編集
                      </a>
                    </div>
                  @endslot
                  @slot('body')
                    @component('admin.element.project._p-list',
                      ['listData' =>
                        [
                          '作成日時'=> ($shop->created_at ?? '---').'<p class="c-text__note">'.$shop->creater ?? ''.'</p>',
                          '最終更新日時'=> ($shop->updated_at ?? '---').'<p class="c-text__note">'.$shop->updater ?? ''.'</p>',
                          'プレオープン日'=> $shop->pre_open_date ?? '---',
                          'グランドオープン日'=> $shop->grand_open_date ?? '---',
                          '閉店日'=> $shop->close_date ?? '---',
                        ]
                      ]
                    )
                      @slot('class')
                        p-list--split2
                      @endslot
                    @endcomponent
                  @endslot
                @endcomponent
                @if(!$is_virtual)
                  {{-- 商品在庫 --}}
                  @component('admin.element.project._p-boxDetail')
                    @slot('title')
                      商品在庫
                    @endslot
                    @slot('active')
                      <div class="p-buttonArea">
                        <a href="" class="c-button c-button--line c-button--small">編集</a>
                      </div>
                    @endslot
                    @slot('bodyClass')
                      p-boxDetail__body--paddingOff
                    @endslot
                    @slot('body')
                      <table class="p-table p-table--block">
                        <thead class="p-table__head">
                          <tr class="p-table__head__tableRow">
                            <th class="p-table__tableHead">
                              <div class="p-table__item">商品名</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--count">
                              <div class="p-table__item">在庫数</div>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="p-table__data ">
                          <?php for($i=0;$i<10;$i++) { ?>
                          <tr class="p-table__data__tableRow" data-href="">
                            <td class="p-table__tableData">
                              <div class="p-table__item">ボディクリーム</div>
                            </td>
                            <td class="p-table__tableData p-table__tableHead--count">
                              <div class="p-table__item">62</div>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    @endslot
                  @endcomponent
                @endif
              </div>
              <div class="l-12__auto">
                <div class="l-12 l-12--start l-12--gap8">
                  @if(!$is_virtual)
                    {{-- 従業員 --}}
                    <div class="l-12__12">
                      @component('admin.element.project._p-boxDetail')
                        @slot('title')
                          従業員
                        @endslot
                        @slot('action')
                          @if(false)
                          <div class="p-buttonArea">
                            <a href="" class="c-button c-button--line c-button--small">編集</a>
                          </div>
                          @endif
                        @endslot
                        @slot('bodyClass')
                          p-boxDetail__body--paddingOff
                        @endslot
                        @slot('body')
                          <table class="p-table">
                            <thead class="p-table__head">
                              <tr class="p-table__head__tableRow">
                                <th class="p-table__tableHead p-table__tableHead--user">
                                  <div class="p-table__item">氏名</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--type">
                                  <div class="p-table__item">区分</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--typeWide">
                                  <div class="p-table__item">性別/年齢</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--telephone">
                                  <div class="p-table__item">電話番号</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--date">
                                  <div class="p-table__item">入社日</div>
                                </th>
                                @if(false)
                                  <th class="p-table__tableHead">
                                    <div class="p-table__item">顧客紹介数</div>
                                  </th>
                                @endif
                                </tr>
                              </thead>
                              <tbody class="p-table__data">
                              @forelse($shopStaffs as $staff)
                                <tr class="p-table__data__tableRow" data-href="{{ route('admin.staff.show', $staff) }}" data-target="_blank">
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">
                                      <!-- ユーザー情報 -->
                                      <div class="p-table__item__user">
                                        <div class="c-image c-image--round" style="background: url({{ Arr::get($staff, 'avator') }});"></div>
                                        <div class="p-table__item__user__text">
                                          <div class="id c-text__note">{{ $staff->staff_code ?? '' }}</div>
                                          <p class="name">{{ $staff->full_name ?? '' }}</p>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">{{ $staff->employment_status_label ?? '' }}</div>
                                  </td>
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">
                                      {{ $staff->gender_label ?? '' }}
                                      <p class="c-text__note">（{{ $staff->age ?? '' }}）</p>
                                    </div>
                                  </td>
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">{{ $staff->tel ?? '' }}</div>
                                  </td>
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">{{ $staff->join_date ?? '' }}</div>
                                  </td>
                                  @if(false)
                                  <td class="p-table__tableData">
                                    <div class="p-table__item">12人</div>
                                  </td>
                                  @endif
                                </tr>
                              @empty
                                @include('admin.element._table_no_element', ['colspan' => '8', 'message' => '登録されている従業員がありません'])
                              @endforelse
                            </tbody>
                          </table>
                        @endslot
                      @endcomponent
                    </div>
                  @else
                    {{-- バーチャル --}}
                    <div class="l-12__12">
                      @component('admin.element.project._p-boxDetail')
                        @slot('title')
                          購入者
                        @endslot
                        @slot('bodyClass')
                          p-boxDetail__body--paddingOff
                        @endslot
                        @slot('bodyStyle')
                          overflow: auto
                        @endslot
                        @slot('body')
                          <table class="p-table p-table--fixed" style="width: 1000px;">
                            <thead class="p-table__head">
                              <tr class="p-table__head__tableRow">
                                <th class="p-table__tableHead p-table__tableHead--status">
                                  <div class="p-table__item">ステータス</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--idWide">
                                  <div class="p-table__item">
                                    注文番号
                                  </div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--dateTimeNarrow">
                                  <div class="p-table__item">
                                    注文日時
                                  </div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--priceNarrow">
                                  <div class="p-table__item">合計金額（税込）</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--creditCard">
                                  <div class="p-table__item">支払い方法</div>
                                </th>
                                <th class="p-table__tableHead p-table__tableHead--userNarrow">
                                  <div class="p-table__item">購入者</div>
                                </th>
                                <th class="p-table__tableHead">
                                  <div class="p-table__item">内容</div>
                                </th>
                                <th class="p-table__tableHead">
                                  <div class="p-table__item">バーチャル店舗</div>
                                </th>
                              </tr>
                            </thead>
                            <tbody class="p-table__data">
                              @forelse($shop->virtural_shop_ec_carts()->ordered()->get() as $virtural_shop_ec_cart)
                                @if($virtural_shop_ec_cart->ec_order)
                                  @include('admin.ec.order._order', ['ec_order' => $virtural_shop_ec_cart->ec_order,])
                                @endif
                              @endforeach
                            </tbody>
                          </table>
                        @endslot
                      @endcomponent
                    </div>
                    <!-- 右側概要エリア -->
                    @forelse($shop->virtural_shop_ec_carts()->ordered()->get() as $virtural_shop_ec_cart)
                      @if($virtural_shop_ec_cart->ec_order)
                        @include('admin.ec.order._overview', [
                          'ec_order' => $virtural_shop_ec_cart->ec_order,
                        ])
                      @endif
                    @endforeach
                  @endif
                  @if(!$is_virtual)
                    <div class="l-12__12">
                      <div class="l-12 l-12--gap8 l-12--nowrap">
                    <div class="l-12__auto">
                    {{-- 部屋情報 --}}
                    @component('admin.element.project._p-boxDetail')
                      @slot('title')
                      部屋情報
                      @endslot
                      @slot('action')
                        <a href="" class="c-button c-button--line c-button--small">編集</a>
                      @endslot
                      @slot('bodyClass')
                        p-boxDetail__body--paddingOff
                      @endslot
                      @slot('body')
                        <table class="p-table p-table--block">
                          <thead class="p-table__head">
                            <tr class="p-table__head__tableRow">
                              <th class="p-table__tableHead p-table__tableHead--type">
                                <div class="p-table__item">部屋名</div>
                              </th>
                              <th class="p-table__tableHead">
                                <div class="p-table__item">タイプ</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--type">
                                <div class="p-table__item">マシン台数</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--statusNarrow">
                                <div class="p-table__item">利用者</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--statusNarrow">
                                <div class="p-table__item">ステータス</div>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="p-table__data p-table__data--scroll400">
                            <?php for($i=0;$i<40;$i++) { ?>
                            <tr class="p-table__data__tableRow" data-href="">
                              <td class="p-table__tableData p-table__tableHead--type">
                                <div class="p-table__item"><?= $i + 1; ?></div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">[個室,ペアルーム,ジムスペース,フェイシャル]</div>
                              </td>
                              <td class="p-table__tableData p-table__tableHead--type">
                                <div class="p-table__item">2台</div>
                              </td>
                              <td class="p-table__tableData p-table__tableHead--statusNarrow">
                                <div class="p-table__item">
                                  <p class="c-labelStatus c-labelStatus--correct">レディース</p>
                                </div>
                              </td>
                              <td class="p-table__tableData p-table__tableHead--statusNarrow">
                                <div class="p-table__item">
                                  <p class="c-status c-status--correct">有効</p>
                                </div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      @endslot
                    @endcomponent
                  </div>
                  @endif
                  @if(!$is_virtual)
                  <div class="l-12__fix280">
                    {{-- マシン情報 --}}
                    @component('admin.element.project._p-boxDetail')
                      @slot('title')
                        マシン情報
                      @endslot
                      @slot('active')
                        <div class="p-buttonArea">
                          <a href="" class="c-button c-button--line c-button--small">編集</a>
                        </div>
                      @endslot
                      @slot('bodyClass')
                        p-boxDetail__body--paddingOff
                      @endslot
                      @slot('body')
                        <table class="p-table p-table--block">
                          <thead class="p-table__head">
                            <tr class="p-table__head__tableRow">
                              <th class="p-table__tableHead p-table__tableHead--user">
                                <div class="p-table__item">マシン名</div>
                              </th>
                              <th class="p-table__tableHead">
                                <div class="p-table__item">部屋</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--statusNarrow">
                                <div class="p-table__item">ステータス</div>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="p-table__data p-table__data--scroll400">
                            <tr class="p-table__data__tableRow" data-href="">
                              <td class="p-table__tableData p-table__tableHead--user">
                                <div class="p-table__item">
                                  <div class="p-table__item__user">
                                    <div class="c-image" style="background: url({{asset('img/common/machine/cellzeropro--square.jpg')}});"></div>
                                    <div class="p-table__item__user__text">
                                      <div class="id c-text__note">92386592</div>
                                      <p class="name">CELL ZERO.pro</p>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">在庫</div>
                              </td>
                              <td class="p-table__tableData p-table__tableHead--statusNarrow">
                                <div class="p-table__item">
                                  <p class="c-status c-status--alert">故障</p>
                                </div>
                              </td>
                            </tr>
                            <?php for($i=0;$i<50;$i++) { ?>
                            <tr class="p-table__data__tableRow" data-href="">
                              <td class="p-table__tableData p-table__tableHead--user">
                                <div class="p-table__item">
                                  <div class="p-table__item__user">
                                    <div class="c-image" style="background: url({{asset('img/common/machine/cellzeropro--square.jpg')}});"></div>
                                    <div class="p-table__item__user__text">
                                      <div class="id c-text__note">92386592</div>
                                      <p class="name">CELL ZERO.pro</p>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">12</div>
                              </td>
                              <td class="p-table__tableData p-table__tableHead--statusNarrow">
                                <div class="p-table__item">
                                  <p class="c-status c-status--correct">正常</p>
                                </div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      @endslot
                    @endcomponent
                  </div>
                  @endif
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script type="text/javascript">
    $(document).ready(function(){
      $('tr.p-table__data__tableRow').on('click', function(){
        var target = $(this).data('target');
        $('.js-target__overview').removeClass('is-active__overview--show');
        $('#' + target).addClass('is-active__overview--show');
      });
    });
  </script>
  @include('admin.machine._p-modal__edit__ecStock')
  @include('admin.ec._p-modal__edit__item')

@endsection
