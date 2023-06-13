<?php

namespace App\Http\Livewire;

use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoList extends Component
{
    protected $listeners = ['$refresh'];

    public $searchText;

    public function render()
    {
        $todoItems = session()->get('todo') ?? [];

        if (Auth::check()) {
            $todoItems = User::find(Auth::user()->id)->todoItems()->get();
        }

        return view('livewire.todo-list', ['data' => $this->search()]);
    }

    public function checkItem($id)
    {
        if (Auth::check()) {
            $todoItem = TodoItem::find($id);
            $todoItem->is_checked = !$todoItem->is_checked;
            $todoItem->save();
        } else {
            $todoItem = session()->get("todo.$id");
            $todoItem->is_checked = !$todoItem->is_checked;
            session()->forget("todo.$id");
            session()->put("todo.$id", $todoItem);
        }
    }

    public function removeItem($id)
    {
        if (Auth::check()) {
            TodoItem::find($id)->delete();
        } else {
            session()->forget("todo.$id");
        }
    }

    public function updated($field) {
        if ($field === 'searchText') {
            $this->emit('$refresh');
        }
    }

    public function search()
    {
        $searchString = "%$this->searchText%";
        if (Auth::check()) {
            $todoItems = User::find(Auth::user()->id)->todoItems()->where('title', 'like', $searchString)->get();
        } else {
            $todoList = session()->get('todo') ?? [];
            $todoItems = array_filter($todoList, function($item) {
                $searchString = "%$this->searchText%";
                return preg_match($searchString , $item->title);
            });
        }

        return $todoItems ?? [];
    }
}
