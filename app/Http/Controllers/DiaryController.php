<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Comment;
use App\Group;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $group_id = $request->group_id;
        return view('create_diary', compact('group_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diary = new Diary;
        $diary->user_id = Auth::id();

        if (!is_null($request->image)) {
            // ディレクトリ名
            // $dir='image';
            // アップロードされたファイル名を取得
            // $file_name=$request->image;
            // $file_name=$request->file('image')->getClientOriginalName();
            // 取得したファイル名で保存
            $request->file('image')->store('public/image');
            $diary->image = $request->file('image')->hashName();
        }

        $colums = ['date', 'title', 'text', 'group_id'];
        foreach ($colums as $colum) {
            $diary->$colum = $request->$colum;
            // todo 画像登録処理（if）

        }
        $diary->save();
        return redirect()->route('home', ['group_id' => $request->group_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Diary $diary)
    {

        $like_model = new Like;
        // $group_num= Diary::where('id', '=' ,$diary);
        $comments = Comment::all();
        $comments->user_id = Auth::id();
        $group_id = $request->group_id;
        return view('mydiary', compact('diary','like_model', 'comments', 'group_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Diary $diary)
    {
        $group_id = $request->group_id;

        return view('edit_diary', compact('diary', 'group_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diary $diary)
    {
        $diary->date = $request->date;
        $diary->title = $request->title;
        $diary->text = $request->text;
        // todo 画像登録処理（if）
        if (!is_null($request->image)) {
            $path = $request->image->store('public/image');
            // 名前の保存（ランダムネーム）
            $file_name = basename($path);
            $diary->image = $file_name;
        }

        $diary->save();
        return redirect()->route('home', ['group_id' => $request->group_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Diary $diary)
    {
        $diary->comments()->delete();
        $diary->delete();
        return redirect()->route('home', ['group_id' => $request->group_id]);
    }

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $diary_id = $request->diary_id;
        $like = new Like;
        $diary =Diary::find($diary_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $diary_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('diary_id', $diary_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->diary_id = $request->diary_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        //下記の記述でajaxに引数の値を返す
        return response()->json();
    
    }

}
