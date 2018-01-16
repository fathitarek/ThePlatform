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
            $failed_posts = AppUsersPosts::latest()->where('publish',0)->where('created_time', '<', date('Y-m-d H:i:s a', time() +5))->orderBy('created_time', 'desc')->paginate(15);
        } catch (\Exception $ex) {
            $failed_posts = null;
        }
        return view('home.failedPosts', compact('failed_posts'));
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
        //
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
    public function destroy($id) {
        //
    }

}
