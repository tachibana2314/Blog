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
              <p class="h1 ttl">管理者管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.member.add') }}" class="btn_ico_plus">管理者を追加する</a>
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
                    <p class="count" data-after="administrators">{{ number_format($admin->total()) }}</p>
                  </div>
                  <!-- フィルタ  -->
                  {!! Form::model($search, ['method' => 'get']) !!}
                  <div class="area_filter_table">
                    <div class="wrap_input wrap_search">
                      {!! Form::text('keyword', null, ['placeholder' => 'キーワードで絞り込み', 'required' => false]) !!}
                    </div>
                    <!-- <div class="wrap_filter">
                    <div class="button_filter">絞り込み</div>
                  </div>
                  <div class="overlay_filter"></div>
                  <section class="area_filter_cnt">
                  <div class="btnarea_filter">
                  <a href="{{ route('admin.member') }}" class="btn_reset">リセット</a>
                  <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                </div>
              </section> -->
            </div>
            {!! Form::close() !!}
            <!-- ページネート  -->
            {{ $admin->appends(request()->input())->links('pagination::default') }}
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
                  <p>氏名</p>
                </th>
                <th>
                  <p>@sortablelink('department', '部署')</p>
                </th>
                <th>
                  <p>@sortablelink('position', '役職')</p>
                </th>
                <th>
                  <p>メールアドレス</p>
                </th>
                <th>
                  <p>@sortablelink('created_at', '登録日')</p>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($admin as $v) { ?>
                <tr data-href="{{ route('admin.member.detail', $v)}}" class="clickable">
                  <td>
                    <p>{{ $v['id']}}</p>
                  </td>
                  <td>
                    <p>{{ !empty($v->status) ? $v->full_name : '仮登録'}}</p>
                  </td>
                  <td>
                    <p>{{ $v->department ? $v->department : '-'}}</p>
                  </td>
                  <td>
                    <p>{{ $v->position ? $v->position : '-'}}</p>
                  </td>
                  <td>
                    <p>{{ $v['email']}}</p>
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
              {{ $admin->appends(request()->input())->links('pagination::default') }}
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
