<div class="p-calendar__item__head">
  <p
    class="
      c-labelStatus
      c-labelStatus--correct
      @if(data_get($attendance, 'type') === \App\Models\Attendance::TYPE_WORK)
        c-labelStatus--correct
      @elseif(
        data_get($attendance, 'type') === \App\Models\Attendance::TYPE_PUBLIC_HOLIDAY ||
        data_get($attendance, 'type') === \App\Models\Attendance::TYPE_PAID_VACATION ||
        data_get($attendance, 'type') === \App\Models\Attendance::TYPE_BONUS_VACATION ||
        data_get($attendance, 'type') === \App\Models\Attendance::TYPE_SPECIAL_VACATION
      )
        c-labelStatus--done
      @elseif(
        data_get($attendance, 'type') === \App\Models\Attendance::TYPE_ABSENCE
      )
        c-labelStatus--alert
      @else
        c-labelStatus--done
      @endif
    "
  >
    {{ $attendance ? $attendance->type_label : "未登録" }}
  </p>
  <span class="c-number__lv5">
    {{ $date->format('Y') }}<span class="c-text__lv6">年</span>
    {{ $date->format('n') }}<span class="c-text__lv6">月</span>
    {{ $date->format('j') }}<span class="c-text__lv6">日</span>
  </span>
  <span class="dow c-text__note">{{ $date->isoFormat('ddd') }}曜</span>
  <div class="p-buttonWrap">
    <div class="js-trigger__calendar--close c-button c-button--small c-button--icon c-button--close">
    </div>
  </div>
</div>
@if($attendance)
  <div class="p-calendar__item__body">
    <ul class="p-list">
      @if($stamp_attendance_in)
        <li>
          <div class="p-list__data">
            <div class="p-stamp" data-stamp-type="出">
              <p class="p-stamp__time">{{ data_get($stamp_attendance_in, 'date_at') ? date('g:i', strtotime(data_get($stamp_attendance_in, 'date_at'))) : null }}</p>
              <p class="c-text__note">{{ data_get($stamp_attendance_in, 'shop.name') }}</p>
            </div>
          </div>
        </li>
      @endif
      @if($stamp_attendance_out)
        <li>
          <div class="p-list__data">
            <div class="p-stamp" data-stamp-type="退">
              <p class="p-stamp__time">{{ data_get($stamp_attendance_out, 'date_at') ? date('g:i', strtotime(data_get($stamp_attendance_out, 'date_at'))) : null }}</p>
              <p class="c-text__note">{{ data_get($stamp_attendance_out, 'shop.name') }}</p>
            </div>
          </div>
        </li>
      @endif
      <li>
        <div class="p-list__data">
          <div class="p-stamp" data-stamp-type="休">
            @php
              $rest_time = $staff->getRestTime($date->format('Y-m-d'));
            @endphp
            <p class="p-stamp__time">{{ $rest_time ? $rest_time : 0 }}<span class="unit">分</span></p>
          </div>
        </div>
      </li>
      <li>
        <div class="p-list__data">
          <div class="p-stamp" data-stamp-type="労">
            @php
              $work_time = $staff->getWorkTime($date->format('Y-m-d'));
            @endphp
            <p class="p-stamp__time">{{ $work_time ? floor($work_time / 60) : 0 }}<span class="unit">時間</span>{{ $work_time ? $work_time % 60 : 0 }}<span class="unit">分</span></p>
          </div>
        </div>
      </li>
      <li>
        <div class="p-list__data">
          <div class="p-stamp" data-stamp-type="残">
            @php
              $leave_late_time = $staff->getLeaveLateTime($date->format('Y-m-d'));
            @endphp
            <p class="p-stamp__time">{{ $leave_late_time ? floor($leave_late_time / 60) : 0 }}<span class="unit">時間</span>{{ $leave_late_time ? $leave_late_time % 60 : 0 }}<span class="unit">分</span></p>
          </div>
        </div>
      </li>
    </ul>
  </div>
@endif
<div class="p-calendar__item__foot">
  <div class="p-buttonWrap p-buttonWrap--right">
{{--    <a href="{{ route('admin.attendance.index') }}" class="c-button c-button--line c-button--small" target="_blank">詳細</a>--}}
    <a href="{{ route('admin.attendance.edit', [
      'staff' => $staff,
      'date' => $date->format('Ymd'),
    ]) }}" class="c-button c-button--line c-button--small" target="_blank">編集</a>
  </div>
</div>