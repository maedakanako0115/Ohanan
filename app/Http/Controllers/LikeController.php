<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Diary;
use Auth;

class LikeController extends Controller
{
    public function like($id)
    {
        Auth::user()->like($postId);
        return 'ok!'; //レスポンス内容
    }

    public function unlike($id)
    {
        Auth::user()->unlilikeke($postId);
        return 'ok!'; //レスポンス内容
    }
}
