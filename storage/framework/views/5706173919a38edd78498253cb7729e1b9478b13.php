<?php $__env->startSection('headScript'); ?>

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








<?php if($post->category_id != NULL): ?>
<?php $__currentLoopData = DB::table('categories')->where('id', '=', $post->category_id)->orderBy('id','DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$datetime = DateTime::createFromFormat('YmdHi', '201308131830');
echo $datetime->format('D');
$times = explode('|',  $cat->sunday); ?>
<?php $__currentLoopData = $times; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><?php echo e($time); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>



      <tr>
        <td><?php echo e($post->id); ?></td>
        <td><?php echo e($post->app_user_id); ?></td>

        <td><?php echo e($post->page_id); ?></td>
        <td><?php echo e($post->message); ?></td>
        <td><?php echo e($post->created_time); ?></td>

      </tr>


   </tbody>
  </table>
</div>

        <?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptCode'); ?>











<script>
$(document).ready(function(){

token= '<?php echo e(csrf_token()); ?>';
//islaaaaaaaaaam ------------------



//get time now to check category
    var d = new Date();
    var n = d.getHours()+':'+d.getMinutes();
//-------------------------------------------------------















var scheduledat= new Date('<?php echo e($post->created_time); ?>');
if(scheduledat <= new Date()){

var scheduleDatee= '<?php echo e($post->created_time); ?>';
console.log('this post is schedueled');

        publish= 1;
        page_id = '<?php echo e($post->page_id); ?>';
        message = '<?php echo e($post->message); ?>';
        picture_url=$("#postPhoto img").attr('src');

        FaceBook.postToPageSchedule(page_id,message,scheduleDatee,picture_url,function(page_id,data){
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
  });
</script>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php $__env->stopSection(); ?>





<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>