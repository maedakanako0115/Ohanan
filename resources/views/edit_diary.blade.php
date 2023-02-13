@extends('layouts.app')

@section('content')

<div class='row justify-content-center'>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class='text-center'><h2>日記編集</h2></div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('diarys.update',$diary->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row ">
                            <p class="col-sm-2 col-form-label">タイトル</p>
                            <input type="text" name="title" class="col-sm-8" value="{{$diary['title']}}" value="{{old('title')}}"/>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">日付</p>
                            <input type="date" name="date" id='date'class="col-sm-8" value="{{$diary['date']}}" value="{{old('date')}}"/>
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">画像追加</p>
                            <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" value="{{$diary['image']}}">
                        </div>
                        <div class="form-group row">
                            <p class="col-sm-2 col-form-label">日記記入</p>
                            <textarea class='form-control' name="text" class=height:500px;width:400px; >{{old('text',$diary->text)}}</textarea>
                        </div>
                        <div class='d-flex justify-content-around mt-3'>
                            <a href="{{ route('home') }}">
                                <button class='btn btn-primary pb-2 pt-2'>一覧に戻る</button>
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
