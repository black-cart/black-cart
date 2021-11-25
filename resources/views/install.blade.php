<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="icon" href="images/icon.png" type="image/png" sizes="16x16">
    <link href="admin/black/fonts/Poppins-font.css" rel="stylesheet" />
    <link href="admin/black/fonts/all.css" rel="stylesheet" />
    <!-- Icons -->
    <link href="admin/black/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS -->
    <link href="admin/black/css/black-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="admin/black/css/theme.css" rel="stylesheet" />
        <style type="text/css">
            .success,.passed::marker{
                color: #418802;
            }
            .has-danger:after, .has-success:after{
                top:35px;
            }
        </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                    </p>
                    <div class="author">
                        <div class="block block-one"></div>
                        <div class="block block-two"></div>
                        <div class="block block-three"></div>
                        <div class="block block-four"></div>
                        <a href="javascript:void(0)">
                            <img class="avatar" src="images/mylogo.png" alt="...">
                            <h5 class="title">{{ config('black-cart.title') }}</h5>
                        </a>
                        <p class="description">
                            <b>{{ trans('install.info.version') }}</b>: {{ config('black-cart.version') }}
                        </p>


                        <div class="dropdown">
                            <button class="dropdown-toggle btn btn-primary btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true">
                                @if ($path_lang == '?lang=vi')
                                <img src="data/language/flag_vn.png" style="height: 25px;">
                                @else
                                <img src="data/language/flag_uk.png" style="height: 25px;">
                                @endif
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                                <a class="dropdown-item" href="install.php"><img src="data/language/flag_uk.png" style="height: 25px;"> English</a>
                                <a class="dropdown-item" href="install.php?lang=vi"><img src="data/language/flag_vn.png" style="height: 25px;"> Vietnamese</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-description">
                    {{ trans('install.info.about') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button href="javascript:void(0)" class="btn btn-icon btn-round btn-facebook">
                        <i class="fab fa-facebook"></i>
                        </button>
                        <button href="javascript:void(0)" class="btn btn-icon btn-round btn-twitter">
                        <i class="fab fa-twitter"></i>
                        </button>
                        <button href="javascript:void(0)" class="btn btn-icon btn-round btn-google">
                        <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @php
                        $checkRequire = 'pass';
                    @endphp
                    <h5>{{ trans('install.check_extension') }}</h5>
                    @if (count($requirements['ext']))
                        <ul class="check_ext">
                            @foreach ($requirements['ext'] as $label => $result)
                                @php
                                    if($result) {
                                        $status = 'passed';
                                    } else {
                                        $status = $checkRequire = 'failed';
                                    }
                                @endphp
                                    <li class="{{ $status }}">{{ $label }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <h5>{{ trans('install.check_writable') }}</h5>
                    @if (count($requirements['writable']))
                        <ul class="check_ext">
                            @foreach ($requirements['writable'] as $label => $result)
                                @php
                                    if($result) {
                                        $status = 'passed';
                                    } else {
                                        $status = $checkRequire = 'failed';
                                    }
                                @endphp
                                    <li class="{{ $status }}">{{ $label }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <form  class="form-horizontal" id="InstallValidation">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group" id="div_database_host">
                            <label for="database_host">{{ trans('install.database_host') }}</label>
                            <input class="form-control" name="database_host" type="text" id="database_host" value="127.0.0.1" 
                            placeholder="{{ trans('install.database_host') }}" required>
                        </div>

                        <div class="form-group" id="div_database_port">
                            <label for="database_port">{{ trans('install.database_port') }}</label>
                            <input class="form-control" name="database_port" type="number" id="database_port" value="3306"
                            placeholder="{{ trans('install.database_port') }}" required>
                        </div>

                        <div class="form-group" id="div_database_name">
                            <label for="database_name">{{ trans('install.database_name') }}</label>
                            <input class="form-control" name="database_name" type="text" id="database_name"
                            placeholder="{{ trans('install.database_name') }}" required>
                        </div>

                        <div class="form-group" id="div_database_user">
                            <label for="database_user">{{ trans('install.database_user') }}</label>
                            <input class="form-control" name="database_user" type="text" id="database_user" value="root" 
                            placeholder="{{ trans('install.database_user') }}" required>
                        </div>

                        <div class="form-group" id="div_database_password">
                            <label for="database_password">{{ trans('install.database_password') }}</label>
                            <input class="form-control" name="database_password" type="password" id="database_password" 
                            placeholder="{{ trans('install.database_password') }}">
                        </div>

                        <div class="form-group" id="div_database_prefix">
                            <label for="database_prefix">{{ trans('install.database_prefix') }}</label>
                            <input class="form-control" name="database_prefix" type="text" id="database_prefix" 
                            placeholder="{{ trans('install.database_prefix_help') }}" required>
                        </div>

                        <hr>

                        <div id="div_language_default" class="form-group">
                            <label for="language_default"> {{ trans('install.language_default') }} </label>
                            <select name="language_default" id="language_default" class="selectpicker" data-style="btn btn-primary" tabindex="-98">
                                @foreach (['vi' => 'VietNam', 'en' => 'English'] as $key => $value)
                                    <option value="{{ $key }}">{{  $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="div_timezone_default" class="form-group">
                            <label for="timezone_default"> {{ trans('install.timezone_default') }} </label>
                            <select name="timezone_default" id="timezone_default" class="selectpicker" data-style="btn btn-primary" tabindex="-98">
                                @foreach (timezone_identifiers_list() as $key => $value)
                                    <option value="{{ $value }}"  {{ $value == 'Asia/Ho_Chi_Minh'?'selected':'' }}>{{  $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <div id="div_admin_url" class="form-group">
                            <label for="admin_url"> {{ trans('install.admin_url') }} </label>
                            <input class="form-control" id="admin_url"  name="admin_url" placeholder="{{ trans('install.admin_url') }}" type="text" required/>
                        </div>

                        <div id="div_admin_user" class="form-group">
                            <label for="admin_user"> {{ trans('install.admin_user') }} </label>
                            <input class="form-control" id="admin_user" value="admin" name="admin_user" placeholder="{{ trans('install.admin_user') }}" type="text" required/>
                        </div>

                        <div id="div_admin_password" class="form-group">
                            <label for="admin_password"> {{ trans('install.admin_password') }} </label>
                            <input class="form-control" id="admin_password" name="admin_password" placeholder="{{ trans('install.admin_password') }}" type="password" required/>
                        </div>
                        
                        <div id="div_admin_email" class="form-group">
                            <label for="admin_email"> {{ trans('install.admin_email') }} </label>
                            <input class="form-control" id="admin_email" name="admin_email" placeholder="{{ trans('install.admin_email') }}" type="email" required/>
                        </div>
                        
                        <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input checkboxinput" type="checkbox" name="terms" id="id_terms" required/>
                              <span class="form-check-sign"></span>
                              {!! trans('install.terms') !!}
                            </label>
                        </div>

                        <h4 id="msg" class="card-title mt-2"></h4>
                        <div class="progress" style="display: none;">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                              <span class="progress-value">0%</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" {{ ($checkRequire == 'pass')?'':'disabled'}} 
                                class="btn btn-fill btn-primary" 
                                data-loading-text="{{ trans('install.installing_button') }}" 
                                id="submit-install">
                            {{ trans('install.installing') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="admin/black/js/core/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="admin/black/js/core/popper.min.js"></script>
<script src="admin/black/js/core/bootstrap.min.js"></script>
<script src="admin/black/js/plugins/bootstrap-selectpicker.js"></script>
<script type="text/javascript">
$('#submit-install').click(function(event) {
    setFormValidation();
    if($("#InstallValidation").valid()){
        $(this).button('loading');
        $('.progress').show();
            $.ajax({
                url: 'install.php{{ $path_lang }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    database_host:$('#database_host').val(),
                    database_port:$('#database_port').val(),
                    database_name:$('#database_name').val(),
                    database_user:$('#database_user').val(),
                    timezone_default:$('#timezone_default').val(),
                    language_default:$('#language_default').val(),
                    admin_user:$('#admin_user').val(),
                    admin_password:$('#admin_password').val(),
                    database_prefix:$('#database_prefix').val(),
                    admin_email:$('#admin_email').val(),
                    admin_url:$('#admin_url').val(),
                    database_password:$('#database_password').val(),
                    step:'step1',
                },
            })
            .done(function(data) {

                error= parseInt(data.error);
                if(error != 1 && error !=0){
                    $('#msg').removeClass('success');
                    $('#msg').addClass('error');
                    $('#msg').html(data);
                    $('#submit-install').button('reset');
                }
                else if(error ===0)
                {
                    var infoInstall = data.infoInstall;
                    $('#admin_url').val(infoInstall.admin_url);
                    $('#msg').addClass('success');
                    $('#msg').html(data.msg);
                    $('.progress-bar').css("width","15%");
                    $('.progress-bar').html("15%");
                    setTimeout(installDatabaseStep1(infoInstall), 1000);
                } else {
                    $('#msg').removeClass('success');
                    $('#msg').addClass('error');
                    $('#msg').html(data.msg);
                    $('#submit-install').button('reset');
                }
            })
            .fail(function() {
                $('#msg').removeClass('success');
                $('#msg').addClass('error');
                $('#msg').html('{{ trans('install.env.error') }}');
                $('#submit-install').button('reset');

            })
    }
});

function installDatabaseStep1(infoInstall){
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2-1', 'infoInstall':infoInstall},
    })
    .done(function(data) {

         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error === 0)
        {
            var infoInstall = data.infoInstall;
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","25%");
            $('.progress-bar').html("25%");
            setTimeout(installDatabaseStep2(infoInstall), 1000);
        }else{
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error_1') }}');
        $('#submit-install').button('reset');
    })
}


function installDatabaseStep2(infoInstall){
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2-2', 'infoInstall':infoInstall},
    })
    .done(function(data) {

         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error === 0)
        {
            var infoInstall = data.infoInstall;
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","40%");
            $('.progress-bar').html("40%");
            setTimeout(installDatabaseStep3(infoInstall), 1000);
        }else{
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error_2') }}');
        $('#submit-install').button('reset');
    })
}

function installDatabaseStep3(infoInstall){
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2-3', 'infoInstall':infoInstall},
    })
    .done(function(data) {

         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error === 0)
        {
            var infoInstall = data.infoInstall;
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","60%");
            $('.progress-bar').html("60%");
            setTimeout(installDatabaseStep4(infoInstall), 1000);
        }else{
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error_3') }}');
        $('#submit-install').button('reset');
    })
}

function installDatabaseStep4(infoInstall){
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2-4', 'infoInstall':infoInstall},
    })
    .done(function(data) {

         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error === 0)
        {
            var infoInstall = data.infoInstall;
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","75%");
            $('.progress-bar').html("75%");
            setTimeout(installDatabaseStep5(infoInstall), 1000);
        }else{
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error_4') }}');
        $('#submit-install').button('reset');
    })
}

function installDatabaseStep5(infoInstall){
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step2-5', 'infoInstall':infoInstall},
    })
    .done(function(data) {
         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error === 0)
        {
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","85%");
            $('.progress-bar').html("85%");
            setTimeout(completeInstall, 1000);
        }else{
            $('#msg').removeClass('success');
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }

    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.database.error_5') }}');
        $('#submit-install').button('reset');
    })
}

function completeInstall() {
    $.ajax({
        url: 'install.php{{ $path_lang }}',
        type: 'POST',
        dataType: 'json',
        data: {step: 'step3'},
    })
    .done(function(data) {
         error= parseInt(data.error);
        if(error != 1 && error !=0){
            $('#msg').addClass('error');
            $('#msg').html(data);
            $('#submit-install').button('reset');
        }
        else if(error ===0)
        {
            $('#msg').addClass('success');
            $('#msg').html(data.msg);
            $('.progress-bar').css("width","100%");
            $('.progress-bar').html("100%");
            $('#msg').html('{{ trans('install.complete.process_success') }}');
            setTimeout(function(){ window.location.replace($('#admin_url').val()); }, 1000);
        }else{
            $('#msg').addClass('error');
            $('#msg').html(data.msg);
            $('#submit-install').button('reset');
        }
    })
    .fail(function() {
        $('#msg').removeClass('success');
        $('#msg').addClass('error');
        $('#msg').html('{{ trans('install.complete.error') }}');
        $('#submit-install').button('reset');
    })
}



function setFormValidation(id) {
  $(id).validate({
    highlight: function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
      $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
    },
    success: function(element) {
      $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
      $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
    },
    errorPlacement: function(error, element) {
      $(element).closest('.form-group').append(error);
    },
  });
}

$(document).ready(function() {
  setFormValidation('#InstallValidation');
});

</script>

</body>
</html>
