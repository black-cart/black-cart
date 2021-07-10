@php
/*
$layout_page = shop_wishlist
**Variables:**
- $wishlist: no paginate
*/
@endphp
@extends($sc_templatePath.'.layout')

@section('block_main_content_center')
<div class="col-md-12">
    @if (count($wishlist) ==0)
        <div class="alert alert-danger alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-support-17"></span>
            <span>
                <b> Oh snap! - </b> {{ trans('front.empty_product') }}!
            </span>
        </div>
    @else
    <div class="card  card-plain">
        <div class="card-header">
          <h4 class="card-title"> Shopping Cart Table</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tablesorter  table-shopping" id="">
                    <thead class="">
                        <tr>
                            <th>No.</th>
                            <th class="text-center"></th>
                            <th>Name</th>
                            <th class="text-center">SKU</th>
                            <th class="text-right">Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlist as $item)
                        @php
                        $n = (isset($n)?$n:0);
                        $n++;
                        $product = $modelProduct->start()->getDetail($item->id, null, $item->storeId);
                        @endphp
                        <tr class="row_cart">
                            <td>{{ $n }}</td>
                            <td>
                                <div class="img-container">
                                    <img src="{{asset($product->getImage())}}" alt="{{ $product->name }}" alt="{{ $product->name }}">
                                    {{-- Process attributes --}}
                                    @if ($item->options->count())
                                    (
                                    @foreach ($item->options as $keyAtt => $att)
                                    <b>{{ $attributesGroup[$keyAtt] }}</b>: <i>{{ $att }}</i> ;
                                    @endforeach
                                    )<br>
                                    @endif
                                    {{-- //end Process attributes --}}
                                </div>
                            </td>
                            <td class="td-name"><a href="{{$product->getUrl() }}">{{ $product->name }}</a></td>
                            <td>{{ $product->sku }}</td>
                            <td class="td-number">{!! $product->showPrice() !!}</td>
                            <td class="td-action">
                                <button type="button" rel="tooltip" data-placement="left" title="Remove" class="btn btn-link btn-danger" 
                                data-original-title="Remove item" 
                                onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ sc_route('cart.remove', ['id'=>$item->rowId, 'instance' => 'wishlist']) }}');">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
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
<div class="page-header page-header-small">
  <div class="container pl-0 pr-0">
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


@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- Render include script --}}
@if (!empty($layout_page) && $includePathScript = config('sc_include_script.'.$layout_page, []))
@foreach ($includePathScript as $script)
  @if (view()->exists($script))
    @include($script)
  @endif
@endforeach
@endif
{{--// Render include script --}}
@endpush