<?php $__env->startSection('content'); ?>
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
    if (d.getElementById(id)) {return; }
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script>
    function init(){}
</script>
<link href="<?php echo e(asset('css/styleUploadFileFacebook.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/styleuploadcsv_statusbrew.css')); ?>" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><style> 
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

        <div class="alert alert-success">Post Send Now successfully</div>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php if(count($scheduled_posts)): ?>
                        <?php $__currentLoopData = $scheduled_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo date('Y-m-d H:i:s', strtotime($record->created_time)); ?></td>
                            <td><?php echo e($record->message); ?></td>
                            <td><div><?php echo $record->picture ? '<img src="'.$record->picture.'" height="40"/>':''; ?></div></td>
                            <td><i class="fa fa-facebook" aria-hidden="true"></i></td>
                            <td><?php echo e($record->appUser['name']); ?></td>
                            <td><?php echo e($record->created_at); ?></td>
                            <td>
                                <a href='/scheduledPostsDelete/<?php echo e($record->id); ?>' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-trash"></i></a>
                                <a href='/scheduledPostsedit/<?php echo e($record->id); ?>' class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                <?php if(!empty($record->picture)): ?>
                                <a href='#'  onclick="sendNow(<?php echo e($record->picture); ?>,<?php echo e($record->page_id); ?>,<?php echo e($record->message); ?>);" data-picture='<?php echo e($record->picture); ?>' data-page-id='<?php echo e($record->page_id); ?>' data-message='<?php echo e($record->message); ?>'   class='btn btn-default btn-xs sendNow'><i class="glyphicon glyphicon-triangle-right"></i></a>
                                <?php else: ?>
                                <a href='#'  data-picture='<?php echo e($record->picture); ?>' data-page-id='<?php echo e($record->page_id); ?>' data-message='<?php echo e($record->message); ?>'  id="" class='btn btn-default btn-xs sendNow'><i class="glyphicon  glyphicon-triangle-right"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($scheduled_posts->links()); ?>  
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
    $('.sendNow').click(function(e){
    e.preventDefault();
    //alert("rthjrhr");
    console.log("asdasda")
     picture = $(this).data('picture');
    var message = $(this).data('message');
    var page_id = $(this).attr('data-page-id');
    console.log(picture); console.log(message); console.log(page_id);
    //alert(picture);
    create_post("facebook", "now", "", "", "", page_id, message, "");
    });
//    function sendNow(picture, page_id, message){
//
//    // picture = $(this).data('picture');
//    /*var message = $(this).data('message');
//     var page_id = $(this).attr('data-page-id');*/
//    create_post("facebook", "now", "", picture, "", page_id, message, "", page_id);
//    }

    });

</script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>