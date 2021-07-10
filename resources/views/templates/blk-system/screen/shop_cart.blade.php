@php
/*
$layout_page = shop_cart
**Variables:**
- $cart: no paginate
- $shippingMethod: string
- $paymentMethod: string
- $totalMethod: array
- $dataTotal: array
- $shippingAddress: array
- $countries: array
- $attributesGroup: array
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')
    <div class="container">
        <div class="row">
            @if (count($cart) ==0)
            <div class="col-md-12">
                <div class="alert alert-danger alert-with-icon">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span data-notify="icon" class="tim-icons icon-support-17"></span>
                    <span>
                        <b> Oh snap! - </b> {!! trans('cart.cart_empty') !!}!
                    </span>
                </div>
            </div>
            @else
            {{-- Item cart detail --}}
            <div class="col-md-12">
                <div class="card  card-plain">
                    <div class="card-header">
                      <h4 class="card-title"> Shopping Cart Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter  table-shopping" id="">
                                <thead class="">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>{{ trans('product.name') }}</th>
                                        <th>{{ trans('product.image') }}</th>
                                        <th>{{ trans('product.sku') }}</th>
                                        <th class="text-right">{{ trans('product.price') }}</th>
                                        <th class="text-right">{{ trans('product.quantity') }}</th>
                                        <th class="text-right">{{ trans('product.total_price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    <tr class="{{ session('arrErrorQty')[$product->id] ?? '' }}{{ (session('arrErrorQty')[$product->id] ?? 0) ? ' has-error' : '' }}">
                                        <td>
                                            {{ $n }}
                                        </td>
                                        <td class="td-name">
                                            <a href="{{$product->getUrl() }}">{{ $product->name }}</a>
                                            <br>
                                            {{-- Go to store --}}
                                            @if (sc_config_global('MultiVendorPro') && config('app.storeId') == SC_ID_ROOT)
                                            <a href="{{ $product->goToStore() }}">
                                                <small>by {{ trans('front.store').' '. $product->store_id  }}</small>
                                            </a>
                                            @endif
                                            {{-- End go to store --}}
                                            <span>                                            {{-- Process attributes --}}
                                                @if ($item->options->count())
                                                @foreach ($item->options as $groupAtt => $att)
                                                <b>{{ $attributesGroup[$groupAtt] }}</b>: {!! sc_render_option_price($att) !!}
                                                @endforeach
                                                @endif
                                                {{-- //end Process attributes --}}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="img-container">
                                                <img src="{{asset($product->getImage())}}" alt="{{ $product->name }}">
                                            </div>
                                        </td>
                                        <td>
                                            {{ $product->sku }}
                                        </td>
                                        <td class="td-number">
                                            {!! $product->showPrice() !!}
                                        </td>
                                        <td class="td-number">{{$item->qty}}
                                            <input type="hidden" 
                                                    data-id="{{ $item->id }}"
                                                    data-rowid="{{$item->rowId}}" 
                                                    data-store_id="{{$product->store_id}}" 
                                                    onChange="updateCart($(this));"
                                                    name="qty-{{$item->id}}" 
                                                    value="{{$item->qty}}">
                                            <div class="btn-group">
                                                <button class="btn btn-info btn-sm"> <i class="tim-icons icon-simple-delete"></i> </button>
                                                <button class="btn btn-info btn-sm"> <i class="tim-icons icon-simple-add"></i> </button>
                                            </div>
                                            @if (session('arrErrorQty')[$product->id] ?? 0)
                                                <span class="help-block">
                                                    <br>{{ trans('cart.minimum_value', ['value' => session('arrErrorQty')[$product->id]]) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="td-number">
                                            {{sc_currency_render($item->subtotal)}}
                                        </td>
                                        <td class="td-actions">
                                            <a onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ sc_route("cart.remove", ['id'=>$item->rowId, 'instance' => 'cart']) }}');" type="button" rel="tooltip" data-placement="left" title="" class="btn btn-link btn-danger cart_quantity_delete" data-original-title="Remove item">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                      <td colspan="3">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-round" title="{{ trans('cart.back_to_shop') }}" onClick="location.href='{{ sc_route('home') }}'">
                                              <i class="tim-icons icon-minimal-left"></i>
                                              {{ trans('cart.back_to_shop') }}
                                            </button>
                                      </td>
                                      <td></td>
                                      <td></td>
                                      <td colspan="3" class="text-right">
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-round" title="{{ trans('cart.remove_all') }}" 
                                        onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ sc_route('cart.clear', ['instance' => 'cart']) }}');">
                                          {{ trans('cart.remove_all') }}
                                          <i class="tim-icons icon-simple-remove"></i>
                                        </button>
                                      </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- //Item cart detail --}}

            <div class="col-md-12">
                <form class="sc-shipping-address" id="form-process" role="form" method="POST" action="{{ sc_route('checkout.prepare') }}">
                    {{-- Required csrf for secirity --}}
                    @csrf
                    {{--// Required csrf for secirity --}}
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h2 class="title">Info Customer</h2>
                            <div class="row">
                                {{-- Select address if customer login --}}
                                @if (auth()->user())
                                    <div class="">
                                        <select class="form-control" name="address_process" style="width: 100%;" id="addressList">
                                            <option value="">{{ trans('cart.change_address') }}</option>
                                            @foreach ($addressList as $k => $address)
                                            <option value="{{ $address->id }}" {{ (old('address_process') ==  $address->id) ? 'selected':''}}>- {{ $address->first_name. ' '.$address->last_name.', '.$address->address1.' '.$address->address2.' '.$address->address3 }}</option>
                                            @endforeach
                                            <option value="new" {{ (old('address_process') ==  'new') ? 'selected':''}}>{{ trans('cart.add_new_address') }}</option>
                                        </select>
                                    </div>
                                @endif
                                {{--// Select address if customer login --}}
                                
                                {{-- Render address shipping --}}
                                @if (sc_config('customer_lastname'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.first_name') }}</label>
                                            <input type="text" name="first_name" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.first_name') }}" value="{{old('first_name', $shippingAddress['first_name'])}}">
                                            @if($errors->has('first_name'))
                                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.last_name') }}</label>
                                            <input type="text" name="last_name" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.last_name') }}" value="{{old('last_name', $shippingAddress['last_name'])}}">
                                            @if($errors->has('last_name'))
                                                <span class="help-block">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.name') }}</label>
                                            <input type="text" name="first_name" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.name') }}" value="{{old('first_name', $shippingAddress['first_name'])}}">
                                            @if($errors->has('first_name'))
                                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_name_kana'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('first_name_kana') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.first_name_kana') }}</label>
                                            <input type="text" name="first_name_kana" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.first_name_kana') }}" value="{{old('first_name_kana', $shippingAddress['first_name_kana'])}}">
                                            @if($errors->has('first_name_kana'))
                                                <span class="help-block">{{ $errors->first('first_name_kana') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('last_name_kana') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.last_name_kana') }}</label>
                                            <input type="text" name="last_name_kana" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.last_name_kana') }}" value="{{old('last_name_kana', $shippingAddress['last_name_kana'])}}">
                                            @if($errors->has('last_name_kana'))
                                                <span class="help-block">{{ $errors->first('last_name_kana') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if (sc_config('customer_phone'))

                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.email') }}</label>
                                            <input type="text" name="email" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.email') }}" value="{{old('email', $shippingAddress['email'])}}">
                                            @if($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.phone') }}</label>
                                            <input type="text" name="phone" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.phone') }}" value="{{old('phone', $shippingAddress['phone'])}}">
                                            @if($errors->has('phone'))
                                                <span class="help-block">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.email') }}</label>
                                            <input type="text" name="email" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.email') }}" value="{{old('email', $shippingAddress['email'])}}">
                                            @if($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_country'))
                                    @php
                                        $ct = old('country',$shippingAddress['country']);
                                    @endphp
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.country') }}</label>
                                            <div class="dropdown bootstrap-select">
                                                <select class="selectpicker" data-style="btn btn-primary btn-simple" title="Choose {{ trans('cart.country') }}" tabindex="-98" name="country">
                                                    @foreach ($countries as $k => $v)
                                                        <option value="{{ $k }}" {{ ($ct ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country'))
                                                    <span class="help-block">
                                                        {{ $errors->first('country') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_postcode'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.postcode') }}</label>
                                            <input type="text" name="postcode" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.postcode') }}" value="{{old('postcode', $shippingAddress['postcode'])}}">
                                            @if($errors->has('postcode'))
                                                <span class="help-block">{{ $errors->first('postcode') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_company'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.company') }}</label>
                                            <input type="text" name="company" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.company') }}" value="{{old('company', $shippingAddress['company'])}}">
                                            @if($errors->has('company'))
                                                <span class="help-block">{{ $errors->first('company') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_address1'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('address1') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.address1') }}</label>
                                            <input type="text" name="address1" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.address1') }}" value="{{old('address1', $shippingAddress['address1'])}}">
                                            @if($errors->has('address1'))
                                                <span class="help-block">{{ $errors->first('address1') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_address2'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('address2') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.address2') }}</label>
                                            <input type="text" name="address2" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.address2') }}" value="{{old('address2', $shippingAddress['address2'])}}">
                                            @if($errors->has('address2'))
                                                <span class="help-block">{{ $errors->first('address2') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if (sc_config('customer_address3'))
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group {{ $errors->has('address3') ? ' has-error' : '' }}">
                                            <label class="control-label">{{ trans('cart.address3') }}</label>
                                            <input type="text" name="address3" placeholder="Regular" class="form-control" placeholder="{{ trans('cart.address3') }}" value="{{old('address3', $shippingAddress['address3'])}}">
                                            @if($errors->has('address3'))
                                                <span class="help-block">{{ $errors->first('address3') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ trans('cart.note') }}</label>
                                        <textarea class="form-control" name="comment" cols="80" placeholder="{{ trans('cart.note') }}....">{{ old('comment','')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        {{--// Render address shipping --}}
                        </div>

                        <div class="col-md-6">
                            <h2 class="title">Order summary</h2>
                            <div class="card">
                                <div class="card-body">
                                    @foreach($cart as $item)
                                        @php
                                            $product = $modelProduct->start()->getDetail($item->id, null, $item->storeId);
                                        @endphp
                                    <div class="media align-items-center mb-3">
                                        <div class="col-md-5 col-6">
                                            <img src="{{asset($product->getImage())}}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                                        </div>
                                        <div class="media-body">
                                            <h2 class="h6">{{$product->name}}</h2>
                                        </div>
                                        <div class="media-body text-right">
                                            <span>{{sc_currency_render($item->subtotal)}}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    <hr class="line-info mb-3">
                                    {{-- Data total --}}
                                    @if (view()->exists($sc_templatePath.'.common.render_total'))
                                        @include($sc_templatePath.'.common.render_total')
                                    @endif
                                    {{-- Data total --}}
                                    {{-- Total method --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div
                                                class="form-group {{ $errors->has('totalMethod') ? ' has-error' : '' }}">
                                                @if($errors->has('totalMethod'))
                                                    <span class="help-block">{{ $errors->first('totalMethod') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                @foreach ($totalMethod as $key => $plugin)
                                                    @if (view()->exists($plugin['pathPlugin'].'::render'))
                                                        @include($plugin['pathPlugin'].'::render')
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                    {{-- //Total method --}}
                                    @if (!sc_config('shipping_off'))
                                    {{-- Shipping method --}}
                                        <div class="form-group {{ $errors->has('shippingMethod') ? ' has-error' : '' }}">
                                            <p class="category">{{ trans('cart.shipping_method') }}</p>
                                            @if($errors->has('shippingMethod'))
                                                <span class="help-block">{{ $errors->first('shippingMethod') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            @foreach ($shippingMethod as $key => $shipping)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                  <input class="form-check-input"
                                                      {{ ($shipping['permission'])?'':'disabled' }} 
                                                      type="checkbox" value="{{ $shipping['key'] }}" 
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
                                    {{-- //Shipping method --}}
                                    @endif
                                    </div>
                                    <div class="col-md-6">
                                        @if (!sc_config('payment_off'))
                                        {{-- Payment method --}}
                                            <div class="form-group {{ $errors->has('paymentMethod') ? ' has-error' : '' }}">
                                                <p class="category">{{ trans('cart.payment_method') }}</p>
                                                @if($errors->has('paymentMethod'))
                                                    <span class="help-block">{{ $errors->first('paymentMethod') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                @foreach ($paymentMethod as $key => $payment)
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" name="paymentMethod"
                                                            value="{{ $payment['key'] }}"
                                                            {{ (old('shippingMethod') == $key)?'checked':'' }}
                                                            {{ ($payment['permission'])?'':'disabled' }}>
                                                            <span class="form-check-sign"></span>
                                                            {{ $shipping['title'] }}
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
                                        {{-- //Payment method --}}
                                        @endif  
                                    </div>
                                    </div>
                                    {{-- Button checkout --}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        {!! $viewCaptcha ?? ''!!}
                                        <button type="submit" id="button-form-process" class="btn btn-info btn-sm">{{ trans('cart.checkout') }}</button>
                                    </div>
                                    {{-- Button checkout --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
{{-- Render include view --}}
@if (!empty($layout_page && $includePathView = config('sc_include_view.'.$layout_page, [])))
@foreach ($includePathView as $view)
  @if (view()->exists($view))
    @include($view)
  @endif
@endforeach
@endif
{{--// Render include view --}}


@endsection


{{-- breadcrumb --}}
@section('breadcrumb')
@php
    $bannerCart = $modelBanner->start()->getBannerCart()->getData()->first();
    $banner = $bannerCart['image'];
    $paper = $bannerCart['title'];
@endphp
<div class="page-header page-header-small">
    <img src="{{ asset($banner ?? 'data/banner/shape-s.png') }}" class="path shape">
    <div class="container pl-0 pr-0">
        <h1 class="h1-seo">{{ trans($paper ?? 'front.cart')}}</h1>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
{{-- //breadcrumb --}}

@push('scripts')
<script src="{{ asset($sc_templateFile.'/js/plugins/bootstrap-selectpicker.js')}}"></script>

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
@if (!empty($layout_page) && $includePathScript = config('sc_include_script.'.$layout_page, []))
@foreach ($includePathScript as $script)
  @if (view()->exists($script))
    @include($script)
  @endif
@endforeach
@endif
{{--// Render include script --}}

<script type="text/javascript">
    function updateCart(obj){
        let new_qty = obj.val();
        let storeId = obj.data('store_id');
        let rowid = obj.data('rowid');
        let id = obj.data('id');
        $.ajax({
            url: '{{ sc_route('cart.update') }}',
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
                    $('.item-qty-'+id).css('display','block').html(data.msg);
                }

                }
        });
    }

    function buttonQty(obj, action){
        var parent = obj.parent();
        var input = parent.find(".item-qty");
        if(action === 'reduce'){
            input.val(parseInt(input.val()) - 1);
        }else{
            input.val(parseInt(input.val()) + 1);
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
            url: '{{ sc_route('customer.address_detail') }}',
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

@push('styles')
{{-- Your css style --}}
@endpush