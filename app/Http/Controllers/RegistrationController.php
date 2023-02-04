
<?php

namespace App\Http\Controllers;
use App\Diary;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function createForm(){
        
        return view('diaries.create',[
            'title'=>'日記一覧',
        ]);
    }  
    public function create(DiaryRequest $request){
        $diarys=new Diary;
            $colums=['date','user_id','title','category','image','comment',];
            foreach($colums as $colum){
                $diarys->$colum=$request->$colum;
            }
        
        return view('diaries.create');
    }   

}
