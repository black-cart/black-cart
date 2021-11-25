<!-- Cart -->
@php
  $favorites = Cart::instance('favorite');
  $favorites_content = $favorites->content();
@endphp
<div class="wrap-header-cart js-panel-favorite">
    <div class="s-full js-hide-favorite"></div>

    <div class="header-cart flex-col-l p-l-25 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-lr-15 w-100">
            @if($favorites_content->isEmpty())
                <span class="mtext-103 cl2 text-danger favorites_title">
                    {{trans('front.empty_favorite')}}
                </span>
            @else
                <span class="mtext-103 cl2 favorites_title">
                    {{trans('front.favoriteslist')}}
                </span>
            @endif
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-favorite">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div class="header-cart-content flex-w js-pscroll  p-lr-15">
            <ul class="header-cart-wrapitem w-full favorites__content">
            @if(!$favorites_content->isEmpty())
                @foreach($favorites_content as $cart)
                    @php
                        $product = $modelProduct->start()->getDetail($cart->id, null, $cart->storeId);
                        $attrGroup = $modelAttributesGroup->getListAll();
                        if(!$product) {
                            continue;
                        }
                    @endphp
                    <li class="header-cart-item flex-w flex-t m-b-12 favorite__{{$product->id}}">
                        @include($bc_templatePath.'.Common.product',['product' => $product])
                    </li>
                @endforeach
            @endif
            </ul>
        </div>
        <div class="w-full p-lr-15 p-t-20">
            <div class="header-cart-buttons w-100">
                <a href="{{ bc_route('favorite') }}" class="flex-c-m stext-101 cl0 size-111 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                    View Collection
                </a>
            </div>
        </div>
    </div>
</div>