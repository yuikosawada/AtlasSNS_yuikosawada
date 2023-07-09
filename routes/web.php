<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();


//ログアウト中のページ

Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::get('/top', 'PostsController@index');
Route::post('/top', 'PostsController@index');


// ログイン後の画面をログインした人にしか見せない設定
Route::group(['middleware' => 'auth'], function () {
    //この中に以前の記事で書いたルーティングのコードを書いていく
    //ログイン認証が必要な機能の部分（ログインしてない人に見せたくないものや、使わせたくない機能）は全部この中に入る

    Route::get('/top', 'PostsController@index');

    Route::get('/profile', 'UsersController@profile');
    Route::post('/profile', 'UsersController@profile');
    Route::post('/profile/update', 'UsersController@update');

    Route::get('/search', 'App\Http\Controllers\SearchController@search')->name('search');

    // Route::get('/search', 'SearchController@search');
    Route::get('/search', 'SearchController@search');
    Route::post('/search', 'SearchController@search');
    Route::post('/search', 'SearchController@search_index');
    Route::post('/search', 'SearchController@show_post');


    Route::post('/posts', 'PostsController@store_post');
    Route::get('/top', 'PostsController@index');

    Route::post('/top', 'PostsController@update_post');
    Route::post('/post/update', 'PostsController@update_post');
    Route::get('/post/{id}/delete', 'PostsController@delete_post');


    Route::post('/profile/follow', [ProfileController::class, 'follow'])->name('profile.follow');

    // Route::post('/follow-list', 'FollowsController@follow_list');
    Route::get('/follow-list', 'FollowsController@show');
    Route::get('/follower-list', 'PostsController@index');
});
