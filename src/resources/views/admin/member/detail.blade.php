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
            <a class="btn_liner" href="{{ route('admin.member') }}"></a>
          </section>
          <!-- ボックス -->
          <div class="box layout">
            <div class="layout_data">
              <ul class="list head_140">
                <?php
                $head_list = [
                  '氏名' => $admin->full_name,
                  'フリガナ' => $admin->full_name_kana,
                  'メールアドレス' => $admin['email'],
                  '部署' => $admin['department'],
                  '役職' => $admin['position'],
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
                <div class="btnarea_right">
                  <a class="btn_liner" href="{{ route('admin.member.edit' , $admin) }}">この管理者情報を編集する</a>
                  @if($login_admin != $admin)
                    <div data-remodal-target="modal_delete_member" class="btn_red_delete">この管理者情報を削除する</div>
                    @include('admin.element.modal.modal_delete_member')
                  @endif
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
