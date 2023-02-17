@extends('layouts.app')

@section('content')

<dl class="UserProfile">
<main class="py-4">
    <div class="row justify-content-around">
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">
                    <div class='text-center'><h3>プロフィール</h3></div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        @csrf
                        @if ($user->image === null)
                        <img src="{{ asset('storage/image/default.png') }}" class="rounded-circle"  alt="プロフィール画像null" width="200" height="200">
                        <!-- asset publicから見つけてる -->
                        @else
                        <img class="rounded-circle" src="{{asset('storage/image/'.$user["image"])}}" alt="プロフィール画像" width="100" height="100">
                        @endif
                    </div>
                    <table class="table table-striped">  
                        <tr>
                            <th>氏名</th>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>  
                        <tr>
                            <th>メールアドレス</th>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>  
                        <tr>
                            <th>誕生日</th>
                            <td>{{ Auth::user()->birthday }}</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>{{ Auth::user()->tel }}</td>
                        </tr>
                    </table>
                    <div class='d-flex justify-content-around mt-3'>
                        <a href="{{route('users.edit',$user['id'])}}">
                            <button class='btn btn-secondary'>編集</button>
                        </a>
                        <a href="{{ route('home', ['group_id'=>$group_id]) }}">
                            <button class='btn btn-warning'>戻る</button>
                        </a>
                    </div>
                </div>
        </div>
    </div>
</main>
@endsection
