@extends('home.layouts.app')
@section('contentHeader')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('publisher') }}">Update Category</a></li>
    </ul>
@endsection
@section('content')


<body>
        <form action="{{ URL('updatecategory/'.$category->id) }}" method="POST" id="my-awesome-dropzone">
          {{ csrf_field() }}
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <input class="form-control" name="postcategry" value="{{$category->name}}" placeholder="Category Name" style="" ><br><br>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        </div>    
                 



                   



<div class="container">


<?php $abc=50; ?>
<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
<div class="divTableCell">Sunday</div>
<div class="divTableCell">Monday</div>
<div class="divTableCell">Tuesday</div>
<div class="divTableCell">Wednesday</div>
<div class="divTableCell">Thursday</div>
<div class="divTableCell">Friday</div>
<div class="divTableCell">Saturday</div>
</div>

<div class="divTableRow">

<div class="divTableCell"><div class="sun">



@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '2'],
])->get() as $sunday)   



<div class="sundayy">
<?php $abc++ ?>
<input name='sun[]' id='input-a{{$abc}}' class='input-a' value='{{$sunday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>

<script>
$( document ).ready(function() {

$("#input-a"+abc).mydatepicker(2);

});
</script>



@endforeach
<button type="button" class="sunbu btn btn-primary-outline">Add Time</button>



</div></div>





<div class="divTableCell"><div class="mond">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '3'],
])->get() as $monday)   


<?php $abc++ ?>

<div class="sunday">
<input name='mond[]' id='input-a{{$abc}}' class='input-a' value='{{$monday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
  <button type="button" class="mondbu btn btn-primary-outline">Add Time</button>


</div></div>




<div class="divTableCell"><div class="tues">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '4'],
])->get() as $tuesday)   



<?php $abc++ ?>

<div class="tuesday">
<input name='tues[]' id='input-a{{$abc}}' class='input-a' value='{{$tuesday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
 
<button type="button" class="tuesbu btn btn-primary-outline">Add Time</button>



</div></div>



<div class="divTableCell"><div class="wedn">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '5'],
])->get() as $wednesday)  

<?php $abc++ ?>

<div class="wednesday">
<input name='wedn[]' id='input-a{{$abc}}' class='input-a' value='{{$wednesday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
  <button type="button" class="wednbu btn btn-primary-outline">Add Time</button>




</div></div>


<div class="divTableCell"><div class="thurs">

@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '6'],
])->get() as $thursday)   




<?php $abc++ ?>

<div class="thursday">
<input name='thurs[]' id='input-a{{$abc}}' class='input-a' value='{{$thursday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
  <button type="button" class="thursbu btn btn-primary-outline">Add Time</button>

</div></div>



<div class="divTableCell"><div class="frid">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '7'],
])->get() as $friday)   


<?php $abc++ ?>

<div class="friday">
<input name='frid[]' id='input-a{{$abc}}' class='input-a' value='{{$friday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
  <button type="button" class="fridbu btn btn-primary-outline">Add Time</button>



</div></div>


<div class="divTableCell"><div class="satur">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '1'],
])->get() as $saturday)


<?php $abc++ ?>

<div class="saturday">
<input name='satu[]' id='input-a{{$abc}}' class='input-a' value='{{$saturday->time}}' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src={{ asset('img/cancel.png') }}>
</div>
@endforeach
  <button type="button" class="saturbu btn btn-primary-outline">Add Time</button>


</div></div>
</div>






</div>
</div>

</div>

<br><br>
<input type="submit" class="btn btn-info" value="Update Category">

</form>
<style>

/* DivTable.com */
.divTable{
  display: table;
  width: 100%;
  background: #FFF;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
 /* border: 1px solid #999999;*/
  display: table-cell;
  padding: 10px 10px;
  text-align: center;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
.with-side-panel .content-i{

      padding: 100px;

}

.sun,.mond,.tues,.wedn,.thurs,.frid,.satur {
    padding-top: 10px;
}
</style>


</body>
</html>








@endsection