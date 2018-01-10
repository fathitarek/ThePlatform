@extends('auth.layouts.app')
@section('pageTitle')
    <title>{{ Lang::get('main.home_page_title') }}</title>
@endsection
@section('contentHeader')
        <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ URL('admin') }}">{{ Lang::get('main.dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ Lang::get('main.user') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> {{ Lang::get('main.user_profile') }} | {{ Lang::get('main.account') }}
        <small>{{ Lang::get('main.user_account_page') }}</small>
    </h1>
    <!-- END PAGE TITLE-->
    @endsection
@section('content')


    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['method'=>'POST','url'=>'admin/profile','files'=>true]) !!}
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">

                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ Auth::user()->name }} </div>
                    </div>
                    <!-- SIDEBAR USERPIC -->
                    <div class="text-center">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: none">
                                <img src="@if(file_exists(public_path(Auth::user()->img_dir.Auth::user()->img))&&!empty(Auth::user()->img_dir)&&!empty(Auth::user()->img)){{ asset(Auth::user()->img_dir.Auth::user()->img) }}@else{{ asset('img/Users/default_image.png') }}@endif" alt="" /> </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                            <div >
                                <span class="btn default btn-file">
                                    <span class="fileinput-new"> {{ Lang::get('main.select_image') }} </span>
                                    <span class="fileinput-exists"> {{ Lang::get('main.change') }} </span>
                                    <input type="file" name="image"> </span>
                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('main.remove') }} </a>
                            </div>
                        </div>
                    </div>

                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->

                    <!-- END SIDEBAR USER TITLE -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">

                                <div class="form-group">
                                    <label for="name" class="control-label">{{ Lang::get('main.name') }}</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="{{ Lang::get('main.enter').Lang::get('main.name') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">{{ Lang::get('main.email') }}</label>
                                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="{{ Lang::get('main.enter').Lang::get('main.email') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="username" class="control-label">{{ Lang::get('main.username') }}</label>
                                    <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" placeholder="{{ Lang::get('main.enter').Lang::get('main.username') }}" class="form-control" />
                                </div>
                            <div class="form-group">
                                <label for="old_password" class="control-label">{{ Lang::get('main.old_password') }}</label>
                                <input type="password" id="old_password" required name="old_password" placeholder="{{ Lang::get('main.enter').Lang::get('main.old_password') }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="control-label">{{ Lang::get('main.new_password') }}</label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{ Lang::get('main.enter').Lang::get('main.new_password') }}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="control-label">{{ Lang::get('main.confirm_password') }}</label>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="{{ Lang::get('main.enter').Lang::get('main.confirm_password') }}" class="form-control" />
                            </div>
                                <div class="margiv-top-10 text-center">
                                    <button type="submit" class="btn green">{{ Lang::get('main.save') }}</button>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
           {!! Form::close() !!}
        </div>

    </div>

@endsection
@section('scriptCode')

@endsection