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
            {{-- その他 --}}
            @component('admin.element.project._p-boxDetail')
              @slot('body')
                <div class="l-12">
                  <div class="l-12__4">
                    <?php
                      $customerOtherData = [
                        '登録日時・登録者' => '2020/12/19 18:05<br>Web',
                        '変更日時・変更者' => '2020/12/27 19:04<br>新宿店',
                        '体験申込日' => '2020/12/19',
                        '入会申込日・担当者' => '2020/12/19',
                        'CP縛り期間終了日' => '2020/12/19',
                      ];
                      $customerOtherData2 = [
                        'カード発行有無' => '有',
                        '利用開始日' => '2020/12/19',
                        '最終利用日' => '2020/12/19',
                      ];
                    ?>
                    <ul class="p-list">
                      <?php foreach($customerOtherData as $key=>$val){ ?>
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
                  <div class="l-12__4">
                    <ul class="p-list">
                      <?php foreach($customerOtherData2 as $key=>$val){ ?>
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
                  <div class="l-12__4">
                    <ul class="p-list p-list--row">
                      <?php
                        $customerOtherData3 = [
                          '休会申込日<br>/担当者' => '2020/12/19<br><p>斉藤 美和</p>',
                          '休会開始日' => '2020/12/24',
                          '復会日' => '---',
                          '退会申込日<br>/担当者' => '---',
                          '退会予定日' => '---',
                          '退会処理日<br>/担当者' => '---',
                        ];
                        foreach($customerOtherData3 as $key=>$val){ ?>
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
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
