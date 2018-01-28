@extends('home.layouts.app')
@section('headScript')
    <script src=" {{ asset('js/twitter.js') }}"></script>
    <script src=" {{ asset('js/addPostAddDatabase.js') }}"></script>

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
        <li class="breadcrumb-item"><a href="{{ URL('scheduledPosts') }}">{{ Lang::get('home.scheduled_posts') }}</a></li>
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

        <div class="col-lg-12">
            @if (isset($_GET['submit'])&& $_GET['submit']==1)

                <div class="alert alert-success">Post Send Now successfully</div>
            @endif
            @if (isset($_GET['submit'])&& $_GET['submit']==0)

                <div class="alert alert-danger">Post Can`t Send Now </div>
            @endif

            @if (session('sucess'))
                <div class="alert alert-success">
                    {{ session('sucess') }}
                </div>
            @endif
        </div>

        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
        <div class="col-lg-12">

            <div >
                <table class="table">

                    <thead>
                    <tr>
                        <th scope="col">Time</th>
                        <th scope="col">Message</th>
                        <th scope="col">Media</th>
                        <th scope="col">Network</th>
                        <th scope="col">Channel</th>
                        <th scope="col">Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($scheduled_posts))
                        @foreach ($scheduled_posts as $record)
                            <tr>

                                <td><?php echo date('Y-m-d H:i:s', strtotime($record->created_time)); ?></td>
                                <td>{{$record->message}}</td>
                                <td><div>{!!$record->picture ? '<img src="'.$record->picture.'" height="40"/>':''!!}</div></td>

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
                                <td>
                                    <a href='{{ URL('/scheduledPostsDelete/'.$record->id) }}' class='btn btn-default btn-xs'><i class="fa fa-trash"></i></a>
                                    <a href='{{ URL('/scheduledPostsedit/'.$record->id) }}' class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                                    @if(!empty($record->picture))
                                        <a href='#'  data-type='{{$record->type[0]}}' data-post_id='{{ $record->id }}' data-picture='{{ $record->picture }}' data-page-id='{{ $record->page_id }}' data-message='{{ $record->message }}'   class='btn btn-default btn-xs sendNow'><i class="fa fa-triangle-right"></i></a>
                                    @else
                                        <a href='#' data-type='{{$record->type[0]}}' data-picture='{{ $record->picture }}' data-page-id='{{ $record->page_id }}'   data-post_id='{{ $record->id }}' data-message='{{ $record->message }}'  id="" class='btn btn-default btn-xs sendNow'><i class="fa  fa-caret-right"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{$scheduled_posts->links()}}
            </div>
        </div>


    </div>


@endsection
@section('scriptCode')
    <script>
        function init(){}

function twitterPost(page_id){
        var picture_url = $(this).data('picture');
        var message = $(this).data('message');
    var post_id = $(this).data('post_id');
   // var page_id = $(this).attr('data-page-id');
    Twitter.makeTweet(message, picture_url, function(reply, rate, err) {
        console.log("in");
        // console.log(reply.errors);
        reply = JSON.parse(JSON.stringify(reply));
        console.log("inin");
        if (reply.errors && reply.errors['0'].code == 187) {
            changeMessageToUser('This post already exist');
        }else{
            // console.log("twitter1", reply.errors[0].code);
            // console.log("twitter", reply);
           // post_id = (typeof post_id == 'undefined') ? reply.id : reply.post_id;
            //resource_id = (typeof resource_id == 'undefined') ? 0 : resource_id;
           // category_id = (typeof category_id == 'undefined') ? 0 : category_id;
            var category_id='';
            var resource_id=0;
            var publish=1;
            picture_url = (typeof picture_url == 'undefined') ? 0 : picture_url;
            errorURL=(typeof errorURL == 'undefined') ? '/' : errorURL;
            sucessURL=(typeof sucessURL == 'undefined') ? '/?submit=1' : sucessURL;
           // newDate=new Date();
          // var  scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();


          //  var message = $(this).data('message');

            if (typeof scheduleDateTime == 'undefined' || scheduleDateTime == '') {
                var newDate = new Date();
                scheduleDateTime = newDate.getFullYear() + '-' + (newDate.getMonth() + 1) + '-' + newDate.getDate() + ' ' + newDate.getHours() + ':' + newDate.getMinutes();
            }
            addPostToDataBase(page_id, message, publish, scheduleDateTime, post_id, resource_id, picture_url, token,category_id,"/scheduledPosts?submit=1","/scheduledPosts?submit=0");
            //  consol                    e.log(page_id);
            //  cons                    ole.log(message);
            //  co                    nsole.log(publish);
            console.log("scheduleDateTime" + scheduleDateTime);
            console.log(picture_url);
            console.log(token);
        }
        {{--$.ajax({--}}
        {{--type: "POST", --}}
        {{--url: "{{ URL('addPost') }}", --}}
        {{--data: --}}
        {{--"page_id": page_id, --}}
        {{--"me                    ssage": message, --}}
        {{-- "publish": publish--}}
        {{--"scheduleDateTime": scheduleDateTime, - - }}
        {{--"post_id": post_id, --}}
        {{--"resource_id": resource_id, --}}
        {{--"picture_url": picture_url, --}}
        {{--_                    token: token--}}
        {{--}, --}}
        {{--success: function (msg) {--}}
        {{--alert("done"); --}}
        {{--}, --}}
        {{--error: function (msg) {--}}
        {{--alert("no"); --}}
        {{--}--}}
        {{--}); --}}
    });
}
        function facebookposttopage(page_id)
        {
            //get access token
            $.ajax({
                type: "POST",
                url: "{{ URL('getaccesstoken') }}/"+page_id,
                data: {
                    "page_id": page_id,
                    _token: token
                },
                success: function (msg) {
                    var post_id = $(this).data('post_id');
                    var picture = $(this).data('picture');
                    var message = $(this).data('message');
                    var page_id = $(this).attr('data-page-id');
                    console.log('assign accesstoken:',page_id,msg);
                    FaceBook.setAccessToken(msg);
                    //addfacebookpost(page_id);
                    var update=update_post("facebook", "now", "", "", "", page_id, message, "",post_id);
                    console.log('fn '+update);
                    if (update) {
                        window.location.href="/scheduledPosts?submit=1";
                    }else{
                        //  window.location.href="/scheduledPosts?submit=0";
                    }

                },
                error: function (msg) {
                    console.log('error :',msg);

                },

            });
            //get access token
        }

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
            $('.sendNow').click(function(e){
                e.preventDefault();
                //alert("rthjrhr");
                console.log("asdasda")
                var post_id = $(this).data('post_id');
                var picture = $(this).data('picture');
                var message = $(this).data('message');
                var page_id = $(this).attr('data-page-id');
                var type=$(this).attr('data-type');
                console.log(picture); console.log(message); console.log(page_id);console.log(post_id);
                alert(type);
                //alert(picture);
                if(type=='facebook') {
                    facebookposttopage(page_id);
                }
                if(type=='twitter') {
                    twitterPost(page_id);
                }
//    var update=update_post("facebook", "now", "", "", "", page_id, message, "",post_id);
//    console.log('fn '+update);
//    if (update) {
//    window.location.href="/scheduledPosts?submit=1";
//}else{
//
//}
            });
//    function sendNow(picture, page_id, message){
//
//    // picture = $(this).data('picture');
//    /*var message = $(this).data('message');
//     var page_id = $(this).attr('data-page-id');*/
//    create_post("facebook", "now", "", picture, "", page_id, message, "", page_id);
//    }

        });



    </script>

@endsection
