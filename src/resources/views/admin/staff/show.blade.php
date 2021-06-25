@extends('admin.layout.layout--detail')
@section('title', $title ?? '従業員管理')
@section('pageClass', 'page_mypage')
@section('content')
  @include('admin.staff._sidebar', ['staff' => $staff])
  <main class="l-main l-main--detail">
    <div class="l-page l-page--detail">
      <div class="p-page">
        <div class="p-page__head p-page__head--detail">
          <div class="l-container">
            <h1 class="c-heading--lv2">従業員詳細</h1>
            <div class="p-page__head__tab p-page__head__tab--left">
              @include('admin.staff._p-page__head__tab__list')
            </div>
          </div>
        </div>
        <div class="p-page__body">
          <div class="l-container">
            <div class="l-12 l-12--gap8 l-12--nowrap">
              <div class="l-12__fix240">
                {{-- 基本情報 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                    従業員情報
                  @endslot
                  @slot('action')
                    <a
                      href="{{route('admin.staff.edit', $staff)}}"
                      class="c-button c-button--line c-button--small"
                    >編集</a>
                  @endslot
                  @slot('body')
                    @component('admin.element.project._p-list',
                      ['listData' =>
                        [
                          '氏名'=> $staff->full_name.'<br><span class="c-text__note">'.$staff->full_name_kana.'</span>',
                          '性別'=> $staff->gender_label,
                          '血液型'=> $staff->blood_type_label,
                          '生年月日'=> $staff->age,
                          'メールアドレス'=> $staff->email,
                          '電話番号'=> $staff->tel,
                          '住所'=> $staff->zipcode.'<br>'.$staff->address,
                        ]
                      ]
                    )
                    @endcomponent
                  @endslot
                @endcomponent
                @if(false)
                {{-- 緊急連絡先 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                    緊急連絡先
                  @endslot
                  @slot('action')
                    <a
                      href="{{route('admin.staff.edit', $staff)}}"
                      class="c-button c-button--line c-button--small"
                    >編集</a>
                  @endslot
                  @slot('body')
                    @component('admin.element.project._p-list',
                      ['listData' =>
                        [
                          '氏名'=> '斎藤直美'.'<br><span class="c-text__note">'.'さいとうなおみ'.'</span>',
                          '続柄'=> '母親',
                          '電話番号'=> '0312345678',
                        ]
                      ]
                    )
                    @endcomponent
                  @endslot
                @endcomponent
                @endif

                {{-- 勤怠承認者 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                    勤怠承認者
                  @endslot
                  @slot('action')
                    <div class="p-buttonWrap">
                      <div data-remodal-target="js-modal__edit__approver" class="c-button c-button--line c-button--small">編集</div>
                    </div>
                  @endslot
                  @slot('body')
                    <ul class="p-list p-list--row">
                      <li>
                        <div class="p-list__label">GPS制限</div>
                        <div class="p-list__data">
                          {!!'<div class="c-labelStatus c-labelStatus--'.($staff->geolocation_limit_off ? "done" : "correct").'">'.($staff->geolocation_limit_off ? "無効" : "有効").'</div>'!!}
                        </div>
                      </li>
                      <li>
                        <div class="p-list__label">残業計算時間</div>
                        <div class="p-list__data">
                          {{ $staff->over_calculation_time }}
                        </div>
                      </li>
                      <li class="p-list--divider"></li>
                    </ul>
                    <ul class="p-list u-mt__8">
                      <li>
                        <div class="p-list__label">承認者</div>
                        <div class="p-list__data">
                          @if($staff->approvalStaffs()->count() === 0)
                            <p>未登録</p>
                          @else
                            <ul class="p-userList__list">
                              @foreach($staff->approvalStaffs() as $approvalStaff)
                                <li>
                                  <article class="p-userList__list__item">
                                    <div class="p-userList__list__item__user">
                                      <div class="c-image c-image--round" style="background: url('{{ $approvalStaff->avator }}');"></div>
                                      <!-- ユーザー -->
                                      <div class="p-userList__list__item__user__text">
                                        <div class="id c-text__note">
                                          {{ $approvalStaff->staff_code }}
                                        </div>
                                        <p class="name">
                                          {{ $approvalStaff->full_name }}
                                        </p>
                                      </div>
                                    </div>
                                  </article>
                                </li>
                              @endforeach
                            </ul>
                          @endif
                        </div>
                      </li>
                      <li>
                        <div class="p-list__label">被承認者</div>
                        <div class="p-list__data">
                          @if($staff->approvalAuthority()->count() === 0)
                            <p>なし</p>
                          @else
                            <ul class="p-userList__list">
                              <li>
                                @foreach($staff->approvalAuthority() as $approvaledStaff)
                                <article class="p-userList__list__item">
                                  <div class="p-userList__list__item__user">
                                    <div class="c-image c-image--round" style="background: url('{{ $approvaledStaff->avator }}');"></div>
                                    <!-- ユーザー -->
                                    <div class="p-userList__list__item__user__text">
                                      <div class="id c-text__note">
                                        {{ $approvaledStaff->staff_code }}
                                      </div>
                                      <p class="name">
                                        {{ $approvaledStaff->full_name }}
                                      </p>
                                    </div>
                                  </div>
                                </article>
                                @endforeach
                              </li>
                            </ul>
                          @endif
                        </div>
                      </li>
                    </ul>
                  @endslot
                @endcomponent

                {{-- 在籍情報 --}}
                @component('admin.element.project._p-boxDetail')
                  @slot('title')
                  在籍情報
                  @endslot
                  @slot('action')
                    <a
                      href="{{route('admin.staff.edit', $staff)}}"
                      class="c-button c-button--line c-button--small"
                    >編集</a>
                  @endslot
                  @slot('body')
                    @component('admin.element.project._p-list',
                      ['listData' =>
                        [
                          '在籍情報'=> '<p class="c-status c-status--correct">在籍中</p>',
                          '勤続年数'=> $staff->diff_day,
                          '入社日'=> $staff->join_date,
                          '休職日'=> '',
                          '復職日'=> $staff->return_date,
                          '退社日'=> $staff->leave_date,
                        ]
                      ])
                      @slot('class')
                        p-list--row
                      @endslot
                    @endcomponent
                  @endslot
                @endcomponent
              </div>

              <div class="l-12__auto">
                <div class="l-12 l-12--gap8">
                  <div class="l-12__12">
                    {{-- 勤怠情報 --}}
                    <div id="area_attendance">
                      @include('admin.staff._attendance', [
                        'month' => date('Y-m'),
                        'staff' => $staff,
                        'totalData' => [],
                        'paidVacationData' => [],
                        'calendarEvents' => [],
                      ])
                    </div>
                    <script>
                      $(function () {
                        UpdateAttendance('{{ date('Y-m') }}');
                      })
                      function UpdateAttendance (month) {
                        $("#area_attendance").css("opacity", 0.5);
                        $.ajax({
                          url : '{{ route('admin.staff.updateAttendance', $staff) }}',
                          type : "GET",
                          datatype:'text/plain',
                          data : {month: month,},
                        }).done(function(response){
                          $("#area_attendance").html(response);
                          $("#area_attendance").css("opacity", 1);
                          monthPicker();
                          var calendarEl = document.getElementById('calendar');
                          var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            initialDate: month + '-01',
                            // 日本語化
                            locale: 'ja',
                            contentHeight: 'auto',
                            dayCellContent: function (e) {
                              e.dayNumberText = e.dayNumberText.replace('日', '');
                            },
                            events: JSON.parse($("#calendarEvents").val()),
                            eventClick: function(info) {
                              $('.js-target__calendar').html("");
                              $('.js-target__calendar').addClass('is-active__calendar--show');
                              $.ajax({
                                url : '{{ route('admin.staff.getAttendanceDetail', $staff) }}',
                                type : "GET",
                                datatype:'text/plain',
                                data : {date: info.event.start.toLocaleDateString(),},
                              }).done(function(response){
                                $('.js-target__calendar').html(response);
                              })
                            }
                          });
                          calendar.render();
                        })
                      }
                    </script>
                  </div>
                  <div class="l-12__12">
                    {{-- 経費情報 --}}
                    @component('admin.element.project._p-boxDetail')
                      @slot('title')
                      立替金経費情報
                      @endslot
                      @slot('body')
                      <div class="l-12">
                        <div class="l-12__auto">
                          <form method="get" action="{{route('admin.staff.show', $staff)}}" id="form_search">
                            <div class="p-selectDate">
                              <div class="p-buttonWrap">
                                <button class="c-button c-button--narrow c-button--line" type="submit" name="expense_month" value="{{ now()->format('Y-m-d') }}">今月</button>
                                <div class="p-selectDate__date">
                                  {{ Form::text('expense_month', request()->expense_month,[ 'class' => 'month_picker', 'form' => 'form_search', 'placeholder' => now()->format('Y-m') ]) }}
                                </div>
                                <button form="form_search" class="c-button c-button--narrow c-button--accent">変更</button>
                              </div>
                            </div>
                            {{-- <div class="c-input c-input--checkbox">
                              <input type="checkbox" name="expenceType" id="expenceType__01">
                              <label for="expenceType__01">立替金</label>
                              <input type="checkbox" name="expenceType" id="expenceType__02">
                              <label for="expenceType__02">通勤費</label>
                              <input type="checkbox" name="expenceType" id="expenceType__03">
                              <label for="expenceType__03">交通費</label>
                            </div> --}}
                          </form>
                        </div>
                        <div class="l-12__auto">
                          <div class="p-text p-text--right">
                            <p class="c-text__lv6">費用合計<span class="c-text__note">（税込）</span></p>
                            <p class="c-number__lv3">¥{{number_format($expense_total)}}</p>
                          </div>
                          <div class="p-text p-text--right">
                            <p class="c-text__note">2021年累計（税込）</p>
                            <p class="c-number__lv6--base">¥{{number_format($expense_year_total)}}</p>
                          </div>
                        </div>
                      </div>
                      @endslot
                      @slot('body2Class')
                        p-boxDetail__body--paddingOff
                      @endslot
                      @slot('body2')
                      <table class="p-table">
                        <thead class="p-table__head">
                          <tr class="p-table__head__tableRow">
                            <th class="p-table__tableHead p-table__tableHead--date">
                              <div class="p-table__item">日付</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--date">
                              <div class="p-table__item">経費種別</div>
                            </th>
                            <th class="p-table__tableHead">
                              <div class="p-table__item">内容</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--price">
                              <div class="p-table__item">金額</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--statusWide">
                              <div class="p-table__item">承認ステータス<br>承認者</div>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="p-table__data">
                          @foreach ($expense_history as $expense)
                          <tr class="p-table__data__tableRow" data-href="/admin/attendance/expense?staff_id={{$staff['id']}}" data-target="_blank">
                            <td class="p-table__tableData">
                              <div class="p-table__item">
                                {{$expense['buy_date']}}
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                {{$expense['category']}}
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                {{$expense['title']}}
                                <span class="c-text__note"> {{$expense['shop_name']}}</span>
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--price">¥{{ number_format($expense['price'])}}</div>

                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                <div class="c-status {{ $expense->setStatusClass() }}">承認済</div>
                                <p class="c-text__note">{{ $expense->approval_staff_name}}</p>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <?php for($i=0;$i<3;$i++) { ?>
                            <td class="p-table__tableData"></td>
                            <?php } ?>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--price">¥{{number_format($expense_total)}}</div>
                            </td>
                            <td class="p-table__tableData"></td>
                          </tr>
                        </tfoot>
                      </table>
                      @endslot
                    @endcomponent
                  </div>
                  <div class="l-12__12">
                    {{-- 経費情報 --}}
                    @component('admin.element.project._p-boxDetail')
                      @slot('title')
                      通勤・交通費経費情報
                      @endslot
                      @slot('body')
                      <div class="l-12">
                        <div class="l-12__auto">
                          <form method="get" action="{{route('admin.staff.show', $staff)}}" id="form_search">
                            <div class="p-selectDate">
                              <div class="p-buttonWrap">
                                <button class="c-button c-button--narrow c-button--line" type="submit" name="commuting_month" value="{{ now()->format('Y-m-d') }}">今月</button>
                                <div class="p-selectDate__date">
                                  {{ Form::text('trans_month', request()->trans_month,[ 'class' => 'month_picker button_search_input', 'form' => 'form_search', 'placeholder' => now()->format('Y-m') ]) }}
                                </div>
                                <button form="form_search" class="c-button c-button--narrow c-button--accent">変更</button>
                              </div>
                            </div>
                            {{-- <div class="c-input c-input--checkbox">
                              <input type="checkbox" name="expenceType" id="expenceType__01">
                              <label for="expenceType__01">立替金</label>
                              <input type="checkbox" name="expenceType" id="expenceType__02">
                              <label for="expenceType__02">通勤費</label>
                              <input type="checkbox" name="expenceType" id="expenceType__03">
                              <label for="expenceType__03">交通費</label>
                            </div> --}}
                          </form>
                        </div>
                        <div class="l-12__auto">
                          <div class="p-text p-text--right">
                            <p class="c-text__lv6">費用合計<span class="c-text__note">（税込）</span></p>
                            <p class="c-number__lv3">¥{{number_format($commuting_total)}}</p>
                          </div>
                          <div class="p-text p-text--right">
                            <p class="c-text__note">2021年累計（税込）</p>
                            <p class="c-number__lv6--base">¥{{number_format($commuting_year_total)}}</p>
                          </div>
                        </div>
                      </div>
                      @endslot
                      @slot('body2Class')
                        p-boxDetail__body--paddingOff
                      @endslot
                      @slot('body2')
                      <table class="p-table">
                        <thead class="p-table__head">
                          <tr class="p-table__head__tableRow">
                            <th class="p-table__tableHead p-table__tableHead--date">
                              <div class="p-table__item">日付</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--date">
                              <div class="p-table__item">経費種別</div>
                            </th>
                            <th class="p-table__tableHead">
                              <div class="p-table__item">内容</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--price">
                              <div class="p-table__item">金額</div>
                            </th>
                            <th class="p-table__tableHead p-table__tableHead--statusWide">
                              <div class="p-table__item">承認ステータス<br>承認者</div>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="p-table__data">
                          @foreach ($commuting_history as $commuting)
                          <tr class="p-table__data__tableRow" data-href="/admin/attendance/transportation?staff_id={{$staff['id']}}" data-target="_blank">
                            <td class="p-table__tableData">
                              <div class="p-table__item">
                                {{$commuting['occurrence_date']}}
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                {{$commuting['transportation_type']}}
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                {{$commuting['trans_category']}}
                                <span class="c-text__note"> {{$commuting['departure']}} ~ {{$commuting['arrival']}}</span>
                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--price">¥{{ number_format($commuting['price'])}}</div>

                              </div>
                            </td>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--column">
                                <div class="c-status {{ $commuting->setStatusClass() }}">{{ $commuting->setStatus() }}</div>
                                <span class="c-text__note">{{ $commuting->approval_staff_name}}</span>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <?php for($i=0;$i<3;$i++) { ?>
                            <td class="p-table__tableData"></td>
                            <?php } ?>
                            <td class="p-table__tableData">
                              <div class="p-table__item p-table__item--price">¥{{number_format($commuting_total)}}</div>
                            </td>
                            <td class="p-table__tableData"></td>
                          </tr>
                        </tfoot>
                      </table>
                      @endslot
                    @endcomponent
                  </div>

                  @if(false)
                  <div class="l-12__6">
                    {{-- 顧客紹介 --}}
                    @component('admin.element.project._p-boxDetail')
                      @slot('title')
                      顧客紹介
                      @endslot
                      @slot('body')
                      <ul class="p-userList__list">
                        <?php for($i=0;$i<4;$i++) { ?>
                        <li>
                          <article class="p-userList__list__item">
                            <div class="p-userList__list__item__user">
                              <div class="c-image c-image--round" style="background: url({{asset('img/sample/user--02.jpg')}});"></div>
                              <!-- ユーザー -->
                              <div class="p-userList__list__item__user__text">
                                <div class="id c-text__note">032</div>
                                <p class="name">宮川 敏江</p>
                              </div>
                            </div>
                            <!-- 情報 -->
                            <div class="p-userList__list__item__data">
                              <ul class="p-list">
                                <li>
                                  <div class="p-list__label">入会日</div>
                                  <div class="p-list__data">2021/03/10</div>
                                </li>
                              </ul>
                            </div>
                          </article>
                        </li>
                        <?php } ?>
                      </ul>
                      @endslot
                    @endcomponent
                  </div>
                  @endif
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('admin.staff._p-modal__edit__approver')
@endsection
