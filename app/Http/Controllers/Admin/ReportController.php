<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('admin.reports.index');
    }

    public function usersReport()
    {
        $users = User::select([
            'id',
            'name',
            'email',
        ])->get();

        
        $pdf = PDF::loadView('admin.reports.users', ['data' => $users]);
        return $pdf->stream('users.pdf');
    }

    public function ordersReport()
    {
        $orders = Order::select([
            'customer_name',
            'customer_phone', 
            'customer_address', 
            'customer_email',
            'status',
            'total',
            'reference',
        ])->get();

        
        $pdf = PDF::loadView('admin.reports.orders', ['data' => $orders]);
        return $pdf->stream('orders.pdf');
    }
}
