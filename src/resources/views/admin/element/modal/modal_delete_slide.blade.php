<script>
$(document).on("click", ".btn_delete", function() {
  var ids = $(this).data('id');
  $(".btnarea_center #slide_delete").val(ids);
});
</script>


<section class="remodal remodal_800" data-remodal-id="modal_delete_slide_{{$v->id}}" data-remodal-options="hashTracking: false">
  <section class="area_modal">
    <section class="box">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="head_box">
        <div class="area_ttl center">
          <p class="ttl h3">このスライドを削除</p>
        </div>
      </div>
      <div class="body_box">
        <div class="area_ttl center">
          <p class="description">削除すると復元はできません。スライドを削除しますか?</p>
        </div>
      </div>
      <div class="foot_box">
        {!! Form::model($v, ['route' => ['admin.slide.delete', $v], 'method'=>'delete']) !!}
        <div class="btnarea_center">
          <a data-remodal-action="cancel" class="btn_gray">閉じる</a>
          <a>{{ Form::submit('このスライドを削除する', ['class' => 'btn_red_delete' ]) }}</a>
        </div>
        {{ Form::close() }}
      </div>
    </section>
  </section>
</section>
