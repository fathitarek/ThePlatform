<!DOCTYPE html>
<html>
<!-- Mirrored from light.pinsupreme.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Aug 2017 06:50:20 GMT -->
<head>
    @yield('pageTitle')
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <link href="{{ asset('favicon.png') }}" rel="shortcut icon">
    <link href="http://fast.fonts.net/cssapi/175a63a1-3f26-476a-ab32-4e21cbdb8be2.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('them/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('them/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('them/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('them/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('them/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('them/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('them/css/main4a50.css?version=3.4') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://www.gstatic.com/firebasejs/4.1.5/firebase.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('test/wickedpicker.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('test/myjqdatepicker.css') }}"/>
    <script>
        var URL="{{ URL('') }}";
        var token="{{ csrf_token() }}";
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyBXCQM4riw4Uu8_XTsgEAnpGSh7_6zC7TM",
            authDomain: "affiliate-2efc3.firebaseapp.com",
            databaseURL: "https://affiliate-2efc3.firebaseio.com",
            projectId: "affiliate-2efc3",
            storageBucket: "affiliate-2efc3.appspot.com",
            messagingSenderId: "366621262416"
        };
        firebase.initializeApp(config);
        function SendToken(token){
            var xmlHttp = new XMLHttpRequest();
            var data=new FormData();
            data.append('token',token)
            data.append('_token','{{ csrf_token() }}')
            xmlHttp.open( "POST", "{{ URL('saveTokenNumber') }}", false ); // false for synchronous request
            xmlHttp.send(data);
        }
        const messaging =firebase.messaging();
        messaging.requestPermission()
                .then(function(){
                    console.log('Have Permission');
                    return messaging.getToken();
                }).then(function(token){
            console.log('get token')
            console.log(token)
            SendToken(token);
        }).catch(function(err){
            console.log('Error Occured'+err);
        });
        messaging.onMessage(function(payload){
            //console.log(payload.notification);
            //console.log(payload.notification)
            var notification = new Notification(payload.notification.title, {
                icon: payload.notification.icon,
                body: payload.notification.body,
            });
            notification.onclick = function () {
                window.open(payload.notification.click_action);
            };
        });
    </script>
{{--linkedin auth--}}
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
   api_key: 77evs5e7zmv88h
   authorize: false
   onLoad: onLinkedInLoad
   </script>
{{--VK auth--}}
<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
<!--     <div id="login_button" onclick="VK.Auth.login(authorize);"></div> -->
    <script language="javascript">
      VK.init({
        apiId: 6361949
      });
         </script>
{{--end VK auth--}}
    @yield('headScript')
    <style>
        .bootstrap-dialog{
            z-index: 999999!important;
        }
        #allParameters{
            max-height: 180px;
            min-height: 180px;
            overflow: auto;
        }
    </style>
    <style>
        @media screen and (min-width: 769px) {
            #nav-tabs-wrapper {
                display: block!important;
            }
        }
        @media screen and (max-width: 768px) {
            .nav-tabs-horizontal  > li {
                float: none;
            }
            .nav-tabs-horizontal  > li + li {
                margin-left: 2px;
            }
            .nav-tabs-horizontal > li,
            .nav-tabs-horizontal > li > a {
                background: transparent;
                width: 100%;
            }
            .nav-tabs-horizontal  > li > a {
                border-radius: 4px;
            }
            .nav-tabs-horizontal  > li.active > a,
            .nav-tabs-horizontal  > li.active > a:hover,
            .nav-tabs-horizontal  > li.active > a:focus {
                color: #ffffff;
                background-color: #428bca;
            }
        }
        .bd-create-new-post-lg .modal-body{
            padding-top: 0;
            padding-left: 15px;
        }
        #leftTabs{
            background: #f3f3f5;
            padding: 0;
        }
        .social-box{
            height: 165px;
            line-height: 250px;
        }
        .facebook-box,.twitter-box,.google-box,.instagram-box,.linkedin-box,.youtube-box,.vk-box{
            border-radius: 2px;
            text-align: center;
        }
        .facebook-box{
            background: linear-gradient(180deg,#5871a8,#3b5999);
        }
        .facebook-box a{
            border: 1px solid #506998;
            background: linear-gradient(180deg,hsla(0,0%,100%,.15),hsla(0,0%,100%,0));
        }
        .facebook-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,100%,.3),hsla(0,0%,88%,.3));
        }
        .facebook-box .fa{
            color:#94a4c7;
        }
        .twitter-box{
            background: linear-gradient(180deg,#6eb8f0,#55acee);
        }
        .twitter-box a{
            border: 1px solid #4a95d1;
            background: linear-gradient(180deg,hsla(0,0%,100%,.15),hsla(0,0%,100%,0));
        }
        .twitter-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .twitter-box .fa{
            color:#a3d2f6;
        }
        .google-box{
            background: linear-gradient(180deg,#e26657,#dd4c3a);
        }
        .google-box a{
            border: 1px solid #c0594d;
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .google-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,100%,.3),hsla(0,0%,88%,.3));
        }
        .google-box .fa{
            color:#ed9f96;
        }
        .instagram-box{
            background: linear-gradient(180deg,#5a606a,#3e4550);
        }
        .instagram-box a{
            border: 1px solid #535760;
            background: linear-gradient(180deg,hsla(0,0%,100%,.15),hsla(0,0%,100%,0));
        }
        .instagram-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .instagram-box .fa{
            color:#979ba2;
        }
        .linkedin-box{
            background: linear-gradient(180deg,#0077b5,#0d89ca)
        }
        .linkedin-box a{
            border: 1px solid #2b7aa2;
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .linkedin-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,100%,.3),hsla(0,0%,88%,.3));
        }
        .linkedin-box .fa{
            color:#86b2ca;
        }
        .youtube-box{
            background: linear-gradient(180deg,#ff0000,#9e0000);
        }
        .youtube-box a{
            border: 1px solid #c0594d;
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .youtube-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,100%,.3),hsla(0,0%,88%,.3));
        }
        .youtube-box .fa{
            color:#ed9f96;
        }
        .vk-box{
            background: linear-gradient(180deg,#5494dc,#4A76A8);
        }
        .vk-box a{
            border: 1px solid #2b7aa2;
            background: linear-gradient(180deg,hsla(0,0%,67%,.2),hsla(0,0%,90%,.2));
        }
        .vk-box a:hover{
            background: linear-gradient(180deg,hsla(0,0%,100%,.3),hsla(0,0%,88%,.3));
        }
        .vk-box .fa{
            color:#bcd2de;
        }
        .padding-top-30{padding-top: 30px}
        .social-box a{
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .social-box .fa{
            font-size: 40pt !important;
            padding-top: 25px;

            position: absolute;
            margin-right: auto;
            margin-left: auto;
            left: 0;
            right: 0;
        }
        #nav-tabs-wrapper{
            border: none;
            padding-top: 15px;
            padding: 0;
        }
        #nav-tabs-wrapper li a{
            text-decoration: none;
            color: #2f3744;
        }
        #nav-tabs-wrapper li.active a,#nav-tabs-wrapper li a{
            background: #e4e5e6;
        }
        #nav-tabs-wrapper li a:hover{
            background: #dcdcdc;
        }
        #nav-tabs-wrapper li.active a,#nav-tabs-wrapper li a:hover,#nav-tabs-wrapper li a{

            font-weight: bold;
            display: inherit;
            padding: 10px;
            border: 5px solid #f3f3f5;
            border-radius: 10px;
        }
        #nav-tabs-wrapper li a span{
            padding-left: 10px;
        }
        .post-icon a{
            text-decoration: none;
            color: #2f3744;
            padding: 10px;
            border: 1px solid #cecece;
        }
        .post-icon a:hover{
            background:#2f3744;
            color: #fff;
        }
        .post-footer{
            padding-left: 0;
        }
        img.groupimg {
            width: 50px;
            padding: 5px;
            border-radius: 30px;
        }
        input.input-a {
            width: 100px;
            margin: 5px;
        }
        .deleteinp{
            cursor: pointer;
        }
        #dp_time {
            float: left;
            width: 200px;
            height: 120px;
        }
        .dp_time_selected{
            background: #008db7 !important;
        }
        #dp_wrapper{
            z-index: 5555555555;
        }
    </style>
</head>
<body>
<div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade bd-create-new-post-lg" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Connect Your Profile</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> ×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3" id="leftTabs">
                        <div class="text-center">
                            <small>ADD SOCIAL PROFILES</small>
                        </div>
                        <ul id="nav-tabs-wrapper" class="nav nav-tabs nav-pills nav-stacked well">
                            <li class="active">
                                <a href="#connectYourProfile" data-toggle="tab">
                                    <i class="os-icon os-icon-cv-2"></i>
                                    <span>{{ Lang::get('home.connect_your_profile') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="connectYourProfile">
                                <h3>{{ Lang::get('home.connect_your_profile') }}</h3>
                                <p>{{ Lang::get('home.connect_your_profile_description') }}</p>
                                <div class="row" id="socialLoginBox">
                                </div>
                                <div class="row" id="socialLogin">
                                    <div class="col-lg-4 padding-top-30">
                                        <div class="social-box facebook-box">
                                            <i class="fa fa-facebook"></i>
                                            <a id="connectSocialFacebook" href="#">{{ Lang::get('home.connect').Lang::get('home.facebook') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box twitter-box">
                                            <i class="fa fa-twitter"></i>
                                            <a id="connectSocialTwitter" href="#">{{ Lang::get('home.connect').Lang::get('home.twitter') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box google-box">
                                            <i class="fa fa-google-plus"></i>
                                            <a id="connectSocialGoogle" href="#">{{ Lang::get('home.connect').Lang::get('home.google_plus') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box instagram-box">
                                            <i class="fa fa-instagram"></i>
                                            <a id="connectSocialInstagram" href="#">{{ Lang::get('home.connect').Lang::get('home.instagram') }}</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box linkedin-box" onclick="liAuth()">
                                            <i class="fa fa-linkedin"></i>
                                            <a id="connectSocialLinkedin" href="#">{{ Lang::get('home.connect').Lang::get('home.linkedin') }}</a>
                                        </div>
                                    </div>
                                       <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box youtube-box">
                                            <i class="fa fa-youtube"></i>
                                            <a id="connectSocialYoutube" href="#">Connect Youtube</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 padding-top-30" >
                                        <div class="social-box vk-box">
                                            <i class="fa fa-vk"></i>
                                            <a id="connectSocialVK" onclick="VK.Auth.login(authorize);" href="#">Connect VK</a>
                                        </div>
                                    </div>        
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="all-wrapper menu-side with-side-panel">
    <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
            <div class="mm-logo-buttons-w">
                <a class="mm-logo" href="{{ URL('') }}">
                    <img src="{{ asset('img/logo.png') }}">
                        {{--<span>Clean Admin</span>--}}
                </a>
                <div class="mm-buttons">
                    {{--<div class="content-panel-open">
                        <div class="os-icon os-icon-grid-circles">
                        </div>
                    </div>--}}
                    <div class="mobile-menu-trigger">
                        <div class="os-icon os-icon-hamburger-menu-1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-and-user">
                @if(Auth::guard('AppUsers')->check())
                <div class="logged-user-w">
                    <div class="avatar-w">
                        <img alt="" src="@if(file_exists(public_path(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img))&&!empty(Auth::guard('AppUsers')->user()->img_dir)&&!empty(Auth::guard('AppUsers')->user()->img)){{ asset(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img) }}@else{{ asset('img/Users/default_image.png') }}@endif">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">{{ Auth::guard('AppUsers')->user()->name }}
                        </div>
                       {{-- <div class="logged-user-role">Administrator
                        </div>--}}
                    </div>
                </div>
                @endif
                <!--------------------
                START - Mobile Menu List
                -------------------->
                <ul class="main-menu">
                    <li class="@if(Request::path()=='/') active @endif">
                        <a href="{{ URL('/') }}">
                            <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.dashboard') }}">
                                <div class="os-icon os-icon-window-content">
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL('/termsAndConditions') }}">
                            <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.terms_and_conditions') }}">
                                <div class="fa fa-question-circle"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL('/support') }}">
                            <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.support') }}">
                                <div class="fa fa-life-ring">
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL('/privacy') }}">
                            <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.privacy') }}">
                                <div class="fa fa-user-secret">
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!--------------------
                END - Mobile Menu List
                -------------------->
            </div>
        </div>
        <!--------------------
        END - Mobile Menu
        -------------------->
        <!--------------------
        START - Menu side
        -------------------->

        @yield('leftSideMenu')
        <!--------------------
        END - Menu side
        -------------------->
        <div class="content-w">

            {{--@if(Auth::guard('AppUsers')->check())
                <div class="logged-user-w">
                    <div class="avatar-w">
                        <img alt="" src="@if(file_exists(public_path(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img))&&!empty(Auth::guard('AppUsers')->user()->img_dir)&&!empty(Auth::guard('AppUsers')->user()->img)){{ asset(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img) }}@else{{ asset('img/Users/default_image.png') }}@endif">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">{{ Auth::guard('AppUsers')->user()->name }}
                        </div>
                        --}}{{-- <div class="logged-user-role">Administrator
                         </div>--}}{{--
                    </div>
                </div>
            @endif--}}
                @if(Auth::guard('AppUsers')->check())
            <div class="top-menu-secondary">
                <ul>
                    <li @if(Request::path()=='/') class="active" @endif><a href="{{ URL('/') }}">{{ Lang::get('home.dashboard') }}</a></li>
                    <li @if(Request::path()=='publisher') class="active" @endif><a href="{{ URL('publisher') }}">{{ Lang::get('home.publisher') }}</a></li>
                    <li @if(Request::path()=='schedule') class="active" @endif><a href="{{ URL('schedule') }}">{{ Lang::get('home.schedule') }}</a></li>
                    <li @if(Request::path()=='my_categories') class="active" @endif><a href="{{ URL('my_categories') }}">{{ Lang::get('home.category') }}</a></li>
                    <li @if(Request::path()=='scheduledPosts') class="active" @endif><a href="{{ URL('scheduledPosts') }}">{{ Lang::get('Posts') }}</a></li>
                </ul>
                <div class="top-menu-controls">

                    <a data-target=".bd-create-new-post-lg" data-toggle="modal" href="" class="btn btn-info" >
                        <i class="fa fa-plus"></i>
                        Add Profile
                    </a>
                    <div class="element-search hidden-lg-down">
                        <input placeholder="Start typing to search..." type="text">
                    </div>

                    <div class="top-icon top-search hidden-xl-up"><i class="os-icon os-icon-ui-37"></i>
                    </div>
                    <!--------------------
                    START - Messages Link in secondary top menu
                    -------------------->
                    {{--<div class="messages-notifications os-dropdown-trigger os-dropdown-center"><i class="os-icon os-icon-mail-14"></i>
                        <div class="new-messages-count">1
                        </div>
                        <div class="os-dropdown light message-list">
                            <div class="icon-w"><i class="os-icon os-icon-mail-14"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="user-avatar-w"><img alt="" src="{{ asset('img/avatar2.jpg') }}">
                                        </div>
                                        <div class="message-content">
                                            <h6 class="message-from">Phil Jones</h6>
                                            <h6 class="message-title">Secutiry Updates</h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    <!--------------------
                    END - Messages Link in secondary top menu
                    -------------------->
                    <!--------------------
                    START - Settings Link in secondary top menu
                    -------------------->
                   {{-- <div class="top-icon top-settings os-dropdown-trigger os-dropdown-center"><i class="os-icon os-icon-ui-46"></i>
                        <div class="os-dropdown">
                            <div class="icon-w"><i class="os-icon os-icon-ui-46"></i>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="os-icon os-icon-ui-49"></i>
                                        <span>Profile Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="os-icon os-icon-grid-10"></i>
                                        <span>Billing Info</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="os-icon os-icon-ui-44"></i>
                                        <span>My Invoices</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="os-icon os-icon-ui-15"></i>
                                        <span>Deactivate Account</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    <!--------------------
                    END - Settings Link in secondary top menu
                    -------------------->
                    <!--------------------
                    START - User avatar and menu in secondary top menu
                    -------------------->
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w">
                                <img alt="" src="@if(file_exists(public_path(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img))&&!empty(Auth::guard('AppUsers')->user()->img_dir)&&!empty(Auth::guard('AppUsers')->user()->img)){{ asset(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img) }}@else{{ asset('img/Users/default_image.png') }}@endif">
                            </div>
                            <div class="logged-user-menu">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w">
                                        <img alt="" src="@if(file_exists(public_path(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img))&&!empty(Auth::guard('AppUsers')->user()->img_dir)&&!empty(Auth::guard('AppUsers')->user()->img)){{ asset(Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img) }}@else{{ asset('img/Users/default_image.png') }}@endif">
                                    </div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name">
                                            {{ Auth::guard('AppUsers')->user()->name }}
                                        </div>

                                        {{--<div class="logged-user-role">Administrator
                                        </div>--}}
                                    </div>
                                </div>

                                <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i>
                                </div>
                                <ul>
                                   {{-- <li>
                                        <a href="#"><i class="os-icon os-icon-mail-01"></i>
                                            <span>Incoming Mail</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="os-icon os-icon-user-male-circle2"></i>
                                            <span>Profile Details</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="os-icon os-icon-coins-4"></i>
                                            <span>Billing Details</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="os-icon os-icon-others-43"></i>
                                            <span>Notifications</span>
                                        </a>
                                    </li>--}}
                                    <li>
                                        <a href="{{ URL('logout') }}">
                                            <i class="os-icon os-icon-signs-11"></i>
                                            <span>{{ Lang::get('home.logout') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - User avatar and menu in secondary top menu
                    -------------------->
                </div>
            </div>
            @endif
            @yield('contentHeader')
            <!--------------------
            START - Breadcrumbs
            -------------------->
            {{--<ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                <li class="breadcrumb-item"><a href="index-2.html">Products</a></li>
                <li class="breadcrumb-item">
<span>Laptop with retina screen
</span></li>
            </ul>--}}
            <!--------------------
            END - Breadcrumbs
            -------------------->
            <div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i>
                <span>Sidebar</span>
            </div>
            <div class="content-i">
                @include('auth.include.messages')
                @yield('content')
            </div>
        </div>
    </div>
    <div class="display-type">
    </div>
</div>
<script src="{{ asset('them/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('them/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('them/bower_components/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('them/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('them/bower_components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('them/bower_components/dropzone/dist/dropzone.js') }}"></script>
<script src="{{ asset('them/bower_components/editable-table/mindmup-editabletable.js') }}"></script>
<script src="{{ asset('them/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('them/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('them/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('them/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('them/bower_components/tether/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/util.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/alert.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/button.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/carousel.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/collapse.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/dropdown.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/modal.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/tab.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/tooltip.js') }}"></script>
<script src="{{ asset('them/bower_components/bootstrap/js/dist/popover.js') }}"></script>
<script src="{{ asset('them/js/main4a50.js?version=3.4') }}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/facebookJavaScript.js') }}"></script>
<script src="{{ asset('js/linkedInJavaScript.js') }}"></script>

<script src="{{ asset('js/codebird.js') }}"></script>
<script src="{{ asset('js/twitter.js') }}"></script>

<!---------------------------islam > jsfiles >----------------------- -->


<script type="text/javascript" src="https://www.google.com/jsapi"></script>  
<script src="{{ asset('js/auth.js') }}"></script>
<script src="{{ asset('js/chanell.js') }}"></script>
<script src="{{ asset('js/upload_video.js') }}"></script>
<script src="{{ asset('js/cors_upload.js') }}"></script>
<script src="{{ asset('js/analytics_codelab.js') }}"></script>
<!-- <script type="text/javascript" src="https://apis.google.com/js/client.js"></script>
 -->
 <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.1/underscore-min.js"></script>
 <script src="{{ asset('js/vendor/spin.min.js') }}"></script>
 <script src=" {{ asset('js/vendor/ladda.min.js') }}"></script>
 <script src=" {{ asset('js/instajam.js') }}"></script>
 <script src=" {{ asset('js/appins.js') }}"></script>
<link href="{{ asset('test/jquery-clockpicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('test/github.min.css') }}" rel="stylesheet">
<script src="{{ asset('test/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('test/wickedpicker.min.js') }}"></script>

<script src="{{ asset('test/myjqdatepicker.js') }}"></script>
<!--------------------- end files ------------------>
@yield('scriptCode')
<script>
for (i = 50; i < 100; i++) { 
$("#input-a"+i).mydatepicker(2);
}
$(".deleteinp").click(function() {
    $(this).parent().remove();
});
var abc=0;
$(".sunbu").click(function() {
    abc++;
    $(".sun").append("<div class='file"+ abc +" fileimage'><input name='sun[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");
    $("#input-a"+abc).mydatepicker(2);
    $(".deleteinp").click(function() {
        $(this).parent().remove();
    });
});






$(".mondbu").click(function() {
abc++;

$(".mond").append("<div class='file"+ abc +" fileimage'><input name='mond[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");



    $("#input-a"+abc).mydatepicker(2);


$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});







$(".tuesbu").click(function() {

abc++;

$(".tues").append("<div class='file"+ abc +" fileimage'><input name='tues[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");

/*
var input = $('.input-a');
input.clockpicker({
    autoclose: true
});

*/

    $("#input-a"+abc).mydatepicker(2);


$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});







$(".wednbu").click(function() {

abc++;

$(".wedn").append("<div class='file"+ abc +" fileimage'><input name='wedn[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");
    $("#input-a"+abc).mydatepicker(2);


$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});







$(".thursbu").click(function() {

abc++;

$(".thurs").append("<div class='file"+ abc +" fileimage'><input name='thurs[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");
    $("#input-a"+abc).mydatepicker(2);


$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});






$(".fridbu").click(function() {

abc++;   

$(".frid").append("<div class='file"+ abc +" fileimage'><input name='frid[]' id='input-a"+ abc +"'  class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");
    $("#input-a"+abc).mydatepicker(2);

$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});





$(".saturbu").click(function() {

abc++;

    
$(".satur").append("<div class='file"+ abc +" fileimage'><input name='satu[]' id='input-a"+ abc +"' class='input-a' value='' data-default='20:48'><img style='width:15px; height:15px;' class='deleteinp' src={{ asset('img/cancel.png') }}></div>");
    
$("#input-a"+abc).mydatepicker(2);


$(".deleteinp").click(function() {
    $(this).parent().remove();
});
});





$(document).on('click','#socialFacebookAddProfile',function(){
        data=[];
        html='';
        $(".socialFacebookCheckbox:checked").each(function(){
            id=$(this).val();
            type=$(this).attr('data-type');
            name=$(this).attr('data-name');
            image_url=$(this).attr('data-image');

if($(this).attr('data-access-token')){
                page_access_token=$(this).attr('data-access-token');


}else{
                page_access_token='group';

}
            

            data.push({"id":id,"name":name,"type":type,"image_url":image_url,"page_access_token":page_access_token});

            html+='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="'+type+'" data-name="'+name+'" data-image="'+image_url+'" value="'+id+'" id=""><img src="'+image_url+'" alt="Test_page"><span>'+name+'</span></label></div></div>';
        });
        $("#allProfiles").append(html);
        userID=$("#userID").val();
        accessToken=$("#accessToken").val();
        expiresIn=$("#expiresIn").val();
        accessTokenSecret=$("#accessTokenSecret").val();

        $.ajax({
            type: "POST",
            url: "{{ URL('addNewProfile') }}",
            data: {data:JSON.stringify(data),'userID':userID,'accessToken':accessToken,'expiresIn':expiresIn,'accessTokenSecret':accessTokenSecret,_token:token},
            success: function (msg) {
                console.log("adddddddddddddddddddddddddddddddddddddddddddddddddddddddd");

                if(msg.success){

                    $(".bd-create-new-post-lg").modal('toggle');
                    $("#socialLoginBox").html('');
                    $("#socialLogin").removeClass('hidden');
                    $("#leftMenuCreatePost").attr('data-target','.bd-chose-page')

                }
            }
        });
        data.forEach(function(item){
            if(item.type=='facebook'){
                FaceBook.getPagePosts(item.id,undefined,100,function(data){
                    console.log(data);
                    $.ajax({
                        type: "POST",
                        url: "{{ URL('addProfilePosts') }}",
                        data: {data:JSON.stringify(data),page_id:item.id,type:item.type,_token:token},
                        success: function (msg) {
                        }
                    });
                })
            }
        })
    });



function authorize(response) {
    //console.log(response);
    //console.log(response.session.mid);
    VK.Api.call('users.get', {fields: 'uid,first_name,photo_50'}, function(data) {
        console.log(data);
        htmly='<input type="hidden" id="VKid" value="'+response.session.mid+'">';
        htmly+='<input type="hidden" id="vaccessToken" value="'+response.session.sid+'">';
        htmly+='<input type="hidden" id="vexpiresIn" value="'+response.session.expire+'">';
        htmly+='<input id="token" name="_token" type="hidden" value="{{csrf_token()}}">';
        htmly+='<label><input type="checkbox" class="socialYoutubeCheckbox " data-type="VK" data-image="'+data.response[0].photo_50+'" data-name="'+data.response[0].first_name +' '+ data.response[0].last_name+'" value="'+data.response[0].uid+'" id=""><img class="myaccimg" src="'+data.response[0].photo_50+'"  alt="'+data.response[0].last_name+'"><span>'+data.response[0].first_name +' '+ data.response[0].last_name+'</span></label>';
//userProfiles
        allIDSa=[];
        $(".userProfiles").each(function(){allIDSa.push($(this).val())});
        console.log(allIDSa);
        if($.inArray(response.session.mid, allIDSa)!=-1){
            htmly+='<span style="color:red;margin:auto;position: relative;bottom: 8px;font-weight: bold;" class="pull-right">Profile already managed in this account.</span><div class="col-lg-12"><button id="socialVKAddProfile" disabled class="btn btn-primary pull-right">Add profiles</button></div>';
        }else{
            htmly+='<div class="col-lg-12"><button id="socialVKAddProfile" class="btn btn-primary pull-right">Add profiles</button></div>';
        }
        $("#socialLogin").addClass('hidden');
        $("#socialLoginBox").html(htmly);
        //console.log('done');
    });
}

//linkedin getProfileData-----------------------------------

  function onLinkedInLoad() {
   IN.Event.on(IN, "auth", getProfileData);
  }
  
   function getProfileData() {
       console.log('testtttt');
       console.log("oauth token:" + IN.ENV.auth.oauth_token);
       allIDSa=[];
       $(".userProfiles").each(function(){allIDSa.push($(this).val())});
       //console.log(allIDSa);
       hasProfile=false;
       LinkedIN.getUserDetails(function(data){
           LinkedIN.getCompaniesList(function(companies){
               //  IN.API.Profile("me").fields("id","first-name", "last-name", "email-address","picture-url").result(function (data) {
               console.log(data);
               if (data){
                   // ex=$("#yexpiresInn").val();
                   //ac=$("#accessto").val();
                   htmly='<input type="hidden" id="linkedinid" value="'+data.id+'">';
                   htmly+='<input type="hidden" id="yaccessToken" value="notdefined 12">';
                   htmly+='<input type="hidden" id="yexpiresIn" value="notdefined 12">';
                   htmly+='<input id="token" name="_token" type="hidden" value="{{csrf_token()}}">';
                   htmly+='<label><input type="checkbox" class="sociallinkedinCheckbox " data-type="linkedin" data-image="'+data.pictureUrl+'" data-name="'+data.firstName +' '+ data.lastName+'" value="'+data.id+'" id=""><img class="myaccimg" src="'+data.pictureUrl+'"  alt="'+data.lastName+'"><span>'+data.firstName +' '+ data.lastName+'</span></label>';
                   //userProfiles
                   if($.inArray(data.id, allIDSa)!=-1){
                       htmly+='<span style="color:red;margin:auto;position: relative;bottom: 8px;font-weight: bold;" class="pull-right">Profile already managed in this account.</span>';
                   }else{
                       hasProfile=true;
                   }
                   //console.log('done');
               }
               if(companies){
                   //console.log(companies);
                   companies.values.forEach(function(company){
                       //console.log(company)
                       htmly+='<input type="hidden" id="linkedinid" value="'+company.id+'">';
                       htmly+='<input type="hidden" id="yaccessToken" value="notdefined 12">';
                       htmly+='<input type="hidden" id="yexpiresIn" value="notdefined 12">';
                       htmly+='<input id="token" name="_token" type="hidden" value="{{csrf_token()}}">';
                       htmly+='<label><input type="checkbox" class="sociallinkedinCheckbox " data-type="linkedin_company" data-image="'+company.logoUrl+'" data-name="'+company.name+'" value="'+company.id+'" id=""><img class="myaccimg" src="'+company.logoUrl+'"  alt="'+company.name+'"><span>'+company.name +'</span></label>';
                       if($.inArray(String(company.id), allIDSa)!=-1){
                           htmly+='<span style="color:red;margin:auto;position: relative;bottom: 8px;font-weight: bold;" class="pull-right">Profile already managed in this account.</span>';
                       }else{
                           hasProfile=true;
                       }
                   });
               }
               htmly+='<div class="col-lg-12"><button id="sociallinkedinAddProfile" '+((hasProfile)?'':'disabled')+' class="btn btn-primary pull-right">Add profiles</button></div>';
               $("#socialLogin").addClass('hidden');
               $("#socialLoginBox").html(htmly);
           });
       });
   }
function liAuth(){
   IN.User.authorize(function(){
     //  callback();
   });
}




//linkedin final-----------------------------------



//-----------------------------ISLAM JS ------------------------------

    $('.userProfiles').on('change', function(e) {
        if($('input[data-type="youtube"]:checked').length > 0){
         $('.userProfiles').prop('checked', false);
         $('.userProfiles').prop("disabled",true);
         $(this).prop("checked",true);
         $(this).prop("disabled",false);
  }else{
         $('.userProfiles').prop("disabled",false);
  }
    });


    





function executeRequestaaa(request) {
        console.log('wslthena');

        request.execute(function(response) {
            console.log(response);
        if (response){

        ex=$("#yexpiresInn").val();
        ac=$("#accessto").val();
        htmly='<input type="hidden" id="chanellID" value="'+response.items[0].id+'">';
        htmly+='<input type="hidden" id="yaccessToken" value="'+ac+'">';
        htmly+='<input type="hidden" id="yexpiresIn" value="'+ex+'">';
        htmly+='<input id="token" name="_token" type="hidden" value="{{csrf_token()}}">';

        htmly+='<label><input type="checkbox" class="socialYoutubeCheckbox " data-type="youtube" data-image="'+response.items[0].snippet.thumbnails.default.url+'" data-name="'+response.items[0].snippet.title+'" value="'+response.items[0].id+'" id=""><img class="myaccimg" src="'+response.items[0].snippet.thumbnails.default.url+'"  alt="'+response.items[0].snippet.title+'"><span>'+response.items[0].snippet.title+'</span></label>';
//userProfiles
        allIDSa=[];
        $(".userProfiles").each(function(){allIDSa.push($(this).val())});
        console.log(allIDSa);
       



    if($.inArray(response.items[0].id, allIDSa)!=-1){

     htmly+='<span style="color:red;margin:auto;position: relative;bottom: 8px;font-weight: bold;" class="pull-right">Profile already managed in this account.</span><div class="col-lg-12"><button id="socialYoutubeAddProfile" disabled class="btn btn-primary pull-right">Add profiles</button></div>';

}else{
     htmly+='<div class="col-lg-12"><button id="socialYoutubeAddProfile" class="btn btn-primary pull-right">Add profiles</button></div>';
}
        $("#socialLogin").addClass('hidden');
        $("#socialLoginBox").html(htmly);

        console.log('done');
            }else{
            console.log(response);
            }
            });
    }



$(document).on('click','#socialYoutubeAddProfile',function(){
                data=[];
                html='';
console.log('aaaa');
                $(".socialYoutubeCheckbox:checked").each(function(){
                    id=$(this).val();
                    type='youtube';
                    name=$(this).attr('data-name');
                    image_url=$(this).attr('data-image');
                    data.push({"id":id,"name":name,"type":type,"image_url":image_url});
                    html+='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="youtube" data-name="'+name+'" data-image="'+image_url+'" value="'+id+'" id=""><img class="myaccimg" src="'+image_url+'" alt="Test_page"><span>'+name+'</span></label></div></div>';
                });
                $("#allProfiles").append(html);
                userID=$("#chanellID").val();
                accessToken=$("#accessto").val();
                expiresIn=$("#yexpiresInn").val();;
                token=$('#token').val();
                accessTokenSecret='';


                $.ajax({
                    type: "POST",
                    url: "{{ URL('addNewProfile') }}",
                    data: {data:JSON.stringify(data),'userID':userID,'accessToken':accessToken,'expiresIn':expiresIn,'accessTokenSecret':accessTokenSecret,_token:token},
                    success: function (msg) {
                       if(msg.success){
                           $(".bd-create-new-post-lg").modal('toggle');
                           $("#socialLoginBox").html('');
                           $("#socialLogin").removeClass('hidden');
                           $("#leftMenuCreatePost").attr('data-target','.bd-chose-page');
                       }
                    }
                });
            });

























//------------------------------------------------------------------------------------------

//add linkedin profile
$(document).on('click','#sociallinkedinAddProfile',function(){
    data=[];
    html='';

    $(".sociallinkedinCheckbox:checked").each(function() {
        id = $(this).val();
        type = $(this).attr('data-type');
        name = $(this).attr('data-name');
        image_url = $(this).attr('data-image');
        data.push({"id":id,"name":name,"type":type,"image_url":image_url});
        html+='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="youtube" data-name="'+name+'" data-image="'+image_url+'" value="'+id+'" id=""><img class="myaccimg" src="'+image_url+'" alt="Test_page"><span>'+name+'</span></label></div></div>';
    });
    console.log(data);
    /*id=$(".sociallinkedinCheckbox:checked").val();
     type=$(".sociallinkedinCheckbox:checked").attr('data-type');
     name=$(".sociallinkedinCheckbox:checked").attr('data-name');
     image_url=$(".sociallinkedinCheckbox:checked").attr('data-image');
     data.push({"id":id,"name":name,"type":type,"image_url":image_url});
     html+='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="youtube" data-name="'+name+'" data-image="'+image_url+'" value="'+id+'" id=""><img class="myaccimg" src="'+image_url+'" alt="Test_page"><span>'+name+'</span></label></div></div>';*/
    $("#allProfiles").append(html);
    userID=$("#linkedinid").val();
    accessToken='undefined 404';
    expiresIn='undefined 404';
    token=$('#token').val();
    accessTokenSecret='';
    $.ajax({
        type: "POST",
        url: "{{ URL('addNewProfile') }}",
        data: {data:JSON.stringify(data),'userID':userID,'accessToken':accessToken,'expiresIn':expiresIn,'accessTokenSecret':accessTokenSecret,_token:token},
        success: function (msg) {
            if(msg.success){
                $(".bd-create-new-post-lg").modal('toggle');
                $("#socialLoginBox").html('');
                $("#socialLogin").removeClass('hidden');
                $("#leftMenuCreatePost").attr('data-target','.bd-chose-page');
            }
        }
    });
});


//------------------------end --------------------


//add VK profile



$(document).on('click','#socialVKAddProfile',function(){
                data=[];
                html='';
console.log('vk clicked');
                $(".socialYoutubeCheckbox:checked").each(function(){
                    id=$(this).val();
                    type='VK';
                    name=$(this).attr('data-name');
                    image_url=$(this).attr('data-image');
                    data.push({"id":id,"name":name,"type":type,"image_url":image_url});
                    html+='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="VK" data-name="'+name+'" data-image="'+image_url+'" value="'+id+'" id=""><img class="myaccimg" src="'+image_url+'" alt="Test_page"><span>'+name+'</span></label></div></div>';
                });
                $("#allProfiles").append(html);
                userID=$("#VKid").val();
                accessToken=$("#vaccessToken").val();
                expiresIn=$("#vexpiresIn").val();
                token=$('#token').val();
                accessTokenSecret='';


                $.ajax({
                    type: "POST",
                    url: "{{ URL('addNewProfile') }}",
                    data: {data:JSON.stringify(data),'userID':userID,'accessToken':accessToken,'expiresIn':expiresIn,'accessTokenSecret':accessTokenSecret,_token:token},
                    success: function (msg) {
                       if(msg.success){
                           $(".bd-create-new-post-lg").modal('toggle');
                           $("#socialLoginBox").html('');
                           $("#socialLogin").removeClass('hidden');
                           $("#leftMenuCreatePost").attr('data-target','.bd-chose-page');
                       }
                    }
                });
            });


//end------------------------





















    $(document).on('change','.socialFacebookCheckbox',function(){
        if($(".socialFacebookCheckbox:checked").length){
            $("#socialFacebookAddProfile").removeAttr('disabled');
        }else{
            $("#socialFacebookAddProfile").attr('disabled','disabled');
        }
    });





    $(document).on('click','#connectSocialFacebook',function(e){

        e.preventDefault();
        allIDS=[];
        $(".userProfiles").each(function(){allIDS.push($(this).val())});
        FaceBook.login(function(response) {


            if (response.authResponse) {


                FaceBook.extendaccesstoken(response.authResponse.accessToken,function(extendaccesstoken){

                    accessToken=extendaccesstoken;
                    FaceBook.setAccessToken(accessToken);
                    FaceBook.getUserDetails(function(user){
                        //  console.log('user data : ',user);
                        $.ajax({
                            type: "POST",
                            url: "{{ URL('addUserProfile') }}",
                            data: {
                                "accessToken":accessToken,
                                "user": user,
                                _token: token
                            },
                            success: function (msg) {
                               // console.log("addUserProfile",msg);
                            }
                        });
                    });

                    FaceBook.getmyprofile(function(profile){
                    console.log("my profile",profile);

                    FaceBook.getGroupsList(function(group){
                    console.log("facebook group",group);

                    FaceBook.getPagesList(function(data){
                  ///  console.log('Facebook Page Data',data);
                    html='<input type="hidden" id="userID" value="'+response.authResponse.userID+'">';
                    html+='<input type="hidden" id="accessToken" value="'+extendaccesstoken+'">';
                    html+='<input type="hidden" id="expiresIn" value="'+response.authResponse.expiresIn+'">';
                    html+='<input type="hidden" id="accessTokenSecret" value="">';

                    if(profile.id){
                       
                    html+='<p>- Your Profile</p><div class="col-lg-12 '+(($.inArray(profile.id,allIDS)===-1)?'':'hasAddPage')+'">'+(($.inArray(profile.id,allIDS)===-1)?'':'<span style="color:red;margin-top: 10px;" class="pull-right">Profile already managed in this account.</span>')+'<div class="checkbox"><label><input '+(($.inArray(profile.id,allIDS)===-1)?'':'disabled')+' type="checkbox" class="socialFacebookCheckbox" data-type="facebook" data-image="'+profile.picture.data.url+'" data-name="'+profile.name+'"  value="'+profile.id+'" id=""><img class="groupimg" src="'+profile.picture.data.url+'" alt="'+profile.name+'"><span>'+profile.name+'</span></label></div></div>';
                    }    
                    
                    html+='<p>- Your Pages</p>';
                    data.data.forEach(function(item){
                        //console.log(item.id);
                        //console.log(allIDS);
                        //console.log($.inArray(item.id,allIDS));
                        if($.inArray('ADMINISTER',item.perms)!== -1||$.inArray('CREATE_CONTENT',item.perms)!== -1){
                            html+='<div class="col-lg-12 '+(($.inArray(item.id,allIDS)===-1)?'':'hasAddPage')+'">'+(($.inArray(item.id,allIDS)===-1)?'':'<span style="color:red;margin-top: 10px;" class="pull-right">Profile already managed in this account.</span>')+'<div class="checkbox"><label><input '+(($.inArray(item.id,allIDS)===-1)?'':'disabled')+' type="checkbox" class="socialFacebookCheckbox " data-type="facebook" data-image="'+item.picture.data.url+'" data-name="'+item.name+'" data-access-token="'+item.access_token+'" value="'+item.id+'" id=""><img class="groupimg" src="'+item.picture.data.url+'" alt="'+item.name+'"><span>'+item.name+'</span></label></div></div>';
                        }
     
                    });
                    html+='<p>- Your Groups</p>';
                    group.data.forEach(function(item){
                    console.log(item.privacy);
                    if(item.name){
                   
                    html+='<div class="col-lg-12 '+(($.inArray(item.id,allIDS)===-1)?'':'hasAddPage')+'">'+(($.inArray(item.id,allIDS)===-1)?'':'<span style="color:red;margin-top: 10px;" class="pull-right">Profile already managed in this account.</span>')+'<div class="checkbox"><label><input '+(($.inArray(item.id,allIDS)===-1)?'':'disabled')+' type="checkbox" class="socialFacebookCheckbox" data-type="facebook" data-image="'+item.picture.data.url+'" data-name="'+item.name+'"  value="'+item.id+'" id=""><img class="groupimg" src="'+item.picture.data.url+'" alt="'+item.name+'"><span>'+item.name+'</span></label></div></div>';
                    }
                   });

  

                    html+='<div class="clearfix"></div>';
                    html+='<div class="col-lg-12"><button id="socialFacebookAddProfile" disabled class="btn btn-primary pull-right">Add profiles</button></div>';
                    $("#socialLogin").addClass('hidden');
                    $("#socialLoginBox").html(html);
                });
                });

});
                    
                                });
            
                
            }else{
                console.log('User cancelled login or did not fully authorize.');
            }
        });
    });
    



    
    $(document).on('click','#connectSocialTwitter',function(e){
        e.preventDefault();
        allIDS=[];
        $(".userProfiles").each(function(){allIDS.push($(this).val())});
        console.log(allIDS)
        Twitter.setRequestToken(function(reply){
            if (Twitter.isLogin() != false) {
                var accessToken = Twitter.getAccessToken();
                console.log(accessToken);
                Twitter.initializeCodeBird(accessToken);
                Twitter.getUserDetails(function (reply, rate, err) {
                    html='<input type="hidden" id="userID" value="'+reply.id+'">';
                    html+='<input type="hidden" id="accessToken" value="'+accessToken.oauth_token+'">';
                    html+='<input type="hidden" id="expiresIn" value="">';
                    html+='<input type="hidden" id="accessTokenSecret" value="'+accessToken.oauth_token_secret+'">';
                    html+='<div class="col-lg-12 '+(($.inArray(reply.id_str,allIDS)===-1)?'':'hasAddPage')+'">'+(($.inArray(reply.id_str,allIDS)===-1)?'':'<span style="color:red;margin-top: 10px;" class="pull-right">Profile already managed in this account.</span>')+'<div class="checkbox"><label><input '+(($.inArray(reply.id_str,allIDS)===-1)?'':'disabled')+' type="checkbox" class="socialFacebookCheckbox " data-type="twitter" data-image="'+reply.profile_image_url+'" data-name="'+reply.name+'" value="'+reply.id+'" id=""><img src="'+reply.profile_image_url+'" alt="'+reply.name+'"><span>'+reply.name+'</span></label></div></div>';
                    html+='<div class="clearfix"></div>';
                    html+='<div class="col-lg-12"><button id="socialFacebookAddProfile" disabled class="btn btn-primary pull-right">Add profiles</button></div>';
                    $("#socialLogin").addClass('hidden');
                    $("#socialLoginBox").html(html);
                    console.log(reply)
                    console.log(rate)
                    console.log(err)
                });
                return'';
            }
            var requestToken = Twitter.getRequestToken();
            if (requestToken != false) {
                Twitter.Authenticate(requestToken,function(d){
                    if(d=='authenticate'){
                        var accessToken = Twitter.getAccessToken();
                        console.log(accessToken);
                        Twitter.initializeCodeBird(accessToken);
                        Twitter.getUserDetails(function (reply, rate, err) {
                            html='<input type="hidden" id="userID" value="'+reply.id+'">';
                            html+='<input type="hidden" id="accessToken" value="'+accessToken.oauth_token+'">';
                            html+='<input type="hidden" id="expiresIn" value="">';
                            html+='<input type="hidden" id="accessTokenSecret" value="'+accessToken.oauth_token_secret+'">';
                            html+='<div class="col-lg-12 '+(($.inArray(reply.id,allIDS)===-1)?'':'hasAddPage')+'">'+(($.inArray(reply.id,allIDS)===-1)?'':'<span style="color:red;margin-top: 10px;" class="pull-right">Profile already managed in this account.</span>')+'<div class="checkbox"><label><input '+(($.inArray(reply.id,allIDS)===-1)?'':'disabled')+' type="checkbox" class="socialFacebookCheckbox " data-type="twitter" data-image="'+reply.profile_image_url+'" data-oauth-token="'+accessToken.oauth_token+'" data-oauth-token-secret="'+accessToken.oauth_token_secret+'" data-name="'+reply.name+'" value="'+reply.id+'" id=""><img src="'+reply.profile_image_url+'" alt="'+reply.name+'"><span>'+reply.name+'</span></label></div></div>';
                            html+='<div class="clearfix"></div>';
                            html+='<div class="col-lg-12"><button id="socialFacebookAddProfile" disabled class="btn btn-primary pull-right">Add profiles</button></div>';
                            $("#socialLogin").addClass('hidden');
                            $("#socialLoginBox").html(html);
                            console.log(reply)
                            console.log(rate)
                            console.log(err)
                        });
                    }
                });
            } else {
                alert('please set request token before call it');
            }
        });
    });
</script>
</body>
</html>
