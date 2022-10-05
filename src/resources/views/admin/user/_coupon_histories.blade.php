<!-- クーポン履歴 -->
<div class="box">
  <div class="head_box">
    <h3 class="ttl h3">
      誕生日クーポン履歴
      <span>({{ number_format($coupon_histories->total()) }})</span>
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
                  'クーポンID' => '',
                  'クーポン名' => '',
                  '画像' => '',
                  'クーポン商品' => '',
                  'クーポン利用日' => '',
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
            @foreach ($coupon_histories as $history)
              @if($history->coupon_id)
                @include('admin.user._coupon', [
                  'history' => $history,
                  'coupon' => $history->coupon,
                ])
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="foot_table">
    <div class="area_control_table">
      <!-- ページネート  -->
      {{ $coupon_histories->links('vendor.pagination.default') }}
    </div>
  </div>
</div>