<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function get_social_networks(){
        $socialNetworks = array(
            array(
                'label' => 'Facebook',
                'id' => 'facebook',
                'class' => 'fa-facebook-official',
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
