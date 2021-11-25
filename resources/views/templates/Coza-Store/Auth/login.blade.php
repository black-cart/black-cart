
<!-- Modal login -->
<div class="wrap-modal-login js-modal-login p-t-60 p-b-20 p-lr-20">
    <div class="overlay-modal-login js-hide-modal-login"></div>

    <div class="row p-0">
        <div class="col-md-8 col-lg-6 col-sm-12 m-lr-auto bg0 p-t-60 p-b-60 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal-login">
                <img src="{{ asset($bc_templateFile)}}/images/icons/icon-close.png" alt="CLOSE">
            </button>
            <div class="flex-w flex-tr">
                <div class="size-209 m-lr-auto bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form class="form login-form">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Login
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="log-email stext-111 cl2 plh3 size-116 {{ ($errors->has('email'))?"input-error":"" }}" type="text" 
                            placeholder="{{ trans('account.email') }}" name="email" value="{{ old('email') }}">
                            <span class="help-block err-email"></span>
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="log-password stext-111 cl2 plh3 size-116 {{ ($errors->has('password'))?"input-error":"" }}" type="password" 
                            placeholder="{{ trans('account.password') }}" name="password">
                            <span class="help-block err-password"></span>
                        </div>
                        @if (!empty(bc_config('LoginSocialite')))
                            <div class="flex-sb-m m-b-20">
                                <a class="filter-link stext-106" href="{{ bc_route('login_socialite.index', ['provider' => 'facebook']) }}">
                                    <i class="zmdi zmdi-facebook-box"></i>
                                    Facebook
                                </a>
                                <a class="filter-link stext-106" href="{{ bc_route('login_socialite.index', ['provider' => 'google']) }}">
                                    <i class="zmdi zmdi-google-plus-box"></i>
                                    Google
                                </a>
                                <a class="filter-link stext-106" href="{{ bc_route('login_socialite.index', ['provider' => 'github']) }}">
                                    <i class="zmdi zmdi-github-box"></i>
                                    Github
                                </a>
                            </div>
                        @endif
                        <button type="button" onclick="LoginAjax(this)" class="flex-c-m m-b-20 stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{ trans('account.login') }}
                        </button>
                        <div class="flex-sb-m">
                            <a href="javascript:void(0)" class="js-show-modal-register filter-link stext-106">{{ trans('account.title_register') }}</a>
                            <a href="javascript:void(0)" class="js-show-modal-forgot filter-link stext-106">{{ trans('account.password_forgot') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>