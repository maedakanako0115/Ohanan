<?php

namespace App\Http\Controllers;
use App\User;
use App\Diary;
use App\Todolist;
use App\Group;

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
    public function index()
    {
        $diaries=Diary::all();
        $todolists=Todolist::all();


        return view('home',compact('diaries','todolists'));
    }
    // public function detail(){
        
    //     return view('detail.mydiary');
    // }   

}
