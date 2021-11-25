<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full">
            <nav class="limiter-menu-desktop container flex-sb">
                <a href="#" class="delivery">
                    Free shipping for standard order over $100
                </a>
                <div class="menu-desktop header-v3">
                    <ul class="main-menu">
                        <li>
                            <a href="product.html">Help & FAQs</a>
                        </li>
                        @guest
                            <li>
                                <a href="javascript:void(0)" class="js-show-modal-login">{{ trans('front.login') }}</a>
                            </li>
                        @else
                            <li class="">
                                <a href="#">
                                    {{ trans('account.my_profile') }}
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="{{ bc_route('customer.index') }}">{{ trans('front.my_profile') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ bc_route('logout') }}"onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" rel="nofollow">{{ trans('front.logout') }}</a>
                                        <form id="logout-form" action="{{ bc_route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        @if (count($bc_languages)>1)
                            <li class="">
                                <a href="#"><img src="{{ asset($bc_languages[app()->getLocale()]['icon']) }}" style="height: 25px;"></a>
                                <ul class="sub-menu">
                                    @foreach ($bc_languages as $key => $language)
                                        <li>
                                            <a href="{{ bc_route('locale', ['code' => $key]) }}">
                                                <img src="{{ asset($language['icon']) }}" style="height: 25px;"> {{ $language['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @if (count($bc_currencies)>1)
                            <li class="">
                                <a href="#">{{ bc_currency_info()['code'] }}</a>
                                <ul class="sub-menu">
                                    @foreach ($bc_currencies as $key => $currency)
                                        <li>
                                            <a {{ ($currency->code ==  bc_currency_info()['code']) ? 'disabled': '' }} 
                                            href="{{ bc_route('currency', ['code' => $currency->code]) }}">
                                            {{ $currency->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="wrap-menu-desktop">
        <nav class="limiter-menu-desktop container">
            
            <!-- Logo desktop -->       
            <a href="{{ bc_route('home') }}" class="logo">
                <img src="{{ asset(bc_store('logo')) }}" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li>
                        <a href="{{ bc_route('home') }}">{{ trans('front.home') }}</a>
                    </li>
                    <li class="label1" data-label1="hot">
                        <a href="{{ bc_route('shop') }}">{{ trans('front.shop') }}</a>
                    </li>
                    @if (!empty(bc_config('Content')) && config('app.storeId') == BC_ID_ROOT)
                        <li class="active-menu">
                            <a href="#">{{ trans('front.cms_category') }}</a>
                            @php
                            $nameSpace = bc_get_plugin_namespace('Cms','Content').'\Models\CmsCategory';
                            $cmsCategories = (new $nameSpace)->getCategoryRoot()->getData();
                            @endphp
                            <ul class="sub-menu">
                                @foreach ($cmsCategories as $cmsCategory)
                                <li>
                                    <a href="{{ $cmsCategory->getUrl() }}">
                                        {{ bc_language_render($cmsCategory->title) }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if (!empty($bc_layoutsUrl['menu']))
                        @foreach ($bc_layoutsUrl['menu'] as $url)
                            <li>
                                <a {{ ($url->target =='_blank')?'target=_blank':''  }} class="nav-link" href="{{ bc_url_render($url->url) }}">
                                    {{ bc_language_render($url->name) }}
                                </a>
                            </li>
                        @endforeach
                    @endif

                    <li>
                        <a href="{{ bc_route('news') }}">{{ trans('front.blog') }}</a>
                    </li>
                </ul>
            </div>  

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart cart_item_default" data-notify="{{ Cart::instance('default')->count() }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-favorite cart_item_favorite" data-notify="{{ Cart::instance('favorite')->count() }}">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </div>
                <a href="{{ bc_route('compare') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti cart_item_compare" 
                data-notify="{{ Cart::instance('compare')->count() }}">
                    <i class="zmdi zmdi zmdi-compare"></i>
                </a>
            </div>
        </nav>
    </div>  
</div>