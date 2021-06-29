@component('admin.element.project._p-boxDetail')
  @slot('title')
    勤怠情報
  @endslot
  @slot('action')
    <p class="c-status c-status--log">
      <span class="p-text">
        <span>修正率</span>
        <span class="c-number__lv4">
          {{ (isset($totalData['edit_rate']) ? $totalData['edit_rate'] : null) }}
        </span>
        <span>％</span>
      </span>
    </p>
  @endslot
  @slot('body')
    <div class="l-12 l-12--gap32 l-12--gap16--pc l-12--nowrap">
      <div class="l-12__auto">
        <div class="l-12 l-12--gap24 l-12--gap16--pc">
          <div class="l-12__12">
            <div class="p-selectDate">
              <div class="p-buttonWrap">
                <div
                  class="c-button c-button--narrow c-button--line"
                  onclick="UpdateAttendance('{{ date('Y-m') }}');"
                >今月</div>
                <div class="p-selectDate__date">
                  <input type="text" value="{{ $month }}" class="month_picker" id="UpdateAttendanceMonth">
                </div>
                <a
                  class="c-button c-button--narrow c-button--accent"
                  onclick="UpdateAttendance($('#UpdateAttendanceMonth').val());"
                >変更</a>
              </div>
            </div>
          </div>
          <div class="l-12__6">
            <p class="c-text__lv5">労働情報</p>
            @component('admin.element.project._p-list',
              ['listData' =>
                [
                  '勤務日数'=> '<span class="c-number__lv5">'.(isset($totalData['attendance']) ? $totalData['attendance'] : null).'</span><span class="c-text__unit">日</span>',
                  '欠勤日数'=> '<span class="c-number__lv5">'.(isset($totalData['absence']) ? $totalData['absence'] : null).'</span><span class="c-text__unit">日</span>',
                  '総労働時間'=> '<span class="c-number__lv5">'.(isset($totalData['work_time']) ? floor($totalData['work_time'] / 60) : null).'</span><span class="c-text__unit">時間</span><span class="c-number__lv5">'.(isset($totalData['work_time']) ? $totalData['work_time'] % 60 : null).'</span><span class="c-text__unit">分</span>',
                  '遅刻'=> '<span class="c-number__lv6">'.(isset($totalData['delay_count']) ? $totalData['delay_count'] : null).'</span><span class="c-text__unit">回</span><br><span class="c-number__lv5">'.(isset($totalData['delay_time']) ? $totalData['delay_time'] : null).'</span><span class="c-text__unit">分</span>',
                  '早退'=> '<span class="c-number__lv6">'.(isset($totalData['leave_early_count']) ? $totalData['leave_early_count'] : null).'</span><span class="c-text__unit">回</span><br><span class="c-number__lv5">'.(isset($totalData['leave_early_time']) ? floor($totalData['leave_early_time'] / 60) : null).'</span><span class="c-text__unit">時間</span><span class="c-number__lv5">'.(isset($totalData['leave_early_time']) ? $totalData['leave_early_time'] % 60 : null).'</span>分',
                  '残業時間'=> '<span class="c-text__note">月残業：</span><span class="c-text__unit">'.(isset($totalData['monthly_leave_late_time']) ? $totalData['monthly_leave_late_time'] : null).'</span><span class="c-text__unit">時間</span><br><span class="c-number__lv5">'.(isset($totalData['leave_late_time']) ? floor($totalData['leave_late_time'] / 60) : null).'</span><span class="c-text__unit">時間</span><span class="c-number__lv5">'.(isset($totalData['leave_late_time']) ? $totalData['leave_late_time'] % 60 : null).'</span>分',
                ]
              ])
              @slot('class')
                p-list--split p-list--line
              @endslot
            @endcomponent
          </div>
          <div class="l-12__6">
            <p class="c-text__lv5">休暇情報</p>
            @component('admin.element.project._p-list',
              ['listData' =>
                [
                  '有給休暇当月使用'=> '<span class="c-number__lv5">'.(isset($totalData['paid_vacation']) ? $totalData['paid_vacation'] : null).'</span><span class="c-text__unit">日</span>',
                  '有給休暇残数（現在）'=> '<span class="c-number__lv5">'.(isset($paidVacationData['total']) ? $paidVacationData['total'] : null).'</span><span class="c-text__unit">日</span>',
                  '次回付与日'=> '<span class="c-text__note">付与日数：</span><span class="c-text__unit">'.(isset($paidVacationData['next_count']) ? $paidVacationData['next_count'] : null).'日</span><br><span class="c-number__lv6">'.(isset($paidVacationData['next_time']) ? $paidVacationData['next_time'] : null).'</span>',
                  'ボーナス休暇当月使用'=> '<span class="c-number__lv5">'.(isset($totalData['bonus_vacation']) ? $totalData['bonus_vacation'] : null).'</span><span class="c-text__unit">日</span>',
                  '当月公休日数'=> '<span class="c-number__lv5">'.(isset($totalData['public_vacation']) ? $totalData['public_vacation'] : null).'</span><span class="c-text__unit">日</span>',
                  '当月特休日数'=> '<span class="c-number__lv5">'.(isset($totalData['special_vacation']) ? $totalData['special_vacation'] : null).'</span><span class="c-text__unit">日</span>',
                ]
              ])
              @slot('class')
                p-list--split p-list--line
              @endslot
            @endcomponent
          </div>
        </div>
      </div>
      <div class="l-12__fix300 l-12__fix240--pcWide">
        <div class="p-calendar">
          <div id='calendar'></div>
          <div class="p-calendar__item js-target__calendar"></div>
        </div>
      </div>
    </div>
    <script>
      $(document).on('click', '.js-trigger__calendar--close', function() {
          $('.js-target__calendar').removeClass('is-active__calendar--show');
        }
      );
    </script>
  @endslot
@endcomponent
<input type="hidden" id="calendarEvents" value="{{ json_encode($calendarEvents) }}">
