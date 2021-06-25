<div class="p-tableSet__place">
  <p class="p-tableSet__place__count">
    全 {{ number_format($shops->total()) }} 件中 {{ number_format($shops->firstItem()) }}～{{ number_format($shops->lastItem()) }} 件目
  </p>
</div>
<div class="p-pagination">
  <div class="p-pagination__control">
    <a
      href="{{ $shops->appends($request->input())->previousPageUrl() }}"
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
        max="{{ $shops->lastItem() }}"
        value="{{ $shops->currentPage() }}"
      >

      {!! Form::hidden('shop_group_id', $request->shop_group_id) !!}
      {!! Form::hidden('shop_type', $request->shop_type) !!}
      {!! Form::hidden('keyword', $request->keyword) !!}
      {!! Form::close() !!}
    </div>
    <div class="p-pagination__body__parameter">/{{ number_format($shops->lastPage()) }}</div>
  </div>
  <div class="p-pagination__control">
    <a
      href="{{ $shops->appends($request->input())->nextPageUrl() }}"
      class="p-pagination__control__button--next"
    ></a>
  </div>
</div>
