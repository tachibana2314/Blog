<li class="banngo" id="sortdata">
  <article>
    <div class="box layout head_80 transparent">
      <div class="layout_head sett">
        <div class="img_slide sett" style="background: url({{ $product->getImageLabel()->url }})"></div>
      </div>
      <div class="layout_body">
        <ul class="list head_100">
          {{ Form::hidden('products[][id]', $product->id) }}
          <li>
            <div class="head">
              <p class="ttl">商品名</p>
            </div>
            <div class="data">
              <p>{{ $product->name }}</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </article>
</li>
