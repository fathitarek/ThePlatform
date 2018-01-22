<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\uploadcsvFacebookRequest;
use App\AppUsersPosts;
use Illuminate\Support\Facades\Input;
use App\Category;
use Auth;
use App\AppUsersPages;

class uploadcsvFacebookController extends Controller {
    /*  public function CheckNotEmpty($ckecked_object) {
      if (!empty($ckecked_object)){
      return true;
      }
      } */

    /*
     * Return view with categories
     */

    public function csvPage() {
        //dd(Auth::guard('AppUsers')->user()->id);
        $pages = AppUsersPages::latest()->where('app_user_id', Auth::guard('AppUsers')->user()->id)->get();
//dd($pages);
        $records = Category::latest()->where('user_id', Auth::guard('AppUsers')->user()->id)->pluck('name', 'id');
        // dd($records);
        return view('home.csvupload', compact('records', 'pages'));
    }

    /**
     * @param uploadcsvFacebookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function import(uploadcsvFacebookRequest $request) {
        echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        echo'<script>var URL="' . URL('') . '"</script>';
        $input = $request->all();
        //  dd($input['_token']);
        $AppUsersPosts = new AppUsersPosts();
$flag=0;
        if (!is_null(Input::file('csv_file'))) {
            //if success return filename as String  if fail return false (function in helper.php )
            $csv_file = uploadFile('csv_file', public_path() . '/upload');
            if (gettype($csv_file) == 'string') {
                $input['csv_file'] = $csv_file;
                $posts_from_file = csvToArray(public_path() . '/upload/' . $csv_file);
                if ($posts_from_file != false) {
                    //dd(count($posts_from_file));
                    for ($i = 0; $i < count($posts_from_file); $i++) {
                       // if($i==1){dd(empty($posts_from_file[$i]['message']));}

                        if (isset($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && isset($posts_from_file[$i]['picture']) && !empty($posts_from_file[$i]['created_time']) && isset($posts_from_file[$i]['created_time']) && $input['date_time'] == '1') {
                        $flag+=1;
//                            echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
//                        create_post("facebook","","' . $posts_from_file[$i]['created_time'] . '","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","","' . $input['_token'] . '","/facebook_csvFile?submit=1","/facebook_csvFile?submit=0");
//                        </script>';
                        } if (isset($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && isset($posts_from_file[$i]['picture']) && $input['date_time'] == '0' && isset($input['category_id']) && !empty($input['category_id'])) {
                            $flag += 1;
                        }
//                            echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
//                        create_post("facebook","","","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","' . $input['category_id'] . '","' . $input['_token'] . '","/facebook_csvFile?submit=1","/facebook_csvFile?submit=0");
//                        </script>';
//                        } else {
//                            //return redirect('/facebook_csvFile')->with('fail', 'Not Complete data in file!');
//                            echo'<script> window.location.href="/facebook_csvFile?submit=0;" </script>';
//                        }
                    }//end for
                } else {
                    return redirect('/facebook_csvFile')->with('fail', 'Not Complete data in file!');
                }
            } else {
                return redirect('/facebook_csvFile')->with('fail', 'file not upload!');
            }
        } else {
            return redirect('/facebook_csvFile')->with('fail', 'file is required!');
        }
        for ($i = 0; $i < count($posts_from_file); $i++) {
            if ($flag == count($posts_from_file) && $input['date_time'] == '1') {
                echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
                        create_post("facebook","","' . $posts_from_file[$i]['created_time'] . '","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","","' . $input['_token'] . '","/facebook_csvFile?submit=1","/facebook_csvFile?submit=0");
                        </script>';
            } elseif ($flag == count($posts_from_file) && $input['date_time'] == '0') {
                echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
//                        create_post("facebook","","","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","' . $input['category_id'] . '","' . $input['_token'] . '","/facebook_csvFile?submit=1","/facebook_csvFile?submit=0");
//                        </script>';
            } else {
                return redirect('/facebook_csvFile')->with('fail', 'Not Complete data in file!');
            }
        }
    }
}

