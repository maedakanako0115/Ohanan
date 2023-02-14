<?php

namespace App\Http\Controllers;

use App\User;
use App\Diary;
use App\Todolist;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $todolists = Todolist::all();
        
        $diary = Diary::query();
        // 検索するときはquery
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            // 全角スペースを半角に変換
            // $spaceConversion = mb_convert_kana($keyword, 's');
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            // $keywords = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
                $diary->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('text', 'LIKE', "%{$keyword}%");
        }
        $diaries = $diary->get();
        return view('home', compact('diaries', 'todolists'));
    }
}
