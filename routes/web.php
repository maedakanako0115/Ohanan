<?php

use illuminate\Support\Facades\Route;
use App\Http\Requests\CreateData;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\DestroyController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/todolists', 'TodolistController');
Route::resource('/users', 'UserController');

Route::resource('/comments', 'CommentController',['only' => ['index','create','store','show',]]);
Route::group(['middleware'=>'can:view,comment'],function(){
Route::resource('/comments', 'CommentController',['only' => ['edit','update','destroy']]);
});

Route::resource('/diarys', 'DiaryController',['only' => ['index','create','store','show',]]);
Route::group(['middleware'=>'can:view,diary'],function(){
Route::resource('/diarys', 'DiaryController',['only' => ['edit','update','destroy']]);
});

Route::resource('/groups', 'GroupController',['only' => ['index','create','update','store','show',]]);
Route::group(['middleware'=>'can:view,group'],function(){
Route::resource('/groups', 'GroupController',['only' => ['edit','destroy']]);
});

Route::resource('group_infos', 'Group_infoController');
// Route::group(['middleware'=>'can:view,group_info'],function(){
// Route::resource('group_infos', 'Group_infoController',['only' => ['edit','destroy']]);

// });

Route::get('/gi_delete/{id}', 'DestroyController@destroy')->name('gi.destroy');


//ログイン中のユーザーのみアクセス可能
Route::group(['middleware' => ['auth']], function () {
    //「ajaxlike.jsファイルのurl:'ルーティング'」に書くものと合わせる。
    Route::post('/ajaxlike', 'DiaryController@ajaxlike')->name('posts.ajaxlike');
});






// method url                     function RouteName
// GET	  /photos	              index	   photos.index    一覧画面表示
// GET	  /photos/create          create   photos.create　 新規登録画面表示
// POST	  /photos	              store	   photos.store　　新規登録処理
// GET	  /photos/{photo}         show	   photos.show　　 詳細画面表示
// GET	  /photos/{photo}/edit	  edit	   photos.edit　　 編集画面表示
// PUT	  /photos/{photo}	      update   photos.update　 編集処理
// DELETE /photos/{photo}	      destroy  photos.destroy　削除処理