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
              <p class="h1 ttl">商品管理</p>
            </div>
            <div class="btnarea">
              <a href="{{ route('admin.product.add') }}" class="btn_ico_plus">商品を追加する</a>
              <a href="{{ route('admin.product.order') }}" class="btn_line_navy">商品の表示順を設定する</a>
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
                    <p class="count" data-after="products">{{ number_format($product->total()) }}</p>
                  </div>
                  <!-- フィルタ  -->
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
                          <p class="ttl">カテゴリー</p>
                          <div class="wrap_input wrap_select">
                            {!! Form::select('m_product_category_id', $m_product_category, null, ['placeholder' => 'カテゴリーを選択', 'id' => 'm_product_category_id'])!!}
                          </div>
                        </li>
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
                        <a href="{{ route('admin.product') }}" class="btn_gray_reset">リセット</a>
                        <div class="">{{Form::submit('適用する',['class'=>'btn_apply'])}}</div>
                      </div>
                    </section>
                  </div>
                  {!! Form::close() !!}
                  <!-- ページネート  -->
                  {{ $product->appends(request()->input())->links('pagination::default') }}
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
                        <p>商品名</p>
                      </th>
                      <th>
                        <p>@sortablelink('m_product_category_id', 'カテゴリ')</p>
                      </th>
                      <th>
                        <p>@sortablelink('price', '価格')</p>
                      </th>
                      <th>
                        <p>@sortablelink('status', 'ステータス')</p>
                      </th>
                      <th>
                        <p>@sortablelink('favoritesCount', 'お気に入り数')</p>
                      </th>
                      <th>
                        <p>@sortablelink('created_at', '登録日')</p>
                      </th>
                      <th>
                        <p>商品QR生成</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($product as $v) { ?>
                      <tr data-href="{{ route('admin.product.detail', $v)}}" class="clickable">
                        <td>
                          <p>{{ $v['id']}}</p>
                        </td>
                        <td>
                          <div class="img" style="background: url({{ $v->getImageLabel()->url }}) no-repeat center center;background-size: cover;"></div>
                        </td>
                        <td>
                          <p>{{ $v['name']}}</p>
                        </td>
                        <td>
                          <p>{{ $v->category->name}}</p>
                        </td>
                        <td>
                          <p>{{ $v['price']}}</p>
                        </td>
                        <td>
                          <p class="{{ $v->setStatusClass() }}"></p>
                        </td>
                        <td>
                          <p>{{ $v->getfavoriteCountLabel()}}</p>
                        </td>
                        <td>
                          <p>{{ date('Y.m.d', strtotime($v->created_at)) }}</p>
                        </td>
                        <td>
                          <div class="btnarea">
                            <a href="{{ route('admin.product.qrGenerate', $v) }}" class="btn_navy">QR生成</a>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="foot_table">
                  <!-- コントロールエリア(上と共通)  -->
                  <div class="area_control_table">
                    <!-- ボタンエリア -->
                    <div class="btnarea">
                      <a href="{{ route('admin.product.productExport') }}" class="btn_navy">CSVで出力</a>
                    </div>
                    <!-- ページネート  -->
                    {{ $product->appends(request()->input())->links('pagination::default') }}
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
