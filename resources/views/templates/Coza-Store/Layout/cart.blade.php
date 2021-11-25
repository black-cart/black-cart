<!-- Cart -->
@php
  $carts = Cart::instance('default');
  $carts_content = $carts->content();
@endphp
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8 w-100">
            @if($carts_content->isEmpty())
                <span class="mtext-103 cl2 text-danger cart_title">
                    {{trans('cart.cart_empty')}}
                </span>
            @else
                <span class="mtext-103 cl2 cart_title">
                    {{trans('cart.your_cart')}}
                </span>
            @endif
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full carts__content">
                @if(!$carts_content->isEmpty())
                    @include($bc_templatePath.'.Common.cart_items',['carts' => $carts_content])
                @endif
            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-10">
                    {{ trans('cart.total_price') }}: <span class="cart-total-amount">{!! bc_currency_render($carts->total) !!}</span>
                </div>
                <div class="header-cart-total w-full p-b-20">
                    {{ trans('cart.total_item') }}: <span class="cart-total-item">{{ $carts->count() }}</span>
                </div>

                <div class="header-cart-buttons w-full">
                    <a href="{{ bc_route('checkout') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('breadcrumb')