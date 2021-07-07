<div class="row mx-0">
  <div class="col-12 text-center pb-4 pt-4">
    @if ($paginator->onFirstPage())
    @else
    <a href="{{ $paginator->previousPageUrl() }}" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
    @endif

    @foreach ($elements as $element)
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <a href="{{ $url }}" class="btn_pagging">{{ $page }}</a>
    @else
    <a href="{{ $url }}" class="btn_pagging">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
    @else
    @endif
  </div>
</div>
