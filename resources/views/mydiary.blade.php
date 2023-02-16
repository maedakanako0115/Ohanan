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
                        <div class="diary">
                            {{$diary['text']}}
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="d-inline-flex p-2 bd-highlight">
                            <img src="{{asset('storage/image/'.$diary["image"])}}" class="img-fluid pb-2 pt-2" >
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <div class="justify-content-center align-items-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                        コメントする
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModal3Label">コメント</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('comments.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleFormControlInput1" class="form-label">コメント</label>
                            <textarea class='form-control' name="comment" class=height:500px;width:400px; placeholder="内容を入力"></textarea>
                            <input type="hidden" name="diary_id" value="{{$diary['id']}}"> 
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                        </div>
                    </div>
                </div>
                @foreach($diary->comments as $comment)
                <form action="/comment/{{$comment['id']}}" method="post">
                    @csrf
                    @method('put')
                    @if(isset($comment))
                        <h2>{{$comment['comment']}}</h2>
                        <h2>{{$comment['created_at']}}</h2>
                    @else
                        <p>コメントがありません</p>
                    @endif
                    @endforeach
                </form>
                <div class='d-flex justify-content-around'>
                    <form action="{{route('diarys.destroy',$diary['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class='btn btn-danger' type='submit' onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                    <a href="{{route('diarys.edit',$diary['id'])}}">
                        <button class='btn btn-secondary'>編集</button>
                    </a>
                    <a href="{{route('ohana')}}">
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


