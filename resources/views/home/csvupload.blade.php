@extends('home.layouts.app')
@section('content')
    <link href="{{ asset('css/styleUploadFileFacebook.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styleuploadcsv_statusbrew.css') }}" rel="stylesheet">
    {{--<link href="https://cdn-app.stbrw.net/main.0a78f3f0b2c644e991bb19e00756bbcc.css" rel="stylesheet">--}}
<style>


</style>


    <body>

    <div class="container">
        @if (session('sucess'))
        <div class="alert alert-success">
            {{ session('sucess') }}
        </div>
        @endif
        @if (session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
        @endif
        <div>

                <div _ngcontent-c25="" class="step choose-type">
                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">1</span>
                        <span _ngcontent-c25="" translate="">Choose Profile</span>
                    </div>
                    <span _ngcontent-c25="" class="step-subhead" translate="">Tell us for which profile you want to upload the CSV</span>
                    <div _ngcontent-c25="" style="height:20px;"></div>
                    <form method="post" action="{{ url('/facebook/csv') }}" enctype="multipart/form-data">
                        <select>
                            <option value=""> Choose Account</option>
                            <option>myacc</option>
                        </select>
                    <div _ngcontent-c25="" class="layout-padding" fxlayout="" fxlayoutalign="start center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center flex-start; align-items: center;">
                        <span _ngcontent-c25="" class="step-count" fxlayout="" fxlayoutalign="center center" style="box-sizing: border-box; max-height: 100%; display: flex; flex-direction: row; place-content: center; align-items: center;">2</span>
                        <span _ngcontent-c25="" translate="">Choose from the following csv formats to upload</span>
                    </div>
                    <span _ngcontent-c25="" class="step-subhead" translate="">Select either a pre selected category or create custom time for your posts</span>
                    <div _ngcontent-c25="" style="height:20px;"></div>

                    <div _ngcontent-c25="" class="step-content">
                        <mat-radio-group _ngcontent-c25="" class="upload-type-group mat-radio-group ng-untouched ng-pristine ng-valid" fxlayout="column" role="radiogroup" style="display: flex; box-sizing: border-box; flex-direction: column;">
                            <mat-radio-button _ngcontent-c25="" class="upload-type-option mat-radio-button mat-accent mat-radio-checked" id="mat-radio-2"><label class="mat-radio-label" for="mat-radio-2-input"><div class="mat-radio-container"><div class="mat-radio-outer-circle"></div><div class="mat-radio-inner-circle"></div><div class="mat-radio-ripple mat-ripple" mat-ripple=""></div></div><input class="mat-radio-input cdk-visually-hidden" type="radio" id="mat-radio-2-input" name="mat-radio-group-0"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                                        <span _ngcontent-c25="" translate="">Pre select Category</span>
                                    </div></label></mat-radio-button>
                            <!----><div _ngcontent-c25="" class="layout-padding upload-option">
                                <div _ngcontent-c25="">
                                    <mat-form-field _ngcontent-c25="" class="mat-input-container mat-form-field ng-tns-c28-6 mat-form-field-type-mat-select mat-form-field-can-float mat-primary ng-untouched ng-pristine ng-valid"><div class="mat-input-wrapper mat-form-field-wrapper"><div class="mat-input-flex mat-form-field-flex"><!----><div class="mat-input-infix mat-form-field-infix">
                                                    <mat-select _ngcontent-c25="" class="mat-select ng-tns-c29-7 ng-untouched ng-pristine ng-valid" name="selectedSchedule" role="listbox" id="mat-select-1" tabindex="0" aria-label="Select Category" aria-required="false" aria-disabled="false" aria-invalid="false" aria-owns="mat-option-1" aria-multiselectable="false"><div class="mat-select-trigger" aria-hidden="true" cdk-overlay-origin=""><div class="mat-select-value"><!----><!---->&nbsp;<!----></div><div class="mat-select-arrow-wrapper"><div class="mat-select-arrow"></div></div></div><!----></mat-select>
                                                    <span class="mat-input-placeholder-wrapper mat-form-field-placeholder-wrapper"><!----><label class="mat-input-placeholder mat-form-field-placeholder ng-tns-c28-6 mat-empty mat-form-field-empty" for="mat-select-1" aria-owns="mat-select-1">Select Category <!----></label></span></div><!----></div><div class="mat-input-underline mat-form-field-underline"><span class="mat-input-ripple mat-form-field-ripple"></span></div><div class="mat-input-subscript-wrapper mat-form-field-subscript-wrapper"><!----><!----><div class="mat-input-hint-wrapper mat-form-field-hint-wrapper ng-tns-c28-6 ng-trigger ng-trigger-transitionMessages" style="opacity: 1; transform: translateY(0%);"><!----><div class="mat-input-hint-spacer mat-form-field-hint-spacer"></div></div></div></div></mat-form-field>
                                    <p _ngcontent-c25="" class="mat-caption" translate="">Your CSV file should be of the following format (do not include the headers)</p>
                                    <table _ngcontent-c25="" class="csv-format">
                                        <tbody _ngcontent-c25=""><tr _ngcontent-c25="">
                                                <th _ngcontent-c25="">Message</th>
                                                <th _ngcontent-c25="">Media URL</th>
                                            </tr>
                                            <tr _ngcontent-c25="">
                                                <td _ngcontent-c25="" translate="">It's a beautiful day today. Good Morning</td>
                                                <td _ngcontent-c25=""></td>
                                            </tr>
                                            <tr _ngcontent-c25="">
                                                <td _ngcontent-c25="" translate="">A beautiful picture of the Torii gates from Fushimi Inari temple in Kyoto #throwback</td>
                                                <td _ngcontent-c25="">http://i.imgur.com/iyvborD.jpg</td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </div>
                            <div _ngcontent-c25="" style="height:30px;"></div>
                            <mat-radio-button _ngcontent-c25="" class="last upload-type-option mat-radio-button mat-accent" id="mat-radio-3"><label class="mat-radio-label" for="mat-radio-3-input"><div class="mat-radio-container"><div class="mat-radio-outer-circle"></div><div class="mat-radio-inner-circle"></div><div class="mat-radio-ripple mat-ripple" mat-ripple=""></div></div><input class="mat-radio-input cdk-visually-hidden" type="radio" id="mat-radio-3-input" name="mat-radio-group-0"><div class="mat-radio-label-content"><span style="display:none">&nbsp;</span>
                                        <span _ngcontent-c25="" translate="">Date-time based CSV file</span>
                                    </div></label></mat-radio-button>
                            <!---->
                        </mat-radio-group>
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
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@endsection