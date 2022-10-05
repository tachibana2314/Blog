@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')
  <!-- ボディ_メイン  -->
 <!-- ボディ_メイン  -->
 <section class="body_main">
  <div class="container">
    <div class="layout_detail">
      <!-- メイン -->
      <div class="layout_main">
        <section class="area_back_page">
          <a class="btn_liner" href="{{ route('admin.stamp') }}"></a>
        </section>
        <!-- ボックス -->
        <div class="box layout">
          <div class="layout_data">
            <div>
              <ul class="list head_140">
              <?php
              $head_list = [
                'カード名' => $stamp_card->title,
                '説明' => nl2br($stamp_card->description),
                '交換可能スタンプ数' => $stamp_card->stamp_count,
                '利用期間' => $stamp_card->start_date . ' - ' . $stamp_card->end_date,
              ];
              foreach ($head_list as $key => $val) {
                ?>
                <li>
                  <div class="head">
                    <p class="ttl"><?= $key; ?></p>
                  </div>
                  <div class="data">
                    <p class="<?php if ($key === 'タイトル') {
                      echo 'large';
                    }; ?>"><?= $val; ?></p>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
            <div class="l_3">
              <div class="box">
                <div class="body_box">
                  <p class="h4" style="margin: 0 0 12px;">ステータス</p>
                  <p class="{{ $stamp_card->setStatusClass() }}_large_full"></p>
                </div>
              </div>
            </div>
            <div class="btnarea_right">
              <a class="btn_liner" href="{{ route('admin.stamp.card_edit' , $stamp_card) }}">スタンプカード情報を編集する</a>
              <div data-remodal-target="modal_delete_stamp_card" class="btn_red_delete">スタンプカード情報を削除する</div>
              @include('admin.element.modal.modal_delete_stamp_card')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- フット_メイン -->
  <section class="foot_main"></section>
@endsection
