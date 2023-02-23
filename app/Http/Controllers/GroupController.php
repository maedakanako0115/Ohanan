<?php

namespace App\Http\Controllers;
use App\User;
use App\Group;
use App\Group_info;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $group_id=$request->group_id;
        $keyword = $request->input('keyword');
        if($keyword){
        // DD($keyword);
        $user=User::where('email',$keyword)->get();
        }else{
            $user=[];
        }
        

        return view('invite_group',compact('user','keyword','group_id'));

        



    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_group');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $group=new Group;
        $group->user_id=Auth::id();
        $colums=['name'];
        foreach($colums as $colum){
            $group->$colum=$request->$colum;
        }
        $group->save();
        return redirect()->route('home',['group_id'=>$request->group_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Group $group)
    {
        $group_id = $request->group_id;

        return view('mygroup', compact('group','group_id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Group $group)
    {
        $group_id=$request->group_id;
        return view('invite_group', compact('group','group_id','you'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    { 
        $group_info=new Group_info;
        // findがテーブルの主key(id)でしか絞れない
        $group_info->group_id=$request->group_id;
        $group_info->user_id=$id;
        

        
        $group_info->save();
        return redirect()->route('home',['group_id'=>$request->group_id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Group $group)
    {
        $group->delete();
        return redirect()->route('home',['group_id'=>$request->group_id]);

    }
}
