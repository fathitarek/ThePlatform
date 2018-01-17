@extends('home.layouts.app')
<!--<link rel="stylesheet" type="text/css" media="screen"-->
     href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
  
{{--section left side bar --}}
@section('content')

<link href="{{ asset('css/styleUploadFileFacebook.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleuploadcsv_statusbrew.css') }}" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><style> 
    .fa{color: blue;}

    td, th { padding:10px;}
    .date_time{display: none; border: 1;}
    #category_id{display: none;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('/js/facebookJavaScript.js')}}"></script>

<body>

    <div class="container">

        @if (isset($_GET['submit'])&& $_GET['submit']==1)

        <div class="alert alert-success">Post Send Now successfully</div>
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
        <div>

            <div _ngcontent-c25="" class="step choose-type">
                <div class="container">
                {!!Form::model($data,['method' =>'PATCH', 'action'=>['statusController@updateScheduledPosts',$data->id],'files' => true])!!}
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group"><label>choose profile</label>
                            <select required name="app_user_id">
                                <option value=""> Choose Account</option>
                                <option selected value="{{Auth::guard('AppUsers')->user()->id}}">{{Auth::guard('AppUsers')->user()->name}}</option>
                            </select>
                        </div></div></div>
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea rows="4" cols="50" name="message"> {{$data->message}}</textarea>
                        </div></div></div>
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <input type="radio" id="select_date_time" name="date_time" value="1"> Date-time based CSV file<br>
                        </div></div></div>
                <div class="row">
                    <div class='col-sm-6' id="choose_time" style="display: none;">
                        <div class="form-group">
                            <input id="datetime" value="{{$data->created_time}}" type="datetime-local" name="created_time">

<!--                            <input id="date" type="datetime" name="created_time">
                            <div class="well">
  <div id="datetimepicker1" class="input-append date">
      <input data-format="dd/MM/yyyy hh:mm:ss" type="text"  date-time="" name="created_time"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>-->
</div>
                            <!--<input type="hidden" name="created_time" id="created_time">-->
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <input type="radio" id="select_category" name="date_time" value="0" style="border-color: #448aff;"> Pre select Category<br>
                            </div></div></div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                {{ Form::select('category_id',$records,null,['placeholder' => 'Choose Category','class'=> '','id'=>'category_id']) }}
                                <input type="file" name="picture" id="csv_file" class="" accept=".image/*" >
                                {!!$data->picture ? '<div><img src="'.$data->picture.'" height="40"/></div>':''!!}
                            </div></div></div>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <button type="submit"  id="update_post" class="btn btn-primary">Upload</button>
                            </div></div></div>
                    {!!Form::close()!!}
                </div>

            </div>
                </div>
        </div>

        <script>
$(document).ready(function () {
    $('#select_category').click(function () {
        if ($('#select_category').is(':checked')) {
            $(".date_time").css("display", "none");
            $("#choose_time").css("display", "none");
            $("#category_id").css("display", "block");
        }
    });


    $('#select_date_time').click(function () {
        if ($('#select_date_time').is(':checked')) {
            $(".date_time").css("display", "block");
            $("#category_id").css("display", "none");
            $("#choose_time").css("display", "block");
        }
    });
    
$('#datetimepicker1').html();
});

//$('#update_post')click(function() {
//    alert($('#datetimepicker1').innerHTML);
//});

        </script>
        <script type="text/javascript">
  $(function() {
         $('#datetimepicker1').datetimepicker({
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
                            
                            $('#created_time').val($('#datetimepicker1').innerHTML);
                        },
                        dayOfWeekStart : 1,
                        lang:'en',
                        disabledDates:[],//['1986/01/08','1986/01/09','1986/01/10'],
                        startDate:  new Date()//'1986/01/08'
                    });
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
  });
</script>
</body>
</html>
@endsection