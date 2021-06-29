<aside class="l-sidebar l-sidebar--detail">
  <div class="p-sidebarDetail">
    <div class="p-sidebarDetail__back">
      <a class="p-button p-button--prev" href="">
        <span class="c-image"></span>
        <span class="c-button">顧客管理</span>
      </a>
    </div>
    <div class="p-sidebarDetail__main">
      <div class="p-sidebarDetail__main__user">
        <div
          class="c-image c-image--round"
          style="background: url({{asset('img/sample/user--01.jpg')}});"
        ></div>
        <p class="name c-text__lv4">三浦 直子</p>
        <p class="kana c-text__note">ミウラ ナオコ</p>
      </div>
      <div class="p-sidebarDetail__main__contents">
        <ul class="p-list p-list--row">
          <?php
            $customerOverviewData = [
              '会員番号' => '010010000042',
              '所属店舗' => '有楽町店',
              '会員状況' => '会員',
              '区分' => '<p class="c-plan c-plan--green"></p>',
            ];
            foreach($customerOverviewData as $key=>$val){
          ?>
            <li>
              <div class="p-list__label"><?= $key; ?></div>
              <div class="p-list__data"><?= $val; ?></div>
            </li>
          <?php } ?>
        </ul>
      </div>
      {{-- 紹介者情報 --}}
      <div class="p-sidebarDetail__main__contents">
        <div class="p-user">
          <div class="p-user__image">
            <div class="c-image c-image--round" style="background: url({{asset('img/common/noImage/admin--square.svg')}})"></div>
          </div>
          <div class="p-user__text">
            <p class="c-text__note">紹介者</p>
            <a href="http://localhost:8000/admin/staff" target="_blank" class="c-link c-link--external">宮川 敏江</a>
          </div>
        </div>
      </div>
      {{-- 所属店舗 --}}
      <div class="p-sidebarDetail__main__contents">
        <div class="p-user">
          <div class="p-user__image">
            <div class="c-image c-image--round" style="background: url({{asset('img/common/noImage/admin--square.svg')}})"></div>
          </div>
          <div class="p-user__text">
            <p class="c-text__note">所属店舗</p>
            <p class="c-link c-link--external">新宿マルイアネックス</p>
          </div>
        </div>
      </div>
      {{-- SNS情報 --}}
      <div class="p-sidebarDetail__main__contents">
        <?php
          $snsData = [
            [
              'name'=>'LINE',
              'icon'=>asset('img/admin/sns/line.svg'),
              'id'=>'jibunde-esute',
            ],
            [
              'name'=>'Facebook',
              'icon'=>asset('img/admin/sns/facebook.svg'),
              'link'=>'https://www.facebook.com/',
              'id'=>'jibundeesute',
            ],
            [
              'name'=>'Twitter',
              'icon'=>asset('img/admin/sns/twitter.svg'),
              'link'=>'https://twitter.com/',
              'id'=>'jibunde_esute',
            ],
            [
              'name'=>'Instagram',
              'icon'=>asset('img/admin/sns/instagram.svg'),
              'link'=>'https://www.instagram.com/',
              'id'=>'jibunde_esute',
            ],
          ];
        ?>
        <ul class="p-list">
          <?php foreach($snsData as $key=>$val){ ?>
          <li>
            <div class="p-list__data">
              <div class="p-user">
                <div class="p-user__image p-user__image--small">
                  <div class="c-image c-image--round" style=" background: url(<?= $val['icon']; ?>)"></div>
                </div>
                <div class="p-user__text">
                  <span class="c-text__note"><?= $val['name']; ?></span>
                  <?php if($val['name'] === 'LINE') { ?>
                    <p><?= $val['id']; ?></p>
                  <?php }else{ ?>
                  <a href="<?= isset($val['link']) ? $val['link'].$val['id'] : '';?>" target="_blank" class="c-link c-link--external"><?= $val['id']; ?></a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</aside>
