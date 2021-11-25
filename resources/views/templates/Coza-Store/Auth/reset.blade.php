
<!-- Modal reset -->
<div class="wrap-modal-reset js-modal-reset p-t-60 p-b-20 p-lr-20">
    <div class="overlay-modal-reset js-hide-modal-reset"></div>

    <div class="row p-0">
        <div class="col-md-8 col-lg-6 col-sm-12 m-lr-auto bg0 p-t-60 p-b-60 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal-reset">
                <img src="{{ asset($bc_templateFile)}}/images/icons/icon-close.png" alt="CLOSE">
            </button>
            <div class="flex-w flex-tr">
                <div class="size-209 m-lr-auto bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form class="form reset-form" method="POST" action="{{ bc_route('password.reset') }}" id="form-process">
                        @csrf
                        <input type="hidden" name="token" value="{{ Session::get('token') }}">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{ trans('account.verify_email.title_page') }}
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20">
                            <input class="stext-111 cl2 plh3 size-116" type="email" 
                            placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if (Session('errors'))
                                <span class="help-block" role="alert">
                                    {{ Session('errors')->first('email') }}
                                </span>
                            @endif
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20">
                            <input class="stext-111 cl2 plh3 size-116" type="password" 
                            placeholder="{{ __('Password') }}" name="password" value="" required>
                            @if (Session('errors'))
                                <span class="help-block" role="alert">
                                    {{ Session('errors')->first('password') }}
                                </span>
                            @endif
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20">
                            <input class="stext-111 cl2 plh3 size-116" type="password" 
                            placeholder="{{ __('Confirm Password') }}" name="password_confirmation" value="" required>
                        </div>

                        {!! $viewCaptcha ?? ''!!}
                        <button type="submit" class="flex-c-m m-b-20 stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{ __('Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>