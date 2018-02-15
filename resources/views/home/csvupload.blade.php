@extends('home.layouts.app')
@section('headScript')
    <script src=" {{ asset('js/twitter.js') }}"></script>
    <script src=" {{ asset('js/addPostAddDatabase.js') }}"></script>

    <link href="{{ asset('css/styleUploadFileFacebook.css') }}" rel="stylesheet">
    <style>

        td, th { padding:10px;}
        .date_time{display: none; border: 1;}
        #category_id{display: none;}

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('/js/facebookJavaScript.js')}}"> </script>
@endsection
@section('pageTitle')
    <title>{{ Lang::get('home.home_page_title') }}</title>
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





                <div _ngcontent-c25="" class="step choose-type">
                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">1</span>
                        <span _ngcontent-c25="" translate="">Choose Profile</span>
                    </div>
                    <span _ngcontent-c25="" class="step-subhead" translate="">Tell us for which profile you want to upload the CSV</span>
                    <div _ngcontent-c25="" style="height:20px;"></div>
                    <form method="post" action="{{ url('/facebook/csv') }}" enctype="multipart/form-data">
                        <select required name="page_id">
                            <option value=""> Choose Account</option>
                            @foreach($pages as $page)
                                <option value="{{$page->page_id}}">{{$page->page_name}}</option>
                            @endforeach
                        </select>
                        <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                            <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">2</span>
                            <span _ngcontent-c25="" translate="">Choose from the following csv formats to upload</span>
                        </div>
                        <span _ngcontent-c25="" class="step-subhead" translate="">Select either a pre selected category or crom time for your posts</span>
                        <div _ngcontent-c25="" style="height:20px;"></div>

                        <div _ngcontent-c25="" class="step-content">
                            <input type="radio" id="select_category" name="date_time" value="0" style="border-color: #448aff;"> Pre select Category<br>
                            <!--<select id="category_id" name="category_id">-->
                            <!--<option value=""> Choose Category</option>-->
                            <!--<option selected value="{{Auth::guard('AppUsers')->user()->id}}">{{Auth::guard('AppUsers')->user()->name}}</option>-->
                            <!--</select>-->
                            <br>
                            {{ Form::select('category_id',$records,null,['placeholder' => 'Choose Category','class'=> '','id'=>'category_id']) }}
                            <br>
                            <input type="radio" id="select_date_time" name="date_time" value="1"> Date-time based CSV file<br>
                            <table border="1" style="margin-bottom: 20px;margin-top: 50px;">
                                <caption style="padding: 35px;">Your CSV file should be of the following format (do not include the headers)</caption>
                                <thead style="background-color: gray; color: black;">
                                <tr>
                                    <th>message</th>
                                    <th>Media URL</th>
                                    <th class="date_time">created_time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>It's a beautiful day today. Good Morning  </td>
                                    <td></td>
                                    <td class="date_time">Jan 16, 2018</td>
                                </tr>
                                <tr>
                                    <td>A beautiful picture of the Torii gates </td>
                                    <td>http://i.imgur.com/iyvborD.jpg</td>
                                    <td class="date_time">Jan 16, 2018</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        {{--</div>--}}








                        <div _ngcontent-c25="" class="step shorten-urls">
                            <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">3</span>
                                <span _ngcontent-c25="" translate="">Shorten URLs in the messages</span>
                            </div>
                            <div _ngcontent-c25="" class="step-content">
                                <div _ngcontent-c25="" class="layout-margin" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                    <mat-slide-toggle _ngcontent-c25="" class="mat-slide-toggle mat-accent mat-checked mat-slide-toggle-label-before" labelposition="before" id="mat-slide-toggle-1"><label class="mat-slide-toggle-label">
                                            <div class="mat-slide-toggle-bar" style=" position: absolute; left: 60px;"><input class="mat-slide-toggle-input cdk-visually-hidden" type="checkbox" id="mat-slide-toggle-1-input" tabindex="0"><div class="mat-slide-toggle-thumb-container"><div class="mat-slide-toggle-thumb"></div><div class="mat-slide-toggle-ripple mat-ripple" mat-ripple=""></div></div></div><span class="mat-slide-toggle-content">
                                                        <span _ngcontent-c25="" translate="posts.create_post.create_post.detail.shorten">Shorten Urls</span>
                                                    </span></label></mat-slide-toggle>
                                    <span _ngcontent-c25="" fxflex="" style="flex: 1 1 1e-09px; box-sizing: border-box;"></span>
                                    <select _ngcontent-c25="">
                                        <option _ngcontent-c25="" value="sb.gl">sb.gl</option>
                                        <option _ngcontent-c25="" value="bit.ly" disabled="">bit.ly</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div _ngcontent-c25="" class="step upload-files">
                            <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">4</span>
                                <span _ngcontent-c25="" translate="">Upload CSV file</span>
                            </div>
                            <span _ngcontent-c25="" class="step-subhead">You can <a class="bulk-upload-download-option" href="https://cdn-front.statusbrew.com/posts/resources/csv2col-v1-1f1f836.csv" target="_blank">download</a> a sample file to get started</span>
                            <div _ngcontent-c25="" style="height:20px;"></div>
                            <div _ngcontent-c25="" class="step-content">
                                <div _ngcontent-c25="" class="file-drop error" ng2filedrop="">
                                    <!---->
                                    <!----><div _ngcontent-c25="" class="ng2-upload-block" fxlayout="column" fxlayoutalign="center stretch" style="box-sizing: border-box; display: flex; flex-direction: column; max-width: 100%; place-content: stretch center; align-items: stretch;">

                                        <input type="file" name="csv_file" id="csv_file" class="" accept=".csv" required>
                                    </div>
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>

    </div>


@endsection
@section('scriptCode')

    <script>
        $(document).ready(function () {
            $('#select_category').click(function () {
                if ($('#select_category').is(':checked')) {
                    $(".date_time").css("display", "none");
                    $("#category_id").css("display","block");
                }
            });


            $('#select_date_time').click(function () {
                if ($('#select_date_time').is(':checked')) {
                    $(".date_time").css("display", "block");
                    $("#category_id").css("display","none");
                }
            });

        });

    </script>
@endsection
