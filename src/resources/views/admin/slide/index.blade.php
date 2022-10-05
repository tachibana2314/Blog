@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
  <section class="body_main">
    <div class="container">
      <div class="area_masters">
        <!-- ページエリア -->
        <section class="area_page">
          <section class="head_page">
            <div class="area_ttl_page">
              <div class="text">
                <p class="h1 ttl">スライド管理</p>
              </div>
              <div class="btnarea">
                <a href="{{ route('admin.slide.add') }}" class="btn_ico_plus">スライドを追加する</a>
              </div>
            </div>
          </section>
          {{ Form::open(['route' => 'admin.slide']) }}
          <section class="body_page">
            <div class="layout col">
              <!-- マスターエリア -->
              <div class="box">
                <div class="head_box col">
                  <div class="area_ttl">
                    <h3 class="ttl h3">スライド一覧</h3>
                  </div>
                  <div class="area_description">
                    <p class="description">ドラッグ&ドロップで順序を変更できます。変更したら<span class="bold">更新ボタンを押してください。</span></p>
                  </div>
                </div>
                <div class="body_box">
                  <div class="area_slide">
                    <ul class="list_slide" id="sortableArea">
                      @foreach ($slide as $v)
                        <li id="sortdata">
                          <article>
                            <div class="box layout head_360 transparent">
                              <div class="layout_head">
                                <div class="img_slide" style="background: url({{ $v->slide_url}})"></div>
                              </div>
                              <div class="layout_body">
                                <ul class="list head_100">
                                  {{ Form::hidden('sort_slide[][id]', $v->id) }}
                                  <li>
                                    <div class="head">
                                      <p class="ttl">ステータス</p>
                                    </div>
                                    <div class="data">
                                      <p class="{{ $v->setStatusClass() }}"></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="head">
                                      <p class="ttl">種別</p>
                                    </div>
                                    <div class="data">
                                      <p>{{ $v->setTypeLabel()}}</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="head">
                                      <p class="ttl">スライド番号</p>
                                    </div>
                                    <div class="data">
                                      <p>{{ $v->order_label }}</p>
                                    </div>
                                  </li>
                                  @switch($v->type)
                                    @case($v->type = 1)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象お知らせ</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->information ? $v->information->title:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 2)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象商品</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->product ? $v->product->name:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 3)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象クーポン</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->coupon ? $v->coupon->title:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 4)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象店舗</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->store->name ? $v->store->name:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 5)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">外部リンク先</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v['url'] ? mb_substr($v['url'], 0, 20).'...':'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 6)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象スタンプカード</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->stamp->title ? $v->stamp->title:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                  @endswitch
                                  <li>
                                    <div class="head">
                                      <p class="ttl">公開期間</p>
                                    </div>
                                    <div class="data">
                                      <p class="">{{ $v->display_period }}</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="btnarea_right">
                                  <a href="{{ route('admin.slide.edit', $v) }}" class="btn_line_small_navy">編集</a>
                                  <div data-remodal-target="modal_delete_slide_{{$v->id}}" class=" btn_red_delete">削除</div>
                                  @include('admin.element.modal.modal_delete_slide')
                                </div>
                              </div>
                            </div>
                          </article>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="foot_box">
                  <div class="btnarea_center">
                    {{ Form::button('表示順序を更新する', ['type' => 'sumit', 'class' => 'btn_navy_thick_large']) }}
                  </div>
                </div>
              </div>
              <div class="box transparent">
              </div>
              <div class="box transparent">
              </div>

              <!-- マスターエリア -->
              {{-- <div class="box">
                <div class="head_box col">
                  <div class="area_ttl">
                    <h3 class="ttl h3">非公開のスライド</h3>
                  </div>
                </div>
                <div class="area_slide">
                  <ul class="list_slide private" id="">
                    @foreach ($slide_w as $v)
                      @if(isset( $v ))
                        <li>
                          <article>
                            <div class="box layout head_360 transparent">
                              <div class="layout_head">
                                <div class="img_slide" style="background: url({{ $v->slide_url}})"></div>
                              </div>
                              <div class="layout_body">
                                <ul class="list head_100">
                                  <li>
                                    <div class="head">
                                      <p class="ttl">ステータス</p>
                                    </div>
                                    <div class="data">
                                      <p class="{{ $v->setStatusClass() }}"></p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="head">
                                      <p class="ttl">種別</p>
                                    </div>
                                    <div class="data">
                                      <p>{{ $v->setTypeLabel()}}</p>
                                    </div>
                                  </li>
                                  @switch($v->type)
                                    @case($v->type = 1)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象お知らせ</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->information ? $v->information->title:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 2)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象商品</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->product ? $v->product->name:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 3)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象クーポン</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->coupon ? $v->coupon->title:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 4)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">対象店舗</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v->store->name ? $v->store->name:'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                    @case($v->type = 5)
                                    <li>
                                      <div class=" head">
                                        <p class="ttl">外部リンク先</p>
                                      </div>
                                      <div class="data">
                                        <p>{{ $v['url'] ? mb_substr($v['url'], 0, 20).'...':'-'}}</p>
                                      </div>
                                    </li>
                                    @break
                                  @endswitch
                                </ul>
                                <div class="btnarea_right">
                                  <a href="{{ route('admin.slide.edit', $v) }}" class="btn_line_small_navy">編集</a>
                                  <div data-remodal-target="modal_delete_slide_{{$v->id}}" class=" btn_red_delete">削除</div>
                                  @include('admin.element.modal.modal_delete_slide')
                                </div>
                              </div>
                            </div>
                          </article>
                        </li>
                      @endif
                    @endforeach
                  </ul>
                </div>
              </div> --}}
            </div>
          </section>
          {{ Form::close() }}
        </section>
      </div>
    </div>
  </section>
  <!-- ソート　順番スクリプト -->
  <script type="text/javascript">
  $(function() {
    $('#sortableArea').sortable();
  });
</script>
<!-- フット_メイン -->
<section class="foot_main"></section>
@endsection
