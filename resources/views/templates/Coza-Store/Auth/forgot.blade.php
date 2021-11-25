
<!-- Modal forgot -->
<div class="wrap-modal-forgot js-modal-forgot p-t-60 p-b-20 p-lr-20">
    <div class="overlay-modal-forgot js-hide-modal-forgot"></div>

    <div class="row m-0">
        <div class="col-md-8 col-lg-6 col-sm-12 m-lr-auto bg0 p-t-60 p-b-60 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal-forgot">
                <img src="{{ asset($bc_templateFile)}}/images/icons/icon-close.png" alt="CLOSE">
            </button>
            <div class="flex-w flex-tr">
                <div class="size-209 m-lr-auto bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form class="form forgot-form" method="POST" action="{{ bc_route('password.email') }}" id="form-process">
                        {{ csrf_field() }}
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{ trans('account.password_forgot') }}
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('email'))?"input-error":"" }}" type="email" 
                            placeholder="{{ trans('account.email') }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        {!! $viewCaptcha ?? ''!!}
                        <button type="submit" class="flex-c-m m-b-20 stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{ trans('front.submit_form') }}
                        </button>
                        <div class="flex-sb-m">
                            <a href="javascript:void(0)" class="js-show-modal-login filter-link stext-106">{{ trans('front.login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>