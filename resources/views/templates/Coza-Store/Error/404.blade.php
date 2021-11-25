@extends($bc_templatePath.'.Layout.main')

@section('content')
<div class="bg0 container text-center">
	<img class="w-50 image-err" src="{{ asset($bc_templateFile)}}/images/404.png">
    <div class="header-cart-buttons p-b-70">
        <a href="{{bc_route('home')}}" class="stext-101 cl0 size-111 bg3 bor2 hov-btn3 trans-04 p-lr-15 p-tb-5">
            {{trans('front.home')}}
        </a>
    </div>
</div>
<!-- /.col -->
@endsection
@push('styles')
<style type="text/css">
	.image-err{
		height: 50vh;
		object-fit: cover;
	}
</style>
@endpush