@extends($bc_templatePath.'.Layout.main')

@section('content')
<style>
  .list{
    padding: 5px;
    border-bottom: 1px solid #c5baba;
  }
</style>
  <section class="bg0 p-t-75 p-b-120"> 
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-3">
        @include($bc_templatePath.'.account.nav_customer')
      </div>
      <div class="col-md-9">  
        <h4 class="mtext-109 cl2 p-b-30">
          {{ $title }}
        </h4>
        @if (count($addresses) ==0)
        <div class="text-danger">
          {{ trans('account.addresses.empty') }}
        </div>
        @else
            @foreach($addresses as $address)
                <div class="m-lr-0-xl m-b-20">
                  <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart" style="min-width: unset;">
                      <tbody>
                      </tbody>
                        @if (bc_config('customer_lastname'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.first_name') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['first_name'] }}                             
                              </td>
                          </tr>
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.last_name') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['last_name'] }}                             
                              </td>
                          </tr>
                        @else
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.name') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['first_name'] }}                             
                              </td>
                          </tr>
                        @endif
                        @if (bc_config('customer_phone'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.phone') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['phone'] }}                             
                              </td>
                          </tr>
                        @endif

                        @if (bc_config('customer_postcode'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.postcode') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['postcode'] }}                             
                              </td>
                          </tr>
                        @endif
                        <tr class="table_head">
                            <th class="column-1">
                                {{ trans('account.address1') }}
                            </th>
                            <td class="column-2">
                                {{ $address['address1'] }}                             
                            </td>
                        </tr>

                        @if (bc_config('customer_address2'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.address2') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['address2'] }}                             
                              </td>
                          </tr>
                        @endif

                        @if (bc_config('customer_address3'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.address3') }}
                              </th>
                              <td class="column-2">
                                  {{ $address['address3'] }}                             
                              </td>
                          </tr>
                        @endif

                        @if (bc_config('customer_country'))
                          <tr class="table_head">
                              <th class="column-1">
                                  {{ trans('account.country') }}
                              </th>
                              <td class="column-2">
                                  {{ $countries[$address['country']] ?? $address['country'] }}                           
                              </td>
                          </tr>
                        @endif
                      </table>
                  </div>
                  <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                      
                      <a href="{{ bc_route('customer.update_address', ['id' => $address->id]) }}" 
                        class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                          {{ trans('account.addresses.edit') }}
                      </a>
                      <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 delete-address" data-id="{{ $address->id }}">
                            {{ trans('account.addresses.delete') }}
                      </div>
                      @if ($address->id == auth()->user()->address_id)
                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            {{ trans('account.addresses.default') }}
                        </div>
                      @endif
                  </div>
                </div>
            @endforeach
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



@push('scripts')
<script>
  $('.delete-address').click(function(){    
    var id = $(this).data('id');
    confirmMsg('Are you sure ?','{{ trans('account.confirm_delete') }}','',function(confirmed){
      if (confirmed) {
        $.ajax({
              url:'{{ bc_route("customer.delete_address") }}',
              type:'POST',
              dataType:'json',
              data:{id:id,"_token": "{{ csrf_token() }}"},
                  beforeSend: function(){
                  $('#loading').show();
              },
              success: function(data){
                if(data.error == 0) {
                  swal.fire(data.msg, '' , "success");
                  setTimeout(function(argument) {
                    location.reload();
                  },2000)
                }
              }
        });
      }else{
        return
      }
    });
    
  });
</script>
@endpush