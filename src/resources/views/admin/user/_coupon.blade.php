<tr data-href="{{ route('admin.coupon.detail', $coupon)}}" class="clickable">
  <td>
    <p>{{ $coupon->id }}</p>
  </td>
  <td>
    <p>{{ $coupon->title }}</p>
  </td>
  <td>
    @if(
      data_get($coupon, 'product') &&
      $coupon->product->getImageLabel()
    )
      <div
        class="img"
        style="background: url({{ $coupon->product->getImageLabel()->url }}) no-repeat center center;background-size: cover;"
      ></div>
    @endif
  </td>
  <td>
    <p>{{ $coupon->product->name }}</p>
  </td>
  <td>
    <p>{{ date('Y.m.d H:i', strtotime($history->created_at)) }}</p>
  </td>
</tr>