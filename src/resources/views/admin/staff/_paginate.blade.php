<div class="p-tableSet__place">
  <p class="p-tableSet__place__count">
    全 {{ number_format($staffs->total()) }} 件中 {{ number_format($staffs->firstItem()) }}～{{ number_format($staffs->lastItem()) }} 件目
  </p>
</div>
<div class="p-pagination">
  <div class="p-pagination__control">
    <a
      href="{{ $staffs->appends($request->input())->previousPageUrl() }}"
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
        max="{{ $staffs->lastItem() }}"
        value="{{ $staffs->currentPage() }}"
      >
      {!! Form::hidden('shop_id', $request->shop_id) !!}
      {!! Form::hidden('keyword', $request->keyword) !!}
      {!! Form::close() !!}
    </div>
    <div class="p-pagination__body__parameter">/{{ number_format($staffs->lastPage()) }}</div>
  </div>
  <div class="p-pagination__control">
    <a
      href="{{ $staffs->appends($request->input())->nextPageUrl() }}"
      class="p-pagination__control__button--next"
    ></a>
  </div>
</div>
