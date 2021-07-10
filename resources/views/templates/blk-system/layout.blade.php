@if (sc_store('active') == '1'  || (sc_store('active') == '0' && auth()->guard('admin')->user()))
        {{-- Admin logged can view the website content under maintenance --}}
    @if (sc_store('active') == '0' && auth()->guard('admin')->user())
        @include($sc_templatePath . '.maintenance_note')
    @endif
<!DOCTYPE html>
<html class="perfect-scrollbar-on" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700%7CLato%7CKalam:300,400,700">
    <meta name="description" content="{{ $description??sc_store('description') }}">
    <meta name="keyword" content="{{ $keyword??sc_store('keyword') }}">
    <title>{{$title??sc_store('title')}}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png" sizes="16x16">
    <meta property="og:image" content="{{ !empty($og_image)?asset($og_image):asset('images/org.jpg') }}" />
    <meta property="og:url" content="{{ \Request::fullUrl() }}" />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="{{ $title??sc_store('title') }}" />
    <meta property="og:description" content="{{ $description??sc_store('description') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($sc_templateFile.'/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset($sc_templateFile.'/img/favicon.png?t=123')}}">
    <!-- css default for -->
    @include($sc_templatePath.'.common.css')
    <!--//end css defaut -->
    <!--Module meta -->
    @isset ($sc_blocksContent['meta'])
        @foreach ( $sc_blocksContent['meta'] as $layout)
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
    <!-- css default for item black-cart -->
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset($sc_templateFile.'/css/nucleo-icons.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset($sc_templateFile.'/css/blk-design-system-pro.css')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset($sc_templateFile.'/css/demo.css')}}" rel="stylesheet" />
    @stack('styles')
    <style>
        {!! sc_store_css() !!}
    </style>
</head>
<body class="{{ $layout_page != 'home' ? 'product-page' : 'ecommerce-page'}}">
    {{-- Block header --}}
    @section('block_header')
    @include($sc_templatePath.'.block_header')
    @show
    {{--// Block header --}}
    <div class="wrapper">
        {{-- Block top --}}
        @section('block_top')
        @include($sc_templatePath.'.block_top')
        @show
        {{-- //Block top --}}
        <div class="main">
            {{-- Block main --}}
            @section('block_main')
                @section('block_main_content')
                    <div class="section">
                        <div class="container">
                            <div class="row">
                                @include($sc_templatePath.'.block_main_content_center')
                                {{-- @include($sc_templatePath.'.block_main_content_right') --}}
                            </div>
                        </div>
                    </div>
                @show
            @show
            {{-- //Block main --}}

            @yield('news')

            {{-- Block bottom --}}
            @section('block_bottom')
            @include($sc_templatePath.'.block_bottom')
            @show
            {{-- //Block bottom --}}

            {{-- Block footer --}}
            @section('block_footer')
            @include($sc_templatePath.'.block_footer')
            @show
            {{-- //Block footer --}}
        </div>
    </div>
    @include($sc_templatePath.'.auth.login')

    <script src="{{ asset($sc_templateFile.'/js/core/jquery.min.js')}}"></script>
    <script src="{{ asset($sc_templateFile.'/js/core/popper.min.js')}}"></script>
    <script src="{{ asset($sc_templateFile.'/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset($sc_templateFile.'/js/blk-design-system-pro.min.js')}}"></script>
    <script src="{{ asset($sc_templateFile.'/js/core/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ asset($sc_templateFile.'/js/demo.js')}}"></script>
    <!-- js default for item black-cart -->
    @include($sc_templatePath.'.common.js')
    <!--//end js defaut -->
    @stack('scripts')

</body>
</html>

@else
    @include($sc_templatePath . '.maintenance')
@endif