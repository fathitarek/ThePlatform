<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('css/styleUploadFileFacebook.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/styleuploadcsv_statusbrew.css')); ?>" rel="stylesheet">

<style> 
        td, th { padding:10px;}
        .date_time{display: none; border: 1;}
        #category_id{display: none;}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <body>

        <div class="container">
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
                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">1</span>
                        <span _ngcontent-c25="" translate="">Choose Profile</span>
                    </div>
                    <span _ngcontent-c25="" class="step-subhead" translate="">Tell us for which profile you want to upload the CSV</span>
                    <div _ngcontent-c25="" style="height:20px;"></div>
                        <form method="post" action="<?php echo e(url('/facebook/csv')); ?>" enctype="multipart/form-data">
                            <select required name="app_user_id">
                                    <option value=""> Choose Account</option>
                                    <option selected value="<?php echo e(Auth::guard('AppUsers')->user()->id); ?>"><?php echo e(Auth::guard('AppUsers')->user()->name); ?></option>
                                </select>
                                <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                    <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">2</span>
                                    <span _ngcontent-c25="" translate="">Choose from the following csv formats to upload</span>
                                </div>
                                <span _ngcontent-c25="" class="step-subhead" translate="">Select either a pre selected category or crom time for your posts</span>
                                <div _ngcontent-c25="" style="height:20px;"></div>

                                <div _ngcontent-c25="" class="step-content">
                                    <input type="radio" id="select_category" name="date_time" value="0" style="border-color: #448aff;"> Pre select Category<br>
                                    <!--<select id="category_id" name="category_id">-->
                                    <!--<option value=""> Choose Category</option>-->
                                    <!--<option selected value="<?php echo e(Auth::guard('AppUsers')->user()->id); ?>"><?php echo e(Auth::guard('AppUsers')->user()->name); ?></option>-->
                                <!--</select>-->
                                <br>
                                <?php echo e(Form::select('category_id',$records,null,['placeholder' => 'Choose Category','class'=> '','id'=>'category_id'])); ?>

                                <br>
                                    <input type="radio" id="select_date_time" name="date_time" value="1"> Date-time based CSV file<br>
                                    <table border="1" style="margin-bottom: 20px;margin-top: 50px;">
                                        <caption style="padding: 35px;">Your CSV file should be of the following format (do not include the headers)</caption>
                                        <thead style="background-color: gray; color: black;">
                                            <tr>
                                                <th>message</th>
                                                <th>Media URL</th>
                                                <th class="date_time">created_time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>It's a beautiful day today. Good Morning  </td>
                                                <td></td>
                                                <td class="date_time">Jan 16, 2018</td>
                                            </tr>
                                            <tr>
                                                <td>A beautiful picture of the Torii gates </td>
                                                <td>http://i.imgur.com/iyvborD.jpg</td>
                                                <td class="date_time">Jan 16, 2018</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                </div>








                                <div _ngcontent-c25="" class="step shorten-urls">
                                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">3</span>
                                        <span _ngcontent-c25="" translate="">Shorten URLs in the messages</span>
                                    </div>
                                    <div _ngcontent-c25="" class="step-content">
                                        <div _ngcontent-c25="" class="layout-margin" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                            <mat-slide-toggle _ngcontent-c25="" class="mat-slide-toggle mat-accent mat-checked mat-slide-toggle-label-before" labelposition="before" id="mat-slide-toggle-1"><label class="mat-slide-toggle-label">
                                                    <div class="mat-slide-toggle-bar" style=" position: absolute; left: 60px;"><input class="mat-slide-toggle-input cdk-visually-hidden" type="checkbox" id="mat-slide-toggle-1-input" tabindex="0"><div class="mat-slide-toggle-thumb-container"><div class="mat-slide-toggle-thumb"></div><div class="mat-slide-toggle-ripple mat-ripple" mat-ripple=""></div></div></div><span class="mat-slide-toggle-content">
                                                        <span _ngcontent-c25="" translate="posts.create_post.create_post.detail.shorten">Shorten Urls</span>
                                                    </span></label></mat-slide-toggle>
                                            <span _ngcontent-c25="" fxflex="" style="flex: 1 1 1e-09px; box-sizing: border-box;"></span>
                                            <select _ngcontent-c25="">
                                                <option _ngcontent-c25="" value="sb.gl">sb.gl</option>
                                                <option _ngcontent-c25="" value="bit.ly" disabled="">bit.ly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div _ngcontent-c25="" class="step upload-files">
                                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">4</span>
                                        <span _ngcontent-c25="" translate="">Upload CSV file</span>
                                    </div>
                                    <span _ngcontent-c25="" class="step-subhead">You can <a class="bulk-upload-download-option" href="https://cdn-front.statusbrew.com/posts/resources/csv2col-v1-1f1f836.csv" target="_blank">download</a> a sample file to get started</span>
                                    <div _ngcontent-c25="" style="height:20px;"></div>
                                    <div _ngcontent-c25="" class="step-content">
                                        <div _ngcontent-c25="" class="file-drop error" ng2filedrop="">
                                            <!---->
                                            <!----><div _ngcontent-c25="" class="ng2-upload-block" fxlayout="column" fxlayoutalign="center stretch" style="box-sizing: border-box; display: flex; flex-direction: column; max-width: 100%; place-content: stretch center; align-items: stretch;">

                                                <input type="file" name="csv_file" id="csv_file" class="" accept=".csv" required>
                                            </div>
                                            <?php echo e(csrf_field()); ?>

                    <button type="submit" class="btn btn-primary">Upload</button>
                                                        </form>
                                               </div>
                                       </div>
                                   </div>                                
    </div>
</div>

<script>
$(document).ready(function () {
    $('#select_category').click(function () {
        if ($('#select_category').is(':checked')) {
            $(".date_time").css("display", "none");
            $("#category_id").css("display","block");
        }
    });


    $('#select_date_time').click(function () {
        if ($('#select_date_time').is(':checked')) {
            $(".date_time").css("display", "block");
            $("#category_id").css("display","none");
        }
    });

});

</script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>