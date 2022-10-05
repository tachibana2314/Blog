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
              <a class="btn_line_navy" href="{{ route('admin.point_gift.index')}}"></a>
            @endif
          </section>
          <!-- ボックス -->
          <div class="l">
            <div class="l_9">
              <div class="box">
                <div class="l nowrap">
                  <div class="l_6 gap">
                    <div class="main_gallery">
                      <div class="img" style="background: url({{ $point_gift->getImageLabel()->url }})"></div>
                    </div>
                  </div>
                  <div class=" l_6">
                    <ul class="list head_120">
                      <li>
                        <div class="head">
                          <p class="ttl">ポイント景品ID</p>
                        </div>
                        <div class="data">
                          <p>{{ $point_gift->id }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">景品名</p>
                        </div>
                        <div class="data">
                          <p>{{ $point_gift->name }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">ポイント</p>
                        </div>
                        <div class="data">
                          <p>{{ $point_gift->point }}</p>
                        </div>
                      </li>
                      <li>
                        <div class="head">
                          <p class="ttl">説明</p>
                        </div>
                        <div class="data">
                          <p>{!! nl2br($point_gift->description) !!}</p>
                        </div>
                      </li>
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
                  <p class="{{ $point_gift->setStatusClass() }}_large_full"></p>
                </div>
                <div class="foot_box">
                  <ul class="list head_120">
                    <li>
                      <div class="head">
                        <p class="ttl">更新日時</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d', strtotime($point_gift->updated_at)) }}</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="box transparent">
                <div class="body_box">
                  <div class="btnarea_">
                    <a class="btn_liner_full_thick" href="{{ route('admin.point_gift.edit', $point_gift) }}">ポイント景品情報を編集する</a>
                    <div data-remodal-target="modal_delete_point_gift" class="btn_red_delete_full_thick">このポイント景品情報を削除する</div>
                    @include('admin.element.modal.modal_delete_point_gift')
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
