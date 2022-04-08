<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Actions\Custom\CreateOrderAction;
use App\Http\Requests\Orders\OrderStoreRequest;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::select('id', 'total', 'description', 'status', 'created_at', 'reference', 'requestId', 'processUrl')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(5);

        return view('orders.index', compact('orders'));
    }

    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $createNewOrderAction = new CreateOrderAction();

        $order = $createNewOrderAction->create($request->validated());

        return redirect()->route('pay', $order);
    }

    public function show($id)
    {
        //
    }

}
