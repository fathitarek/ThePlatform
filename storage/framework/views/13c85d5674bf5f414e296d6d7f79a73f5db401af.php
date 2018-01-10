
<?php $__env->startSection('pageTitle'); ?>
    <title><?php echo e(Lang::get('main.home_page_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentHeader'); ?>
        <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="<?php echo e(URL('/admin')); ?>"><?php echo e(Lang::get('main.dashboard')); ?></a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span><?php echo e(Lang::get('main.profiles')); ?></span>
            </li>
        </ul>
        <!--<div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                <i class="icon-calendar"></i>&nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
        </div>-->
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> <?php echo e(Lang::get('main.profiles')); ?>
        <small><?php echo e(Lang::get('main.view')); ?></small>
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(PerUser('profiles_add')): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-right">
                <a href="<?php echo e(URL('admin/profiles/create')); ?>" id="sample_editable_1_new" class="btn green"> Add New
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(PerUser('profiles_view')): ?>
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-profiles font-dark"></i>
                    <span class="caption-subject bold uppercase"><?php echo e(Lang::get('main.profiles')); ?></span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                    <thead>
                    <tr>
                        <th class="all">#</th>
                        <th class="all"><?php echo e(Lang::get('main.name')); ?></th>
                        <th class="all"><?php echo e(Lang::get('main.active')); ?></th>
                        <th class="all"><?php echo e(Lang::get('main.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x=1;?>
                    <?php $__currentLoopData = $profiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $post=makeDefaultImage($post,'profiles')?>
                        <tr id="profiles-<?php echo e($post->id); ?>">
                            <td><?php echo e($x); ?></td>
                            <td><?php echo e($post->name); ?></td>
                            <td class="text-center">
                                <div class="checkbox-nice checkbox-inline">
                                    <input data-id="<?php echo e($post->id); ?>" type="checkbox" <?php if(!PerUser('profiles_active')): ?> disabled="disabled" <?php endif; ?> class="<?php if(PerUser('profiles_active')): ?> changeStatues <?php endif; ?>" <?php if($post->active==1): ?> checked="checked" <?php endif; ?> id="checkbox-<?php echo e($post->id); ?>">
                                    <label for="checkbox-<?php echo e($post->id); ?>">
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown"><?php echo e(Lang::get('main.action')); ?>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <?php if(PerUser('profiles_edit')): ?>
                                        <li>
                                            <a href="<?php echo e(URL('admin/profiles/'.$post->id.'/edit')); ?>">
                                                <i class="fa fa-pencil"></i> <?php echo e(Lang::get('main.edit')); ?> </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if(PerUser('profiles_delete')): ?>
                                        <li>
                                            <a href="javascript:;" class="delete_this" data-id="<?php echo e($post->id); ?>">
                                                <i class="fa fa-trash-o"></i> <?php echo e(Lang::get('main.delete')); ?> </a>
                                        </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php $x++;?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptCode'); ?>
    <?php if(PerUser('profiles_view')): ?>
    <script>
        $(document).ready(function(){
            token= '<?php echo e(csrf_token()); ?>';
            <?php if(PerUser('profiles_active')): ?>
            $(document).on('change','.changeStatues',function(){
                var statues=$(this).is(':checked');
                var id=$(this).attr('data-id');
                if(statues){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(URL('admin/profiles/activation')); ?>",
                        data: {"active": 1, "id": id,_token:token},
                        success: function (msg) {
                            $("#errors").html(msg);
                        }
                    });
                }else{
                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(URL('admin/profiles/activation')); ?>",
                        data: {"active": 0, "id": id,_token:token},
                        success: function (msg) {
                            $("#errors").html(msg);
                        }
                    });
                }
            });
            <?php endif; ?>
            <?php if(PerUser('profiles_delete')): ?>
            $(document).on('click','.delete_this',function(event){
                deleted_id=$(this).attr("data-id");
                event.preventDefault();
                BootstrapDialog.show({
                    title: '<?php echo e(Lang::get('main.delete').lang::get('main.profiles')); ?>',
                    message: '<?php echo e(Lang::get('main.delete_this').lang::get('main.profiles')); ?> ?',
                    buttons: [
                        {
                            label: '<?php echo e(Lang::get('main.yes')); ?>',
                            cssClass: 'btn-primary',
                            action: function(dialogItself){
                                $.ajax({
                                    type: "DELETE",
                                    url: "<?php echo e(URL('admin/profiles')); ?>/"+deleted_id,
                                    data: {"id":deleted_id,_token:token},
                                    success: function (msg) {
                                        $("#errors").html(msg);
                                        $("#profiles-"+deleted_id).remove();
                                        dialogItself.close();
                                    }
                                });
                            }
                        },
                        {
                            label: '<?php echo e(Lang::get('main.no')); ?>',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                });

            });
            <?php endif; ?>
       });
    </script>
    <?php endif; ?>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>