{!! Form::open(['method' => 'get']) !!}
<div class="p-filter">
  <div class="p-filter__body">
   <ul class="p-filter__list">
      <li class="p-filter__list__item">
        <div class="p-filter__list__item__label">店舗グループ</div>
        <div class="p-filter__list__item__data">
          <div class="c-input--select">
            {{ Form::select('shop_group_id', $mShopGroups, $request->input('shop_group_id'), ['placeholder' => 'すべて']) }}
          </div>
        </div>
      </li>
      @if(!$is_virtual)
      <li class="p-filter__list__item">
        <div class="p-filter__list__item__label">店舗区分</div>
        <div class="p-filter__list__item__data">
          <div class="c-input--radio">
            {{ Form::radio('shop_type', '', empty($request->input('shop_type')), ['id' => 'shopType--all']) }}
            <label for="shopType--all">すべて</label>
            @foreach($shopTypes as $value => $dispName)
              {{ Form::radio('shop_type', $value, $value == $request->input('shop_type'), ['id' => 'shopType--0' . $value]) }}
              <label for="{{ 'shopType--0' . $value }}">{{ $dispName }}</label>
            @endforeach
          </div>
        </div>
      </li>
      @endif
      <li class="p-filter__list__item">
        <div class="p-filter__list__item__label">キーワード</div>
        <div class="p-filter__list__item__data">
          <div class="c-input">
            {{ Form::text('keyword', $request->input('keyword') ?? null, ['placeholder' => 'キーワード'])}}
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div class="p-filter__action">
    <div class="p-buttonWrap p-buttonWrap--auto">
      <button type="submit" class="c-button c-button--full c-button--accent">絞り込み</button>
    </div>
  </div>
</div>
{!! Form::close() !!}
