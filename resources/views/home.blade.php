@extends('layouts.app')

@section('content')

@if(!$group_id)
<div class="card">
    <h3 class="card-header text-center">かぞく選択が選択されてません</h3>
    <div class="card-body">
        <div class="text-center">
            <p>かぞくで日記・Todoリストを共有しよう！</p>
            <div class="btn-group">
                <form action="/home" method="get">
                    @csrf
                    <select class="custom-select" name="group_id">
                        <option selected>グループ選択</option>
                        @foreach($groups as $group)
                        @if($group_id == $group['id'])
                        <option value="{{$group['id']}}" selected>{{$group['name']}}</option>
                        @else
                        <option value="{{$group['id']}}">{{$group['name']}}</option>
                        @endif
                        @endforeach
                    </select>
                    <button type="submit" class="mr-4">移動する</button>
                </form>
                <a href="{{route('groups.create')}}">
                    <button type="button" class="btn btn-outline-success">かぞく作成</button>
                </a>
            </div>
        </div>
    </div>
</div>

@else
<div class="text-left">
    <div class="d-flex">
        
    </div>
<div class="text-right">
    <div class="btn-group pb-4 pt-3">
        <form action="/home" method="get">
            @csrf
            <li></li>
            <select class="custom-select" name="group_id">
                <option selected>グループ選択</option>
                @foreach($groups as $group)
                @if($group_id == $group['id'])
                <option value="{{$group['id']}}" selected>{{$group['name']}}</option>
                @else
                <option value="{{$group['id']}}">{{$group['name']}}</option>
                @endif
                @endforeach
            </select>
            <button type="submit" class=" btn-outline-info m-4">移動する</button>
        </form>
        <form action="{{route('groups.show')}}">
            <button type="submit" class="btn btn-outline-info m-4">かぞく</button>
            <input type="text" name="group_id" value="{{$group_id}}" hidden>
        </form>
        <a href="{{route('groups.create')}}">
            <button type="button" class="btn btn-outline-success m-4">かぞく作成</button>
        </a>
        <form action="{{route('groups.index')}}">
            <button type="submit" class="btn btn-outline-info m-4">かぞく招待</button>
            <input type="text" name="group_id" value="{{$group_id}}" hidden>
        </form>
    </div>
</div>
<div class="mx-auto">
    <div class="row justify-content-around">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class='text-center'>To do List</div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                        リスト追加
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal3Label">リスト作成</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('todolists.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="exampleFormControlInput1" class="form-label">リスト名</label>
                                        <input type="list_name" name="list_name" class="form-control">
                                        <label for="exampleFormControlInput1" class="form-label">名前</label>
                                        <input type="assign_personname" name="assign_personname" class="form-control">
                                        <label for="exampleFormControlInput1" class="form-label">期日</label>
                                        <input type="date" name="deadline" id='date' class="form-control">
                                        <input type="hidden" name="group_id" value="{{$group_id}}">

                                        <!-- <select name='assign_personname' class='form-control'>
                                            <option value='' hidden>選択</option>
                                            <option value=""></option> -->
                                        <!-- </select> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                        <button type="submit" class="btn btn-primary">登録</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class='d-flex align-items-center justify-content-center px-4 border-bottom pb-2 pt-2'>
                        <div class="col-md-10">
                            <div class='d-flex justify-content-center align-items-center'>
                                <div class='col-md-2'>To do</div>
                                <div class='col-md-2'>担当</div>
                                <div class='col-md-2'>状態</div>
                                <div class='col-md-4'>期限</div>
                                <div class='col-md-2'></div>
                            </div>
                        </div>
                        <div class='col-md-2'></div>
                    </div>
                    @if(isset($todolists))
                    @foreach($todolists as $todolist)
                    <div class='d-flex align-items-center justify-content-center px-4 border-bottom pb-2 pt-2'>
                        <div class='col-md-10'>
                            <form action="/todolists/{{$todolist['id']}}" method="post">
                                @csrf
                                @method('put')
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div class='col-md-2'>✔️{{$todolist['list_name']}}</div>
                                    <div class='col-md-2'>{{$todolist['assign_personname']}}</div>
                                    <div class='col-md-2'>
                                        <select name="status">
                                            @foreach(\Status::STATUS as $key => $value)
                                            @if($todolist['status'] === $key)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @endif
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='col-md-4'>{{$todolist['deadline']}}</div>
                                    <div class='col-md-2'>
                                        <button type="submit" class='btn btn-outline-primary' formaction="/todolists/{{$todolist['id']}}">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='col-md-2'>
                            <form action="{{route('todolists.destroy',$todolist['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class='btn btn-outline-primary' formaction="{{route('todolists.destroy',$todolist['id'])}}">削除</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>日記</div>
                    <a href="/diarys/create?group_id={{$group_id}}">
                        <button type="submit" class="btn btn-primary">日記追加</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="input-group border-bottom pb-2 pt-2">
                            <form method="get" action="/home">
                                @csrf
                                <input type="text" name="keyword" class="form-control" placeholder="テキスト入力欄">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">検索</button>
                                </span>
                                <input type="text" name="group_id" value="{{$group_id}}" hidden>
                            </form>
                        </div>
                        @if(isset($diaries))
                        @foreach($diaries as $diary)
                        @csrf
                        <div class="container">
                            <div class="d-flex">
                                <div class="col-md-8">
                                    <div class="card">
                                        <a href="{{route('diarys.show',$diary['id'])}}">
                                            <img class="card-img-top" src="{{asset('storage/image/'.$diary["image"])}}" alt="Card image cap" width="100" height="200" action="{{route('diarys.show',$diary['id'])}}">
                                            <div class="card-body text-center">{{$diary['title']}}</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

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