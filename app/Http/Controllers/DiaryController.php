<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Comment;
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
    public function create()
    {        
        return view('create_diary');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diary=new Diary;
        $diary->user_id=Auth::id();
        $colums=['date','title','text','image'];
        foreach($colums as $colum){
            $diary->$colum=$request->$colum;
            // todo 画像登録処理（if）
            if(!is_null($request->image)){
                // ディレクトリ名
                // $dir='image';
                 // アップロードされたファイル名を取得
                // $file_name=$request->image;
                // $file_name=$request->file('image')->getClientOriginalName();
                 // 取得したファイル名で保存
                $request->file('image')->store('public/image');
                $diary->image=$request->file('image')->getClientOriginalName();
            }
        }
        $diary->save();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function show(Diary $diary)
    {
        $comment=new Comment;
        $comments=Comment::all();
        return view('mydiary', compact('diary','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function edit(Diary $diary)
    {
        return view('edit_diary', compact('diary'));
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
        $diary->date=$request->date;
        $diary->title=$request->title;
        $diary->text=$request->text;
        // todo 画像登録処理（if）
        if(!is_null($request->image)){
            $path=$request->image->store('public/image');
            // 名前の保存（ランダムネーム）
            $file_name=basename($path);
            $diary->image=$file_name;
        }
        
        $diary->save();
        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diary  $diary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diary $diary)
    {
        $diary->delete();
        return redirect()->route('home');

    }
}
