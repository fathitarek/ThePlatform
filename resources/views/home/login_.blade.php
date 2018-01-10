<!DOCTYPE html><!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!--><html lang="en"><!--<![endif]--><!-- BEGIN HEAD --><head>    <meta charset="utf-8" />    @yield('pageTitle')    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta content="width=device-width, initial-scale=1" name="viewport" />    <meta content="" name="description" />    <meta content="" name="author" />    <!-- BEGIN GLOBAL MANDATORY STYLES -->    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />    <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />    <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />    <!-- END GLOBAL MANDATORY STYLES -->    <!-- BEGIN PAGE LEVEL PLUGINS -->    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />    <!-- END PAGE LEVEL PLUGINS -->    <!-- BEGIN THEME GLOBAL STYLES -->    <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />    <link href="" rel="stylesheet" type="text/css" />    <!-- END THEME GLOBAL STYLES -->    <!-- BEGIN PAGE LEVEL STYLES -->    <link href="{{ asset('assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />    <!-- END PAGE LEVEL STYLES -->    <!-- BEGIN THEME LAYOUT STYLES -->    <!-- END THEME LAYOUT STYLES -->    <link rel="shortcut icon" href="favicon.ico" />    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">    <style>        .width-percentage-100 .bootstrap-tagsinput {            width: 100%;            border: 1px solid #c3ccda;            background-color: #dde3ec;            height: 43px;            color: #8290a3;            line-height: 35px;        }    </style></head><!-- END HEAD --><body class=" login"><!-- BEGIN LOGO --><div class="logo">    <a href="{{ URL('') }}">        <img src="{{ asset('img/logo-big.png') }}" alt="" />    </a></div><!-- END LOGO --><!-- BEGIN LOGIN --><div class="content">    <!-- BEGIN LOGIN FORM -->    <form class="login-form" action="{{ URL('login') }}" method="post">        {{ csrf_field() }}        <h3 class="form-title font-green">Sign In</h3>        <div class="alert alert-danger display-hide">            <button class="close" data-close="alert"></button>            <span> Enter any email and password. </span>        </div>        @if($errors->any())            <div class="alert alert-danger">            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                <ul>                    @foreach($errors->all() as $error)                        <li>{{ $error }}</li>                    @endforeach                </ul>            </div>        @endif        @if(!empty( Session::get('error') ))            <div class="alert  alert-danger">                <button class="close" aria-hidden="true" data-dismiss="alert">&times;</button>                <h4 class="alert-heading"> {!! Session::get('error') !!}</h4>                {{ Session::forget('error') }}            </div>        @endif        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.email') }}</label>            <input class="form-control form-control-solid placeholder-no-fix" value="{{ old('email') }}" type="email" autocomplete="off" placeholder="{{ Lang::get('home.enter').Lang::get('home.email') }}" name="email" />            @if ($errors->has('username'))                <span class="help-block">                        <strong>{{ $errors->first('email') }}</strong>                </span>            @endif        </div>        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">            <label class="control-label visible-ie8 visible-ie9">Password</label>            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />            @if ($errors->has('password'))                <span class="help-block">                        <strong>{{ $errors->first('password') }}</strong>                    </span>            @endif        </div>        <div class="form-actions">            <button type="submit" class="btn green uppercase">Login</button>            <label class="rememberme check mt-checkbox mt-checkbox-outline">                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1" />Remember                <span></span>            </label>            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>        </div>        <div class="login-options">            <h4>Or login with</h4>            <ul class="social-icons">                <li>                    <a class="social-icon-color facebook" data-original-title="facebook" href="{{ URL('login/facebook') }}"></a>                </li>                <li>                    <a class="social-icon-color twitter" data-original-title="Twitter" href="{{ URL('login/twitter') }}"></a>                </li>                <li>                    <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="{{ URL('login/google') }}"></a>                </li>                <li>                    <a class="social-icon-color linkedin" data-original-title="Linkedin" href="{{ URL('login/linkedin') }}"></a>                </li>            </ul>        </div>        <div class="create-account">            <p>                <a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>            </p>        </div>    </form>    <!-- END LOGIN FORM -->    <!-- BEGIN FORGOT PASSWORD FORM -->    <form class="forget-form" action="index.html" method="post">        <h3 class="font-green">Forget Password ?</h3>        <p> Enter your e-mail address below to reset your password. </p>        <div class="form-group">            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>        <div class="form-actions">            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>        </div>    </form>    <!-- END FORGOT PASSWORD FORM -->    <!-- BEGIN REGISTRATION FORM -->    <form class="register-form" id="register-form" method="post">        <h3 class="font-green">Sign Up</h3>        <p class="hint"> Enter your personal details below: </p>        <div class="alert alert-danger display-hide">            <button class="close" data-close="alert"></button>            You have some form errors. Please check below.        </div>        <div class="alert alert-success display-hide">            <button class="close" data-close="alert"></button>            Your form validation is successful!        </div>        <div id="registerErrors"></div>        <input type="hidden" name="register_register_type" value="@if($userSocialType){{ $userSocialType }}@else{{ 'web' }}@endif">        <input type="hidden" name="register_social_id" value="@if($userSocialType){{ $userSocialData->id }}@else{{ '' }}@endif">        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.type') }}</label>            <select name="register_type" id="register_type" class="form-control">                <option value="company">{{ Lang::get('home.company') }}</option>                <option value="personal">{{ Lang::get('home.personal') }}</option>            </select>        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.name') }}</label>            <input class="form-control placeholder-no-fix" value="@if($userSocialData){{ $userSocialData->name }}@endif" type="text" placeholder="{{ Lang::get('home.enter').Lang::get('home.name') }}" name="register_name" />        </div>        <div class="form-group">            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.email') }}</label>            <input class="form-control placeholder-no-fix" value="@if($userSocialData){{ $userSocialData->email }}@endif" type="email" placeholder="{{ Lang::get('home.enter').Lang::get('home.email') }}" name="register_email" />        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.phone') }}</label>            <input class="form-control placeholder-no-fix"  type="tel" placeholder="{{ Lang::get('home.enter').Lang::get('home.phone') }}" name="register_phone" />        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.password') }}</label>            <input class="form-control placeholder-no-fix" id="register_password" type="password" placeholder="{{ Lang::get('home.enter').Lang::get('home.password') }}" name="register_password" />        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.confirm_password') }}</label>            <input class="form-control placeholder-no-fix" type="password" placeholder="{{ Lang::get('home.enter').Lang::get('home.confirm_password') }}" name="register_confirm_password" />        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.country') }}</label>            <select name="register_country_id" id="register_country_id" class="form-control">                <option value="">{{ Lang::get('home.select').Lang::get('home.country') }}</option>                @foreach($countries as $country)                    <option value="{{ $country->id }}">{{ $country->name }}</option>                @endforeach            </select>        </div>        <div class="form-group">            <label class="control-label visible-ie8 visible-ie9">{{ Lang::get('home.time_zone') }}</label>            <select name="register_time_zone" id="register_time_zone" class="form-control">            </select>        </div>        <div class="form-group margin-top-20 margin-bottom-20">            <label class="mt-checkbox mt-checkbox-outline">                <input type="checkbox" name="tnc" id="tnc" /> I agree to the                <a href="javascript:;">Terms of Service </a> &                <a href="javascript:;">Privacy Policy </a>                <span></span>            </label>            <div id="register_tnc_error"></div>        </div>        <div class="form-actions">            <button type="button" id="register-back-btn" class="btn green btn-outline">Back</button>            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>        </div>    </form>    <!-- END REGISTRATION FORM --></div><div class="copyright"> 2014 ©  </div><!--[if lt IE 9]><script src="{{ asset('assets/global/plugins/respond.min.js') }}"></script><script src="{{ asset('assets/global/plugins/excanvas.min.js') }}"></script><![endif]--><!-- BEGIN CORE PLUGINS --><script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script><!-- END CORE PLUGINS --><!-- BEGIN PAGE LEVEL PLUGINS --><script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script><script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script><!-- END PAGE LEVEL PLUGINS --><!-- BEGIN THEME GLOBAL SCRIPTS --><script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script><!-- END THEME GLOBAL SCRIPTS --><!-- BEGIN PAGE LEVEL SCRIPTS --><!-- END PAGE LEVEL SCRIPTS --><!-- BEGIN THEME LAYOUT SCRIPTS --><!-- END THEME LAYOUT SCRIPTS --><script src="{{ asset('js/bootstrap-typeahead.js') }}"></script><script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script><script>    @if($userSocialData)     jQuery('.login-form').hide();    jQuery('.register-form').show();    @endif        $('.login-form').validate({            errorElement: 'span', //default input error message container            errorClass: 'help-block', // default input error message class            focusInvalid: false, // do not focus the last invalid input            rules: {                email: {                    required: true,                    email: true                },                password: {                    required: true                },                remember: {                    required: false                }            },            messages: {                email: {                    required: "Email is required."                },                password: {                    required: "Password is required."                }            },            invalidHandler: function(event, validator) { //display error alert on form submit                $('.alert-danger', $('.login-form')).show();            },            highlight: function(element) { // hightlight error inputs                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group            },            success: function(label) {                label.closest('.form-group').removeClass('has-error');                label.remove();            },            errorPlacement: function(error, element) {                error.insertAfter(element.closest('.input-icon'));            },            submitHandler: function(form) {                form.submit(); // form validation success, call ajax form submit            }        });        $('.login-form input').keypress(function(e) {            if (e.which == 13) {                if ($('.login-form').validate().form()) {                    $('.login-form').submit(); //form validation success, call ajax form submit                }                return false;            }        });        $('.forget-form').validate({            errorElement: 'span', //default input error message container            errorClass: 'help-block', // default input error message class            focusInvalid: false, // do not focus the last invalid input            ignore: "",            rules: {                email: {                    required: true,                    email: true                }            },            messages: {                email: {                    required: "Email is required."                }            },            invalidHandler: function(event, validator) { //display error alert on form submit            },            highlight: function(element) { // hightlight error inputs                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group            },            success: function(label) {                label.closest('.form-group').removeClass('has-error');                label.remove();            },            errorPlacement: function(error, element) {                error.insertAfter(element.closest('.input-icon'));            },            submitHandler: function(form) {                form.submit();            }        });        $('.forget-form input').keypress(function(e) {            if (e.which == 13) {                if ($('.forget-form').validate().form()) {                    $('.forget-form').submit();                }                return false;            }        });        jQuery('#forget-password').click(function() {            jQuery('.login-form').hide();            jQuery('.forget-form').show();        });        jQuery('#back-btn').click(function() {            jQuery('.login-form').show();            jQuery('.forget-form').hide();        });        jQuery('#register-btn').click(function() {            jQuery('.login-form').hide();            jQuery('.register-form').show();        });        jQuery('#register-back-btn').click(function() {            jQuery('.login-form').show();            jQuery('.register-form').hide();        });    function clear_form_elements(ele) {        $(ele).find(':input').each(function() {            switch(this.type) {                case 'password':                case 'email':                case 'tel':                case 'select-multiple':                case 'select-one':                case 'text':                case 'textarea':                    $(this).val('');                    break;                case 'checkbox':                case 'radio':                    this.checked = false;            }        });    }    token= '{{ csrf_token() }}';    var registerForm=$("#register-form");    var error3 = $('.alert-danger', registerForm);    var success3 = $('.alert-success', registerForm);    registerForm.validate({        errorElement: 'span', //default input error message container        errorClass: 'help-block help-block-error', // default input error message class        focusInvalid: false, // do not focus the last invalid input        ignore: "", // validate all fields including form hidden input        rules: {            register_country_id: {                required: true            },            register_name: {                required: true            },            register_email: {                minlength: 2,                required: true,                email:true            },            register_phone: {                required: true,                number: true            },            register_password: {                minlength: 6,                required: true            },            register_confirm_password: {                minlength: 6,                required: true,                equalTo:"#register_password"            },        },        messages: { // custom messages for radio buttons and checkboxes            membership: {                required: "Please select a Membership type"            },            service: {                required: "Please select  at least 2 types of Service",                minlength: jQuery.validator.format("Please select  at least {0} types of Service")            }        },        errorPlacement: function (error, element) { // render error placement for each input type            if (element.parent(".input-group").size() > 0) {                error.insertAfter(element.parent(".input-group"));            } else if (element.attr("data-error-container")) {                error.appendTo(element.attr("data-error-container"));            } else if (element.parents('.radio-list').size() > 0) {                error.appendTo(element.parents('.radio-list').attr("data-error-container"));            } else if (element.parents('.radio-inline').size() > 0) {                error.appendTo(element.parents('.radio-inline').attr("data-error-container"));            } else if (element.parents('.checkbox-list').size() > 0) {                error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));            } else if (element.parents('.checkbox-inline').size() > 0) {                error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));            } else {                error.insertAfter(element); // for other inputs, just perform default behavior            }        },        invalidHandler: function (event, validator) { //display error alert on form submit            error3.show();            App.scrollTo(error3, -200);        },        highlight: function (element) { // hightlight error inputs            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group        },        unhighlight: function (element) { // revert the change done by hightlight            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group        },        success: function (label) {            label.closest('.form-group').removeClass('has-error'); // set success class to the control group        },        submitHandler: function (form) {            error3.hide();            if($("#tnc").is(":checked")){                $.ajax({                    type: "POST",                    url: "{{ URL('register') }}?"+$(form).serialize(),                    data: {_token:token},                    success: function (msg) {                        $("#registerErrors").html(msg.message);                        $("#register_tnc_error").html('')                        if(msg.success){                            clear_form_elements(form);                        }                    }                });            }else{                $("#register_tnc_error").html('<div class="alert alert-danger">{{ Lang::get('home.error_check_term_condition') }}</div>');            }            //form.submit(); // submit the form        }    });    //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.    $('.select2me', registerForm).change(function () {        registerForm.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input    });    $(document).on('change','#register_country_id',function(){        country_id=$(this).val();        $.ajax({            type: "POST",            url: "{{ URL('timeZone') }}",            data: {"country_id": country_id,_token:token},            success: function (msg) {                if(msg.success){                    $("#register_time_zone").html(msg.html)                }            }        });    });</script></body></html>