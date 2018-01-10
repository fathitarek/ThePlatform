<?php



namespace App\Http\Controllers;

use App\User;

use App\AppUsers;

use App\AppUsersPages;

use App\AppUsersPosts;

use App\AppUsersPostsComments;

use App\AppUsersPostsLikes;

use App\AppUsersProfiles;

use App\Countries;

use App\Profiles;

use App\Resources;

use App\TimeZone;

use App\Category;


use App\CategoryPlans;


use Doctrine\Instantiator\Exception\InvalidArgumentException;

use GuzzleHttp\Exception\ClientException;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Lang;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Laravel\Socialite\Facades\Socialite;

use Laravel\Socialite\Two\InvalidStateException;

use League\OAuth1\Client\Credentials\CredentialsException;

use Mockery\Generator\Parameter;

use Carbon\Carbon;



class HomeController extends Controller

{



    public function noData(){

        return abort(404);

    }

    public function login(){

        $userSocialData=Session::get('userSocialData');

        $userSocialType=Session::get('userSocialType');

        //dd($userSocialType);

        //dd($userSocialData);

        $countries=Countries::where('active',1)->get();

        return view('home.login',compact('countries','userSocialData','userSocialType'));

    }

    public function loginPost(Request $request){
        $data=$request->input();
        $validator = Validator::make($request->all(),

            array(

                'email'=>'required',
                'password'=>'required',

            ));

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

        }else{

            $appUser=AppUsers::withTrashed()->where('email',$data['email'])->first();

            if(count($appUser)){

                if(Hash::check($data['password'],$appUser->password)){

                    if($appUser->active==1){

                        if($appUser->deleted_at==null){

                            Auth::guard('AppUsers')->loginUsingId($appUser->id);

                            return Redirect::to('/');

                        }else{

                            return redirect()->back()->withErrors([Lang::get('home.error_deleted_account_message')])->withInput();

                        }

                    }else{

                        return redirect()->back()->withErrors([Lang::get('home.error_not_active_account_message')])->withInput();

                    }

                }else{

                    return redirect()->back()->withErrors([Lang::get('home.wrong_email_or_password')])->withInput();

                }

            }else{

                return redirect()->back()->withErrors([Lang::get('home.wrong_email_or_password')])->withInput();

            }

        }

    }

    public function registerPost(Request $request){

    /*    $data=$request->input();

        $validator = Validator::make($request->all(),

            array(

                'register_country_id'=>'required',

                'register_time_zone'=>'required',

                'register_type'=>'required',

                'register_name'=>'required',

                'register_email'=>'required|unique:app_users,email',

                'register_phone'=>'required|unique:app_users,phone',

                'register_password'=>'required',

                'register_confirm_password'=>'required|same:register_confirm_password',

            ));

        if ($validator->fails()) {

            $message='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul>';

            foreach($validator->errors()->all() as $error){

                $message.='<li>'.$error.'</li>';

            }

            $message.='</ul></div>';

            return response()->json(['message'=>$message,'success'=>false,])->setCallback($request->input('callback'));

        }else {

            $app_users=new AppUsers();

            $app_users->uniqid=uniqid('',true);

            $app_users->type=$data['register_type'];

            $app_users->time_zone=$data['register_time_zone'];

            $app_users->country_id=$data['register_country_id'];

            $app_users->register_type=(isset($data['register_register_type']))?$data['register_register_type']:'web';

            $app_users->register_social_id=(isset($data['register_social_id']))?$data['register_social_id']:'';

            $app_users->name=$data['register_name'];

            $app_users->email=$data['register_email'];

            $app_users->phone=$data['register_phone'];

            $app_users->password=Hash::make($data['register_password']);

            $app_users->add_date=date("Y-m-d H:i:s");

            if($app_users->save()){

                Session::forget('userSocialData');

                Session::forget('userSocialType');

                $app_users->add_by_user=$app_users->id;

                $app_users->save();

                return response()->json(['message'=>'<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.Lang::get('home.register_success_message').'</div>','success'=>true,])->setCallback($request->input('callback'));
            }
        }
*/


    }


    public function signup(){
        return view('home.register');
    }

    public function register(Request $request){
    $data=$request->input();
   /*         $validator = Validator::make($request->all(),

            array(
                'username'=>'required',
                'phone_number'=>'required',
                'email'=>'required|unique:app_users,email',
                'phone_number'=>'required|unique:app_users,phone',
                'password'=>'required',
            ));

     
        if ($validator->fails()) {
            $message='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul>';
            foreach($validator->errors()->all() as $error){
                $message.='<li>'.$error.'</li>';

            }
            $message.='</ul></div>';
            return response()->json(['message'=>$message,'success'=>false,])->setCallback($request->input('callback'));

        }else {

*/
    $app_users=new AppUsers();
    $app_users->uniqid=uniqid('',true);
    $app_users->add_date=date("Y-m-d H:i:s");
    $app_users->name=$data['username'];
    $app_users->phone=$data['phone_number'];
    $app_users->password=Hash::make($data['password']);;
    $app_users->email=$data['email'];
    $app_users->country_id='64';
    $app_users->active='1';

    if($app_users->save()){

$app_users->save();
    
    return Redirect::to('/login');

                
}
}




    public function home(){

        $pages=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->get();

        return view('home.home',compact('pages'));

    }

    public function getEngagementPosts(Request $request){

        $data=$request->input();

        if(isset($data['page_id'])){

            $page_id=$data['page_id'];

            $posts=AppUsersPosts::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$page_id)->orderBy(DB::raw("comments_count+likes_count"),'DESC')->take(8)->get();

            $html='';

            foreach($posts as $post){

                $html.='<div class="col-lg-3 post-item"> <div class="col-lg-2 padding-0"> <img class="profile-img" alt="'.$post->from_name.'" title="'.$post->from_name.'" style="width: 100%" src="'.$post->from_picture.'"> </div> <div class="col-lg-10"> <h5 class="profile-name"><a target="_blank" href="https://www.facebook.com/'.$post->from_id.'">'.$post->from_name.'</a></h5> <span class="small created-time"><a target="_blank" href="'.URL('singlePost/'.$post->page_id.'/'.$post->post_id).'">'.$post->created_time.'</a></span> </div> <div class="col-lg-12">';

                if(!empty($post->picture)){

                    $html.='<img class="post-image" style="width:100%;" src="'.$post->picture.'" alt="">';

                }

                $html.='<p class="post-message">'.str_limit($post->message,120).'</p> </div> <hr> <div class="col-lg-4"> <span>Likes</span> <span class="post-like-count">'.$post->likes_count.'</span> </div> <div class="col-lg-4"> <span>Comments</span> <span class="post-comments-count">'.$post->comments_count.'</span> </div> <div class="col-lg-4"> <span>Shares</span> <span class="post-shares-count">'.$post->share_count.'</span> </div> </div>';

            }

            return response()->json(['message'=>Lang::get('home.success'),'success'=>true,'html'=>$html])->setCallback($request->input('callback'));

        }

    }



    public function profile(){

        $countries=Countries::all();

        return view('home.users.profile',compact('countries'));

    }




    public function category(){

        return view('home.category');

    }


  public function addcategory(Request $request){


if($request->sun){
$sun=implode($request->sun, '|');
}else{
 $sun='';
}
if($request->mond){
$mond=implode($request->mond, '|');
}else{
 $mond='';
}

if($request->tues){
$tues=implode($request->tues, '|');
}else{
 $tues='';
}

if($request->wedn){
$wedn=implode($request->wedn, '|');
}else{
 $wedn='';
}

if($request->thurs){
$thurs=implode($request->thurs, '|');
}else{
 $thurs='';
}

if($request->frid){
$frid=implode($request->frid, '|');
}else{
 $frid='';
}
if($request->satur){
$satur=implode($request->satur, '|');
}else{
 $satur='';
}



$category=new Category();
$category->user_id=Auth::guard('AppUsers')->user()->id;
$category->name=$request->postcategry;
$category->save();

$categryid=$category->id;
/*
DB::table('categories')->insert([
'user_id'  => Auth::guard('AppUsers')->user()->id,
'name'  => $request->postcategry,
'sunday'  => $sun,
'monday'  => $mond,
'tuesday'  => $tues,
'wednesday'  => $wedn,
'thursday'  => $thurs,
'friday'  => $frid,
'saturday'  => $satur
        ]);
*/
if(isset($request->sun)){
foreach ($request->sun as $sunday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='sunday';
$categoryplan->doweek='2';
$categoryplan->time=$sunday;
$categoryplan->save();
}
}


if(isset($request->mond)){
foreach ($request->mond as $monday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='monday';
$categoryplan->doweek='3';
$categoryplan->time=$monday;
$categoryplan->save();
}
}




if(isset($request->tues)){
foreach ($request->tues as $tuesday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='tuesday';
$categoryplan->doweek='4';
$categoryplan->time=$tuesday;
$categoryplan->save();
}
}



if(isset($request->wedn)){
foreach ($request->wedn as $wednesday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='wednesday';
$categoryplan->doweek='5';
$categoryplan->time=$wednesday;
$categoryplan->save();
}
}




if(isset($request->thurs)){
foreach ($request->thurs as $thursday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='thursday';
$categoryplan->doweek='6';
$categoryplan->time=$thursday;
$categoryplan->save();
}
}





if(isset($request->frid)){
foreach ($request->frid as $friday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='friday';
$categoryplan->doweek='7';
$categoryplan->time=$friday;
$categoryplan->save();
}
}



if(isset($request->satur)){
foreach ($request->satur as $saturday) {
$categoryplan=new CategoryPlans();
$categoryplan->category_id=$categryid;
$categoryplan->day='saturday';
$categoryplan->doweek='1';
$categoryplan->time=$saturday;
$categoryplan->save();
}
}

return redirect('/my_categories');
    }


  public function mycat(){
     $categories = Category::with('CategoryPlans')->where('user_id', Auth::guard('AppUsers')->user()->id)->get();
     return view('home.mycat',compact('categories'));    
    }




public function editcategory($id){  
     $category = DB::table('categories')->where('id', $id)->first();
     return view('home.editcat',compact('category'));    
}


public function updatecategory(Request $request,$id){    
    
if($request->sun){
$sun=implode($request->sun, '|');
}else{
 $sun='';
}
if($request->mond){
$mond=implode($request->mond, '|');
}else{
 $mond='';
}

if($request->tues){
$tues=implode($request->tues, '|');
}else{
 $tues='';
}

if($request->wedn){
$wedn=implode($request->wedn, '|');
}else{
 $wedn='';
}

if($request->thurs){
$thurs=implode($request->thurs, '|');
}else{
 $thurs='';
}

if($request->frid){
$frid=implode($request->frid, '|');
}else{
 $frid='';
}
if($request->satur){
$satur=implode($request->satur, '|');
}else{
 $satur='';
}

DB::table('categories')->where('id', $id)->update([
        'name' => $request->postcategry,
        'sunday' => $sun,
        'monday' => $mond,
        'tuesday' => $tues,
        'wednesday' => $wedn,
        'thursday' => $thurs,
        'friday' => $frid,
        'saturday' => $satur,
  ]);
   return Redirect::back();
    }


public function deletecategory($id){  
DB::table('categories')->where('id', '=', $id)->delete();
   return Redirect::back();
}









    public function profilePost(Request $request){

        $data=$request->input();

        $allow=[

            'country_id'=>'required',

            'time_zone'=>'required',

            'name'=>'required',

            'phone'=>'required|unique:app_users,phone,'.Auth::guard('AppUsers')->user()->id,

            'old_password'=>'required',

            'confirm_password'=>'same:confirm_password',

        ];

        $validator = Validator::make($request->all(),$allow);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput();

        }else{

            if(Hash::check($data['old_password'],Auth::guard('AppUsers')->user()->password)){

                if(!empty($data['new_password'])){

                    $validator = Validator::make($request->all(),

                        array(

                            'new_password'=>'required|min:6',

                            'confirm_password'=>'required|same:new_password',

                        ));

                    if ($validator->fails()) {

                        return redirect()->back()->withErrors($validator->errors())->withInput();

                    }else {

                        Auth::guard('AppUsers')->user()->password=Hash::make($data['password']);

                    }

                }

                if(Input::hasFile('image')){

                    $validator = Validator::make($request->all(),array(

                        'image' => 'required|mimes:jpeg,bmp,png'

                    ));

                    if ($validator->fails()) {

                        return redirect()->back()->withErrors($validator->errors())->withInput();

                    }else{

                        if(file_exists(public_path().Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img)&&!empty(Auth::guard('AppUsers')->user()->img_dir)){

                            unlink(public_path().Auth::guard('AppUsers')->user()->img_dir.Auth::guard('AppUsers')->user()->img);

                        }

                        if(file_exists(public_path().Auth::guard('AppUsers')->user()->img_dir.'thumbnail/thumbnail_'.Auth::guard('AppUsers')->user()->img)&&!empty(Auth::guard('AppUsers')->user()->img_dir)){

                            unlink(public_path().Auth::guard('AppUsers')->user()->img_dir.'thumbnail/thumbnail_'.Auth::guard('AppUsers')->user()->img);

                        }

                        $file=$request->file('image');

                        $image=FileImage($file,'app_users');

                        Auth::guard('AppUsers')->user()->img=$image['img'];

                        Auth::guard('AppUsers')->user()->img_dir=$image['img_dir'];

                    }

                }

                Auth::guard('AppUsers')->user()->country_id=$data['country_id'];

                Auth::guard('AppUsers')->user()->time_zone=$data['time_zone'];

                Auth::guard('AppUsers')->user()->name=$data['name'];

                Auth::guard('AppUsers')->user()->phone=$data['phone'];

                if(Auth::guard('AppUsers')->user()->save()){

                    Session::flash('success', Lang::get('home.update'));

                    return Redirect::to('user/profile');

                }

            }else{

                return redirect()->back()->withErrors([Lang::get('home.wrong_password_message')])->withInput();

            }

        }

    }

    public function timeZone(Request $request){

        $data=$request->input();

        if(isset($data['country_id'])){

            $country=Countries::find($data['country_id']);

            if(count($country)){

                $timeZones=TimeZone::where('country_code',$country->iso)->get();

                $html='';

                foreach($timeZones as $timeZone){

                    $html.='<option '.((isset($data['selected'])&&$data['selected']==$timeZone->zone_name)?'selected="selected"':'').' value="'.$timeZone->zone_name.'">'.$timeZone->zone_name.'</option>';

                }

                return response()->json(['message'=>Lang::get('home.success'),'success'=>true,'html'=>$html])->setCallback($request->input('callback'));

            }else{

                return $this->noData();

            }

        }else{

            return $this->noData();

        }

    }



    public function termsAndConditions(){

        return view('home.terms_and_conditions');

    }

    public function support(){

        return view('home.support');

    }

    public function privacy(){

        return view('home.privacy');

    }

    public function socialLogin($type){

        if(in_array($type,['facebook','google','linkedin','twitter'])){

            try{

                return Socialite::driver($type)->redirect();

            }catch (InvalidArgumentException $e){

                dd($e);

                //return $this->noData();

            }catch(CredentialsException $e){

                dd($e);

                //return $this->noData();

            }catch(\ErrorException $e){

                dd($e);

                //return Redirect::to('/');

            }

        }else{

            return $this->noData();

        }



    }

    public function socialLoginCallback($type,Request $request){

        if(in_array($type,['facebook','google','linkedin','twitter'])){

            try{

                $user = Socialite::driver($type)->user();

                $email=($user->email==null)?$user->id.'@'.$type.'.com':$user->email;

                $appUser=AppUsers::withTrashed()->where('email',$email)->first();

                if(!count($appUser)){

                   $appUser=new AppUsers();

                    $appUser->uniqid=uniqid('',true);

                    $appUser->name=$user->name;

                    $appUser->email=$email;

                    $appUser->token=$user->token;

                    $appUser->expiresIn=(isset($user->expiresIn))?$user->expiresIn:'';

                    $appUser->register_social_id=$user->id;

                    $appUser->register_type=$type;

                    $appUser->country_id=64;

                    $appUser->save();

                    Session::put('userSocialData',$user);

                    Session::put('userSocialType',$type);

                    Session::put('error',Lang::get('home.error_not_active_account_message'));

                    return Redirect::to('/login');

                }

                Session::forget('userSocialData');

                Session::forget('userSocialType');

                $appUser->token=$user->token;

                $appUser->expiresIn=(isset($user->expiresIn))?$user->expiresIn:'';

                $appUser->save();

                if($appUser->active==1){

                    if($appUser->deleted_at==null){

                        Auth::guard('AppUsers')->loginUsingId($appUser->id);

                        $appUser->last_login_type=$type;

                        $appUser->last_login_date=date('Y-m-d H:i:s');

                        $appUser->last_login_social_id=$user->id;

                        $appUser->save();

                        return Redirect::to('/');

                    }else{

                        Session::flash('error',Lang::get('home.error_deleted_account_message'));

                        return Redirect::to('/login');

                    }

                }else{

                    Session::flash('error',Lang::get('home.error_not_active_account_message'));

                    return Redirect::to('/login');

                }

            }catch (InvalidArgumentException $e){

                dd($e);

                //return $this->noData();

            }catch (ClientException $e){

                dd($e);

                //return $this->noData();

            }catch(CredentialsException $e){

                dd($e);

                //return $this->noData();

            }catch(InvalidStateException $e){

                dd($e);

                //return $this->noData();

            }catch(\ErrorException $e){

                dd($e);

                //return Redirect::to('/');

            }

        }else{

            return $this->noData();

        }

    }

    public function logout(){

        Auth::guard('AppUsers')->logout();

        return Redirect::to('/');

    }


 public function scheduledposts(){

$userposts=AppUsersPosts::where([
    ['app_user_id', '=', Auth::guard('AppUsers')->user()->id],
    ['publish', '=', '0'],
])
->get();
        
return view('home.scheduled_posts',compact('userposts'));


}


    public function publisher(){

$userposts=AppUsersPosts::where([
    ['app_user_id', '=', Auth::guard('AppUsers')->user()->id],
    ['publish', '=', '0'],
])
->get();
    $userPages=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->get();
    $resources=Resources::where('app_user_id',Auth::guard('AppUsers')->user()->id)->orderBy('id','DESC')->get();
    $categories=Category::where('user_id', '=', Auth::guard('AppUsers')->user()->id)->orderBy('id','DESC')->get();


    return view('home.publisher',compact('userPages','resources','userposts','categories'));
    }

    public function schedule(){

        $posts=AppUsersPosts::select('app_users_posts.*','app_users_pages.page_name','app_users_pages.page_image_url')->join('app_users_pages','app_users_pages.id','=','app_users_posts.app_user_page_id')->where('app_users_posts.app_user_id',Auth::guard('AppUsers')->user()->id)->where('app_users_posts.created_time','!=','')->orderBy('app_users_posts.created_time')->where('app_users_posts.posted_from','app')->get();

        //dd($posts);

        return view('home.schedule',compact('posts'));

    }

    public function addNewProfile(Request $request){

        $data=$request->input();

        $json=json_decode($data['data']);

        $appUsersProfiles=[];

        foreach($json as $item){

            if(!in_array($item->type,['facebook','twitter','google','instagram','linkedin','youtube'])){

                return response()->json(['message'=>Lang::get('home.failed'),'success'=>false])->setCallback($request->input('callback'));

                break;

            }

            switch($item->type){

                case 'facebook':

                    $appUsersProfile=AppUsersProfiles::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('profile_id',$data['userID'])->first();

                    if(count($appUsersProfile)){

                        $appUsersPage=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$item->id)->get();

                        if(!count($appUsersPage)){

                            $appUsersProfiles[]=[

                                'app_user_id'=>Auth::guard('AppUsers')->user()->id,

                                'app_user_profile_id'=>$appUsersProfile->id,

                                'profile_id'=>$appUsersProfile->profile_id,

                                'page_id'=>$item->id,

                                'page_name'=>$item->name,

                                'page_image_url'=>$item->image_url,

                                'page_access_token'=>$item->page_access_token,

                                'oauth_token'=>$data['accessToken'],

                                'oauth_token_secret'=>$data['accessTokenSecret'],

                                'user_id'=>$data['userID'],

                                'expired_in'=>$data['expiresIn'],

                                'type'=>$item->type,

                                'add_date'=>date('Y-m-d H:i:s'),

                                'created_at'=>date('Y-m-d H:i:s'),

                                'updated_at'=>date('Y-m-d H:i:s'),

                            ];

                        }

                    }

                    break;

                case 'twitter':

                    $appUsersPage=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$item->id)->get();



                    if(!count($appUsersPage)){

                        $appUsersProfiles[]=[

                            'app_user_id'=>Auth::guard('AppUsers')->user()->id,

                            'app_user_profile_id'=>0,

                            'profile_id'=>$item->id,

                            'page_id'=>$item->id,

                            'page_name'=>$item->name,

                            'page_image_url'=>$item->image_url,

                            'oauth_token'=>$data['accessToken'],

                            'oauth_token_secret'=>$data['accessTokenSecret'],

                            'user_id'=>$data['userID'],

                            'expired_in'=>$data['expiresIn'],

                            'type'=>$item->type,

                            'add_date'=>date('Y-m-d H:i:s'),

                            'created_at'=>date('Y-m-d H:i:s'),

                            'updated_at'=>date('Y-m-d H:i:s'),

                        ];

                    }

                    break;

                case 'youtube':

    $appUserProfile=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$item->id)->get();
            if(!count($appUserProfile)){
                $appUsersProfiles[]=[
                    'app_user_id'=>Auth::guard('AppUsers')->user()->id,
                    'page_id'=>$item->id,
                    'page_name'=>$item->name,
                    'page_image_url'=>$item->image_url,
                    'oauth_token'=>$data['accessToken'],
                    'oauth_token_secret'=>$data['accessTokenSecret'],
                    'user_id'=>$data['userID'],
                    'expired_in'=>$data['expiresIn'],
                    'type'=>$item->type,
                    'add_date'=>date('Y-m-d H:i:s'),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                ];
            }








              break;



                default:

                    $appUsersPage=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$item->id)->get();

                    if(!count($appUsersPage)){

                        $appUsersProfiles[]=[

                            'app_user_id'=>Auth::guard('AppUsers')->user()->id,

                            'app_user_profile_id'=>$appUsersProfile->id,

                            'profile_id'=>$appUsersProfile->profile_id,

                            'page_id'=>$item->id,

                            'page_name'=>$item->name,

                            'page_image_url'=>$item->image_url,

                            'page_access_token'=>$item->page_access_token,

                            'oauth_token'=>$data['accessToken'],

                            'oauth_token_secret'=>$data['accessTokenSecret'],

                            'user_id'=>$data['userID'],

                            'expired_in'=>$data['expiresIn'],

                            'type'=>$item->type,

                            'add_date'=>date('Y-m-d H:i:s'),

                            'created_at'=>date('Y-m-d H:i:s'),

                            'updated_at'=>date('Y-m-d H:i:s'),

                        ];

                    }

                    break;

            }



        }

        AppUsersPages::insert($appUsersProfiles);

        return response()->json(['message'=>Lang::get('home.success'),'success'=>true])->setCallback($request->input('callback'));



    }

    public function searchProfile(Request $request){

        $html='';

        $search=$request->input('search');

        $userProfiles=AppUsersPages::where('page_name','LIKE',"%$search%")->where('app_user_id',Auth::guard('AppUsers')->user()->id)->get();

        foreach($userProfiles as $profile){

            $html.='<div class="col-lg-12"><div class="checkbox"><label><input type="checkbox" class="userProfiles" data-name="'.$profile->page_name.'" data-type="'.$profile->type.'" data-image="'.$profile->page_image_url.'" value="'.$profile->page_id.'" id=""><img src="'.$profile->page_image_url.'" alt="'.$profile->page_name.'"><span>'.$profile->page_name.'</span></label></div></div>';

        }

        return response()->json(['message'=>Lang::get('home.success'),'success'=>true,'html'=>$html])->setCallback($request->input('callback'));

    }

  


//update publish ------------ islam -----------

public function updatepost(Request $request,$id){

AppUsersPosts::where('id', $id)->update(['publish' => 1, 'post_id' => $request->post_id , 'resource_id' => $request->resource_id]);

}





    public function addPost(Request $request){

        $data=$request->input();

        $validator = Validator::make($request->all(),

            array(

                'page_id'=>'required',

                'resource_id'=>'required',

                'post_id'=>'required',

                'message'=>'required',

                'publish'=>'required',

                'scheduleDateTime'=>'required',

            ));

        if ($validator->fails()) {

            $messages='<ul>';

            foreach($validator->errors()->all() as $err){

                $messages.='<li>'.$err.'</li>';

            }

            $messages.='</ul>';

            return response()->json(['message'=>$messages,'success'=>false])->setCallback($request->input('callback'));

        }else {



            $appPosts=AppUsersPosts::where('user_id',Auth::guard('AppUsers')->user()->id)->where('category_id',$data['category_id'])->get();

            


            $appcategory=CategoryPlans::select('time')->where('category_id',$data['category_id'])->lists('time')->toArray();



            $appUserPage=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$data['page_id'])->get();




if(count($appPosts)){

    $last_post=end($appPosts);
    $lastt_post=$last_post->created_time;
    $key = array_search($lastt_post, $appcategory);


if(isset($appcategory[$key+1]))
    $scheduledpost=$appcategory[$key+1]; 

}else{
$scheduledpost=$appcategory[0];
}



            if(count($appUserPage)){

                $appUserPosts=new AppUsersPosts();

                $appUserPosts->app_user_id=$appUserPage->app_user_id;

                $appUserPosts->app_user_page_id=$appUserPage->id;

                $appUserPosts->profile_id=$appUserPage->app_user_profile_id;

                $appUserPosts->publish=$data['publish'];

                $appUserPosts->page_id=$data['page_id'];

                $appUserPosts->post_id=$data['post_id'];

                $appUserPosts->resource_id=$data['resource_id'];

                $appUserPosts->message=$data['message'];


                $appUserPosts->category_id=$data['category_id'];
                //dd(date('Y-m-d H:i:s',((1511611379)+(120*59)-59)));

                $appUserPosts->created_time=($data['scheduleDateTime'])?$data['scheduleDateTime']:'';

                $appUserPosts->add_by=Auth::guard('AppUsers')->user()->id;

                $appUserPosts->add_date=date('Y-m-d H:i:s');

                if($appUserPosts->save()){

                    return response()->json(['message'=>Lang::get('home.success'),'success'=>true])->setCallback($request->input('callback'));

                }
            }
        }



    }

    public function uploadPhotos(Request $request){

        $validator = Validator::make($request->all(),

            array(

                'file'=>'required|mimes:jpeg,bmp,png',

            ));

        if ($validator->fails()) {

            return Response::make($validator->errors->first(), 400);

        }else{

            $file=$request->file('file');

            $image=FileImage($file,'resources','file');

            $resources=new Resources();

            $resources->app_user_id=Auth::guard('AppUsers')->user()->id;

            $resources->resource_dir=$image['img_dir'];

            $resources->resource=$image['img'];

            $resources->add_date=date('Y-m-d H:i:s');

            if( $resources->save() ) {

                $html='<div class="col-lg-4 resource-item " id="resource-'.$resources->id.'"><div  class="active-resource"><button type="button" data-id="'.$resources->id.'" class="close remove-image">&times;</button><img data-id="'.$resources->id.'" src="'.asset($resources->resource_dir.$resources->resource).'" alt=""></div></div>';

                return response()->json(['message'=>Lang::get('home.success'),'success'=>true,'imageID'=>$resources->id,'html'=>$html])->setCallback($request->input('callback'));

            } else {

                return Response::json('error', 400);

            }

        }

    }

    public function removePhoto(Request $request){

        $data=$request->input();

        if(isset($data['photo_id'])){

            $photo_id=$data['photo_id'];

            $resource=Resources::where('app_user_id',Auth::guard('AppUsers')->user()->id)->find($photo_id);

            if(count($resource)){

                $resource->delete();

                return response()->json(['message'=>Lang::get('home.success'),'success'=>true])->setCallback($request->input('callback'));

            }else{

                return response()->json(['message'=>Lang::get('home.failed'),'success'=>false])->setCallback($request->input('callback'));

            }

        }

    }

    public function jsCallback(){

        return view('home.js_callback');

    }

    public function singlePost($page_id,$post_id){

        $profiles=AppUsersPages::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('page_id',$page_id)->first();

        if(count($profiles)){

            return view('home.single_post',compact('page_id','post_id'));

        }else{

            return $this->noData();

        }

    }

    public function addProfilePosts(Request $request){

        $data=$request->input();

        $jsonData=json_decode($data['data']);

        if($data['type']=='facebook'){

            $page=AppUsersPages::where('page_id',$data['page_id'])->where('app_user_id',Auth::guard('AppUsers')->user()->id)->first();

            if(count($page)){

                if(isset($jsonData->data)){

                    foreach($jsonData->data as $post){
                        $appUserPost=AppUsersPosts::where('post_id',$post->id)->first();
                        if(!count($appUserPost)){
                            $appUserPost=new AppUsersPosts();
                        }

                            $appUserPost->app_user_page_id=$page->id;

                            $appUserPost->profile_id=$page->profile_id;

                            $appUserPost->page_id=$page->page_id;

                            $appUserPost->post_id=$post->id;

                            $appUserPost->message=isset($post->message)?$post->message:'';

                            $appUserPost->link=isset($post->link)?$post->link:'';

                            $appUserPost->name=isset($post->name)?$post->name:'';

                            $appUserPost->picture=isset($post->picture)?$post->picture:'';

                            $appUserPost->status_type=isset($post->status_type)?$post->status_type:'';

                            $appUserPost->story=isset($post->story)?$post->story:'';

                            $appUserPost->publish=1;

                            $appUserPost->posted_from='social';

                            $appUserPost->comments_count=$post->comments->summary->total_count;

                            $appUserPost->likes_count=$post->likes->summary->total_count;

                            $appUserPost->share_count=(isset($post->shares))?$post->shares->count-1:0;

                            $appUserPost->created_time=(isset($post->created_time))?$post->created_time:'';

                            $appUserPost->from_id=(isset($post->from->id))?$post->from->id:'';

                            $appUserPost->from_name=(isset($post->from->name))?$post->from->name:'';

                            $appUserPost->from_picture=(isset($post->from->picture->data->url))?$post->from->picture->data->url:'';

                            $appUserPost->save();

                            foreach($post->comments->data as $comment){

                                $appUserPostComments=AppUsersPostsComments::where('comment_id',$comment->id)->first();

                                if(!count($appUserPostComments)){

                                    $appUserPostComments=new AppUsersPostsComments();

                                }

                                $appUserPostComments->app_user_post_id=$appUserPost->id;

                                $appUserPostComments->profile_id=$appUserPost->profile_id;

                                $appUserPostComments->post_id=$appUserPost->post_id;

                                $appUserPostComments->page_id=$appUserPost->page_id;

                                $appUserPostComments->comment_id=$comment->id;

                                $appUserPostComments->like_count=$comment->like_count;

                                $appUserPostComments->comment_count=$comment->comment_count;

                                $appUserPostComments->message=$comment->message;

                                $appUserPostComments->from_id=$comment->from->id;

                                $appUserPostComments->from_name=$comment->from->name;

                                $appUserPostComments->from_picture=$comment->from->picture->data->url;

                                $appUserPostComments->created_time=$comment->created_time;

                                $appUserPostComments->save();

                            }

                            foreach($post->likes->data as $like){

                                $appUserPostLikes=AppUsersPostsLikes::where('from_id',$like->id)->where('post_id',$appUserPost->post_id)->first();

                                if(!count($appUserPostLikes)){

                                    $appUserPostLikes=new AppUsersPostsLikes();

                                }

                                $appUserPostLikes->app_user_post_id=$appUserPost->id;

                                $appUserPostLikes->profile_id=$appUserPost->profile_id;

                                $appUserPostLikes->post_id=$appUserPost->post_id;

                                $appUserPostLikes->page_id=$appUserPost->page_id;

                                $appUserPostLikes->from_id=$like->id;

                                $appUserPostLikes->from_name=$like->name;

                                $appUserPostLikes->from_link=$like->link;

                                $appUserPostLikes->from_picture=$like->picture->data->url;

                                $appUserPostLikes->from_pic_large=$like->pic_large;

                                $appUserPostLikes->from_pic_small=$like->pic_small;

                                $appUserPostLikes->save();

                            }
                    }

                    return response()->json(['message'=>Lang::get('home.success'),'success'=>true])->setCallback($request->input('callback'));

                }

            }
        }



    }

    public function saveAccessToken(Request $request){

        $data=$request->input();

        $validator = Validator::make($request->all(),

            array(

                'profile_id'=>'required',

               /* 'name'=>'required',

                'first_name'=>'required',

                'last_name'=>'required',*/

                /*'middle_name'=>'required',*/

                /*'email'=>'required',

                'birthday'=>'required',*/

                /*'political'=>'required',

                'quotes'=>'required',

                'relationship_status'=>'required',

                'religion'=>'required',

                'updated_time'=>'required',

                'website'=>'required',

                'link'=>'required',

                'gender'=>'required',*/

                'accessToken'=>'required',

            ));

        if ($validator->fails()) {

            $message='<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul>';

            foreach($validator->errors()->all() as $error){

                $message.='<li>'.$error.'</li>';

            }

            $message.='</ul></div>';

            return response()->json(['message'=>$message,'success'=>false,])->setCallback($request->input('callback'));

        }else {

            $profiles=AppUsersProfiles::where('app_user_id',Auth::guard('AppUsers')->user()->id)->where('profile_id',$data['profile_id'])->first();

            if(!count($profiles)){

                $profiles=new AppUsersProfiles();

            }

            $profiles->app_user_id=Auth::guard('AppUsers')->user()->id;

            $profiles->profile_id=$data['profile_id'];

            $profiles->name=isset($data['name'])?$data['name']:'';

            $profiles->first_name=isset($data['first_name'])?$data['first_name']:'';

            $profiles->middle_name=isset($data['middle_name'])?$data['middle_name']:'';

            $profiles->last_name=isset($data['last_name'])?$data['last_name']:'';

            $profiles->email=isset($data['email'])?$data['email']:'';

            $profiles->birthday=isset($data['birthday'])?$data['birthday']:'';

            $profiles->political=isset($data['political'])?$data['political']:'';

            $profiles->quotes=isset($data['quotes'])?$data['quotes']:'';

            $profiles->about=isset($data['about'])?$data['about']:'';

            $profiles->relationship_status=isset($data['relationship_status'])?$data['relationship_status']:'';

            $profiles->religion=isset($data['religion'])?$data['religion']:'';

            $profiles->updated_time=$data['updated_time'];

            $profiles->website=isset($data['website'])?$data['website']:'';

            $profiles->link=isset($data['link'])?$data['link']:'';

            $profiles->gender=isset($data['gender'])?$data['gender']:'';

            $profiles->accessToken=$data['accessToken'];

            $profiles->add_date=date('Y-m-d H:i:s');

            if($profiles->save()){

                return response()->json(['message'=>Lang::get('home.success'),'success'=>true])->setCallback($request->input('callback'));

            }



        }

    }





}

