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
              <p class="h1 ttl">顧客管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.user.add') }}" class="btn_ico_plus">顧客を追加する</a>
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
                    <p class="count" data-after="users">{{ number_format($user->total()) }}</p>
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
                              {!! Form::select('left_at', ['' => '選択してください']+CustomConst::USER_STATUS,old('left_at')) !!}
                            </div>
                          </div>
                        </li>
                      </ul>
                      <div class="btnarea_filter">
                        <a href="{{ route('admin.user') }}" class="btn_gray_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $user->appends(request()->query())->links('pagination::default') }}
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
                        <p>ニックネーム</p>
                      </th>
                      {{-- <th>
                        <p>@sortablelink('gender', '性別')</p>
                      </th> --}}
                      <th>
                        <p>生年月日</p>
                      </th>
                      <th>
                        <p>メールアドレス</p>
                      </th>
                      <th>
                        <p>@sortablelink('favoritesCount', 'お気に入り数')</p>
                      </th>
                      <th>
                        <p>@sortablelink('couponsCount', '誕生日クーポン使用数')</p>
                      </th>
                      <th>
                        <p>@sortablelink('left_at', 'ステータス')</p>
                      </th>
                      <th>
                        <p>@sortablelink('created_at', '登録日')</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $v)
                      <tr data-href="{{ route('admin.user.detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v['id']}}</p>
                        </td>
                        <td>
                          <p>{{ !empty($v->nickname) ? $v->nickname : '-'}}</p>
                        </td>
                        {{-- <td>
                          <p>{{ $v->getGenderLabelAttribute() ? $v->getGenderLabelAttribute() : '-'}}</p>
                        </td> --}}
                        <td>
                          <p>{{ $v->birthday ? $v->birthday : '-'}}</p>
                        </td>
                        <td>
                          <p>{{ $v->email ? $v->email : '-'}}</p>
                        </td>
                        <td>
                          <p>{{ $v->getfavoriteCountLabel() ?$v->getfavoriteCountLabel() : '0'}}</p>
                        </td>
                        <td>
                          <p>{{ $v->couponHistories->count() ?$v->couponHistories->count() : '0'}}</p>
                        </td>
                        <td>
                          <p class="{{ isset($v['left_at']) && $v['left_at'] ? 'status_gray' : 'status_green'}}" data-before="{{ isset($v['left_at']) && $v['left_at'] ? '退会済み' : 'アクティブ'}}"></p>
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
                <div class="area_control_table">
                  <!-- ボタンエリア -->
                  <div class="btnarea">
                    <a href="{{ route('admin.user.userExport') }}" class="btn_navy">CSVで出力</a>
                  </div>
                  <!-- ページネート  -->
                  {{ $user->appends(request()->query())->links('pagination::default') }}
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
