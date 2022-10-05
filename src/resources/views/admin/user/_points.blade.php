<!-- ポイント履歴一覧 -->
<div class="box">
  <div class="head_box">
    <h3 class="ttl h3">
      ポイント履歴
      <span>({{ number_format($points->total()) }})</span>
    </h3>
  </div>
  <div class="body_box">
    <section class="area_table">
      <div class="body_table">
        <table class="table">
          <thead>
            <tr>
              <?php
                $thead = [
                  '区分' => '',
                  'ポイント' => '',
                  '利用期限' => '',
                  '景品' => '',
                  '登録日時' => '',
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
            @foreach ($points as $point)
              <tr>
                <td>
                  <p>{{ $point->type_label }}</p>
                </td>
                <td>
                  <p>
                    @if($point->type == \App\Models\Point::TYPE_ACQUIRE)
                      {{ $point->amount }}
                    @elseif($point->type == \App\Models\Point::TYPE_USE)
                      {{ (-1) * $point->use }}
                    @endif
                  </p>
                </td>
                <td>
                  <p>
                    @if($point->type == \App\Models\Point::TYPE_ACQUIRE)
                      {{ $point->expired_at ? date('Y/m/d H:i:s', strtotime($point->expired_at)) : null }}
                    @endif
                  </p>
                </td>
                <td>
                  @if(
                    $point->type == \App\Models\Point::TYPE_USE &&
                    $point->point_gift
                  )
                    <a
                            href="{{ route('admin.point_gift.detail', $point->point_gift) }}"
                            style="text-decoration: underline;"
                    >
                      {{ data_get($point, 'point_gift.name') }}
                    </a>
                  @endif
                </td>
                <td>
                  <p>{{ date('Y/m/d H:i:s', strtotime($point->created_at)) }}</p>
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
      {{ $points->links('vendor.pagination.default') }}
    </div>
  </div>
</div>