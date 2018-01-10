@extends('home.layouts.app')
@section('contentHeader')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL('publisher') }}">Create Category</a></li>
    </ul>
@endsection


@section('content')
<body>
        <form action="{{ URL('addcategry') }}" method="POST" id="my-awesome-dropzone">
          {{ csrf_field() }}
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <input class="form-control" name="postcategry" placeholder="Category Name" style="" ><br><br>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        </div>    
                 



                   



<div class="container">

<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">


<div class="divTableCell">Sunday<div class="sun"><button type="button" class="sunbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Monday<div class="mond"><button type="button" class="mondbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Tuesday<div class="tues"><button type="button" class="tuesbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Wednesday<div class="wedn"><button type="button" class="wednbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Thursday<div class="thurs"><button type="button" class="thursbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Friday<div class="frid"><button type="button" class="fridbu btn btn-primary-outline">Add Time</button></div></div>
<div class="divTableCell">Saturday<div class="satur"><button type="button" class="saturbu btn btn-primary-outline">Add Time</button></div></div>
</div>
</div>
</div>

</div>

<br><br>
<input type="submit" class="btn btn-info" value="Add Category">

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
  padding: 3px 10px;
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