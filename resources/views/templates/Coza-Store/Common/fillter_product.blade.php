<div class="flex-w flex-sb-m p-b-52">
    @php
        $categories = json_encode($modelCategory->categoryRecursive());
    @endphp
    <div class="flex-w flex-l-m filter-tope-group m-tb-10 filter-categories">

    </div>

    @if(isset($filterArrSort))
    <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter show-filter">
            <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
            <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
             Filter
        </div>

        <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
            <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
            <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
            Search
        </div>
    </div>
    
    <!-- Search product -->
    <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                <i class="zmdi zmdi-search"></i>
            </button>

            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
        </div>  
    </div>

    <!-- Filter -->
    <div class="panel-filter w-full p-t-10">
        @php
            $queries = request()->all();
            $params = [
                'categoryId'=>'',
                'filter_sort'=>'id_desc',
                'filter_price'=>'0'.'-'.bc_currency_value($filterArrPrice[1]),
                'filter_keyword'=>'',
                'filter_attribute' => '',
                'page'=>'1'
            ];
            if (isset($queries['filter_price'])) {
                $start = explode('-',$queries['filter_price']);
                $end = $start[1];
                $start = $start[0];
            }else{
                $start = bc_currency_value($filterArrPrice[0],bc_currency_rate());
                $end = bc_currency_value($filterArrPrice[1],bc_currency_rate());
            }
        @endphp
        <form action="" method="GET" id="sort_form">
            @foreach ($params as $key => $param)
                @if(array_key_exists($param, $queries))
                    <input type="hidden" id="{{ $key }}" name="{{ $key }}" value="{{ $queries[$key] }}">
                @else                        
                    <input type="hidden" id="{{ $key }}" name="{{ $key }}" value="{{ $param }}">
                @endif
            @endforeach
            <div class="wrap-filter flex-w bg6 w-full p-lr-20 p-t-25 p-lr-15-sm">
                <div class="filter-col1 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Sort By
                    </div>
                    <ul>
                        @foreach($filterArrSort as $key => $fillter)
                        <li class="p-b-6">
                            <a href="javascript:void(0)" class="filter-link stext-106 trans-04 shop-sort-by {{ $filter_sort == $key ? 'filter-link-active' : '' }}" data-sort="{{$key}}">
                                {{ trans('front.filters.'.$key) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-col2 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Price
                    </div>
                    <div class="p-lr-20">
                        <div id="sliderDouble" class="slider slider-primary mt-3 noUi-target noUi-ltr noUi-horizontal"></div>
                        <div class="row m-t-20">
                            <div class="col-md-4 p-0">
                                <input type="text" id="price_min" class="form-control p-tb-3" value="" placeholder="min">
                            </div>
                            <div class="col-md-4 p-0">
                                <input type="text" id="price_max" class="form-control p-tb-3" value="" placeholder="max">
                            </div>
                            <div class="col-md-4 p-0">
                                <a href="javascript:void(0)" class="flex-c-m stext-107 cl6 bor4 p-lr-15 hov-tag1 hov-tag1-active trans-04 shop-sort-price">
                                    Find
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-col3 p-r-15 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Color
                    </div>

                    <div class="dis-flex flex-wrap">

                        @foreach($filterArrAttribute as $att)
                            <div class="m-lr-5 m-tb-5">
                                <div style="background: {{ $att  }};" class="point-color shop-sort-attribute pointer"  data-attribute="{{ $att  }}">
                                    
                                </div>
                            </div>
                        @endforeach
                        <div class="m-lr-5 m-tb-5">
                            <div style="background: #fff;" class="text-center point-color shop-sort-attribute pointer"  data-attribute="">                                
                                <i class="zmdi zmdi-close fs-25"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-col4 p-b-27">
                    <div class="mtext-102 cl2 p-b-15">
                        Tags
                    </div>

                    <div class="flex-w p-t-4 m-r--5">
                        <a href="javascript:void(0)" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 shop-sort-keyword 
                        {{ $filter_keyword == '' ? 'hov-tag1-active' : '' }}" 
                        data-keyword="">
                            All
                        </a>
                        @foreach($filterArrKeyword as $key => $keyword)
                            <a href="javascript:void(0)" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 shop-sort-keyword 
                            {{ $filter_keyword == $keyword ? 'hov-tag1-active' : '' }}" 
                            data-keyword="{{$keyword}}">
                                {{$keyword}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
</div>
@if(isset($filterArrSort))
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile.'/css/nouislider.css') }}">
        <style type="text/css">
            .point-color{
                width: 22px;
                height: 22px;
                border-radius: 50%;
            }
        </style>
    @endpush
    @push('scripts')
        @include($bc_templatePath.'.Common.category_fillter_js')
        <script src="{{ asset($bc_templateFile.'/js/nouislider.js') }}"></script>
        <script src="{{ asset($bc_templateFile.'/js/wNumb.js') }}"></script>
        <script type="text/javascript">
            initSliders({{$start}},{{$end}},{{bc_currency_value($filterArrPrice[0])}},{{bc_currency_value($filterArrPrice[1])}},'{{bc_currency_symbol()}}','sliderDouble');
        </script>
    @endpush
@else
    @push('scripts')
        @include($bc_templatePath.'.Common.category_fillter_js')
    @endpush
@endif