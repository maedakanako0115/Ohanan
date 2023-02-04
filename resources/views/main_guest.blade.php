@extends('layouts.app')

@section('content')
<div class="text-right">
    <div class="btn-group">
        <option value='' class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            グループ選択 
        </option>
        <button type="button" class="btn btn-outline-success" >グループ作成</button>
    </div>
</div>


<div class="mx-auto">
    <div class="row justify-content-around">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class='text-center'>To do List</div>
                    </form>
                </div>
                <div class="card-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th></th>
                            <th scope='col' class= "text-center"></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th scope='col'></th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope='col'>
                                <a href=""></a>
                            </th>
                            <th scope='col'></th>
                            <th scope='col'></th>
                            
                        </tr>
                    </tbody>
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
                <button type="submit" class="btn btn-primary">日記追加</button>
                </div>
            </div>
        </div>
    </div>
</div>
