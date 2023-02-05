@extends('layouts.layout')

@section('content')

<div class="">日記追加画面</h1>
<a href="{{ route('home') }}">一覧に戻る</a>

<form action="{{ route('diarys.store')}}" method="post">
@csrf
<div class="">
    <label for=title>タイトル
        <input type="text" name="title" placeholder="日記のタイトルを入力"/>
    </label>
</div>
<div>
    <label for=date>日付</label>
        <input type="date" name="date" id='date' placeholder="0000/00/00"/>
    </label>
</div>
<div>
    <label for=image>画像追加
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </label>
</div>
<div>
    <label for=comment>
        <textarea class='form-control' name="comment" placeholder="内容を入力"></textarea>
    </label>
</div>
<div class='row justify-content-center'>
<button type="submit" class="btn btn-primary">保存</button>

</form>
@endsection
