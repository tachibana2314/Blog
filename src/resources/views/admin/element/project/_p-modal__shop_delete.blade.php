<div class="p-remodal remodal" data-remodal-id="js-modal__shop_delete" data-remodal-options="hashTracking:true;">
  <button class="p-remodal__closeButton remodal-close" data-remodal-action="close"></button>
  <div class="p-remodal__layout">
    <div class="p-remodal__head">
      <h2 class="p-remodal__head__title">
        対象コンテンツを削除します
      </h2>
    </div>
    <div class="p-remodal__scroll">
      <section class="p-remodal__contents">
        <div class="p-remodal__body">
          <p>この動作は取り消せません。本当に削除しますか？</p>
        </div>
      </section>
    </div>
    <div class="p-remodal__foot">
      {{ Form::open(['route' => ['admin.shop.delete', $shop], 'method' => 'delete']) }}
      <div class="p-buttonWrap">
        <div data-remodal-action="close" class="c-button c-button--line">キャンセル</div>
        {{ Form::submit('削除する', ['class' => 'c-button c-button--alert' ]) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>