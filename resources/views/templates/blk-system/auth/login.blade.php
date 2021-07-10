
<!--form-->
<div class="modal fade show" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="card card-login">
                <form action="" class="form login-form">
                    <div class="card-header">
                        <img class="card-img" src="{{ asset($sc_templateFile.'/img/square-purple-1.png') }}" alt="Card image">
                        <h4 class="card-title">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }} input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="tim-icons icon-single-02"></i></span>
                            </div>
                            <input type="text" class="form-control {{ ($errors->has('email'))?"input-error":"" }}" placeholder="{{ trans('account.email') }}" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }} input-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="tim-icons icon-caps-small"></i></span>
                            </div>
                            <input type="password" class="form-control {{ ($errors->has('password'))?"input-error":"" }}" placeholder="{{ trans('account.password') }}" name="password" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                      <button type="button" onclick="LoginAjax(this)" class="btn btn-primary btn-round btn-lg btn-block">{{ trans('account.login') }}</button>
                    </div>
                    <div class="pull-left ml-3 mb-3">
                      <h6>
                        <a href="#pablo" class="link footer-link">Create Account</a>
                      </h6>
                    </div>
                    <div class="pull-right mr-3 mb-3">
                      <h6>
                        <a href="#pablo" class="link footer-link">Need Help?</a>
                      </h6>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                {{-- @if (!empty(sc_config('LoginSocialite')))
                    <ul>
                    <li class="rd-dropdown-item">
                      <a class="rd-dropdown-link" href="{{ sc_route('login_socialite.index', ['provider' => 'facebook']) }}"><i class="fab fa-facebook"></i>
                         {{ trans('front.login') }} facebook</a>
                    </li>
                    <li class="rd-dropdown-item">
                      <a class="rd-dropdown-link" href="{{ sc_route('login_socialite.index', ['provider' => 'google']) }}"><i class="fab fa-google-plus"></i>
                         {{ trans('front.login') }} google</a>
                    </li>
                    <li class="rd-dropdown-item">
                      <a class="rd-dropdown-link" href="{{ sc_route('login_socialite.index', ['provider' => 'github']) }}"><i class="fab fa-github"></i>
                         {{ trans('front.login') }} github</a>
                    </li>
                    </ul>
                @endif
                <p class="lost_password form-group">
                    <a class="btn btn-link" href="{{ sc_route('forgot') }}">
                        {{ trans('account.password_forgot') }}
                    </a>
                    <br>
                    <a class="btn btn-link" href="{{ sc_route('register') }}">
                        {{ trans('account.title_register') }}
                    </a>
                </p> --}}
