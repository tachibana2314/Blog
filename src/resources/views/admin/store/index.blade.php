@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <!-- ページエリア  -->
      <section class="area_page">
        <section class="head_page">
          <div class="area_ttl_page">
            <div class="text">
              <p class="h1 ttl">店舗管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.store.add') }}" class="btn_ico_plus">店舗を追加する</a>
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
                    <p class="count" data-after="stores">{{ number_format($store->total()) }}</p>
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
                          <p class="ttl">カフェスペース</p>
                          <div class="wrap_input wrap_select">
                            {{ Form::select('cafe_flg', ['' => '選択してください','2' => '無し', '1' => '有り']) }}
                          </div>
                        </li>
                      </ul>
                      <ul class="list_filter">
                        <li>
                          <p class="ttl">ワインの取り扱い</p>
                          <div class="wrap_input wrap_select">
                            {{ Form::select('wine_flg', ['' => '選択してください','2' => '無し', '1' => '有り']) }}
                          </div>
                        </li>
                      </ul>
                      <ul class="list_filter">
                        <li>
                          <p class="ttl">焼き立て対象商品の取り扱い</p>
                          <div class="wrap_input wrap_select">
                            {{ Form::select('oven_flg', ['' => '選択してください','2' => '無し', '1' => '有り']) }}
                          </div>
                        </li>
                      </ul>
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
                        <a href="{{ route('admin.store') }}" class="btn_gray_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $store->appends(request()->input())->links('pagination::default') }}
                </div>
              </div>
              <div class="body_table">
                <table class="table link">
                  <thead>
                    <tr>
                      <th>
                        <p style="width:50px;">@sortablelink('id', 'ID')</p>
                      </th>
                      <th>
                        <p>店舗名</p>
                      </th>
                      <th>
                        <p>電話番号</p>
                      </th>
                      <th>
                        <p>住所</p>
                      </th>
                      <th>
                        <p style="width:70px;">@sortablelink('cafe_flg', 'カフェ')</p>
                      </th>
                      <th>
                        <p style="width:70px;">@sortablelink('wine_flg', 'ワイン')</p>
                      </th>
                      <th>
                        <p style="width:70px;">@sortablelink('oven_flg', '焼き立て')</p>
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
                    <?php foreach ($store as $v) { ?>
                      <tr data-href="{{ route('admin.store.detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v['id']}}</p>
                        </td>
                        <td>
                          <p style="">{{ !empty($v->name) ? $v->name : '-'}}</p>
                        </td>
                        <td>
                          <p style="">{{ $v['tel']}}</p>
                        </td>
                        <td>
                          <p>{{ $v['address']}}</p>
                        </td>
                        <td>
                          <p style="">{{ $v->getCafeFlgLabel() }}</p>
                        </td>
                        <td>
                          <p style="">{{ $v->getWineFlgLabel() }}</p>
                        </td>
                        <td>
                          <p style="">{{ $v->getOvenFlgLabel() }}</p>
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
                    {{ $store->appends(request()->input())->links('pagination::default') }}
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
