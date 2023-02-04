<?php

use illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DiaryController;
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
Route::resource('/diarys', 'DiaryController');

// method url                     function RouteName
// GET	  /photos	              index	   photos.index    一覧画面表示
// GET	  /photos/create          create   photos.create　 新規登録画面表示
// POST	  /photos	              store	   photos.store　　新規登録処理
// GET	  /photos/{photo}         show	   photos.show　　 詳細画面表示
// GET	  /photos/{photo}/edit	  edit	   photos.edit　　 編集画面表示
// PUT	  /photos/{photo}	      update   photos.update　 編集処理
// DELETE /photos/{photo}	      destroy  photos.destroy　削除処理