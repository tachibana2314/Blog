<!--
管理項目[control-item]英語表記
　ダッシュボード 　→ dashboard
　顧客管理　　　　 → customer
　店舗/従業員管理　→ shop
  マシン/商品管理　→ machine
  物流管理　　　　 → logistics
  コンテンツ管理　 → contents
  勤怠/経費管理 　 → attendance
  実績管理 　 　　 → performance
  売上/入金管理　　→ sales
  お問い合わせ管理 → contact
  アプリ管理　　　 → application
 -->
<?php
  $controlItemSidebar = [
    'dashboard'=> [
      'label' => 'ダッシュボード',
      'path' => 'admin.home',
      'phase' => '1',
      'link' => 'link',
    ],
    'customer'=> [
      'label' => 'プロフィール編集',
      'path' => 'admin.home',
      'phase' => '1',
      'link' => 'not_link',
      'megaMenu' => [
        'linkList' => [
          [
            'label' => 'プロフィール編集',
            'path' => 'admin.home',
            'phase' => '1',
          ],
        ],
      ]
    ],
    'contents'=> [
      'label' => 'コンテンツ管理',
      'path' => 'admin.content.index',
      'phase' => '1',
      'link' => 'not_link',
      'megaMenu' => [
        'linkList' => [
          [
            'label' => 'コンテンツ管理',
            'path' => 'admin.content.index',
            'phase' => '1',
          ],
          [
            'label' => '動画管理',
            'path' => 'admin.content.index',
            'phase' => '1',
          ],
        ],
      ]
    ],
    'sales'=> [
      'label' => '売上/入金管理',
      'path' => 'admin.home',
      'phase' => '1',
      'link' => 'not_link',
      'megaMenu' => [
        'linkList' => [
          [
            'label' => '売上',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => 'クレジットカード請求明細',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => '口座振替請求明細',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => 'コンビニ請求明細',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => '口座情報',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => '未入金リスト',
            'path' => 'admin.home',
            'phase' => '1',
          ],
          [
            'label' => '過入金リスト',
            'path' => 'admin.home',
            'phase' => '1',
          ],
        ],
      ]
    ],
    'shop'=> [
      'label' => 'オフィス管理',
      'path' => 'admin.shop.index',
      'phase' => '1',
      'link' => 'not_link',
      'megaMenu' => [
        'linkList' => [
          [
            'label' => '店舗一覧',
            'path' => 'admin.shop.index',
            'phase' => '1',
          ],
        ],
        'actionList' => [
          [
            'label' => '店舗追加',
            'path' => 'admin.shop.create',
            'phase' => '1',
          ],
        ]
      ]
    ],
    'contact'=> [
      'label' => 'お問い合わせ管理',
      'path' => 'admin.contact.index',
      'phase' => '1',
      'link' => 'link',
    ],
    'setting'=> [
      'label' => '設定',
      'path' => 'admin.home',
      'phase' => '1',
      'link' => 'link',
    ]
  ];
?>
<aside class="l-sidebar">
  <div class="p-sidebar">
    <nav class="p-sidebar__nav">
      <ul class="p-sidebar__nav__list">
        <?php
          foreach($controlItemSidebar as $key => $val){
        ?>

        <li class="p-sidebar__item <?= 'phase--'.$val['phase']; ?> <?= $key === 'setting'? 'divider': '' ?>">
          <li class="p-sidebar__item {{'phase--'.$val['phase']}} {{ $key === 'setting'? 'divider': '' }}">

          @if($val['path'] == "admin.contact.index")
            {{-- @if($contact_cnt != 0)
            <span class ='p-sidebar__item__notification'>{{$contact_cnt}}</span>
            @endif --}}
          @endif
          <a <?php if($val['link'] == 'link'){ ?> href="{{route($val['path'])}}"<?php } ?> class="
            p-sidebar__item__button
            <!-- 下層ページでも判定される形式に変更 -->
            {{in_array(explode('.', Route::currentRouteName())[1], [explode('.', $val['path'])[1]], TRUE) ? 'is-current' : '' }}
          ">
            <div class="c-image c-image--<?= $key; ?>"></div>
            <?= $val['label']; ?>
          </a>
          <!-- メガメニュー -->
          <?php if(isset($val['megaMenu'])) { ?>
          <div class="p-sidebar__megaMenu">
            <div class="p-sidebar__megaMenu__item">
              <div class="p-sidebar__megaMenu__item__title">
                <?= $val['label']; ?>
              </div>
              <!-- アクションボタンリスト -->
              <ul class="p-sidebar__megaMenu__item__linkList">
                <?php
                  foreach($val['megaMenu']['linkList'] as $itemListVal){
                ?>

                    @if( $itemListVal['path'] == 'admin.virtual_shop.index')
                      <li class="<?= 'phase--3'; ?>"><a href="{{route($itemListVal['path'])}}"><?= $itemListVal['label']; ?></a></li>
                    @else
                      <li class="<?= 'phase--'.$itemListVal['phase']; ?>"><a href="{{route($itemListVal['path'])}}"><?= $itemListVal['label']; ?></a></li>
                    @endif

                <?php } ?>
              </ul>
            </div>
            <!-- アクションボタンリスト -->
            <?php if(isset($val['megaMenu']['actionList'])) { ?>
            <div class="p-sidebar__megaMenu__item">
              <div class="p-sidebar__megaMenu__item__title">
                追加処理
              </div>
              <ul class="p-sidebar__megaMenu__item__actionList">
                <?php
                  foreach($val['megaMenu']['actionList'] as $actionListVal){
                ?>
                @if( $actionListVal['path'] == 'admin.virtual_shop.create' || $actionListVal['path'] == 'admin.shop.create' || $actionListVal['path'] == 'admin.staff.create')
                  <li class="<?= 'phase--3'; ?>">
                    <a href="{{route($actionListVal['path'])}}" class="c-button c-button--accent c-button--small c-button--full"><?= $actionListVal['label']; ?></a>
                  </li>
                @else
                  <li class="<?= 'phase--'.$actionListVal['phase']; ?>">
                    <a href="{{route($actionListVal['path'])}}" class="c-button c-button--accent c-button--small c-button--full"><?= $actionListVal['label']; ?></a>
                  </li>
                @endif

                <?php } ?>
              </ul>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
        </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>

