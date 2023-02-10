@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                <div class='text-center'><h3>日記</h3></div>
            </div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <div class="d-flex justify-content-center align-items-center">
                            <h4 class="pb-2 pt-2">{{$diary['title']}}</h4>
                            <h5 class="px-4 border-bottom pb-2 pt-2">{{$diary['date']}}</h5>
                        </div>
                        <div class="row justify-content-around"></div>
                        <p class="text">{{$diary['comment']}}</p>
                        <div></div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="d-inline-flex p-2 bd-highlight">
                            <img src="{{asset('storage/image/'.$diary["image"])}}" class="img-fluid pb-2 pt-2" >
                        </div>
                    </div>
                </div>
                <div class='d-flex justify-content-around'>
                    <form action="{{route('diarys.destroy',$diary['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class='btn btn-danger' type='submit' onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
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
<!-- <main class="py-4">
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
                        @if(isset($diary['id']))
                        <tr>
                            <th scope='col'><img src="{{asset('storage/image/'.$diary["image"])}}" ></th>
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
                    <form action="{{route('diarys.destroy',$diary['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class='btn btn-danger' type='submit' onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                    
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
</main> -->


