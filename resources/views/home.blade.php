@extends('layouts.app')

@section('content')
<div class="text-right">
    <div class="btn-group">
        <option value='' class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            グループ選択 
        </option>
        <button type="button" class="btn btn-outline-success" >グループ作成</button>
        <button type="button" class="btn btn-outline-info">グループ編集</button>
        <button type="button" class="btn btn-outline-danger">グループ削除</button>
    </div>
</div>
<div class="mx-auto">
    <div class="row justify-content-around">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>To do List</div>
                        <button type="submit" class="btn btn-primary">リスト追加</button>
                    </form>
                </div>
                <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col'>To do</th>
                            <th scope='col'>担当</th>
                            <th scope='col'>状態</th>
                            <th scope='col'>期限</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($todolists as $todolist)
                        <tr>
                            <th scope='col'>
                                <a href=""></a>
                            </th>
                            <th scope='col'>{{$todolist['list_name']}}</th>
                            <th scope='col'>{{$todolist['assign_personname']}}</th>
                            <th scope='col'></th>
                            <th scope='col'>{{$todolist['deadline']}}</th>
                        </tr>
                    </tbody>
                    @endforeach
                </table>

                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class='text-center'>日記</div>
                <form class="d-flex justify-content-center align-items-center">
                    <div class="form-outline flex-fill">
                        <input type="text" id="form3" class="form-control form-control-lg"  placeholder="タイトル　カテゴリー…"/>
                    </div>
                <button type="button" class="btn btn-primary">検索</button> 
            </div>
            <div class="card-body">
                <div class="card-body">
                    <a href="{{route('diarys.create')}}">
                    <button type="submit" class="btn btn-primary" >日記追加</button>
                </a>
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col'>タイトル</th>
                            <th scope='col'>日付</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diaries as $diary)
                        <tr>
                            <th scope='col'>
                                <a href="{{route('diarys.show',$diary['id'])}}">♯</a>
                            </th>
                            <th scope='col'>{{$diary['title']}}</th>
                            <th scope='col'>{{$diary['date']}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
