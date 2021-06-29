<section class="remodal" data-remodal-id="modal_contact_in_{{$contact->id}}" data-options="830 delete">
  <div class="l-overview js-target__overview">
    <div class="p-overview">
      <div class="p-overview__control">
        <div class="p-overview__control__close js-trigger__overview--close">
          <p class="c-text__sub">× 閉じる</p>
        </div>
      </div>
      <div class="p-overview__body">
        <ul class="p-list">
        <li>
          <div class="p-list__label">
            ステータス
          </div>
          <div class="p-list__data">
            <div class="c-input--radio c-input--radio--label">
              <input type="radio" name="contactStatus" id="contactStatus--backlog" checked="">
              <label class="label--error" for="contactStatus--backlog">未対応</label>
              <input type="radio" name="contactStatus" id="contactStatus--wip">
              <label for="contactStatus--wip">対応中</label>
              <input type="radio" name="contactStatus" id="contactStatus--closed">
              <label class="label--correct" for="contactStatus--closed">対応済</label>
            </div>
            <div class="p-buttonWrap p-buttonWrap--right">
              <a class="c-button c-button--accent">更新する</a>
            </div>
          </div>
        </li>
        <li class="p-list__line"></li>
        <li>
          <div class="p-list__label">
            カテゴリ
          </div>
          <div class="p-list__data">
            {{$contact['type']}}
          </div>
        </li>
        <li>
          <div class="p-list__label">
            お問合せ内容
          </div>
          <div class="p-list__data">
            {{$contact['content']}}
          </div>
        </li>
      </ul>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).on('click', '#submit', function () {
    $(this).attr('disabled');
  })
</script>
