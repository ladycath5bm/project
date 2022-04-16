<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Constants\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Actions\Custom\CreateOrderAction;
use App\Http\Requests\Orders\OrderStoreRequest;
use App\Actions\Custom\ConsultPaymentStatusAction;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::select('id', 'total', 'description', 'status', 'created_at', 'reference', 'requestId', 'processUrl')
            ->where('customer_id', auth()->user()->id)
            ->latest('id')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(OrderStoreRequest $request): RedirectResponse
    {
        $createNewOrderAction = new CreateOrderAction();

        $order = $createNewOrderAction->create($request->validated());

        return redirect()->route('pay', $order);
    }

    public function show(Order $order): View
    {
        $order = Order::select('id', 'status', 'requestId', 'processUrl', 'transactions', 'created_at', 'customerName', 'customerEmail', 'reference')
            ->where('id', $order->id)
            ->where('customer_id', auth()->user()->id)
            ->first();
        
        $order = (new ConsultPaymentStatusAction())->consult($order);
        
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        //dd($order);
        if ($order->status == OrderStatus::REJECTED) {
            
            DB::table('order_product')->where('order_id', $order->id)->delete();
            $order->delete();
        }
        
        return redirect()->route('orders.index')->with('information', 'Order deleted successfully!');
    }

}
