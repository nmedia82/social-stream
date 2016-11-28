<?php

use Illuminate\Http\Request;

use Abraham\TwitterOAuth\TwitterOAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/fburl', function () {
  
    $client = new \GuzzleHttp\Client();
    /*$res = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
    echo $res->getStatusCode();
    // 200
    echo $res->getHeaderLine('content-type');
    // 'application/json; charset=utf8'
    echo $res->getBody();*/
    
    //FBing
    $fb_id = '469643676424752';
    $fb_secret = '0f3a6cb5cfea501073159522545dd267';
    $app_access_token = $fb_id.'|'.$fb_secret;
    $maxFeeds = 25;
    $page_id = 'najeebmedia';
    $fields = "id,message,picture,link,name,description,created_time,type,icon,from,object_id,likes,comments";
    
    $graphUrl = 'https://graph.facebook.com/v2.3/'.$page_id.'/feed?key=value&access_token='.$app_access_token.'&fields='.$fields.'&limit='.$maxFeeds;
    
    $res = $client->request('GET', $graphUrl);
    echo $res->getStatusCode();
    // 200
    echo $res->getHeaderLine('content-type');
    // 'application/json; charset=utf8'
    echo $res->getBody();
});

Route::get('/twitter', function () {
    
    if (!session_id()) {
        session_start();
    }
    
    // return view('networks');
    $ck = 'wNESEgYakKB7apRqEU6w4A';
    $cs = 'BJZKJnkLJoej29UPcKYaX0Xv8YBOeFM3xa06tFLZYo';
    $at = '316939729-dquGikqqJNj1ZHt7QhSGgr61Mb6yrxPt3Mi9eSA7';
    $ats= 'sdqt34T5vM4fnK7YFHEtymcN40DPkbT9089zGJuVsI';
    
    $connection = new TwitterOAuth($ck, $cs, $at, $ats);
    $content = $connection->get("account/verify_credentials");
    
    if( isset($content->errors) )
        die('Check your Credentials');
    
    $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
    echo '<pre>';
    print_r($statuses);
    echo '</pre>';


    
});

Route::get('/facebook', function () {
    
    if (!session_id()) {
        session_start();
    }
    
    $fb_id = '469643676424752';
    $fb_secret = '0f3a6cb5cfea501073159522545dd267';
    $dumy_token = $fb_id.'|'.$fb_secret;
   

    $fb = new \Facebook\Facebook([
      'app_id' => $fb_id,
      'app_secret' => $fb_secret,
      'default_graph_version' => 'v2.8',
    //   'default_access_token' => $fb_token
    ]);

	$helper = $fb->getRedirectLoginHelper();
    
    if( ! isset($_SESSION['fb_token']) ) {
    	$permissions = ['email', 'user_likes']; // optional
    	$loginUrl = $helper->getLoginUrl('http://localhost/laravel/social-stream/public/api/facebook', $permissions);
    
    	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';	
    }
    
    
    if( ! isset($_SESSION['fb_token']) ) {
        try {
          $accessToken = $helper->getAccessToken();
          $_SESSION['fb_token'] = $accessToken;
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
    }    
    
    $page_link = array();
    $page_name = array();
    
    $maxFeeds = 5;
    $feed_count = 0;
    $message = '';
    $json_decoded = array();
    $link_url = '';
    
    $fields = "id,message,picture,link,name,description,created_time,type,icon,from,object_id,likes,comments";
    
    $page_ids = "imagecrop.net,najeebmedia";
    $pagesArray = explode(",",$page_ids);
    
    //making request array for each page
    $requests = array();
    foreach($pagesArray as $key => $page) {
        
        // Getting page detail from Graph
        $pageResponse = $fb -> get('/'.$page.'?fields=id,link,name',$_SESSION['fb_token']);
        $pageObject = $pageResponse -> getGraphObject();
        $pageArray = $pageObject->asArray();
            
        $page_link[$key] = $pageArray['link'];
        $page_name[$key] = $pageArray['name'];
    
    
        $requests[] = $fb->request('GET', '/'.$page.'/feed?key=value&fields='.$fields.'&limit='.$maxFeeds);
    }
    
    
    try {
      $batchResponse = $fb->sendBatchRequest($requests, $_SESSION['fb_token']);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    // $response = $fb->get('/'.$page_ids.'/feed?key=value&fields='.$fields, $_SESSION['fb_token']);
    // $response = $fb->request('GET', '/najeebmedia/feed');
    
    foreach($batchResponse as $key => $response) {
        
           
      $feedEdge = $response->getGraphEdge();
        do {
          foreach ($feedEdge as $data) {
              
            /*echo '<pre>';
            print_r($data);
            echo '</pre>';*/
            
            $created_time = $data['created_time'];
            
            
            if(isset($data['message']))
    		{
    			$message = str_replace("\n","</br>",$data['message']);
    		} else if(isset($data['storey']))
    		{
    			$message = $data['storey'];
    		} else {
    			$message = '';
    		}
    		
    		if(isset($data['description']))
    		{
    			$message .= ' ' . $data['description'];
    		}
    		
    		$link = isset($data['link']) ? $data['link'] : '';
    		$image = isset($data['picture']) ? $data['picture'] : null;
    		$type = isset($data['type']) ? $data['type'] : '';
    		
    		if($link_url == $link){
    		//	continue;
    		}
    		
    		$link_url = $link;
    		
    		if($message == '' || $link == '') {
    		//	continue;
    		}
    		
    		if($type == 'status' && isset($data['storey'])) {
    			continue;
    		}
    		
        	if(!isset($data['object_id']) && $type != 'video') {
    			$pic_id = explode("_", $image);	
    			if(isset($pic_id[1])){
    				$data['object_id'] = $pic_id[1];
    			}
    		}
    		
    		if(isset($data['object_id'])){
    		
    			if(strpos($image, 'safe_image.php') === false && is_numeric($data['object_id'])) {
    				$image = 'https://graph.facebook.com/'.$data['object_id'].'/picture?type=normal';
    			}
    		
    		}
            
          }
          
            $json_decoded['responseData']['feed'][$key][$feed_count]['page_link'] = $page_link[$key];
        	$json_decoded['responseData']['feed'][$key][$feed_count]['page_name'] = $page_name[$key];
        	$json_decoded['responseData']['feed'][$key][$feed_count]['link'] = $link;
        	$json_decoded['responseData']['feed'][$key][$feed_count]['content'] = $message;
        	$json_decoded['responseData']['feed'][$key][$feed_count]['thumb'] = $image;
        	$json_decoded['responseData']['feed'][$key][$feed_count]['published_date'] = $created_time->format('D, d M Y H:i:s O');
    		
          $feed_count++;
        } while ($feed_count < $maxFeeds && $feedEdge = $fb->next($feedEdge));
    }
    
    echo '<pre>';
    print_r($json_decoded);
    echo '</pre>';
    
});
