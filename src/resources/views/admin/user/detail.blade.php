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
            <a class="btn_line_navy" href="{{ route('admin.user') }}"></a>
          </section>
          <!-- ボックス -->
          <div class="box">
            <div class="layout">
              <div class="layout_head">
                <ul class="list head_140">
                  <li>
                    <div class="head">
                      <p class="ttl">顧客ID</p>
                    </div>
                    <div class="data">
                      <p>{{ $user['id']}}</p>
                    </div>
                  </li>
                  <li>
                    <div class="head">
                      <p class="ttl">ニックネーム</p>
                    </div>
                    <div class="data">
                      <p>{{ $user->nickname}}</p>
                    </div>
                  </li>
                  {{-- <li>
                    <div class="head">
                      <p class="ttl">性別</p>
                    </div>
                    <div class="data">
                      <p>{{ $user-> getGenderLabelAttribute()}}</p>
                    </div>
                  </li> --}}
                  <li>
                    <div class="head">
                      <p class="ttl">生年月日</p>
                    </div>
                    <div class="data">
                      <p>{{ $user['birthday']}}</p>
                    </div>
                  </li>
                  <li>
                    <div class="head">
                      <p class="ttl">メールアドレス</p>
                    </div>
                    <div class="data">
                      <p style="width:300px;">{{ $user['email']}}</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="layout_data">
                <ul class="list head_140">
                  <li>
                    <div class="head">
                      <p class="ttl">所持ポイント</p>
                    </div>
                    <div class="data">
                      <p>{{ number_format($user->available_point) }}pt</p>
                    </div>
                  </li>
                  <li>
                    <div class="head">
                      <p class="ttl">登録日</p>
                    </div>
                    <div class="data">
                      <p>{{ date('Y.m.d', strtotime($user->created_at)) }}</p>
                    </div>
                  </li>
                  @isset($user->logged_in_at)
                    <li>
                      <div class="head">
                        <p class="ttl">最終ログイン</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d H:i', strtotime($user->logged_in_at)) }}</p>
                      </div>
                    </li>
                  @endisset
                  @isset($user->left_at)
                    <li>
                      <div class="head">
                        <p class="ttl">退会日時</p>
                      </div>
                      <div class="data">
                        <p>{{ date('Y.m.d H:i', strtotime($user->left_at)) }}</p>
                      </div>
                    </li>
                  @endisset
                </ul>
              </div>
            </div>
            <div class="btnarea_right">
              <a class="btn_liner" href="{{ route('admin.user.edit' , $user) }}">この顧客情報を編集する</a>
              <div data-remodal-target="modal_delete_user" class="btn_red_delete">この顧客情報を削除する</div>
              @include('admin.element.modal.modal_delete_user')
            </div>
          </div>
          @include('admin.user._favorites', [
            'favorites' => $favorites,
          ])
          @include('admin.user._coupon_histories', [
            'coupon_histories' => $coupon_histories,
          ])
          @include('admin.user._points', [
            'points' => $points,
          ])
        </div>
      </section>
      <!-- フット_メイン -->
      <section class="foot_main"></section>
    @endsection
