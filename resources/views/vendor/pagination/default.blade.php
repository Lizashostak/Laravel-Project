<style>
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #fb9f95;
        border-color: #fb9f95;
        font-weight: bold;
        font-size: 14px;
    }
    .pagination>li>a, .pagination>li>span {
        position: relative;
        float: none;
        transition: 0.3s;
        padding: 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: black;
        text-decoration: inherit;
        background-color: inherit;
        border: none;
        font-weight: bold;
        border-radius: 30px;
        margin: 5px;
        width: 10px;
        height: 40px;
        font-size: 14px;

    }
    .pagination>li:last-child>a, .pagination>li:last-child>span {
        border-top-right-radius: 30px; 
        border-bottom-right-radius: 30px; 
    }
    .pagination>li:first-child>a, .pagination>li:first-child>span {
        border-top-left-radius: 30px; 
        border-bottom-left-radius: 30px; 
    }

    .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
        z-index: 2;
        color: white;
        background-color: #fb9f95;
        border-color: #ddd;
    }
    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
        color: #777;
        cursor: allowed;
        background-color: none;
        border-color: #ddd;
        display: none;
    }
</style>

@if ($paginator->hasPages())
<ul class="pagination" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span aria-hidden="true">&lsaquo;</span>
    </li>
    @else
    <li>
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
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
    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li>
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
    </li>
    @else
    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <span aria-hidden="true">&rsaquo;</span>
    </li>
    @endif
</ul>
@endif
