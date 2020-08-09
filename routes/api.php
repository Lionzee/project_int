<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('/user')->group(function(){
    Route::post('/register','UserController@register');
    Route::post('/login','UserController@login');
});

Route::prefix('/item')->middleware('jwt.verify')->group(function(){
    Route::post('/create','ItemController@create');
    Route::delete('/delete/{item_id}','ItemController@delete');
    Route::put('/update/{item_id}','ItemController@update');
    Route::post('/image-update/{item_id}','ItemController@image_update');
});
Route::get('/item/all','ItemController@viewAll');
Route::get('/item/{item_id}','ItemController@viewDetail');
Route::get('/user/{user_id}/items','ItemController@viewUserItems');

Route::prefix('/like')->middleware('jwt.verify')->group(function(){
    Route::post('/create','LikeController@create');
    Route::delete('/delete/{item_id}','LikeController@delete');
});
Route::get('/item/{item_id}/like-list','LikeController@list');
