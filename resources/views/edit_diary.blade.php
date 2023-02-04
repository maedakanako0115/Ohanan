@extends('layouts.layout')

@section('content')

<div class="">日記追加画面</h1>
<a href="{{ route('home') }}">一覧に戻る</a>

<form action="{{ route('diarys.update',$diary->id)}}" method="post">
@csrf
@method('put')
<div class="">
    <label for=title>タイトル
        <input type="text" name="title" value="{{$diary['title']}}" value="{{old('title')}}"/>
    </label>
</div>
<div>
    <label for=date>日付</label>
        <input type="text" name="date" id='date' value="{{$diary['date']}}" value="{{old('date')}}"/>
    </label>
</div>
<div>
    <label for=image>画像追加
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </label>
</div>
<div>
    <label for=comment>
        <textarea class='form-control' name="comment">{{old('comment',$diary->comment)}}</textarea>
    </label>
</div>
<div class='row justify-content-center'>
<button type="submit" class="btn btn-primary">保存</button>

</form>
@endsection
