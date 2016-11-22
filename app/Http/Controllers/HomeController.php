<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
        return View::make('home')->with(array('networks' => $this->get_social_networks()));
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
                        'type'  => 'text',
                        'id'    => 'comments',
                        'help'  => 'Enter number of comments to show for facebook album posts (max 25)',
                    ),
                ), 
            ),
            array(
                'label' => 'Twitter',
                'id' => 'twitter',
                'class' => 'fa-twitter',
            ),
            array(
                'label' => 'Google+',
                'id' => 'googleplus',
                'class' => 'fa-google-plus',
            ),
            array(
                'label' => 'RSS',
                'id' => 'rss',
                'class' => 'fa-rss',
            ),
            array(
                'label' => 'Flickr',
                'id' => 'flickr',
                'class' => 'fa-flickr',
            ),
            array(
                'label' => 'Delicious',
                'id' => 'delicious',
                'class' => 'fa-delicious',
            ),
            array(
                'label' => 'YouTube',
                'id' => 'youtube',
                'class' => 'fa-youtube',
            ),
            array(
                'label' => 'Pinterest',
                'id' => 'pinterest',
                'class' => 'fa-pinterest-p',
            ),
            array(
                'label' => 'Last.FM',
                'id' => 'lastfm',
                'class' => 'fa-lastfm',
            ),
            array(
                'label' => 'Dribble',
                'id' => 'dribble',
                'class' => 'fa-dribbble',
            ),
            array(
                'label' => 'Vimeo',
                'id' => 'vimeo',
                'class' => 'fa-vimeo',
            ),
            array(
                'label' => 'Stumbleupon',
                'id' => 'stumbleupon',
                'class' => 'fa-stumbleupon',
            ),
            array(
                'label' => 'Deviantart',
                'id' => 'deviantart',
                'class' => 'fa-deviantart',
            ),
            array(
                'label' => 'Tumblr',
                'id' => 'tumblr',
                'class' => 'fa-tumblr',
            ),
            array(
                'label' => 'Instagram',
                'id' => 'instagram',
                'class' => 'fa-instagram',
            ),
        );

        return $socialNetworks;   
    }
}
