@if ($paginator->hasPages())
<div class="flex-c-m flex-w w-full p-t-38">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="javascript:void(0)" aria-disabled="true" class="disabled flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                    &lsaquo;
                </a>
            @else
                @php
                    parse_str(parse_url($paginator->previousPageUrl())['query'],$get_array);
                @endphp
                <a href="javascript:void(0)" data-page="{{$get_array['page']}}" class="shop-paginate flex-c-m how-pagination1 trans-04 m-all-7">
                    &lsaquo;
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="javascript:void(0)" aria-disabled="true" class="disabled flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                        {{ $element }}
                    </a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="javascript:void(0)" aria-disabled="true" class="disabled flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                                {{ $page }}
                            </a>
                        @else
                            <a href="javascript:void(0)" data-page="{{ $page }}"  class="shop-paginate flex-c-m how-pagination1 trans-04 m-all-7">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                @php
                    parse_str(parse_url($paginator->nextPageUrl())['query'],$get_array);
                @endphp
                <a href="javascript:void(0)" data-page="{{$get_array['page']}}" class="shop-paginate flex-c-m how-pagination1 trans-04 m-all-7">
                    &rsaquo;
                </a>
            @else
                <a href="javascript:void(0)" aria-disabled="true" class="disabled flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                    &rsaquo;
                </a>
            @endif
    </div>
@endif
