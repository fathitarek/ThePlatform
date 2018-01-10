@extends('auth.layouts.app')@section('pageTitle')    <title>{{ Lang::get('main.home_page_title') }}</title>@endsection@section('contentHeader')    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">    <style>        .width-percentage-100 .bootstrap-tagsinput {            width: 100%;        }    </style>        <!-- BEGIN PAGE HEADER-->    <!-- BEGIN PAGE BAR -->    <div class="page-bar">        <ul class="page-breadcrumb">            <li>                <a href="{{ URL('/admin') }}">{{ Lang::get('main.dashboard') }}</a>                <i class="fa fa-circle"></i>            </li>            <li>                <a href="{{ URL('/admin/app_users') }}">{{ Lang::get('main.app_users') }}</a>                <i class="fa fa-circle"></i>            </li>            <li>                <span>{{ Lang::get('main.add') }}</span>            </li>        </ul>    </div>    <!-- END PAGE BAR -->    <!-- BEGIN PAGE TITLE-->    <h1 class="page-title"> {{ Lang::get('main.app_users') }}        <small>{{ Lang::get('main.add') }}</small>    </h1>    <!-- END PAGE TITLE-->    <!-- END PAGE HEADER-->    @endsection@section('content')    <div class="row">        <div class="portlet light bordered">            <div class="portlet-title">                <div class="caption font-dark">                    <i class="icon-app_users font-dark"></i>                    <span class="caption-subject bold uppercase">{{ Lang::get('main.app_users') }}</span>                </div>                <div class="tools"> </div>            </div>            <div class="portlet-body">                {!! Form::open(['method'=>'POST','url'=>'admin/app_users','id'=>'addAppUsersForm','files'=>true]) !!}                <div class="form-body">                    <div class="alert alert-danger display-hide">                        <button class="close" data-close="alert"></button>                        {{ Lang::get('main.form_validation_error') }}                    </div>                    <div class="alert alert-success display-hide">                        <button class="close" data-close="alert"></button>                        {{ Lang::get('main.form_validation_success') }}                    </div>                    <div class="form-group col-lg-4">                        <label for="country_id">{{ Lang::get('main.country') }}</label>                        <select id="country_id" class="form-control select2me" style="width: 100%" name="country_id">                            <option value=""></option>                            @foreach($countries as $country)                                <option @if($country->id==old('country_id')) selected="selected" @endif value="{{ $country->id }}">{{ $country->name }}</option>                            @endforeach                        </select>                    </div>                    <div class="form-group col-lg-4">                        <label for="time_zone">{{ Lang::get('main.time_zone') }}</label>                        <select id="time_zone" class="form-control select2me" style="width: 100%" name="time_zone">                        </select>                    </div>                    <div class="form-group col-lg-4">                        <label for="parent_id">{{ Lang::get('main.parent') }}</label>                        <select id="parent_id" class="form-control select2me" style="width: 100%" name="parent_id">                            @foreach($appUsers as $appUser)                                <option @if($appUser->id==old('parent_id')) selected="selected" @endif value="{{ $appUser->id }}">{{ $appUser->name }}</option>                            @endforeach                        </select>                    </div>                    <div class="form-group col-lg-12">                        <label for="type">{{ Lang::get('main.type') }}</label>                        <select id="type" class="form-control select2me" style="width: 100%" name="type">                            <option @if(old('type')=='company') selected="selected" @endif value="company">{{ Lang::get('main.company') }}</option>                            <option @if(old('type')=='personal') selected="selected" @endif value="personal">{{ Lang::get('main.personal') }}</option>                        </select>                    </div>                    <div class="form-group col-lg-9">                        <label class="control-label" for="name">{{ Lang::get('main.name') }}  <span class="required"> * </span></label>                        <div class="input-icon right">                            <i class="fa"></i>                            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.name') }}">                        </div>                    </div>                    <div class="form-group col-lg-3 text-center" style="margin-top:25px;">                        <input type="checkbox" class="make-switch" name="active" value="1" checked data-size="small" data-on-color="success" data-on-text="active" data-off-color="default" data-off-text="unActive">                    </div>                    <div class="clearfix"></div>                    <div class="form-group col-lg-12">                        <label class=" control-label" for="email">{{ Lang::get('main.email') }}  <span class="required"> * </span></label>                        <div class="input-icon right">                            <i class="fa"></i>                            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.email') }}">                        </div>                    </div>                    <div class="form-group col-lg-12">                        <label class="control-label" for="phone">{{ Lang::get('main.phone') }}  <span class="required"> * </span></label>                        <div class="input-icon right">                            <i class="fa"></i>                            <input type="text" class="form-control" id="phone" value="{{ old('phone') }}" name="phone"  data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.phone') }}">                        </div>                    </div>                    <div class="form-group col-lg-12">                        <label class="control-label" for="password">{{ Lang::get('main.password') }}  <span class="required"> * </span></label>                        <div class="input-icon right">                            <i class="fa"></i>                            <input type="password" class="form-control" id="password" name="password" data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.password') }}">                        </div>                    </div>                    <div class="form-group col-lg-12">                        <label class="control-label" for="confirm_password">{{ Lang::get('main.confirm_password') }}  <span class="required"> * </span></label>                        <div class="input-icon right">                            <i class="fa"></i>                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.confirm_password') }}">                        </div>                    </div>                    <div class="text-center">                        <div class="fileinput fileinput-new" data-provides="fileinput">                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px; border: none">                                <img src="{{ asset('img/app_users/default_image.png') }}" alt="" /> </div>                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>                            <div >                                <span class="btn default btn-file">                                    <span class="fileinput-new"> {{ Lang::get('main.select_image') }} </span>                                    <span class="fileinput-exists"> {{ Lang::get('main.change') }} </span>                                    <input type="file" name="image"> </span>                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('main.remove') }} </a>                            </div>                        </div>                    </div>                    <div class="clearfix" style="height: 30px"></div>                    <div class="text-center">                        <button type="submit" class="btn green">{{ Lang::get('main.add') }}</button>                    </div>                </div>                <div class="clearfix" style="height: 30px"></div>                {!! Form::close() !!}            </div>        </div>    </div>@endsection@section('scriptCode')    <script src="{{ asset('js/bootstrap-typeahead.js') }}"></script>    <script src="{{ asset('js/bootstrap-tagsinput.min.js') }}"></script>    <script>        $(document).ready(function(){            $(".trafficSources input").typeahead({                ajax: {                    url: '{{ URL('trafficSources') }}'                }            });            $(document).on('click','#register-submit-btn',function(){                el=$(".trafficSources input");                val=el.val();                el.val('');                $("#trafficSources").tagsinput('add',val);                $("#trafficSources").val($("#trafficSources").tagsinput('items').join());            });            /*$('input').on('focusout',function(){             el=$(this);             if(el.parent().hasClass('bootstrap-tagsinput')){             val=el.val();             parentEl=el.parent().parent();             if(parentEl.hasClass('trafficSources')){             el.val('');             $("#trafficSources").tagsinput('add',val);             }             }             });*/        });    </script>    <script>        $(document).ready(function(){            $(document).on('change','#all_projects',function(){               if($(this).is(':checked')){                   $("#projects_ids").attr('disabled','disabled');               }else{                   $("#projects_ids").removeAttr('disabled')               }            });            $(document).on('change','#country_id',function(){                country_id=$(this).val();                $.ajax({                    type: "POST",                    url: "{{ URL('timeZone') }}",                    data: {"country_id": country_id,_token:token},                    success: function (msg) {                        if(msg.success){                            $("#time_zone").html(msg.html)                        }                    }                });            });        });            </script>    @endsection