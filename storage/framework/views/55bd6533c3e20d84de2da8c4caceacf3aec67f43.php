<?php $__env->startSection('contentHeader'); ?>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(URL('publisher')); ?>">Update Category</a></li>
    </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<body>
        <form action="<?php echo e(URL('updatecategory/'.$category->id)); ?>" method="POST" id="my-awesome-dropzone">
          <?php echo e(csrf_field()); ?>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <input class="form-control" name="postcategry" value="<?php echo e($category->name); ?>" placeholder="Category Name" style="" ><br><br>
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
<?php if($category->sunday): ?>

<?php $featuresp = explode('|', $category->sunday); 

?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="sundayy">
<?php $abc++ ?>
<input name='sun[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>

<script>
$( document ).ready(function() {

$("#input-a"+abc).mydatepicker(2);

});
</script>



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<button type="button" class="sunbu btn btn-primary-outline">Add Time</button>


<?php else: ?>
<button type="button" class="sunbu btn btn-primary-outline">Add Time</button>
<?php endif; ?>
</div></div>





<div class="divTableCell"><div class="mond">
<?php if($category->monday): ?>
<?php $featuresp = explode('|', $category->monday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $abc++ ?>

<div class="sunday">
<input name='mond[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <button type="button" class="mondbu btn btn-primary-outline">Add Time</button>

<?php else: ?>
  <button type="button" class="mondbu btn btn-primary-outline">Add Time</button>
<?php endif; ?>
</div></div>




<div class="divTableCell"><div class="tues">
<?php if($category->tuesday): ?>

<?php $featuresp = explode('|', $category->tuesday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $abc++ ?>

<div class="tuesday">
<input name='tues[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
<button type="button" class="tuesbu btn btn-primary-outline">Add Time</button>





<?php else: ?>
<button type="button" class="tuesbu btn btn-primary-outline">Add Time</button>
<?php endif; ?>
</div></div>



<div class="divTableCell"><div class="wedn">
<?php if($category->wednesday): ?>
<?php $featuresp = explode('|', $category->wednesday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $abc++ ?>

<div class="wednesday">
<input name='wedn[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <button type="button" class="wednbu btn btn-primary-outline">Add Time</button>




<?php else: ?>
  <button type="button" class="wednbu btn btn-primary-outline">Add Time</button>
  <?php endif; ?>
</div></div>


<div class="divTableCell"><div class="thurs">

<?php if($category->thursday): ?>
<?php $featuresp = explode('|', $category->thursday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $abc++ ?>

<div class="thursday">
<input name='thurs[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <button type="button" class="thursbu btn btn-primary-outline">Add Time</button>

<?php else: ?>
  <button type="button" class="thursbu btn btn-primary-outline">Add Time</button>
  <?php endif; ?>
</div></div>



<div class="divTableCell"><div class="frid">
<?php if($category->friday): ?>
<?php $featuresp = explode('|', $category->thursday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $abc++ ?>

<div class="friday">
<input name='frid[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <button type="button" class="fridbu btn btn-primary-outline">Add Time</button>




<?php else: ?>
  <button type="button" class="fridbu btn btn-primary-outline">Add Time</button>
  <?php endif; ?>
</div></div>


<div class="divTableCell"><div class="satur">
<?php if($category->saturday): ?>
<?php $featuresp = explode('|', $category->saturday); ?>
<?php $__currentLoopData = $featuresp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $abc++ ?>

<div class="saturday">
<input name='satu[]' id='input-a<?php echo e($abc); ?>' class='input-a' value='<?php echo e($feature); ?>' data-default='20:48'>
<img style="width:15px; height:15px;" class="deleteinp" src=<?php echo e(asset('img/cancel.png')); ?>>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <button type="button" class="saturbu btn btn-primary-outline">Add Time</button>
<?php else: ?>
  <button type="button" class="saturbu btn btn-primary-outline">Add Time</button>
<?php endif; ?>

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








<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>