<?php

namespace App\Console\Commands;

use App\Actions\Custom\ConsultPaymentStatusAction;
use App\Constants\OrderStatus;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConsultPaymentStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consult:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command consult the transaction status for payments';

    public function handle(): int
    {
        $orders = Order::select('id', 'status', 'requestId')
            ->where('status', '=', OrderStatus::PENDING)
            ->get();
        if ($orders->isNotEmpty()) {
            Log::info('Consult payment status for orders in PENDING status');

            foreach ($orders as $order) {
                (new ConsultPaymentStatusAction())->consult($order);
            }
        }

        return 0;
    }
}
