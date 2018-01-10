4@extends('home.layouts.app')
@section('headScript')

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



        
        @section('content')


<div class="container">           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>user_id</th>
        <th>page_id</th>
        <th>POST</th>
        <th>Scheduled_date</th>
      </tr>
    </thead>
    <tbody>

@if(count($userposts))
@foreach($userposts as $post)








@if($post->category_id != NULL)
@foreach(DB::table('categories')->where('id', '=', $post->category_id)->orderBy('id','DESC')->get() as $cat)
<?php 
$datetime = DateTime::createFromFormat('YmdHi', '201308131830');
echo $datetime->format('D');
$times = explode('|',  $cat->sunday); ?>
@foreach($times as $time)
<tr>
<td>{{$time}}</td>
</tr>
@endforeach
@endforeach
@endif



      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->app_user_id}}</td>
        <td>{{$post->page_id}}</td>
        <td>{{$post->message}}</td>
        <td>{{$post->created_time}}</td>
      </tr>

   </tbody>
  </table>
</div>

        @endsection
@section('scriptCode')











<script>
$(document).ready(function(){
token= '{{ csrf_token() }}';
//islaaaaaaaaaam ------------------



//get time now to check category
    var d = new Date();
    var n = d.getHours()+':'+d.getMinutes();
//-------------------------------------------------------



var scheduledat= new Date('{{$post->created_time}}');
if(scheduledat <= new Date()){

var scheduleDatee= '{{$post->created_time}}';
console.log('this post is schedueled');

        publish= 1;
        page_id = '{{$post->page_id}}';
        message = '{{$post->message}}';
        picture_url=$("#postPhoto img").attr('src');

        FaceBook.postToPageSchedule(page_id,message,scheduleDatee,picture_url,function(page_id,data){
                                    console.log(data);
                                        post_id =data.id;
                                        resource_id=0;
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ URL('updatepost', [$post->id]) }}",
                                            data: {
                                                "page_id": page_id,
                                                "message": message,
                                                "publish": publish,                                               
                                                "post_id": post_id,
                                                "resource_id": resource_id,
                                                _token: token
                                            },
                                            success: function (msg) {
                                            }
                                        });
                
            });


    }
  });
</script>

@endforeach
@endif


@endsection




