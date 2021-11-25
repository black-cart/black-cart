@if (bc_store('active') == '1'  || (bc_store('active') == '0' && auth()->guard('admin')->user()))
{{-- Admin logged can view the website content under maintenance --}}
@if (bc_store('active') == '0' && auth()->guard('admin')->user())
    @include($bc_templatePath . '.maintenance_note')
@endif
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{$title??bc_store('title')}}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $description??bc_store('description') }}">
    <meta name="keywords" content="{{ $keyword??bc_store('keyword') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:image" content="{{ !empty($og_image)?asset($og_image):asset('images/org.jpg') }}" />
    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="{{ $title??bc_store('title') }}" />
    <meta property="og:description" content="{{ $description??bc_store('description') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($bc_templateFile.'/images/icons/favicon.png?t=20210729')}}">
    <link rel="icon" type="image/png" href="{{ asset($bc_templateFile.'/images/icons/favicon.png?t=20210729')}}" sizes="16x16">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/slick/slick.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset($bc_templateFile)}}/css/main.css">
<!--===============================================================================================-->
    <!--Module meta -->
    @isset ($bc_blocksContent['meta'])
        @foreach ( $bc_blocksContent['meta'] as $layout)
            @php
                $arrPage = explode(',', $layout->page)
            @endphp
            @if ($layout->page == '*' || (isset($layout_page) && in_array($layout_page, $arrPage)))
                @if ($layout->type =='html')
                    {!! $layout->text !!}
                @endif
            @endif
        @endforeach
    @endisset
    <!--//Module meta -->
    @stack('styles')
    <style>
        {!! bc_store_css() !!}
    </style>
</head>
<body class="animsition">
    {{-- Block header --}}
    @section('header')
        @include($bc_templatePath.'.Layout.header')
    @show
    {{--// Block header --}}

    {{-- Block cart --}}
    @section('cart')
        @include($bc_templatePath.'.Layout.cart')
    @show
    {{--// Block cart --}}

    {{-- Block favorite --}}
    @section('favorite')
        @include($bc_templatePath.'.Layout.favorite')
    @show
    {{--// Block favorite --}}

    {{-- Block top --}}
    @section('top')
        @include($bc_templatePath.'.Layout.top')
    @show
    {{--// Block top --}}

    {{-- Block content --}}
    @yield('content')
    {{--// Block content --}}

    {{-- Block footer --}}
    @section('footer')
        @include($bc_templatePath.'.Layout.footer')
    @show
    {{--// Block footer --}}


    {{-- Modal auth --}}
    @section('auth')
        @include($bc_templatePath.'.Layout.auth')
    @show
    {{--// Modal auth --}}

    {{-- Modal auth --}}
    @section('quick_view_product')
        @include($bc_templatePath.'.Components.quick_view_product')
    @show
    {{--// Modal auth --}}

</body>





<!--===============================================================================================-->  
    <script src="{{ asset($bc_templateFile)}}/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset($bc_templateFile)}}/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset($bc_templateFile)}}/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/slick/slick.min.js"></script>
    <script src="{{ asset($bc_templateFile)}}/js/slick-custom.js"></script>
<!--===============================================================================================-->
    {{-- <script src="{{ asset($bc_templateFile)}}/vendor/parallax100/parallax100.js"></script> --}}
    {{-- <script>
        $('.parallax100').parallax100();
    </script> --}}
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!--===============================================================================================-->
    <script type="text/javascript" src="{{ asset($bc_templateFile)}}/js/js-cloudimage-360-view.min.js"></script>
    <script type="text/javascript" src="{{ asset($bc_templateFile)}}/js/v2.0.0.lazysizes.min.js"></script>
    
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
        window.cloudimg = '{{env('APP_CLOUD_URL')}}';
    </script>
<!--===============================================================================================-->
    <script src="{{ asset($bc_templateFile)}}/js/main.js"></script>
    @include($bc_templatePath.'.Common.js')
    @stack('scripts')
    @stack('isotope')
</html>

@else
    @include($bc_templatePath . '.maintenance')
@endif