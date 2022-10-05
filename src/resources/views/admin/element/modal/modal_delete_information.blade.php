<section class="remodal remodal_800" data-remodal-id="modal_delete_information">
  <!--   data-remodal-options="hashTracking: false" -->
  <section class="area_modal">
    <section class="box">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="head_box">
        <div class="area_ttl center">
          <p class="ttl h3">{{$information->title}}を削除</p>
        </div>
      </div>
      <div class="body_box">
        <div class="area_ttl center">
          <p class="description">削除すると復元はできません。お知らせを削除しますか?</p>
        </div>
      </div>
      <div class="foot_box">
        <div class="btnarea_center">
          <a data-remodal-action="cancel" class="btn_gray">閉じる</a>
          {{ Form::open(['route' => ['admin.information.delete', $information], 'method' => 'delete']) }}
          <a>{{ Form::submit('このお知らせ情報を削除する', ['class' => 'btn_red_delete' ]) }}</a>
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </section>
</section>
