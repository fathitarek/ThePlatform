<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersPages;
class twitterController extends Controller
{

    public function getaccesstoken($page_id){

$tokens=array();
        $accesstoken=  AppUsersPages::latest()->where('type','twitter')->where('page_id',$page_id)->limit(1)->get();
       // $tokens->oauth_token=$accesstoken->get(0)->oauth_token;
       // $tokens->oauth_token_secret=$accesstoken->get(0)->oauth_token_secret;
        $tokens = array('oauth_token' => $accesstoken->get(0)->oauth_token, 'oauth_token_secret' =>$accesstoken->get(0)->oauth_token_secret);

        //dd($accesstoken) ;
        //return json_encode($tokens['oauth_token']);
        return json_encode($tokens);
       // dd($tokens['oauth_token']);
    }
}
