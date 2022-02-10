<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class SidebarCategories extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.sidebar-categories', compact('categories'));
    }
}
