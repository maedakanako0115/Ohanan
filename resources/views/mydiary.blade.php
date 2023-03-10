@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="box1">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-12 col-sm-6 col-md-8">
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="pb-2 pt-2">{{$diary['title']}}</h4>
                                <h5 class="px-4 border-bottom pb-2 pt-2">{{$diary['date']}}</h5>
                                @if($like_model->like_exist(Auth::user()->id,$diary->id))
                                <form action="{{route('posts.ajaxlike')}}" method="post">
                                    @csrf
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle loved " href="" data-diaryid="{{ $diary->id }}"><i class="fas fa-heart"></i></a>
                                    </p>
                                    @else
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle" href="" data-diaryid="{{ $diary->id }}"><i class="far fa-heart"></i></a>
                                    </p>
                                </form>
                                @endif
                            </div>
                            <div class="diary">
                                {{$diary['text']}}
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-inline-flex p-2 bd-highlight">
                                @csrf
                                @if ($diary->image === null)
                                <img src="{{ asset('storage/image/noimage.png') }}" class="img-fluid pb-2 pt-2">
                                @else
                                <img src="{{asset('storage/image/'.$diary['image'])}}" class="img-fluid pb-2 pt-2">
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="justify-content-center align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3">
                            ??????????????????<i class="far fa-comment ml-2"></i>
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal3Label">????????????</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('comments.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="exampleFormControlInput1" class="form-label">????????????</label>
                                        <textarea class='form-control' name="comment" class=height:500px;width:400px; placeholder="???????????????"></textarea>
                                        <input type="hidden" name="diary_id" value="{{$diary['id']}}">
                                        <input type="hidden" name="group_id" value="{{$diary['group_id']}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">??????</button>
                                        <button type="submit" class="btn btn-primary">??????</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @foreach($diary->comments as $comment)
                    <div class='box14'>
                        <form action="/comment/{{$comment['id']}}" method="post">
                            @csrf
                            @method('put')
                            @if(isset($comment))
                            <div class='d-flex align-items-center pb-4 pt-2'>
                                <div class='col-md-2 box14-title'>{{$comment->user->name}}</div>
                                <div class='col-md-3'>{{$comment['comment']}}</div>
                                <div class='col-md-4'>{{$comment['created_at']}}</div>
                                <form action="{{route('comments.destroy',$comment['id'])}}" method="post" class=>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class='btn btn-outline-danger' formaction="{{route('comments.destroy',$comment['id'])}}" onclick="return confirm('??????????????????????????????')"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </form>
                        @endif
                        @endforeach
                        </form>
                        <div class='d-flex justify-content-around'>
                            <button type='button' class='btn btn-primary pb-2 pt-2' onClick="history.back()"><i class="fas fa-home"></i></button>
                            @if($diary['user_id']==Auth::id())
                            <a href="{{route('diarys.edit',$diary['id'])}}">
                                <button class='btn btn-secondary'>??????<i class="fas fa-edit ml-2"></i></button>
                            </a>
                            <form action="{{route('diarys.destroy',$diary['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class='btn btn-danger' type='submit' onclick="return confirm('??????????????????????????????')"><i class="far fa-trash-alt"></i></button>
                            </form>
                            @endif
                        </div>
                    </div>
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
                <div class='text-center'>??????</div>
            </div>
            <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col'>????????????</th>
                            <th scope='col'>??????</th>
                            <th scope='col'>??????</th>
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
                        <button class='btn btn-danger' type='submit' onclick="return confirm('??????????????????????????????')">??????</button>
                    </form>
                    
                    <a href="{{route('diarys.edit',$diary['id'])}}">
                        <button class='btn btn-secondary'>??????</button>
                    </a>
                    <a href="{{route('home')}}">
                        <button class='btn btn-warning'>??????</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main> -->