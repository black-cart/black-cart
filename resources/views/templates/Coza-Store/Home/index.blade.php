@extends($bc_templatePath.'.Layout.main')

@section('content')
      
  <!-- Product -->
  <section class="bg0 p-t-23 p-b-140">
      <div class="container">
          <div class="p-b-10">
              <h3 class="ltext-103 cl5">
                  Product Latest
              </h3>
          </div>
          {{-- Block fillter --}}
              @section('fillter_product')
                @include($bc_templatePath.'.Common.fillter_product')
              @show
          {{--// Block fillter --}}
          

          <div class="row isotope-grid">
              {{-- Block latest prod --}}
              @section('latest_product')
                  @include($bc_templatePath.'.Block.latest')
              @show
              {{--// Block latest prod --}}
          </div>
      </div>
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

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
<script src="{{ asset($bc_templateFile)}}/vendor/isotope/isotope.min.js"></script>
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