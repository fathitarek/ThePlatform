<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\uploadcsvFacebookRequest;
use App\AppUsersPosts;
use Illuminate\Support\Facades\Input;
use App\category;
class uploadcsvFacebookController extends Controller {

    public function csvPage() {
       $records= category::latest()->get();
      // dd($records);
      return view('home.csvupload',compact('records'));
    }
    
    /**
     * @param uploadcsvFacebookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function import(uploadcsvFacebookRequest $request) {
        $input = $request->all();
        // dd($input['category_id']);
        $AppUsersPosts = new AppUsersPosts();


        if (!is_null(Input::file('csv_file'))) {
            //if success return filename as String  if fail return false (function in helper.php )
            $csv_file = uploadFile('csv_file', public_path() . '/upload');
            if (gettype($csv_file) == 'string') {
                $input['csv_file'] = $csv_file;
                $posts_from_file = csvToArray(public_path() . '/upload/' . $csv_file);
                for ($i = 0; $i < count($posts_from_file); $i++) {
                    if (!empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && !empty($posts_from_file[$i]['created_time']) && $input['date_time'] == '1') {

                        \DB::table('app_users_posts')->insert(
                                [['message' => $posts_from_file[$i]['message'],
                                'created_time' => $posts_from_file[$i]['created_time'], 'picture' => $posts_from_file[$i]['picture'], 'app_user_id' => $input['app_user_id']]
                        ]);
                    } elseif (!empty($posts_from_file[$i]['message']) && !empty($posts_from_file[$i]['picture']) && $input['date_time'] == '0') {
                        \DB::table('app_users_posts')->insert([
                            ['message' => $posts_from_file[$i]['message'], 'picture' => $posts_from_file[$i]['picture'],
                                'app_user_id' => $input['app_user_id']]
                        ]);
                    } else {
                        return redirect('/facebook_csvFile')->with('fail', 'Not Complete data in file!');
                    }
                }//en for
            }
        } else {
            return redirect('/facebook_csvFile')->with('fail', 'file not updated!');
        }
        return redirect('/facebook_csvFile')->with('sucess', 'file updated!');
    }

}
