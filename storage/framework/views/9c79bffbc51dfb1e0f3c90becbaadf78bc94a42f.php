    <?php $__env->startSection('pageTitle'); ?>        <title><?php echo e(Lang::get('home.home_page_title')); ?></title>        <link rel="stylesheet" href="<?php echo e(asset('js/jquery.qtip.min.css')); ?>">        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    <?php $__env->stopSection(); ?><?php $__env->startSection('contentHeader'); ?>    <ul class="breadcrumb">        <li class="breadcrumb-item"><a href="<?php echo e(URL('privacy')); ?>"><?php echo e(Lang::get('home.privacy')); ?></a></li>    </ul>    <?php $__env->stopSection(); ?>    <?php $__env->startSection('content'); ?>    <!-- BEGIN DASHBOARD STATS 1-->    <div class="content-box">        <div class="element-wrapper">            <div class="element-box">                <div id="fullCalendarPosts">                </div>                <div class="clearfix"></div>            </div>        </div>    </div><?php $__env->stopSection(); ?><?php $__env->startSection('scriptCode'); ?>    <script src="<?php echo e(asset('js/jquery.qtip.min.js')); ?>"></script>    <script>        date = new Date();        d = date.getDate();        m = date.getMonth();        y = date.getFullYear();        calendar = $("#fullCalendarPosts").fullCalendar({            header: {                left: "prev,next today",                center: "title",                right: "month,agendaWeek,agendaDay"            },            selectable: false,            selectHelper: false,            select: function select(start, end, allDay) {                var title;                title = prompt("Event Title:");                if (title) {                    calendar.fullCalendar("renderEvent", {                        title: title,                        start: start,                        end: end,                        allDay: allDay                    }, true);                }                return calendar.fullCalendar("unselect");            },            editable: false,            events: [                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    {                        title: "<?php echo e($post->page_name); ?>"+"<i class='fa fa-facebook' aria-hidden='true'></i>",                        description: "<?php echo e(str_limit(trim(preg_replace( "/\r|\n/","",preg_replace('/\s\s+/', ' ',$post->message))),100)); ?>",                        start: "<?php echo e(date('Y-m-d H:i:s',strtotime($post->created_time))); ?>",                        end: "<?php echo e(date('Y-m-d H:i:s',strtotime($post->created_time))); ?>"                    },               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            ],            eventRender: function(event, element) {                element.qtip({                    content: event.description                });            }        });    </script><?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>