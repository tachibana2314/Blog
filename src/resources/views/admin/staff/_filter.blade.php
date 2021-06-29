{!! Form::open(['method' => 'get']) !!}
  <ul class="p-filter__list">
    <li class="p-filter__list__item">
      <div class="p-filter__list__item__label">対象店舗</div>
      <div class="p-filter__list__item__data">
        <div class="c-input--select">
          {{ Form::select('shop_id', ['' => 'すべて'] + $shops, $request->shop_id) }}
        </div>
      </div>
    </li>
    <li class="p-filter__list__item">
      <div class="p-filter__list__item__label">キーワード</div>
      <div class="p-filter__list__item__data">
        <div class="c-input">
          {!! Form::text('keyword', $request->keyword, ['placeholder' => 'キーワード']) !!}
        </div>
      </div>
    </li>
    <li class="p-filter__list__item p-filter__list__item--right">
      <div class="p-buttonWrap p-buttonWrap--right">
        <button type="submit" class="c-button c-button--accent">検索する</button>
      </div>
    </li>
  </ul>
{!! Form::close() !!}
