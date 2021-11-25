<script type="text/javascript">
@if(Session::has('message') || Session::has('status'))
    showNotification({!! Session::get('status') !!}, {!! Session::get('message') !!})
@endif

@if(Session::has('success'))
    showNotification('success', {!! Session::get('success') !!})
@endif

@if(Session::has('error'))
    showNotification('danger', {!! Session::get('error') !!})
@endif

@if(Session::has('warning'))
    showNotification('warning', {!! Session::get('warning') !!})
@endif
</script>