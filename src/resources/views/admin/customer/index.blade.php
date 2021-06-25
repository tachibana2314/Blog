@extends('admin.layout.layout--base')
@section('title', $title ?? '')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page">
    @component('admin.layout.p-page')
      @slot('headTitle')
        顧客管理
      @endslot
      @slot('headAction')
        <div class="p-page__head__action">
          <a href="{{route('admin.news.create')}}" class="c-button c-button--main">
            顧客を追加する
          </a>
        </div>
      @endslot
      @slot('body')
        <section class="p-box">
          <div class="p-box__filter">
            @include('admin.customer._filter')
          </div>
          <div class="p-box__body">
            <div class="p-tableSet">
              <div class="p-tableSet__head">
                <div class="p-tableSet__place">
                  <p class="p-tableSet__place__count">
                    全 100 件目
                  </p>
                </div>
              </div>
              <div class="p-tableSet__body">
                <div class="p-scroll">
                  <div class="p-scroll__inner">
                    <table class="p-table">
                      <thead class="p-table__head">
                        <tr class="p-table__head__tableRow">
                          <th class="p-table__tableHead p-table__tableHead--idWide">
                            <div class="p-table__item">会員番号</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--user">
                            <div class="p-table__item">氏名</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">性別</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">
                              <p class="c-text__note">所属店舗</p>
                            </div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">年齢</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">会員状況</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item p-table__item--column">区分<span class="c-text__note">（利用プラン）</span></div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--date">
                            <div class="p-table__item">入会申込日</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--date">
                            <div class="p-table__item">最終利用日</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--date">
                            <div class="p-table__item">登録日</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--date">
                            <div class="p-table__item">変更日</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="p-table__data">
                        <?php for($i=0;$i<10;$i++) { ?>
                        <tr data-href="{{route('admin.customer.show')}}" class="p-table__data__tableRow js-trigger__overview--open">
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              010010000042
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              <div class="p-user">
                                <div class="p-user__image">
                                  <div class="c-image c-image--round" style="background: url({{asset('img/sample/user--01.jpg')}})"></div>
                                </div>
                                <div class="p-user__text">
                                  三浦 直子
                                  <span class="c-text__note">ミウラ ナオコ</span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              女性
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              新宿マルイアネックス
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              28
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              会員
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item p-table__item--row">
                              <p class="c-plan c-plan--green"></p><span class="c-text__note">
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              2021/05/06
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              2021/05/06
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              2021/05/06
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              2021/05/06
                            </div>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      @endslot
    @endcomponent
  </div>
@endsection