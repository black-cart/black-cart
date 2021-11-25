@switch($kind)
    @case(BC_PRODUCT_GROUP)
        @if(!$detail)
            <span class="stext-105 cl3">{!! trans('product.price_group') !!}</span>
        @endif
        @break
    @default
        <div class="product_price">
        @if ($price == $priceFinal)
            @if(!$detail)
                <span class="stext-105 cl3">{!! bc_currency_render($price) !!}</span>
            @else
                <span class="mtext-106 cl2 prod-price">
                    <span class="mtext-106 cl2">{!! bc_currency_render($price) !!}</span>
                    <span class="clr-pri"></span>
                    <span class="siz-pri"></span>
                </span>
            @endif
        @else
            @if(!$detail)
                <span class="stext-105 text-dange">{!! bc_currency_render($priceFinal) !!}</span>
                <span class="stext-109 cl3"><del>{!! bc_currency_render($price) !!}</del></span>
                @else
                    <span class="mtext-106 cl2">{!! bc_currency_render($priceFinal) !!}</span> 
                    <span class="stext-109 cl3"><del>{!! bc_currency_render($price) !!}</del></span>

                    <span class="clr-pri"></span>
                    <span class="siz-pri"></span>
            @endif
        @endif
        </div>
@endswitch