<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Constants\OrderStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Jobs\ConsultPaymentStatusJob;
use App\Actions\Custom\ConsultPaymentStatusAction;

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
        //ConsultPaymentStatusJob::dispatch();
        $orders = Order::select('id', 'status', 'requestId')
            ->where('status', '=', OrderStatus::PENDING)
            ->get();
        Log::info('commmand por consult paymetn status run..');
        if ($orders->isNotEmpty()) {
            Log::info('Consult payment status for orders in PENDING status');

            foreach ($orders as $order) {
                (new ConsultPaymentStatusAction())->consult($order);
            }
        }

        return 0;
    }
}
