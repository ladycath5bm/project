<?php

namespace App\Http\Controllers;

use App\Actions\Custom\ConsultPaymentStatusAction;
use App\Actions\Custom\CreateOrderAction;
use App\Constants\OrderStatus;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::select('id', 'total', 'description', 'status', 'created_at', 'reference', 'request_id', 'process_url')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(CreateOrderAction $createNewOrderAction, OrderStoreRequest $request): RedirectResponse
    {
        $order = $createNewOrderAction->create($request->validated());
        
        return redirect()->route('pay', $order);
    }

    public function show(Order $order): View
    {
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        if ($order->status == OrderStatus::REJECTED) {
            $order->delete();
        }

        return redirect()->route('orders.index')->with('information', 'Order deleted successfully!');
    }
}
