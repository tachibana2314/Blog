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
            <a class="btn_line_navy" href="{{ route('admin.information')}}"></a>
          </section>
          <!-- ボックス -->
          <div class="l">
            <div class="l_9">
              <div class="box">
                <div class="l nowrap">
                  @if(isset($information->pic_path))
                    <div class="l_6 gap">
                      <div class="main_gallery">
                        <div class="img" style="background: url({{ $information->url }})"></div>
                      </div>
                    </div>
                    <div class=" l_6">
                      <ul class="list head_120">
                        <li>
                          <div class="data">
                            <p>{{ $information->title }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="data">
                            <p> {!! nl2br($information->body) !!}</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  @else
                    <div class=" l_12">
                      <ul class="list head_120">
                        <li>
                          <div class="data">
                            <p>{{ $information->title }}</p>
                          </div>
                        </li>
                        <li>
                          <div class="data">
                            <p> {!! nl2br($information->body) !!}</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="l_3">
              <div class="box">
                <!-- ステータス -->
                <div class="body_box">
                  <p class="h4" style="margin: 0 0 12px;">ステータス</p>
                  <p class="{{ $information->setStatusClass() }}_large_full"></p>
                </div>
                <div class="foot_box">
                  <ul class="list head_120">
                    <li>
                      <div class="head">
                        <p class="ttl">公開日</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d', strtotime($information->release_date)) }}</p>
                      </div>
                    </li>
                    @if(Arr::get($information, 'product'))
                      <li>
                        <div class="head">
                          <p class="ttl">対象商品</p>
                        </div>
                        <div class="data">
                          <p>{{ $information->product->name }}</p>
                        </div>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
              <!-- お知らせコントロール -->
              <div class="box transparent">
                <div class="body_box">
                  <div class="btnarea_right">
                    <a class="btn_liner_full_thick" href="{{ route('admin.information.edit', $information) }}">このお知らせを編集する</a>
                    <div data-remodal-target="modal_delete_information" class="btn_red_delete_full_thick">このお知らせを削除する</div>
                    @include('admin.element.modal.modal_delete_information')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- フット_メイン -->
          <section class="foot_main"></section>
        @endsection
