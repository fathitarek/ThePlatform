@extends('home.layouts.app')
@section('content')
           <div class="panel-body">
                                           
        <form action="{{ URL('addcategry') }}" method="POST" id="my-awesome-dropzone">


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <input class="form-control" name="postcategry" placeholder="Category Name" style="" >
       </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        </div>    
                 


<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Sunday</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><button type="button" class="sund btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="mond btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="tues btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="wedn btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="thurs btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="frid btn btn-primary-outline">Add Time</button></td>
        <td><button type="button" class="satu btn btn-primary-outline">Add Time</button></td>

      </tr>
    </tbody>
  </table>
</div>





</form>

                </div>
                   

                 











<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
 <script type="text/javascript" src="wickedpicker.js"></script>




@endsection