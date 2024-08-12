<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(todo $todo){
        $todos = todo::all();

        return view("welcome", [
            "Hamborger" => ["todos" => $todos],
            "Selected" => $todo
        ]);
    }
    
    public function store(){
       $attributes = request()->validate([
            "title" => "required",
            "description" => "nullable"
       ]);

       todo::create($attributes);

       return redirect("/");
    }

    public function update(todo $todo){
        $todo->update(["isDone" => true]);

        return redirect("/");
    }
    
    public function modifiedData(todo $todo){
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);
    
        $todo->update($attributes);

        return redirect('/')->with('success', 'Todo updated successfully!');
    }
    
    public function remove(todo $todo){
        $todo->delete();
        return redirect("/");
    }
}
