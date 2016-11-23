<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Page;

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

        return View::make('welcome')->with(array(
            'page_title' => $page->title,
            'page_id' => $page->id,
            'page_stream' => $page->stream_id,
            'page_contents' => $page->contents,
	        'all_pages' => $created_pages,
        ));
    }
}
