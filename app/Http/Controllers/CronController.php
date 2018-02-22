<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppUsersPosts;
use App\AppUsersPages;
use App\AppUsersPostsResources;
use App\Resources;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class CronController extends Controller {

    /**
     * 
     * @param type $id
     * @return type
     */
    public function updatePost($id) {
        $post_update = AppUsersPosts::where('id', $id)->update(array('publish' => 1));
        return $post_update;
    }

    /**
     * 
     * @param type $fb
     * @param type $pageId
     * @param type $Data
     * @param type $pageAccessToken
     */
    public function postOnFacebook($fb, $pageId, $Data, $pageAccessToken) {
        try {
            $response = $fb->post('/' . $pageId . '/feed', $Data, $pageAccessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }

    /**
     * 
     * @param type $fb
     * @param type $userAccessToken
     * @param type $pageId
     * @return type
     */
    public function getPageAccessToken($fb, $userAccessToken, $pageId) {
        $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);
        $fb->setDefaultAccessToken($longLivedToken);
        $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])->getDecodedBody();
        $pageAccessToken = $response['access_token'];
        return $pageAccessToken;
    }

    /**
     * 
     * @param LaravelFacebookSdk $fb
     */
    public function getScheduledPosts(LaravelFacebookSdk $fb) {
        $scheduled_posts = AppUsersPosts::latest()->where('app_user_page_id', '12')->where('publish', 0)->get();
        foreach ($scheduled_posts as $value) {
            $Data = ['message' => $value->message,];
            $AppUsersPages = AppUsersPages::latest()->where('page_id', $value->page_id)->first();
            $pageAccessToken = $this->getPageAccessToken($fb, $AppUsersPages->oauth_token, $value->page_id);
            if ($value->resource_id && $value->resource_id > 0) {
                $post_resoucers = AppUsersPostsResources::oldest()->where('app_users_post_id', $value->id)->get();
                foreach ($post_resoucers as $resource) {
                    $linkData = ['url' => []];
                    $images = array();
                    $resoucers = Resources::oldest()->where('id', $resource->resource_id)->get();
                    //$img = ['url' => 'https://static.pexels.com/photos/34950/pexels-photo.jpg', 'published' => false];
                    $img = ['url' => URL('') . $resoucers[0]->resource_dir . $resoucers[0]->resource, 'published' => false];
                    $response = $fb->post('/' . $value->page_id . '/photos', $img, $pageAccessToken);
                    //var_dump($response->getGraphUser()->getId());
                    array_push($images, $response->getGraphUser()->getId());
//                    $Data = ['message' => $value->message,];
                    for ($i = 0; $i < count($images); $i++) {
                        array_push($Data, $Data["attached_media[" . $i . "]"] = "{'media_fbid':'$images[$i]'}");
                    }
                    $this->postOnFacebook($fb, $value->page_id, $Data, $pageAccessToken);
                }
                exit();
            } else {
                $this->postOnFacebook($fb, $value->page_id, $Data, $pageAccessToken);
            }//end if resources

            $this->updatePost($value->id);
        }//end for on schedule posts
    }

}
