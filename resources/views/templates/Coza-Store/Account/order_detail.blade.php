@php
/*
$layout_page = shop_profile
** Variables:**
- $statusOrder
- $statusShipping
- $order
- $countries
- $attributesGroup
*/ 
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
  <section class="bg0 p-t-75 p-b-120"> 
      <div class="container">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-3">
      @include($bc_templatePath.'.account.nav_customer')
    </div>
    <div class="col-12 col-sm-12 col-md-9 min-height-37vh">
      <h4 class="mtext-109 cl2 p-b-30">
        {{ $title }}
      </h4>
      @if (!$order)
      <div class="text-danger">
        {{ trans('account.order_detail_not_exist') }}
      </div>
      @else
      <div class="row" id="order-body">
      <div class="col-sm-6">
        <table class="table table-bordered">
           <tr>
             <td class="td-title">{{ trans('order.shipping_first_name') }}:</td><td>{!! $order->first_name !!}</td>
           </tr>

           @if (bc_config('customer_lastname'))
           <tr>
             <td class="td-title">{{ trans('order.shipping_last_name') }}:</td><td>{!! $order->last_name !!}</td>
           </tr>
           @endif

           @if (bc_config('customer_phone'))
           <tr>
             <td class="td-title">{{ trans('order.shipping_phone') }}:</td><td>{!! $order->phone !!}</td>
           </tr>
           @endif

           <tr>
             <td class="td-title">{{ trans('order.email') }}:</td><td>{!! empty($order->email)?'N/A':$order->email!!}</td>
           </tr>

           @if (bc_config('customer_company'))
           <tr>
             <td class="td-title">{{ trans('order.company') }}:</td><td>{!! $order->company !!}</td>
           </tr>
           @endif

           @if (bc_config('customer_postcode'))
           <tr>
             <td class="td-title">{{ trans('order.postcode') }}:</td><td>{!! $order->postcode !!}</td>
           </tr>
           @endif

           <tr>
             <td class="td-title">{{ trans('order.shipping_address1') }}:</td><td>{!! $order->address1 !!}</td>
           </tr>

           @if (bc_config('customer_address2'))
           <tr>
             <td class="td-title">{{ trans('order.shipping_address2') }}:</td><td>{!! $order->address2 !!}</td>
           </tr>
           @endif

           @if (bc_config('customer_address3'))
           <tr>
             <td class="td-title">{{ trans('order.shipping_address3') }}:</td><td>{!! $order->address3 !!}</td>
           </tr>
           @endif

           @if (bc_config('customer_country'))
           <tr>
             <td class="td-title">{{ trans('order.country') }}:</td><td>{!! $countries[$order->country] ?? $order->country !!}</td>
           </tr>
           @endif

       </table>
   </div>


   <div class="col-sm-6">
    <table  class="table table-bordered">
        <tr><td class="td-title">{{ trans('order.order_status') }}:</td><td>{{ $statusOrder[$order->status] }}</td></tr>
        <tr><td>{{ trans('order.order_shipping_status') }}:</td><td>{{ $statusShipping[$order->shipping_status]??'' }}</td></tr>
        <tr><td>{{ trans('order.shipping_method') }}:</td><td>{{ $order->shipping_method }}</td></tr>
        <tr><td>{{ trans('order.payment_method') }}:</td><td>{{ $order->payment_method }}</td></tr>
        <tr>
          <td class="td-title">{{ trans('order.currency') }}:</td><td>{{ $order->currency }}</td>
        </tr>
        <tr>
          <td class="td-title">{{ trans('order.exchange_rate') }}:</td><td>{{ ($order->exchange_rate)??1 }}</td>
        </tr>
    </table>
  </div>
</div>

      <div class="row">
        <div class="col-sm-12">
          <div class="box collapsed-box">
          <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>{{ trans('product.name') }}</th>
                    <th>{{ trans('product.sku') }}</th>
                    <th class="product_price">{{ trans('product.price') }}</th>
                    <th class="product_qty">{{ trans('product.quantity') }}</th>
                    <th class="product_total">{{ trans('product.total_price') }}</th>
                    <th class="product_tax">{{ trans('product.tax') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $item)
                          <tr>
                            <td>{{ $item->name }}
                              @php
                              $html = '';
                                if($item->attribute && is_array(json_decode($item->attribute,true))){
                                  $array = json_decode($item->attribute,true);
                                      foreach ($array as $key => $element){
                                        $html .= '<br><b>'.$attributesGroup[$key].'</b> : <i>'.$element.'</i>';
                                      }
                                }
                              @endphp
                            {!! $html !!}
                            </td>
                            <td>{{ $item->sku }}</td>
                            <td class="product_price">{{ $item->price }}</td>
                            <td class="product_qty">x  {{ $item->qty }}</td>
                            <td class="product_total item_id_{{ $item->id }}">{{ bc_currency_render_symbol($item->total_price,$order->currency)}}</td>
                            <td class="product_tax">{{ $item->tax }}</td>
                          </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>
        </div>

      </div>

      @php
          $dataTotal = \BlackCart\Core\Front\Models\ShopOrderTotal::getTotal($order->id)
      @endphp
      <div class="row">
        <div class="col-md-12">
          <div class="box collapsed-box">
              <table   class="table table-bordered">
                @foreach ($dataTotal as $element)
                  @if ($element['code'] =='subtotal')
                    <tr><td  class="td-title-normal">{!! $element['title'] !!}:</td><td style="text-align:right" class="data-{{ $element['code'] }}">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif
                  @if ($element['code'] =='tax')
                  <tr><td  class="td-title-normal">{!! $element['title'] !!}:</td><td style="text-align:right" class="data-{{ $element['code'] }}">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif

                  @if ($element['code'] =='shipping')
                    <tr><td>{!! $element['title'] !!}:</td><td style="text-align:right">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif
                  @if ($element['code'] =='discount')
                    <tr><td>{!! $element['title'] !!}(-):</td><td style="text-align:right">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif

                   @if ($element['code'] =='total')
                    <tr style="background:#f5f3f3;font-weight: bold;"><td>{!! $element['title'] !!}:</td><td style="text-align:right" class="data-{{ $element['code'] }}">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif

                  @if ($element['code'] =='received')
                    <tr><td>{!! $element['title'] !!}(-):</td><td style="text-align:right">{{ bc_currency_format($element['value']) }}</td></tr>
                  @endif

                @endforeach
                <tr class="data-balance"><td>{{ trans('order.balance') }}:</td><td style="text-align:right">{{ bc_currency_format($order->balance) }}</td></tr>
            </table>
          </div>

        </div>
      </div>


      @endif
    </div>
  </div>
</div>
</section>
@endsection

{{-- breadcrumb --}}
@section('breadcrumb')
    @php
        $bannerStore = $modelBanner->start()->settype('breadcrumb_account')->getData()->first();
    @endphp
    @if($bannerStore)
        <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerStore['image'] ?? '') }}');">
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
            <a href="{{ bc_route('customer.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ trans('front.my_account') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                {{ $title ?? '' }}
            </span>
        </div>
    </div>
@endsection
{{-- //breadcrumb --}}