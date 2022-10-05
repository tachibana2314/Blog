@extends('admin.element.app_admin')

@section('main_class', 'main')

@section('content')

  <section class="body_main">
    <div class="container">
      <div class="area_masters">
        <!-- ページエリア -->
        <section class="area_page">
          <section class="head_page">
            <div class="area_ttl_page">
              <div class="text">
                <p class="h1 ttl">表示順設定</p>
              </div>
            </div>
          </section>
          <section class="body_page">
            <div class="layout col">
              <!-- マスターエリア -->
              <div class="box">
                <div class="head_box col">
                  {{ Form::open(['method' => 'get']) }}
                  <div class="area_ttl">
                    <div class="wrap_input wrap_select">
                      {!! Form::select('m_point_gift_category_id', $m_point_gift_category, $category->id, ['placeholder' => 'カテゴリーを選択', 'onChange'=>'submit()'])!!}
                    </div>
                  </div>
                  {{ Form::close() }}
                  <div class="area_description">
                    <p class="description">
                      ドラッグ&ドロップで順序を変更できます。変更したら
                      <span class="bold">更新ボタンを押してください。</span>
                    </p>
                  </div>
                </div>
                {{ Form::open(['route' => 'admin.point_gift.orderStore']) }}
                <div class="body_box">
                  <div class="area_slide">
                    <ul class="list_slide" id="sortableArea">
                      @foreach ($point_gifts as $point_gift)
                        @include('admin.point_gift.order._point_gift', ['point_gift' => $point_gift])
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="foot_box">
                  <div class="btnarea_center">
                    {{ Form::button('表示順序を更新する', ['type' => 'sumit', 'class' => 'btn_navy_thick_large']) }}
                  </div>
                </div>
                {{ Form::close() }}
              </div>
              <div class="box transparent">
              </div>
              <div class="box transparent">
              </div>
            </div>
          </section>
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
  <section class="foot_main"></section>
@endsection
