{!! Form::model($staff, ['id' => 'staff_form', 'class'=> 'h-adr', 'enctype'=>'multipart/form-data','files'=> true]) !!}
  <div class="l-container--960">
    <div class="l-edit__main">
      <div class="p-input">
        <ul class="p-input__list">
          <li>
            <p class="p-input__list__title">基本情報</p>
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontalAuto c-input--required  c-input--full {{ $errors->has('last_name') ? 'c-input--error' : ''}}" data-title="姓">
              {{ Form::text('last_name', old('last_name'), ['placeholder' => '斉藤', 'autofocus' => true]) }}
            </div>
            @error('last_name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontalAuto c-input--required c-input--full {{ $errors->has('first_name') ? 'c-input--error' : ''}}" data-title="名">
              {{ Form::text('first_name', old('first_name'), ['placeholder' => '直子']) }}
            </div>
            @error('first_name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontalAuto c-input--full {{ $errors->has('last_name_kana') ? 'c-input--error' : ''}}" data-title="フリガナ（姓）">
              {{ Form::text('last_name_kana', old('last_name_kana'), ['placeholder' => 'サイトウ']) }}
            </div>
            @error('last_name_kana')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontalAuto c-input--full {{ $errors->has('first_name_kana') ? 'c-input--error' : ''}}" data-title="フリガナ（名）">
              {{ Form::text('first_name_kana', old('first_name_kana'), ['placeholder' => 'ナオコ']) }}
            </div>
            @error('first_name_kana')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="auto">
            <div class="c-input--radio c-input--right {{ $errors->has('gender') ? 'c-input--error' : ''}}" data-title="性別">
              @foreach(\App\Models\Staff::GENDER_LIST as $radio_key => $radio_value)
                {{ Form::radio('gender', $radio_key, $staff->gender == $radio_key ? true : false, ['id' => "gender_{$radio_key}"]) }}
                {{ Form::label("gender_{$radio_key}", $radio_value) }}
              @endforeach
            </div>
            @error('gender')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="auto">
            <div class="c-input--radio c-input--right {{ $errors->has('blood_type') ? 'c-input--error' : ''}}" data-title="血液型">
              @foreach(\App\Models\Staff::BLOOD_TYPE_LIST as $radio_key => $radio_value)
                {{ Form::radio('blood_type', $radio_key, $staff->blood_type == $radio_key ? true : false, ['id' => "blood_type_{$radio_key}"]) }}
                {{ Form::label("blood_type_{$radio_key}", $radio_value) }}
              @endforeach
            </div>
            @error('blood_type')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="生年月日">
              {{ Form::text('birthday', old('birthday', $staff->birthday), ['placeholder' => '1988/03/18', "class" => "calendar"]) }}
            </div>
            @error('birthday')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-inputs c-input--horizontal c-input--full {{ $errors->has('tel') ? 'c-input--error' : ''}}" data-title="電話番号">
              {{ Form::text('tel', old('tel'), ['placeholder' => '0', 'class' => 'numberfmt']) }}
            </div>
            @error('tel')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <div class="c-input c-input--horizontal c-input--required c-input--full {{ $errors->has('email') ? 'c-input--error' : ''}}" data-title="メールアドレス">
              {{ Form::email('email', old('email'), ['placeholder' => 'sample@example.com']) }}
            </div>
            @error('email')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <span class="p-country-name" style="display:none;">Japan</span>
          <li>
            <p class="p-input__list__title {{ $errors->has('zipcode') ? 'c-input--error' : ''}}">住所</p>
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="郵便番号">
              {{ Form::text('zipcode', old('zipcode'), ['placeholder' => '1230000', 'class' => 'p-postal-code']) }}
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
                {{ Form::select('address1', config('prefecture.PREFECTURE'), old('address1', null), ['placeholder' => '選択してください','class' => 'p-region-id']) }}
              </div>
            </div>
          </li>
          <li>
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('address2') ? 'c-input--error' : ''}}" data-title="市区町村・番地">
              {{ Form::text('address2', old('address2'), ['placeholder' => '渋谷区渋谷123','class' => 'p-locality p-street-address p-extended-address']) }}
            </div>
          </li>
          <li>
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('address3') ? 'c-input--error' : ''}}" data-title="建物名・号室">
              {{ Form::text('address3', old('address3'), ['placeholder' => '渋谷ビル101', 'class' => '']) }}
            </div>
          </li>
          <li>
            <p class="p-input__list__title {{ $errors->has('line_account') ? 'c-input--error' : ''}}">その他</p>
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="LINEアカウント">
              {{ Form::text('line_account', old('line_account'), ['placeholder' => '']) }}
            </div>
            @error('line_account')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('facebook_account') ? 'c-input--error' : ''}}" data-title="Facebookアカウント">
              {{ Form::text('facebook_account', old('facebook_account'), ['placeholder' => '']) }}
            </div>
            @error('facebook_account')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('instagram_account') ? 'c-input--error' : ''}}" data-title="Instagramアカウント">
              {{ Form::text('instagram_account', old('instagram_account'), ['placeholder' => '']) }}
            </div>
            @error('instagram_account')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('twitter_account') ? 'c-input--error' : ''}}" data-title="Twitterアカウント">
              {{ Form::text('twitter_account', old('twitter_account'), ['placeholder' => '']) }}
            </div>
            @error('twitter_account')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--required c-input--full {{ $errors->has('join_date') ? 'c-input--error' : ''}}" data-title="入社日">
              {{ Form::text('join_date', old('join_date'), ['placeholder' => '1988/03/18', "class" => "calendar"]) }}
            </div>
            @error('join_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('leave_date') ? 'c-input--error' : ''}}" data-title="休職日">
              {{ Form::text('leave_date', old('leave_date'), ['placeholder' => '1988/03/18', "class" => "calendar"]) }}
            </div>
            @error('leave_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('return_date') ? 'c-input--error' : ''}}" data-title="復職日">
              {{ Form::text('return_date', old('return_date'), ['placeholder' => '1988/03/18', "class" => "calendar"]) }}
            </div>
            @error('return_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full {{ $errors->has('leave_date') ? 'c-input--error' : ''}}" data-title="退社日">
              {{ Form::date('leave_date', old('leave_date'), ['placeholder' => '1988/03/18', "class" => "calendar"]) }}
            </div>
            @error('leave_date')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li>
            <div class="c-input c-input--full {{ $errors->has('memo') ? 'c-input--error' : ''}}" data-title="メモ">
              {{ Form::textarea('memo', old('memo'), ['placeholder' => '','class' => 'half']) }}
            </div>
            @error('memo')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>

          <li>
            <p class="p-input__list__title {{ $errors->has('line_account') ? 'c-input--error' : ''}}">個人詳細情報</p>
          </li>
          <li class="split__2">
            <div class="c-input c-input--right c-input--full {{ $errors->has('employment_insurance_number') ? 'c-input--error' : ''}}" data-title="前職の雇用保険被保険者番号">
              {{ Form::text('employment_insurance_number', old('employment_insurance_number'), ['placeholder' => '12桁の数字を入力']) }}
            </div>
            @error('employment_insurance_number')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--right c-input--full {{ $errors->has('annuity_number') ? 'c-input--error' : ''}}" data-title="年金番号">
              {{ Form::text('annuity_number', old('annuity_number'), ['placeholder' => '10桁の数字を入力']) }}
            </div>
            @error('annuity_number')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="銀行名">
              {{ Form::text('bank_name', old('bank_name'), ['placeholder' => '銀行名を入力']) }}
            </div>
            @error('bank_name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="銀行コード">
              {{ Form::text('bank_code', old('bank_code'), ['placeholder' => '銀行コードを入力']) }}
            </div>
            @error('bank_code')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="支店名">
              {{ Form::text('branch_name', old('branch_name'), ['placeholder' => '支店名を入力']) }}
            </div>
            @error('branch_name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--horizontal c-input--full" data-title="支店コード">
              {{ Form::text('branch_code', old('branch_code'), ['placeholder' => '支店コードを入力']) }}
            </div>
            @error('branch_code')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="p-list__data">
              <div class="c-input--radio c-input--right" data-title="口座種類">
                @foreach(\App\Models\Staff::TYPE_OF_MOUTHPIECE_LIST as $key => $type)
                  {{ Form::radio('deposit_type', $key, $staff->deposit_type == $key ? true : false, ['id' => "deposit_type_{$key}"]) }}
                  {{ Form::label("deposit_type_{$key}", $type) }}
                @endforeach
              </div>
              @error('enrolled_type')
                <div class="p-formError">
                  <p class="message">{{ $message }}</p>
                </div>
              @enderror
            </div>
          </li>
          <li class="split__2">
            <div class="c-input c-input--right c-input--full {{ $errors->has('facebook_account') ? 'c-input--error' : ''}}" data-title="口座番号">
              {{ Form::text('account_number', old('account_number'), ['placeholder' => '7桁の数字を入力']) }}
            </div>
            @error('account_number')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
          <li class="split__2">
            <div class="c-input c-input--right c-input--full {{ $errors->has('facebook_account') ? 'c-input--error' : ''}}" data-title="口座名義（フルネームカナ）">
              {{ Form::text('account_full_name', old('account_full_name'), ['placeholder' => '口座名義（カナ）を入力']) }}
            </div>
            @error('account_full_name')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </li>
        </ul>
      </div>
    </div>
    <div class="l-edit__sidebar">
      <ul class="p-list">
        <li>
          <div class="p-list__label p-list__label--required">
            社員番号
          </div>
          <div class="p-list__data">
            <div class="c-input c-input--full {{ $errors->has('staff_code') ? 'c-input--error' : ''}}">
              {{ Form::text('staff_code', old('staff_code'), [
                'placeholder' => '社員番号',
                'disabled' => $staff->id ? true : false
              ]) }}
            </div>
            @error('staff_code')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label p-list__label--required">
            パスワード
          </div>
          <div class="p-list__data">
            <div class="c-input c-input--full {{ $errors->has('password') ? 'c-input--error' : ''}}">
              {{ Form::password('password', ['placeholder' => $staff->id ? '変更する場合のみ入力' : '',]) }}
            </div>
            @error('password')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label">
            雇用形態
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--radio--label {{ $errors->has('employment_status') ? 'c-input--error' : ''}}">
              @foreach(\App\Models\Staff::EMPLOYMENT_STATUS_LIST as $radio_key => $radio_value)
                {{ Form::radio('employment_status', $radio_key, $staff->employment_status == $radio_key ? true : false, ['id' => "employment_status_{$radio_key}"]) }}
                {{ Form::label("employment_status_{$radio_key}", $radio_value) }}
              @endforeach
            </div>
            @error('employment_status')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label p-list__label--required">
            在職区分
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--radio--label {{ $errors->has('enrolled_type') ? 'c-input--error' : ''}}">
              @foreach(\App\Models\Staff::ENROLLED_TYPE_LIST as $radio_key => $radio_value)
                {{ Form::radio('enrolled_type', $radio_key, $staff->enrolled_type == $radio_key ? true : false, ['id' => "enrolled_type_{$radio_key}"]) }}
                {{ Form::label("enrolled_type_{$radio_key}", $radio_value) }}
              @endforeach
            </div>
            @error('enrolled_type')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label p-list__label--required">
            権限
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--radio--label {{ $errors->has('authority') ? 'c-input--error' : ''}}">
              @foreach(\App\Models\Staff::AUTHORITY_LIST as $radio_key => $radio_value)
                {{ Form::radio('authority', $radio_key, $staff->authority == $radio_key ? true : false, ['id' => "authority_{$radio_key}"]) }}
                {{ Form::label("authority_{$radio_key}", $radio_value) }}
              @endforeach
            </div>
            @error('authority')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label">
            役職
          </div>
          <div class="p-list__data">
            <div class="c-input c-input--full {{ $errors->has('position') ? 'c-input--error' : ''}}">
              {{ Form::text('position', old('position'), ['placeholder' => '役職']) }}
            </div>
            @error('position')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label p-list__label--required">
            所属店舗
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--select {{ $errors->has('shop_id') ? 'c-input--error' : ''}}">
              {{ Form::select('shop_id', $shops, old('shop_id', null), ['placeholder' => '選択してください'])}}
            </div>
          </div>
          @error('shop_id')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label">
            GPS制限
          </div>
          <div class="p-list__data">
            <div class="c-input--checkbox c-input--checkbox--label {{ $errors->has('geolocation_limit_off') ? 'c-input--error' : ''}}">
              <input type="hidden" name="geolocation_limit_off" value="" />
              {{ Form::checkbox('geolocation_limit_off', 1, old('geolocation_limit_off', $staff->geolocation_limit_off) ? true : false, ['id' => "geolocation_limit_off"]) }}
              {{ Form::label("geolocation_limit_off", 'GPS制限を無効にする') }}
            </div>
            @error('geolocation_limit_off')
              <div class="p-formError">
                <p class="message">{{ $message }}</p>
              </div>
            @enderror
          </div>
        </li>
        <li>
          <div class="p-list__label p-list__label">
            承認者
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--select">
              {{ Form::select('approval_staff_id[]', $all_staffs, $staff->approvalStaffs()->pluck('id')->toArray(), ['class' => 'js-target__select2-limit3', 'multiple' => true,])}}
            </div>
          </div>
          @error('approval_staff_id')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label p-list__label">
            管轄店舗
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--required c-input--select">
              {{ Form::select('shop_ids[]', $all_shops, $staff->jurisdictionShops()->pluck('shop_id')->toArray(), ['class' => 'js-target__select2', 'multiple' => true,])}}
            </div>
          </div>
          @error('approval_staff_id')
            <div class="p-formError">
              <p class="message">{{ $message }}</p>
            </div>
          @enderror
        </li>
        <li>
          <div class="p-list__label">
            従業員写真
          </div>
          <div class="p-list__data">
            <div class="c-input--file">
              <div class="c-button c-button--remove js-trigger__photoList--remove delete_image"></div>
              <label for="postImage__main" id="main-image" class="c-image" style="background: url({{ isset($staff->photo) ? $staff->avator : '' }})">
                {{ Form::file('photo', ['id' => 'postImage__main','accept' => 'image/*', 'enctype' => 'multipart/form-data', 'class' => 'file_img_preview']) }}
                {!! Form::hidden('photo', isset($staff->photo) ? $staff->photo : '' ) !!}
              </label>
            </div>
          </div>
          <div class="p-list__label">
            ＊画像アップロードサイズは200MBまでとなります
          </div>
        </li>
      </ul>
    </div>
  </div>
{!! Form::close() !!}

@include('admin.staff._form_script')
