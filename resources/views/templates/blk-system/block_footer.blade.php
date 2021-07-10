      <!-- Page Footer-->
<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <img class="logo-footer" src="{{  asset(sc_store('logo')) }}" alt="{{ sc_store('title') }}">
          </div>
          <div class="col-md-3 col-6">
            <ul class="nav">
              @if (!empty($sc_layoutsUrl['footer']))
                @foreach ($sc_layoutsUrl['footer'] as $url)
                <li class="nav-item">
                    <a {{ ($url->target =='_blank')?'target=_blank':''  }} class="nav-link" href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a>
                </li>
                @endforeach
              @endif
            </ul>
          </div>
          <div class="col-md-3 col-6">
            <ul class="nav">
              <li class="nav-item">
                <a href="https://creative-tim.com/contact-us?ref=blkdsp-footer" class="nav-link">
                  {{ trans('front.shop_info.address') }}: {{ sc_store('address') }}
                </a>
              </li>
              <li class="nav-item">
                <a href="https://creative-tim.com/about-us?ref=blkdsp-footer" class="nav-link">
                  {{ trans('front.shop_info.hotline') }}: {{ sc_store('long_phone') }}
                </a>
              </li>
              <li class="nav-item">
                <a href="http://creative-tim.com/blog?ref=blkdsp-footer" class="nav-link">
                  {{ trans('front.shop_info.email') }}: {{ sc_store('email') }}
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="title">Follow us:</h3>
            <div class="btn-wrapper profile text-left">
              <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-icon btn-neutral  btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-dribbble"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>