@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア -->
      <section class="area_stamp">
        <section class="head_page">
          <div class="area_ttl_page">
            <div class="text">
              <p class="h1 ttl">スタンプカード管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.stamp.addCard') }}" class="btn_ico_plus">スタンプカードを追加する</a>
            </div>
          </div>
        </section>
        <section class="body_page">
          <section class="box">
            <!-- テーブルエリア -->
            <section class="area_table">
              <div class="head_table">
                <!-- コントロールエリア(下と共通)  -->
                <div class="area_control_table">
                  <!-- カウント  -->
                  <div class="area_count_table">
                    <p class="count" data-after="cards">{{ number_format($stamp_card->total()) }}</p>
                  </div>
                  <!-- フィルタ  -->
                  {!! Form::model($search_card, ['method' => 'get']) !!}
                  <div class="area_filter_table">
                    <div class="wrap_input wrap_search">
                      {!! Form::text('keyword_card', null, ['placeholder' => 'キーワードで絞り込み', 'required' => false]) !!}
                    </div>
                    <div class="wrap_filter">
                      <div class="button_filter">絞り込み</div>
                    </div>
                    <div class="overlay_filter"></div>
                    <section class="area_filter_cnt">
                      <ul class="list_filter">
                        <li>
                          <p class="ttl"></p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">
                            </div>
                          </div>
                        </li>
                        <li>
                          <p class="ttl">ステータス</p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">
                              {!! Form::select('card_status', ['' => '選択してください']+CustomConst::COUPON_STATUS,old('status')) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a href="{{ route('admin.stamp') }}" class="btn_gray_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $stamp_card->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
              <div class="body_table">
                <table class="table link">
                  <thead>
                    <tr>
                      <th>
                        <p>カード名</p>
                      </th>
                      <th>
                        <p>合計スタンプ数</p>
                      </th>
                      <th>
                        <p>利用期間</p>
                      </th>
                      <th>
                        <p>ステータス</p>
                      </th>
                      <th>
                        <p>登録日</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stamp_card as $v)
                      <tr data-href="{{ route('admin.stamp.card_detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v['title'] }}</p>
                        </td>
                        <td>
                          <p>{{ $v['stamp_count'] }}</p>
                        </td>
                        <td>
                          <p>{{ $v['start_date']}} - {{ $v['end_date']}}</p>
                        </td>
                        <td>
                          <p class="{{ $v->setStatusClass() }}"></p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($v->created_at)) }}</p>
                        </td>
                        <th>
                        </th>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="foot_table">
                <!-- コントロールエリア(上と共通)  -->
                <div class="area_control_table">
                  <!-- ページネート  -->
                  {{ $stamp_card->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
            </section>
          </section>
        </section>
      </section>

      <section class="head_page" style="margin-top: 15px">
          <div class="area_ttl_page">
            <div class="btnarea">
              <a href="{{ route('admin.stamp.addCoupon') }}" class="btn_ico_plus">スタンプクーポンを追加する</a>
            </div>
          </div>
        </section>
        <section class="body_page">
          <section class="box">
            <!-- テーブルエリア -->
            <section class="area_table">
              <div class="head_table">
                <!-- コントロールエリア(下と共通)  -->
                <div class="area_control_table">
                  <!-- カウント  -->
                  <div class="area_count_table">
                    <p class="count" data-after="coupons">{{ number_format($stamp_coupon->total()) }}</p>
                  </div>
                  <!-- フィルタ  -->
                  {!! Form::model($search_coupon, ['method' => 'get']) !!}
                  <div class="area_filter_table2">
                    <div class="wrap_input wrap_search">
                      {!! Form::text('keyword', null, ['placeholder' => 'キーワードで絞り込み', 'required' => false]) !!}
                    </div>
                    <div class="wrap_filter">
                      <div class="button_filter2">絞り込み</div>
                    </div>
                    <div class="overlay_filter2"></div>
                    <section class="area_filter_cnt">
                      <ul class="list_filter">
                        <li>
                          <p class="ttl"></p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">

                            </div>
                          </div>
                        </li>
                        <li>
                          <p class="ttl">ステータス</p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">
                              {!! Form::select('status', ['' => '選択してください']+CustomConst::COUPON_STATUS,old('status')) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a href="{{ route('admin.stamp') }}" class="btn_gray_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply2'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $stamp_coupon->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
              <div class="body_table">
                <table class="table link">
                  <thead>
                    <tr>
                      <th>
                        <p>対象スタンプカード</p>
                      </th>
                      <th>
                        <p>クーポン名</p>
                      </th>
                      <th>
                        <p>スタンプ数</p>
                      </th>
                      <th>
                        <p>利用期間</p>
                      </th>
                      <th>
                        <p>ステータス</p>
                      </th>
                      <th>
                        <p>登録日</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($stamp_coupon as $v)
                      <tr data-href="{{ route('admin.stamp.coupon_detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v->stampCard->title }}</p>
                        </td>
                        <td>
                          <p>{{ $v['title'] }}</p>
                        </td>
                        <td>
                          <p>{{ $v['stamp_count'] }}</p>
                        </td>
                        <td>
                          <p>{{ $v['use_period']}}日間</p>
                        </td>
                        <td>
                          <p class="{{ $v->setStatusClass() }}"></p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($v->created_at)) }}</p>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="foot_table">
                <!-- コントロールエリア(上と共通)  -->
                <div class="area_control_table">
                  <!-- ページネート  -->
                  {{ $stamp_coupon->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
            </section>
          </section>
        </section>
      </section>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
