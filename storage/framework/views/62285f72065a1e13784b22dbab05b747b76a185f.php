<!DOCTYPE html>
<html>
<!-- Mirrored from light.pinsupreme.com/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Aug 2017 06:54:14 GMT -->

<head>
    <title>Admin Dashboard HTML Template
    </title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo e(asset('favicon.png')); ?>" rel="shortcut icon">
    <link href="http://fast.fonts.net/cssapi/175a63a1-3f26-476a-ab32-4e21cbdb8be2.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('them/bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('them/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('them/bower_components/dropzone/dist/dropzone.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('them/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('them/bower_components/fullcalendar/dist/fullcalendar.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('them/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('them/css/main4a50.css?version=3.4')); ?>" rel="stylesheet">
    <style>
        @import  url(http://weloveiconfonts.com/api/?family=brandico|entypo|openwebicons|zocial);

        /* brandico */
        [class*="brandico-"]:before {
            font-family: 'brandico', sans-serif;
        }

        /* entypo */
        [class*="entypo-"]:before {
            font-family: 'entypo', sans-serif;
        }

        /* openwebicons */
        [class*="openwebicons-"]:before {
            font-family: 'OpenWeb Icons', sans-serif;
        }

        /* zocial */
        [class*="zocial-"]:before {
            font-family: 'zocial', sans-serif;
        }

        .form-signin{
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }


        .login-input {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .login-input-pass {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }


        .signup-input {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .signup-input-confirm {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }



        .create-account {
            text-align: center;
            width: 100%;
            display: block;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .btn-center{
            width: 50%;
            text-align: center;
            margin: inherit;
        }

        .social-login-btn {
            margin: 5px;
            width: 20%;
            font-size: 250%;
            padding: 0;
        }

        .social-login-more {
            width: 45%;
        }

        .social-google {
            background-color: #da573b;
            border-color: #be5238;
        }
        .social-google:hover{
            background-color: #be5238;
            border-color: #9b4631;
        }

        .social-twitter {
            background-color: #1daee3;
            border-color: #3997ba;
        }
        .social-twitter:hover {
            background-color: #3997ba;
            border-color: #347b95;
        }

        .social-facebook {
            background-color: #4c699e;
            border-color: #47618d;
        }
        .social-facebook:hover {
            background-color: #47618d;
            border-color: #3c5173;
        }

        .social-linkedin {
            background-color: #4875B4;
            border-color: #466b99;
        }
        .social-linkedin:hover {
            background-color: #466b99;
            border-color: #3b5a7c;
        }
        .auth-box-w .logo-w{
padding:20px;

        }
    </style>
</head>
<body class="auth-wrapper">
<div class="all-wrapper menu-side with-pattern">
    <div class="auth-box-w">
        <div class="logo-w">
        </div><h4 class="auth-header">Create Your Account</h4>
        <form class="login-form" action="<?php echo e(URL('register')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <a type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(!empty( Session::get('error') )): ?>
                <div class="alert  alert-danger">
                    <a class="close" aria-hidden="true" data-dismiss="alert">&times;</a>
                    <h4 class="alert-heading"> <?php echo Session::get('error'); ?></h4>
                    <?php echo e(Session::forget('error')); ?>

                </div>
            <?php endif; ?>



         <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email">Username</label>
                <input class="form-control" name="username" placeholder="Enter Username" >
                <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>
            </div>


            <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email"><?php echo e(Lang::get('home.email')); ?></label>
                <input class="form-control" name="email" placeholder="<?php echo e(Lang::get('home.enter').Lang::get('home.email')); ?>" type="email">
                <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>
            </div>







         <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email">Phone</label>
                <input class="form-control" name="phone_number" placeholder="Enter phone" >
                <div class="pre-icon os-icon os-icon-user-male-circle"></div>
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>
            </div>







            <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <label for="">Password</label>
                <input class="form-control" name="password" placeholder="<?php echo e(Lang::get('home.enter').Lang::get('home.password')); ?>" type="password">
                <div class="pre-icon os-icon os-icon-fingerprint"></div>
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
       <div class="buttons-w"><button class="btn btn-primary">Sign me up</button>
                <div class="form-check-inline">
                    <label class="form-check-label">

if you have account, please <a href="<?php echo e(URL('login')); ?>" class="signupclick">Login</a>

                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
</body>

</html>
