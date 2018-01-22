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
        $pages = AppUsersPages::latest()->where('app_user_id',Auth::guard('AppUsers')->user()->id)->get();
//dd($pages);
        $records = Category::latest()->where('user_id',Auth::guard('AppUsers')->user()->id)->pluck('name', 'id');
        // dd($records);
        return view('home.csvupload', compact('records','pages'));
    }

    /**
     * @param uploadcsvFacebookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function import(uploadcsvFacebookRequest $request) {
        echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        $input = $request->all();
       //  dd($input['_token']);
        $AppUsersPosts = new AppUsersPosts();

        if (!is_null(Input::file('csv_file'))) {
            //if success return filename as String  if fail return false (function in helper.php )
            $csv_file = uploadFile('csv_file', public_path() . '/upload');
            if (gettype($csv_file) == 'string') {
                $input['csv_file'] = $csv_file;
                $posts_from_file = csvToArray(public_path() . '/upload/' . $csv_file);
                for ($i = 0; $i < count($posts_from_file); $i++) {
                    if (!empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && !empty($posts_from_file[$i]['created_time']) && $input['date_time'] == '1') {
                        //create_post(page_type,scheduleDate,scheduleDateTime,picture_url,resource_id,page_id,message,categoryid)
//dd($posts_from_file[$i]['message']);
  //create_post(page_type,scheduleDate,scheduleDateTime,picture_url,resource_id,page_id,message,categoryid){

                        echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
                        create_post("facebook","","' . $posts_from_file[$i]['created_time'] . '","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","","' . $input['_token'] . '","/facebook_csvFile?submit=1");
</script>';

//                        \DB::table('app_users_posts')->insert(
//                                [['message' => $posts_from_file[$i]['message'],
//                                'created_time' => $posts_from_file[$i]['created_time'], 'picture' => $posts_from_file[$i]['picture'], 'app_user_id' => $input['app_user_id']]
//                        ]);
                    } elseif (!empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && $input['date_time'] == '0' && isset($input['category_id']) && !empty($input['category_id'])) {
//dd($input['category_id']);
                        echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
                        create_post("facebook","","","' . $posts_from_file[$i]['picture'] . '","0","' . $input['page_id'] . '","' . $posts_from_file[$i]['message'] . '","' . $input['category_id'] . '","' . $input['_token'] . '","/facebook_csvFile?submit=1");
                           
                        </script>';


//                        \DB::table('app_users_posts')->insert([
//                            ['message' => $posts_from_file[$i]['message'], 'picture' => $posts_from_file[$i]['picture'],
//                                'app_user_id' => $input['app_user_id']]
//                        ]);
                    } else {
                        return redirect('/facebook_csvFile')->with('fail', 'Not Complete data in file!');
                    }
                }//end for
            }
        } else {
            return redirect('/facebook_csvFile')->with('fail', 'file not updated!');
        }
       // echo '<script type="text/javascript"> window.location.href="/facebook_csvFile?submit=1"</script>';
        //return view('home.csvupload')->with('sucess', 'file updated!');
        //return $this->csvPage();
    }

}
