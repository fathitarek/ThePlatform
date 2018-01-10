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
                <a href="{{ URL('/admin/profiles') }}">{{ Lang::get('main.profiles') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{ Lang::get('main.add') }}</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> {{ Lang::get('main.profiles') }}
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
                    <i class="icon-profiles font-dark"></i>
                    <span class="caption-subject bold uppercase">{{ Lang::get('main.profiles') }}</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                {!! Form::open(['method'=>'POST','url'=>'admin/profiles','id'=>'addProfilesForm','class'=>"form-horizontal"]) !!}
                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        {{ Lang::get('main.form_validation_error') }}
                    </div>
                    <div class="alert alert-success display-hide">
                        <button class="close" data-close="alert"></button>
                        {{ Lang::get('main.form_validation_success') }}
                    </div>
                    <div class="form-group col-lg-9">
                        <label class="control-label" for="name">{{ Lang::get('main.name') }}  <span class="required"> * </span></label>
                        <div class="input-icon right">
                            <i class="fa"></i>
                            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" data-required="1" placeholder="{{ Lang::get('main.enter').Lang::get('main.name') }}">
                        </div>

                    </div>
                    <div class="form-group col-lg-3 text-center" style="margin-top:25px;">
                        <input type="checkbox" class="make-switch" name="active" value="1" checked data-size="small" data-on-color="success" data-on-text="active" data-off-color="default" data-off-text="unActive">
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <ul class="col-lg-3 permissions">
                            <?php
                            $count= count ($GLOBALS['sup_permissions']);
                            foreach($GLOBALS['sup_permissions'] as $sup=>$val){
                                $count+=count($val);
                            }
                            $x=1;
                            $count_col=1;
                            $counter_col=0;
                            foreach($GLOBALS['permissions_settings'] as $pr){
                                if($count_col==$count+1){echo'</ul>';$count_col=1;}
                                if(isset($sup)&&in_array($pr,$GLOBALS['sup_permissions'] [$sup])){
                                    echo'
                                        <ol>
                                            <div class="md-checkbox">
                                                <input name="permissions[]" '.((old('permissions')&&in_array($pr,old('permissions')))?'checked="checked"':'').' type="checkbox" id="checkbox-'.$x.'" value="'.$pr.'" class="md-check">
                                                <label for="checkbox-'.$x.'">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> '.Lang::get('main.'.$pr).' </label>
                                            </div>
                                        </ol>
                                   ';
                                }else{
                                    $counter_col++;
                                    echo'</li>';
                                    if(isset($sup)&&$counter_col==2){echo'</ul><ul class="col-lg-3 permissions">';$counter_col=1;}
                                    unset($sup);
                                    echo'
                                <li>
                                    <div class="md-checkbox has-success">
                                        <input name="permissions[]" '.((old('permissions')&&in_array($pr,old('permissions')))?'checked="checked"':'').' type="checkbox" id="checkbox-'.$x.'" value="'.$pr.'" class="md-check">
                                        <label for="checkbox-'.$x.'">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> '.Lang::get('main.'.$pr).' </label>
                                    </div>

                                    ';
                                }
                                if(isset($GLOBALS['sup_permissions'][$pr])){$sup=$pr;}
                                $x++;
                                $count_col++;

                            }
                            ?>
                        </ul>

                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix" style="height: 30px"></div>
                    <div class="text-center">
                        <button type="submit" class="btn green">{{ Lang::get('main.add') }}</button>
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
            <?php
                foreach($GLOBALS['sup_permissions'] as $key=>$val){
                    echo'
                        $("input[value=\''.$key.'\']").click(function(){
                            if($("input[value=\''.$key.'\']").is(\':checked\')){
                            ';
                                foreach($val as $ex_val){
                                    echo'$("input[value=\''.$ex_val.'\']").prop(\'checked\', true);';
                                }
                            echo'
                            }else{
                            ';
                                foreach($val as $ex_val){
                                    echo'$("input[value=\''.$ex_val.'\']").prop(\'checked\', false);';
                                }
                            echo'
                            }
                        });
                    ';
                }
            ?>
                    });
    </script>
    @endsection