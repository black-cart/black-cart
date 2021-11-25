@php
/*
$layout_page = shop_compare
**Variables:**
- $compare: no paginate
*/
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
<div class="bg0 p-t-75 p-b-85 container">
     @if (count($compare) ==0)
        <div class="text-center">
            <img src="{{ asset($bc_templateFile.'/images/empty_compare.png') }}">
        </div>
        <div class="text-center">
            <a href="{{bc_route('shop')}}">
                <button class="stext-101 cl0 size-102 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                    {{ trans('front.search') }}
                </button>
            </a>
        </div>
    @else
    <div class="row">
        @foreach($compare as $key => $item)
            @php
                $product = $modelProduct->start()->getDetail($item->id, null, $item->storeId);
                //dd($product);
            @endphp
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35">            
                <button class="pos-absolute remv-cpare" title="Remove" 
                onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ bc_route("cart.remove",['id'=>$item->rowId, 'instance' => 'compare']) }}');">
                        <i class="zmdi zmdi-close pointer"></i>
                </button>
                <div class="overlay pos-absolute info-prod">
                    <div class="flex-w w-full">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart" style="min-width: unset;">
                                <tbody>
                                    @if (bc_config('product_stock'))
                                        <tr class="table_head">
                                            <th class="column-5 text-left p-l-10">
                                                @if($product->stock <=0 && !bc_config('product_buy_out_of_stock'))
                                                    <span class="text-danger">{{ trans('product.out_stock') }}</span>
                                                @else 
                                                    <span class="text-success">{{ trans('product.in_stock') }}</span>
                                                @endif 
                                            </th>
                                            <td><b>{{$product->stock}} SP</b></td>
                                        </tr>
                                    @endif
                                    <tr class="table_head">
                                        <th class="column-5 text-left p-l-10">
                                            {{ trans('product.brand') }}
                                        </th>
                                        <td class="column-2">
                                            {!! empty($product->brand->name) ? 'None' : '<a href="'.$product->brand->getUrl().'">'.$product->brand->name.'</a>' !!}
                                        </td>
                                    </tr>
                                    <tr class="table_head">
                                        <th class="column-5 text-left p-l-10">
                                            {{ trans('product.sold') }}
                                        </th>
                                        <td class="column-2">
                                            {{ $product->sold }}
                                        </td>
                                    </tr>
                                    <tr class="table_head">
                                        <th class="column-5 text-left p-l-10">
                                            {{ trans('product.view') }}
                                        </th>
                                        <td class="column-2">
                                            {{ $product->view }}
                                        </td>
                                    </tr>
                                    @if (bc_config('product_property'))
                                        @if (!$product->attributes->isEmpty())
                                            @php
                                                $attgroup = $modelAttributesGroup->getListAll();
                                            @endphp
                                            @foreach($attgroup as $key => $group)
                                                <tr class="table_head">
                                                    <th class="column-5 text-left p-l-10">
                                                        {{ $group }}
                                                    </th>
                                                    <td class="column-2">
                                                        @foreach($product->attributes as $attribute)
                                                            {{$attribute->attribute_group_id == $key ? $attribute->name.',' : ''}}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endif
                                    @if (bc_config('product_weight'))
                                        @if ($product->weight)
                                            <tr class="table_head">
                                                <th class="column-5 text-left p-l-10">
                                                    {{ trans('product.weight') }}
                                                </th>
                                                <td class="column-2">
                                                    {{ $product->weight }} {{ $product->weight_class }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                    @if (bc_config('product_length'))
                                        @if ($product->length)
                                            <tr class="table_head">
                                                <th class="column-5 text-left p-l-10">
                                                    {{ trans('product.length') }}
                                                </th>
                                                <td class="column-2">
                                                    {{ $product->length }} {{ $product->length_class }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($product->width)
                                            <tr class="table_head">
                                                <th class="column-5 text-left p-l-10">
                                                    {{ trans('product.width') }}
                                                </th>
                                                <td class="column-2">
                                                    {{ $product->width }} {{ $product->length_class }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($product->height)
                                            <tr class="table_head">
                                                <th class="column-5 text-left p-l-10">
                                                    {{ trans('product.height') }}
                                                </th>
                                                <td class="column-2">
                                                    {{ $product->height }} {{ $product->length_class }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @include($bc_templatePath.'.Common.product',['product'=>$product])
            </div>
        @endforeach
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
    $bannerCompare = $modelBanner->start()->settype('breadcrumb_compare')->getData()->first();
@endphp
@if($bannerCompare)
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerCompare['image'] ?? '') }}');">
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
<script src="{{ asset($bc_templateFile)}}/vendor/isotope/isotope.min.js"></script>
<script src="{{ asset($bc_templateFile)}}/vendor/isotope/imagesloaded.min.js"></script>
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
    <style type="text/css">
        .remv-cpare{
            top: 2%;
            right: 10%;
        }
        .row .col-md-4:hover .remv-cpare{
            z-index: 2;
        }
        .info-prod{
            z-index: 1;
            width: calc(100% - 30px);
            opacity: 0.8;
            background: #fff;
        }
        .table-shopping-cart .table_head th{
            font-size: 12px;
            padding-bottom: 5px;
            padding-top: 5px;
        }
        .table-shopping-cart .column-2{
            font-size: 13px;
        }
        .col-sm-6:hover .block2 .block2-btn{
            z-index: 2;
            bottom: 20px;
            box-shadow: 2px 3px 9px 3px #717fe0;
            background: #fff;
            border-radius: 4px;
        }
    </style>
@endpush
@push('isotope')
  @include($bc_templatePath.'.Common.isotope_js')
@endpush