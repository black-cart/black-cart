@php
/*
$layout_page = shop_profile
** Variables:**
- $statusOrder
- $orders
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
          <div class="col-12 col-sm-12 col-md-9">
              <h4 class="mtext-109 cl2 p-b-30">
                {{ $title }}
              </h4>
              <div class="m-lr-0-xl">
              @if (count($orders) ==0)
                <div class="text-danger">
                  {{ trans('account.orders.empty') }}
                </div>
              @else              
                <div class="wrap-table-shopping-cart">
                  <table class="table-shopping-cart" style="min-width: unset;">
                    <tbody>
                      <tr class="table_head">
                        <th class="column-1">No.</th>
                        <th class="column-1">{{ trans('account.orders.id') }}</th>
                        <th class="column-1">{{ trans('account.orders.total') }}</th>
                        <th class="column-1">{{ trans('account.orders.status') }}</th>
                        <th class="column-1">{{ trans('account.orders.date_add') }}</th>
                        <th class="column-1">Action</th>
                      </tr>
                      @foreach($orders as $order)
                      @php
                      $n = (isset($n)?$n:0);
                      $n++;
                      @endphp
                      <tr>
                        <td class="column-1">
                          {{ $n }}
                        </td>
                        <td class="column-1">
                          #{{ $order->id }}
                        </td>
                        <td class="column-1">
                          {{ number_format($order->total) }}
                        </td>
                        <td class="column-1">
                          {{ $statusOrder[$order->status]}}
                        </td>
                        <td class="column-1">
                          {{ $order->created_at }}
                        </td>
                        <td class="column-1">
                          <a class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4" href="{{ bc_route('customer.order_detail', ['id' => $order->id ]) }}">
                            <i class="zmdi zmdi-file-text"></i> {{ trans('account.orders.detail_order') }}
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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