@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>
                        <h3>かぞく招待</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form method="get" action="{{route('groups.index')}}">
                            @csrf
                            <input type="text" name="keyword" class="form-control" value="{{$keyword}}">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">検索</button>
                            </span>
                        </form>
                    </div>
                </div>
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
                        @foreach($user as $you)
                        <tr>
                            <th></th>
                            <th scope='col'>{{$you['name']}}</th>
                            <th scope='col'>{{$you['email']}}</th>
                            <th>
                                <form method="POST" action="{{ route('groups.update',$you->id)}}">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success">
                                        招待
                                    </button>
                                </form>
                            </th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                @endsection