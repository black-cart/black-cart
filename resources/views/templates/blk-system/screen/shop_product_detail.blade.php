@php
/*
$layout_page = shop_product_detail
**Variables:**
- $product: no paginate
- $productRelation: no paginate
*/
@endphp

@extends($sc_templatePath.'.layout')
{{-- block_main --}}
@section('block_main')
      <!-- Single Product-->
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12 ">
              <div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
                <ol class="carousel-indicators mt-5">
                @if ($product->images->count())
                      @foreach ($product->images as $key=>$image)
                        <li data-target="#productCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                      @endforeach
                @elseif($product->kind == SC_PRODUCT_GROUP)
                    @php
                    $groups = $product->groups
                    @endphp
                    @foreach ($groups as $key => $group)
                      <li data-target="#productCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                    @endforeach
                @else
                  <li data-target="#productCarousel" data-slide-to="1" class="active"></li>
                @endif
                </ol>
                <div class="carousel-inner" role="listbox">
                  @if ($product->images->count())
                    @foreach ($product->images as $key=>$image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                      <img class="d-block" src="{{ asset($image->getImage()) }}" alt="First slide">
                    </div>
                    @endforeach
                  @elseif($product->kind == SC_PRODUCT_GROUP)
                    @php
                    $groups = $product->groups
                    @endphp
                    @foreach ($groups as $key => $group)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                      <a target=_blank href="{{ $group->product->getUrl() }}">
                        <a target=_blank href="{{ $group->product->getUrl() }}">
                          <img class="d-block" src="{{ asset($group->product->image) }}" alt="First slide">
                        </a>
                      </a>
                    </div>
                    @endforeach
                  @else
                    <div class="carousel-item active">
                      <img class="d-block" src="{{ asset($product->image) }}" alt="First slide">
                    </div>
                  @endif
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                  <button type="button" class="btn btn-warning btn-icon btn-round btn-sm" name="button">
                    <i class="tim-icons icon-minimal-left"></i>
                  </button>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                  <button type="button" class="btn btn-warning btn-icon btn-round btn-sm" name="button">
                    <i class="tim-icons icon-minimal-right"></i>
                  </button>
                </a>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 mx-auto">
              <h2 class="title">{{ $product->name }}</h2>
              <h5 class="category">SKU: {{ $product->sku }}</h5>
              <div class="stats stats-right">
                <div class="stars text-warning">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="far fa-star"></i>
                  <p class="d-inline">(76 customer reviews)</p>
                </div>
              </div>
              <br>
              <h2 class="main-price">{!! $product->showPriceDetail() !!}</h2>
              {{-- date available --}}
              @if (sc_config('product_available') && $product->date_available >= date('Y-m-d H:i:s'))
                <h5 class="category text-danger">
                    {{ trans('product.date_available') }}: {{ $product->date_available }}
                </h5>
              @endif
              {{--// date available --}}
              {{-- Stock info --}}
              @if (sc_config('product_stock'))
                <h5 class="category">{{ trans('product.stock_status') }}:
                  @if($product->stock <=0 && !sc_config('product_buy_out_of_stock'))
                  {{ trans('product.out_stock') }} 
                  @else 
                  {{ trans('product.in_stock') }}
                  @endif 
                </h5>
              @endif
              {{--// Stock info --}}

              {{-- Category info --}}
              <h5 class="category">{{ trans('product.category') }}: 
                @foreach ($product->categories as $category)
                  <a href="{{ $category->getUrl() }}">{{ $category->getTitle() }}</a>,
                @endforeach
              </h5>
              {{--// Category info --}}

              {{-- Brand info --}}
              @if (sc_config('product_brand') && !empty($product->brand->name))
              <h5 class="category">
                  {{ trans('product.brand') }}: {!! empty($product->brand->name) ? 'None' : '<a href="'.$product->brand->getUrl().'">'.$product->brand->name.'</a>' !!}
              </h5>
              @endif
              {{--// Brand info --}}

              {{-- Go to store --}}
              @if (sc_config_global('MultiVendorPro') && config('app.storeId') == SC_ID_ROOT)
              <h5 class="category">
                <a href="{{ $product->goToStore() }}"><i class="tim-icons icon-bag-16"></i> {{ trans('front.store').' '. $product->store_id  }}</a>
              </h5>
              @endif
              {{-- End go to store --}}

              <form action="{{ sc_route('cart.add') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <input type="hidden" name="storeId" value="{{ $product->store_id }}" />
                <div class="row pick-size">
                  <div class="col-lg-4 col-md-4">
                    @if ($product->kind != SC_PRODUCT_GROUP && $product->allowSale())
                      <label>Quantity</label>
                      <div class="input-group">
                        <div class="input-group-btn">
                          <button type="button" id="down" class="btn btn-warning btn-round btn-simple" onclick="down('0')"><i class="tim-icons icon-simple-delete"></i></button>
                        </div>
                        <input type="text" id="myNumber" name="qty" class="form-control input-number" value="1">
                        <div class="input-group-btn">
                          <button type="button" id="up" class="btn btn-warning btn-round btn-simple" onclick="up('100')"><i class="tim-icons icon-simple-add"></i></button>
                        </div>
                      </div>
                    @endif
                  </div>
                  {{-- Show attribute --}}
                  @if (sc_config('product_property'))
                      @if ($product->attributes())
                      {!! $product->renderAttributeDetails() !!}
                      @endif
                  @endif
                  {{--// Show attribute --}}
                </div>
                <br>
                {{-- Product kind --}}
                  @if ($product->kind == SC_PRODUCT_BUILD)
                  <h5 class="category">{{ trans('product.builds') }} :</h5>
                  <div class="row mb-2">
                    @php
                    $builds = $product->builds
                    @endphp
                      @foreach ($builds as $k => $build)
                        <div class="col-md-2 pl-1 pr-1">
                          <span class="badge badge-danger pos-absolute">{{ $build->quantity }}</span>
                          <a target="_new" href="{{ $build->product->getUrl() }}">{!! sc_image_render($build->product->image) !!}</a>
                        </div>
                      @endforeach
                  </div>
                  @endif
                {{-- Product kind --}}
                {{-- Button add to cart --}}
                @if ($product->kind != SC_PRODUCT_GROUP && $product->allowSale())
                  <div class="row justify-content-start">
                      <button type="submit" class="btn btn-warning ml-3">{{ trans('front.add_to_cart') }} <i class="tim-icons icon-cart"></i></button>
                  </div>
                @else
                  <span class="badge badge-info pos-absolute">{{ trans('front.products_group') }}</span>
                @endif
              </form>
              {{--// Button add to cart --}}
            </div>
          </div>
        </div>
      </div>
      {{-- Render connetnt --}}
      <div class="container">
        <div class="row">
          <!-- Nav tabs -->
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs nav-tabs-primary" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                    <i class="tim-icons icon-spaceship"></i> {{ trans('product.description') }}
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <!-- Tab panes -->
              <div class="tab-content tab-space">
                <div class="tab-pane active" id="link1">
                  {!! sc_html_render($product->content) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--// Render connetnt --}}
      @if ($productRelation->count())
      <!-- Related Products-->
      <div class="section related-products">
        <div class="container">
          <div class="col-md-8">
            <h2 class="title">You may also like </h2>
          </div>
          <div class="row">
            @foreach ($productRelation as $key => $product_rel)
            <div class="col-lg-3 col-md-6">
              <div class="card card-product">
                <div class="card-image">
                  @if ($product_rel->price != $product_rel->getFinalPrice() && $product_rel->kind !=SC_PRODUCT_GROUP)
                    <span class="badge badge-success pos-absolute">{{ trans('front.products_special') }}</span>
                  @elseif($product_rel->kind == SC_PRODUCT_BUILD)
                    <span class="badge badge-danger pos-absolute">{{ trans('front.products_build') }}</span>
                  @elseif($product_rel->kind == SC_PRODUCT_GROUP)
                    <span class="badge badge-info pos-absolute">{{ trans('front.products_group') }}</span>
                  @endif
                  <a href="{{ $product_rel->getUrl() }}">
                    <img class="img rounded w-100" src="{{ asset($product_rel->getThumb()) }}" alt="{{ $product_rel->name }}">
                  </a>
                </div>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="{{ $product_rel->getUrl() }}" class="card-link text-white">{{ $product_rel->name }}</a>
                  </h4>
                  <div class="card-footer">
                    <div class="price-container">
                      <span class="price">{!! $product_rel->showPrice() !!}</span>
                    </div>
                  </div>
                  <div class="card-header">
                    <button onClick="addToCartAjax('{{ $product_rel->id }}','wishlist','{{ $product_rel->store_id }}')" 
                      class="btn btn-neutral btn-warning btn-icon btn-round" rel="tooltip" title="" data-placement="left" data-original-title="Add to wishlist">
                      <i class="tim-icons icon-heart-2"></i>
                    </button>
                    <button onClick="addToCartAjax('{{ $product_rel->id }}','compare','{{ $product_rel->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="top" data-original-title="Compare">
                      <i class="tim-icons icon-puzzle-10"></i>
                    </button>
                    @if ($product_rel->allowSale())
                      <button onClick="addToCartAjax('{{ $product_rel->id }}','default','{{ $product_rel->store_id }}')" 
                        class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="right" data-original-title="{{trans('front.add_to_cart')}}">
                          <i class="tim-icons icon-cart"></i>
                      </button>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif

{{-- Render include view --}}
@if (!empty($layout_page && $includePathView = config('sc_include_view.'.$layout_page, [])))
@foreach ($includePathView as $view)
  @if (view()->exists($view))
    @include($view)
  @endif
@endforeach
@endif
{{--// Render include view --}}


<!--/product-details-->
@endsection
{{-- block_main --}}


{{-- breadcrumb --}}
@section('breadcrumb')
@php
    $bannerProductDetail = $modelBanner->start()->getBannerProductDetail()->getData()->first();
    $banner = $bannerProductDetail['image'];
    $paper = $bannerProductDetail['title'];
@endphp
<div class="page-header page-header-small">
  <img src="{{ asset($banner ?? 'data/banner/shape-s.png') }}" class="path shape">
  <div class="container pl-0 pr-0">
    <h1 class="h1-seo">{{ trans($paper ?? 'front.product_detail')}}</h1>
    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
        @if (sc_config_global('MultiVendorPro') && config('app.storeId') == SC_ID_ROOT)
          <li class="breadcrumb-item"><a href="{{ $goToStore }}">{{ sc_store('title', $product->store_id) }}</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
{{-- //breadcrumb --}}


@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
<script src="{{ asset($sc_templateFile.'/js/plugins/bootstrap-selectpicker.js')}}"></script>
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
