@php
$banners = $modelBanner->start()->setType('banner_home')->getData();
@endphp
<!-- Banneer -->
@if (!empty($banners))
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                @foreach ($banners as $key => $banner)
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
                            <a href="{{ bc_route('banner.click',['id' => $banner->id]) }}" target="{{ $banner->target }}" 
                                class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        {{ $banner->title }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04">
                                        Spring 2018
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
{{-- {!! bc_html_render($banner->html) !!} --}}
