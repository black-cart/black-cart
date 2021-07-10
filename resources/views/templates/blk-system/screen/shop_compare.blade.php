@php
/*
$layout_page = shop_compare
**Variables:**
- $compare: no paginate
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main_content_center')
<div class="col-md-12">
     @if (count($compare) ==0)
        <div class="alert alert-danger alert-with-icon">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
            </button>
            <span data-notify="icon" class="tim-icons icon-support-17"></span>
            <span>
                <b> Oh snap! - </b> {{ trans('front.no_data') }}!
            </span>
        </div>
    @else
    <div class="title">
      <h3>
        <small>{{ $title }}</small>
      </h3>
    </div>
    <div class="row card-coins">
        @php
            $n = 0;
        @endphp

        @foreach($compare as $key => $item)
        @php
            $n++;
            $product = $modelProduct->start()->getDetail($item->id, null, $item->storeId);
        @endphp
        <div class="col-md-4 mb-5 mt-5">
            <div class="card card-coin card-plain">
                <div class="card-header mb-0">
                    <a href="{{ $product->getUrl() }}">
                        <img src="{{asset($product->getImage())}}" class="img-center w-100">
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="text-uppercase">{{ $product->name }}</h4>
                            <span>{{ $product->sku }}</span>
                            <hr class="line-primary">
                        </div>
                    </div>
                    <div class="row">
                        <ul class="list-group">
                            <li class="list-group-item text-danger">{!! $product->showPrice() !!}</li>
                            <li class="list-group-item">100 emails</li>
                            <li class="list-group-item">24/7 Support</li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button rel="tooltip" data-placement="top" title="Remove" 
                    onClick="confirmMsg('Are you sure ?','You won\'t be able to revert this!','{{ sc_route("cart.remove",['id'=>$item->rowId, 'instance' => 'compare']) }}');" 
                    class="btn btn-link btn-danger">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
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

@push('styles')
{{-- Your css style --}}
@endpush