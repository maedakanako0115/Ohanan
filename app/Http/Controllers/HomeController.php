<?php

namespace App\Http\Controllers;

use App\User;
use App\Diary;
use App\Todolist;
use App\Group;
use App\Group_info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



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
    // public function index(Request $request)
    // {
    //     $groups= Group::where('user_id',Auth::id())->get();


    //     return view('home', compact('groups'));


    public function index(Request $request)
    {

        $group_id = $request->group_id;
        $todolists = '';
        $diaries = '';
        $groups = Group::where('user_id', Auth::id());
        $flg = Group_info::where('user_id', Auth::id())->get();
        // is_array->配列チェック
        if ($flg) {
            $group_flg = [];
            foreach ($flg as $val) {
                $groups->orWhere('id', $val->group_id);
                // = 代入（上書される　or されない）
                // orWhere->範囲選択（広がっていく）'->'推奨
                // where->絞り込み'->'推奨 
                // = 使うなら変数「」にしてあげる　（キーが入る（01...））
            }
        }
        $groups = $groups->get();


        
        // getするためには変数＝～get()
        
        $keyword = '';
        $icon=[];
        $group_create=null;
        $group_infos="";
        // 条件式である、ないを定義すときは空の変数を作る
        
        if ($group_id) {
            
            
            $iconkey = [];
            foreach ($groups as $group) {
                if($group->id == $group_id){
                    $group_create=$group->user->image;
                }
                // $group_create=
                foreach ($group->group_infos as $val) {
                    if($val['group_id'] == $group_id){
                        $iconkey[] = $val->user->image;
                    }
                }
            }
            $icon = array_unique($iconkey);
            
            $todolists = Todolist::where('user_id', Auth::id());
            if ($group_id) {
                $todolists = $todolists->where('group_id', $group_id);
            }
            $todolists = $todolists->get();
            
            $diary = Diary::query();
            
            
            
            
            // 検索するときはquery
            $keyword = $request->input('keyword');
            if ($keyword && !$group_id) {
                // $keywordに全角スペースがあれば半角スペースに変換し、半角スペースで文字列を区切り配列化 's'変換コード
                $keys = preg_split('/[\s,]+/', mb_convert_kana($keyword, 's'), -1, PREG_SPLIT_NO_EMPTY);
                // 配列になっているのでループ処理
                foreach ($keys as $key) {
                    // title, textをor検索 title, textはカラム名が違うのであれば置き換え
                    $diary->orWhere(function ($query) use ($key) {
                        // function内で定義したものしか使えないけどuseの中に外部で定義したものが使える
                        $query->where('title', 'like', '%' . $key . '%')->orWhere('text', 'like', '%' . $key . '%');
                    });
                }
            } elseif (!$keyword && $group_id) {
                $diary->where('group_id', $group_id);
            } elseif ($keyword && $group_id) {
                // $keywordに全角スペースがあれば半角スペースに変換し、半角スペースで文字列を区切り配列化 's'変換コード
                $keys = preg_split('/[\s,]+/', mb_convert_kana($keyword, 's'), -1, PREG_SPLIT_NO_EMPTY);
                // 配列になっているのでループ処理
                foreach ($keys as $key) {
                    // title, textをor検索 title, textはカラム名が違うのであれば置き換え
                    $diary->orWhere(function ($query) use ($key) {
                        // function内で定義したものしか使えないけどuseの中に外部で定義したものが使える
                        $query->where('title', 'like', '%' . $key . '%')->orWhere('text', 'like', '%' . $key . '%');
                    });
                }
                $diary->where('group_id', $group_id);
            }
            // DD($diary->get());

            $diaries = $diary->paginate(5);
        }
        return view('home', compact('diaries', 'todolists', 'groups', 'group_id', 'keyword', 'icon','group_create','group_infos'));
    }
}


//     public function search(Request $request)
// {
//     // diary取得
//     $diary = Diary::query();
//     // date検索用 開始日
//     $early = $request->input('early'); // 日付検索を入れないのであれば削除
//     // date検索用 終了日
//     $late = $request->input('late'); // 日付検索を入れないのであれば削除
//     // キーワード検索用
//     $keyword = $request->input('keyword');
// ​
//     /**
//         * 日付検索
//         * date = 日記の日付 カラム名が違うのであればdate部分は置き換え
//         * 日付検索がいらないのであれば削除
//         */
//     // $earlyに値があり$lateに値がない場合に処理を実行
//     if ($early && !$late) {
//         // $early以降の日付のデータを検索
//         $diary->where('date', '>=', $early);
//         // $lateに値があり$earlyに値がない場合に処理を実行
//     } elseif (!$early && $late) {
//         // $late以前の日付のデータを検索
//         $diary->where('date', '<=', $late); // $early, $lateに値がある場合に処理を実行 } elseif ($early && $late && $early < $late) { // $early以降、$late以前のデータを検索 $diary->whereBetween('date', [$early, $late]);
//     }
//     /**
//         * orWhere -> いずれかが含まれている場合
//         * where -> すべてが含まれている場合
//         */
//     // $keywordに値がある場合
//     if ($keyword) {
//         // $keywordに全角スペースがあれば半角スペースに変換し、半角スペースで文字列を区切り配列化
//         $keys = preg_split('/[\s,]+/', mb_convert_kana($keyword, 's'), -1, PREG_SPLIT_NO_EMPTY);
//         // 配列になっているのでループ処理
//         foreach ($keys as $key) {
//             // title, textをor検索 title, textはカラム名が違うのであれば置き換え
//             $diary->orWhere('title', 'like', '%' . $key . '%')->orWhere('text', 'like', '%' . $key . '%');
//         }
//     }
//     // ページネーションで取得し、$diariesに代入
//     $diaries = $diary->paginate(5);
//     return view('home')->with([
//         'diaries' => $diaries,
//     ]);
