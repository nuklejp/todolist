<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
   Route::get('todo_list/create', 'Admin\TodoListController@add'); 
   Route::post('todo_list/create', 'Admin\TodoListController@create');
   Route::get('todo_list/edit', 'Admin\TodoListController@edit');
   Route::post('todo_list/edit', 'Admin\TodoListController@update');
   Route::get('todo_list', 'Admin\TodoListController@index');
   Route::get('todo_list/delete', 'Admin\TodoListController@delete');
   Route::get('todo_list/complete', 'Admin\TodoListController@complete');
   Route::get('todo_list/doneIndex', 'Admin\TodoListController@doneIndex');
   Route::get('todo_list/incomplete', 'Admin\TodoListController@incomplete');
   Route::get('todo_list/order', 'Admin\TodoListController@order');


});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
