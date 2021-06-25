<aside class="l-sidebar l-sidebar--detail">
  <div class="p-sidebarDetail">
    <div class="p-sidebarDetail__back">
      <a href="{{ route('admin.staff.index') }}" class="p-button p-button--prev">
        <div class="c-image"></div>
        <span class="c-button">従業員管理</span>
      </a>
    </div>
    <div class="p-sidebarDetail__main">
      <div class="p-sidebarDetail__main__user">
        <div
          class="c-image c-image--round"
          style="background: url({{ $staff->avator }});"
        ></div>
        <p class="name c-text__lv4">
          {{ $staff->full_name }}
        </p>
        <p class="kana c-text__note">
          {{ $staff->full_name_kana }}
        </p>
      </div>
      <div class="p-sidebarDetail__main__contents">
        <ul class="p-list p-list--row p-list--column--note">
          @php
            $list =[
                '会員番号' => $staff->staff_code,
                '所属店舗' => Arr::get($staff, 'shop.name', ""),
                '雇用形態' => $staff->employment_status_label,
                '在職区分' => $staff->enrolled_type_label,
                '権限' => $staff->authority_label,
                '役職' => $staff->position,
              ];
            $jurisdiction_shops = '';
            foreach ($staff->jurisdictionShops as $jurisdiction_shop){
              $jurisdiction_shops = $jurisdiction_shops.'<li><p class="c-text__note">'.$jurisdiction_shop->shop->name.'</p></li>';
            }
            if (!empty($jurisdiction_shops)){
              $list['管轄店舗'] = '<ul>'.$jurisdiction_shops.'</ul>';
            }
          @endphp
          @foreach($list as $list_label => $list_value)
            <li>
              <div class="p-list__label">
                {{ $list_label }}
              </div>
              <div class="p-list__data">
                @if($list_label == '所属店舗')
                  @if($list_value)
                    <a href="{{ route('admin.shop.show', $staff->shop) }}">
                      {{ $list_value }}
                    </a>
                  @endif
                @else
                  {!! $list_value !!}
                @endif
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      {{-- SNS情報 --}}
      <div class="p-sidebarDetail__main__contents">
        <?php
          $snsData = [
            [
              'name'=>'LINE',
              'icon'=>asset('img/admin/sns/line.svg'),
              'id'=>$staff->line_account,
            ],
            [
              'name'=>'Facebook',
              'icon'=>asset('img/admin/sns/facebook.svg'),
              'link'=>'https://www.facebook.com/',
              'id'=>$staff->facebook_account,
            ],
            [
              'name'=>'Twitter',
              'icon'=>asset('img/admin/sns/twitter.svg'),
              'link'=>'https://twitter.com/',
              'id'=>$staff->twitter_account,
            ],
            [
              'name'=>'Instagram',
              'icon'=>asset('img/admin/sns/instagram.svg'),
              'link'=>'https://www.instagram.com/',
              'id'=>$staff->instagram_account,
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
                  <?php }elseif(isset($val['id'])){ ?>
                  <a href="<?= isset($val['link']) ? $val['link'].$val['id'] : '';?>" target="_blank" class="c-link c-link--external"><?= $val['id']; ?></a>
                  <?php }else{ ?>---<?php } ?>
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
