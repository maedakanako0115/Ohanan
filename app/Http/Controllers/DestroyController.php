<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group_info;
use App\Group;


class DestroyController extends Controller
{
    public function destroy(Request $request ,$id)
    {

        $gi = Group_info::where('user_id',$id)->first();
        $gi->delete();
        return redirect()->route('home',['group_id'=>$request->group_id]);
    }
}
