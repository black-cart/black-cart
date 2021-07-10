      
{{-- {{ asset(sc_store('logo')) }} --}}

<nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="https://demos.creative-tim.com/blk-design-system-pro/index.html" rel="tooltip" title="" data-placement="bottom" target="_blank" data-original-title="Designed and Coded by Creative Tim">
                <span>BLK•</span> Design System PRO
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
        </div>
        <div class="collapse navbar-collapse" id="navigation">
            <div class="navbar-collapse-header">
              <div class="row">
                <div class="col-6 collapse-brand">
                    <a href="{{ sc_route('home') }}">
                        BLK•<span> PRO </span>
                    </a>
                </div>
                <div class="col-6 collapse-close text-right">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                </div>
              </div>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sc_route('shop') }}">{{ trans('front.shop') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ sc_route('news') }}">{{ trans('front.blog') }}</a></li>
                @if (!empty(sc_config('Content')) && config('app.storeId') == SC_ID_ROOT)
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">{{ trans('front.cms_category') }}</a>
                        @php
                        $nameSpace = sc_get_plugin_namespace('Cms','Content').'\Models\CmsCategory';
                        $cmsCategories = (new $nameSpace)->getCategoryRoot()->getData();
                        @endphp
                        <div class="dropdown-menu dropdown-with-icons">
                            @foreach ($cmsCategories as $cmsCategory)
                            <a href="{{ $cmsCategory->getUrl() }}" class="dropdown-item">
                                {{ sc_language_render($cmsCategory->title) }}
                            </a>
                            @endforeach
                        </div>
                    </li>
                @endif

                @if (!empty($sc_layoutsUrl['menu']))
                    @foreach ($sc_layoutsUrl['menu'] as $url)
                        <li class="nav-item"><a {{ ($url->target =='_blank')?'target=_blank':''  }} class="nav-link" href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a></li>
                    @endforeach
                @endif

                @guest
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-lock d-lg-none d-xl-none"></i> {{ trans('front.account') }}
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="#" class="dropdown-item" data-target="#loginModal" data-toggle="modal">
                            <i class="tim-icons icon-lock-circle"></i> {{ trans('front.login') }}
                        </a>
                        <a href="{{ sc_route('wishlist') }}" class="dropdown-item">
                            <i class="tim-icons icon-heart-2"></i>
                            <span class="badge badge-warning cart_item_wishlist">{{ Cart::instance('wishlist')->count() }}</span> {{ trans('front.wishlist') }}
                        </a>
                        <a href="{{ sc_route('compare') }}" class="dropdown-item">
                            <i class="tim-icons icon-paper"></i>
                            <span class="badge badge-warning cart_item_compare">{{ Cart::instance('compare')->count() }}</span> {{ trans('front.compare') }} 
                        </a>
                    </div>
                </li>
                @else
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-lock"></i> {{ trans('account.my_profile') }}
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a class="dropdown-item" href="{{ sc_route('customer.index') }}">
                            <i class="fa fa-user"></i> {{ trans('front.my_profile') }}
                        </a>

                        <a class="dropdown-item" href="{{ sc_route('logout') }}" rel="nofollow" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="tim-icons icon-button-power"></i> {{ trans('front.logout') }}
                        </a>
                        
                        <a class="dropdown-item" href="{{ sc_route('wishlist') }}">
                            <i class="tim-icons icon-heart-2"></i>
                            <span class="badge badge-warning cart_item_wishlist">{{ Cart::instance('wishlist')->count() }}</span> {{ trans('front.wishlist') }} 
                        </a>

                        <a class="dropdown-item" href="{{ sc_route('compare') }}">
                            <i class="tim-icons icon-paper"></i>
                            <span class="badge badge-warning cart_item_compare">{{ Cart::instance('compare')->count() }}</span> {{ trans('front.compare') }} 
                        </a>
                        
                        <form id="logout-form" action="{{ sc_route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
                    </div>
                </li>
                @endguest
                @if (count($sc_languages)>1)
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ asset($sc_languages[app()->getLocale()]['icon']) }}" style="height: 25px;">
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        @foreach ($sc_languages as $key => $language)
                        <a class="dropdown-item" href="{{ sc_route('locale', ['code' => $key]) }}">
                            <img src="{{ asset($language['icon']) }}" style="height: 25px;"> {{ $language['name'] }}
                        </a>
                        @endforeach
                    </div>
                </li>
                @endif
                @if (count($sc_currencies)>1)
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        {{ sc_currency_info()['name'] }} 
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        @foreach ($sc_currencies as $key => $currency)
                            <a class="dropdown-item" {{ ($currency->code ==  sc_currency_info()['code']) ? 'disabled': '' }} href="{{ sc_route('currency', ['code' => $currency->code]) }}">
                                {{ $currency->name }}
                            </a>
                        @endforeach
                    </div>
                </li>
                @endif

                {{-- <div class="rd-navbar-main-element">
                  <!-- RD Navbar Search-->
                  <div class="rd-navbar-search rd-navbar-search-2">
                    <button class="rd-navbar-search-toggle rd-navbar-fixed-element-3" data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                    <form class="rd-search" action="{{ sc_route('search') }}"  method="GET">
                      <div class="form-wrap">
                        <input class="rd-navbar-search-form-input form-input"  type="text" name="keyword"  placeholder="{{ trans('front.search_form.keyword') }}"/>
                        <button class="rd-search-form-submit" type="submit"></button>
                      </div>
                    </form>
                  </div>
                </div> --}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="{{ sc_route('cart') }}">
                        <i class="tim-icons icon-basket-simple"></i>
                        <span class="badge badge-warning cart_item">{{ Cart::instance('default')->count() }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
