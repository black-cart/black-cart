@php
/*
$layout_page = home
*/ 
@endphp

@extends($sc_templatePath.'.layout')
@php
$productsNew = $modelProduct->start()->getProductLatest()->setlimit(sc_config('product_top'))->getData();
$news = $modelNews->start()->setlimit(sc_config('item_top'))->getData();
@endphp

@section('block_main')
      <!-- New Products-->
      <div class="section">
        <div class="container">
          <div class="row">
            <div class="col-md-10 mx-auto text-center">
              <h3 class="desc my-5">{{ trans('front.products_new') }}</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                @foreach ($productsNew as $key => $productNew)
                  <div class="col-lg-3 col-md-6">
                    <div class="card card-product card-plain card-primary">
                      <div class="card-image">
                        {{-- Product type --}}
                        @if ($productNew->price != $productNew->getFinalPrice() && $productNew->kind !=SC_PRODUCT_GROUP)
                          <span class="badge badge-success pos-absolute">{{ trans('front.products_special') }}</span>
                        @elseif($productNew->kind == SC_PRODUCT_BUILD)
                          <span class="badge badge-danger pos-absolute">{{ trans('front.products_build') }}</span>
                        @elseif($productNew->kind == SC_PRODUCT_GROUP)
                          <span class="badge badge-info pos-absolute">{{ trans('front.products_group') }}</span>
                        @endif
                        {{-- //Product type --}}

                        {{-- Product image --}}
                        <a href="{{ $productNew->getUrl() }}">
                          <img class="w-100" src="{{ asset($productNew->getThumb()) }}" alt="{{ $productNew->name }}">
                        </a>
                        {{--// Product image --}}
                      </div>
                      <div class="card-body">
                        @if (sc_config_global('MultiVendorPro') && config('app.storeId') == SC_ID_ROOT)
                          <div class="store-url"><a href="{{ $productNew->goToStore() }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ trans('front.store').' '. $productNew->store_id  }}</a>
                          </div>
                        @endif
                        <div class="card-header">
                            {{-- wishlist, compare --}}
                            <button onClick="addToCartAjax('{{ $productNew->id }}','wishlist','{{ $productNew->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="left" data-original-title="Remove from wishlist">
                              <i class="tim-icons icon-heart-2"></i>
                            </button>
                            <button onClick="addToCartAjax('{{ $productNew->id }}','compare','{{ $productNew->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="top" data-original-title="Compare">
                              <i class="tim-icons icon-puzzle-10"></i>
                            </button>
                            {{-- //wishlist, compare --}}
                            @if ($productNew->allowSale())
                              <button onClick="addToCartAjax('{{ $productNew->id }}','default','{{ $productNew->store_id }}')" class="btn btn-danger btn-neutral btn-icon btn-round" rel="tooltip" title="" data-placement="right" data-original-title="{{trans('front.add_to_cart')}}">
                                <i class="tim-icons icon-cart"></i>
                              </button>
                            @endif
                        </div>

                       {{-- Product name --}}
                        <a href="{{ $productNew->getUrl() }}">
                          <h4 class="card-title">{{ $productNew->name }}</h4>
                        </a>
                        {{-- //Product name --}}
                        <div class="card-footer">
                          <div class="price-container">
                            <span class="price">{!! $productNew->showPrice() !!}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end card -->
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
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

@section('news')
  @if ($news)
  <!-- Our Blog-->
  <div class="testimonials-1 section-image">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto mr-auto text-center">
          <h2 class="title">{{ trans('front.blog') }}</h2>
        </div>
      </div>
      <div id="carousel-testimonials" class="carousel slide carousel-team">
        <div class="carousel-inner">
          @foreach ($news as $key => $blog)
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
              <div class="container">
                <div class="row">
                  <div class="col-md-5 mr-auto">
                    <div class="space-100"></div>
                    <h3 class="card-title"> {{ $blog->title }} </h3>
                    <h3 class="text-warning">• • •</h3>
                    <h4 class="description">
                      {!! \Illuminate\Support\Str::limit($blog->content, 200) !!}
                    </h4>
                    <a href="{{ $blog->getUrl() }}" class="btn btn-warning">Read more</a>
                  </div>
                  <div class="col-md-6 ml-auto">
                    <img class="d-block" src="{{ asset($blog->getThumb()) }}" alt="Second slide">
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-testimonials" role="button" data-slide="prev">
          <i class="tim-icons icon-minimal-left"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-testimonials" role="button" data-slide="next">
          <i class="tim-icons icon-minimal-right"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  @endif
@endsection

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')

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
