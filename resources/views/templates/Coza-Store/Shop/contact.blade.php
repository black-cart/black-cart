@php
/*
$layout_page = shop_contact
*/
@endphp

@extends($bc_templatePath.'.Layout.main')

@section('content')
<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md"> 
                <form method="post" action="{{ bc_route('contact.post') }}" class="contact-form" id="form-process">
                    {{ csrf_field() }}
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Send Us A Message
                    </h4>

                    <div class="bor8 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 {{ $errors->has('title') ? ' has-error' : '' }}" type="text" name="title" placeholder="{{ trans('front.contact_form.title') }}" value="{{ old('title') }}">
                        <span class="lnr lnr-text-format fs-18 cl5 txt-center how-pos4"></span>
                    </div>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            {{ $errors->first('title') }}
                        </span>
                    @endif
                    
                    <div class="bor8 m-t-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 {{ $errors->has('name') ? ' has-error' : '' }}" type="text" name="name" placeholder="{{ trans('front.contact_form.name') }}" value="{{ old('name') }}">
                        <span class="lnr lnr-user fs-18 cl5 txt-center how-pos4"></span>
                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif

                    <div class="bor8 m-t-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 {{ $errors->has('email') ? ' has-error' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('front.contact_form.email') }}">
                        <span class="lnr lnr-envelope fs-18 cl5 txt-center how-pos4"></span>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                    @endif

                    <div class="bor8 m-t-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 {{ $errors->has('phone') ? ' has-error' : '' }}" type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('front.contact_form.phone') }}">
                        <span class="lnr lnr-phone-handset fs-18 cl5 txt-center how-pos4"></span>
                    </div>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif

                    <div class="bor8 m-t-20">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25 {{ $errors->has('content') ? ' has-error' : '' }}" name="content" placeholder="{{ trans('front.contact_form.content') }}">{{ old('content') }}</textarea>
                    </div>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            {{ $errors->first('content') }}
                        </span>
                    @endif
                    {!! $viewCaptcha?? '' !!}
                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer m-t-20">
                        {{ trans('front.contact_form.submit') }}
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                    </span>
                    <div class="size-212 p-t-2">
                        <img src="{{ asset(bc_store('logo')) }}" alt="IMG">
                    </div>
                </div>
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Address
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            {{ bc_store('address') }}
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Lets Talk
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            {{ bc_store('long_phone') }}
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Sale Support
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            {{ bc_store('email') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
{{-- Render include view --}}
@if (!empty($layout_page && $includePathView = config('bc_include_view.'.$layout_page, [])))
@foreach ($includePathView as $view)
  @if (view()->exists($view))
    @include($view)
  @endif
@endforeach
@endif
{{--// Render include view --}}

@endsection

{{-- breadcrumb --}}
@section('breadcrumb')
    @php
    $bannerBreadcrumb = $modelBanner->start()->settype('breadcrumb_contact')->getData()->first();
    @endphp
    @if($bannerBreadcrumb)
        <!-- Title page -->
        <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset($bannerBreadcrumb['image'] ?? '') }}');">
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

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- Render include script --}}
@if (!empty($layout_page) && $includePathScript = config('bc_include_script.'.$layout_page, []))
@foreach ($includePathScript as $script)
  @if (view()->exists($script))
    @include($script)
  @endif
@endforeach
@endif
{{--// Render include script --}}
@endpush