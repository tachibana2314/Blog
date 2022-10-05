<section class="remodal remodal_1000" data-remodal-id="modal_delete_product">
  <!--   data-remodal-options="hashTracking: false" -->
  <section class="area_modal">
    <section class="box">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="head_box">
        <div class="area_ttl center">
          <p class="ttl h3">{{$product->name}}を削除</p><br>
        </div>
      </div>
      <div class="body_box">
        <div class="area_ttl center">
          <p class="description">削除すると復元はできません。この商品を削除しますか?</p>
        </div>
      </div>
      <div class="foot_box">
        <div class="btnarea_center">
          <a data-remodal-action="cancel" class="btn_liner_thick">閉じる</a>
          {{ Form::open(['route' => ['admin.product.delete', $product], 'method' => 'delete']) }}
          <a>{{ Form::submit('この商品情報を削除する', ['class' => 'btn_red_delete_full_thick' ]) }}</a>
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </section>
</section>
