<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CustomProductsIndex extends Component
{
    use WithPagination;

    public $search;
    protected $products;
    

    public function updatingSearch()
    {
        $this->resetPage();
    }

 
    public function mount($products)
    {
        $this->products = $products;
    }

    public function render()
    {
        //$products = Product::where('status', true)->latest('id')->paginate(9);
        //$this->products;
        //$this->categories = Category::wher;
        //$this->products = Product::where('category_id', $this->category_id)->paginate(15)->all();
        //$this->products = $this->products;
        return view('livewire.custom-products-index', ['products' => $this->products]);
    }
}
