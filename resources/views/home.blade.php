@extends('layouts.app')

@section('content')

@if(!$group_id)
<div class="card">
    <h3 class="card-header text-center">かぞく選択が選択されてません</h3>
    <div class="card-body">
        <div class="text-center">
            <p>かぞくで日記・Todoリストを共有しよう！</p>
            <div class="d-flex justify-content-around align-items-center mb-3">
                <div class="d-flex">
                    <form action="/home" method="get" class="d-flex">
                        @csrf
                        <div class="input-group">
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
                            <div class="">
                                <button type="submit" class="btn btn-outline-primary">移動する</button>
                            </div>
                        </div>
                    </form>
                    <div class="d-flex">
                        <a href="{{route('groups.create')}}">
                            <button type="button" class="btn btn-outline-success mx-2">かぞく作成</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
<div class="container">
    <div class="d-flex justify-content-around align-items-center mb-3">
        <div class="d-flex">
            <img src="{{asset('storage/image/' . $group_create)}}" alt="Circle image" width="60px">
            @foreach($icon as $val)
            <a href="{{route('group_infos.index',$group_info['user_id'])}}">
                <div class="mx-3">
                    <img src="{{asset('storage/image/' . $val)}}" alt="Circle image" width="60px">
                </div>
            </a>
            @endforeach
        </div>
        <div class="d-flex">
            <form action="/home" method="get" class="d-flex">
                @csrf
                <div class="input-group">
                    <select class="custom-select te" name="group_id">
                        <option selected>グループ選択</option>
                        @foreach($groups as $group)
                        @if($group_id == $group['id'])
                        <option value="{{$group['id']}}" selected>{{$group['name']}}</option>
                        @else
                        <option value="{{$group['id']}}">{{$group['name']}}</option>
                        @endif
                        @endforeach
                    </select>
                    <div class="">
                        <button type="submit" class="btn btn-outline-primary">移動する</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-flex">
            <a href="{{route('groups.create')}}">
                <button type="button" class="btn btn-outline-success m-4">かぞく作成</button>
            </a>
            @if($group['user_id']==Auth::id())
            <form action="{{route('groups.index')}}">
                <button type="submit" class="btn btn-outline-info m-4">かぞく招待</button>
                <input type="text" name="group_id" value="{{$group_id}}" hidden>
            </form>
            <form action="{{route('groups.destroy',$group['id'])}}" method="post">
                @csrf
                @method('DELETE')
                <button class='btn btn-outline-danger m-4' type='submit' onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
            @endif
        </div>
    </div>
</div>
<div class="mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class='text-center'>
                        <h3 class="">To do List<i class="fas fa-clipboard-list ml-2"></i></h3>
                    </div>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal3">
                        <i class="far fa-plus-square"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title " id="exampleModal3Label">リスト作成</h5>
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
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                        <button type="submit" class="btn btn-primary">登録</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- todoリスト内容 -->
                    <div class="card-body">
                        <div class='d-flex align-items-center justify-content-center px-4 border-bottom pb-2 pt-2'>
                            <div class="col-md-10">
                                <div class='d-flex justify-content-center align-items-center'>
                                    <div class='col-md-2'></div>
                                    <div class='col-md-2'></div>
                                    <div class='col-md-2'></div>
                                    <div class='col-md-2'>To do</div>
                                    <div class='col-md-3'>担当</div>
                                    <div class='col-md-3'>状態</div>
                                    <div class='col-md-4'>期限</div>
                                </div>
                            </div>
                            <div class='col-md-2'></div>
                            <div class='col-md-2'></div>
                            <div class='col-md-2'></div>
                        </div>
                        @if(isset($todolists))
                        @foreach($todolists as $todolist)
                        <div class='d-flex align-items-center justify-content-center px-4 border-bottom pb-2 pt-2'>
                            <div class='col-md-11'>
                                <form action="/todolists/{{$todolist['id']}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class='d-flex justify-content-center align-items-center'>
                                        <div class='col-md-2'>✔️{{$todolist['list_name']}}</div>
                                        <div class='col-md-2'>{{$todolist['assign_personname']}}</div>
                                        <div class='col-md-2'>
                                            <select name="status" class="text-center">
                                                @foreach(\Status::STATUS as $key => $value)
                                                @if($todolist['status'] === $key)
                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                                @endif
                                                <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class='col-md-2'>{{$todolist['deadline']}}</div>
                                        <div class='col-md-2'>
                                            <form action="{{route('todolists.update',$todolist['id'])}}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="submit" class='btn btn-outline-primary' formaction="/todolists/{{$todolist['id']}}">更新</button>
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
                                </form>
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
<div class="mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-9 pb-2 pt-5">
            <div class="card">
                <div class="card-body">
                    <div class='text-center'>
                        <h3>日記<i class="fas fa-book ml-2"></i></h3>
                    </div>
                    <a href="/diarys/create?group_id={{$group_id}}">
                        <button type="submit" class="btn btn-primary float-right"><i class="far fa-plus-square"></i></button>
                    </a>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="input-group border-bottom pb-2 pt-2">
                                <form method="get" action="/home" class="form-inline">
                                    @csrf
                                    <input type="text" name="keyword" class="form-control" placeholder="テキスト入力欄">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-info">🔍</button>
                                    </span>
                                    <input type="text" name="group_id" value="{{$group_id}}" hidden>
                                </form>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="container d-flex flex-wrap">
                                @if(isset($diaries))
                                @foreach($diaries as $diary)
                                @csrf
                                <div class="w-30">
                                    <div class="card mr-4">
                                        <div class="col text-center pt-2">
                                            <a href="{{route('diarys.show',$diary['id'])}}">
                                                <img class="card-img-top" src="{{asset('storage/image/'.$diary['image'])}}" alt="Card image cap" width="150" height="200" action="{{route('diarys.show',$diary['id'])}}">
                                                <input type="text" name="group_id" value="{{$group_id}}" hidden>
                                            </a>
                                            <div class="card-body text-center">{{$diary['title']}}</div>
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
        </div>
    </div>
</div>


@endif

@endsection