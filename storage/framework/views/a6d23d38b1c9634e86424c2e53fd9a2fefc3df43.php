<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/styleUploadFileFacebook.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/styleuploadcsv_statusbrew.css')); ?>" rel="stylesheet">
<!--<link href="https://cdn-app.stbrw.net/main.0a78f3f0b2c644e991bb19e00756bbcc.css" rel="stylesheet">-->
<style> 
.fa{color: blue;}

    td, th { padding:10px;}
    .date_time{display: none; border: 1;}
    #category_id{display: none;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php echo e(asset('/js/facebookJavaScript.js')); ?>"></script>

<body>

    <div class="container">

        <?php if(isset($_GET['submit'])&& $_GET['submit']==1): ?>

        <div class="alert alert-success">File Uploaded successfully</div>
        <?php endif; ?>


        <?php if(session('sucess')): ?>
        <div class="alert alert-success">
            <?php echo e(session('sucess')); ?>

        </div>
        <?php endif; ?>
        <?php if(session('fail')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('fail')); ?>

        </div>
        <?php endif; ?>
        <div>

            <div _ngcontent-c25="" class="step choose-type">
 <div >
                    <a href="<?php echo e(URL('scheduledPosts')); ?>" style="margin-right: 30px; text-decoration: underline"><?php echo e(Lang::get('scheduledPosts')); ?></a> 
                    <a href="<?php echo e(URL('publishPosts')); ?>" style="margin-right: 30px;text-decoration: underline;"><?php echo e(Lang::get('publishPosts')); ?></a>
                    <a href="<?php echo e(URL('failedPosts')); ?>" style="margin-right: 30px;text-decoration: underline;"><?php echo e(Lang::get('failedPosts')); ?></a>
                </div>


<table class="table">
    
  <thead>
    <tr>
      <th scope="col">Time</th>
      <th scope="col">Message</th>
      <th scope="col">Media</th>
      <th scope="col">Network</th>
       <th scope="col">Channel</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>   
       <?php if(count($failed_posts)): ?>
        <?php $__currentLoopData = $failed_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      
           <td><?php echo date('Y-m-d H:i:s', strtotime($record->created_time));?></td>
      <td><?php echo e($record->message); ?></td>
      <td><div><?php echo $record->picture ? '<img src="'.$record->picture.'" height="40"/>':''; ?></div></td>
       <td><i class="fa fa-facebook" aria-hidden="true"></i></td>
      <td><?php echo e($record->appUser['name']); ?></td>
      <td><?php echo e($record->created_at); ?></td>
    </tr>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
  </tbody>
</table>
               <?php echo e($failed_posts->links()); ?>  
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>