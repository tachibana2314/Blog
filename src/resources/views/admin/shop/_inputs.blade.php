{{--
  @include('admin.shop._inputs', ['shop' => $shop, 'mShopGroups' => $mShopGroups])
--}}
{{ Form::hidden('is_edit', isset($shop)) }}
<span class="p-country-name" style="display:none;">Japan</span>
<div class="l-edit__body">
  <div class="l-container--1080">
    <div class="l-edit__main">
      <div class="p-input">
        <ul class="p-input__list">
          <li>
            <p class="p-input__list__title">基本情報</p>
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--required c-input--full {{ $errors->has('shop_id') ? 'c-input--error' : ''}}" data-title="店舗コード">
              {{ Form::text('shop_id', old('shop_id', null)) }}
            </div>
            @error('shop_id')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            @if(!$is_virtual)
              <div class="c-input c-input--horizontal c-input--required  c-input--full {{ $errors->has('shop_type') ? 'c-input--error' : ''}}" data-title="店舗区分">
                <div class="c-input--select c-input--full">
                  {{ Form::select('shop_type', App\Models\Shop::SHOP_TYPE_LIST, old('shop_type', null), ['placeholder' => '選択してください']) }}
                </div>
              </div>
              @error('shop_type')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            @else
              {{ Form::hidden('shop_type', App\Models\Shop::SHOP_TYPE_STATUS_VIRTUAL_SHOP) }}
            @endif
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--required c-input--full {{ $errors->has('name') ? 'c-input--error' : ''}}" data-title="店舗名">
              {{ Form::text('name', old('name', null)) }}
            </div>
            @error('name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          @if(!$is_virtual)
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('name_abbreviation') ? 'c-input--error' : ''}}" data-title="略称">
              {{ Form::text('name_abbreviation', old('name_abbreviation', null)) }}
            </div>
            @error('name_abbreviation')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('shop_type_gender') ? 'c-input--error' : ''}}" data-title="利用者性別">
              <div class="c-input--select c-input--full">
                {{ Form::select('shop_type_gender', App\Models\Shop::SHOP_TYPE_GENDER_LIST, old('shop_type_gender', null), ['class' =>'shop_type_gender', 'laceholder' => '選択してください']) }}
              </div>
            </div>
            @error('shop_type_gender')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          @endif
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('shop_group_id') ? 'c-input--error' : ''}}" data-title="店舗グループ">
              <div class="c-input--select c-input--full">
                {{ Form::select('shop_group_id', $mShopGroups, old('shop_group_id', null), ['placeholder' => '選択してください']) }}
              </div>
            </div>
            @error('shop_group_id')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('zipcode') ? 'c-input--error' : ''}}" data-title="郵便番号">
              {{ Form::text('zipcode', old('zipcode', null), ['placeholder' => '123-0000','class' => 'p-postal-code']) }}
            </div>
            @error('zipcode')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('address1') ? 'c-input--error' : ''}}" data-title="都道府県">
              <div class="c-input--select c-input--full">
                {{ Form::select('address1', config('prefecture.PREFECTURE'), old('address1', null), ['placeholder' => '選択してください', 'class' => 'p-region-id'])}}
              </div>
            </div>
            @error('address1')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('address2') ? 'c-input--error' : ''}}" data-title="市区町村・番地">
              {{ Form::text('address2', old('address2', null), ['placeholder' => '渋谷区渋谷1-2-3', 'class' => 'p-locality p-street-address p-extended-address']) }}
            </div>
            @error('address2')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('address3') ? 'c-input--error' : ''}}" data-title="建物名・号室">
              {{ Form::text('address3', old('address3', null), ['placeholder' => '渋谷ビル102']) }}
            </div>
            @error('address3')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <div class="c-input--horizontal c-input--full {{ $errors->has('mail') ? 'c-input--error' : ''}}" data-title="メールアドレス">
              {{ Form::text('mail', old('mail', null), ['placeholder' => 'test@example.com']) }}
            </div>
            @error('mail')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <div class="c-input--horizontal c-input--full {{ $errors->has('password') ? 'c-input--error' : ''}}" data-title="パスワード">
              {{ Form::password('password') }}
            </div>
            @error('password')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('tel') ? 'c-input--error' : ''}}" data-title="電話番号">
              {{ Form::text('tel', old('tel', null), ['placeholder' => '0311112222']) }}
            </div>
            @error('tel')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('fax') ? 'c-input--error' : ''}}" data-title="FAX番号">
              {{ Form::text('fax', old('fax', null), ['placeholder' => '0311112223']) }}
            </div>
            @error('fax')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__3">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('pre_open_date') ? 'c-input--error' : ''}}" data-title="プレオープン">
              {{ Form::text('pre_open_date', old('pre_open_date', null), ['placeholder' => '2021-01-01', "class" => "calendar"]) }}
            </div>
            @error('pre_open_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__3">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('grand_open_date') ? 'c-input--error' : ''}}" data-title="グランドオープン">
              {{ Form::text('grand_open_date', old('pre_open_date', null), ['placeholder' => '2021-01-01', "class" => "calendar"]) }}
            </div>
            @error('grand_open_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__3">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('close_date') ? 'c-input--error' : ''}}" data-title="閉店日">
              {{ Form::text('close_date', old('close_date', null), ['placeholder' => '2021-01-01', "class" => "calendar"]) }}
            </div>
            @error('close_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <div class="c-input--horizontal c-input--full {{ $errors->has('grand_open_remark') ? 'c-input--error' : ''}}" data-title="オープン予定日等のwebテキスト表示">
              {{ Form::text('grand_open_remark', old('grand_open_remark', null), ['placeholder' => '近日オープン予定など']) }}
            </div>
            <small class="c-text__note">※グランドオープン日が未来日に限り表示されます</small>
            @error('grand_open_remark')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          @if(!$is_virtual)
            {{-- 開店日詳細--}}
            <li>
              <p class="p-input__list__title">営業時間</p>
            </li>
            <!-- 開店時間・閉店時間・最終受付時間 -->
            <li class="split__3">
              <div class="c-input c-input--right c-input--full {{ $errors->has('opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻">
                {{ Form::text('opening_time', old('opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              <small class="c-text__note">※開始時刻を一括反映します</small>
              @error('opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--right c-input--full {{ $errors->has('closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻">
                {{ Form::text('closing_time', old('closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              <small class="c-text__note">※閉店時刻を一括反映します</small>
              @error('closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--right c-input--full {{ $errors->has('last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻">
                {{ Form::text('last_recepting_time', old('last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              <small class="c-text__note">※最終受付時刻を一括反映します</small>
              @error('last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 月曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('monday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（月）">
                {{ Form::text('monday_opening_time', old('monday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('monday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('monday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（月）">
                {{ Form::text('monday_closing_time', old('monday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('monday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('monday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（月）">
                {{ Form::text('monday_last_recepting_time', old('monday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('monday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 火曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('tuesday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（火）">
                {{ Form::text('tuesday_opening_time', old('tuesday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('tuesday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('tuesday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（火）">
                {{ Form::text('tuesday_closing_time', old('tuesday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('tuesday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('tuesday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（火）">
                {{ Form::text('tuesday_last_recepting_time', old('tuesday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('tuesday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 水曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('wednesday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（水）">
                {{ Form::text('wednesday_opening_time', old('wednesday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('wednesday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('wednesday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（水）">
                {{ Form::text('wednesday_closing_time', old('wednesday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('wednesday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('wednesday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（水）">
                {{ Form::text('wednesday_last_recepting_time', old('wednesday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('wednesday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 木曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('thursday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（木）">
                {{ Form::text('thursday_opening_time', old('thursday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('thursday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('thursday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（木）">
                {{ Form::text('thursday_closing_time', old('thursday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('thursday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('thursday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（木）">
                {{ Form::text('thursday_last_recepting_time', old('thursday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('thursday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 金曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('friday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（金）">
                {{ Form::text('friday_opening_time', old('friday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('friday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('friday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（金）">
                {{ Form::text('friday_closing_time', old('friday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('friday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('friday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（金）">
                {{ Form::text('friday_last_recepting_time', old('friday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('friday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 土曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('saturday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（土）">
                {{ Form::text('saturday_opening_time', old('saturday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('saturday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('saturday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（土）">
                {{ Form::text('saturday_closing_time', old('saturday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('saturday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('saturday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（土）">
                {{ Form::text('saturday_last_recepting_time', old('saturday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('saturday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 日曜日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('sunday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（日）">
                {{ Form::text('sunday_opening_time', old('sunday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('sunday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('sunday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（日）">
                {{ Form::text('sunday_closing_time', old('sunday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('sunday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('sunday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（日）">
                {{ Form::text('sunday_last_recepting_time', old('sunday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('sunday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <!-- 祝日 -->
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('holiday_opening_time') ? 'c-input--error' : ''}}" data-title="開店時刻（祝日）">
                {{ Form::text('holiday_opening_time', old('holiday_opening_time', null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
              </div>
              @error('holiday_opening_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('holiday_closing_time') ? 'c-input--error' : ''}}" data-title="閉店時刻（祝日）">
                {{ Form::text('holiday_closing_time', old('holiday_closing_time', null), ['placeholder' => '20:00', 'class' => 'time_picker']) }}
              </div>
              @error('holiday_closing_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__3">
              <div class="c-input c-input--horizontalMin c-input--full {{ $errors->has('holiday_last_recepting_time') ? 'c-input--error' : ''}}" data-title="最終受付時刻（祝日）">
                {{ Form::text('holiday_last_recepting_time', old('holiday_last_recepting_time', null), ['placeholder' => '19:00', 'class' => 'time_picker']) }}
              </div>
              @error('holiday_last_recepting_time')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li>
              <p class="p-input__list__title">勤務開始時間</p>
            </li>
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
              <li class="split__3">
                <div
                  class="c-input c-input--horizontalMin c-input--full {{ $errors->has($week_value['key']) ? 'c-input--error' : ''}}"
                  data-title="勤務開始時間（{{ $week_value['label'] }}）"
                >
                  {{ Form::text($week_value['key'], old($week_value['key'], null), ['placeholder' => '10:00', 'class' => 'time_picker']) }}
                </div>
                @error($week_value['key'])
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </li>
            @endforeach
            <li>
              <p class="p-input__list__title">詳細情報</p>
              <div class="c-input c-input--horizontal c-input--full {{ $errors->has('nearest_station') ? 'c-input--error' : ''}}" data-title="最寄駅">
                {{ Form::text('nearest_station', old('nearest_station', null), ['placeholder' => 'JR山手線新宿駅徒歩1分']) }}
              </div>
              @error('nearest_station')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__2">
              <div class="c-input c-input--horizontal c-input--full {{ $errors->has('regular_holiday') ? 'c-input--error' : ''}}" data-title="定休日">
                {{ Form::text('regular_holiday', old('regular_holiday', null), ['placeholder' => '年中無休']) }}
              </div>
              @error('regular_holiday')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__2">
              <div class="c-input c-input--horizontal c-input--full {{ $errors->has('room_count') ? 'c-input--error' : ''}}" data-title="部屋数">
                {{ Form::text('room_count', old('room_count', null), ['placeholder' => '部屋数']) }}
              </div>
              @error('room_count')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </li>
            <li class="split__2">
              <div class="c-input c-input--horizontal c-input--full " data-title="坪数">
                {{ Form::text('floor_space', old('floor_space', null), ['placeholder' => '00.00']) }}
              </div>
            </li>
            <li class="split__2">
              <div class="c-input c-input--horizontal c-input--full " data-title="内装色">
                {{ Form::text('floor_colors', old('floor_colors', null), ['placeholder' => '内装色']) }}
              </div>
            </li>
            <li class="split__3">
              <div class="p-list__data">
                <div class="c-input--radio c-input--right c-input--horizontal {{ $errors->has('has_face_counter') ? 'c-input--error' : ''}}" data-title="フェイスカウンター">
                  {{ Form::radio('has_face_counter', App\Models\Shop::STATUS_YES, (old('has_face_counter', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : false, ['id' => 'has_face_counter--01']) }}
                  {{ Form::label('has_face_counter--01', 'あり') }}
                  {{ Form::radio('has_face_counter', App\Models\Shop::STATUS_NO, (old('has_face_counter', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : true, ['id' => 'has_face_counter--04']) }}
                  {{ Form::label('has_face_counter--04', 'なし') }}
                </div>
                @error('has_face_counter')
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </div>
            </li>
            <li class="split__3">
              <div class="p-list__data">
                <div class="c-input--radio c-input--right c-input--horizontal {{ $errors->has('has_fitness_gym_space') ? 'c-input--error' : ''}}" data-title="フィットネスジムスペース">
                  {{ Form::radio('has_fitness_gym_space', App\Models\Shop::STATUS_YES, (old('has_fitness_gym_space', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : false, ['id' => 'has_fitness_gym_space--01']) }}
                  {{ Form::label('has_fitness_gym_space--01', 'あり') }}
                  {{ Form::radio('has_fitness_gym_space', App\Models\Shop::STATUS_NO, (old('has_fitness_gym_space', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : true, ['id' => 'has_fitness_gym_space--04']) }}
                  {{ Form::label('has_fitness_gym_space--04', 'なし') }}
                </div>
                @error('has_fitness_gym_space')
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </div>
            </li>
            <li class="split__3">
              <div class="p-list__data">
                <div class="c-input--radio c-input--right c-input--horizontal {{ $errors->has('has_sports_gym') ? 'c-input--error' : ''}}" data-title="ジムスペース">
                  {{ Form::radio('has_sports_gym', App\Models\Shop::STATUS_YES, (old('has_sports_gym', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : false, ['id' => 'has_sports_gym--01']) }}
                  {{ Form::label('has_sports_gym--01', 'あり') }}
                  {{ Form::radio('has_sports_gym', App\Models\Shop::STATUS_NO, (old('has_sports_gym', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : true, ['id' => 'has_sports_gym--04']) }}
                  {{ Form::label('has_sports_gym--04', 'なし') }}
                </div>
                @error('has_sports_gym')
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </div>
            </li>
            <li class="split__3">
              <div class="p-list__label">
                インボディ
              </div>
              <div class="p-list__data">
                <div class="c-input--radio c-input--right c-input--horizontal {{ $errors->has('has_inbody') ? 'c-input--error' : ''}}" data-title="">
                  {{ Form::radio('has_inbody', App\Models\Shop::STATUS_YES, (old('has_inbody', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : false, ['id' => 'has_inbody--01']) }}
                  {{ Form::label('has_inbody--01', 'あり') }}
                  {{ Form::radio('has_inbody', App\Models\Shop::STATUS_NO, (old('has_inbody', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : true, ['id' => 'has_inbody--04']) }}
                  {{ Form::label('has_inbody--04', 'なし') }}
                </div>
                @error('has_inbody')
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </div>
            </li>
            <li class="split__3">
              <div class="p-list__label">
                ペアルーム
              </div>
              <div class="p-list__data">
                <div class="c-input--radio c-input--right c-input--horizontal {{ $errors->has('has_pair_room') ? 'c-input--error' : ''}}" data-title="">
                  {{ Form::radio('has_pair_room', App\Models\Shop::STATUS_YES, (old('has_pair_room', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : false, ['id' => 'has_pair_room--01']) }}
                  {{ Form::label('has_pair_room--01', 'あり') }}
                  {{ Form::radio('has_pair_room', App\Models\Shop::STATUS_NO, (old('has_pair_room', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : true, ['id' => 'has_pair_room--04']) }}
                  {{ Form::label('has_pair_room--04', 'なし') }}
                </div>
                @error('has_pair_room')
                  <div class="p-formError">
                    <p class="message">{{ $message }}</p>
                  </div>
                @enderror
              </div>
            </li>
          @endif
          <li>
            <div class="c-input c-input--full" data-title="メモ {{ $errors->has('memo') ? 'c-input--error' : ''}}">
              {{ Form::textarea('memo', old('memo', null), ['placeholder' => '','class'=>'half']) }}
            </div>
            @error('memo')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
        </ul>
      </div>
    </div>
    <div class="l-edit__sidebar">
      <ul class="p-list" style="position: sticky; top: 100px;">
        <li>
          <p class="p-input__list__title">その他の情報</p>
        </li>
        @if(!$is_virtual)
        <li>
          <div class="p-list__label">
            web公開/非公開
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--radio--label">
              {{ Form::radio('web_release', App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC, (old('web_release', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PUBLIC) ? true : true, ['id' => 'showPlace--01']) }}
              {{ Form::label('showPlace--01', '公開') }}
              {{ Form::radio('web_release', App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE, (old('web_release', $shop->web_release ?? null) == App\Models\Shop::WEB_RELEASE_STATUS_PRIVATE) ? true : false, ['id' => 'showPlace--04']) }}
              {{ Form::label('showPlace--04', '非公開') }}
            </div>
          </div>
        </li>
        @endif
        <li>
          <div class="p-list__label">
            有効/無効
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--radio--label">
              {{ Form::radio('effectiveness', App\Models\Shop::EFFECTIVENESS_STATUS_VALID, (old('effectiveness', $shop->effectiveness ?? null) == App\Models\Shop::EFFECTIVENESS_STATUS_VALID) ? true : true, ['id' => 'effectiveness--01']) }}
              {{ Form::label('effectiveness--01', '有効') }}
              {{ Form::radio('effectiveness', App\Models\Shop::EFFECTIVENESS_STATUS_INVALID, (old('effectiveness', $shop->effectiveness ?? null) == App\Models\Shop::EFFECTIVENESS_STATUS_INVALID) ? true : false, ['id' => 'effectiveness--04']) }}
              {{ Form::label('effectiveness--04', '無効') }}
            </div>
          </div>
        </li>
        <li>
          <div class="p-list__label">
            メイン画像
          </div>
          <div class="p-list__data">
            <div class="p-list__data">
              <div class="c-input--file">
                <div class="c-button c-button--remove js-trigger__photoList--remove delete_image"></div>
                <label for="postImage__main" id="main-image" class="c-image c-image--wide imageUpload"
                        style="background: url({{ isset($shop->thumbnail) ? $shop->thumbnail : '' }})">
                  {{ Form::file('main_photo', ['id' => 'postImage__main','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'file_img_preview']) }}
                  {!! Form::hidden('main_photo', isset($shop->main_photo) ? $shop->main_photo : '' ) !!}
                </label>
              </div>
            </div>
          </div>
        </li>
        {!! Form::hidden('delete_lp_photo',null,['class' => 'delete_lp_photo']) !!}
        <li class="lp_photo" style="display: none">
          <div class="p-list__label">
            LP専用画像
          </div>
          <div class="p-list__data">
            <div class="p-list__data">
              <div class="c-input--file">
                <div class="c-button c-button--remove js-trigger__photoList--remove delete_image"></div>
                <label for="postImage__lp" id="lp-image" class="c-image c-image--wide imageUpload"
                        style="background: url({{ $shop->lp_thumbnail}})">
                  {{ Form::file('lp_photo', ['id' => 'postImage__lp','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'lp_img_preview']) }}
                  {!! Form::hidden('lp_photo', isset($shop->lp_photo) ? $shop->lp_photo : '' ,['class' => 'lp_image']) !!}
                </label>
              </div>
            </div>
          </div>
        </li>
        @if(!$is_virtual)
        <li>
          <div class="p-list__label">
            詳細画像
          </div>
          <div class="p-list__data">
            <div class="p-photoList">
              <ul class="p-photoList__list p-photoList__list--split2" id="js-draggable">
                @for($i=0; $i < 6; $i++)
                  <li class="js-target__photoList">
                    <div class="c-input--file">
                      <div class="c-button c-button--remove js-trigger__photoList--remove delete_image"></div>
                      <label
                        class="c-image c-image--wide imageUpload"
                        id="file_preview_{{$i}}"
                        style="background: url('{{ Arr::get($shop, "shop_images.{$i}.url", asset('img/common/noImage/admin--square.svg')) }}')"
                        data-current="{{ Arr::get($shop, "shop_images.{$i}.url", asset('img/common/noImage/admin--square.svg')) }}"
                      >
                        <input type="file" style="display: none;">
                        {!! Form::hidden('shop_images['.$i.'][pic_path]', Arr::get($shop, "shop_images.{$i}.pic_path")) !!}
                      </label>
                      {!! Form::hidden('shop_images['.$i.'][id]', Arr::get($shop, "shop_images.{$i}.id")) !!}
                      @if($shop->id)
                        {!! Form::hidden('shop_images['.$i.'][shop_id]', $shop->id) !!}
                      @endif
                    </div>
                  </li>
                @endfor
              </ul>
            </div>
          </div>
          <div class="p-list__label">
            ＊画像アップロードサイズは200MBまでとなります
          </div>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>

@include('admin.shop._form_script')
