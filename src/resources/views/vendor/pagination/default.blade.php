<div class="area_pager">
    <div class="count_pager">
        <p class="children">{{ $paginator->lastItem() }}</p>
        <p class="parameter">{{$paginator->total()}}</p>
    </div>
    @if ($paginator->hasPages())
    <ul class="list_pager" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="disabled prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true"></span>
        </li>
        @else
        <li class='prev'>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"></a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="current" aria-current="page"><a href="{{ $url }}">{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class='next'>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"></a>
        </li>
        @else
        <li class="disabled " aria-disabled="true" aria-label="@lang('pagination.next')">
            {{-- <span aria-hidden="true">&rsaquo;</span> --}}
        </li>
        @endif
    </ul>
    @endif
</div>
