<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersPages;
use App\Http\Requests\uploadcsvFacebookRequest;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Category;

class twitterController extends Controller
{

    public function getaccesstoken($page_id){

        $tokens=array();
        $accesstoken=  AppUsersPages::latest()->where('type','twitter')->where('page_id',$page_id)->limit(1)->get();
        $tokens = array('oauth_token' => $accesstoken->get(0)->oauth_token, 'oauth_token_secret' =>$accesstoken->get(0)->oauth_token_secret);
        return json_encode($tokens);
    }
    /**
     * @param uploadcsvFacebookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */

    public function csvPage() {
        //dd(Auth::guard('AppUsers')->user()->id);
        $pages = AppUsersPages::latest()->where('app_user_id', Auth::guard('AppUsers')->user()->id)->get();
//dd($pages);
        $records = Category::latest()->where('user_id', Auth::guard('AppUsers')->user()->id)->pluck('name', 'id');
        // dd($records);
        return view('home.csvupload_twitter', compact('records', 'pages'));
    }

    public function import(uploadcsvFacebookRequest $request) {
        echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        echo'<script>var URL="' . URL('') . '"</script>';
        $input = $request->all();
        //  dd($input['_token']);
      //  $AppUsersPosts = new AppUsersPosts();
        $flag=0;
        if (!is_null(Input::file('csv_file'))) {
            //if success return filename as String  if fail return false (function in helper.php )
            $csv_file = uploadFile('csv_file', public_path() . '/upload');
            if (gettype($csv_file) == 'string') {
                $input['csv_file'] = $csv_file;
                $posts_from_file = csvToArray(public_path() . '/upload/' . $csv_file);
                if ($posts_from_file != false) {
                    for ($i = 0; $i < count($posts_from_file); $i++) {

                        if (isset($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && isset($posts_from_file[$i]['picture']) && !empty($posts_from_file[$i]['created_time']) && isset($posts_from_file[$i]['created_time']) && $input['date_time'] == '1') {
                            $flag+=1;
                        } if (isset($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && isset($posts_from_file[$i]['picture']) && $input['date_time'] == '0' && isset($input['category_id']) && !empty($input['category_id'])) {
                            $flag += 1;
                        }
                    }//end for
                } else {
                    return redirect('/twitter_csv')->with('fail', 'Not Complete data in file!');
                }
            } else {
                return redirect('/twitter_csv')->with('fail', 'file not upload!');
            }
        } else {
            return redirect('/twitter_csv')->with('fail', 'file is required!');
        }
        for ($i = 0; $i < count($posts_from_file); $i++) {
            if ($flag == count($posts_from_file) && $input['date_time'] == '1') {
                // TIME BASED
                echo '<script type="text/javascript" src="/js/addPostAddDatabase.js"></script><script>
// addPostToDataBase(page_id, message, publish, scheduleDateTime, post_id, resource_id, picture_url, token)

addPostToDataBase("'.$input['page_id'].'","'.$posts_from_file[$i]['message'].'","0","'.$posts_from_file[$i]['created_time'].'","0","0","' . $posts_from_file[$i]['picture'] . '","'.$input['_token'].'","","/twitter_csv?submit=1","/twitter_csv?submit=0");
                        </script>';
            } elseif ($flag == count($posts_from_file) && $input['date_time'] == '0') {
                /*dump($input['page_id']);
                dump($posts_from_file[$i]['message']);
                dump($input['category_id']);
                dd($input['_token']);*/
                echo '<script type="text/javascript" src="/js/addPostAddDatabase.js"></script><script>
// addPostToDataBase(page_id, message, publish, scheduleDateTime, post_id, resource_id, picture_url, token) 0000-0-00 00:00

                        addPostToDataBase("'.$input['page_id'].'","'.$posts_from_file[$i]['message'].'","0","0000-0-00 00:00","0","0","' . $posts_from_file[$i]['picture'] . '","'.$input['_token'].'","' . $input['category_id'] . '","/twitter_csv?submit=1","/twitter_csv?submit=0");
//                        </script>';
            } else {
                return redirect('/twitter_csv')->with('fail', 'Not Complete data in file!');
            }
        }
    }
}
