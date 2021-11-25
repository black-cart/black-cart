    
@extends($bc_templatePath.'.Layout.main')

@section('content')
<!-- Shoping Cart -->
<div class="bg0 p-t-75 p-b-85 container">
    @if (count($cart) > 0)
        <form class="bc-shipping-address" id="form-process" role="form" method="POST" action="{{ bc_route('checkout.prepare') }}">
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
                                            <div class="wrap-num-product flex-w m-0">
                                                <div onclick="actionQty($(this),'minus')" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input type="number" 
                                                    class="mtext-104 cl3 txt-center num-product"
                                                    data-id="{{ $item->id }}"
                                                    data-rowid="{{$item->rowId}}" 
                                                    data-store_id="{{$product->store_id}}" 
                                                    onChange="updateCart($(this));"
                                                    onKeyUp="processChange($(this))"
                                                    name="qty-{{$item->id}}" 
                                                    value="{{$item->qty}}">

                                                <div onclick="actionQty($(this),'plus')" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                            @if (session('arrErrorQty')[$product->id] ?? 0)
                                                <span class="help-block">
                                                    <br>{{ trans('cart.minimum_value', ['value' => session('arrErrorQty')[$product->id]]) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="column-5">
                                            {{bc_currency_render($item->subtotal)}}
                                        </td>
                                        <td class="column-5">
                                            <a onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ bc_route("cart.remove", ['id'=>$item->rowId, 'instance' => 'cart']) }}');" type="button">
                                                <i class="zmdi zmdi-close pointer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            @foreach ($totalMethod as $key => $plugin)
                                @if (view()->exists($plugin['pathPlugin'].'::render'))
                                    @include($plugin['pathPlugin'].'::render')
                                @endif
                            @endforeach
                            @if($errors->has('totalMethod'))
                                <span class="help-block">{{ $errors->first('totalMethod') }}</span>
                            @endif
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"
                            onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ bc_route('cart.clear', ['instance' => 'cart']) }}');">
                                {{ trans('cart.remove_all') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6 col-xl-6 m-b-50">
                    <div class="bor10 p-3 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Info Customer
                        </h4>
                        {{-- Render address shipping --}}
                        @if (bc_config('customer_lastname'))
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="first_name" placeholder="{{ trans('cart.first_name') }}" 
                                value="{{old('first_name', $shippingAddress['first_name'])}}">
                                @if($errors->has('first_name'))
                                    <span class="m-l-15 help-block">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>

                            <div class="bor8 bg0 m-b-12 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="last_name" placeholder="{{ trans('cart.last_name') }}" 
                                value="{{old('last_name', $shippingAddress['last_name'])}}">
                                @if($errors->has('last_name'))
                                    <span class="m-l-15 help-block">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        @else
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="first_name" placeholder="{{ trans('cart.first_name') }}" 
                                value="{{old('first_name', $shippingAddress['first_name'])}}">
                                @if($errors->has('first_name'))
                                    <span class="m-l-15 help-block">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                        @endif

                        @if (bc_config('customer_name_kana'))
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('first_name_kana') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="first_name_kana" placeholder="{{ trans('cart.first_name_kana') }}" 
                                value="{{old('first_name_kana', $shippingAddress['first_name_kana'])}}">
                                @if($errors->has('first_name_kana'))
                                    <span class="m-l-15 help-block">{{ $errors->first('first_name_kana') }}</span>
                                @endif
                            </div>
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('last_name_kana') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="last_name_kana" placeholder="{{ trans('cart.last_name_kana') }}" 
                                value="{{old('last_name_kana', $shippingAddress['last_name_kana'])}}">
                                @if($errors->has('last_name_kana'))
                                    <span class="m-l-15 help-block">{{ $errors->first('last_name_kana') }}</span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_phone'))
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" placeholder="{{ trans('cart.email') }}" 
                                value="{{old('email', $shippingAddress['email'])}}">
                                @if($errors->has('email'))
                                    <span class="m-l-15 help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="{{ trans('cart.phone') }}" 
                                value="{{old('phone', $shippingAddress['phone'])}}">
                                @if($errors->has('phone'))
                                    <span class="m-l-15 help-block">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        @else
                            <div class="bor8 bg0 m-b-12 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" placeholder="{{ trans('cart.email') }}" 
                                value="{{old('email', $shippingAddress['email'])}}">
                                @if($errors->has('email'))
                                    <span class="m-l-15 help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        @endif
                        @if (auth()->user())
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 {{ $errors->has('country') ? ' has-error' : '' }}">
                                <select class="js-select2" id="addressList" name="address_process">
                                    <option value="">Default address</option>
                                    <option value="new" {{ (old('address_process') ==  'new') ? 'selected':''}}>{{ trans('cart.add_new_address') }}</option>
                                    @foreach ($addressList as $k => $address)
                                        <option value="{{ $address->id }}" {{ (old('address_process') ==  $address->id) ? 'selected':''}}>
                                            - {{ $address->first_name. ' '.$address->last_name.', '.$address->address1.' '.$address->address2.' '.$address->address3 }}
                                        </option>
                                        <div class="dropDownSelect2"></div>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-xl-6 m-b-50">                
                        @csrf
                        <div class="bor10 p-3 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Order summary
                            </h4>
                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Address shipping:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    {{-- <p class="stext-111 cl6 p-t-2">
                                        There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                    </p> --}}
                                    <div class="">
                                        <span class="stext-112 cl8">
                                            {{ trans('cart.country') }}
                                        </span>
                                        @if (bc_config('customer_country'))
                                            @php
                                                $ct = old('country',$shippingAddress['country']);
                                            @endphp
                                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 {{ $errors->has('country') ? ' has-error' : '' }}">
                                                <select class="js-select2" name="country">
                                                    @foreach ($countries as $k => $v)
                                                        <option value="{{ $k }}" {{ ($ct ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            @if ($errors->has('country'))
                                                <span class="m-l-15 help-block">
                                                    {{ $errors->first('country') }}
                                                </span>
                                            @endif
                                        @endif

                                        @if (bc_config('customer_postcode'))
                                            <div class="bor8 bg0 m-b-22 {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="{{ trans('cart.postcode') }}" 
                                                value="{{old('postcode', $shippingAddress['postcode'])}}">
                                                @if($errors->has('postcode'))
                                                    <span class="m-l-15 help-block">{{ $errors->first('postcode') }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if (bc_config('customer_company'))
                                            <div class="bor8 bg0 m-b-22 {{ $errors->has('company') ? ' has-error' : '' }}">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="company" placeholder="{{ trans('cart.company') }}" 
                                                value="{{old('company', $shippingAddress['company'])}}">
                                                @if($errors->has('company'))
                                                    <span class="m-l-15 help-block">{{ $errors->first('company') }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if (bc_config('customer_address1'))
                                            <div class="bor8 bg0 m-b-22 {{ $errors->has('address1') ? ' has-error' : '' }}">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address1" placeholder="{{ trans('cart.address1') }}" 
                                                value="{{old('address1', $shippingAddress['address1'])}}">
                                                @if($errors->has('address1'))
                                                    <span class="m-l-15 help-block">{{ $errors->first('address1') }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if (bc_config('customer_address2'))
                                            <div class="bor8 bg0 m-b-22 {{ $errors->has('address2') ? ' has-error' : '' }}">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address2" placeholder="{{ trans('cart.address2') }}" 
                                                value="{{old('address2', $shippingAddress['address2'])}}">
                                                @if($errors->has('address2'))
                                                    <span class="m-l-15 help-block">{{ $errors->first('address2') }}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if (bc_config('customer_address3'))
                                            <div class="bor8 bg0 m-b-22 {{ $errors->has('address3') ? ' has-error' : '' }}">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address3" placeholder="{{ trans('cart.address3') }}" 
                                                value="{{old('address3', $shippingAddress['address3'])}}">
                                                @if($errors->has('address3'))
                                                    <span class="m-l-15 help-block">{{ $errors->first('address3') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                        <span class="stext-112 cl8">
                                            {{ trans('cart.note') }}
                                        </span>
                                        <div class="bg0 m-b-22 m-t-9">
                                            <textarea class="form-control" name="comment" cols="80" placeholder="{{ trans('cart.note') }}....">{{ old('comment','')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        {{ trans('cart.shipping_method') }}:
                                    </span>
                                </div>
                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    @if (!bc_config('shipping_off'))
                                        {{-- Shipping method --}}
                                            <div class="form-group {{ $errors->has('shippingMethod') ? ' has-error' : '' }}">
                                                @foreach ($shippingMethod as $key => $shipping)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                      <input class="form-check-input"
                                                          {{ ($shipping['permission'])?'':'disabled' }} 
                                                          type="radio" value="{{ $shipping['key'] }}" 
                                                          name="shippingMethod" 
                                                          {{ (old('shippingMethod') == $key)?'checked':'' }}>
                                                          <span class="form-check-sign"></span>
                                                          {{ $shipping['title'] }}
                                                    </label>
                                                </div>
                                                {{-- Render view --}}
                                                @if (view()->exists($shipping['pathPlugin'].'::render'))
                                                    @include($shipping['pathPlugin'].'::render')
                                                @endif
                                                {{-- //Render view --}}
                                                @endforeach
                                            </div>
                                            @if($errors->has('shippingMethod'))
                                                <span class="help-block">{{ $errors->first('shippingMethod') }}</span>
                                            @endif
                                        {{-- //Shipping method --}}
                                        @endif
                                </div>
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        {{ trans('cart.payment_method') }}:
                                    </span>
                                </div>
                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    @if (!bc_config('payment_off'))
                                        {{-- Payment method --}}
                                            <div class="form-group {{ $errors->has('paymentMethod') ? ' has-error' : '' }}">
                                                @foreach ($paymentMethod as $key => $payment)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                                            value="{{ $payment['key'] }}"
                                                            {{ (old('shippingMethod') == $key)?'checked':'' }}
                                                            {{ ($payment['permission'])?'':'disabled' }}>
                                                            <span class="form-check-sign"></span>
                                                            {{ $payment['title'] }}
                                                            {{-- <label class="radio-inline" for="payment-{{ $payment['key'] }}">
                                                                <img title="{{ $payment['title'] }}"
                                                                    alt="{{ $payment['title'] }}"
                                                                    src="{{ asset($payment['image']) }}">
                                                            </label> --}}
                                                    </label>
                                                </div>
                                                {{-- Render view --}}
                                                @if (view()->exists($payment['pathPlugin'].'::render'))
                                                    @include($payment['pathPlugin'].'::render')
                                                @endif
                                                {{-- //Render view --}}
                                                @endforeach
                                            </div>
                                            @if($errors->has('paymentMethod'))
                                                <span class="help-block">{{ $errors->first('paymentMethod') }}</span>
                                            @endif
                                        {{-- //Payment method --}}
                                        @endif  
                                </div>
                            </div>  
                            {{-- Data total --}}
                                @if (view()->exists($bc_templatePath.'.common.render_total'))
                                    <div id="showTotal">
                                        @include($bc_templatePath.'.common.render_total')
                                    </div>
                                @endif
                            {{-- Data total --}}
                            {!! $viewCaptcha ?? ''!!}
                            <button id="button-form-process" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer submit">
                                {{ trans('cart.checkout') }}
                            </button>
                        </div>
                    
                </div>
            </div>
        </form>
    @else
        <div class="text-center">
            <img src="{{ asset($bc_templateFile.'/images/empty_cart.png') }}">
        </div>
        <div class="text-center">
            <a href="{{bc_route('shop')}}">
                <button class="stext-101 cl0 size-102 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                    {{ trans('cart.back_to_shop') }}
                </button>
            </a>
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
    $bannerCart = $modelBanner->start()->settype('breadcrumb_cart')->getData()->first();
@endphp
@if($bannerCart)
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerCart['image'] ?? '') }}');">
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

        <span class="stext-109 cl4">
            {{ $title ?? '' }}
        </span>
    </div>
</div>

@endsection

@push('scripts')

{{-- Render script from total method --}}
@foreach ($totalMethod as $key => $plugin)
    @if (view()->exists($plugin['pathPlugin'].'::script'))
        @include($plugin['pathPlugin'].'::script')
    @endif
@endforeach
{{--// Render script from total method --}}

{{-- Render script from shipping method --}}
@foreach ($shippingMethod as $key => $plugin)
    @if (view()->exists($plugin['pathPlugin'].'::script'))
        @include($plugin['pathPlugin'].'::script')
    @endif
@endforeach
{{--// Render script from shipping method --}}

{{-- Render script from payment method --}}
@foreach ($paymentMethod as $key => $plugin)
    @if (view()->exists($plugin['pathPlugin'].'::script'))
        @include($plugin['pathPlugin'].'::script')
    @endif
@endforeach
{{--// Render script from payment method --}}

{{-- Render include script --}}
@if (!empty($layout_page) && $includePathScript = config('bc_include_script.'.$layout_page, []))
    @foreach ($includePathScript as $script)
        @if (view()->exists($script))
            @include($script)
        @endif
    @endforeach
@endif
{{--// Render include script --}}

<script type="text/javascript">
    function processChange(obj){
        let timer;
        clearTimeout(timer);
        timer = setTimeout(() => { updateCart(obj); }, 1000);
    }

    function updateCart(obj){
        let new_qty = obj.val();
        let storeId = obj.data('store_id');
        let rowid = obj.data('rowid');
        let id = obj.data('id');
        $.ajax({
            url: '{{ bc_route('cart.update') }}',
            type: 'POST',
            dataType: 'json',
            async: false,
            cache: false,
            data: {
                id: id,
                rowId: rowid,
                new_qty: new_qty,
                storeId: storeId,
                _token:'{{ csrf_token() }}'},
            success: function(data){
                error= parseInt(data.error);
                if(error ===0)
                {
                    window.location.replace(location.href);
                }else{
                    $('.num-product-'+id).css('display','block').html(data.msg);
                }

            }
        });
    }
    /*[ +/- num product ]*/
    function actionQty(obj, action){
        var parent = obj.parent();
        var input = parent.find(".num-product");
        var num = parseInt(input.val())
        if(action === 'minus'){
            input.val(num - 1);
        }else{
            input.val(num + 1);
        }
        updateCart(input)
    }

    $('#button-form-process').click(function(){
        $('#form-process').submit();
        $(this).prop('disabled',true);
    });

    $('#addressList').change(function(){
        var id = $('#addressList').val();
        if(!id) {
            return;   
        } else if(id == 'new') {
            $('#form-process [name="first_name"]').val('');
            $('#form-process [name="last_name"]').val('');
            $('#form-process [name="phone"]').val('');
            $('#form-process [name="postcode"]').val('');
            $('#form-process [name="company"]').val('');
            $('#form-process [name="country"]').val('');
            $('#form-process [name="address1"]').val('');
            $('#form-process [name="address2"]').val('');
            $('#form-process [name="address3"]').val('');
        } else {
            $.ajax({
            url: '{{ bc_route('customer.address_detail') }}',
            type: 'GET',
            dataType: 'json',
            async: false,
            cache: false,
            data: {
                id: id,
            },
            success: function(data){
                error= parseInt(data.error);
                if(error === 1)
                {
                    alert(data.msg);
                }else{
                    $('#form-process [name="first_name"]').val(data.first_name);
                    $('#form-process [name="last_name"]').val(data.last_name);
                    $('#form-process [name="phone"]').val(data.phone);
                    $('#form-process [name="postcode"]').val(data.postcode);
                    $('#form-process [name="company"]').val(data.company);
                    $('#form-process [name="country"]').val(data.country);
                    $('#form-process [name="address1"]').val(data.address1);
                    $('#form-process [name="address2"]').val(data.address2);
                    $('#form-process [name="address3"]').val(data.address3);
                }

                }
        });
        }
    });

</script>
@endpush
