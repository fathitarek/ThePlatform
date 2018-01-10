@extends('home.layouts.app')    @section('pageTitle')        <title>{{ Lang::get('home.home_page_title') }}</title>        <link rel="stylesheet" href="{{ asset('js/jquery.qtip.min.css') }}">    @endsection@section('contentHeader')    <ul class="breadcrumb">        <li class="breadcrumb-item"><a href="{{ URL('privacy') }}">{{ Lang::get('home.privacy') }}</a></li>    </ul>    @endsection    @section('content')    <!-- BEGIN DASHBOARD STATS 1-->    <div class="content-box">        <div class="element-wrapper">            <div class="element-box">                <div id="fullCalendarPosts">                </div>                <div class="clearfix"></div>            </div>        </div>    </div>@endsection@section('scriptCode')    <script src="{{ asset('js/jquery.qtip.min.js') }}"></script>    <script>        date = new Date();        d = date.getDate();        m = date.getMonth();        y = date.getFullYear();        calendar = $("#fullCalendarPosts").fullCalendar({            header: {                left: "prev,next today",                center: "title",                right: "month,agendaWeek,agendaDay"            },            selectable: false,            selectHelper: false,            select: function select(start, end, allDay) {                var title;                title = prompt("Event Title:");                if (title) {                    calendar.fullCalendar("renderEvent", {                        title: title,                        start: start,                        end: end,                        allDay: allDay                    }, true);                }                return calendar.fullCalendar("unselect");            },            editable: false,            events: [                @foreach($posts as $post)                    {                        title: "{{ $post->page_name }}",                        description: "{{ str_limit(trim(preg_replace( "/\r|\n/","",preg_replace('/\s\s+/', ' ',$post->message))),100) }}",                        start: "{{ date('Y-m-d H:i:s',strtotime($post->created_time)) }}",                        end: "{{ date('Y-m-d H:i:s',strtotime($post->created_time)) }}"                    },               @endforeach            ],            eventRender: function(event, element) {                element.qtip({                    content: event.description                });            }        });    </script>@endsection