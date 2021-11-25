@php
/*
$layout_page = shop_profile
** Variables:**
- $customer
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
                <div class="m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart" style="min-width: unset;">
                            <tbody>
                                @if (bc_config('customer_lastname'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.first_name') }}
                                        </th>
                                        <td class="column-2">
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="first_name" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.first_name') }}" 
                                                data-value="{{ $customer['first_name'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['first_name'] }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.last_name') }}
                                        </th>
                                        <td class="column-2">   
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="last_name" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.last_name') }}" 
                                                data-value="{{ $customer['last_name'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['last_name'] }}
                                            </a>                          
                                        </td>
                                    </tr>
                                @else
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.first_name') }}
                                        </th>
                                        <td class="column-2">
                                            {{ $customer['first_name'] }}   
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="first_name" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.first_name') }}" 
                                                data-value="{{ $customer['first_name'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['first_name'] }}
                                            </a>                            
                                        </td>
                                    </tr>
                                @endif

                                @if (bc_config('customer_name_kana'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.first_name_kana') }}
                                        </th>
                                        <td class="column-2"> 
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="first_name_kana" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.first_name_kana') }}" 
                                                data-value="{{ $customer['first_name_kana'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['first_name_kana'] }}  
                                            </a>                            
                                        </td>
                                    </tr>
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.last_name_kana') }}
                                        </th>
                                        <td class="column-2">     
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="last_name_kana" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.last_name_kana') }}" 
                                                data-value="{{ $customer['last_name_kana'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['last_name_kana'] }}   
                                            </a>                       
                                        </td>
                                    </tr>
                                @endif

                                @if (bc_config('customer_phone'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.phone') }}
                                        </th>
                                        <td class="column-2"> 
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="phone" 
                                                data-type="number" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.phone') }}" 
                                                data-value="{{ $customer['phone'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['phone'] }}   
                                            </a>                           
                                        </td>
                                    </tr>
                                @endif

                                @if (bc_config('customer_postcode'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.postcode') }}
                                        </th>
                                        <td class="column-2"> 
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="postcode" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.postcode') }}" 
                                                data-value="{{ $customer['postcode'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['postcode'] }}   
                                            </a>                           
                                        </td>
                                    </tr>
                                @endif

                                <tr class="table_head">
                                    <th class="column-1">
                                        {{ trans('account.email') }}
                                    </th>
                                    <td class="column-2"> 
                                        <a href="#" class="editable-required editable editable-click" 
                                            data-name="email" 
                                            data-type="email" 
                                            data-pk="" 
                                            data-source="" 
                                            data-url="{{ bc_route('customer.update') }}" 
                                            data-title="{{ trans('account.email') }}" 
                                            data-value="{{ $customer['email'] }}" 
                                            data-original-title="" title="">
                                            {{ $customer['email'] }}       
                                        </a>                       
                                    </td>
                                </tr>

                                <tr class="table_head">
                                    <th class="column-1">
                                        {{ trans('account.address1') }}
                                    </th>
                                    <td class="column-2">
                                        <a href="#" class="editable-required editable editable-click" 
                                            data-name="address1" 
                                            data-type="text" 
                                            data-pk="" 
                                            data-source="" 
                                            data-url="{{ bc_route('customer.update') }}" 
                                            data-title="{{ trans('account.address1') }}" 
                                            data-value="{{ $customer['address1'] }}" 
                                            data-original-title="" title="">
                                            {{ $customer['address1'] }}     
                                        </a>                          
                                    </td>
                                </tr>


                                @if (bc_config('customer_address2'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.address2') }}
                                        </th>
                                        <td class="column-2">   
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="address2" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.address2') }}" 
                                                data-value="{{ $customer['address2'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['address2'] }}
                                            </a>                            
                                        </td>
                                    </tr>
                                @endif


                                @if (bc_config('customer_address3'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.address3') }}
                                        </th>
                                        <td class="column-2"> 
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="address3" 
                                                data-type="text" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.address3') }}" 
                                                data-value="{{ $customer['address3'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['address3'] }} 
                                            </a>                             
                                        </td>
                                    </tr>
                                @endif

                                @if (bc_config('customer_country'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.country') }}
                                        </th>
                                        <td class="column-2"> 
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="country" 
                                                data-type="select" 
                                                data-pk="" 
                                                data-source="{{json_encode(Cache::get(session('adminStoreId').'_cache_countries_'.bc_get_locale()))}}" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.country') }}" 
                                                data-value="{{ $customer['country'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['country'] }}
                                            </a>                            
                                        </td>
                                    </tr>
                                @endif


                                @if (bc_config('customer_sex'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.sex') }}
                                        </th>
                                        <td class="column-2">     
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="sex" 
                                                data-type="select" 
                                                data-pk="" 
                                                data-source="{{ json_encode(
                                                    [
                                                        '0' => trans('account.sex_men'), 
                                                        '1'   => trans('account.sex_women')
                                                    ]
                                                )}}" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.sex') }}" 
                                                data-value="{{ $customer['sex'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['sex'] }}
                                            </a>                          
                                        </td>
                                    </tr>
                                @endif

                                @if (bc_config('customer_birthday'))
                                    <tr class="table_head">
                                        <th class="column-1">
                                            {{ trans('account.birthday') }}
                                        </th>
                                        <td class="column-2">
                                            {{ $customer['birthday'] }}   
                                            <a href="#" class="editable-required editable editable-click" 
                                                data-name="birthday" 
                                                data-type="date" 
                                                data-pk="" 
                                                data-source="" 
                                                data-url="{{ bc_route('customer.update') }}" 
                                                data-title="{{ trans('account.birthday') }}" 
                                                data-value="{{ $customer['birthday'] }}" 
                                                data-original-title="" title="">
                                                {{ $customer['birthday'] }}
                                            </a>                            
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
            <span class="stext-109 cl4">
                {{ $title ?? '' }}
            </span>
        </div>
    </div>
@endsection
{{-- //breadcrumb --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('admin/plugin/bootstrap-editable.css')}}">
@endpush
@push('scripts')
<script src="{{ asset('admin/plugin/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
      //  $.fn.editable.defaults.mode = 'inline';
      $.fn.editable.defaults.params = function (params) {
        params._token = "{{ csrf_token() }}";
        params.storeId = "{{ session('adminStoreId') }}";
        params.id = "{{ $customer['id'] }}";
        return params;
      };

      $('.editable-required').editable({
        validate: function(value) {
            if (value == '') {
                return '{{  trans('admin.not_empty') }}';
            }
        },
        success: function(data) {
          if(data.error == 0){
            swal.fire('{{ trans('admin.msg_change_success') }}', '' , "success");
          } else {
            swal.fire(data.msg, '' , "error");
          }
      }
    });

    $('.editable').editable({
        validate: function(value) {
        },
        success: function(data) {
          if(data.error == 0){
            swal.fire('{{ trans('admin.msg_change_success') }}', '' , "success");
          } else {
            swal.fire(data.msg, '' , "error");
          }
      }
    });

});
</script>
@endpush