@if ($paginator->hasPages())
    <nav class="page-nav">
        @if(!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="extend prev">上一页</a>
        @endif

        {{-- Pagination Elements --}}
{{--        @foreach($elements as $element)--}}
{{--            @if(is_string($element))--}}
{{--                <span class="page-number current">{{$element}}</span>--}}
{{--            @endif--}}
{{--            --}}{{-- Array Of Links --}}
{{--            @if (is_array($element))--}}
{{--                @foreach ($element as $page => $url)--}}
{{--                    @if ($page == $paginator->currentPage())--}}
{{--                        <span class="page-number current">{{$page}}</span>--}}
{{--                    @else--}}
{{--                        <a href="{{ $url }}" class="page-number">{{ $page }}</a>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        @endforeach--}}

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="extend next">下一页</a>
        @endif
    </nav>
@endif
