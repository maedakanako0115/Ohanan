@extends('layouts.app')

@section('content')
<div class='row justify-content-center'>
    <div class="col-md-5">
        <div class="card my-5">
            <div class='text-center py-4 border-bottom mx-3'>
                <h2>家族作成</h2>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('groups.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                            <p class="col-sm-2 col-form-label">家族名</p>
                            <input type="text" name="name" class="col-sm-8" placeholder="山田家" />
                        </div>
                        <div class='d-flex justify-content-around mt-3'>
                            <button type='button' class='btn btn-primary pb-2 pt-2' onClick="history.back()"><i class="fas fa-home"></i></button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection