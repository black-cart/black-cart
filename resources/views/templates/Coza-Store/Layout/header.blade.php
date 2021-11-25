<header class="{{ Route::current()->getName() == 'home' ? '' : 'header-v4'}}">
    <!-- Header desktop -->
    @include($bc_templatePath.'.Nav.desk')

    @include($bc_templatePath.'.Nav.mobile')
    
    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset($bc_templateFile)}}/images/icons/icon-close2.png" alt="CLOSE">
            </button>
            <form class="wrap-search-header flex-w p-l-15 rd-search" action="{{ bc_route('search') }}"  method="GET">
                <button class="flex-c-m trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="keyword" placeholder="{{ trans('front.search_form.keyword') }}">
            </form>
        </div>
    </div>
</header>