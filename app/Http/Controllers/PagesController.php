<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Page;
use App\Stream;
use Abraham\TwitterOAuth\TwitterOAuth;
use DateTime;

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
            'pagescontroller' => new PagesController,
        ));
    }

    public function get_facebook_data($options){

        $client = new \GuzzleHttp\Client();
        //FBing
        $fb_id = $options->app_id;
        $fb_secret = $options->app_secret;
        $app_access_token = $fb_id.'|'.$fb_secret;
        $maxFeeds = 25;
        $page_id = $options->id;
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
        $ck = $options->consumer_key;
        $cs = $options->consumer_secret;
        $at = $options->access_token;
        $ats= $options->access_token_secret;
        
        $connection = new TwitterOAuth($ck, $cs, $at, $ats);
        $content = $connection->get("account/verify_credentials");
        
        if( isset($content->errors) )
            die('Check your Credentials');
        
        $statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

        return $statuses;
    }

    public function get_flickr_data($options){
        $flickr_client = new \GuzzleHttp\Client();
        $flickr_id = $options->id;
        $flickr_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$flickr_id.'&format=json&nojsoncallback=?';
        $response = $flickr_client->get($flickr_url);

        return json_decode($response->getBody());
    }

    public function get_youtube_data($options){

        $apiKey = 'AIzaSyAmx2kbobEgQNaiVfSq-x71W4gRTK6KwH4';

        $G_client = new \GuzzleHttp\Client();
        $q = 'ammir khan';
        $youtube_search = 'https://www.googleapis.com/youtube/v3/search?part=snippet&key='.$apiKey.'&order=date&maxResults=25&q='.$q;

        $playlistId = 'PLC8A1AD995AB64055';
        $youtube_playlist = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&key='.$apiKey.'&playlistId='.$playlistId.'&maxResults=25';

        $youtube_dummy = 'https://theproductionarea.net/laravel/socials/public/youtube';

        $response = $G_client->get($youtube_dummy);

        return json_decode($response->getBody());

    }

    public function get_pinterest_data($options){

        $pinterest_client = new \GuzzleHttp\Client();

        $pinterest_id = $options->id;

        $request_url = 'https://www.pinterest.com/'.$pinterest_id.'/feed.rss/';

        $response = $pinterest_client->get($request_url);

        return simplexml_load_string($response->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);

    }

    public function get_googleplus_data($options){
        $G_client = new \GuzzleHttp\Client();
        $people = $options->id;
        $api_key = $options->api_key;
        // $gplus_url = 'https://www.googleapis.com/plus/v1/people/'.urlencode($people).'/activities/public?key=AIzaSyAmx2kbobEgQNaiVfSq-x71W4gRTK6KwH4';
        $gplus_url = 'https://theproductionarea.net/laravel/socials/public/gplus';
        $response = $G_client->get($gplus_url);
        return json_decode($response->getBody());
    }

    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}
