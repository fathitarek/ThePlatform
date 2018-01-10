@extends('auth.layouts.app')
@section('pageTitle')
    <title>{{ Lang::get('main.home_page_title') }}</title>
@endsection
@section('contentHeader')
        <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ URL('/admin') }}">{{ Lang::get('main.dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ Lang::get('main.settings') }}</span>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ Lang::get('main.system') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> {{ Lang::get('main.system') }}
        <small>{{ Lang::get('main.add') }}</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
@endsection
@section('content')
    <style>
        ul li{
            list-style: none;
        }
        ul li ol{
            margin-top: 10px;
        }
    </style>

    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">{{ Lang::get('main.system') }}</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                {!! Form::open(['method'=>'POST','url'=>'admin/system','id'=>'addsystemForm','class'=>"form-horizontal"]) !!}
                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        {{ Lang::get('main.form_validation_error') }}
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button>
                        {{ Lang::get('main.form_validation_success') }}
                    </div>
                    <div class="form-group col-lg-12 text-center" style="padding-bottom:15px; ">
                        <label >{{ Lang::get('main.backend_color') }}&nbsp;&nbsp;&nbsp;    </label>
                        <div class="btn-group " data-toggle="buttons">
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/default.min.css') }}" id="" data-original-title="Default"  style="background: #333438;width:30px;height: 30px;@if($system->backend_color=='default')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='default') checked="checked" @endif  value="default" id="option1">
                            </label>
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/darkblue.min.css') }}" id="theme-white" data-original-title="darkblue"   style="background: #2b3643;width:30px;height: 30px;@if($system->backend_color=='darkblue')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='darkblue') checked="checked" @endif value="darkblue" id="option2">
                            </label>
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/blue.min.css') }}" id="theme-blue-gradient" data-original-title="blue" style="background: #2d5f8b;width:30px;height: 30px;@if($system->backend_color=='blue')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='blue') checked="checked" @endif value="blue" id="option2">
                            </label>
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/grey.min.css') }}"  id="theme-turquoise" data-original-title="grey" style="background: #697380;width:30px;height: 30px;@if($system->backend_color=='grey')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='grey') checked="checked" @endif value="grey" id="option2">
                            </label>
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/light.min.css') }}" id="theme-amethyst" data-original-title="light" style="background: #f9fafd;width:30px;height: 30px;@if($system->backend_color=='light')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='light') checked="checked" @endif value="light" id="option2">
                            </label>
                            <label class="btn btn-primary colors tooltips " data-toggle="tooltip" data-url="{{ asset('assets/layouts/layout/css/themes/light2.min.css') }}" id="theme-blue" data-original-title="light2" style="background: #f1f1f1;width:30px;height: 30px;@if($system->backend_color=='light2')border: 2px solid rgb(255, 0, 0);@endif">
                                <input type="radio" name="backend_color" @if($system->backend_color=='light2') checked="checked" @endif value="light2" id="option2">
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_lang">{{ Lang::get('main.backend_lang') }}</label>
                        <select id="backend_lang" class="form-control select2me" name="backend_lang">
                           {{-- <option @if($system->backend_lang=='ar') selected="selected" @endif value="ar">{{ Lang::get('main.ar') }}</option>--}}
                            <option @if($system->backend_lang=='en') selected="selected" @endif value="en">{{ Lang::get('main.en') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_layout">{{ Lang::get('main.backend_layout') }}</label>
                        <select id="backend_layout" class="form-control select2me" name="backend_layout">
                            <option @if($system->backend_layout=='fluid') selected="selected" @endif value="fluid">{{ Lang::get('main.fluid') }}</option>
                            <option @if($system->backend_layout=='boxed') selected="selected" @endif value="boxed">{{ Lang::get('main.boxed') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_header">{{ Lang::get('main.backend_header') }}</label>
                        <select id="backend_header" class="form-control select2me" name="backend_header">
                            <option @if($system->backend_header=='default') selected="selected" @endif value="default">{{ Lang::get('main.default') }}</option>
                            <option @if($system->backend_header=='fixed') selected="selected" @endif value="fixed">{{ Lang::get('main.fixed') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_top_menu_dropdown">{{ Lang::get('main.backend_top_menu_dropdown') }}</label>
                        <select id="backend_top_menu_dropdown" class="form-control select2me" name="backend_top_menu_dropdown">
                            <option @if($system->backend_top_menu_dropdown=='light') selected="selected" @endif value="light">{{ Lang::get('main.light') }}</option>
                            <option @if($system->backend_top_menu_dropdown=='dark') selected="selected" @endif value="dark">{{ Lang::get('main.dark') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="backend_sidebar_menu_mode">{{ Lang::get('main.backend_sidebar_menu_mode') }}</label>
                        <select id="backend_sidebar_menu_mode" class="form-control select2me" name="backend_sidebar_menu_mode">
                            <option @if($system->backend_sidebar_menu_mode=='default') selected="selected" @endif value="default">{{ Lang::get('main.default') }}</option>
                            <option @if($system->backend_sidebar_menu_mode=='fixed') selected="selected" @endif value="fixed">{{ Lang::get('main.fixed') }}</option>

                        </select>
                    </div>
                    {{--<div class="form-group col-lg-12">
                        <label for="backend_sidebar_menu_sub_show">{{ Lang::get('main.backend_sidebar_menu_sub_show') }}</label>
                        <select id="backend_sidebar_menu_sub_show" class="form-control select2me" name="backend_sidebar_menu_sub_show">
                            <option @if($system->backend_sidebar_menu_sub_show=='accordion') selected="selected" @endif value="accordion">{{ Lang::get('main.accordion') }}</option>
                            <option @if($system->backend_sidebar_menu_sub_show=='hover') selected="selected" @endif value="hover">{{ Lang::get('main.hover') }}</option>
                        </select>
                    </div>--}}
                    <div class="form-group col-lg-12">
                        <label for="backend_sidebar_menu_style">{{ Lang::get('main.backend_sidebar_menu_style') }}</label>
                        <select id="backend_sidebar_menu_style" class="form-control select2me" name="backend_sidebar_menu_style">
                            <option @if($system->backend_sidebar_menu_style=='default') selected="selected" @endif value="default">{{ Lang::get('main.default') }}</option>
                            <option @if($system->backend_sidebar_menu_style=='light') selected="selected" @endif value="light">{{ Lang::get('main.light') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_sidebar_menu_position">{{ Lang::get('main.backend_sidebar_menu_position') }}</label>
                        <select id="backend_sidebar_menu_position" class="form-control select2me" name="backend_sidebar_menu_position">
                            <option @if($system->backend_sidebar_menu_position=='left') selected="selected" @endif value="left">{{ Lang::get('main.left') }}</option>
                            <option @if($system->backend_sidebar_menu_position=='right') selected="selected" @endif value="right">{{ Lang::get('main.right') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="backend_footer">{{ Lang::get('main.backend_footer') }}</label>
                        <select id="backend_footer" class="form-control select2me" name="backend_footer">
                            <option @if($system->backend_footer=='default') selected="selected" @endif value="default">{{ Lang::get('main.default') }}</option>
                            <option @if($system->backend_footer=='fixed') selected="selected" @endif value="fixed">{{ Lang::get('main.fixed') }}</option>
                        </select>
                    </div>
                    <div class="clearfix" style="height: 30px"></div>
                    <div class="text-center">
                        <button type="submit" class="btn green">{{ Lang::get('main.save') }}</button>
                    </div>
                </div>

                <div class="clearfix" style="height: 30px"></div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scriptCode')
    <script>
        $(document).ready(function(){
            $(document).on('click',".colors",function(){
                styleURl=$(this).data('url');
                $('.colors').css({'border':'0px','border-color':'none'});
                $(this).css({ 'border':'2px solid','border-color':'#ff0000' });
                $("#style_color").attr('href',styleURl);
            });

            $("#backend_layout").change(function(){
                val=$(this).val();
                footerOption=$("#backend_footer").val();
                if (val === "boxed") {
                    $("body").addClass("page-boxed");
                    // set header
                    $('.page-header > .page-header-inner').addClass("container");
                    var cont = $('body > .clearfix').after('<div class="container"></div>');
                    // set content
                    $('.page-container').appendTo('body > .container');
                    // set footer
                    if (footerOption === 'fixed') {
                        $('.page-footer').html('<div class="container">' + $('.page-footer').html() + '</div>');
                    } else {
                        $('.page-footer').appendTo('body > .container');
                    }
                }else{
                    $("body").removeClass("page-boxed");
                    $('.page-header > .page-header-inner').removeClass("container");
                    var cont = $('body > .clearfix').after('<div class="container"></div>');
                    // set content
                    $('body > .container .page-container').remove;
                    // set footer
                    if (footerOption === 'fixed') {
                        $('.page-footer').html('<div class="container">' + $('.page-footer').html() + '</div>');
                    } else {
                        $('.page-footer').appendTo('body > .container');
                    }
                }
            });
            $("#backend_header").change(function(){
                headerOption=$(this).val();
                if (headerOption === 'fixed') {
                    $("body").addClass("page-header-fixed");
                    $(".page-header").removeClass("navbar-static-top").addClass("navbar-fixed-top");
                } else {
                    $("body").removeClass("page-header-fixed");
                    $(".page-header").removeClass("navbar-fixed-top").addClass("navbar-static-top");
                }
            });
            $("#backend_top_menu_dropdown").change(function(){
                headerTopDropdownStyle=$(this).val();
                if (headerTopDropdownStyle === 'dark') {
                    $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
                } else {
                    $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
                }
            });



            $("#backend_sidebar_menu_mode").change(function(){
                sidebarOption=$(this).val();
                headerOption=$('#backend_header').val();
                if (sidebarOption == "fixed" && headerOption == "default") {
                    alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                    $('#backend_header').val("fixed");
                    $('#backend_sidebar_menu_mode').val("fixed");
                    sidebarOption = 'fixed';
                    headerOption = 'fixed';
                }
            });
            /*$("#backend_sidebar_menu_sub_show").change(function(){
                sidebarMenuOption=$(this).val();
                sidebarOption=$("#backend_sidebar_menu_mode").val();
                if (sidebarMenuOption === 'hover') {
                    if (sidebarOption == 'fixed') {
                        alert("Hover Sidebar Menu is not compatible with Fixed Sidebar Mode. Select Default Sidebar Mode Instead.");
                    } else {
                        $(".page-sidebar-menu").addClass("page-sidebar-menu-hover-submenu");
                    }
                } else {
                    $(".page-sidebar-menu").removeClass("page-sidebar-menu-hover-submenu");
                }
            });*/

             /*$("#backend_sidebar_menu_sub_show").change(function(){
             $(".top-menu > .navbar-nav > li.dropdown").toggleClass("dropdown-dark");
             });*/
            $("#backend_sidebar_menu_style").change(function(){
                $(".page-sidebar-menu").toggleClass("page-sidebar-menu-light");
            });
            $("#backend_sidebar_menu_position").change(function(){
                $("body").toggleClass('page-sidebar-reversed');
            });
            $("#backend_footer").change(function(){
                $("body").toggleClass('page-footer-fixed');
            });




        });
    </script>
@endsection