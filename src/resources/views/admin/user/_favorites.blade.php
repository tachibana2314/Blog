<!-- お気に入り商品一覧 -->
<div class="box">
  <div class="head_box">
    <h3 class="ttl h3">
      お気に入り商品一覧
      <span>({{ number_format($favorites->total()) }})</span>
    </h3>
  </div>
  <div class="body_box">
    <section class="area_table">
      <div class="body_table">
        <table class="table link">
          <thead>
            <tr>
              <?php
                $thead = [
                  '商品ID' => '',
                  '画像' => '',
                  '商品名' => '',
                  'カテゴリ' => '',
                  '価格 (＄)' => '',
                  'ステータス' => '',
                  'お気に入り登録数' => ''
                ];
                foreach ($thead as $key => $val) {
              ?>
                <th>
                  <p><?= $key; ?></p>
                </th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            @foreach ($favorites as $v)
              <tr data-href="{{ route('admin.product.detail', $v->product)}}" class="clickable">
                <td>
                  <p>{{ $v->product->id}}</p>
                </td>
                <td>
                  @if($v->product->getImageLabel())
                    <div
                      class="img"
                      style="background: url({{ $v->product->getImageLabel()->url }})"
                    ></div>
                  @endif
                </td>
                <td>
                  <p>{{ $v->product->name}}</p>
                </td>
                <td>
                  <p>{{ $v->product->category->name}}</p>
                </td>
                <td>
                  <p>{{ $v->product->price}}</p>
                </td>
                <td>
                  <p class="{{ $v->product->setStatusClass() }}"></p>
                </td>
                <td>
                  <p>{{ $v->product->getfavoriteCountLabel()}}</p>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="foot_table">
    <div class="area_control_table">
      <!-- ページネート  -->
      {{ $favorites->links('vendor.pagination.default') }}
    </div>
  </div>
</div>