<section class="remodal remodal_800" data-remodal-id="modal_delete_member">
  <!--   data-remodal-options="hashTracking: false" -->
  <section class="area_modal">
    <section class="box">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="head_box">
        <div class="area_ttl center">
          <p class="ttl h3">{{$admin->full_name}}を削除</p><br>
        </div>
      </div>
      <div class="body_box">
        <div class="area_ttl center">
          <p class="description">削除すると復元はできません。この管理者を削除しますか?</p>
        </div>
      </div>
      <div class="foot_box">
        <div class="btnarea_center">
          <a data-remodal-action="cancel" class="btn_gray">閉じる</a>
          {{ Form::open(['route' => ['admin.member.delete', $admin], 'method' => 'delete']) }}
          {{ Form::submit('この管理者情報を削除する', ['class' => 'btn_red_delete']) }}
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </section>
</section>
