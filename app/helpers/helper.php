<?phpfunction convertToDateTimeLocal($date){    return (!empty($date)&&$date!='0000-00-00 00:00:00')?date("Y-m-d",strtotime($date)).'T'.date("H:i:s",strtotime($date)):'';}function PerUser($val){    $UserPermissionsData=\Illuminate\Support\Facades\Request::get('UserPermissionsData');    return(isset($UserPermissionsData->$val)&&$UserPermissionsData->$val)?true:false;}function timeAgo ($time){    $time=strtotime($time);    $time = time() - $time; // to get the time since that moment    $time = ($time<1)? 1 : $time;    $tokens = array (        31536000 => 'year',        2592000 => 'month',        604800 => 'week',        86400 => 'day',        3600 => 'hour',        60 => 'minute',        1 => 'second'    );    foreach ($tokens as $unit => $text) {        if ($time < $unit) continue;        $numberOfUnits = floor($time / $unit);        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');    }}function makeDefaultImage($post,$name){    if(!(!empty($post->img_dir)&&!empty($post->img)&&file_exists(public_path($post->img_dir.$post->img)))){        $post->img_dir='/img/'.$name.'/';        $post->img='default_image.png';    }    return$post;}function userSystem(){    $system=\App\UsersSystems::where('user_id',Auth::user()->id)->first();    if(!count($system)){        $system=new \App\UsersSystems();        $system->user_id=Auth::user()->id;        $system->backend_lang='en';        $system->save();    }    return$system;}function getUserSystem($pars){    $userSystemData=\Illuminate\Support\Facades\Request::get('UserSystem');    return (isset($userSystemData->$pars))?$userSystemData->$pars:'';}function byUser($user_id,$string=null){    $user=DB::table('users')->where('id',$user_id)->first();    if(count($user)){        if($user->img_dir==''||$user->img==''){            $user->img_dir='img/Users/';            $user->img='default_user.png';        }        return'<div class="zoom_img"><img class="img-polaroid " src="'.asset($user->img_dir.$user->img).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$string.$user->name.'"></div>';    }    return Lang::get('main.no_image');}function byAppUser($user_id,$string=null){    $user=\App\AppUsers::find($user_id);    if(count($user)){        if($user->img_dir==''&&$user->img==''){            $user->img_dir='img/Users/';            $user->img='default_user.png';        }        return'<div class="zoom_img"><img class="img-polaroid " src="'.asset($user->img_dir.$user->img).'" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$string.' { '.Lang::get('main.'.$user->type).' } '.$user->name.'"></div>';    }    return Lang::get('main.no_image');}function FileImage($file,$folder_name,$input_name='image'){    $path = '/img/'.$folder_name.'/' . date('Y/m/d').'/';    if (!file_exists(public_path() . $path)) {        File::makeDirectory(public_path() . $path, $mode = 0777, true, true);    }    if (!file_exists(public_path() . $path.'thumbnail')) {        File::makeDirectory(public_path() . $path.'thumbnail', $mode = 0777, true, true);    }    //file new name    $namefile = $folder_name.'_' . rand(0000, 9999) . '_' . time();    //file extension    $ext = $file->getClientOriginalExtension();    //file old name    $old_name = $file->getClientOriginalName();    //convert the size of the file    //$size = ImageUploader::GetSize($file->getSize());    //get the mime type of the file    $mimtype = $file->getMimeType();    //making the new name with extension    $mastername = $namefile . '.' . $ext;    list($width, $height, $type, $attr) = getimagesize($_FILES[$input_name]['tmp_name']);    $width_per=round(($width*10)/100);    $height_per=round(($height*10)/100);    $file->move(public_path() . $path, $mastername);    Image::make(public_path() . $path  . $mastername, array(        'width' => $width_per,        'height' => $height_per,    ))->save(public_path() . $path . 'thumbnail/thumbnail_' . $mastername);    return array('img'=>$mastername,'img_dir'=>$path);}function FileImages($file,$folder_name,$x,$input_name='images'){    $path = '/img/'.$folder_name.'/' . date('Y/m/d').'/';    if (!file_exists(public_path() . $path)) {        File::makeDirectory(public_path() . $path, $mode = 0777, true, true);    }    if (!file_exists(public_path() . $path.'thumbnail')) {        File::makeDirectory(public_path() . $path.'thumbnail', $mode = 0777, true, true);    }    //file new name    $namefile = $folder_name.'_' . rand(0000, 9999) . '_' . time();    //file extension    $ext = $file->getClientOriginalExtension();    //file old name    $old_name = $file->getClientOriginalName();    //convert the size of the file    //$size = ImageUploader::GetSize($file->getSize());    //get the mime type of the file    $mimtype = $file->getMimeType();    //making the new name with extension    $mastername = $namefile . '.' . $ext;    list($width, $height, $type, $attr) = getimagesize($_FILES[$input_name]['tmp_name'][$x]);    $width_per=round(($width*10)/100);    $height_per=round(($height*10)/100);    $file->move(public_path() . $path, $mastername);    switch($folder_name){        case'hotels':            $imagesResize=[                0=>['width'=>60,'height'=>60],                1=>['width'=>260,'height'=>180],                2=>['width'=>400,'height'=>200],            ];            break;        case'flights':            $imagesResize=[                0=>['width'=>60,'height'=>60],                1=>['width'=>260,'height'=>180],                2=>['width'=>400,'height'=>200],            ];            break;        default:            $imagesResize=[];            break;    }    foreach($imagesResize as $imageSize){        $widthS=$imageSize['width'];        $heightS=$imageSize['height'];        Image::make(public_path() . $path  . $mastername, array(            'width' => $widthS,            'height' => $heightS,        ))->save(public_path() . $path . 'thumbnail/'.$widthS.'_'.$heightS.'_' . $mastername);    }    Image::make(public_path() . $path  . $mastername, array(        'width' => $width_per,        'height' => $height_per,    ))->save(public_path() . $path . 'thumbnail/thumbnail_' . $mastername);    return array('img'=>$mastername,'img_dir'=>$path);}function tableCount($table){    if(Schema::hasTable($table)){        $section=DB::table($table)->count();        return $section;    }    return 0;}function getDaysName(){    $timestamp = strtotime('next Sunday');    $days = array();    for ($i = 0; $i < 7; $i++) {        $days[] = strtolower(strftime('%A', $timestamp));        $timestamp = strtotime('+1 day', $timestamp);    }    return$days;}function hasShowLink($user_id,$product_id){    $hasLink=\App\AppUserViewProductLinks::where('app_user_id',$user_id)->where('product_id',$product_id)->first();    if(count($hasLink)){        return ['statues'=>$hasLink->approved];    }    return false;}function sendsms($mobile,$message){    $data=array('access_token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0b2tlbiI6IjJlYzQ0YTY0MTkxZDc1MTNkMjdkNTM1MDhlNDU4NGY5OGZmOTM3YWJjNDcyOTliZDFjMzM3YjI1OWI1YmExODZjMTBhMzM3OGI5ZGJmZjJhZWMxMTRlYzg0MTY1ZTNmYmZkZGM1NTNmYjRiZmQzYzU2Y2I0ZDUxNWMxZTQ3ODgxYmUwNTc5ZGJmZmQxOTczMGM5ZDBmYzI4MzI1MTJiNTgiLCJpYXQiOjE0OTQ0MjM0Mjh9.mfdxxjQaxXgRwM51Wa3rCPe3SoiCkibAqH744j6NWp4',        'senderName' => 'E3mel.BSNS', 'recipients' => "$mobile",'messageType' => 'text',        'messageText' => "$message");    $url = "http://api.cequens.com/cequens/api/v1/messaging";    //$data=array("apiKey" => "20e2b5c6-d2cc-4ec8-b653-1cc48d232da4", "userName" =>"almoasher");    $content="";    foreach($data as $key=>$value) { $content .= $key.'='.$value.'&'; }    //echo $content;    $curl = curl_init($url);    //curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8"));    curl_setopt($curl, CURLOPT_HEADER, false);    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    curl_setopt($curl, CURLOPT_POST, true);    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);    $json_response = curl_exec($curl);    //echo $json_response;    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);    curl_close($curl);    return $json_response;    //  echo 'Transfer Record '. $data['id'].' Is '. $json_response.'<br>';    //$response = json_decode($json_response, true);    //echo $response['name'];    //var_dump($response);}function sendEmail($user,$subject,$smstemplate,$link,$emailTemplate='active'){    Mail::send('emails.'.$emailTemplate, ['user' => $user,'smstemplate'=>$smstemplate,'link'=>$link], function ($m) use ($user,$subject) {        $m->from('affiliate@app.com', 'affiliate Application');        $m->to($user->email, $user->name)->subject($subject);    });    return true;}function sendNotification($title,$smstemplate,$link){    $postData=[        'messageTitle'=>$title,        'messageImageURL'=>\Illuminate\Support\Facades\Config::get('app.notification_icon'),        'messageContent'=>$smstemplate,        'messageLink'=>$link,    ];    $enc=new \App\Helpers\APIEncryption();    return $enc->sendRequest($postData,'sendNotifications');}function makeRequestTo($url,$data){    $curl = curl_init(URL($url));    $content="";    foreach($data as $key=>$value) { $content .= $key.'='.$value.'&'; }    curl_setopt($curl, CURLOPT_HEADER, false);    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    curl_setopt($curl, CURLOPT_POST, true);    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);    $json_response = curl_exec($curl);    //echo $json_response;    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);    curl_close($curl);    return $json_response;}function sendAllReminder($product,$type){    switch($type){        case'new':            $title='تم أضافة عرض جديد';            $smstemplate='تم أضافة عرض '.$product->name;            $link=URL('product/'.$product->id);            break;        case'close':            $title='تم إغلاق العرض';            $smstemplate='تم إغلاق عرض '.$product->name;            $link=URL('product/'.$product->id);            break;        default:            return false;            break;    }    sendNotification($title,$smstemplate,$link);    makeRequestTo('affiliateAPI/addLogsNotifications',['product_id'=>$product->id,'smstemplate'=>$smstemplate,'link'=>$link,'title'=>$title]);    makeRequestTo('affiliateAPI/sendSMSEmail',['title'=>$title,'smstemplate'=>$smstemplate,'link'=>$link]);    return true;}