<!-- Header Mobile -->
<div class="wrap-header-mobile">
    <!-- Logo moblie -->        
    <div class="logo-mobile">
        <a href="index.html"><img src="{{ asset(bc_store('logo')) }}" alt="IMG-LOGO"></a>
    </div>

    <!-- Icon header -->
    <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
        </div>

        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart cart_item_default" data-notify="{{ Cart::instance('default')->count() }}">
            <i class="zmdi zmdi-shopping-cart"></i>
        </div>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-favorite cart_item_favorite" 
            data-notify="{{ Cart::instance('favorite')->count() }}">
            <i class="zmdi zmdi-favorite-outline"></i>
        </a>

        <a href="{{ bc_route('compare') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti cart_item_compare" 
            data-notify="{{ Cart::instance('compare')->count() }}">
            <i class="zmdi zmdi zmdi-compare"></i>
        </a>
    </div>

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile p-0 main-menu-m">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <div class="cursor">
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            Help & FAQs
                        </a>
                    </div>
                    @guest
                        <div class="cursor">
                            <a href="javascript:void(0)" class="flex-c-m p-lr-10 trans-04 js-show-modal-login">{{ trans('front.login') }}</a>
                        </div>
                    @else
                        <div class="cursor active-sub-menu-m">
                            <a href="#" class="flex-c-m p-lr-10 trans-04">
                                {{ trans('account.my_profile') }}
                            </a>
                            <ul class="sub-menu-m">
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
                        </div>
                    @endguest
                    @if (count($bc_languages)>1)
                        <div class="cursor active-sub-menu-m">
                            <a  href="#" class="flex-c-m p-lr-10 trans-04">
                                <img src="{{ asset($bc_languages[app()->getLocale()]['icon']) }}" style="height: 25px;">
                            </a>
                            <ul class="sub-menu-m">
                                @foreach ($bc_languages as $key => $language)
                                    <li>
                                        <a href="{{ bc_route('locale', ['code' => $key]) }}">
                                            <img src="{{ asset($language['icon']) }}" style="height: 25px;"> {{ $language['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (count($bc_currencies)>1)
                        <div class="cursor active-sub-menu-m"><a class="flex-c-m p-lr-10 trans-04" href="#">{{ bc_currency_info()['code'] }}</a>
                            <ul class="sub-menu-m">
                                @foreach ($bc_currencies as $key => $currency)
                                    <li>
                                        <a {{ ($currency->code ==  bc_currency_info()['code']) ? 'disabled': '' }} 
                                        href="{{ bc_route('currency', ['code' => $currency->code]) }}">
                                        {{ $currency->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ bc_route('home') }}">{{ trans('front.home') }}</a>
            </li>
            <li>
                <a href="{{ bc_route('shop') }}">{{ trans('front.shop') }}</a>
            </li>
            @if (!empty(bc_config('Content')) && config('app.storeId') == BC_ID_ROOT)
                <li>
                    <a href="#">{{ trans('front.cms_category') }}</a>
                    @php
                        $nameSpace = bc_get_plugin_namespace('Cms','Content').'\Models\CmsCategory';
                        $cmsCategories = (new $nameSpace)->getCategoryRoot()->getData();
                    @endphp
                    <ul class="sub-menu-m">
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
                        <a {{ ($url->target =='_blank')?'target=_blank':''  }} class="" href="{{ bc_url_render($url->url) }}">
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

</div>
