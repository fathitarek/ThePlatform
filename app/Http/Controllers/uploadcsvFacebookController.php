<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\uploadcsvFacebookRequest;
use App\AppUsersPosts;
use Illuminate\Support\Facades\Input;

class uploadcsvFacebookController extends Controller {

    /**
     * @param uploadcsvFacebookRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function import(uploadcsvFacebookRequest $request) {
        $input = $request->all();
       // dd($input);
        $AppUsersPosts = new AppUsersPosts();
        $destination = public_path() . '/excel_imported_files'; // upload path

        if (!is_null(Input::file('csv_file'))) {
            //if success return filename as String  if fail return false (function in helper.php )
            $csv_file = uploadFile('csv_file', public_path() . '/upload');
            if (gettype($csv_file) == 'string') {
                $input['csv_file'] = $csv_file;
                $posts_from_file = csvToArray(public_path() . '/upload/' . $csv_file);
                for ($i = 0; $i < count($posts_from_file); $i++) {
                    //insert post to database
                    \DB::table('app_users_posts')->insert([
                        ['message' => $posts_from_file[$i]['message'], 'created_time' => $posts_from_file[$i]['created_time']]
                    ]);
                }
            }
        } else {
            return redirect('/facebook_csvFile')->with('fail', 'file not updated!');
        }
        return redirect('/facebook_csvFile')->with('sucess', 'file updated!');
    }

}
