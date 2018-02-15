<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersPosts;
use App\Category;
use Illuminate\Support\Facades\Input;
use File;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\AppUsersPages;

class statusController extends Controller {

    /**
     * Display a listing of the resource.
     * List publish posts WHEERE Publish equal 1
     * @return \Illuminate\Http\Response
     */
    public function publishPosts() {
        try {
            $publish_posts = AppUsersPosts::latest()->where('publish', 1)->where('app_user_id', Auth::guard('AppUsers')->user()->id)->orderBy('created_time', 'desc')->paginate(15);
           // dd($publish_posts ['page_id']);
            if(count($publish_posts)) {
                foreach ($publish_posts as $record) {
                    $record->type = AppUsersPages::where('page_id', $record->page_id)->pluck('type');
                }
            }

        } catch (\Exception $ex) {
            $publish_posts = null;
        }
        return view('home.publishPosts', compact('publish_posts'));
    }

    /**
     * Show the form for creating a new resource.
     * List publish posts WHEERE Publish equal 0 AND ceated time > now
     * @return \Illuminate\Http\Response
     */
    public function scheduledPosts() {
        try {
            $scheduled_posts = AppUsersPosts::latest()->where('app_user_id', Auth::guard('AppUsers')->user()->id)->where('publish', 0)->where('created_time', '>', date('Y-m-d  H:i:s'))->orderBy('created_time', 'desc')->paginate(15);

            if(count($scheduled_posts)) {
                foreach ($scheduled_posts as $record) {
                    $record->type = AppUsersPages::where('page_id', $record->page_id)->pluck('type');
                }
            }
        } catch (\Exception $ex) {
            $scheduled_posts = null;
        }
        return view('home.scheduledPosts', compact('scheduled_posts'));
    }

    /**
     * Show the form for creating a new resource.
     * List publish posts WHEERE Publish equal 0 AND ceated time > now
     * @return \Illuminate\Http\Response
     */
    public function failedPosts() {
        //var_dump(date("m/d/Y h:i:s"));
        // dd(date("m/d/Y h:i:s a", time() +5));
        try {
            $failed_posts = AppUsersPosts::latest()->where('app_user_id', Auth::guard('AppUsers')->user()->id)->where('publish', -1)->where('created_time', '<', date('Y-m-d H:i:s a', time() + 5))->orderBy('created_time', 'desc')->paginate(15);

            if(count($failed_posts)) {
                foreach ($failed_posts as $record) {
                    $record->type = AppUsersPages::where('page_id', $record->page_id)->pluck('type');
                }
            }
        } catch (\Exception $ex) {
            $failed_posts = null;
        }
        return view('home.failedPosts', compact('failed_posts'));
    }

    public function sendNowScheduledPosts($id) {
        echo' <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : "1535009383226574",
                autoLogAppEvents : true,
                xfbml            : true,
                version          : "v2.10"
            });
            init();
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));
    </script>';

        $post = AppUsersPosts::findOrFail($id);
        $data = AppUsersPosts::findOrFail($id);

        //dd($post);
        try {
            //$data->delete();
            echo '<script type="text/javascript" src="/js/facebookJavaScript.js"></script><script>
 create_post("facebook","now","","' . $post->picture . '","","' . $post->page_id . '","' . $post->message . '","","' . $post->page_id . '");                      
       </script>';

            return 'dd';
            echo '<script type="text/javascript"> window.location.href="/scheduledPosts?submit=1"</script>';
        } catch (Exception $ex) {
            return redirect('/scheduledPosts')->with('fail', 'Post Can`t Send Now Successfuly');
        }
        //$data->delete(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editScheduledPosts($id) {
        $data = AppUsersPosts::findOrFail($id);
        $records = Category::latest()->where('user_id', Auth::guard('AppUsers')->user()->id)->pluck('name', 'id');
        //dd($data->message);
        try {
            return view('home.edit_scheduledPosts', compact('data', 'records'));
        } catch (Exception $ex) {
            return redirect('/scheduledPosts')->with('fail', 'Post Can`t Deleted Successfuly');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateScheduledPosts(Request $request, $id) {

        $post = AppUsersPosts::findOrFail($id);
        // dump($post->created_time);
        $input = $request->all();
        // dump($input['created_time']);
        $destination = public_path() . '/postImages'; // upload path
        //dd($input['date_time']);
        if (!isset($input['date_time'])) {
           // dump("frr");
            $input['created_time'] = $post->created_time;
            $input['category_id'] = $post->category_id;
            // dd($input['created_time']);
            // $validator = Validator::make($request->all(), array('date_time' => 'required'));
            // return redirect('/scheduledPostsedit/' . $id)->with('fail', 'please check category based or date time based');
        }

        if (isset($input['date_time']) && $input['date_time'] == 1) {
            $input['created_time'] = date("Y-m-d H:i", strtotime($input['created_time']));
            $validator = Validator::make($request->all(), array('created_time' => 'required'));
            if ($validator->fails()) {
                return redirect('/scheduledPostsedit/' . $id)->with('fail', 'choose date time ');
            }
            $input['category_id'] = '';
        }

        if (isset($input['date_time']) && $input['date_time'] == 0) {
            $validator = Validator::make($request->all(), array('category_id' => 'required'));
            if ($validator->fails()) {
                return redirect('/scheduledPostsedit/' . $id)->with('fail', 'choose category ');
            }
            $input['created_time'] = '';
        }



        if (!is_null(Input::file('picture'))) {
            $validator = Validator::make($request->all(), array('picture' => 'required|mimes:jpeg,bmp,png'));
            if ($validator->fails()) {
                return redirect('/scheduledPostsedit/' . $id)->with('fail', 'choose picture as a jpeg or bmp or png');
            }

            $picture = uploadFile('picture', $destination);
            // return $similar_sections['image_en'].$image_en ;
            if (gettype($picture) == 'string') {
                // dd(public_path() . '/postImages/'.$input['picture']);
                $input['picture'] = '/postImages/' . $picture;
            }
        }

        $post->update($input);
        return redirect('/scheduledPosts')->with('sucess', 'Post Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyScheduledPosts($id) {
        try {
            $data = AppUsersPosts::findOrFail($id);
            // dd($data);
            $data->delete();
            return redirect('/scheduledPosts')->with('sucess', 'Post Deleted Successfuly');
        } catch (Exception $ex) {
            return redirect('/scheduledPosts')->with('fail', 'Post Can`t Deleted Successfuly');
        }
    }

}
