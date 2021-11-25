@extends($bc_templatePath.'.Layout.main')
{{-- block_main --}}
@section('content')
  <!-- Product Detail -->
  <section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container view_detail_product">
      @include($bc_templatePath.'.Common.product_detail',['product' => $product])
      <div class="bor10 m-t-50 p-t-43 p-b-40">
        <!-- Tab01 -->
        <div class="tab01">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item p-b-10">
              <a class="nav-link active" data-toggle="tab" href="#description" role="tab">{{ trans('product.description') }}</a>
            </li>

            <li class="nav-item p-b-10">
              <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
            </li>

            <li class="nav-item p-b-10">
              <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content p-t-43">
            <!-- - -->
            <div class="tab-pane fade show active" id="description" role="tabpanel">
              <div class="how-pos2 p-lr-15-md">
                {!! bc_html_render(($product->content ?: $product->description )) !!}
              </div>
            </div>

            <!-- - -->
            <div class="tab-pane fade" id="information" role="tabpanel">
              <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                  <ul class="p-lr-28 p-lr-15-sm">
                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Weight
                      </span>

                      <span class="stext-102 cl6 size-206">
                        {{$product->weight}} {{$product->weight_class}} 
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Dimensions
                      </span>

                      <span class="stext-102 cl6 size-206">
                        {{$product->length}} x {{$product->height}} x {{$product->width}} {{$product->length_class}} 
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Materials
                      </span>

                      <span class="stext-102 cl6 size-206">
                        60% cotton
                      </span>
                    </li>
                    @foreach($modelAttributesGroup->getListAll() as $key => $group)
                      <li class="flex-w flex-t p-b-7">
                        <span class="stext-102 cl3 size-205">
                          {{$group}}
                        </span>

                        <span class="stext-102 cl6 size-206">
                          @foreach($product->attributes as $attr)
                            @if($key == $attr->attribute_group_id)
                              {{$attr->name}},
                            @endif
                          @endforeach
                        </span>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <!-- - -->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
              <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                  <div class="p-b-30 m-lr-15-sm">
                    <!-- Review -->
                    <div class="flex-w flex-t p-b-68">
                      <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                        {{-- <img src="images/avatar-01.jpg" alt="AVATAR"> --}}
                      </div>

                      <div class="size-207">
                        <div class="flex-w flex-sb-m p-b-17">
                          <span class="mtext-107 cl2 p-r-20">
                            Ariana Grande
                          </span>

                          <span class="fs-18 cl11">
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star-half"></i>
                          </span>
                        </div>

                        <p class="stext-102 cl6">
                          Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                        </p>
                      </div>
                    </div>
                    
                    <!-- Add review -->
                    <form class="w-full">
                      <h5 class="mtext-108 cl2 p-b-7">
                        Add a review
                      </h5>

                      <p class="stext-102 cl6">
                        Your email address will not be published. Required fields are marked *
                      </p>

                      <div class="flex-w flex-m p-t-50 p-b-23">
                        <span class="stext-102 cl3 m-r-16">
                          Your Rating
                        </span>

                        <span class="wrap-rating fs-18 cl11 pointer">
                          <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                          <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                          <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                          <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                          <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                          <input class="dis-none" type="number" name="rating">
                        </span>
                      </div>

                      <div class="row p-b-25">
                        <div class="col-12 p-b-5">
                          <label class="stext-102 cl3" for="review">Your review</label>
                          <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                        </div>

                        <div class="col-sm-6 p-b-5">
                          <label class="stext-102 cl3" for="name">Name</label>
                          <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                        </div>

                        <div class="col-sm-6 p-b-5">
                          <label class="stext-102 cl3" for="email">Email</label>
                          <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                        </div>
                      </div>

                      <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Submit
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Related Products -->
@if ($productRelation->count())
  <section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
      <div class="p-b-45">
        <h3 class="ltext-106 cl5 txt-center">
          Related Products
        </h3>
      </div>

      <!-- Slide2 -->
      <div class="wrap-slick2">
        <div class="slick2">
          @foreach ($productRelation as $key => $product)
            <div class="item-slick2 p-all-15">            
              @include($bc_templatePath.'.Common.product',['product' => $product])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif

  {{-- Render include view --}}
  @if (!empty($layout_page && $includePathView = config('bc_include_view.'.$layout_page, [])))
    @foreach ($includePathView as $view)
      @if (view()->exists($view))
        @include($view)
      @endif
    @endforeach
  @endif
  {{--// Render include view --}}

  <!--/product-details-->
@endsection
{{-- block_main --}}


{{-- breadcrumb --}}
@section('breadcrumb')
@php
    // $bannerProductDetail = $modelBanner->start()->getBannerProductDetail()->getData()->first();
    // $banner = $bannerProductDetail['image'];
    // $paper = $bannerProductDetail['title'];
@endphp
  <div class="container">
    <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
      <a href="{{ bc_route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
        {{ trans('front.home') }}
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>
      @if (bc_config_global('MultiVendorPro') && config('app.storeId') == BC_ID_ROOT)
        <a href="{{ $goToStore }}" class="stext-109 cl8 hov-cl1 trans-04">
          {{ bc_store('title', $product->store_id) }}
          <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
      @endif
      <span class="stext-109 cl4">
        {{ $title ?? '' }}
      </span>
    </div>
  </div>
  {{-- <img src="{{ asset($banner ?? 'data/banner/shape-s.png') }}" class="path shape"> --}}
@endsection
{{-- //breadcrumb --}}
@push('scripts')
<script type="text/javascript">
  initialViewDetaiProduct($('.view_detail_product'));
</script>
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
