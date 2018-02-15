@extends('home.layouts.app')
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
@section('pageTitle')
    <title>{{ Lang::get('home.home_page_title') }}</title>

    @endsection
@section('contentHeader')


@endsection
        @section('leftSideMenu')


        @endsection

    @section('content')



    @endsection
@section('scriptCode')



<script>


    $(document).ready(function() {
        console.log("xxxxxxxxxx","{{ URL('scheduledpostss') }}");
    $.ajax({
        type: "GET",
        url: "{{ URL('scheduledpostss') }}",

        success: function (data) {
          // console.log(data);
            $.each(data,function(key,value){
              //  console.log(key,value);
                        page_id=value.page_id;
                        message=value.message;
                        scheduleDate=value.created_time;
						 postid=value.id;
                       if (value.picture==""){
                           picture_url=$("#postMessagess").val();
                       }else{picture_url=value.picture;}


                console.log( page_id,message,scheduleDate,picture_url);
                        facebookposttopage ( page_id,message,scheduleDate,picture_url,postid);
//                addposttofacebook ( page_id,message,scheduleDate,picture_url,postid);


            }
            );

        }
    });



        function facebookposttopage(page_id,message,scheduleDate,picture_url,postid)
        {
            //get access token
            $.ajax({
                type: "POST",
                url: "{{ URL('getaccesstoken1') }}/"+page_id,
                data: {
                    "page_id": page_id,
                    _token: token
                },
                success: function (msg) {
                    console.log('assign accesstoken:',page_id,msg);
                    FaceBook.setAccessToken(msg);
                    addposttofacebook(page_id,message,scheduleDate,picture_url,postid);
                },
                error: function (msg) {
                    console.log('error :',msg);

                },

            });
            //get access token
        }

       function addposttofacebook ( page_id,message,scheduleDate,picture_url,postid) {
		   

           FaceBook.postToPageSchedule(page_id, message, scheduleDate, picture_url, function (page_id, data) {
               console.log('post tofacebook ', data);
               if (data.error) {
                   console.log("error : ",data);
               } else {
                   console.log("sucsess : ",data);
				   
				   $.ajax({
                                            type: "POST",
                                            url: '{{ URL('updatepost1') }}/'+postid,
                                            data: {
                                                "page_id": page_id,
                                                "message": message,
                                                "publish": 1,
                                                "post_id": postid,
                                                "resource_id": picture_url,
                                                _token: token
                                            },
                                            success: function (msg) {
                                            }
                                        });
										
               }
           });

       }





    });

</script>



















@endsection






