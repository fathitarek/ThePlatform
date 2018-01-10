@extends('home.layouts.app')
@section('contentHeader')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('publisher') }}">Categories</a></li>
    </ul>
@endsection

@section('content')

<div class="container">





















<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
<div class="divTableCell">Name Category</div>
<div class="divTableCell">Sunday</div>
<div class="divTableCell">Monday</div>
<div class="divTableCell">Tuesday</div>
<div class="divTableCell">Wednesday</div>
<div class="divTableCell">Thursday</div>
<div class="divTableCell">Friday</div>
<div class="divTableCell">Saturday</div>
<div class="divTableCell">Control</div>
</div>




@foreach($categories as $category)
<div class="divTableRow">
<div class="divTableCell"><div class="sun">{{ $category->name }}</div></div>





<div class="divTableCell">
@if(count(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '2'],
])->get()))    


@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '2'],
])->get() as $sunday)   

<div class="sun">
{{$sunday->time}}
</div>

@endforeach
@endif

</div>


<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '3'],
])->get() as $monday)   

<div class="sun">
{{$monday->time}}
</div>

@endforeach
</div>



<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '4'],
])->get() as $tuesday)   

<div class="sun">
{{$tuesday->time}}
</div>
@endforeach
</div>



<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '5'],
])->get() as $wednesday)   

<div class="sun">
{{$wednesday->time}}
</div>
@endforeach
</div>



<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '6'],
])->get() as $thursday)   

<div class="sun">
{{$thursday->time}}
</div>
@endforeach
</div>





<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '7'],
])->get() as $friday)   

<div class="sun">
{{$friday->time}}
</div>
@endforeach
</div>


<div class="divTableCell">
@foreach(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '1'],
])->get() as $saturday)   

<div class="sun">
{{$saturday->time}}
</div>
@endforeach
</div>




<div class="divTableCell">
<a href="	{{ URL('editcategory/'.$category->id) }}" class="btn btn-info">
<i class="fa fa-edit"></i>
</a>
<a href="{{ URL('deletecategory/'.$category->id) }}" class="btn btn-danger">
<i class="fa fa-trash-o"></i>
</a> 
</div>
</div>
@endforeach
</div>
</div>
</div>


<br>
<a  href="{{ URL('addcategory') }}" class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </a>


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
    border-bottom: 1px solid #eaeaea;
    display: table-cell;
    padding: 20px 10px;
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
@endsection