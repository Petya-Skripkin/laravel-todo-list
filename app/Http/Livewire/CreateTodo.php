<?php

namespace App\Http\Livewire;

use App\Models\TodoItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTodo extends Component
{
    public $todoText;

    public function render()
    {
        return view('livewire.create-todo');
    }

    public function submit()
    {
        $todoItem = new TodoItem();
        $todoItem->title = $this->todoText;

        if (Auth::check()) {
            $todoItem->user_id = auth()->user()->id;
            $todoItem->save();
            $this->emit('$refresh');
            $this->todoText = "";
            return;
        }

        $todoItem->id = random_int(0, 999999999);
        $todoItem->is_checked = false;

        session()->put("todo.$todoItem->id", $todoItem);
        $this->emit('$refresh');
        $this->todoText = "";
    }
}
