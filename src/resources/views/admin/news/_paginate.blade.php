<div class="p-tableSet__place">
  <p class="p-tableSet__place__count">
    全 {{ number_format($newses->total()) }} 件中 {{ number_format($newses->firstItem()) }}～{{ number_format($newses->lastItem()) }} 件目
  </p>
</div>
<div class="p-pagination">
  <div class="p-pagination__control">
    <a
      href="{{ $newses->previousPageUrl() }}"
      class="p-pagination__control__button--prev"
    ></a>
  </div>
  <div class="p-pagination__body">
    <div class="c-input">
      {!! Form::open(['method' => 'get']) !!}
      <input
        type="number"
        name="page"
        placeholder="1"
        min="0"
        max="{{ $newses->lastItem() }}"
        value="{{ $newses->currentPage() }}"
      >
      {!! Form::hidden('text_category_id', $request->text_category_id) !!}
      {!! Form::hidden('keyword', $request->keyword) !!}
      {!! Form::hidden('content_type', $request->content_type) !!}
      {!! Form::close() !!}
    </div>
    <div class="p-pagination__body__parameter">/{{ number_format($newses->lastPage()) }}</div>
  </div>
  <div class="p-pagination__control">
    <a
      href="{{ $newses->nextPageUrl() }}"
      class="p-pagination__control__button--next"
    ></a>
  </div>
</div>
