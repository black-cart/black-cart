@php
$banners = $modelBanner->start()->setType('banner')->getData()
@endphp
  @if (!empty($banners))
        <ol class="carousel-indicators">
          @foreach ($banners as $key => $banner)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
          @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach ($banners as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
              <div class="card card-blog card-background" data-animation="true">
                <div class="full-background" style="background-image: url({{ asset($banner->image) }})"></div>
                <div class="card-body">
                  <div class="content-bottom">
                    <h6 class="card-category">Footwear</h6>
                    <a href="{{ sc_route('banner.click',['id' => $banner->id]) }}" target="{{ $banner->target }}">
                      <h3 class="card-title">{{ $banner->title }}</h3>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
  @endif
  {{-- {!! sc_html_render($banner->html) !!} --}}