@extends('admin.element.app_admin')

@section('main_class', 'main')
@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="layout_detail">
        <!-- メイン -->
        <div class="layout_main">
          <section class="area_back_page">
            @if($url)
            <a class="btn_line_navy" href="{{ $url }}"></a>
            @else
            <a class="btn_line_navy" href="{{ route('admin.product')}}"></a>
            @endif
          </section>
          <!-- ボックス -->
          <div class="l">
            <div class="l_9">
              <div class="box">
                <div class="l nowrap">
                  <div class="l_6 gap">
                    <div class="main_gallery">
                      <div class="img" style="background: url({{ $product->getImageLabel()->url }})"></div>
                    </div>
                    <ul class="list_gallery">
                      @foreach ($product->pictures as $picture)
                        <li>
                          <article>
                            <div class="img" style="background: url({{ $picture->url }})"></div>
                          </article>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class=" l_6">
                    <ul class="list head_120">
                      <li>
                        <div class="head">
                          <p class="ttl">商品ID</p>
                        </div>
                        <div class="data">
                          <p>{{ $product->id }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">商品名</p>
                        </div>
                        <div class="data">
                          <p>{{ $product->name }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">カテゴリ</p>
                        </div>
                        <div class="data">
                          <p>{{ $product->category->name }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">価格 (＄)</p>
                        </div>
                        <div class="data">
                          <p>{{ $product->price }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">商品説明</p>
                        </div>
                        <div class="data">
                          <p>{!! nl2br($product->description) !!}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">オンライン</p>
                        </div>
                        <div class="data">
                          <p>{{ $product->getOnlineFlgLabel() }}</p>
                        </div>
                      </li>
                      @isset($product->limited_flg)
                        <li>
                          <div class="head">
                            <p class="ttl">期間限定商品</p>
                          </div>
                          <div class="data">
                            <p>{!! nl2br($product->getLimitedFlgLabel()) !!}</p>
                          </div>
                        </li>
                        <li>
                          <div class="head">
                            <p class="ttl">期間</p>
                          </div>
                          @isset($product->start_date)
                            <div class="data">
                              <p>{{ date('Y.m.d', strtotime($product->start_date)) }}</p>
                            </div>
                          @endisset
                          <span class="">〜</span>
                          @isset($product->end_date)
                            <div class="data">
                              <p>{{ date('Y.m.d', strtotime($product->end_date)) }}</p>
                            </div>
                          @endisset
                        </li>
                        @isset($product->release_date)
                          <li>
                            <div class="head">
                              <p class="ttl">公開日</p>
                            </div>
                            <div class="data">
                              <p>{{ date('Y.m.d', strtotime($product->release_date)) }}</p>
                            </div>
                          </li>
                        @endisset
                      @endisset
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="l_3">
              <div class="box">
                <!-- ステータス -->
                <div class="body_box">
                  <p class="h4" style="margin: 0 0 12px;">ステータス</p>
                  <p class="{{ $product->setStatusClass() }}_large_full"></p>
                </div>
                <div class="foot_box">
                  <ul class="list head_120">
                    <li>
                      <div class="head">
                        <p class="ttl">更新日時</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d', strtotime($product->updated_at)) }}</p>
                      </div>
                    </li>
                    <li>
                      <div class="head">
                        <p class="ttl">お気に入り数</p>
                      </div>
                      <div class="data">
                        <p class="">{{$favorites_count}}</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="box transparent">
                <div class="body_box">
                  <div class="btnarea_">
                    <a class="btn_liner_full_thick" href="{{ route('admin.product.edit', $product) }}">商品情報を編集する</a>
                    <div data-remodal-target="modal_delete_product" class="btn_red_delete_full_thick">この商品情報を削除する</div>
                    @include('admin.element.modal.modal_delete_product')
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="l">
            <div class="l_12">
              <div class="box">
                <div class="head_box">
                  <h3 class="ttl h3">お気に入り登録ユーザー<span>({{$favorites_count}})</span></h3>
                </div>
                <div class="body_box">
                  <!-- テーブルエリア -->
                  <section class="area_table">
                    <table class="table link">
                      <thead>
                        <tr>
                          <?php
                          $thead = [
                            '顧客ID' => '',
                            'ニックネーム' => '',
                            // '性別' => '',
                            '生年月日' => '',
                            'メールアドレス' => '',
                            '最終ログイン' => '',
                            '登録日' => ''
                          ];
                          foreach ($thead as $key => $val) {
                            ?>
                            <th>
                              <p><?= $key; ?></p>
                            </th>
                            <?php } ?>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($favorites as $v)
                            <tr data-href="{{ route('admin.user.detail', $v->user)}}" class="clickable">
                              <td>
                                <p>{{ $v->user->id}}</p>
                              </td>
                              <td>
                                <p>{{ $v->user->nickname}}</p>
                              </td>
                              {{-- <td>
                                <p>{{ $v->user->getGenderLabelAttribute()}}</p>
                              </td> --}}
                              <td>
                                <p>{{ $v->user->birthday}}</p>
                              </td>
                              <td>
                                <p>{{ $v->user->email}}</p>
                              </td>
                              <td>
                                <p>{{ $v->user->logged_in_at}}</p>
                              </td>
                              <td>
                                <p>{{ $v->user['created_at']->format('Y.m.d') ? $v->user['created_at']->format('Y.m.d') :'-'}}</p>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      <div class="foot_table">
                        <div class="area_control_table">
                          <!-- ページネート  -->
                          {{ $favorites->links('vendor.pagination.default') }}
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- フット_メイン -->
    <section class="foot_main"></section>
  @endsection
