<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Page;
use App\Stream;
use App\Setting;
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

        $global_settings = Setting::orderBy('created_at', 'asc')->get();

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
            'stream_settings' => $stream_settings,
            'pagescontroller' => new PagesController,
            'global_settings' => $global_settings,
        ));
    }

    public function get_facebook_data($options){

        $client = new \GuzzleHttp\Client();
        //FBing
        $fb_id = $options->app_id;
        $fb_secret = $options->app_secret;
        $app_access_token = $fb_id.'|'.$fb_secret;
        $maxFeeds = ($options->max != '') ? $options->max : 25;
        $page_id = $options->id;
        $fields = "id,message,full_picture,link,name,description,created_time,type,icon,from,object_id,likes,comments";
        
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
        $ats = $options->access_token_secret;
        $count = ($options->search != '') ? $options->search : 25 ;
        
        $connection = new TwitterOAuth($ck, $cs, $at, $ats);
        $content = $connection->get("account/verify_credentials");
        
        if( isset($content->errors) )
            die('Check your Credentials');
        
        $statuses = $connection->get("statuses/user_timeline", ["count" => $count, "exclude_replies" => true]);

        return $statuses;
    }

    public function get_flickr_data($options){
        $flickr_client = new \GuzzleHttp\Client();
        $flickr_id = $options->id;
        $flickr_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$flickr_id.'&format=json&nojsoncallback=?';
        $response = $flickr_client->get($flickr_url);

        return json_decode($response->getBody());
    }


    public function get_rss_data($options){
        $client = new \GuzzleHttp\Client();
      
        $rss_url = $options->id;
        $graphUrl = $rss_url;
        
        $res = $client->request('GET', $graphUrl);
        return simplexml_load_string($res->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
    }


    public function get_delicious_data($options){
        $client = new \GuzzleHttp\Client();
      
        $delicious_id = $options->id;
        $graphUrl = 'http://feeds.del.icio.us/v2/json/'.$delicious_id;
        
        $res = $client->request('GET', $graphUrl);
        return json_decode($res->getBody());
    }


    public function get_vimeo_data($options){
        $client = new \GuzzleHttp\Client();
      
        $user = $options->id;
        
        $accessToken = '32610885f98c50d63a2e284cfa9dbfb4';
        
        $graphUrl = 'https://api.vimeo.com/users/' . $user.'/feed/?access_token='.$accessToken;
        
        $res = $client->request('GET', $graphUrl);
        return json_decode($res->getBody());
    }


    public function get_dribbble_data($options){
        $client = new \GuzzleHttp\Client();
      
        $user = 'najeebmedia';
        $accessToken = 'e918302415b22a47420377ba6eb560e23d562f08a1526a2ebf1b0eb6bcba6d3b';
        $user = 'adamgrason';
        
        $graphUrl = 'https://api.dribbble.com/v1/users/'.$user.'/shots/?access_token='.$accessToken;
        
        $res = $client->request('GET', $graphUrl);
        
        return json_decode($res->getBody());
    }

    public function get_tumblr_data($options){
        $client = new \GuzzleHttp\Client();
      
        $user = 'nmedia82';
        $blog = $user.'.tumblr.com';
        $apiKey = 'kUSp55WOe3ZEZUyocFh61QIHdI8qX8brqzscoeECUZ9TCgJjI9';
        
        $graphUrl = 'https://api.tumblr.com/v2/blog/'.$blog.'/posts/photo/?api_key='.$apiKey;
        
        $res = $client->request('GET', $graphUrl);

        $response = $res->getBody();

        return json_decode($response);
    }

    public function get_lastfm_data($options){
        $client = new \GuzzleHttp\Client();
      
        $user = 'najeebmedia';
        $apiKey = 'fb8dc5062b43135e61815f3b406ced52';
        $user = 'RTJ3';
        $method = 'user.getRecentTracks';
        
        $graphUrl = 'http://ws.audioscrobbler.com/2.0/?method='.$method.'&user='.$user.'&api_key='.$apiKey.'&format=json';
        // $graphUrl = 'https://api.del.icio.us/v1/nmedia';
        
        $res = $client->request('GET', $graphUrl);
        return json_decode($res->getBody());
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
        $count =  ($options->count != '') ? $options->count : 25 ;
        $gplus_url = 'https://www.googleapis.com/plus/v1/people/'.urlencode($people).'/activities/public?key='.$api_key.'&maxResults='.$count;
        // $gplus_url = 'https://theproductionarea.net/laravel/socials/public/gplus';
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
        $html = '<span class="nmtime" data-time="'.strtotime($datetime).'">';
        $html .= $string ? implode(', ', $string) . ' ago' : 'just now';
        $html .= '</span>';

        return $html;
    }
}
