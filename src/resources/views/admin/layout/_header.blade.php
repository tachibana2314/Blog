<header class="l-header">
  <div class="p-header">
    <div class="p-header__left">
      <h1 class="p-header__logo">
        <a href="{{ route('admin.home') }}">
          {{-- <img src="{{asset('img/common/logo/logo--black.svg')}}"> --}}
        </a>
      </h1>
      <div class="p-header__text">
        <p class="c-text__note">管理画面</p>
      </div>
    </div>
    <div class="p-header__center">
      <div class="p-header__date">
        <span class="c-number__lv5">
          <?= date('Y'); ?><span class="c-text__lv6">年</span>
          <?= date('m'); ?><span class="c-text__lv6">月</span>
          <?= date('d'); ?><span class="c-text__lv6">日</span>
          <span class="c-text__note">
            <?php
              $w = date('w');
              $week_name = array("日", "月", "火", "水", "木", "金", "土");
              echo ($week_name[$w]).'曜';
            ?>
          </span>
        </span>
      </div>
    </div>
    <div class="p-header__right">
      <nav class="p-header__nav">
      <ul class="p-header__nav__list">
        <li>
          <div class="p-alertMenu">
            {{-- <div class="p-alertMenu__button js-trigger__alertMenu" data-notification="3"></div> --}}
            <nav class="p-alertMenu__nav js-target__alertMenu">
              <ul class="p-alertMenu__nav__list">
                <li>
                  <a href="" class="p-alertMenu__nav__item">
                    <p class="p-alertMenu__nav__item__label">確認をしてください</p>
                    <p class="p-alertMenu__nav__item__date">2021/04/21</p>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </li>
        <li>
          {{-- <div class="c-image c-image--round p-header__nav__list__avatar js-headerMenu" style="background: url({{ $login_user->avator }});"></div> --}}
        </li>
      </ul>
      <div class="p-header__menu js-headerMenu">
        <nav class="p-header__menu__body">
          {{-- <a href="{{route('admin.logout')}}">ログアウト</a> --}}
        </nav>
      </div>
    </nav>
    </div>
  </div>
</header>
