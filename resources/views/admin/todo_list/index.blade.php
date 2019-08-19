@extends('layouts.admin')
@section('title', '登録済みtodo_listの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>todo_list一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoListController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoListController@doneIndex') }}" role="button" class="btn btn-primary">完了済みリスト</a>
            </div>
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoListController@index', ['order' => 'importance_desc']) }}" role="button" class="btn btn-primary">重要度順</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\TodoListController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_name" value="{{ $cond_name }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-todo_list col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">ユーザID</th>
                                <th width="20%">名前</th>
                                <th width="40%">本文</th>
                                <th width="10%">重要度</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $todo_list)
                                <tr>
                                    @if($todo_list->is_complete != 1)
                                    <th>{{ $todo_list->id }}</th>
                                    <td>{{ str_limit($user->name, 100) }}</td>
                                    <td>{{ str_limit($todo_list->name, 100) }}</td>
                                    <td>{{ str_limit($todo_list->description, 250) }}</td>
                                    <td>{{ str_limit($todo_list->importance, 100) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{action('Admin\TodoListController@edit', ['id' => $todo_list->id])}}">編集</a>
                                        </div>
                                        <div>
                                            <a href ="{{action('Admin\TodoListController@delete', ['id' => $todo_list->id])}}">削除</a>
                                        </div>
                                        <div>
                                            <a href ="{{action('Admin\TodoListController@complete', ['id' => $todo_list->id])}}">完了</a>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection