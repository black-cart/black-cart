
<!-- Block2 -->
<div class="block2">
    <div  
        @if ($product->price != $product->getFinalPrice() && $product->kind !=BC_PRODUCT_GROUP)
          class="block2-pic hov-img0 label-new" data-label="{{ trans('front.products_special') }}"
        @elseif($product->kind == BC_PRODUCT_BUILD)
          class="block2-pic hov-img0 label-new" data-label="{{ trans('front.products_build') }}"
        @elseif($product->kind == BC_PRODUCT_GROUP)
          class="block2-pic hov-img0 label-new" data-label="{{ trans('front.products_group') }}"
        @else
          class="block2-pic hov-img0"
        @endif >
        @php
          $image = explode(',', $product->image)[0];
        @endphp
        <img src="{{ bc_image_generate_thumb($image,270,345) }}" alt="{{ $product->name }}">
        <div class="flex-c-m block2-btn trans-04">
          <a href="javascript:void(0)" class="stext-103 cl2 bg0 hov-btn1 p-tb-5 m-lr-5 p-lr-10 trans-04 js-show-modal1" data-id="{{ $product->id }}" 
            data-storeId="{{$product->store_id}}">
              <i class="zmdi zmdi-eye"></i>
          </a>
          <a href="javascript:void(0)" class="stext-103 cl2 bg0 hov-btn1 p-tb-5 m-lr-5 p-lr-10 trans-04" 
          onClick="addToCartAjax(this,'{{ $product->id }}','default','{{ $product->store_id }}')">
              <i class="zmdi zmdi-shopping-cart-plus"></i>
          </a>
          <a href="javascript:void(0)" class="stext-103 cl2 bg0 hov-btn1 p-tb-5 m-lr-5 p-lr-10 trans-04" 
          onClick="addToCartAjax(this,'{{ $product->id }}','compare','{{ $product->store_id }}')">
              <i class="zmdi zmdi-compare"></i>
          </a>
        </div>
    </div>
    @if (bc_config_global('MultiVendorPro') && config('app.storeId') == BC_ID_ROOT)
      <div class="store-url">
        <a href="{{ $product->goToStore() }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> 
          {{ trans('front.store').' '. $product->store_id  }}
        </a>
      </div>
    @endif
    <div class="block2-txt p-t-14">
        <div class="justify-content-between d-flex">
            <a href="{{ $product->getUrl() }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" title="{{ $product->name }}">
                {{\Illuminate\Support\Str::limit($product->getName(), 30, ' ...')}}
            </a>
            <a href="javascript:void(0)" class="btn-addwish-b2 dis-block pos-relative" 
            onClick="addToCartAjax(this,'{{ $product->id }}','favorite','{{ $product->store_id }}')">
            @php
              $fav = Cart::instance('favorite')->search(function ($cartItem,$rowId) use($product){ 
                  return $cartItem->id == $product->id;
              });
            @endphp
            <i class="icon-heart1 dis-block trans-04 zmdi zmdi-favorite{{ ($fav->isEmpty() ? '-outline' : '') }} heart__{{ $product->id }}"></i>
            </a>
        </div>

        <div class="d-flex justify-content-between">            
            {!! $product->showPrice() !!}
            <span class="stext-104 cl4 p-b-6">{{ trans('product.sold').' '.$product->sold }}</span>
        </div>
    </div>
</div>  