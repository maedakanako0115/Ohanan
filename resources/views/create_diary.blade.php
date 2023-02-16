@extends('layouts.app')

@section('content')
<div class='row justify-content-center'>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class='text-center'><h2>日記追加</h2></div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('diarys.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                            <p class="col-sm-2 col-form-label">タイトル</p>
                            <input type="text" name="title" class="col-sm-8" placeholder="日記のタイトルを入力"/>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">日付</p>
                            <input type="date" name="date" id='date'class="col-sm-8" placeholder="0000/00/00"/>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">画像追加</p>
                            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">日記記入</p>
                            <textarea class='form-control'  name="text" class=height:500px;width:400px; placeholder="内容を入力"></textarea>
                        </div>
                        <input type="hidden" name="group_id" value="{{$group_id}}">
                        <div class='d-flex justify-content-around mt-3'>
                            <a href="{{ route('home', ['group_id'=>$group_id]) }}">
                                <button type='button' class='btn btn-primary pb-2 pt-2'>一覧に戻る</button>
                            </a>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
