<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Page;
use App\Stream;
use Abraham\TwitterOAuth\TwitterOAuth;

class PagesController extends Controller
{
    /**
     * Will show the page
     *
     * @return 
     */
    public function view($page_id)
    {
		$created_pages = Page::orderBy('created_at', 'asc')->get();
        $page = Page::find($page_id);

        $stream_data = Stream::findOrFail($page->stream_id);

        $stream_settings = json_decode($stream_data->settings);

        $all_data_arr = array();

        foreach ($stream_settings as $network => $options) {
            if (isset($options->id) && $options->id != '') {
                $callback_name = 'get_'.$network.'_data';
                $all_data_arr[$network] = $this->$callback_name($options);
            }
        }

        return View::make('welcome')->with(array(
            'page_title' => $page->title,
            'page_id' => $page->id,
            'social_data' => $all_data_arr,
            'page_contents' => $page->contents,
	        'all_pages' => $created_pages,
        ));
    }

    public function get_facebook_data($options){
        $client = new \GuzzleHttp\Client();
        //FBing
        $fb_id = '469643676424752';
        $fb_secret = '0f3a6cb5cfea501073159522545dd267';
        $app_access_token = $fb_id.'|'.$fb_secret;
        $maxFeeds = 25;
        $page_id = 'najeebmedia';
        $fields = "id,message,picture,link,name,description,created_time,type,icon,from,object_id,likes,comments";
        
        $graphUrl = 'https://graph.facebook.com/v2.3/'.$page_id.'/feed?key=value&access_token='.$app_access_token.'&fields='.$fields.'&limit='.$maxFeeds;
        
        $res = $client->request('GET', $graphUrl);

        $json_data =  $res->getBody();

        return json_decode($json_data);
    }

    public function get_twitter_data($options){
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

        return $statuses;
    }
}
