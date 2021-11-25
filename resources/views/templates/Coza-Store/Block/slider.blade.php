@php
$sliders = $modelBanner->start()->setType('slider_home')->getData();
$effect = ['lightSpeedIn','slideInUp','rollIn','zoomIn','fadeInUp','fadeInDown','rotateInDownLeft','rotateInUpRight','rotateIn'];
$random_effect = array_rand($effect,3);
@endphp
<!-- Slider -->
@if (!empty($sliders))
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach ($sliders as $key => $slider)
                    <div class="item-slick1" style="background-image: url({{ asset($slider->image) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="{{$effect[$random_effect[0]]}}" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        New Collection 2021
                                    </span>
                                </div>
                                    
                                <div class="layer-slick1 animated visible-false" data-appear="{{$effect[$random_effect[1]]}}" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{ $slider->title }}
                                    </h2>
                                </div>
                                    
                                <div class="layer-slick1 animated visible-false" data-appear="{{$effect[$random_effect[2]]}}" data-delay="1600">
                                    <a href="{{ bc_route('banner.click',['id' => $slider->id]) }}" target="{{ $slider->target }}" 
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Shop Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
{{-- {!! bc_html_render($slider->html) !!} --}}


            
