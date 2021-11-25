<div class="row m-lr-15">
  <div class="col-md-6 col-lg-7 p-b-30">
    {{-- Product kind --}}

    {{-- Product kind --}}
    @switch($product->kind)
      @case(BC_PRODUCT_SINGLE)
        <div class="p-l-25 p-r-30 p-lr-0-lg slider-content"> 
            @php
              $image_count = [];
              foreach($product->images as $sub_image){
                $image_sub = explode(',',$sub_image->image);
                foreach ($image_sub as $image_sub_count) {
                  $image_count[] = $image_sub_count;
                }
              }
              // $image_count = explode(',', $product->getFirstAttributeImage()->images);
              if ($product->img->type_show == 'threesixty') {
                $image_data = bc_get_threesixty_image($image_count);
              }else{
                $image_data = implode(',',bc_get_array_thumb($image_count,800,480,true)) ;
              }
            @endphp
              <div class="view-detail-product"
                  data-type="{{$product->img->type_show}}"
                @if($product->img->type_show == 'threesixty')
                  data-full-screen="true"
                  data-magnifier="3"
                  data-autoplay
                  data-spin-reverse="true"
                  data-filename="{{ $image_data['file_name'] }}-{index}.{{ $image_data['extension'] }}"
                  data-folder="{{ $image_data['path'] }}/"
                  data-amount="{{count($image_count)}}"
                  data-lazyload="true"
                  @else
                  data-images="{{$image_data}}"
                @endif >
              </div>
        </div>
        @break
      @case(BC_PRODUCT_GROUP)
        <section class="sec-relate-product bg0 p-t-5 p-b-105" data-type="groups">
          <div class="container">
            <div class="p-b-45">
              <h3 class="ltext-101 cl5 txt-center">
                {{  $product->name  }}
              </h3>
            </div>
            <!-- Slide2 -->
            <div class="wrap-slick2" data-slidesToShow="2" data-slidesToScroll="1">
              <div class="slick2">
                @foreach ($product->groups as $key => $group)
                  <div class="col-sm-6 col-md-4 col-lg-3">
                    @include($bc_templatePath.'.Common.product',['product' => $group->product])
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </section>
        @break
      @case(BC_PRODUCT_BUILD)
        <section class="sec-relate-product bg0 p-t-5 p-b-105 view-detail-product" data-type="builds">
            <div id="render_image_spot">
              <div class="w-100 img-build">
                <img class="w-100" src="{{$product->image}}">
              </div>
              @foreach ($product->builds as $key => $build)
                @php
                  $spot_pos = json_decode($build->spot_inset);
                  $top = $spot_pos->top;
                  $left = $spot_pos->left;
                @endphp
                <div class="t_hotSpot {{$build->spot_type}} {{$build->spot_size}} {{$build->spot_color}}" 
                  style="top:{{$top}};left:{{$left}};">
                  <span class="ring"></span>
                  <div class="t_tooltip_content_wrap t_tooltip_content_render {{$build->spot_popup_position}}">
                    <div class="t_tooltip_content">                      
                      @if(!$build->product_id)
                        {!! $build->spot_content !!}
                      @else
                        @include($bc_templatePath.'.Common.product',['product' => $build->product])
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
        </section>
        @break
    @endswitch
  </div>
    
  <div class="col-md-6 col-lg-5 p-b-30 info-prod">
    <div class="p-r-50 p-t-5 p-lr-0-lg">
      @if ($product->kind != BC_PRODUCT_GROUP)
        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
          {{ $product->name }}
        </h4>
      @endif
      {{-- Go to store --}}
        @if (bc_config_global('MultiVendorPro') && config('app.storeId') == BC_ID_ROOT)
          <a class="p-b-14" href="{{ $product->goToStore() }}">{{ trans('front.store').' '. $product->store_id  }}</a>
        @endif
      {{-- End go to store --}}
      {!! $product->showPrice('detail') !!}

      <div class="bg6 size-302 p-tb-10 m-t-14">
        <p class="stext-107 cl6 p-l-10">
          {{ trans('product.sku') }}: {{ $product->sku }}
        </p>

        <p class="stext-107 cl6 p-l-10">
          {{ trans('product.category') }}: 
          @foreach ($product->categories as $category)
            <a href="{{ $category->getUrl() }}">{{ $category->getTitle() }}</a>,
          @endforeach
        </p>
        @if (bc_config('product_brand') && !empty($product->brand->name))
          <p class="stext-107 cl6 p-l-10">
            {{ trans('product.brand') }}: {!! empty($product->brand->name) ? 'None' : '<a href="'.$product->brand->getUrl().'">'.$product->brand->name.'</a>' !!}
          </p>
        @endif
        {{-- status stock--}}
        @if (bc_config('product_stock'))
          <p class="stext-107 cl6 p-l-10">{{ trans('product.stock_status') }}: 
            @if($product->stock <=0 && !bc_config('product_buy_out_of_stock'))
            <span class="text-danger">{{ trans('product.out_stock') }}</span>
            @else 
            <span class="text-success">{{ trans('product.in_stock') }}</span>
            @endif 
          </p>
        @endif
        {{--// status stock --}}
        {{-- date available --}}
        @if (bc_config('product_available') && $product->date_available >= date('Y-m-d H:i:s'))
          <p class="stext-107 cl6 p-l-10 text-danger">
              {{ trans('product.date_available') }}: {{ $product->date_available }}
          </p>
        @endif
        {{--// date available --}}
      </div>

      <!--  -->
    <form action="{{ bc_route('cart.add') }}" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="product_id" value="{{ $product->id }}" /> 
      <input type="hidden" name="storeId" value="{{ $product->store_id }}" />
      <div class="p-t-14">

        {{-- Show attribute --}}
        @if (bc_config('product_property'))
            @if ($product->attributes())
            {!! $product->renderAttributeDetails() !!}
            @endif
        @endif
        {{--// Show attribute --}}

        <div class="flex-w justify-content-center p-b-10">
          <div class="size-204 flex-w justify-content-center respon6-next">
            @if ($product->kind != BC_PRODUCT_GROUP && $product->allowSale())
                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                  <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-minus"></i>
                  </div>

                  <input class="mtext-104 cl3 txt-center num-product" type="number" name="qty" value="1">

                  <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-plus"></i>
                  </div>
                </div>
                {{-- Button add to cart --}}
                  <button type="button" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail submit">
                    {{ ($product->kind == BC_PRODUCT_BUILD ? trans('front.add_all_to_cart') : trans('front.add_to_cart')) }}
                  </button>
                {{-- Button add to cart --}}
            @endif
          </div>
        </div>  
      </div>
    </form>
      <!--  -->
      @php        
        $fav = Cart::instance('favorite')->search(function ($cartItem,$rowId) use($product){ 
            return $cartItem->id == $product->id;
        });
      @endphp
      <div class="flex-w flex-m p-l-100 p-t-40 respon7">
        <div class="flex-m bor9 p-r-10 m-r-11">
          <a href="#" class="btn-addwish-b2 fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" 
            data-tooltip="{{ ($fav->isEmpty() ? 'Add to Wishlist' : 'Remove to Wishlist') }}">
            <i class="zmdi zmdi-favorite{{ ($fav->isEmpty() ? '-outline' : '') }} heart__{{ $product->id }}"></i>
          </a>
        </div>

        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
          <i class="fa fa-facebook"></i>
        </a>

        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
          <i class="fa fa-twitter"></i>
        </a>

        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
          <i class="fa fa-google-plus"></i>
        </a>
      </div>
    </div>
  </div>
</div>
@if($product->kind == BC_PRODUCT_BUILD)
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/black/css/hotspot.css') }}">
@endif