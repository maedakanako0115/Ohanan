<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Post;
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
        $colums=['date','title','comment',];
        foreach($colums as $colum){
            $diary->$colum=$request->$colum;
        }
        $diary->user_id=Auth::id();
        // todo 画像登録処理（if）
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
        return view('mydiary', compact('diary'));
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
        $diary->comment=$request->comment;
        // todo 画像登録処理（if）
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
