@extends('home.layouts.app')
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
        <div>

            <div _ngcontent-c25="" class="step choose-type">


<table class="table">
    
  <thead>
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Message</th>
      <th scope="col">Media</th>
      <th scope="col">Network</th>
       <th scope="col">Channel</th>
      <th scope="col">Created At</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>   
       @if(count($scheduled_posts))
        @foreach ($scheduled_posts as $record)
    <tr>
      
           <td><?php echo date('Y-m-d H:i:s', strtotime($record->created_time));?></td>
      <td>{{$record->message}}</td>
      <td><div>{!!$record->picture ? '<img src="'.$record->picture.'" height="40"/>':''!!}</div></td>
       <td><i class="fa fa-facebook" aria-hidden="true"></i></td>
      <td>{{$record->appUser['name']}}</td>
      <td>{{$record->created_at}}</td>
      <td><a href='scheduledPostsDelete/{{$record->id}}' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-trash"></i></a></td>
    </tr>
     @endforeach
        @endif
  </tbody>
</table>
               {{$scheduled_posts->links()}}  
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#select_category').click(function () {
            if ($('#select_category').is(':checked')) {
                $(".date_time").css("display", "none");
                $("#category_id").css("display", "block");
            }
        });


        $('#select_date_time').click(function () {
            if ($('#select_date_time').is(':checked')) {
                $(".date_time").css("display", "block");
                $("#category_id").css("display", "none");
            }
        });

    });

</script>
</body>
</html>
@endsection