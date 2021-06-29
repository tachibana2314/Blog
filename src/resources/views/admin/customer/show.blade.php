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
          <div class="l-12 l-12--gap8">
            <div class="l-12__4">
              {{-- 基本情報 --}}
              @component('admin.element.project._p-boxDetail')
                @slot('title')
                  基本情報
                @endslot
                @slot('body')
                  <ul class="p-list p-list--row">
                    <?php
                      $customerBasicData = [
                        '氏名' => '三浦 直子<br><span class="c-text__note">ミウラ ナオコ</span>',
                        '性別' => '女性',
                        '所属店舗' => '<a href="" class="c-link c-link--external">新宿マルイアネックス</a>',
                        '生年月日' => '1988/05/07<br><span class="c-text__note">(32歳)</span>',
                        'メールアドレス' => 'sample@example.com',
                        '住所' => '<span class="c-text__note">160-0022</span><p>東京都新宿区新宿1-34-5<br>Verde Vista 新宿御苑 5F</p>',                          
                        '電話番号' => '09012345678',
                        '配送先住所' => '<span class="c-text__note">160-0022</span><p>東京都新宿区新宿1-34-5<br>Verde Vista 新宿御苑 5F</p>',                          
                        '配送先<br>電話番号' => '09012345678',
                      ];
                    ?>
                    <?php foreach($customerBasicData as $key=>$val){ ?>
                      <li>
                        <div class="p-list__label">
                          <?= $key; ?>
                        </div>
                        <div class="p-list__data">
                          <?= $val; ?>
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
                @endslot
              @endcomponent     
              {{-- 緊急連絡先 --}}         
              @component('admin.element.project._p-boxDetail')
                @slot('title')
                  緊急連絡先
                @endslot
                @slot('body')
                  <ul class="p-list p-list--row">
                    <?php
                      $customerBasicData = [
                        '氏名' => '三浦 直哉<br><span class="c-text__note">ミウラ ナオヤ</span>',
                        '続柄' => '父親',
                        '電話番号' => '09012345678',
                      ];
                    ?>
                    <?php foreach($customerBasicData as $key=>$val){ ?>
                      <li>
                        <div class="p-list__label">
                          <?= $key; ?>
                        </div>
                        <div class="p-list__data">
                          <?= $val; ?>
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
                @endslot
              @endcomponent
              {{-- 各種日付 --}}         
              @component('admin.element.project._p-boxDetail')
                @slot('title')
                  各種日付
                @endslot
                @slot('body')
                  <ul class="p-list p-list--row">
                    <?php
                      $customerDateData = [
                        '入会申込日' => '2021/02/02',
                        '登録日' => '2021/02/04',
                        '変更日' => '2021/02/08',
                        '退会申込日' => '---',
                        '退会予定日' => '---',
                        '退会処理日' => '---',
                        '最終利用日' => '2021/05/10',
                      ];
                    ?>
                    <?php foreach($customerDateData as $key=>$val){ ?>
                      <li>
                        <div class="p-list__label">
                          <?= $key; ?>
                        </div>
                        <div class="p-list__data">
                          <?= $val; ?>
                        </div>
                      </li>
                    <?php } ?>
                  </ul>
                @endslot
              @endcomponent
            </div>
            <div class="l-12__8">
              <div class="l-12 l-12--gap8">
                <div class="l-12__6">
                  @component('admin.element.project._p-boxDetail')
                    @slot('title')
                      利用履歴
                    @endslot
                    @slot('action')
                      <div class="p-buttonWrap">
                        <a href="{{route('admin.customer.history')}}" class="c-button c-button--icon c-button--next"></a>
                      </div>
                    @endslot
                    @slot('body')
                      <div class="p-summary">
                        <ul class="p-summary__list">
                          <?php
                            $historyData = [
                              '2020.12'=>'2',
                              '2021.01'=>'4',
                              '2021.02'=>'4',
                              '2021.03'=>'8',
                              '2021.03'=>'4',
                            ];
                            foreach($historyData as $key=>$val){
                          ?>
                          <li> 
                            <div class="p-summary__list__label"><?= $key; ?></div>
                            <div class="p-summary__list__data">
                              <div class="p-text">
                                <p><?= number_format($val);?></p>
                                <span class="p-summary__list__data__unit">回</span>
                              </div>
                            </div>
                          </li>
                          <?php } ?>
                          <li class="p-summary__list__divider"> 
                            <div class="p-summary__list__label">合計利用回数</div>
                            <div class="p-summary__list__data">
                              <div class="p-text">
                                <p class="p-summary__list__data__total"><?= number_format(22);?></p>
                                <span class="p-summary__list__data__unit">回</span>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    @endslot
                  @endcomponent
                </div>
                <div class="l-12__6">
                  @component('admin.element.project._p-boxDetail')
                    @slot('title')
                      利用金額
                    @endslot
                    @slot('body')
                      <div class="p-summary">
                        <ul class="p-summary__list">
                          <li> 
                            <div class="p-summary__list__label">入会金</div> 
                            <div class="p-summary__list__data">
                              <div class="p-text">
                                <p><?= '¥'.number_format(0);?></p>
                              </div>
                            </div>
                          </li>
                          <li> 
                            <div class="p-summary__list__label">会費</div>
                            <div class="p-summary__list__data">
                              <div class="p-text">
                                <p><?= '¥'.number_format(0);?></p>
                              </div>
                            </div>
                          </li>
                          <li class="p-summary__list__divider">
                            <div class="p-summary__list__label">合計利用金額</div>
                            <div class="p-summary__list__data">
                              <p class="p-summary__list__data__total"><?= '¥'.number_format(14953);?></p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    @endslot
                  @endcomponent
                  
                </div>
                <div class="l-12__12">
                  {{-- 支払い情報 --}}
                  @component('admin.element.project._p-boxDetail')
                    @slot('title')
                      支払い情報
                    @endslot
                    @slot('body')
                      <div class="l-12 l-12--gap16">
                        <div class="l-12__6">
                          <?php
                            $customerPaymentData = [
                              [
                                'label' => '支払方法',
                                'data' => 'クレジットカード<br><span class="c-text__note">先払い</span>',
                                'link' => 'data-href="'.route('admin.customer.history').'"',
                              ],
                              [
                                'label' => '会員区分',
                                'data' => '<p class="c-plan c-plan--green"></p><span class="c-text__note">（¥9,800＋税）</span>',
                                'link' => 'data-remodal-target="js-modal__edit__plan"',
                              ],
                              [
                                'label' => '決済顧客番号',
                                'data' => '990000013513',
                              ],
                              [
                                'label' => '分割払い月数',
                                'data' => '---',
                              ],
                            ];
                          ?>
                          <ul class="p-list p-list--row">
                            <?php foreach($customerPaymentData as $key=>$val){ ?>
                              <li <?= isset($val['link']) ? $val['link']: '' ?>>
                                <div class="p-list__label">
                                  <?= $val['label']; ?>
                                </div>
                                <div class="p-list__data">
                                  <?= $val['data']; ?>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                        <div class="l-12__6">
                          <?php
                            $customerDiscountData = [
                              '割引率' => '---',
                              '割引後会費' => '---',
                              '割引適用期間' => '---',
                              '割引理由' => '---',
                            ];
                          ?>
                          <ul class="p-list p-list--row">
                            <?php foreach($customerDiscountData as $key=>$val){ ?>
                              <li>
                                <div class="p-list__label">
                                  <?= $key; ?>
                                </div>
                                <div class="p-list__data">
                                  <?= $val; ?>
                                </div>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    @endslot
                    @slot('body2Class')
                      p-boxDetail__body--paddingOff
                    @endslot
                    @slot('body2')
                      <table class="p-table">
                          <thead class="p-table__head">
                            <tr class="p-table__head__tableRow">
                              <th class="p-table__tableHead p-table__tableHead--date">
                                <div class="p-table__item">利用日</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--date">
                                <div class="p-table__item">請求日</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--date">
                                <div class="p-table__item">入金日</div>
                              </th>
                              <th class="p-table__tableHead">
                                <div class="p-table__item">入金方法</div>
                              </th>
                              <th class="p-table__tableHead p-table__tableHead--price">
                                <div class="p-table__item">入金額</div>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="p-table__data">
                            <?php for($i=0;$i<10;$i++) { ?>
                            <tr class="p-table__data__tableRow">
                              <td class="p-table__tableData">
                                <div class="p-table__item">
                                  2021/05/07
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">
                                  2021/05/07
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">
                                  2021/05/07
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item">
                                  クレジットカード
                                </div>
                              </td>
                              <td class="p-table__tableData">
                                <div class="p-table__item p-table__item--price">¥<?= number_format(6578);?></div>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <?php for($i=0;$i<4;$i++) { ?>
                              <td class="p-table__tableData"></td>
                              <?php } ?>
                              <td class="p-table__tableData">
                                <div class="p-table__item p-table__item--price">¥<?= number_format(65780);?></div>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                    @endslot
                  @endcomponent
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('admin.customer._p-modal__edit__plan')
@endsection
