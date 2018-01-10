<?php $__env->startSection('contentHeader'); ?>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(URL('publisher')); ?>">Categories</a></li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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




<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="divTableRow">
<div class="divTableCell"><div class="sun"><?php echo e($category->name); ?></div></div>





<div class="divTableCell">
<?php if(count(\App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '2'],
])->get())): ?>    


<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '2'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sunday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($sunday->time); ?>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</div>


<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '3'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $monday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($monday->time); ?>

</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '4'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tuesday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($tuesday->time); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '5'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wednesday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($wednesday->time); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '6'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thursday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($thursday->time); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>





<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '7'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($friday->time); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


<div class="divTableCell">
<?php $__currentLoopData = \App\CategoryPlans::where([
    ['category_id', '=', $category->id],
    ['doweek', '=', '1'],
])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saturday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   

<div class="sun">
<?php echo e($saturday->time); ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>




<div class="divTableCell">
<a href="	<?php echo e(URL('editcategory/'.$category->id)); ?>" class="btn btn-info">
<i class="fa fa-edit"></i>
</a>
<a href="<?php echo e(URL('deletecategory/'.$category->id)); ?>" class="btn btn-danger">
<i class="fa fa-trash-o"></i>
</a> 
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>


<br>
<a  href="<?php echo e(URL('addcategory')); ?>" class="btn btn-info">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>