<section class="remodal remodal_800" data-remodal-id="modal_delete_user">
  <!--   data-remodal-options="hashTracking: false" -->
  <section class="area_modal">
    <section class="box">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="head_box">
        <div class="area_ttl center">
          <p class="ttl h3">{{$user->nickname}}を削除</p>
        </div>
      </div>
      <div class="body_box">
        <div class="area_ttl center">
          <p class="description">削除すると復元はできません。顧客を削除しますか?</p>
        </div>
      </div>
      <div class="foot_box">
        <div class="btnarea_center">
          <a data-remodal-action="cancel" class="btn_gray">閉じる</a>
          {{ Form::open(['route' => ['admin.user.delete', $user], 'method' => 'delete']) }}
          <a>{{ Form::submit('この顧客情報を削除する', ['class' => 'btn_red_delete']) }}</a>
          {{ Form::close() }}
        </div>
      </div>
    </section>
  </section>
</section>
