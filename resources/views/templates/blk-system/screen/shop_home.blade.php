@php
/*
$layout_page = shop_home
**Variables:**
- $products: paginate
Use paginate: $products->appends(request()->except(['page','_token']))->links()
*/ 
@endphp

@extends($sc_templatePath.'.layout')

{{-- block_main_content_center --}}
@section('block_main_content_center')
@include($sc_templatePath.'.block_main_content_left')
  {{-- Product list --}}
  <div class="col-md-12 p-0">
    <div class="row">
      {{-- Sort filter --}}
        <div class="col-md-6">
          <div class="title mt-0">
            <h5>{!! trans('front.result_item', ['item_from' => $products->firstItem(), 'item_to'=> $products->lastItem(), 'item_total'=> $products->total()  ]) !!}</h5>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-5">
              <div class="dropdown bootstrap-select">
                  <form action="" method="GET" id="filter_sort">
                    @php
                    $queries = request()->except(['filter_sort','page']);
                    @endphp
                    @foreach ($queries as $key => $query)
                    <input type="hidden" name="{{ $key }}" value="{{ $query }}">
                    @endforeach
                    <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-simple" title="Single Select" tabindex="-98" name="filter_sort">
                        <option value="" disabled selected>{{ trans('front.filters.sort') }}</option>
                        <option value="price_asc" {{ ($filter_sort =='price_asc')?'selected':'' }}>
                            {{ trans('front.filters.price_asc') }}
                        </option>
                        <option value="price_desc" {{ ($filter_sort =='price_desc')?'selected':'' }}>
                            {{ trans('front.filters.price_desc') }}
                        </option>
                        <option value="sort_asc" {{ ($filter_sort =='sort_asc')?'selected':'' }}>
                            {{ trans('front.filters.sort_asc') }}
                        </option>
                        <option value="sort_desc" {{ ($filter_sort =='sort_desc')?'selected':'' }}>
                            {{ trans('front.filters.sort_desc') }}
                        </option>
                        <option value="id_asc" {{ ($filter_sort =='id_asc')?'selected':'' }}>
                          {{ trans('front.filters.id_asc') }}
                        </option>
                        <option value="id_desc" {{ ($filter_sort =='id_desc')?'selected':'' }}>
                            {{ trans('front.filters.id_desc') }}
                        </option>
                    </select>
                  </form>
              </div>
            </div>
          </div>
        </div>
        {{-- //Sort filter --}}
    </div>
    <div class="row">
      @foreach ($products as $key => $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="card card-product card-plain card-primary">
            <div class="card-image">
              {{-- Product type --}}
              @if ($product->price != $product->getFinalPrice() && $product->kind !=SC_PRODUCT_GROUP)
                <span class="badge badge-success pos-absolute">{{ trans('front.products_special') }}</span>
              @elseif($product->kind == SC_PRODUCT_BUILD)
                <span class="badge badge-danger pos-absolute">{{ trans('front.products_build') }}</span>
              @elseif($product->kind == SC_PRODUCT_GROUP)
                <span class="badge badge-info pos-absolute">{{ trans('front.products_group') }}</span>
              @endif
              {{-- //Product type --}}

              {{-- Product image --}}
              <a href="{{ $product->getUrl() }}">
                <img class="w-100" src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}">
              </a>
              {{--// Product image --}}
            </div>
            <div class="card-body">
              @if (sc_config_global('MultiVendorPro') && config('app.storeId') == SC_ID_ROOT)
                <div class="store-url"><a href="{{ $product->goToStore() }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ trans('front.store').' '. $product->store_id  }}</a>
                </div>
              @endif
              <div class="card-header">
                  {{-- wishlist, compare --}}
                  <button onClick="addToCartAjax('{{ $product->id }}','wishlist','{{ $product->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="left" data-original-title="Remove from wishlist">
                    <i class="tim-icons icon-heart-2"></i>
                  </button>
                  <button onClick="addToCartAjax('{{ $product->id }}','compare','{{ $product->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="top" data-original-title="Compare">
                    <i class="tim-icons icon-puzzle-10"></i>
                  </button>
                  {{-- //wishlist, compare --}}
                  @if ($product->allowSale())
                    <button onClick="addToCartAjax('{{ $product->id }}','default','{{ $product->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="right" data-original-title="{{trans('front.add_to_cart')}}">
                      <i class="tim-icons icon-cart"></i>
                    </button>
                  @endif
              </div>

             {{-- Product name --}}
              <a href="{{ $product->getUrl() }}">
                <h4 class="card-title">{{ $product->name }}</h4>
              </a>
              {{-- //Product name --}}
              <div class="card-footer">
                <div class="price-container">
                  <span class="price">{!! $product->showPrice() !!}</span>
                </div>
              </div>
            </div>
          </div>
          <!-- end card -->
        </div>
      @endforeach
    </div>
    <ul class="pagination justify-content-center mt-5">
      {{ $products->appends(request()->except(['page','_token']))->links() }}
    </ul>
  </div>
  {{-- //Product list --}}
        @section('blockStoreLeft')
        {{-- Categories tore --}}
        {{-- Only show category store if shop home is not primary store --}}
        @if (config('app.storeId') != SC_ID_ROOT && function_exists('sc_vendor_get_categories_front') &&  count(sc_vendor_get_categories_front(config('app.storeId'))))
        <div class="col-md-4">
          <h6 class="aside-title">{{ trans('front.categories_store') }}</h6>
          <ul class="list-shop-filter">
            @foreach (sc_vendor_get_categories_front(config('app.storeId')) as $key => $category)
            <li class="product-minimal-title active"><a href="{{ $category->getUrl() }}"> {{ $category->getTitle() }}</a></li>
            @endforeach
          </ul>
        </div>
        @endif
        {{-- //Categories tore --}}
@endsection
{{-- //block_main_content_center --}}





{{-- Render include view --}}
@if (!empty($layout_page && $includePathView = config('sc_include_view.'.$layout_page, [])))
@foreach ($includePathView as $view)
  @if (view()->exists($view))
    @include($view)
  @endif
@endforeach
@endif
{{--// Render include view --}}

@endsection

{{-- breadcrumb --}}
@section('breadcrumb')
@php
  $bannerStore = $modelBanner->start()->getBannerStore()->getData()->first();
  $bannerImage = $bannerStore['image'] ?? 'data/banner/shape-s.png';
@endphp
<div class="page-header page-header-small">
  <img src="{{ asset($bannerImage) }}" class="path shape">
  <div class="container pl-0 pr-0">
    <h1 class="h1-seo">{{ $title ?? '' }}</h1>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
        </ol>
    </nav>
  </div>
</div>
@endsection
{{-- //breadcrumb --}}
@push('styles')
  <style type="text/css">
    .my-cus-card{
      border: 1px solid #1f2251;
      box-shadow: inset -1px -5px 10px -2px;
    }
    .hide-scr-bar::-webkit-scrollbar {
        display: none;
    }
    .my-cus-bgr{
      background-size: contain!important;
      background-repeat: no-repeat;
    }
    .card-blog{
      height: auto;
      min-height: unset;
      margin: 15px 0px 15px 0px;
    }
  </style>
@endpush
@push('scripts')
<script src="{{ asset($sc_templateFile.'/js/plugins/bootstrap-selectpicker.js')}}"></script>
<script type="text/javascript">
  $('[name="filter_sort"]').change(function(event) {
      $('#filter_sort').submit();
  });
</script>

{{-- Render include script --}}
@if (!empty($layout_page) && $includePathScript = config('sc_include_script.'.$layout_page, []))
@foreach ($includePathScript as $script)
  @if (view()->exists($script))
    @include($script)
  @endif
@endforeach
@endif
{{--// Render include script --}}

@endpush