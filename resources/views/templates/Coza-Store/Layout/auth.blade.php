
{{-- Modal login --}}
@section('login')
    @include($bc_templatePath.'.Auth.login')
@show
{{--// Modal Login --}}


{{-- Modal login --}}
@section('register')
    @include($bc_templatePath.'.Auth.register')
@show
{{--// Modal Login --}}

{{-- Modal forgot --}}
@section('forgot')
    @include($bc_templatePath.'.Auth.forgot')
@show
{{--// Modal forgot --}}

@if(Session::has('reset_state') || Session::has('reset_failed'))
	{{-- Modal forgot --}}
	@section('reset')
		<a href="javascript:void(0)" class="js-show-modal-reset dis-none"></a>
	    @include($bc_templatePath.'.Auth.reset')
	@show
	{{--// Modal forgot --}}
@endif