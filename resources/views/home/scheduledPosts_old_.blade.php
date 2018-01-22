@extends('home.layouts.app')
{{--section left side bar --}}
@section('content')
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
    if (d.getElementById(id)) {return; }
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script>
    function init(){}
</script>
<link href="{{ asset('css/styleUploadFileFacebook.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleuploadcsv_statusbrew.css') }}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><style>
    .fa{color: blue;}

    td, th { padding:10px;}
    .date_time{display: none; border: 1;}
    #category_id{display: none;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('/js/facebookJavaScript.js')}}"></script>

<body>

    <div class="container">

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
        @if (session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
        @endif
        <div>

            <div _ngcontent-c25="" class="step choose-type">
                <div >
                    <a href="{{ URL('scheduledPosts') }}" style="margin-right: 30px; text-decoration: underline">{{ Lang::get('scheduledPosts') }}</a>
                    <a href="{{ URL('publishPosts') }}" style="margin-right: 30px;text-decoration: underline;">{{ Lang::get('publishPosts') }}</a>
                    <a href="{{ URL('failedPosts') }}" style="margin-right: 30px;text-decoration: underline;">{{ Lang::get('failedPosts') }}</a>
                </div>

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
                            <td><i class="fa fa-facebook" aria-hidden="true"></i></td>
                            <td>{{$record->appUser['name']}}</td>
                            <td>{{$record->created_at}}</td>
                            <td>
                                <a href='/scheduledPostsDelete/{{$record->id}}' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                                <a href='/scheduledPostsedit/{{$record->id}}' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                @if(!empty($record->picture))
                                <a href='#'  data-post_id='{{ $record->id }}' data-picture='{{ $record->picture }}' data-page-id='{{ $record->page_id }}' data-message='{{ $record->message }}'   class='btn btn-default btn-xs sendNow'><i class="glyphicon glyphicon-triangle-right"></i></a>
                                @else
                                <a href='#'  data-picture='{{ $record->picture }}' data-page-id='{{ $record->page_id }}'   data-post_id='{{ $record->id }}' data-message='{{ $record->message }}'  id="" class='btn btn-default btn-xs sendNow'><i class="glyphicon  glyphicon-triangle-right"></i></a>
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
</div>

<script>
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
    console.log(picture); console.log(message); console.log(page_id);console.log(post_id);
    //alert(picture);
    var update=update_post("facebook", "now", "", "", "", page_id, message, "",post_id);
    console.log('fn '+update);
    if (update) {
    window.location.href="/scheduledPosts?submit=0";
}else{

}
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
</body>
</html>
@endsection