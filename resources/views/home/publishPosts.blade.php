@extends('home.layouts.app')
@section('headScript')
    <style>
        /*.fa{color: blue;}*/
    </style>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '1535009383226574',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.10'
            });
            init();
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
@section('pageTitle')
    <title>{{ Lang::get('home.home_page_title') }}</title>
@endsection
@section('contentHeader')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('publishPosts') }}">{{ Lang::get('home.publish_posts') }}</a></li>
    </ul>
@endsection
@section('leftSideMenu')
    <div class="desktop-menu menu-side-compact-w menu-activated-on-hover color-scheme-dark">
        <div class="logo-w">
            <a class="logo" href="{{ URL('') }}">
                <img src="{{ asset('img/logo.png') }}">
            </a>
        </div>
        <div class="menu-and-user">
            <ul class="main-menu">
                <li class="@if(Request::path()=='/') active @endif">
                    <a href="{{ URL('/') }}">
                        <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.dashboard') }}">
                            <div class="os-icon os-icon-window-content">
                            </div>
                        </div>
                    </a>
                </li>
                <li class="@if(Request::path()=='scheduledPosts') active @endif">
                    <a href="{{ URL('scheduledPosts') }}">
                        <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.scheduled_posts') }}">
                            <div class="fa fa-calendar"></div>
                        </div>
                    </a>
                </li>
                <li class="@if(Request::path()=='publishPosts') active @endif">
                    <a href="{{ URL('publishPosts') }}">
                        <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.publish_posts') }}">
                            <div class="fa fa-bookmark"></div>
                        </div>
                    </a>
                </li>
                <li class="@if(Request::path()=='failedPosts') active @endif">
                    <a href="{{ URL('failedPosts') }}">
                        <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.failed_posts') }}">
                            <div class="fa fa-exclamation-triangle"></div>
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
        </div>
    </div>
@endsection
@section('content')

    <div class="blog-page blog-content-1">


        @if (isset($_GET['submit'])&& $_GET['submit']==1)

            <div class="alert alert-success">File Uploaded successfully</div>
        @endif


        @if (session('sucess'))
            <div class="alert alert-success">
                {{ session('sucess') }}
            </div>
        @endif
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
        <div class="col-lg-12">

            <div>

                <table class="table">

                    <thead>
                    <tr>
                        <th scope="col">{{ Lang::get('home.time') }}</th>
                        <th scope="col">{{ Lang::get('home.message') }}</th>
                        <th scope="col">{{ Lang::get('home.media') }}</th>
                        <th scope="col">{{ Lang::get('home.network') }}</th>
                        <th scope="col">{{ Lang::get('home.channel') }}</th>
                        <th scope="col">{{ Lang::get('home.created_at') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($publish_posts))
                        @foreach ($publish_posts as $record)
                            <tr>

                                <td><?php echo date('Y-m-d H:i:s', strtotime($record->created_time));?></td>
                                <td>{{$record->message}}</td>
                                <td><div>{!!$record->picture ? '<img src="'.$record->picture.'" height="40"/>':''!!}</div></td>
                                {{--<td><i class="fa fa-facebook" aria-hidden="true"></i></td>--}}
                                <td>
                                    @if($record->type[0]=='facebook')
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    @elseif($record->type[0]=='twitter')
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    @else
                                    @endif
                                </td>
                                <td>{{$record->appUser['name']}}</td>
                                <td>{{$record->created_at}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{$publish_posts->links()}}
            </div>
        </div>
    </div>


@endsection
@section('scriptCode')
    <script>
        function init(){}

        $(document).ready(function () {
            $('#select_category').click(function () {
                if ($('#select_category').is(':checked')) {
                    $(".date_time").css("display", "none");
                    $("#category_id").css("display", "block");
                }
            });


            $('#select_date_time').click(function () {
                if ($('#select_date_time').is(':checked')) {
                    $(".date_time").css("display", "block");
                    $("#category_id").css("display", "none");
                }
            });

        });



    </script>

@endsection
