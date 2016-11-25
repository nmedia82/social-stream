<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Stream;
use App\Page;

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
        $created_pages = Page::orderBy('created_at', 'asc')->get();
        $created_streams = Stream::orderBy('created_at', 'asc')->get();
        return View::make('home')->with(array(
          'networks' => $this->get_social_networks(),
          'all_streams' => $created_streams,
          'all_pages' => $created_pages,
        ));
    }

    /**
     * Edit the Stream
     */
    public function edit($id)
    {
        $created_streams = Stream::orderBy('created_at', 'asc')->get();
        $created_pages = Page::orderBy('created_at', 'asc')->get();
        return View::make('home')->with(array(
            'stream_id' => $id,
            'networks' => $this->get_social_networks(),
            'all_streams' => $created_streams,
            'all_pages' => $created_pages,
        ));
    }

    /**
     * Edit the page
     */
    public function edit_page($id)
    {
        $created_pages = Page::orderBy('created_at', 'asc')->get();
        $created_streams = Stream::orderBy('created_at', 'asc')->get();
        return View::make('home')->with(array(
            'page_id' => $id,
            'all_pages' => $created_pages,
            'all_streams' => $created_streams,
        ));
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
     * Will save pages
     *
     * @return 
     */
    public function add_page(Request $request)
    {
        $settings = new Page;
        $settings->title = $request->page_title;
        $settings->stream_id = $request->page_stream;
        $settings->contents = $request->page_contents;
        $settings->save();

        return redirect('/home');
    }

    /**
     * Will update social network settings
     *
     * @return 
     */
    public function update(Request $request)
    {
        $stream = Stream::find($request->stream_id);
        $stream->name = $request->stream_title;
        $stream->settings = json_encode($request->settings);
        $stream->save();

        return redirect('/home');
    }

    /**
     * Will update page
     *
     * @return 
     */
    public function update_page(Request $request)
    {
        $page_data = Page::find($request->page_id);
        $page_data->title = $request->page_title;
        $page_data->stream_id = $request->page_stream;
        $page_data->contents = $request->page_contents;
        $page_data->save();

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
                       'title' => 'Facebook App ID',
                       'type'  => 'text',
                       'id'    => 'app_id',
                       'help'  => 'Required For All Facebook Page Feeds',
                   ),
                    array(
                       'title' => 'Facebook App Secret',
                       'type'  => 'text',
                       'id'    => 'app_secret',
                       'help'  => 'Required For All Facebook Page Feeds',
                   ),
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
                       'title' => 'Consumer Key',
                       'type'  => 'text',
                       'id'    => 'consumer_key',
                       'help'  => 'Required For All Twitter Feeds',
                    ),
                    array(
                       'title' => 'Consumer Secret',
                       'type'  => 'text',
                       'id'    => 'consumer_secret',
                       'help'  => 'Required For All Twitter Feeds',
                    ),
                    array(
                       'title' => 'OAuth Access Token',
                       'type'  => 'text',
                       'id'    => 'access_token',
                       'help'  => 'Required For All Twitter Feeds',
                    ),
                    array(
                       'title' => 'OAuth Access Token Secret',
                       'type'  => 'text',
                       'id'    => 'access_token_secret',
                       'help'  => 'Required For All Twitter Feeds',
                    ),
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
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter your Google +1 profile ID
                                    Enter multiple IDs separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
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
                    array(
                       'title' => 'Api_key',
                       'type'  => 'text',
                       'id'    => 'api_key',
                       'help'  => 'Google Api Key - required',
                    ),
                ),
           ),
           array(
               'label' => 'RSS',
               'id' => 'rss',
               'class' => 'fa-rss',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter the URL for the RSS feed
                                    Enter multiple URLs separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'select',
                        'options' => array(
                           'snippet' => 'Snippet',
                           'complete_text' => 'Complete Text',
                        ),
                       'id'    => 'text_snippet',
                       'help'  => 'Display snippet or complete text',
                    ),
               ),
           ),
           array(
               'label' => 'Flickr',
               'id' => 'flickr',
               'class' => 'fa-flickr',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Flickr username ID
                                    2. To use a flickr group enter "/" followed by the group ID - e.g. /646972@N21
                                    Enter multiple usernames/groups separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
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
               'label' => 'Delicious',
               'id' => 'delicious',
               'class' => 'fa-delicious',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Delicious username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
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
               'label' => 'YouTube',
               'id' => 'youtube',
               'class' => 'fa-youtube',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Videos from a specific play list ID or Channel ID -
                                    Enter the text you would like to show for the feed profile name followed by / followed by the required list ID -
e.g. "My Youtube Feed/UUPPPrnT5080hPMxK1N4QSjA"
                                    2. Videos from a search - Enter "#" followed by the search term - e.g. "#designchemical"',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Search Text',
                       'type'  => 'text',
                       'id'    => 'search',
                       'help'  => 'Text for srearch item',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'select',
                       'options' => array(
                           '120px' => '120px X 180px',
                           '320px' => '320px X 180px',
                           '480px' => '480px X 360px',
                           '640px' => '640px X 480px',
                       ),
                       'id'    => 'thumb_size',
                       'help'  => 'Select image size',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Api_key',
                       'type'  => 'text',
                       'id'    => 'api_key',
                       'help'  => 'Google Api Key - required',
                    ),
                ),
           ),
           array(
               'label' => 'Pinterest',
               'id' => 'pinterest',
               'class' => 'fa-pinterest-p',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Pinterest username
                                    2. To show a Pinterest board enter the username, then "/" followed by the board name - e.g. jaffrey/social-media
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
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
               'label' => 'Last.FM',
               'id' => 'lastfm',
               'class' => 'fa-lastfm',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a last.fm username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Recenttracks',
                       'type'  => 'checkbox',
                       'id'    => 'recenttracks_checkbox',
                    ),
                    array(
                       'title' => 'Lovedtracks',
                       'type'  => 'checkbox',
                       'id'    => 'lovedtracks_checkbox', 
                    ),
                    array(
                       'title' => 'Replytracker',
                       'type'  => 'checkbox',
                       'id'    => 'replytracker_checkbox',
                    ),
                ),
           ),
           array(
               'label' => 'Dribble',
               'id' => 'dribble',
               'class' => 'fa-dribbble',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Dribbble username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Shots',
                       'type'  => 'checkbox',
                       'id'    => 'shots_checkbox',
                    ),
                    array(
                       'title' => 'Links',
                       'type'  => 'checkbox',
                       'id'    => 'links_checkbox',
                    ),
                    array(
                       'title' => 'AccessToken',
                       'type'  => 'text',
                       'id'    => 'accessToken',
                    ),
                ),
           ),
           array(
               'label' => 'Vimeo',
               'id' => 'vimeo',
               'class' => 'fa-vimeo',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Vimeo  username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Links',
                       'type'  => 'checkbox',
                       'id'    => 'links_checkbox',
                    ),
                    array(
                       'title' => 'Videos:',
                       'type'  => 'checkbox',
                       'id'    => 'videos_checkbox',
                    ),
                    array(
                       'title' => 'Appears_in',
                       'type'  => 'checkbox',
                       'id'    => 'appears_in_checkbox',
                    ),
                    array(
                       'title' => 'All_videos',
                       'type'  => 'checkbox',
                       'id'    => 'all_videos_checkbox',
                    ),
                    array(
                       'title' => 'Albums',
                       'type'  => 'checkbox',
                       'id'    => 'albums_checkbox',
                    ),
                    array(
                       'title' => 'Channels',
                       'type'  => 'checkbox',
                       'id'    => 'channels_checkbox',
                    ),
                    array(
                       'title' => 'Groups',
                       'type'  => 'checkbox',
                       'id'    => 'groups_checkbox',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'select',
                       'options' => array(
                            'small' => 'Small 100px wide',
                            'medium' => 'Medium 200px wide',
                            'large' => 'Large 640px wide',
                        ),
                       'id'    => 'thumb_select',
                    ),
                ),
           ),
           array(
               'label' => 'Stumbleupon',
               'id' => 'stumbleupon',
               'class' => 'fa-stumbleupon',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Stumbleupon  username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'Favorites',
                       'type'  => 'checkbox',
                       'id'    => 'favorites_checkbox',
                    ),
                    array(
                       'title' => 'Reviews',
                       'type'  => 'checkbox',
                       'id'    => 'reviews_checkbox',
                    ),
                ),
           ),
           array(
               'label' => 'Deviantart',
               'id' => 'deviantart',
               'class' => 'fa-deviantart',
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a Deviantart  username
                                    Enter multiple usernames separated by commas',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Title',
                       'type'  => 'checkbox',
                       'id'    => 'title_checkbox',
                       'help'  => 'Feed item title',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
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
               'fields'=> array(
                    array(
                       'title' => 'Id',
                       'type'  => 'text',
                       'id'    => 'id',
                       'help'  => '1. Enter a user ID starting with a "!" - e.g. !12345
                                    2. To search by tag start with the character "#" followed by the tag - e.g. #london
                                    3. To show latest posts by a location ID start with a "@" followed by the ID - e.g. @12345
                                    4. To search by geographical location start with the character "?" followed by the latitude, longitude and distance in meters (up to a 
                                     maximum of 5000) all separated by a "/" - e.g. ?55.5/0/20',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'text',
                       'id'    => 'intro',
                       'help'  => 'Text for feed item link',
                    ),
                    array(
                       'title' => 'Search Text',
                       'type'  => 'text',
                       'id'    => 'search_text',
                       'help'  => 'Text for search item link',
                    ),
                    array(
                       'title' => 'Intro',
                       'type'  => 'checkbox',
                       'id'    => 'intro_checkbox',
                       'help'  => 'Item summary-icon, links & date',
                    ),
                    array(
                       'title' => 'Thumb',
                       'type'  => 'checkbox',
                       'id'    => 'thumb_checkbox',
                       'help'  => 'Thumbnails (if available)',
                    ),
                    array(
                       'title' => 'Text',
                       'type'  => 'checkbox',
                       'id'    => 'text_checkbox',
                       'help'  => 'Text block',
                    ),
                    array(
                       'title' => 'User',
                       'type'  => 'checkbox',
                       'id'    => 'user_checkbox',
                       'help'  => 'Display RSS name',
                    ),
                    array(
                       'title' => 'Share',
                       'type'  => 'checkbox',
                       'id'    => 'share_checkbox', 
                       'help'  => 'Include share links',
                    ),
                    array(
                       'title' => 'AccessToken',
                       'type'  => 'text',
                       'id'    => 'accessToken',
                    ),
                    array(
                       'title' => 'RedirectUrl',
                       'type'  => 'text',
                       'id'    => 'redirect_url',
                    ),
                    array(
                       'title' => 'ClientId',
                       'type'  => 'text',
                       'id'    => 'client_id',
                    ),
                ),
           ),
        );

        return $socialNetworks;   
    }
}
?>