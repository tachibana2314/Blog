<div class="p-remodal p-remodal--narrow remodal" data-remodal-id="js-modal__edit__approver">
  <button class="p-remodal__closeButton remodal-close" data-remodal-action="close"></button>
  <div class="p-remodal__layout">
    <div class="p-remodal__head">
      <h2 class="p-remodal__head__title">
        勤怠承認者の変更
      </h2>
    </div>
    <div class="p-remodal__middle">
      <div class="l-12">
        <div class="l-12__12">
          <ul class="p-list p-list--rowWide">
            <li>
              <div class="p-list__label">対象の従業員</div>
              <div class="p-list__data">
                <div class="p-user">
                  <div class="p-user__image">
                    <div class="c-image c-image--round" style="background: url({{ $staff['avator'] }})"></div>
                  </div>
                  <div class="p-user__text">
                    <p class="c-text__lv5">{{ $staff['full_name'] }}</p>
                    <p class="c-text__note">{{ $staff['full_name_kana'] }}</p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="p-remodal__scroll js-target__approvalStatus">
      {!! Form::open(['route' => ['admin.staff.approvalUpdate', $staff], 'id' => 'staff_form', 'class'=> 'h-adr', 'method' => 'post',]) !!}
        <section class="p-remodal__contents">
          <div class="p-remodal__body">
            <div class="p-creditCard">
              <ul class="p-input__list">
                <li>
                  <p class="p-input__list__title">
                    承認者
                  </p>
                </li>
                <li>
                  <div class="c-input c-input--select c-input--full" data-title="承認者">
                    {{ Form::select('approval_staff_id[]', $all_staffs, $staff->approvalStaffs()->pluck('id')->toArray(), ['class' => 'js-target__select2-limit3', 'multiple' => true,])}}
                  </div>
                </li>
                <li>
                  <p class="p-input__list__title">
                    月残業計算時間
                  </p>
                </li>
                <li>
                  <div class="c-input c-input--full" data-title="時間">
                    {{ Form::number('over_calculation_time', $staff->over_calculation_time, [
                      'min' => 0,
                      'step' => 1,
                      'placeholder' => 173,
                    ]) }}
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </section>
      {!! Form::close() !!}
    </div>
    <div class="p-remodal__foot">
      <div class="p-buttonWrap">
        <div data-remodal-action="close" class="c-button c-button--line">キャンセル</div>
        <div onclick="$('#staff_form').submit();" class="c-button c-button--accent">保存する</div>
      </div>
    </div>
  </div>
</div>
