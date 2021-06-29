@extends('admin.layout.layout--base')
@section('title', $title ?? '店舗管理')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page l-page--full">
    <div class="p-page">
      <div class="p-page__head">
        <div class="l-container">
          <h1 class="c-heading--lv1">
            @if(!$is_virtual)
              店舗管理
            @else
              バーチャル店舗
            @endif
          </h1>
          <div class="p-page__head__action">
            @if(!$is_virtual)
              @if(Auth::user()->authority < \App\Models\Staff::AUTHORITY_3)
              <a href="{{route('admin.shop.create')}}" class="c-button c-button--accent c-button--small">
                店舗を新規作成
              </a>
              @endif
            @else
              <a href="{{route('admin.virtual_shop.create')}}" class="c-button c-button--accent c-button--small">
                バーチャル店舗を新規作成
              </a>
            @endif
          </div>
        </div>
      </div>
      <div class="p-page__body">
        <div class="l-container--full">
          <section class="p-box">
            <div class="p-box__filter">
              @include('admin.shop._filter', ['request' => $request, 'mShopGroups' => $mShopGroups, 'is_virtual' => $is_virtual,])
            </div>
            <div class="p-box__body">
              <div class="p-tableSet">
                <div class="p-tableSet__head">
                  <div class="p-tableSet__place">
                    <p class="p-tableSet__place__count">
                      全 {{ number_format($shops->total()) }} 件中 {{ number_format($shops->firstItem()) }}～{{ number_format($shops->lastItem()) }} 件目
                    </p>
                  </div>
                </div>
                <div class="p-tableSet__body">
                  {{--スクロール--}}
                  <div class="p-scroll">
                    {{--テーブル--}}
                    <table class="p-table">
                      <thead class="p-table__head">
                        <tr class="p-table__head__tableRow">
                          <th class="p-table__tableHead" width="136">
                            <div class="p-table__item">写真</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">
                              店舗名
                              @if(!$is_virtual)
                              <span class="c-text__note">
                              （略称）
                              </span>
                              @endif
                            </div>
                          </th>
                          @if(!$is_virtual)
                          <th class="p-table__tableHead">
                            <div class="p-table__item">店舗区分</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">店舗グループ</div>
                          </th>
                          @endif
                          <th class="p-table__tableHead">
                            <div class="p-table__item">住所</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">電話番号</div>
                          </th>
                          @if(!$is_virtual)
                          <th class="p-table__tableHead">
                            <div class="p-table__item">web公開</div>
                          </th>
                          @else
                          <th class="p-table__tableHead">
                            <div class="p-table__item">メールアドレス</div>
                          </th>
                          @endif
                          <th class="p-table__tableHead">
                            <div class="p-table__item">有効</div>
                          </th>
                          @if($is_virtual)
                          <th class="p-table__tableHead">
                            <div class="p-table__item">URL</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">申込数</div>
                          </th>
                          @endif
                          @if(false)
                          <th class="p-table__tableHead">
                            <div class="p-table__item">顧客数<span class="c-text__note">（レンタル）</span></div>
                          </th>
                          @endif
                          <th class="p-table__tableHead">
                            <div class="p-table__item">顧客数<span class="c-text__note">（販売）</span></div>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="p-table__data">
                        @foreach($shops as $shop)
                        @if(!$is_virtual)
                          <tr class="p-table__data__tableRow" data-href="{{route('admin.shop.show', $shop)}}">
                        @else
                          <tr class="p-table__data__tableRow" data-href="{{route('admin.virtual_shop.show', $shop)}}">
                        @endif
                            <td class="p-table__tableData">
                              <div class="p-table__item">
                                <div class="p-table__item__photo">
                                  <div class="c-image c-image--wide" style="background: url({{ isset($shop->thumbnail) ? $shop->thumbnail : 'img/common/noImage/admin--square.svg' }})"></div>
                                </div>
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                <span class="c-text__note">{{ $shop->shop_id ?? '' }}</span>
                                {{ $shop->name ?? '' }}
                                @if(!$is_virtual)
                                <span class="c-text__note">{{ $shop->disp_name_abbreviation ?? '' }}</span>
                                @endif
                              </div>
                            </td>
                            @if(!$is_virtual)
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->disp_shop_type ?? '' }}</div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ Arr::get($mShopGroups, $shop->shop_group_id ?? '') }}</div>
                            </td>
                            @endif
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                <span class="c-text__note">{{ $shop->zipcode ?? '' }}</span>
                                <p>{{ $shop->disp_address_main ?? '' }}<br>{{ $shop->disp_address_sub ?? '' }}</p>
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->tel ?? '' }}</div>
                            </td>
                            @if(!$is_virtual)
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->disp_web_release ?? '' }}</div>
                            </td>
                            @else
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->mail ?? '' }}</div>
                            </td>
                            @endif
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->disp_effectiveness ?? '' }}</div>
                            </td>
                            @if($is_virtual)
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->application_url ?? '' }}</div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item">{{ $shop->virtural_shop_users_count ?? '' }}</div>
                            </td>
                            @endif
                            @if(false)
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                <p>12,312名</p>
                                <span class="c-text__note">（299名）</span>
                              </div>
                            </td>
                            @endif
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                               <p>{{ $shop->virtural_shop_ec_carts()->ordered()->get()->count() }}</p>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
                <div class="p-tableSet__foot">
                  @include('admin.shop._paginate', ['request' => $request, 'shops' => $shops])
                </div>
              </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
