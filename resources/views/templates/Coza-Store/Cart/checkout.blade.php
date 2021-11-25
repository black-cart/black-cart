@php
/*
$layout_page = shop_checkout
**Variables:**
- $cart: no paginate
- $shippingMethod: string
- $paymentMethod: string
- $dataTotal: array
- $shippingAddress: array
- $attributesGroup: array
- $products: paginate
Use paginate: $products->appends(request()->except(['page','_token']))->links()
*/
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
<div class="bg0 p-t-75 p-b-85 container">
    @if (count($cart) > 0)
        <div class="row">
            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                <div class="m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">No.</th>
                                <th class="column-2">{{ trans('product.name') }}</th>
                                <th class="column-3">{{ trans('product.image') }}</th>
                                <th class="column-4 text-center">{{ trans('product.sku') }}</th>
                                <th class="column-1">{{ trans('product.price') }}</th>
                                <th class="column-6 text-center">{{ trans('product.quantity') }}</th>
                                <th class="column-7 text-center">{{ trans('product.total_price') }}</th>
                            </tr>
                            @foreach($cart as $item)
                                @php
                                    $n = (isset($n)?$n:0);
                                    $n++;
                                    // Check product in cart
                                    $product = $modelProduct->start()->getDetail($item->id, null, $item->storeId);
                                    if(!$product) {
                                        continue;
                                    }
                                    // End check product in cart
                                @endphp
                                <tr class="table_row {{ session('arrErrorQty')[$product->id] ?? '' }}{{ (session('arrErrorQty')[$product->id] ?? 0) ? ' has-error' : '' }}">
                                    <td class="column-1">
                                        {{ $n }}
                                    </td>
                                    <td class="column-2">
                                        <a href="{{$product->getUrl() }}">{{ $product->name }}</a>
                                        <br>
                                        {{-- Go to store --}}
                                        @if (bc_config_global('MultiVendorPro') && config('app.storeId') == BC_ID_ROOT)
                                            <a href="{{ $product->goToStore() }}">
                                                <small>by {{ trans('front.store').' '. $product->store_id  }}</small>
                                            </a>
                                        @endif
                                        {{-- End go to store --}}
                                    </td>
                                    <td class="column-3">
                                        <div class="how-itemcart1 w-100">
                                            <img src="{{asset($product->getImage())}}" alt="{{ $product->name }}">
                                        </div>
                                    </td>
                                    <td class="column-4 text-center">
                                        {{ $product->sku }}
                                    </td>
                                    <td class="column-1" style="width: 250px;">
                                        {!! $product->showPrice() !!}
                                        <span>                                            
                                            {{-- Process attributes --}}
                                            @if ($item->options->count())
                                                @foreach ($item->options as $groupAtt => $att)
                                                    <div class="product-price">
                                                        <span class="stext-105 cl3">
                                                            {{ $attributesGroup[$groupAtt] }} : {!! bc_render_option_price($att,null,null,$item->qty) !!}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @endif
                                            {{-- //end Process attributes --}}
                                        </span>
                                    </td>
                                    <td class="column-4 text-center">
                                        {{$item->qty}}
                                    </td>
                                    <td class="column-5">
                                        {{bc_currency_render($item->subtotal)}}
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xl-6 m-b-50">
                <div class="bor10 p-3 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        {{ trans('cart.to_name') }}
                    </h4>
                
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart min-w-full">
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.name') }}</th>
                                <td class="column-2"><span class="stext-105 cl3">{{ $shippingAddress['first_name'] }} {{ $shippingAddress['last_name'] }}</span></td>
                            </tr>
                            @if (bc_config('customer_name_kana'))
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.name_kana') }}</th>
                                <td class="column-2"><span class="stext-105 cl3">{{ $shippingAddress['first_name_kana'].$shippingAddress['last_name_kana'] }}</span></td>
                            </tr>
                            @endif
                            @if (bc_config('customer_phone'))
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.phone') }}</th>
                                <td class="column-2"><span class="stext-105 cl3">{{ $shippingAddress['phone'] }}</span></td>
                            </tr>
                            @endif
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.email') }}</th>
                                <td class="column-2"><span class="stext-105 cl3">{{ $shippingAddress['email'] }}</span></td>
                            </tr>
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.address') }}</td>
                                <td class="column-2">
                                    {{ $shippingAddress['address1'].' '.$shippingAddress['address2'].' '.$shippingAddress['address3'].','.$shippingAddress['country'] }}
                                </td>
                            </tr>
                            @if (bc_config('customer_postcode'))
                                <tr class="table_head">
                                    <th class="column-1">{{ trans('cart.postcode') }}</td>
                                    <td class="column-2">{{ $shippingAddress['postcode']}}</td>
                                </tr>
                            @endif

                            @if (bc_config('customer_company'))
                                <tr class="table_head">
                                    <th class="column-1">{{ trans('cart.company') }}</td>
                                    <td class="column-2">{{ $shippingAddress['company']}}</td>
                                </tr>
                            @endif

                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.note') }}</td>
                                <td class="column-2">{{ $shippingAddress['comment'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-xl-6 m-b-50">
                <div class="bor10 p-3 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        {{ trans('cart.info_order') }}
                    </h4>

                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart min-w-full">
                            @foreach ($dataTotal as $key => $element)

                                @if ($element['code']=='total')
                                    <tr class="table_head">
                                        <th class="column-1">{!! $element['title'] !!}</th>
                                        <td class="column-2" id="{{ $element['code'] }}">{{$element['text'] }}</td>
                                    </tr>
                                @elseif($element['value'] !=0)
                                    @if($element['code'] == 'discount')
                                        <tr class="table_head">
                                            <th class="column-1">{{ trans('order.totals.'.$element['code']) }}</th>
                                            <td class="column-2" id="{{ $element['code'] }}">
                                                <i class="zmdi zmdi-ticket-star"></i> {!! $element['title'] !!} ({{$element['text'] }})
                                            </td>
                                        </tr>
                                        @else                                    
                                        <tr class="table_head">
                                            <th class="column-1">{!! $element['title'] !!}</th>
                                            <td class="column-2" id="{{ $element['code'] }}">{{$element['text'] }}</td>
                                        </tr>
                                    @endif
                                @elseif($element['code'] =='shipping')
                                    <tr class="table_head">
                                        <th class="column-1">{!! $element['title'] !!}</th>
                                        <td class="column-2" id="{{ $element['code'] }}">{{$element['text'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            @if (!bc_config('payment_off'))
                            {{-- Payment method --}}
                            <tr class="table_head">
                                <th class="column-1">{{ trans('cart.payment_method') }}</th>
                                <td class="column-2">
                                    <img title="{{ $paymentMethodData['title'] }}" width="20px" src="{{ asset($paymentMethodData['image']) }}">    
                                    {{ $paymentMethodData['title'] }}
                                </td>
                            </tr>
                            {{-- //Payment method --}}
                            @endif
                        </table>
                    </div>
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" onClick="location.href='{{ bc_route('cart') }}'">
                            {{ trans('cart.back_to_cart') }}
                        </div>
                        <div class="submit flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" onClick="$('#form-order').submit()">
                            {{ trans('cart.confirm') }}
                        </div>
                    </div>
                    <form id="form-order" role="form" method="POST" action="{{ bc_route('order.add') }}">
                        @csrf

                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
{{-- Render include view --}}
@if (!empty($layout_page && $includePathView = config('bc_include_view.'.$layout_page, [])))
    @foreach ($includePathView as $view)
      @if (view()->exists($view))
        @include($view)
      @endif
    @endforeach
@endif
{{--// Render include view --}}

@endsection


@section('breadcrumb')
@php
    $bannerCheckout = $modelBanner->start()->settype('breadcrumb_checkout')->getData()->first();
@endphp
@if($bannerCheckout)
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerCheckout['image'] ?? '') }}');">
      <h2 class="ltext-105 cl0 txt-center">
        {{ $title ?? '' }}
      </h2>
    </section>
@endif  
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
        <a href="{{ bc_route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ trans('front.home') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <a href="{{ bc_route('cart') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ trans('front.cart') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $title ?? '' }}
        </span>
    </div>
</div>

@endsection


@push('scripts')

{{-- Render include script --}}
@if (!empty($layout_page) && $includePathScript = config('bc_include_script.'.$layout_page, []))
@foreach ($includePathScript as $script)
  @if (view()->exists($script))
    @include($script)
  @endif
@endforeach
@endif
{{--// Render include script --}}

@endpush

@push('styles')
{{-- Your css style --}}
@endpush