<li class="banngo" id="sortdata">
  <article>
    <div class="box layout head_80 transparent">
      <div class="layout_head sett">
        <div class="img_slide sett" style="background: url({{ $point_gift->getImageLabel()->url }})"></div>
      </div>
      <div class="layout_body">
        <ul class="list head_100">
          {{ Form::hidden('point_gifts[][id]', $point_gift->id) }}
          <li>
            <div class="head">
              <p class="ttl">ポイント景品名</p>
            </div>
            <div class="data">
              <p>{{ $point_gift->name }}</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </article>
</li>
