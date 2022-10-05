@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <!-- ボディ_メイン -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア  -->
      <section class="area_page">
        <section class="head_page">
          <div class="area_ttl_page">
            <div class="text">
              <p class="h1 ttl">お知らせ管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.information.add') }}" class="btn_ico_plus">お知らせを追加する</a>
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
                    <p class="count" data-before="" data-after="news">{{ number_format($information->total()) }}</p>
                  </div>
                  <!-- フィルタ  -->
                  {!! Form::model($search, ['method' => 'get']) !!}
                  <div class="area_filter_table">
                    <div class="wrap_input wrap_search">
                      {!! Form::text('keyword', null, ['placeholder' => 'キーワードで絞り込み', 'required' => false]) !!}
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
                              {!! Form::select('status', ['' => '選択してください']+CustomConst::STATUS,old('status')) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a href="{{ route('admin.information') }}" class="btn_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $information->appends(request()->input())->links('pagination::default') }}
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
                        <p>タイトル</p>
                      </th>
                      <th>
                        <p>@sortablelink('release_date', '公開日')</p>
                      </th>
                      <th>
                        <p>@sortablelink('status', 'ステータス')</p>
                      </th>
                      <th>
                        <p>@sortablelink('created_at', '登録日')</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($information as $v) { ?>
                      <tr data-href="{{ route('admin.information.detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v['id']}}</p>
                        </td>
                        <td>
                          <p>{{ $v['title']}}</p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($v->release_date)) }}</p>
                        </td>
                        <td>
                          <p class="{{ $v->setStatusClass() }}"></p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($v->created_at)) }}</p>
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
                    {{ $information->appends(request()->input())->links('pagination::default') }}
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
