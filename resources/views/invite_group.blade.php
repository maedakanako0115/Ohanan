@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="card">
                    <div class='text-center py-4 border-bottom mx-3'>
                        <h3>かぞく招待</h3>
                    </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class='d-flex align-items-center pb-4 pt-2'>
                            <form method="get" action="{{route('groups.index')}}">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" value="{{$keyword}}">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-success">🔍</button>
                                    </span>
                                    <input type="hidden" name="group_id" value="{{$group_id}}">
                                    <div class="">
                                        <button type='button' class='btn btn-primary ml-5' onClick="history.back()"><i class="fas fa-home"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="card">
                @foreach($user as $you)
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col'>名前</th>
                            <th scope='col'>アドレス</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <th scope='col'>{{$you['name']}}</th>
                            <th scope='col'>{{$you['email']}}</th>
                            <input type="hidden" name="group_id" value="{{$group_id}}">
                            <th>
                                <form method="POST" action="{{ route('groups.update',$you->id)}}">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="group_id" value="{{$group_id}}">
                                    <button type="submit" class="btn btn-success">
                                        招待
                                    </button>
                                </form>
                            </th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection