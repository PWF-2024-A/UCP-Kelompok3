<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){

        $todos = Todo::where('user_id', auth()->user()->id)

            ->orderBy('is_complete', 'asc')

            ->orderBy('created_at', 'desc')

            ->get();

        $categories = Category::all();
        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();

        return view('todo.index', compact('todos', 'categories', 'todosCompleted'));
    }

    public function create(){
        $categories = Category::where('user_id', auth()->user()->id)
            ->get();
        return view('todo.create', compact('categories'));
    }

    public function edit(Todo $todo){
        $categories = Category::all();
        if(auth()->user()->id == $todo->user_id){

            return view('todo.edit', compact('todo', 'categories'));
        }else{

            return redirect()->route('todo.index')->with('danger', 'You are not authorized to edit this todo!');
        }
    }

    public function update(Request $request, Todo $todo){
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todo->update([

            'title'=> ucfirst($request->title),
            'category_id' => $request->category_id
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');
    }

    public function complete(Todo $todo){
        if (auth()->user()->id == $todo->user_id){
            $todo->update([
                'is_complete' => true,
            ]);

            return redirect()->route('todo.index')->with('success', 'Todo completed successfully!');
        } else{
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to complete this todo!');
        }
    }

    public function uncomplete(Todo $todo){
        if (auth()->user()->id == $todo->user_id){
            $todo->update([
                'is_complete' => false,
            ]);

            return redirect()->route('todo.index')->with('success', 'Todo uncompleted successfully!');
        } else{
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to uncomplete this todo!');
        }
    }

    public function store(Request $request, Todo $todo){

        $request->validate([
            'title' => 'required|max:255',
            // 'category' => 'required'
        ]);

        $todo = Todo::create([
            'title' => ucfirst($request->title),
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully!');

    }

    public function destroy(Todo $todo){
        if(auth()->user()->id == $todo->user_id){
            $todo->delete();
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully!');
        }else{
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to delete this todo!');
        }
    }

    public function destroyCompleted(){
        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($todosCompleted as $todo){
            $todo->delete();
        }
        return redirect()->route('todo.index')->with('success', 'All completed todos deleted successfully!');
    }

}
