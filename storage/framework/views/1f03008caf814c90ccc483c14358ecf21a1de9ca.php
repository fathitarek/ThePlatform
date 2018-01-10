
<?php $__env->startSection('pageTitle'); ?>
    <title><?php echo e(Lang::get('main.home_page_title')); ?></title>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <span><?php echo e(Lang::get('main.dashboard')); ?></span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> <?php echo e(Lang::get('main.dashboard')); ?>
    <small><?php echo e(Lang::get('main.dashboard')); ?></small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>