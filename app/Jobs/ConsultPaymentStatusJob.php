<?php

namespace App\Jobs;

use App\Http\Controllers\PaymentController;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultPaymentStatusJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected array $responseTransaction;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        //consulta
        $id = Order::latest()->first()->id;
        $consult = PaymentController::consult((int)$id);
    }
}
