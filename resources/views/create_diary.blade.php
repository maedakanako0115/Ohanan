@extends('layouts.layout')

@section('content')
<div class='row justify-content-center'>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class='text-center'><h2>日記追加画面</h2></div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <a href="{{ route('home') }}">
                        <button class='btn btn-primary pb-2 pt-2'>一覧に戻る</button>
                    </a>
                    <form action="{{ route('diarys.store')}}" method="post">
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
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">日記記入</p>
                            <textarea class='form-control' name="comment" class=height:400px;width:400px; placeholder="内容を入力"></textarea>
                        </div>
                        <div class='row justify-content-center'>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
