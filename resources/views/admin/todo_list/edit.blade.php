@extends('layouts.admin')
@section('title', 'todo_listの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>todo_list編集</h2>
                <form action="{{ action('Admin\TodoListController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $todo_list_form->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="description">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="description" rows="20">{{ $todo_list_form->description }}</textarea>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2" for="importance">重要度</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="importance" value="{{ $todo_list_form->importance }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $todo_list_form->id }}">
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
