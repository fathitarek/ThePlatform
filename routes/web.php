<?php/*|--------------------------------------------------------------------------| Web Routes|--------------------------------------------------------------------------|| Here is where you can register web routes for your application. These| routes are loaded by the RouteServiceProvider within a group which| contains the "web" middleware group. Now create something great!|*//*Route::get('/countries', function(){    $countries=\App\Countries::all();    dd($countries);});*/Route::get('/facebook_csvFile', function () {    return view('home/csvupload');});Route::post('/facebook/csv','uploadcsvFacebookController@import');Route::get('/termsAndConditions', 'HomeController@termsAndConditions');Route::get('/support', 'HomeController@support');Route::get('/privacy', 'HomeController@privacy');Route::get('/logout','HomeController@logout');Route::get('/login','HomeController@login');Route::post('/login','HomeController@loginPost');Route::post('/register','HomeController@registerPost');Route::get('/login/{type}', 'HomeController@socialLogin');Route::get('/{type}/callback', 'HomeController@socialLoginCallback');Route::post('timeZone', 'HomeController@timeZone');    Route::get('signup', 'HomeController@signup');Route::post('register', 'HomeController@register'); Route::group(['middleware' => 'AppUsers'], function () {    Route::get('/', 'HomeController@home');    Route::get('user/profile', 'HomeController@profile');    Route::post('user/profile', 'HomeController@profilePost');    Route::get('schedule', 'HomeController@schedule');    Route::get('publisher', 'HomeController@publisher');        Route::get('my_categories', 'HomeController@mycat');    Route::get('addcategory', 'HomeController@category');    Route::get('editcategory/{id}', 'HomeController@editcategory');    Route::POST('updatecategory/{id}', 'HomeController@updatecategory');    Route::POST('addcategry', 'HomeController@addcategory');    Route::get('deletecategory/{id}', 'HomeController@deletecategory');    Route::post('addNewProfile', 'HomeController@addNewProfile');    Route::post('searchProfile', 'HomeController@searchProfile');    Route::post('addPost', 'HomeController@addPost');        Route::get('/scheduledposts', 'HomeController@scheduledposts');    Route::post('/updatepost/{id}', 'HomeController@updatepost');    Route::post('uploadPhotos', 'HomeController@uploadPhotos');    Route::post('removePhoto', 'HomeController@removePhoto');    Route::get('twitter/jsCallback', 'HomeController@jsCallback');    Route::get('singlePost/{page_id}/{post_id}', 'HomeController@singlePost');    Route::post('getEngagementPosts', 'HomeController@getEngagementPosts');    Route::post('addProfilePosts', 'HomeController@addProfilePosts');    Route::post('saveAccessToken', 'HomeController@saveAccessToken');    //Route::post('saveTokenNumber', 'HomeController@saveTokenNumber');});/*auth routes*/Auth::routes();/*authentication routes*/Route::group(['middleware' => 'PermissionsAuth'], function () {    /*home page admin route*/    Route::get('/admin', 'Admin\AdminController@home');    Route::group(['prefix' => 'admin'], function () {        /*users routes*/        Route::resource('users', 'Admin\UsersController',['names'=>['create'=>'users_add','store'=>'users_add','index'=>'users','edit'=>'users_edit','update'=>'users_edit','destroy'=>'users_delete']]);        Route::post('users/activation', ['uses'=>'Admin\UsersController@activation','as'=>'users_active']);        /*profiles permission routes*/        Route::resource('profiles', 'Admin\ProfilesController',['names'=>['create'=>'profiles_add','store'=>'profiles_add','index'=>'profiles','edit'=>'profiles_edit','update'=>'profiles_edit','destroy'=>'profiles_delete']]);        Route::post('profiles/activation', ['uses'=>'Admin\ProfilesController@activation','as'=>'profiles_active']);        /*profile routes*/        Route::get('profile', ['uses'=>'Admin\AdminController@profile','as'=>'profile']);        Route::post('profile', ['uses'=>'Admin\AdminController@profilePost','as'=>'profile']);        /*profile routes*/        Route::get('system', ['uses'=>'Admin\AdminController@system','as'=>'system']);        Route::post('system', ['uses'=>'Admin\AdminController@systemPost','as'=>'system']);        /*start app_users routes*/        Route::resource('app_users', 'Admin\AppUsersController',['names'=>['create'=>'app_users_add','store'=>'app_users_add','index'=>'app_users','edit'=>'app_users_edit','update'=>'app_users_edit','destroy'=>'app_users_delete']]);        Route::post('app_users/activation', ['uses'=>'Admin\AppUsersController@activation','as'=>'app_users_active']);        /*end app_users routes*/    });});