@extends('layouts.app')

@section('content')


<dl class="UserProfile">
    <main class="py-4">
        <div class="row justify-content-around">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class='text-center'>
                            <h3>プロフィール</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            @csrf
                            @if ($users->image === null)
                            <img src="{{ asset('storage/image/default.png') }}" class="rounded-circle" alt="プロフィール画像null" width="200" height="200">
                            <!-- asset publicから見つけてる -->
                            @else
                            <img class="rounded-circle" src="{{asset('storage/image/'.$users['image'])}}" alt="プロフィール画像" width="100" height="100">
                            @endif
                        </div>
                        <table class="table table-striped">
                            <tr>
                                <th>氏名</th>
                                <td>{{$users->name}}</td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>{{$users->email}}</td>
                            </tr>
                            <tr>
                                <th>誕生日</th>
                                <td>{{$users->birthday}}</td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>{{$users->tel}}</td>
                            </tr>
                        </table>
                        <div class='d-flex justify-content-around mt-3'>
                            @if($groups['user_id']==Auth::id())
                            <a class='btn btn-danger' href="{{ route('gi.destroy', $users->id) }}" onclick="return confirm('本当に削除しますか？')">メンバー削除<i class="far fa-trash-alt"></i></a>
                            @endif
                            <button type='button' class='btn btn-primary pb-2 pt-2' onClick="history.back()"><i class="fas fa-home"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</dl>
@endsection