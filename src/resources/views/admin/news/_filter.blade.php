{!! Form::open(['method' => 'get']) !!}
  <ul class="p-filter__list">
    <li class="p-filter__list__item">
      <div class="p-filter__list__item__label">カテゴリー</div>
      <div class="p-filter__list__item__data">
        <div class="c-input--select">
          {{-- {{ Form::select('text_category_id', ['' => 'すべて'] + $textCategories, $request->text_category_id) }} --}}
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
    <li class="p-filter__list__item">
      <div class="p-filter__list__item__label">コンテンツ区分</div>
      <div class="p-filter__list__item__data">
        <div class="c-input--radio">
          {{ Form::radio('content_type', 0, !$request->content_type ? true : false, ['id' => "shopType--0"]) }}
          {{ Form::label("shopType--0", 'すべて') }}
          @foreach(\App\Models\News::CONTENT_TYPE_LIST as $radio_key => $radio_value)
            {{ Form::radio('content_type', $radio_key, $request->content_type == $radio_key ? true : false, ['id' => "shopType--{$radio_key}"]) }}
            {{ Form::label("shopType--{$radio_key}", $radio_value) }}
          @endforeach
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
