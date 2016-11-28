<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Page;
use App\Stream;

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

        return View::make('welcome')->with(array(
            'page_title' => $page->title,
            'page_id' => $page->id,
            'stream_settings' => $stream_settings,
            'page_contents' => $page->contents,
	        'all_pages' => $created_pages,
        ));
    }
}
