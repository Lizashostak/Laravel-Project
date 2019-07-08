<style>
    .pager {
        margin: 0 0 3.75rem;
        font-size: 0;
        text-align: center;
    }
    .pager__item {
        display: inline-block;
        vertical-align: top;
        font-size: 1rem;
        font-weight: bold;
        margin: 0 2px;
    }
    .pager__item.active .pager__link {
        background-color: #fb9f95;
        border-color: #fb9f95;
        color: #fff;
        text-decoration: none;
    }
    .pager__item--prev svg, .pager__item--next svg {
        width: 8px;
        height: 12px;
    }
    .pager__item--next .pager__link svg {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        -webkit-transform-origin: center center;
        transform-origin: center center;
    }
    .pager__link {
        position: relative;
        border-radius: 30px;
        display: block;
        text-align: center;
        color: #2f3640;
        text-decoration: none;
        transition: 0.3s;
        padding: 10px;
    }
    .pager__link:hover, .pager__link:focus, .pager__link:active {
        background-color: #fb9f95;
        border-color: #fb9f95;
        color: #fff;
        text-decoration: none;
    }
    .pager__link:hover svg path, .pager__link:focus svg path, .pager__link:active svg path {
        fill: #fff;
    }
    .pager .pager__item.active + .pager__item .pager__link, .pager .pager__item:hover + .pager__item .pager__link {
        border-left-color: #fb9f95;
    }

    @media screen and (max-width: 576px) {
        .pager__item {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        .pager__item.active, .pager__item:first-of-type, .pager__item:last-of-type, .pager__item:nth-of-type(2), .pager__item:nth-last-of-type(2) {
            position: initial;
            top: initial;
            left: initial;
        }
        .pager__item.active + li {
            position: initial;
            top: initial;
            left: initial;
        }

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
<ul class="pagination pager" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="pager__item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span class="pager__link" aria-hidden="true">&lsaquo;</span>
    </li>
    @else
    <li class="pager__item">
        <a class="pager__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="page-item disabled" aria-disabled="true"><span class="pager__link">{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="pager__item active" aria-current="page"><span class="pager__link">{{ $page }}</span></li>
    @else
    <li class="pager__item"><a class="pager__link" href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li class="pager__item">
        <a class="pager__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
    </li>
    @else
    <li class="pager__item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <span class="pager__link" aria-hidden="true">&rsaquo;</span>
    </li>
    @endif
</ul>
@endif
