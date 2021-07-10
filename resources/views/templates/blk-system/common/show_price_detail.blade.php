
@switch($kind)
    @case(SC_PRODUCT_GROUP)
        <span class="price-new ml-1">{!! trans('product.price_group_chose') !!}</span>
        @break
    @default
        @if ($price == $priceFinal)
            <span class="price-new ml-1">{!! sc_currency_render($price) !!}</span>
        @else
            <span class="price-new ml-1">{!! sc_currency_render($priceFinal) !!}</span>
            <span class="price-old">{!!  sc_currency_render($price) !!}</span>
        @endif
@endswitch