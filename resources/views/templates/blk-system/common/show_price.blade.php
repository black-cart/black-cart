@switch($kind)
    @case(SC_PRODUCT_GROUP)
    <div class="price-new ml-1">{!! trans('product.price_group') !!}</div>
        @break
    @default
        @if ($price == $priceFinal)
            <div class="product-old">{!! sc_currency_render($price) !!}</div>
        @else
            <div class="price-old">{!!  sc_currency_render($price) !!}</div>
            <div class="price-new ml-1">{!! sc_currency_render($priceFinal) !!}</div>
        @endif
@endswitch