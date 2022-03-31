<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class SidebarCategories extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.sidebar-categories', compact('categories'));
    }
}
