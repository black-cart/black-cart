@php
/*
$layout_page = shop_profile
**Variables:**
- $customer
*/ 
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
<section class="bg0 p-t-75 p-b-120"> 
    <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-3">
            @include($bc_templatePath.'.account.nav_customer')
        </div>
        <div class="col-12 col-sm-12 col-md-6">
            <h4 class="mtext-109 cl2 p-b-30">
                {{ $title }}
            </h4>
            <form class="form login-form" action="{{ bc_route('customer.post_change_password') }}"  method="POST">
                @csrf

                <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ Session::has('password_old_error') ? ' has-error' : '' }}">
                    <input class="stext-111 cl2 plh3 size-116" type="password" 
                    placeholder="{{ trans('account.password_old') }}" name="password_old">
                    @if(Session::has('password_old_error'))
                        <span class="help-block">{{ Session::get('password_old_error') }}</span>
                    @endif
                </div>

                <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="log-password stext-111 cl2 plh3 size-116" type="password" 
                    placeholder="{{ trans('account.password_new') }}" name="password">
                    @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="bor8 m-b-20 how-pos4-parent p-l-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input class="log-password stext-111 cl2 plh3 size-116" type="password" id="password-confirm"
                    placeholder="{{ trans('account.password_confirm') }}" name="password_confirmation">
                </div>

                <button type="submit" class="flex-c-m m-b-20 stext-101 cl0 size-112 m-lr-auto bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                    {{ trans('account.update_infomation') }}
                </button>
            </form>
        </div>
    </div>
</div>
</section>
@endsection

{{-- breadcrumb --}}
@section('breadcrumb')
    @php
        $bannerStore = $modelBanner->start()->settype('breadcrumb_account')->getData()->first();
    @endphp
    @if($bannerStore)
        <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerStore['image'] ?? '') }}');">
            <h2 class="ltext-105 cl0 txt-center">
            {{ $title ?? '' }}
            </h2>
        </section>  
    @endif
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
            <a href="{{ bc_route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ trans('front.home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                {{ $title ?? '' }}
            </span>
        </div>
    </div>
@endsection
{{-- //breadcrumb --}}