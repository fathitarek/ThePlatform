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
                <span>{{ Lang::get('main.users') }}</span>
            </li>
        </ul>
        <!--<div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>-->
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> {{ Lang::get('main.users') }}
        <small>{{ Lang::get('main.view') }}</small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    @endsection
@section('content')

    @if(PerUser('users_add'))
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <a href="{{ URL('admin/users/create') }}" id="sample_editable_1_new" class="btn green"> Add New
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
    @if(PerUser('users_view'))
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-users font-dark"></i>
                    <span class="caption-subject bold uppercase">{{ Lang::get('main.users') }}</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                    <thead>
                    <tr>
                        <th class="all">#</th>
                        <th class="all">{{ Lang::get('main.name') }}</th>
                        <th class="all">{{ Lang::get('main.image') }}</th>
                        <th class="none">{{ Lang::get('main.username') }}</th>
                        <th class="none">{{ Lang::get('main.email') }}</th>
                        <th class="all">{{ Lang::get('main.active') }}</th>
                        <th class="all">{{ Lang::get('main.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x=1;?>
                    @foreach($users as $post)
                        <?php $post=makeDefaultImage($post,'Users')?>
                        <tr id="users-{{ $post->id }}">
                            <td>{{ $x }}</td>
                            <td>{{ $post->name }}</td>
                            <td class="text-center"><img src="{{ asset($post->img_dir.$post->img) }}" alt=""></td>
                            <td>{{ $post->username }}</td>
                            <td>{{ $post->email }}</td>
                            <td class="text-center">
                                <div class="checkbox-nice checkbox-inline">
                                    <input data-id="{{ $post->id }}" type="checkbox" @if(!PerUser('users_active')) disabled="disabled" @endif class="@if(PerUser('users_active')) changeStatues @endif" @if($post->active==1) checked="checked" @endif id="checkbox-{{ $post->id }}">
                                    <label for="checkbox-{{ $post->id }}">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">{{ Lang::get('main.action') }}
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        @if(PerUser('users_edit'))
                                        <li>
                                            <a href="{{ URL('admin/users/'.$post->id.'/edit') }}">
                                                <i class="fa fa-pencil"></i> {{ Lang::get('main.edit') }} </a>
                                        </li>
                                        @endif
                                        @if(PerUser('users_delete'))
                                        <li>
                                            <a href="javascript:;" class="delete_this" data-id="{{ $post->id }}">
                                                <i class="fa fa-trash-o"></i> {{ Lang::get('main.delete') }} </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $x++;?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('scriptCode')
    @if(PerUser('users_view'))
    <script>
        $(document).ready(function(){
            token= '{{ csrf_token() }}';
            @if(PerUser('users_active'))
            $(document).on('change','.changeStatues',function(){
                var statues=$(this).is(':checked');
                var id=$(this).attr('data-id');
                if(statues){
                    $.ajax({
                        type: "POST",
                        url: "{{ URL('admin/users/activation') }}",
                        data: {"active": 1, "id": id,_token:token},
                        success: function (msg) {
                            $("#errors").html(msg);
                        }
                    });
                }else{
                    $.ajax({
                        type: "POST",
                        url: "{{ URL('admin/users/activation') }}",
                        data: {"active": 0, "id": id,_token:token},
                        success: function (msg) {
                            $("#errors").html(msg);
                        }
                    });
                }
            });
            @endif
            @if(PerUser('users_delete'))
            $(document).on('click','.delete_this',function(event){
                deleted_id=$(this).attr("data-id");
                event.preventDefault();
                BootstrapDialog.show({
                    title: '{{ Lang::get('main.delete').lang::get('main.users') }}',
                    message: '{{ Lang::get('main.delete_this').lang::get('main.users') }} ?',
                    buttons: [
                        {
                            label: '{{ Lang::get('main.yes') }}',
                            cssClass: 'btn-primary',
                            action: function(dialogItself){
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ URL('admin/users') }}/"+deleted_id,
                                    data: {"id":deleted_id,_token:token},
                                    success: function (msg) {
                                        $("#errors").html(msg);
                                        $("#users-"+deleted_id).remove();
                                        dialogItself.close();
                                    }
                                });
                            }
                        },
                        {
                            label: '{{ Lang::get('main.no') }}',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                });
            });
            @endif
        });
    </script>
    @endif
    @endsection