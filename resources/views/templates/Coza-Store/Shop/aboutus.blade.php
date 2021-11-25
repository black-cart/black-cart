@php
/*
$layout_page = shop_page
**Variables:**
- $page: no paginate
*/ 
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">  
  {!! bc_html_render($page->content) !!}
</section>  
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
  $bannerBreadcrumb = $modelBanner->start()->settype('breadcrumb_aboutus')->getData()->first();
  @endphp
  <!-- Title page -->
  @if($bannerBreadcrumb)
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerBreadcrumb['image'] ?? '') }}');">
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
{{-- Your css style --}}
@endpush

@push('scripts')
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