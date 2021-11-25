@extends($bc_templatePath.'.Layout.main')
{{-- block_main_content_center --}}
@section('content')
<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
  <div class="container">
    @include($bc_templatePath.'.Common.fillter_product',
      [
        'filter_sort' => $filter_sort,
        'filterArrSort' => $filterArrSort,
        'filterArrPrice' => $filterArrPrice,
        'filterArrKeyword'=>$filterArrKeyword,
        'filterArrAttribute'=>$filterArrAttribute,
        'filter_attribute' => $filter_attribute,        
        $FilterClass = 'life-filter',
      ]
    )
    <div class="isotope-container">
      <div class="row isotope-grid">
        @foreach ($products as $key => $product)
          <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item @foreach($product->categories as $category) {{$category->id}} @endforeach">
            @include($bc_templatePath.'.Common.product',['product' => $product])
          </div>
        @endforeach
      </div>
      <!-- paginate -->
      {{ $products->appends(request()->except(['page','_token']))->links() }}
    </div>
  </div>
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

{{-- breadcrumb --}}
@section('breadcrumb')
  @php
    $bannerStore = $modelBanner->start()->settype('breadcrumb_shop')->getData()->first();
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
  <style type="text/css">
    .my-cus-card{
      border: 1px solid #1f2251;
      box-shadow: inset -1px -5px 10px -2px;
    }
    .hide-scr-bar::-webkit-scrollbar {
        display: none;
    }
    .my-cus-bgr{
      background-size: contain!important;
      background-repeat: no-repeat;
    }
    .card-blog{
      height: auto;
      min-height: unset;
      margin: 15px 0px 15px 0px;
    }
  </style>
@endpush
@push('scripts')
<script src="{{ asset($bc_templateFile)}}/vendor/isotope/isotope.min.js"></script>
<script src="{{ asset($bc_templateFile)}}/vendor/isotope/imagesloaded.min.js"></script>
<!--===============================================================================================-->
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

@push('isotope')
  @include($bc_templatePath.'.Common.isotope_js')
@endpush