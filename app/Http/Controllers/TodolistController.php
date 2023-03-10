<?php

namespace App\Http\Controllers;

use App\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $group_id=$request->group_id;
        return view('home',compact('group_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todolist=new Todolist;
        $colums=['list_name','assign_personname','deadline','group_id'];
        foreach($colums as $colum){
            $todolist->$colum=$request->$colum;
        }
        $todolist->user_id=Auth::id();
        $todolist->save();
        return redirect()->route('home',['group_id'=>$request->group_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todolist=Todolist::find($id);
        $todolist->status=$request->status;
        $todolist->save();
        return redirect()->route('home',['group_id'=>$request->group_id]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $todolist=Todolist::find($id);
        $todolist->delete();
        return redirect()->route('home',['group_id'=>$request->group_id]);

    }
}
