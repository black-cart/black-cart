@foreach($carts as $cart)
    @php
        $product = $modelProduct->start()->getDetail($cart->id, null, $cart->storeId);
        $attrGroup = $modelAttributesGroup->getListAll();
        if(!$product) {
            continue;
        }
    @endphp
    <li class="header-cart-item flex-w flex-t m-b-12">
        <div class="header-cart-item-img" onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ bc_route("cart.remove", ['id'=>$cart->rowId, 'instance' => 'cart']) }}');">
            <img src="{{asset($product->getImage())}}" alt="IMG">
        </div>

        <div class="header-cart-item-txt">
            <a href="{{$product->getUrl() }}" class="header-cart-item-name m-b-5 hov-cl1 trans-04">
                {{$product->name}}
            </a>
            @if ($cart->options->count())
                @foreach ($cart->options as $groupAtt => $att)
                    <span class="header-cart-item-info">{{ $attrGroup[$groupAtt] }} : {!! bc_render_option_price($att) !!}</span>
                @endforeach
            @endif
            <span class="header-cart-item-info">
                {{$cart->qty}} x {{bc_currency_render($cart->subtotal)}}
            </span>
        </div>
    </li>
@endforeach