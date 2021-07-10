@php
$arrProductsLastView = array();
$lastView = empty(\Cookie::get('productsLastView')) ? [] : json_decode(\Cookie::get('productsLastView'), true);
if ($lastView) {
    arsort($lastView);
}

if ($lastView && count($lastView)) {
    $lastView = array_slice($lastView, 0, sc_config('product_viewed'), true);
    $productsLastView = $modelProduct->start()->getProductFromListID(array_keys($lastView))->getData();
    foreach ($lastView as $pId => $time) {
        foreach ($productsLastView as $key => $product) {
            if ($product['id'] == $pId) {
                $product['timelastview'] = $time;
                $arrProductsLastView[] = $product;
            }
        }
    }
}
@endphp
@if (!empty($arrProductsLastView))
<div class="row vh-100 overflow-auto hide-scr-bar">
    <div class="col-md-12">
        @foreach ($arrProductsLastView as $product)
            <div class="col-lg-10 m-auto">
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
</div>
<!--/last_view_product-->
@endif
