@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア -->
      <section class="area_page">
        <section class="head_page">
          <div class="area_ttl_page">
            <div class="text">
              <p class="h1 ttl">
                ポイント管理
              </p>
            </div>
          </div>
        </section>
        <section class="body_page">
          <section class="box">
            {!! Form::model($search, ['method' => 'get']) !!}
            <!-- テーブルエリア -->
            <section class="area_table">
              <div class="head_table">
                <!-- コントロールエリア(下と共通)  -->
                <div class="area_control_table">
                  <!-- カウント  -->
                  <div class="area_count_table">
                    <p class="count" data-after="point_gifts">
                      {{ number_format($points->total()) }}
                    </p>
                  </div>
                  <!-- フィルタ  -->
                  <div class="area_filter_table">
                    <div class="wrap_input wrap_search">
                      {!! Form::text('keyword', null, [
                        'placeholder' => 'キーワードで絞り込み',
                        'required' => false,
                      ]) !!}
                    </div>
                    <div class="wrap_filter">
                      <div class="button_filter">絞り込み</div>
                    </div>
                    <div class="overlay_filter"></div>
                    <section class="area_filter_cnt">
                      <ul class="list_filter">
                        <li>
                          <p class="ttl">区分</p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">
                              {!! Form::select('type', [
                                '' => '選択してください'] + \App\Models\Point::TYPE_LIST,
                                old('type')
                              ) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a
                          href="{{ route('admin.point.index') }}"
                          class="btn_gray_reset"
                        >
                          リセット
                        </a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $points->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
              <div class="body_table">
                <table class="table">
                  <thead>
                    <tr>
                      <th>
                        <p>区分</p>
                      </th>
                      <th>
                        <p>顧客</p>
                      </th>
                      <th>
                        <p>ポイント</p>
                      </th>
                      <th>
                        <p>利用期限</p>
                      </th>
                      <th>
                        <p>景品</p>
                      </th>
                      <th>
                        <p>@sortablelink('created_at', '登録日時')</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($points as $point) { ?>
                      <tr>
                        <td>
                          <p>{{ $point->type_label }}</p>
                        </td>
                        <td>
                          @if($point->user)
                            <a
                              href="{{ route('admin.user.detail', $point->user) }}"
                              style="text-decoration: underline;"
                            >
                              {{ data_get($point, 'user.nickname') }}
                            </a>
                          @endif
                        </td>
                        <td>
                          <p>
                            @if($point->type == \App\Models\Point::TYPE_ACQUIRE)
                              {{ $point->amount }}
                            @elseif($point->type == \App\Models\Point::TYPE_USE)
                              {{ (-1) * $point->use }}
                            @endif
                          </p>
                        </td>
                        <td>
                          <p>
                            @if($point->type == \App\Models\Point::TYPE_ACQUIRE)
                              {{ $point->expired_at ? date('Y/m/d H:i:s', strtotime($point->expired_at)) : null }}
                            @endif
                          </p>
                        </td>
                        <td>
                          @if(
                            $point->type == \App\Models\Point::TYPE_USE &&
                            $point->point_gift
                          )
                            <a
                              href="{{ route('admin.point_gift.detail', $point->point_gift) }}"
                              style="text-decoration: underline;"
                            >
                              {{ data_get($point, 'point_gift.name') }}
                            </a>
                          @endif
                        </td>
                        <td>
                          <p>{{ date('Y/m/d H:i:s', strtotime($point->created_at)) }}</p>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="foot_table">
                <!-- コントロールエリア(上と共通)  -->
                <div class="area_control_table">
                  <!-- ページネート  -->
                  {{ $points->appends(request()->input())->links('pagination::default') }}
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
