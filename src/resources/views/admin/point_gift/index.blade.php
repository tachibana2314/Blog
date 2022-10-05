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
                ポイント景品管理
              </p>
            </div>
            <div class="btnarea">
              <a
                href="{{ route('admin.point_gift.add') }}"
                class="btn_ico_plus"
              >
                ポイント景品を追加する
              </a>
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
                      {{ number_format($point_gifts->total()) }}
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
                          <p class="ttl">ステータス</p>
                          <div class="wrap_input wrap_select">
                            <div class="wrap_input wrap_select">
                              {!! Form::select('status', [
                                '' => '選択してください'] + \App\Models\PointGift::STATUS_LIST,
                                old('status')
                              ) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a
                          href="{{ route('admin.point_gift.index') }}"
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
                  {{ $point_gifts->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
              <div class="body_table">
                <table class="table link">
                  <thead>
                    <tr>
                      <th>
                        <p>@sortablelink('id', 'ID')</p>
                      </th>
                      <th>
                        <p>画像</p>
                      </th>
                      <th>
                        <p>@sortablelink('name', 'ポイント景品名')</p>
                      </th>
                      <th>
                        <p>@sortablelink('point', 'ポイント')</p>
                      </th>
                      <th>
                        <p>@sortablelink('status', 'ステータス')</p>
                      </th>
                      <th>
                        <p>交換数</p>
                      </th>
                      <th>
                        <p>@sortablelink('created_at', '登録日')</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($point_gifts as $point_gift) { ?>
                      <tr
                        data-href="{{ route('admin.point_gift.detail', $point_gift)}}"
                        class="clickable"
                      >
                        <td>
                          <p>{{ $point_gift['id']}}</p>
                        </td>
                        <td>
                          @if($point_gift->getImageLabel())
                            <div
                              class="img"
                              style="background: url({{ $point_gift->getImageLabel()->url }}) no-repeat center center; background-size: cover;"
                            ></div>
                          @endif
                        </td>
                        <td>
                          <p>{{ $point_gift->name }}</p>
                        </td>
                        <td>
                          <p>{{ $point_gift->point }}</p>
                        </td>
                        <td>
                          <p class="{{ $point_gift->setStatusClass() }}"></p>
                        </td>
                        <td>
                          <p>{{ $point_gift->points()->count() }}</p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($point_gift->created_at)) }}</p>
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
                    {{ $point_gifts->appends(request()->input())->links('pagination::default') }}
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
