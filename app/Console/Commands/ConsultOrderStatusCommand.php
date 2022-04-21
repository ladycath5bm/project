<?php

namespace App\Console\Commands;

use App\Constants\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConsultOrderStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consult:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for consult order status and change it if CREATED to REJECTED';

    public function handle(): int
    {
        $orders = Order::select('id', 'status', 'created_at')
            ->where('status', '=', OrderStatus::CREATED)
            ->where('created_at', '<=', Carbon::now()->subHour())
            ->get();

        if ($orders->isNotEmpty()) {
            Log::info('Order status from CREATED to REJECTED, time expired');
            foreach ($orders as $order) {
                $order->status = OrderStatus::REJECTED;
                $order->save();
                $order = $this->updateOrderRejected($order);
            }
        }

        return 0;
    }

    private function updateOrderRejected(Order $order): Order
    {
        foreach ($order->products as $product) {
            Product::find($product->id)->increment('stock', $product->pivot->quantity);
        }

        return $order;
    }
}
