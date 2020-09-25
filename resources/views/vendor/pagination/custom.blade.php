@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item mx-1 disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><a class="page-link rounded border-0 shadow-sm px-3" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            @else
                <li class="page-item mx-1" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><a class="page-link rounded border-0 shadow-sm px-3" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item mx-1 disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item mx-1 active" aria-current="page"><span class="page-link rounded border-0 shadow-sm px-3">{{ $page }}</span></li>
                        @else
                            <li class="page-item mx-1"><a class="page-link rounded border-0 shadow-sm px-3" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item mx-1"><a class="page-link rounded border-0 shadow-sm px-3" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><span aria-hidden="true">»</span></a></li>
            @else
                <li class="page-item mx-1 disabled" aria-disabled="true" aria-label="@lang('pagination.next')"><a class="page-link rounded border-0 shadow-sm px-3" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
            @endif
        </ul>
    </nav>
@endif
