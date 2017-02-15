<?php
use Illuminate\Http\Request;
use App\Page;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	$created_pages = Page::orderBy('created_at', 'asc')->get();
    return View::make('welcome')->with(array(
        'all_pages' => $created_pages,
    ));
});
Route::get('/view-page/{id}', 'PagesController@view');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/add-stream', 'HomeController@index');
Route::get('/add-page', 'HomeController@index');
Route::get('/edit-stream/{id}', 'HomeController@edit');
Route::get('/edit-page/{id}', 'HomeController@edit_page');

Route::get('/settings', 'HomeController@index');

Route::post('/home', 'HomeController@store');
Route::post('/edit-stream/{id}', 'HomeController@update');
Route::post('/add-page', 'HomeController@add_page');
Route::post('/edit-page/{id}', 'HomeController@update_page');
Route::post('/settings', 'HomeController@save_settings');

Route::delete('/home/{id}', 'HomeController@delete');
