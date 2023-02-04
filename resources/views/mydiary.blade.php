@extends('layouts.layout')

@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header">
                <div class='text-center'>日記</div>
            </div>
            <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col'>タイトル</th>
                            <th scope='col'>日付</th>
                            <th scope='col'>内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ここに支出を表示する -->
                        @if(isset($diary['id']))
                        <tr>
                            <th scope='col'>
                            </th>
                            <th scope='col'>{{$diary['title']}}</th>
                            <th scope='col'>{{$diary['date']}}</th>
                            <th scope='col'>{{$diary['comment']}}</th>
                            </th>
                            <th scope='col'></th>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class='d-flex justify-content-around mt-3'>
                    <a href="{{route('diarys.destroy',$diary['id'])}}">
                        <button class='btn btn-danger'>削除</button>
                    </a>
                    
                    <a href="{{route('diarys.edit',$diary['id'])}}">
                        <button class='btn btn-secondary'>編集</button>
                    </a>
                    <a href="{{route('home')}}">
                        <button class='btn btn-warning'>戻る</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection