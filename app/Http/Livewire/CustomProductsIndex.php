<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CustomProductsIndex extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('status', true)->latest('id')->paginate(9);

        return view('livewire.custom-products-index', compact('products'));
    }
}
