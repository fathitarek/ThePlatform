<?php $__env->startSection('headScript'); ?>
    <style type="text/css" media="screen">
    .table{
background: #fff;

    }    
    </style>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '1535009383226574',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.10'
            });
            init();
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageTitle'); ?>
    <title><?php echo e(Lang::get('home.home_page_title')); ?></title>

    <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentHeader'); ?>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(URL('publisher')); ?>"><?php echo e(Lang::get('home.publisher')); ?></a></li>
    </ul>
<?php $__env->stopSection(); ?>
        <?php $__env->startSection('leftSideMenu'); ?>
            <div class="desktop-menu menu-side-compact-w menu-activated-on-hover color-scheme-dark">
                <div class="logo-w">
                    <a class="logo" href="<?php echo e(URL('')); ?>">
                        <img src="<?php echo e(asset('img/logo.png')); ?>">
                    </a>
                </div>
            </div>
        <?php $__env->stopSection(); ?>
        
        <?php $__env->startSection('content'); ?>


<div class="container">           
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>user_id</th>
        <th>page_id</th>
        <th>POST</th>
        <th>Scheduled_date</th>

      </tr>
    </thead>
    <tbody>

<?php if(count($userposts)): ?>
<?php $__currentLoopData = $userposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($post->id); ?></td>
        <td><?php echo e($post->app_user_id); ?></td>
        <td><?php echo e($post->page_id); ?></td>
        <td><?php echo e($post->message); ?></td>
        <td><?php echo e($post->created_time); ?></td>

      </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

   </tbody>
  </table>
</div>

        <?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptCode'); ?>


<script>

token= '<?php echo e(csrf_token()); ?>';
//islaaaaaaaaaam ------------------
<?php if(count($userposts)): ?>
<?php $__currentLoopData = $userposts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

var scheduledat= new Date('<?php echo e($post->created_time); ?>');
if(scheduledat <= new Date()){

var scheduleDatee= '<?php echo e($post->created_time); ?>';
console.log('this post is schedueled');

        publish= 1;
        page_id = '<?php echo e($post->page_id); ?>';
        message = '<?php echo e($post->message); ?>';
        FaceBook.postToPageSchedule(page_id,message,scheduleDatee,function(page_id,data){
                                    console.log(data);
                                        post_id =data.id;
                                        resource_id=0;
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo e(URL('updatepost', [$post->id])); ?>",
                                            data: {
                                                "page_id": page_id,
                                                "message": message,
                                                "publish": publish,                                               
                                                "post_id": post_id,
                                                "resource_id": resource_id,
                                                _token: token
                                            },
                                            success: function (msg) {
                                            }
                                        });
                
            });
    }

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php $__env->stopSection(); ?>





<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>