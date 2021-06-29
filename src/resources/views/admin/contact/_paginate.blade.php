<div class="p-tableSet__place">
  <p class="p-tableSet__place__count">
    全 {{ number_format($contacts->total()) }} 件中 {{ number_format($contacts->firstItem()) }}～{{ number_format($contacts->lastItem()) }} 件目
  </p>
</div>
<div class="p-pagination">
  <div class="p-pagination__control">
    <a
      href="{{ $contacts->appends($request->input())->previousPageUrl() }}"
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
        max="{{ $contacts->lastItem() }}"
        value="{{ $contacts->currentPage() }}"
      >
      {!! Form::hidden('shop_id', $request->shop_id) !!}
      {!! Form::hidden('keyword', $request->keyword) !!}
      {!! Form::close() !!}
    </div>
    <div class="p-pagination__body__parameter">/{{ number_format($contacts->lastPage()) }}</div>
  </div>
  <div class="p-pagination__control">
    <a
      href="{{ $contacts->appends($request->input())->nextPageUrl() }}"
      class="p-pagination__control__button--next"
    ></a>
  </div>
</div>
