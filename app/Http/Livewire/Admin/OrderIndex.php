<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('reference', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate();

        return view('livewire.admin.order-index', compact('orders'));
    }
}
