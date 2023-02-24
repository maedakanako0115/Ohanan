@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレスを確認してください</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            新しい確認リンクがあなたのメール アドレスに送信されました
                        </div>
                    @endif

                    続行する前に、メールで確認リンクを確認してください
                    メールが届かない場合
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">こちらをクリックして下さい。</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
