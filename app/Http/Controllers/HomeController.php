<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Stream;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $created_streams = Stream::orderBy('created_at', 'asc')->get();
        return View::make('home')->with(array('networks' => $this->get_social_networks(), 'all_streams' => $created_streams));
    }

    /**
     * Will save social network settings
     *
     * @return 
     */
    public function store(Request $request)
    {
        $settings = new Stream;
        $settings->name = $request->stream_title;
        $settings->settings = json_encode($request->settings);
        $settings->save();

        return redirect('/home');
    }

    /**
     * Will delete the stream
     *
     * @return 
     */
    public function delete($id)
    {
        Stream::findorFail($id)->delete();
    
        return redirect('/home');
    }

    public function get_social_networks(){
        $socialNetworks = array(
           array(
               'label' => 'Facebook',
               'id'    => 'facebook',
               'class' => 'fa-facebook-official',
               'fields'=> array(
                    array(
                       'title' => 'ID',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => 'Facebook page wall posts - Enter the page ID',
                   ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                   ),
                    array(
                       'title' => 'Comments',
                       'type'  => 'text',
                       'id'    => 'comments',
                       'help'  => 'Enter number of comments to show for facebook album posts (max 25)',
                   ),
                    array(
                       'title' => 'Image Width',
                       'type'  => 'select',
                       'options' => array(
                           'none' => 'None',
                           'thumb' => 'Thumb',
                           'small' => 'Small',
                           'medium' => 'Medium',
                           'large' => 'Large',
                       ),
                       'id'    => 'images',
                       'help'  => 'Select source of facebook page posts',
                    ),
                    array(
                        'title' => 'Feed',
                        'type'  => 'select',
                        'options' => array(
                           'all' => 'All page posts',
                           'onlyByAdmin' => 'Only posts made by page admin'
                        ),
                        'id'    => 'feed',
                        'help'  => 'Select source of facebook page posts',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary - icon, link & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb',
                       'help'  => 'Thumbnail (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text',
                       'help'  => 'Wall post text',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user',
                       'help'  => 'Display user name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share',
                       'help'  => 'Include share links',
                    )
                ), 
            ),
           array(
                'label' => 'Twitter',
                'id' => 'twitter',
                'class' => 'fa-twitter',
                'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a twitter username without the "@"
                                    2. To use a twitter list enter "/" followed by the list ID - e.g. /123456
                                    3. To search enter "#" followed by the search terms - e.g. #designchemical',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ), 
                    array(
                       'title' => 'Search text',
                       'type'  => 'text',
                       'id'    => 'search',
                       'help'  => 'Text for search item link',
                    ),
                    array(
                       'title' => 'Image',
                       'type'  => 'select',
                       'options' => array(
                           'none' => 'None',
                           'thumb' => 'Thumb',
                           'small' => 'Small',
                           'medium' => 'Medium',
                           'large' => 'Large',
                       ),
                       'id'    => 'images',
                       'help'  => 'Include Twitter images',
                    ),
                    array(
                       'title' => 'Retweets',
                       'type'  => 'checkbox',
                       'id'    => 'retweets',
                       'help'  => 'Include retweets',
                    ),
                    array(
                       'title' => 'Replies',
                       'type'  => 'checkbox',
                       'id'    => 'replies',
                       'help'  => 'Include replies',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary - icon, link & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Include profile avatar',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox',
                       'help'  => 'Include share links',
                    ),
                ),
           ),
           array(
               'label' => 'Google+',
               'id' => 'googleplus',
               'class' => 'fa-google-plus',
               'fields'=> array(

               ),
           ),
           array(
               'label' => 'RSS',
               'id' => 'rss',
               'class' => 'fa-rss',
               'fields'=> array(

               ),
           ),
           array(
               'label' => 'Flickr',
               'id' => 'flickr',
               'class' => 'fa-flickr',
               'fields'=> array(),
           ),
           array(
               'label' => 'Delicious',
               'id' => 'delicious',
               'class' => 'fa-delicious',
               'fields'=> array(),
           ),
           array(
               'label' => 'YouTube',
               'id' => 'youtube',
               'class' => 'fa-youtube',
               'fields'=> array(),
           ),
           array(
               'label' => 'Pinterest',
               'id' => 'pinterest',
               'class' => 'fa-pinterest-p',
               'fields'=> array(),
           ),
           array(
               'label' => 'Last.FM',
               'id' => 'lastfm',
               'class' => 'fa-lastfm',
               'fields'=> array(),
           ),
           array(
               'label' => 'Dribble',
               'id' => 'dribble',
               'class' => 'fa-dribbble',
               'fields'=> array(),
           ),
           array(
               'label' => 'Vimeo',
               'id' => 'vimeo',
               'class' => 'fa-vimeo',
               'fields'=> array(),
           ),
           array(
               'label' => 'Stumbleupon',
               'id' => 'stumbleupon',
               'class' => 'fa-stumbleupon',
               'fields'=> array(),
           ),
           array(
               'label' => 'Deviantart',
               'id' => 'deviantart',
               'class' => 'fa-deviantart',
               'fields'=> array(),
           ),
           array(
               'label' => 'Tumblr',
               'id' => 'tumblr',
               'class' => 'fa-tumblr',
                'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Tumblr username
                                    Enter multiple usernames separated by comma',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Item summary - icon, link & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb',
                       'help'  => 'Thumbnail (if available)',
                    ),
                    array(
                       'title' => 'Titel',
                       'type'  => 'checkbox',
                       'id'    => 'title',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user',
                       'help'  => 'Display user name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share',
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'text',
                       'id'    => 'thumb_width',
                       'help'  => 'Width of thumbnail image - enter 75, 100, 250, 400, 500, or 1280',
                    ),
                    array(
                       'title' => 'Video',
                       'type'  => 'text',
                       'id'    => 'video',
                       'help'  => 'Width of inline video player - enter 250, 400 or 500',
                    ),
                ),
           ),
           array(
               'label' => 'Instagram',
               'id' => 'instagram',
               'class' => 'fa-instagram',
               'fields'=> array(),
           ),
        );

        return $socialNetworks;   
    }
}
?>