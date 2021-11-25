
<!-- Modal register -->
<div class="wrap-modal-register js-modal-register p-t-60 p-b-20 p-lr-20">
    <div class="overlay-modal-register js-hide-modal-register"></div>

    <div class="row p-0">
        <div class="col-md-8 col-lg-6 col-sm-12 m-lr-auto bg0 p-t-60 p-b-60 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal-register">
                <img src="{{ asset($bc_templateFile)}}/images/icons/icon-close.png" alt="CLOSE">
            </button>
            <div class="flex-w flex-tr">
                <div class="size-209 m-lr-auto bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="{{bc_route('postRegister')}}" method="post" class="form register-form" id="form-process">
                        {!! csrf_field() !!}
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{ trans('account.title_register') }}
                        </h4>
                        @if (bc_config('customer_lastname'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('first_name'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.first_name') }}" name="first_name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        {{ $errors->first('first_name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('last_name'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.last_name') }}" name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        {{ $errors->first('last_name') }}
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('first_name'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.first_name') }}" name="first_name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        {{ $errors->first('first_name') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_name_kana'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('first_name_kana') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('first_name_kana'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.first_name_kana') }}" name="first_name_kana" value="{{ old('first_name_kana') }}">
                                @if ($errors->has('first_name_kana'))
                                    <span class="help-block">
                                        {{ $errors->first('first_name_kana') }}
                                    </span>
                                @endif
                            </div>
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('last_name_kana') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('last_name_kana'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.last_name_kana') }}" name="last_name_kana" value="{{ old('last_name_kana') }}">
                                @if ($errors->has('last_name_kana'))
                                    <span class="help-block">
                                        {{ $errors->first('last_name_kana') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('email'))?"input-error":"" }}" type="email" 
                            placeholder="{{ trans('account.email') }}" name="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        @if (bc_config('customer_phone'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('phone'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.phone') }}" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        {{ $errors->first('phone') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_postcode'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('postcode') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('postcode'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.postcode') }}" name="postcode" value="{{ old('postcode') }}">
                                @if ($errors->has('postcode'))
                                    <span class="help-block">
                                        {{ $errors->first('postcode') }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('address1') ? ' has-error' : '' }}">
                            <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('address1'))?"input-error":"" }}" type="text" 
                            placeholder="{{ trans('account.address1') }}" name="address1" value="{{ old('address1') }}">
                            @if ($errors->has('address1'))
                                <span class="help-block">
                                    {{ $errors->first('address1') }}
                                </span>
                            @endif
                        </div>

                        @if (bc_config('customer_address2'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('address2') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('address2'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.address2') }}" name="address2" value="{{ old('address2') }}">
                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        {{ $errors->first('address2') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                
                        @if (bc_config('customer_address3'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('address3') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('address3'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.address3') }}" name="address3" value="{{ old('address3') }}">
                                @if ($errors->has('address3'))
                                    <span class="help-block">
                                        {{ $errors->first('address3') }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if (bc_config('customer_company'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('company') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('company'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.company') }}" name="company" value="{{ old('company') }}">
                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        {{ $errors->first('company') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                
                        @if (bc_config('customer_country'))
                            @if(!Cache::has(session('adminStoreId').'_cache_countries_'.bc_get_locale()))
                                @php
                                    bc_set_cache(session('adminStoreId').'_cache_countries_'.bc_get_locale(), $bc_countriesList);
                                @endphp
                                @else
                                @php
                                    $bc_countriesList = Cache::get(session('adminStoreId').'_cache_countries_'.bc_get_locale())
                                @endphp
                            @endif
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9 {{ $errors->has('country') ? ' has-error' : '' }}">
                                <select class="js-select2 country" id="addressList" name="country">
                                    <option>__{{ trans('account.country') }}__</option>
                                    @foreach ($bc_countriesList as $k => $v)                                
                                        <option value="{{ $k }}" {{ (old('country') ==$k) ? 'selected':'' }}>{{ $v }}</option>
                                        <div class="dropDownSelect2"></div>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                                @if ($errors->has('country'))
                                    <span class="help-block p-l-20">
                                        {{ $errors->first('country') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_sex'))
                            <div class="flex-sb-m bor8 m-b-20 how-pos4-parent p-lr-20 p-tb-13 {{ $errors->has('sex') ? ' has-error' : '' }}">
                                <label class="dis-inline-block m-b-0 {{ ($errors->has('sex'))?"input-error":"" }}">{{ trans('account.sex') }}:</label>
                                <label class="dis-inline-block m-b-0">
                                    <input class="dis-inline-block" value="0" type="radio" name="sex" {{ (old('sex') == 0)?'checked':'' }}> {{ trans('account.sex_women') }}
                                </label>
                                <label class="m-b-0">
                                    <input class="dis-inline-block" value="1" type="radio" name="sex" {{ (old('sex') == 1)?'checked':'' }}> {{ trans('account.sex_men') }}
                                </label>
                                @if ($errors->has('sex'))
                                    <span class="help-block">
                                        {{ $errors->first('sex') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_birthday'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('birthday'))?"input-error":"" }}" type="date" 
                                placeholder="{{ trans('account.birthday') }}" data-date-format="YYYY-MM-DD" name="birthday" value="{{ old('birthday','1996-07-20') }}">
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        {{ $errors->first('birthday') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if (bc_config('customer_group'))
                            <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('group') ? ' has-error' : '' }}">
                                <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('group'))?"input-error":"" }}" type="text" 
                                placeholder="{{ trans('account.group') }}" name="group" value="{{ old('group') }}">
                                @if ($errors->has('group'))
                                    <span class="help-block">
                                        {{ $errors->first('group') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    
                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('password'))?"input-error":"" }}" type="password" 
                            placeholder="{{ trans('account.password') }}" name="password" value="">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input class="stext-111 cl2 plh3 size-116 {{ ($errors->has('password_confirmation'))?"input-error":"" }}" type="password" 
                            placeholder="{{ trans('account.password') }}" name="password_confirmation" value="">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </div>                        
                        {!! $viewCaptcha ?? ''!!}
                        <button type="submit" class="flex-c-m m-b-20 stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{ trans('account.signup') }}
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