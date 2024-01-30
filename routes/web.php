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

Route::group(['middleware' => ['web']], function () {
  Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
  Route::get('/login', array('as' => 'login', 'uses' => 'HomeController@index'));
  Route::post('/login', array('as' => 'login.post', 'uses' => 'HomeController@postLogin'));
  Route::post('/forceChangePassword', array('as' => 'search.getAPIData', 'uses' => 'HomeController@forceChangePassword'));
    Route::post('/heartBeat', array('as' => 'search.heartBeat', 'uses' => 'HomeController@heartBeat'));
});

Route::group(['middleware'=>'authenticate'], function(){
   Route::get('/logout', array('as' => 'logout', 'uses' => 'HomeController@logout'));
   Route::get('/dashboard', array('as' => 'dashboard', 'uses' => 'HomeController@dashboard'));

   Route::post('/dashboard', array('as' => 'dashboard.content', 'uses' => 'HomeController@getDashboardContent'));
   Route::post('/get-view/', array('as' => 'get.view', 'uses' => 'HomeController@getView'));
   Route::post('/get-add', array('as' => 'get.add', 'uses' => 'HomeController@getEditor'));

   Route::post('getDetail/{slug}', 'HomeController@getDetail');
   Route::post('/add', array('as' => 'post.add', 'uses' => 'HomeController@postAdd'));
   Route::post('/edit', array('as' => 'post.edit', 'uses' => 'HomeController@postEdit'));
   Route::post('/delete', array('as' => 'post.delete', 'uses' => 'HomeController@postDelete'));
   Route::post('/detail', array('as' => 'post.detail', 'uses' => 'HomeController@postDetail'));
   Route::post('/detail2', array('as' => 'post.detail', 'uses' => 'HomeController@postDetail2'));
   Route::post('/fetchDataTable', array('as' => 'post.fetch', 'uses' => 'HomeController@fetchDataTable'));
    Route::post('/getAPIData', array('as' => 'search.getAPIData', 'uses' => 'HomeController@getAPIData'));
    Route::post('/getViewWithURL', array('as' => 'getViewWithURL', 'uses' => 'HomeController@getViewWithURL'));

   Route::get('/{slug?}', array('as' => 'all', 'uses' => 'HomeController@dashboard'));

   Route::post('/getTrxStatusDetailView', array('as' => 'get.detailView', 'uses' => 'HomeController@getTrxStatusDetailView'));
   Route::post('/downloadFile', array('as' => 'get.download', 'uses' => 'HomeController@downloadFile'));
   Route::post('/uploadFile', array('as' => 'post.upload', 'uses' => 'HomeController@uploadFile'));

});
