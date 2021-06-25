<aside class="l-sidebar l-sidebar--detail">
  <div class="p-sidebarDetail">
    <div class="p-sidebarDetail__back">
      <a href="{{ $is_virtual ? route('admin.virtual_shop.index') : route('admin.shop.index') }}" class="p-button p-button--prev">
        <div class="c-image"></div>
        <span class="c-button">{{ $is_virtual ? 'バーチャル店舗管理' : '店舗管理'}}</span>
      </a>
    </div>
    <div class="p-sidebarDetail__main">
      <div class="p-sidebarDetail__main__shop">
        <div
          class="c-image c-image--wide"
          style="background: url({{ Arr::get($shop, 'thumbnail') }});"
        ></div>
        <p class="c-text__note">{{ $shop->shop_id ?? ''}}</p>
        <p class="name c-text__lv5">{{ $shop->name ?? ''}}</p>
        @if(!$is_virtual)
          <p class="c-text__note">{{ $shop->disp_name_abbreviation ?? ''}}</p>
        @else
          <p class="c-text__note">{{ $shop->name ?? ''}}</p>
        @endif
      </div>
      <div class="p-sidebarDetail__main__contents">
        {{-- 通常店舗 --}}
        @if(!$is_virtual)
          {{-- 本部以外で表示 --}}
          @unless($shop->disp_shop_type === '本部')
          <ul class="p-list">
            <li>
              <div class="p-list__label">最終受付</div>
              <div class="p-list__data">
                {!! '<span class="c-text__lv6 c-text__weight--700">'.disp_time_format($shop->opening_time ?? '').'〜'.disp_time_format($shop->closing_time ?? '').' </span><span class="c-text__note">（最終受付：'.disp_time_format($shop->last_recepting_time ?? '').'）</span>'!!}<br>
                {!! '<span class="c-text__note">月：</span>'. disp_time_format($shop->monday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->monday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->monday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">火：</span>'. disp_time_format($shop->tuesday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->tuesday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->tuesday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">水：</span>'. disp_time_format($shop->wednesday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->wednesday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->wednesday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">木：</span>'. disp_time_format($shop->thursday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->thursday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->thursday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">金：</span>'. disp_time_format($shop->friday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->friday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->friday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">土：</span>'. disp_time_format($shop->saturday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->saturday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->saturday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">日：</span>'. disp_time_format($shop->sunday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->sunday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->sunday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
                {!! '<span class="c-text__note">祝：</span>'. disp_time_format($shop->holiday_opening_time ?? ($shop->opening_time ?? '')).'〜'.disp_time_format($shop->holiday_closing_time ?? ($shop->closing_time ?? '')).
                  '<span class="c-text__note">（'.disp_time_format($shop->holiday_last_recepting_time ?? ($shop->last_recepting_time ?? '')).'）</span>' !!}<br>
              </div>
            </li>
            <li>
              <div class="p-list__label">勤務開始時間</div>
              <div class="p-list__data">
                @foreach([
                    [
                        'label' => '月',
                        'key' => 'monday_attendance_start_time',
                    ], [
                        'label' => '火',
                        'key' => 'tuesday_attendance_start_time',
                    ], [
                        'label' => '水',
                        'key' => 'wednesday_attendance_start_time',
                    ], [
                        'label' => '木',
                        'key' => 'thursday_attendance_start_time',
                    ], [
                        'label' => '金',
                        'key' => 'friday_attendance_start_time',
                    ], [
                        'label' => '土',
                        'key' => 'saturday_attendance_start_time',
                    ], [
                        'label' => '日',
                        'key' => 'sunday_attendance_start_time',
                    ], [
                        'label' => '祝',
                        'key' => 'holiday_attendance_start_time',
                    ],
                ] as $week_key => $week_value)
                  <span class="c-text__note">{{ $week_value['label'] }}：</span>
                  {{ disp_time_format(data_get($shop, $week_value['key']) ?? (data_get($shop, $week_value['key']) ?? '')) }}<br>
                @endforeach
              </div>
            </li>
            <li>
              <div class="p-list__label">最寄り駅</div>
              <div class="p-list__data">{{ $shop->nearest_station ?? ''}}</div>
            </li>
            <li>
              <div class="p-list__label">定休日</div>
              <div class="p-list__data">{{ $shop->regular_holiday ?? '' }}</div>
            </li>
            <li>
              <div class="l-12">
                <div class="l-12__3">
                  <div>
                    <div class="p-list__label">部屋数</div>
                    <div class="p-list__data">{{ $shop->room_count ?? '' }}</div>
                  </div>
                </div>
                <div class="l-12__3">
                  <div>
                    <div class="p-list__label">坪数</div>
                    <div class="p-list__data">{{ $shop->floor_space ?? '' }}</div>
                  </div>
                </div>
                <div class="l-12__6">
                  <div>
                    <div class="p-list__label">内装色</div>
                    <div class="p-list__data">{{ $shop->floor_colors ?? '' }}</div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <ul class="p-list u-mt__16">
            <li>
              <div class="p-list__label">施設</div>
              <div class="p-list__data">
                <p class="p-text p-text--narrow">
                  <span class="c-labelStatus {{ $shop->facilityClass($shop->has_face_counter)}}">フェイスカウンター</span>
                  <span class="c-labelStatus {{ $shop->facilityClass($shop->has_sports_gym)}}">ジムスペース</span>
                  <span class="c-labelStatus {{ $shop->facilityClass($shop->has_fitness_gym_space)}}">フィットネスジムスペース</span>
                  <span class="c-labelStatus {{ $shop->facilityClass($shop->has_pair_room)}} }}">ペアルーム</span>
                  <span class="c-labelStatus {{$shop->facilityClass($shop->has_inbody)}}">インボディ</span>
                </p>
              </div>
            </li>
            <li>
              <div class="p-list__label">メモ</div>
              <div class="p-list__data">{!! nl2br(e($shop->memo ?? '')) !!}</div>
            </li>
            <li>
              <div class="p-list__label">店舗写真</div>
              <div class="p-list__data">
                <div class="p-photoList">
                  <ul class="p-photoList__list">
                    @foreach($shop->shop_images ?? [] as $shop_image)
                      <li>
                        <div
                          class="c-image c-image--wide"
                          style="background: url({{ Arr::get($shop_image, 'url') }})"
                        ></div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </li>
          </ul>
          @endif
        @else
        <ul class="p-list">
          <li>
            <div class="p-list__label">URL（レンタル）</div>
            <div class="p-list__data">
              <a target="_blank" href="{{ $shop->application_url ?? '#'}}" >{{ $shop->application_url ?? ''}}</a>
            </div>
          </li>
          <li>
            <div class="p-list__label">URL（販売）</div>
            <div class="p-list__data">
              <a target="_blank" href="{{ $shop->sell_url ?? '#'}}" >{{ $shop->sell_url ?? ''}}</a>
            </div>
          </li>
          <li>
            <div class="p-list__label">メモ</div>
            <div class="p-list__data">{!! nl2br(e($shop->memo ?? '')) !!}</div>
          </li>
        </ul>
        @endif
      </div>
    </div>
  </div>
</aside>
