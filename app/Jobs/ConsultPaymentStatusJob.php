<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\PaymentController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
