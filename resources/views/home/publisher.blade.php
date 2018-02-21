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



    <style>
        #preview #facebookPost .comment:before{
            content: "";
            background-position: -271px -142px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 5px;
        }
        #privewPlus{
            position: absolute;
            background: rgba(0, 0, 0, .5);
            right: 29px;
            bottom: 34px;
            width: 29.5%;
            height: 125px;
            text-align: center;
            line-height: 125px;
            color: #fff;
            font-size: 15pt;
        }

        #preview #facebookPost .like:before{
            content: "";
            background-position: -271px -112px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 6px;
        }
        #preview #facebookPost .share:before{
            content: "";
            background-position: -271px -127px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 6px;
        }
        #facebookPost{
            padding: 12px 12px 6px;border: 1px solid #dee0ea;background-color: #fff;
        }
        #facebookPost img{
            position: absolute;
        }
        #facebookPost .title{
            margin-left: 60px;color: #415496;font-size: 14px;font-weight: 700;font-family: Arial,sans-serif;
        }
        #facebookPost .datetime{
            margin-left: 60px;color: #899ab3;font-size: 12px;
        }







        #preview #twitterPost .comment:before{
            content: "";
            background-position: -271px -142px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
        }
        #preview #twitterPost .like:before{
            content: "";
            background-position: -271px -112px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
            margin-left: 20px;
        }
        #preview #twitterPost .share:before{
            content: "";
            background-position: -271px -127px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
        }
        #twitterPost{
            padding: 12px 12px 6px;border: 1px solid #dee0ea;background-color: #fff;
        }
        #twitterPost img{
            position: absolute;
        }
        #twitterPost .title{
            margin-left: 60px;color: #415496;font-size: 14px;font-weight: 700;font-family: Arial,sans-serif;
        }
        #twitterPost .datetime{
            margin-left: 60px;color: #899ab3;font-size: 12px;
        }












     #preview #linkedinPost .comment:before{
            content: "";
            background-position: -271px -142px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
        }
        #preview #linkedinPost .like:before{
            content: "";
            background-position: -271px -112px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
            margin-left: 20px;
        }
        #preview #linkedinPost .share:before{
            content: "";
            background-position: -271px -127px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-right: 50px;
        }
        div#linkedinPost{
            padding: 12px 12px 6px;border: 1px solid #dee0ea;background-color: #fff;
        }
        #linkedinPost img{
            position: absolute;
        }
        #linkedinPost .title{
            margin-left: 60px;color: #415496;font-size: 14px;font-weight: 700;font-family: Arial,sans-serif;
        }
        #linkedinPost .datetime{
            margin-left: 60px;color: #899ab3;font-size: 12px;
        }







    #preview #vkPost .comment:before{
            content: "";
            background-position: -271px -142px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
    margin-left: 20px;        }
        #preview #vkPost .like:before{
            content: "";
            background-position: -271px -112px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
            margin-left: 8px;
        }
        #preview #vkPost .share:before{
            content: "";
            background-position: -271px -127px;
            background-repeat: no-repeat;
            overflow: hidden;
            width: 15px;
            height: 15px;
            background-image: url('{{ asset('img/sprite-icons.png') }}');
            display: inline-block;
            position: relative;
            top: 3px;
    margin-left: 20px;

            }
        div#vkPost{
            padding: 12px 12px 6px;border: 1px solid #dee0ea;background-color: #fff;
        }
        #vkPost img{
            position: absolute;
        }
        #vkPost .title{
            margin-left: 60px;color: #415496;font-size: 14px;font-weight: 700;font-family: Arial,sans-serif;
        }
        #vkPost .datetime{
            margin-left: 60px;color: #899ab3;font-size: 12px;
        }





        #emptyPost{
            width: 352px;height: 231px;background:url('{{ URL('img/post-preview-empty.svg') }}');
        }
        .hasAddPage *{
            cursor: not-allowed;
        }

        .resource-item div:first-child{
            border: 5px solid gray;border-radius: 15px;margin-bottom: 15px
        }
        .resource-item button.close{
            position: absolute;right: 25px;background: white;border-radius: 25px;width: 20px;
        }
        .resource-item img{
            width: 100%;max-height:200px;border-radius: 5px;
        }
        .active-resource{
            border: 5px solid #047bf8!important;
        }
        .active-resource:before{
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 55px;
            content:"\f05d";
            pointer-events: none;
            opacity: 1;
            z-index: 500;
            position: absolute;
            display: block;
            top: 45%;
            left: 50%;
            margin-left: -27px;
            margin-top: -27px;
            color: #047bf8;
        }
        #resources-items .resource-item img{
            cursor:pointer;
        }
        #postPhoto>div{display: inline-block;}
        #removePostPhoto{
            float: left;
            position: relative;
            left: 115px;
            background: white;
            border-radius: 25px;
            width: 20px;
            margin-top: 5px;
        }

/*------------------ islam CSS ------------------------------*/

        .myaccimg{
         width: 60px;
         height: 60px;
         margin: 8px;
         border-radius: 40px;
        }
        .allaccimg{
         width: 40px;
         height: 40px;
         margin: 5px;
         border-radius: 40px;

        }
        select#privacy-status,#playlists {
    top: 10px;
    position: relative;
    height: 40px;
}






#file {
}
#file::-webkit-file-upload-button {
  visibility: hidden;
}
#file::before {
  content: 'Select Video';
  color: white;
  display: inline-block;
  background: -webkit-linear-gradient(top, #047bf8, #047bf8);
  border: 1px solid #047bf8;
  padding: 11px 5px;
  outline: none;
  -webkit-user-select: none;
  cursor: pointer;
  font-weight: 700;
  font-size: 10pt;
}
#file:hover::before {
  border-color: #047bf8;
}
#file:active {
  outline: 0;
}
#file:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
}
progress#upload-progress{
        margin-left: 70px !important;
}
.uploadvidf {
    position: relative;
    float: right;
    bottom: 10px;
}


img.imgprev {
    width: 50px;
    border-radius: 40px;

}
img.pubimg {
    width: 50px;
    padding: 5px;
    border-radius: 40px;

}




/* new */

.postToPage {
    background: white;
    -webkit-box-shadow: 0 8px 6px -6px black;
    -moz-box-shadow: 0 8px 6px -6px black;
    box-shadow: 0 5px 6px -6px black;
    cursor: pointer;

}


.addp {
    padding: 10px;
}

img.plusicon {
    width: 20px;
}



@keyframes click-wave {
  0% {
    height: 40px;
    width: 40px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}

.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 13.33333px;
  right: 0;
  bottom: 0;
  left: 0;
  height: 40px;
  width: 40px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #5bc0de;
}
.option-input:checked::before {
  height: 40px;
  width: 40px;
  position: absolute;
  content: '✔';
  display: inline-block;
  font-size: 26.66667px;
  text-align: center;
  line-height: 40px;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #40e0d0;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}

.statuschoose {
    background: white;
    -webkit-box-shadow: 0 8px 6px -6px black;
    -moz-box-shadow: 0 8px 6px -6px black;
    box-shadow: 0 5px 6px -6px black;
}


.innerstatus {
    padding: 10px;
}

.usecategory{
    display: none;
    padding: 20px;
}
.usescheduled{
    padding: 20px;
}
select#categoryid {
    height: 40px;
}

p.alertchooseprofile {
    color: red;
display: none;}




        .urlimg {
            position: relative !important;
            margin-right: auto;
            margin-left: auto;
            display: block;
            height: 250px;
        }

        .headerdescurl {
            font-weight: bolder;
            font-size: 16px;
        }
        .subdescurl {
            margin-bottom: 20px;
        }


    </style>
    @endsection
@section('contentHeader')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('publisher') }}">{{ Lang::get('home.publisher') }}</a></li>
    </ul>

    <ul class="">
        <li class=""><a href="{{ URL('facebook_csvFile') }}">CSV Upload</a></li>
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
                        <li>
                            <a class="mr-2 btn btn-primary" id="leftMenuCreatePost" data-target="@if(count($userPages)) .bd-chose-page @else .bd-create-new-post-lg @endif" data-toggle="modal">
                                <div class="icon-w" data-toggle="tooltip" data-placement="top" data-original-title="{{ Lang::get('home.create_new_post') }}">
                                    <div class="fa fa-plus">
                                    </div>
                                </div>
                            </a>
                        </li>
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
                </div>
            </div>
        @endsection
    @section('content')
        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade bd-chose-page" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Profiles</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true"> ×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <input type="text" class="form-control" id="searchProfile">
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="checkAllProfiles">
                                        Select all Profiles
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="allProfiles">
                                @foreach($userPages as $page)
                                    <div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-type="{{ $page->type }}" data-oauth-token="{{ $page->oauth_token }}" data-oauth-token-secret="{{ $page->oauth_token_secret }}" data-name="{{ $page->page_name }}" value="{{ $page->page_id }}" data-image="{{ $page->page_image_url }}" id="">


                        @if ($page->type == 'facebook')
                        <i style="margin-bottom: 2px; color: #4267B2;" class="fa fa-facebook"></i>
                        @elseif($page->type == 'youtube')
                        <i style="color: #FF021C" class="fa fa-youtube" aria-hidden="true"></i>
                        
                        @elseif($page->type == 'twitter')
                        <i  style="color: #2AA9E0" class="fa fa-twitter" aria-hidden="true"></i>

                        @elseif($page->type == 'linkedin')
                        <i  style="color: #000" class="fa fa-linkedin" aria-hidden="true"></i>
                        
                           @elseif($page->type == 'VK')
                        <i  style="color: #4A76A8" class="fa fa-vk" aria-hidden="true"></i>
                        @endif


                                        <img class="allaccimg" src="{{ $page->page_image_url }}" alt="{{ $page->page_name }}"><span style="font-size: 12px;">{{ $page->page_name }}</span></label></div></div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button>
                        <button  class="btn btn-primary" id="useProfile" type="button">Use Selected Profiles</button>
                    </div>
                </div>
            </div>
        </div>

        <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade bd-add-photos" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Photos</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true"> ×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- TAB NAVIGATION -->
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#add_photo" class="btn btn-primary changeTabs">Add Photo</a></li>
                                    <li><a href="#select_photo"  class="btn btn-default changeTabs">Select Photo</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-12">
                                <!-- TAB CONTENT -->
                                <div class="tab-content">
                                    <div class="active tab-pane fade in" id="add_photo">
                                        <div id="uploadedPhotos"></div>
                                       <div class="text-center">
                                           <form action="{{ URL('uploadPhotos') }}" class="dropzone" id="my-awesome-dropzone">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                               <div class="dz-message">
                                                   <div>
                                                       <h4>Drop files here or click to upload.</h4>
                                                       <div class="text-muted">(This is just a demo dropzone. Selected files are not actually uploaded)
                                                       </div>
                                                   </div>
                                               </div>
                                           </form>
                                       </div>
                                    </div>
                                    <div class="tab-pane fade" id="select_photo">
                                        <h2 class="text-center">Select Photo</h2>
                                        <?php $x=0;?>
                                        <div id="resources-items">
                                            @foreach($resources as $resource)
                                                <div class="col-lg-4 resource-item " id="resource-{{ $resource->id }}">
                                                    <div @if($x==0) class="active-resource" @endif>
                                                        <button type="button" data-id="{{ $resource->id }}" class="close remove-image">&times;</button>
                                                        <img data-id="{{ $resource->id }}" src="{{ asset($resource->resource_dir.$resource->resource) }}" alt="">
                                                    </div>
                                                </div>
                                                <?php $x++;?>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button>
                        <button  class="btn btn-primary" id="useImage" type="button">Use Selected Image</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS 1-->
   <!-- <div class="blog-page blog-content-1">
        <div class="clearfix"></div>
        <div class="clearfix" style="height:20px"></div>
        <div class="clearfix"></div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <div id="errorMessage"></div>
            <div id="postsInPages">
                {{--<div class="col-lg-12 postToPage" data-id="131752234107545"><img src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&amp;oe=5A3F36EC" alt="Test_page"><span>Test_page</span><a href="" onclick="return false;" date-time="now"  class="pull-right schedule">Now</a></div>--}}
            </div>
            <div class="clearfix"></div>
            <div class="clearfix" style="height: 50px;"></div>
            <div class="panel panel-default">
                <div class="panel-body">

                    <textarea class="form-control" name="postMessage" id="postMessage" placeholder="Post Content" rows="5" style="height: 50px; overflow: hidden; word-wrap: break-word;border: none;resize: none;" data-autosize-on="true"></textarea>
                    <div id="postPhoto">
                        {{--<div><button type="button" id="removePostPhoto" class="close">×</button><img src="http://sbks-builder.s3.amazonaws.com/r55p8ywopwd.jpg?format=jpg" style="width:120px;height:120px;" /></div>--}}
                    </div>
                </div>
                <div class="panel-footer post-footer">
                    <div class="post-icon pull-left">
                        <a href="#" data-target=".bd-add-photos" data-toggle="modal">
                            <i class="fa fa-camera"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-tags"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="schedule"></span>
                        </a>
                    </div>
                    <div class="pull-right">
                        <span id="countPost">0</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div>
                <div class="pull-right">
                    <a href="#" id="clearPublisher">Clear Publisher</a>
                    <button disabled="disabled" id="postButton" class="btn btn-primary">Schedule</button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <h4>Post Preview</h4>
            <p>Please select a profile to preview</p>
            <p>Available only for Facebook and Twitter pages</p>

            <div id="preview">
                <div id="emptyPost"></div>
                <div id="facebookPost" class="hidden">

                    <img src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&oe=5A3F36EC" alt="">
                    <div class="title">Test_page</div>
                    <div class="datetime">Just Now - <i class="fa fa-globe"></i></div>
                    <div class="clearfix"></div>
                    <div class="clearfix" style="height: 10px;"></div>
                    <p class="content"></p>
                    <div class="clearfix"></div>
                    <div style="border-top: 1px solid #dcdcdc;">
                        <span class="like"> Like</span>
                        <span class="comment"> Comment</span>
                        <span class="share"> Share</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->



<!-- -------------------- islam html --------------------- -->

    <div class="blog-page blog-content-1">
        <div class="clearfix"></div>
        <div class="clearfix" style="height:20px"></div>
        <div class="clearfix"></div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <div id="errorMessage"></div>
            <div id="postsInPages">

<div class="col-lg-12 postToPage" data-target=" .bd-chose-page " data-toggle="modal"><div class="addp"><img class="plusicon" src="img/add.ico"> Choose profiles </div></div>


                {{--<div class="col-lg-12 postToPage" data-id="131752234107545"><img src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&amp;oe=5A3F36EC" alt="Test_page"><span>Test_page</span><a href="" onclick="return false;" date-time="now"  class="pull-right schedule">Now</a></div>--}}


            </div>




















                        <div class="clearfix" style="height: 70px;"></div>

                        <div class="inputs"></div>

            <div class="clearfix"></div>


            <div class="panel panel-default">
                <div class="panel-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <textarea class="form-control" name="postMessage" id="postMessage" placeholder="Post Content" rows="5" style="height: 50px; overflow: hidden; word-wrap: break-word;border: none;resize: none;" data-autosize-on="true"></textarea>
                   </div>
                    <div class="clearfix"></div>
                    <div id="postPhoto">
                        {{--<div><button type="button" id="removePostPhoto" class="close">×</button><img src="http://sbks-builder.s3.amazonaws.com/r55p8ywopwd.jpg?format=jpg" style="width:120px;height:120px;" /></div>--}}
                    </div>
                </div>
 
 
                <div class="panel-footer post-footer">
                    <div class="post-icon pull-left">
                        <a href="#" data-target=".bd-add-photos" data-toggle="modal">
                            <i class="fa fa-camera"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-tags"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-calendar"></i>
                           <!-- <span class="schedule"></span>-->
                        </a>
                        <div class="uploadvidf"></div>
                    </div>

                    <div class="pull-right">
                        <span id="countPost">5000</span>
                    </div>
                    <div class="clearfix"></div>
                </div>


            </div>
         

<div class="statuschoose">
    <div class="innerstatus">
  <label>
    <input type="radio" id="customtime" class="option-input radio" name="example" checked />
    Custom Time

  </label><br>
<div id="test now" class="usescheduled">
<a href="" onclick="return false;" date-time="now" class="schedule">Now</a>
<p class="alertchooseprofile">Please choose your Profile..</p>

    </div>

  <label>
    <input type="radio" id="scheduledcat" class="option-input radio" name="example" />
Schedule Category
  </label><br>


<div id="test scheduled" class="usecategory">
<div> 
<select class="form-control" id="categoryid"><option value="">Select Category</option>

@foreach($categories as $category)
<option value='{{$category->id}}'>{{$category->name}}</option>
@endforeach
                    
</select>

</div>
</div>







    </div>
</div>

<br><br>
                <div class="pull-right">
                    <a href="#" id="clearPublisher">Clear Publisher</a>
                    <button disabled="disabled" id="postButton" class="btn btn-primary pub">Schedule</button>
          <!--<button id="testpost" class="btn btn-primary pub">test</button>-->
                </div>

</div>








        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <h4 class="prev">Post Preview</h4>
            <p>Please select a profile to preview</p>
            <p></p>

            <div id="preview">
                <div id="emptyPost"></div>
                <div id="player"></div>

                <div id="facebookPost" class="hidden">

                    <img class="imgprev" src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&oe=5A3F36EC" alt="">
                    <div class="title">Test_page</div>
                    <div class="datetime">Just Now - <i class="fa fa-globe"></i></div>
                    <div class="clearfix"></div>
                    <div class="clearfix" style="height: 10px;"></div>
                    <p class="content"></p>
                    <div id="imagesprev"></div>
                    <div id="urlprev"></div>

                    <div class="clearfix"></div>
                    <div style="border-top: 1px solid #dcdcdc;">
                        <span class="like"> Like</span>
                        <span class="comment"> Comment</span>
                        <span class="share"> Share</span>
                    </div>
                </div>




 <div id="twitterPost" class="hidden">
                    <img class="imgprev" src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&oe=5A3F36EC" alt="">
                    <div class="title">Test_page</div>
                    <div class="datetime">@twitter</div>
                    <div class="clearfix"></div>
                    <div class="clearfix" style="height: 10px;"></div>
                    <p class="content"></p>
                    <div id="imagesprevtwitter"></div>
                    <div id="urlprevtwitter"></div>

                    <div class="clearfix"></div>
                    <div style="border-top: 1px solid #dcdcdc;">
                        <span class="like"></span>
                        <span class="comment"></span>
                        <span class="share"></span>

                        <span class="comment"></span>
                    </div>
  </div> 







 <div id="linkedinPost" class="hidden">
                    <img class="imgprev" src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&oe=5A3F36EC" alt="">
                    <div class="title">Test_page</div>
                    <div class="datetime">@linkedin</div>
                    <div class="clearfix"></div>
                    <div class="clearfix" style="height: 10px;"></div>
                    <p class="content"></p>
                    <div id="imagesprevtwitter"></div>
                    <div id="urlprevtwitter"></div>

                    <div class="clearfix"></div>
                    <div style="border-top: 1px solid #dcdcdc;">
                        <span class="like"></span>
                        <span class="comment"></span>
                        <span class="share"></span>
                        <span class="comment"></span>
                    </div>
  </div> 




 <div id="vkPost" class="hidden">
                    <img class="imgprev" src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/20799907_131752677440834_5496398408492918250_n.jpg?oh=c4c9047b010223a4aa074cbe048d134d&oe=5A3F36EC" alt="">
                    <div class="title">Test_page</div>
                    <div class="datetime">Just Now </div>
                    <div class="clearfix"></div>
                    <div class="clearfix" style="height: 10px;"></div>
                    <p class="content"></p>
                    <div id="imagesprevtwitter"></div>
                    <div id="urlprevtwitter"></div>
                    <div class="clearfix"></div>
                    <div style="border-top:1px solid #dcdcdc;">
                    <span class="like"> <i class="far fa-heart"></i></span>
                        <span class="comment"> Comment </span>
                        <span class="share"></span>
                    </div>
  </div> 





            </div>
        </div>


    </div>


<hr>












<input type="hidden" id="yexpiresInn" value="">
<input type="hidden" id="accessto" value="">
<input type="hidden" id="pageidd" value="">


    @endsection
@section('scriptCode')

    {{--<script src="{{ asset('js/twitterJavaScript.js') }}"></script>--}}

    <script>
//islaaaaaaaaaam ------------------





























@if(count($userposts))
@foreach($userposts as $post)
/*
var scheduledat= new Date('{{$post->created_time}}');
if(scheduledat <= new Date()){

var scheduleDatee= '{{$post->created_time}}';
console.log('this post is schedueled');

        publish= 1;
        page_id = '{{$post->page_id}}';
        message = '{{$post->message}}';
        picture_url=$("#postPhoto img").attr('src');
        resource_id=$("#postPhoto img").data('id');

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
*/
@endforeach
@endif
        //token of post request
        token= '{{ csrf_token() }}';
        //cookies=new Cookie;
        //cookies.setCookie('accessToken','',-1)
        //cookies.setCookie('reuqestToken','',-1)
        //init function after facebook
        /*console.log(twitter.isLogin());
        cookies=new Cookie;
        cookies.setCookie('reuqestToken','',-1)
        cookies.setCookie('reuqestToken','',-1)*/

        /*if (Twitter.isLogin() != false) {
            alert('already login' + URL);

            //location.href = URL + '/home.html';
        }
        //twitter.setRequestToken(URL + '/twitter/jsCallback');
        Twitter.setRequestToken();
        $('#auth').click(function () {
            var requestToken = Twitter.getRequestToken();
            if (requestToken != false) {
                Twitter.Authenticate(requestToken);
            } else {
                alert('please set request token before call it');
            }
        });*/
        /*var accessToken = twitter.getAccessToken();
        console.log(accessToken);
        twitter.initializeCodeBird(accessToken);
        twitter.getUserDetails(function (reply, rate, err) {
            console.log(reply);
        });*/

        function init(){
            /*FaceBook.isAuthorized(function(data,res){
             console.log(new Date().getTime())
             console.log('{{ time() }}')
             newDate=new Date(res.expiresIn)
             console.log(newDate)
             console.log(res)
             });
             */
           /* FaceBook.getUserDetails(function(data){
                console.log(data);
            })*/
           /*FaceBook.login(function(data){
               console.log(data);
           })*/
            //"EAAV0FTkDnM4BAIgZAWahWHBDGwNlPpn2I0DqZCD9uTiirxwZCZC5CSZB37ZBgqgUnDnZABE1hroZBQ8Tbb3E4HbGrcYOARmrZCaWqCTVnfDfZA1oqv0nRllxJeUeavvMVuviWDAr2wkU3QywNPdv3P8K2w5NrTr14KZAjo7Wf401oDcFbtI2cqt8Ukx7ZAePwGkHB8YJYSKKLI1A6AZDZD"
            //"EAAV0FTkDnM4BAG8ZC6aLAEwvwVgUzIQms4qP6HodP2XGLsD9q2YXcLxs1YCAf8tyPeAztKfKPi4MGaIFX7DR8j87UuxxTQOPkzFLYcb9QBWVGDDHJvj13ItGfYRZAIvzOz1ejeSJrOytWZCDYj0yk4luVIfVsSLVnQUGtFobWqNAhZBsJGtSIrsIZAf5UIcout4gol3HzHAZDZD"
            /*FaceBook.customRequest('/181912195713121','GET',{"fields":FaceBook.scope,"access_token":"EAAV0FTkDnM4BAIgZAWahWHBDGwNlPpn2I0DqZCD9uTiirxwZCZC5CSZB37ZBgqgUnDnZABE1hroZBQ8Tbb3E4HbGrcYOARmrZCaWqCTVnfDfZA1oqv0nRllxJeUeavvMVuviWDAr2wkU3QywNPdv3P8K2w5NrTr14KZAjo7Wf401oDcFbtI2cqt8Ukx7ZAePwGkHB8YJYSKKLI1A6AZDZD"},function(data){
                console.log(data);
            })*/

        }
        Dropzone.autoDiscover = false;
        Dropzone.addRemoveLinks = true;
        $(document).ready(function(){
            /*console.log(Twitter.isLogin())
            if(Twitter.isLogin()){
                var accessToken = Twitter.getAccessToken();
                console.log(accessToken);
                Twitter.initializeCodeBird(accessToken);
                Twitter.makeTweet("twiiter","https://pbs.twimg.com/profile_images/2287464529/269404_2087090670616_5970750_n_normal.jpg",function(reply, rate, err){
                    console.log(reply);
                    console.log(rate);
                    console.log(err);
                });
            }*/
            function changeImages(){
                htmlimage='';
                length=$("#postPhoto>div>img").length;
                x=0;
                y=0;
                $("#postPhoto>div>img").each(function(){
                    image_url=$(this).attr('src');
                    image_id=$(this).data('id');
                    if(x<=3){  htmlimage+='<div class="urlpre "';
                        if(length==2){
                            htmlimage+='style="width:100%;display:block;"';
                        }
                        if(length==3&&x==0){
                            htmlimage+='style="width:100%;display:block;"';
                        }else if(length==3&&(x==1||x==2)){
                            htmlimage+='style="width:50%;display:inline-block;"';
                        }else if(length>=4&&(x==1||x==2||x==3)){
                            htmlimage+='style="width:33.33%;display:inline-block;"';
                        }

                        htmlimage+=' id="imageprev-'+image_id+'"><img class="urlimg"';
                        htmlimage+='style="width:100%;height:auto;"';
                        /*if(length==2){
                         htmlimage+='style="width:100%;height:auto;"';
                         }
                         if(length==3){
                         htmlimage+='style="width:100%;height:auto;"';
                         }*/
                        htmlimage+=' src="'+image_url+'"></div>';
                        y++;
                    }
                    x++;

                });
                if(length>4){
                    htmlimage+='<div id="privewPlus">+'+(length-4)+'</div>';
                }
                $("#imagesprev").html(htmlimage);
                $("#imagesprevtwitter").html(htmlimage);
            }
            $(document).on('click','#useImage',function(){
                htmlimage='';
                htmlPostPhoto='';
                length=$("#resources-items .resource-item .active-resource img").length;
                x=0;
                y=0;
                $("#resources-items .resource-item .active-resource img").each(function(){
                    image_url=$(this).attr('src');
                    image_id=$(this).data('id');
                    htmlPostPhoto+='<div><button type="button" id="removePostPhoto" data-id="'+image_id+'" class="close">×</button><img data-id="'+image_id+'" src="'+image_url+'" style="width:120px;height:120px;" /></div>';
                    if(x<=3){  htmlimage+='<div class="urlpre "';
                        if(length==2){
                            htmlimage+='style="width:100%;display:block;"';
                        }
                        if(length==3&&x==0){
                            htmlimage+='style="width:100%;display:block;"';
                        }else if(length==3&&(x==1||x==2)){
                            htmlimage+='style="width:50%;display:inline-block;"';
                        }else if(length>=4&&(x==1||x==2||x==3)){
                            htmlimage+='style="width:33.33%;display:inline-block;"';
                        }

                        htmlimage+=' id="imageprev-'+image_id+'"><img class="urlimg"';
                        htmlimage+='style="width:100%;height:auto;"';
                        /*if(length==2){
                            htmlimage+='style="width:100%;height:auto;"';
                        }
                        if(length==3){
                            htmlimage+='style="width:100%;height:auto;"';
                        }*/
                        htmlimage+=' src="'+image_url+'"></div>';
                        y++;
                    }
                    x++;

                });
                if(length>4){
                    htmlimage+='<div id="privewPlus">+'+(length-4)+'</div>';
                }
                $("#postPhoto").html(htmlPostPhoto)
                $(".bd-add-photos").modal('toggle');
                  $("#imagesprev").html(htmlimage);
                  $("#imagesprevtwitter").html(htmlimage);

            });
            $(document).on('click','#removePostPhoto',function(){
                $("#imageprev-"+$(this).data('id')).remove();
                $(this).parent().remove();
                changeImages();
            });
            $(document).on('click','#resources-items .resource-item img',function(){
                //$("#resources-items .resource-item div").removeClass('active-resource');
                $(this).parent().toggleClass('active-resource');
                if($(".active-resource").length==0){
                    $(this).parent().toggleClass('active-resource');
                }
            });
            $(document).on('click','.remove-image',function(){
                el=$(this);
                photo_id=$(this).data('id');
                if(!el.parent().hasClass('active-resource')){
                    $.ajax({
                        type: "POST",
                        url: "{{ URL('removePhoto') }}",
                        data: {
                            "photo_id": photo_id,
                            _token: token
                        },
                        success: function (msg) {
                            if(msg.success){
                                $("#resource-"+photo_id).remove();
                            }
                        }
                    });
                }else{
                    alert('You can\'t remove selected image');
                }

            });
            var myDropzone=new Dropzone("#my-awesome-dropzone");
            myDropzone.on('success',function(file, responseText){
                $("a[href='#select_photo']").trigger('click');
                $(".dz-preview.dz-processing.dz-image-preview.dz-success").remove();
                $("#my-awesome-dropzone").removeClass('dz-started');
                $("#resources-items .resource-item .active-resource").removeClass('active-resource');
                $("#resources-items").prepend(responseText.html)
                console.log(responseText);
            });
            myDropzone.on("addedfile", function(file) {
                /* Maybe display some more file information on your page */
                console.log(file);
            });
            $(document).on('click','.changeTabs',function(e){
                e.preventDefault();
                $(".changeTabs").removeClass('btn-primary btn-default').addClass('btn-default');
               $(this).removeClass('btn-default').addClass('btn-primary');
                target=$(this).attr('href');
                console.log(target)
                $(".tab-pane").removeClass('active in');
                $(target).addClass('active in');
            });
            var nowDate=new Date();
            //post button action



$(document).on('click','#testpost',function(){
create_post('facebook','','','test','111','522235181447370','fathyscheduled','18');
});


// url === 'www.facebook.com'
//update_post('facebook','now','','','111','522235181447370','fathyscheduled','','547');


   if($('#scheduledcat').is(':checked')) { alert("it's checked"); }



    $(".option-input").change(function () {
        if ($("#customtime").is(":checked")) {
            $('.usescheduled').slideDown('slow');
            $('.usecategory').hide('slow');

        }
        else if ($("#scheduledcat").is(":checked")) {
            $('.usecategory').slideDown('slow');
            $('.usescheduled').hide('slow');
        }
    });     




$(document).on('click','#postButton',function(){
                //get all pages selected
    if(typeof scheduleDateTime=='undefined'){
        newDate=new Date();
        scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();
    }
    if(categoryid != ''){
        scheduleDateTime='catogrized';
    }
                postToPage=$(".postToPage");
                if(postToPage.length){
                    //get message textarea
                    postMessage=$("#postMessage");
                    message=postMessage.val();
                    if(message.length) {
                        postToPage.each(function () {
                            //each elemet that have postToPage class [ all pages selected ]
                            el = $(this);

                            page_id = el.data('id');
                            page_type = el.data('type');
                             if(page_type=='facebook'){

                            facebookposttopage(page_id);
}
//return'';
               
                             if(page_type=='twitter'){
                                picture_url=$("#postPhoto img").attr('src');
                                resource_id=$("#postPhoto img").data('id');
                                oauth_token_secret=el.data('oauth-token-secret');
                                oauth_token=el.data('oauth-token');
                                 picture_urls=[];
                                 resource_ids=[];
                                 $("#postPhoto img").each(function(){
                                     picture_urls.push($(this).attr('src'));
                                 });
                                 $("#postPhoto img").each(function(){
                                     resource_ids.push($(this).data('id'));
                                 });
                                if(Twitter.isLogin()){
                                    var accessToken = Twitter.getAccessToken();
                                    console.log(accessToken);
                                    //Twitter.initializeCodeBird(accessToken);
                                    accessToken={oauth_token:oauth_token,oauth_token_secret:oauth_token_secret};
                                    console.log(accessToken)
                                    Twitter.initializeCodeBird({oauth_token:oauth_token,oauth_token_secret:oauth_token_secret});
                                    Twitter.makeTweet(message,picture_urls,function(reply, rate, err){
                                        post_id = reply.id;
                                        resource_id=(typeof resource_ids=='undefined')?[]:resource_ids;
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ URL('addPost') }}",
                                            data: {
                                                "page_id": page_id,
                                                "message": message,
                                                "publish": publish,
                                                "scheduleDateTime": scheduleDateTime,
                                                "post_id": post_id,
                                                "resource_ids": resource_ids,
                                                "picture_urls": picture_urls,
                                                _token: token
                                            },
                                            success: function (msg) {
                                            }
                                        });
                                    });
                                }else{
                                    Twitter.setRequestToken(function(reply){
                                        var requestToken = Twitter.getRequestToken();
                                        console.log(requestToken);
                                        if (requestToken != false) {
                                            Twitter.Authenticate(requestToken,function(d){
                                                if(d=='authenticate'){
                                                    var accessToken = Twitter.getAccessToken();
                                                    console.log(accessToken);
                                                    Twitter.initializeCodeBird(accessToken);
                                                    Twitter.getUserDetails(function (reply, rate, err) {
                                                        var accessToken = Twitter.getAccessToken();
                                                        console.log(accessToken);
                                                        //Twitter.initializeCodeBird(accessToken);
                                                        accessToken={oauth_token:oauth_token,oauth_token_secret:oauth_token_secret};
                                                        console.log(accessToken)
                                                        Twitter.initializeCodeBird({oauth_token:oauth_token,oauth_token_secret:oauth_token_secret});
                                                        Twitter.makeTweet(message,picture_urls,function(reply, rate, err){
                                                            post_id = reply.id;
                                                            resource_id=(typeof resource_ids=='undefined')?[]:resource_ids;
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "{{ URL('addPost') }}",
                                                                data: {
                                                                    "page_id": page_id,
                                                                    "message": message,
                                                                    "publish": publish,
                                                                    "scheduleDateTime": scheduleDateTime,
                                                                    "post_id": post_id,
                                                                    "resource_ids": resource_ids,
                                                                    "picture_urls": picture_urls,
                                                                    _token: token
                                                                },
                                                                success: function (msg) {
                                                                }
                                                            });
                                                        });
                                                    });
                                                }
                                            });
                                        } else {
                                            alert('please set request token before call it');
                                        }
                                    })

                                }
                            }








//linkedin addpost ----------- -------------------------------------------
              if(page_type=='linkedin'||page_type=='linkedin_company'){

            publish=0;
                    picture_url=$("#postPhoto img").attr('src');
                    resource_id=$("#postPhoto img").data('id');
                    resource_id=(typeof resource_id=='undefined')?0:resource_id;
                    if($("#urlprev").html().length){
                        picture_url=$("#urlprev img.urlimg").attr('src');
                        message+="\n"
                        message+=$("#urlprev .headerdescurl").text();
                        message+="\n"
                        message+=$("#urlprev .subdescurl").text();
                    }

                        scheduleDate = $('.schedule').attr('date-time');
                        categoryid=$('#categoryid').val();
      if(typeof scheduleDateTime=='undefined'){
                    newDate=new Date();
                    scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();
                }

                if(categoryid != ''){
                    scheduleDateTime='catogrized';
                }


                    if(scheduleDate=='now' && categoryid ==''){
                        publish=1;
                        console.log(page_id,message,scheduleDate,picture_url);
                        bodyRequest = {
                            "comment": message,
                            "visibility": {
                                "code": "anyone"
                            }
                        };
                        if(page_type=='linkedin_company'){
                            LinkedIN.shareInCompany(page_id,bodyRequest,function(result){
                                $.ajax({
                                    type: "POST",
                                    url: "{{ URL('addPost') }}",
                                    data: {
                                        "page_id": page_id,
                                        "message": message,
                                        "publish": publish,
                                        "scheduleDateTime": scheduleDateTime,
                                        "post_id": result.updateKey,
                                        "resource_id": resource_id,
                                        "picture_url": picture_url,
                                        _token: token
                                    },
                                    success: function (msg) {
                                    }
                                });
                            })
                        }else{
                            LinkedIN.shareInMyProfile(bodyRequest,function(result){
                                $.ajax({
                                    type: "POST",
                                    url: "{{ URL('addPost') }}",
                                    data: {
                                        "page_id": page_id,
                                        "message": message,
                                        "publish": publish,
                                        "scheduleDateTime": scheduleDateTime,
                                        "post_id": result.updateKey,
                                        "resource_id": resource_id,
                                        "picture_url": picture_url,
                                        _token: token
                                    },
                                    success: function (msg) {
                                    }
                                });
                            })
                        }

                        /*IN.API.Raw("people/~/shares")
                                .method("POST")
                                .body(bodyRequest)
                                .result(function(result) {

                                    console.log("Success")

                                    $.ajax({
                                        type: "POST",
                                        url: "{{ URL('addPost') }}",
                                        data: {
                                            "page_id": page_id,
                                            "message": message,
                                            "publish": publish,
                                            "scheduleDateTime": scheduleDateTime,
                                            "post_id": 'linkedin1245',
                                            "resource_id": resource_id,
                                            "picture_url": picture_url,
                                            _token: token
                                        },
                                        success: function (msg) {
                                        }
                                    });
                                }).error(function(result) {
                            console.log(JSON.stringify(result));
                        });*/




                    }else{
                        //console.log(page_id,message,scheduleDateTime,categoryid);
                        $.ajax({
                            type: "POST",
                            url: "{{ URL('addPost') }}",
                            data: {
                                "page_id": page_id,
                                "message": message,
                                "publish": publish,
                                "scheduleDateTime": scheduleDateTime,
                                "category_id":categoryid,
                                "post_id": '0',
                                "resource_id":resource_id,
                                "picture_url": picture_url,
                                _token: token
                            },
                            success: function (msg) {
                            }
                        });
                    }
                }
         

 //linkedin addpost end------------------------------------------------------



//VK addpost----------------------------------------------


              if(page_type=='VK'){



            publish=0;
                    picture_url=$("#postPhoto img").attr('src');
                    resource_id=$("#postPhoto img").data('id');
                    resource_id=(typeof resource_id=='undefined')?0:resource_id;
                    if($("#urlprev").html().length){
                        picture_url=$("#urlprev img.urlimg").attr('src');
                        message+="\n"
                        message+=$("#urlprev .headerdescurl").text();
                        message+="\n"
                        message+=$("#urlprev .subdescurl").text();
                    }

                        scheduleDate = $('.schedule').attr('date-time');
                        categoryid=$('#categoryid').val();
      if(typeof scheduleDateTime=='undefined'){
                    newDate=new Date();
                    scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();
                }

                if(categoryid != ''){
                    scheduleDateTime='catogrized';
                }


                    if(scheduleDate=='now' && categoryid ==''){
                        publish=1;
                        console.log(page_id,message,scheduleDate,picture_url);








 VK.Api.call('wall.post', {
            message: message,
            }, function(r) {   
                if (r.error) {
                    console.log(r.error);
                   }else{
                        $.ajax({
                                    type: "POST",
                                    url: "{{ URL('addPost') }}",
                                    data: {
                                        "page_id": page_id,
                                        "message": message,
                                        "publish": publish,
                                        "scheduleDateTime": scheduleDateTime,
                                        "post_id": 'linkedin1245',
                                        "resource_id": resource_id,
                                        "picture_url": picture_url,
                                        _token: token
                                    },
                                    success: function (msg) {
                                    }
                                });


                alert('success');

                   }       
                        
        });


//vk scheduled post
                    }else{
                        //console.log(page_id,message,scheduleDateTime,categoryid);
                        $.ajax({
                            type: "POST",
                            url: "{{ URL('addPost') }}",
                            data: {
                                "page_id": page_id,
                                "message": message,
                                "publish": publish,
                                "scheduleDateTime": scheduleDateTime,
                                "category_id":categoryid,
                                "post_id": '0',
                                "resource_id":resource_id,
                                "picture_url": picture_url,
                                _token: token
                            },
                            success: function (msg) {
                            }
                        });
                    }
                }
         


















//end addpost-------------------------------

                        });
                        scheduleDate = $('.schedule').attr('date-time');
                        categoryid=$('#categoryid').val();
                        publish=(scheduleDate=='now' && categoryid =='')?1:0;
                        //clear publisher
                        //add success post message
                        if(publish==0){
                        $("#errorMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your Post is Scheduled Successfuly</div>')
                        }else{
                        $("#errorMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your Post Is Success Posted</div>')
                    }
                    }

                }
            });



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
                        console.log('assign accesstoken:',page_id,msg);
                        FaceBook.setAccessToken(msg);
                        addfacebookpost(page_id);
                    },
                    error: function (msg) {
                        console.log('error :',msg);

                    },

                });
                //get access token
            }

            function addfacebookpost(page_id)
            {

                //add facebook post
                scheduleDate = $('.schedule').attr('date-time');
                categoryid=$('#categoryid').val();
                scheduleDateTime = $('.schedule').attr('date-scheduleDateTime');
                resource_id=(typeof resource_id=='undefined')?0:resource_id;

                if(typeof scheduleDateTime=='undefined'){
                    newDate=new Date();
                    scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();
                }

                if(categoryid != ''){
                    scheduleDateTime='catogrized';
                }

                publish=1;
                //if type is facebook

                if(page_type=='facebook'){
                    console.log('asdasdasd');
                    publish=0;
                    picture_urls=[];
                    resource_ids=[];
                    $("#postPhoto img").each(function(){
                        picture_urls.push($(this).attr('src'));
                    });
                    $("#postPhoto img").each(function(){
                        resource_ids.push($(this).data('id'));
                    });
                    //picture_url=$("#postPhoto img").attr('src');
                    //resource_id=$("#postPhoto img").data('id');
                    //resource_id=(typeof resource_id=='undefined')?0:resource_id;
                    if($("#urlprev").html().length){
                        //picture_url=$("#urlprev img.urlimg").attr('src');
                        picture_urls.push($("#urlprev img.urlimg").attr('src'));
                        message+="\n"
                        message+=$("#urlprev .headerdescurl").text();
                        message+="\n"
                        message+=$("#urlprev .subdescurl").text();
                    }
                    if(scheduleDate=='now' && categoryid ==''){
                        publish=1;
                        console.log(page_id,message,scheduleDate,picture_urls);
                        FaceBook.postToPageSchedule(page_id,message,scheduleDate,picture_urls,function(page_id,data){
                            console.log(data);
                            if(data.error){
                                $("#errorMessage").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+data.error.message+'</div>');
                            }else{
                                //post_id =(typeof picture_url=='undefined')? data.id:data.post_id;
                                post_id =data.id;

                                $.ajax({
                                    type: "POST",
                                    url: "{{ URL('addPost') }}",
                                    data: {
                                        "page_id": page_id,
                                        "message": message,
                                        "publish": publish,
                                        "scheduleDateTime": scheduleDateTime,
                                        "post_id": post_id,
                                        "resource_ids": resource_ids,
                                        "picture_urls": picture_urls,
                                        _token: token
                                    },
                                    success: function (msg) {
                                    }
                                });
                            }
                        });
                    }else{
                        //console.log(page_id,message,scheduleDateTime,categoryid);
                        $.ajax({
                            type: "POST",
                            url: "{{ URL('addPost') }}",
                            data: {
                                "page_id": page_id,
                                "message": message,
                                "publish": publish,
                                "scheduleDateTime": scheduleDateTime,
                                "category_id":categoryid,
                                "post_id": '0',
                                "resource_id":resource_ids,
                                "picture_url": picture_urls,
                                _token: token
                            },
                            success: function (msg) {
                            }
                        });
                    }
                }
                if(publish==0){

                    $("#errorMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your Post is Scheduled Successfuly</div>')
                }else{
                    $("#errorMessage").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your Post Is Success Posted</div>')
                }
                $("#postMessage").val('');

                //add facebook post
            }
            //clearPublisher
            $(document).on('click','#clearPublisher',function(e){
                e.preventDefault();
                $("#postMessage").val('');
                $("#postsInPages").html('');
                $("#checkAllProfiles").prop('checked',false);
                $("#postButton").html('Schedule').attr('disabled','disabled');
                $(".userProfiles").prop('checked',false);
                $("#countPost").html(5000)
                $("#facebookPost").addClass('hidden');
                $("#twetterPost").addClass('hidden');
                $("#emptyPost").removeClass('hidden');
            });



$('#categoryid').on('change', function() {
  if($('#categoryid').val()!=''){
                    $('#postButton').html('Save Post');


  }
});


$(document).on('click','.schedule',function(){
$('.alertchooseprofile').show('slow');
 });   



$(document).on('click','#useProfile',function(){
                html='';
 //--------------------------------------- ISLAM JS ---------------------               
                htmlin='';
                htmlinn='';
 
$('.alertchooseprofile').remove();

        if($('input[data-type="youtube"]:checked').length > 0){
        $('#connectSocialYoutube').click();

                $(".userProfiles:checked").each(function(){
                    page_name=$(this).attr('data-name');
                    page_image=$(this).attr('data-image');
                    page_type=$(this).attr('data-type');
                    page_id=$(this).val();
                    chanell_access=$(this).attr('data-access');
                    time_modf=$(this).attr('data-time');
                    page_access=$(this).attr('data-access');
                   
                    $('#pageidd').val(page_id);
                    $('#accessto').val(page_access);




                     var ds = time_modf; 
                     var newDate = new Date(ds).getTime(); //convert string date to Date object
                     var currentDate = new Date().getTime();
                     var diff = currentDate-newDate;
                var minutes = Math.floor((diff/1000)/60);
var timesub=minutes-120;
console.log(timesub);

if(timesub>2){
}else{

}








                    html+='<div class="col-lg-12 postToPage" data-id="'+page_id+'" data-name="page_name" data-image="'+page_image+'" data-type="'+page_type+'">' +
                            '<img class="allaccimg" src="'+page_image+'" alt="'+page_name+'">' +
                            '<span>'+page_name+'</span>' +
                            '</div>';



                 

                    
                    htmlin+='<div class="panel panel-default"><div class="panel-body" style="padding:7px;"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><input class="form-control" style="border: none;" id="title" type="text" placeholder="Title"></div></div></div><div class="panel panel-default"><div class="panel-body" style="padding:0px;"><div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><select class="form-control" id="privacy-status"><option>public</option><option>unlisted</option><option>private</option></select><br /></div><div  class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><select class="form-control" id="playlists"><option>choose playlist</option></select><br /></div></div></div>';


                });


                postButton=$("#postButton");
                $("#postsInPages").html(html);
                $(".inputs").html(htmlin);
                $(".uploadvidf").html('<input input type="file" id="file" class="button" accept="video/*"><progress id="upload-progress" max="1" value="0"></progress>');

                $(".bd-chose-page").modal('toggle');
                if(html.length){

                    $('.schedule').datetimepicker({
                        onChangeDateTime:function(){
                            nowDate=new Date();
                        },
                        onClose:function(dp,$input){
                            //console.log(dp)
                            if(dp.getTime()<=nowDate.getTime()){
                                //$(".schedule").html('Now').attr('date-time','now')
                                $input.html('Now').attr('date-time','now');
                                $('#privacy-status').attr('disabled', false);
                                $("#privacy-status").val("public").change();


                            }else{

                                $("#privacy-status").val("private").change();
                                $('#privacy-status').attr('disabled', 'disabled');

                                dateTime=Math.round(dp.getTime()/1000)+120
                                //$(".schedule").html(dp.getFullYear()+'-'+(dp.getMonth()+1)+'-'+dp.getDate()+' '+dp.getHours()+':'+dp.getMinutes()).attr('date-time',dateTime)
                                $input.html(dp.getFullYear()+'-'+(dp.getMonth()+1)+'-'+dp.getDate()+' '+dp.getHours()+':'+dp.getMinutes()).attr('date-time',dateTime)
                                console.log(dateTime)
                            }
                        },
                        dayOfWeekStart : 1,
                        step:1,
                        lang:'en',
                        disabledDates:[],//['1986/01/08','1986/01/09','1986/01/10'],
                        startDate:  new Date()//'1986/01/08'
                    });

                    $(".pub").attr("id","button");
                    $("#button").html('Upload Video');
                    $("#button").removeAttr('disabled');
                    $(".prev").html('Video Preview');
                   $(".imgprev").css('opacity','0.5px');

                   $('#emptyPost').css({"background": "url(https://cdn.arstechnica.net/wp-content/uploads/sites/3/2015/01/YouTube-640x391.jpg)","height": "200px","width": "350px","opacity": "0.6","background-size": "100% 100%"});  
                   $("#clearPublisher").hide();



}


}else{


//----------------------------------------------------------------------------
        $(".userProfiles:checked").each(function(){


                    oauth_token=$(this).attr('data-oauth-token');
                    oauth_token_secret=$(this).attr('data-oauth-token-secret');
                    page_name=$(this).attr('data-name');
                    page_image=$(this).attr('data-image');
                    page_type=$(this).attr('data-type');
                    page_id=$(this).val();
                    html+='<div class="col-lg-12 postToPage" data-oauth-token="'+oauth_token+'" data-oauth-token-secret="'+oauth_token_secret+'" data-id="'+page_id+'" data-name="page_name" data-image="'+page_image+'" data-type="'+page_type+'"><img class="pubimg" src="'+page_image+'" alt="'+page_name+'"><span>'+page_name+'</span></div>';



if($(this).attr('data-type')=='facebook'){
                    $("#facebookPost").removeClass('hidden');

 $("#facebookPost").clone();
 $("#preview #facebookPost .title").html($(this).attr('data-name'));
 $("#preview #facebookPost img.imgprev").attr('src',$(this).attr('data-image'));
}else if($(this).attr('data-type')=='twitter'){
$("#twitterPost").removeClass('hidden');

 $("#twitterPost").clone();
$("#preview #twitterPost .title").html($(this).attr('data-name'));
 $("#preview #twitterPost img.imgprev").attr('src',$(this).attr('data-image'));
}
//linkedin preview post--
else if($(this).attr('data-type')=='linkedin'){
$("#linkedinPost").removeClass('hidden');

 $("#linkedinPost").clone();
$("#preview #linkedinPost .title").html($(this).attr('data-name'));
 $("#preview #linkedinPost img.imgprev").attr('src',$(this).attr('data-image'));
}

//VK preview post--

else if($(this).attr('data-type')=='VK'){
$("#vkPost").removeClass('hidden');

 $("#vkPost").clone();
$("#preview #vkPost .title").html($(this).attr('data-name'));
 $("#preview #vkPost img.imgprev").attr('src',$(this).attr('data-image'));
}



});


                postButton=$("#postButton");
                $("#postsInPages").html(html);
                $(".bd-chose-page").modal('toggle');
                if(html.length){


  if($('#categoryid').val()!=''){
        $('#postButton').html('Save Post');
  }


                    $('.schedule').datetimepicker({
                        onChangeDateTime:function(){
                            nowDate=new Date();
                        },
                        onClose:function(dp,$input){
                            //console.log(dp)
                            if(dp.getTime()<=nowDate.getTime()){
                                //$(".schedule").html('Now').attr('date-time','now')
                                newDate=new Date();
                                scheduleDateTime=newDate.getFullYear()+'-'+(newDate.getMonth()+1)+'-'+newDate.getDate()+' '+newDate.getHours()+':'+newDate.getMinutes();
                                $input.html('Now').attr('date-time','now').attr('date-scheduleDateTime',scheduleDateTime);

                            }else{
                                dateTime=Math.round(dp.getTime()/1000)+120
                                //$(".schedule").html(dp.getFullYear()+'-'+(dp.getMonth()+1)+'-'+dp.getDate()+' '+dp.getHours()+':'+dp.getMinutes()).attr('date-time',dateTime)
                                scheduleDateTime=dp.getFullYear()+'-'+(dp.getMonth()+1)+'-'+dp.getDate()+' '+dp.getHours()+':'+dp.getMinutes();
                                $input.html(scheduleDateTime).attr('date-time',dateTime).attr('date-scheduleDateTime',scheduleDateTime);


                    postButton.html('Save Post');
      
                 //console.log(dateTime)
                            }
                        },
                        dayOfWeekStart : 1,
                        step:1,
                        lang:'en',
                        disabledDates:[],//['1986/01/08','1986/01/09','1986/01/10'],
                        startDate:  new Date()//'1986/01/08'
                    });
                    $("#emptyPost").addClass('hidden');

//if($(".userProfiles:checked:first").attr('data-type')=='facebook'){
          //          $("#twitterPost").addClass('hidden');


//}else if($(".userProfiles:checked:first").attr('data-type')=='twitter'){
//                      $("#facebookPost").addClass('hidden');

//}
                 $("#preview .content").html($("#postMessage").val());
                    postButton.html('Publish');
                    if($("#postMessage").val().length){
                        postButton.removeAttr('disabled');
                    }
                }
            }
            });
            $(document).on('keyup','#searchProfile',function(){
                search=$(this).val();
                $("#checkAllProfiles").prop('checked',false);
                $.ajax({
                    type: "POST",
                    url: "{{ URL('searchProfile') }}",
                    data: {"search":search,_token:token},
                    success: function (msg) {
                        if(msg.success){
                            $("#allProfiles").html(msg.html);
                        }
                    }
                });
            });
            $(document).on('change','.userProfiles',function(){
                checkBoxes=$("#checkAllProfiles");
                if($(".userProfiles").length==$(".userProfiles:checked").length){
                    checkBoxes.prop("checked",true);
                }else{
                    checkBoxes.prop("checked",false);
                }
            });
            $(document).on('change','#checkAllProfiles',function(){
                if($(this).is(':checked')){
                    $(".userProfiles").prop('checked',true);
                }else{
                    $(".userProfiles").prop('checked',false);
                }
            });
            function findUrls( text )
            {
                var source = (text || '').toString();
                var urlArray = [];
                var url;
                var matchArray;

                // Regular expression to find FTP, HTTP(S) and email URLs.
                var regexToken = /(((ftp|https?):\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;

                // Iterate through any URLs in the text.
                while( (matchArray = regexToken.exec( source )) !== null )
                {
                    var token = matchArray[0];
                    urlArray.push( token );
                }

                return urlArray;
            }
            var testsent=0;
            function nl2br (str, is_xhtml) {
                var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
                return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
            }
            $(document).on('keyup','#postMessage',function(){
                countWords=5000-$(this).val().length
                content=$(this).val();
                content=nl2br(content);
                $("#preview .content").html(content);
                urls=findUrls($(this).val());
               // console.log(urls);
                if ($(this).val() == ''){
                    testsent=0;

                   // $("#urlprev").html('');
                }
                if(typeof urls[0]!='undefined'){
                    testsent=1;
                    FaceBook.geturlmeta(urls[0],'EAATurYpXZBxoBAE2OgDrPdw2atRh8rMpmQytxEooPI8FjGpsUZAPtUfvl9k8lN8eokYmOyKOiI8Oibq6o0XtdTcOVuHlrCAFPyY7JimJmEqu1tDVxq6k0THVLQOG9SGHGT4mHr0uKEZB7qsetk0t4D6kmO2vHgZD',function(geturlmeta){
                        //console.log(typeof geturlmeta.og_object.image)
                        //console.log(geturlmeta);
                        htmlurl='<div class="urlpre">';
                        if(typeof geturlmeta.og_object.image !='undefined'){
                            htmlurl+='<img class="urlimg" src="'+geturlmeta.og_object.image[0].url+'">';
                        }
                        if(typeof geturlmeta.og_object.title !='undefined'){
                            htmlurl+='<div class="headerdescurl">'+geturlmeta.og_object.title+'</div>';
                        }
                        if(typeof geturlmeta.og_object.description !='undefined'){
                            htmlurl+='<div class="subdescurl">'+geturlmeta.og_object.description+'</div>';
                        }
                        htmlurl+='</div>';
                        $("#urlprev").html(htmlurl);
                        $("#urlprevtwitter").html(htmlurl);

                        // html+='<div class="col-lg-12 postToPage" data-oauth-token="'+oauth_token+'" data-oauth-token-secret="'+oauth_token_secret+'" data-id="'+page_id+'" data-name="page_name" data-image="'+page_image+'" data-type="'+page_type+'"><img class="pubimg" src="'+page_image+'" alt="'+page_name+'"><span>'+page_name+'</span>';
                        console.log(geturlmeta);
                    });
                }

                /*if(new RegExp("([a-zA-Z0-9]+://)?([a-zA-Z0-9_]+:[a-zA-Z0-9_]+@)?([a-zA-Z0-9.-]+\\.[A-Za-z]{2,4})(:[0-9]+)?(/.*)?").test($(this).val())) {

                    var $words = $(this).val().split(' ');
                    for (i in $words) {
                        if ($words[i].indexOf('http://') == 0 || $words[i].indexOf('https://') == 0) {

                            if(testsent == 1){

                            }else{
                                testsent=1;
                                FaceBook.geturlmeta($words[i],'EAATurYpXZBxoBAE2OgDrPdw2atRh8rMpmQytxEooPI8FjGpsUZAPtUfvl9k8lN8eokYmOyKOiI8Oibq6o0XtdTcOVuHlrCAFPyY7JimJmEqu1tDVxq6k0THVLQOG9SGHGT4mHr0uKEZB7qsetk0t4D6kmO2vHgZD',function(geturlmeta){


                                    htmlurl='<div class="urlpre"><img class="urlimg" src="'+geturlmeta.og_object.image[0].url+'"><div class="headerdescurl">'+geturlmeta.og_object.description+'</div><div class="subdescurl">'+geturlmeta.og_object.description+'</div></div>';
                                    $("#urlprev").html(htmlurl);
                                    // html+='<div class="col-lg-12 postToPage" data-oauth-token="'+oauth_token+'" data-oauth-token-secret="'+oauth_token_secret+'" data-id="'+page_id+'" data-name="page_name" data-image="'+page_image+'" data-type="'+page_type+'"><img class="pubimg" src="'+page_image+'" alt="'+page_name+'"><span>'+page_name+'</span>';

                                    console.log(geturlmeta);

                                });
                            }
                        }
                    }


                }*/


                if($("#postButton").html()=='Publish' || $("#postButton").html()=='Save Post'){
                    if(countWords){
                        $("#postButton").removeAttr('disabled');
                    }else{
                        $("#postButton").attr('disabled','disabled');
                    }

                }
                $("#countPost").html(countWords);
            });





            /*if (Twitter.isLogin() != false) {
             alert('already login' + URL);

             //location.href = URL + '/home.html';
             }
             //twitter.setRequestToken(URL + '/twitter/jsCallback');
             Twitter.setRequestToken();
             $('#auth').click(function () {
             var requestToken = Twitter.getRequestToken();
             if (requestToken != false) {
             Twitter.Authenticate(requestToken);
             } else {
             alert('please set request token before call it');
             }
             });*/

        });

//-----------------------------ISLAM JS ------------------------------



//------------------------------------------------------------------------------------------
</script>



















@endsection






