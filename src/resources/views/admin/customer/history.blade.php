@extends('admin.layout.layout--detail')
@section('title', $title ?? '顧客詳細')
@section('pageClass', 'page_mypage')
@section('content')
  @include('admin.customer._sidebar', [])
  <main class="l-main l-main--detail">
    <div class="l-page l-page--detail"> 
      <div class="p-page">
        <div class="p-page__head p-page__head--detail">
          <div class="l-container">
            <h1 class="c-heading--lv2">顧客詳細</h1>
            <div class="p-page__head__tab p-page__head__tab--left">
              @include('admin.customer._p-page__head__tab__list')
            </div>
          </div>
        </div>
        <div class="p-page__body">
          <div class="l-container">
            {{-- 利用履歴 --}}
            @component('admin.element.project._p-boxDetail')
              @slot('title')
                利用履歴
              @endslot
              @slot('bodyClass')
                p-boxDetail__body--paddingOff
              @endslot
              @slot('body')
                <div class="l-12">
                  <div class="l-12__12">
                    <table class="p-table">
                      <thead class="p-table__head">
                        <tr class="p-table__head__tableRow">
                          <th class="p-table__tableHead p-table__tableHead--dateTime">
                            <div class="p-table__item">受付日時</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">利用店舗</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">区分</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--time">
                            <div class="p-table__item">開始時刻</div>
                          </th>
                          <th class="p-table__tableHead p-table__tableHead--time">
                            <div class="p-table__item">終了時刻</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">メモ</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="p-table__data">
                        <?php for($i=0;$i<10;$i++) { ?>
                        <tr class="p-table__data__tableRow">
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              2021/05/10　16:33
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              新宿マルイアネックス
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              Gr<span class="c-text__note">グリーン</span>
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              16:40
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              17:20
                            </div>
                          </td>
                          <td class="p-table__tableData">
                            <div class="p-table__item">
                              <?php if($i === 5){?>
                              先入会：渡辺　クレカ：渡辺
                              <?php }else{} ?>
                            </div>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              @endslot
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
