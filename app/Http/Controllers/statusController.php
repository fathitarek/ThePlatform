<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersPosts;

class statusController extends Controller {

    /**
     * Display a listing of the resource.
     * List publish posts WHEERE Publish equal 1
     * @return \Illuminate\Http\Response
     */
    public function publishPosts() {
        try {
            $publish_posts = AppUsersPosts::latest()->where('publish', 1)->orderBy('created_time', 'desc')->paginate(15);
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
            $scheduled_posts = AppUsersPosts::latest()->where('publish', 0)->where('created_time', '>', date('Y-m-d  H:i:s'))->orderBy('created_time', 'desc')->paginate(15);
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
            $failed_posts = AppUsersPosts::latest()->where('publish', 0)->where('created_time', '<', date('Y-m-d H:i:s a', time() + 5))->orderBy('created_time', 'desc')->paginate(15);
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
    public function edit($id) {
        $data = AppUsersPosts::findOrFail($id);
        try {
            return view($url, compact('data'));
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
    public function update(Request $request, $id) {
        //
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
