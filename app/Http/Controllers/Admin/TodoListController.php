<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\TodoList;

use Illuminate\Support\Facades\Auth;  

class TodoListController extends Controller
{
    //
    public function add()
    {
        return view('admin.todo_list.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, TodoList::$rules);
        
        $todo_list = new TodoList;
        $form = $request->all();
        
          // データベースに保存する
        $todo_list->fill($form);
        $todo_list->user_id = 0;
        $todo_list->is_complete = 0;
        $todo_list->save();
        
        return redirect ('admin/todo_list');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        $order = $request->order;
        
        if ($cond_name != '') {
            $posts = TodoList::where('name', $cond_name)->get();
        } else {
            if ($order == "importance_desc") {
              $posts = TodoList::orderBy('importance', 'desc')->get();
            } else {
                $posts = TodoList::all();    
            }
        }
        
        $user = Auth::user();
        
        
        return view('admin.todo_list.index', ['posts' => $posts, 'cond_name' => $cond_name, 'user' => $user]);
    }
    
    public function edit(Request $request)
  {
      // Todolist Modelからデータを取得する
      $todo_list = TodoList::find($request->id);
      //dd($request->importance);
      
      //dd($request->id);
      
      if (empty($todo_list)) {
        abort(404);    
      }
      return view('admin.todo_list.edit', ['todo_list_form' => $todo_list]);
  }


  public function update(Request $request)
  {
      //dd($request->importance);
      // Validationをかける
      $this->validate($request, TodoList::$rules);
      // TodoList Modelからデータを取得する
      $todo_list = TodoList::find($request->id);
      // 送信されてきたフォームデータを格納する
      $todo_list_form = $request->all();
      
      
      //dd($todo_list);
      //dd($request->id);

      // 該当するデータを上書きして保存する
      $todo_list->fill($todo_list_form)->save();
      

      return redirect('admin/todo_list');
  }
  
  public function delete(Request $request)
  {
      $todo_list = TodoList::find($request->id);
      
      $todo_list->delete();
      return redirect('admin/todo_list/');
  }
  
  public function complete(Request $request)
  {
      $todo_list = TodoList::find($request->id);
      $todo_list->is_complete = 1;
      $todo_list_form = $request->all();
      
      $todo_list->fill($todo_list_form)->save();


      return redirect('admin/todo_list/');

  }
  
  public function doneIndex(Request $request)
  {
      $cond_name = $request->cond_name;
        if ($cond_name != '') {
            $posts = TodoList::where('name', $cond_name)->get();
        } else {
            
            $posts = TodoList::all();
        }
        
        $user = Auth::user();
        
        
        return view('admin.todo_list.doneIndex', ['posts' => $posts, 'cond_name' => $cond_name, 'user' => $user]);
  }
  
  public function incomplete(Request $request)
  {
      $todo_list = TodoList::find($request->id);
      $todo_list->is_complete = 0;
      $todo_list_form = $request->all();
      
      $todo_list->fill($todo_list_form)->save();


      return redirect('admin/todo_list/doneIndex/');

  }
  
  public function order(Request $request)
  {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            $posts = TodoList::where('name', $cond_name)->orderBy('importance', 'desc')->get();
        } else {
            
            $posts = TodoList::orderBy('importance', 'desc')->get();
        }
        
        $user = Auth::user();
        
        
        return view('admin.todo_list.index', ['posts' => $posts, 'cond_name' => $cond_name, 'user' => $user]);


  }
}
