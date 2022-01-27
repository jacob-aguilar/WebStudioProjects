@if ($paginator->hasPages())
@endif
    <nav aria-label="Page navigation example" class="mx-4" >
    <ul class="pagination pagination-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item "><span></span></li>
        @else
            <li  class="page-item"><a class="page-link"href="{{ $paginator->previousPageUrl()}}" rel="prev" tabindex="-1">Anterior</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item "><a class="page-link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item "><a class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li  class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente</a></li>
        @else
            <li class="page-item "><span ></span></li>
        @endif
    </ul>
</nav>

