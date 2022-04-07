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

    protected int $id;

    public function __construct()
    {
        $this->id = Order::latest()
            //select('id', 'customer_id')
            //->where('customer_id','=' , auth()->user()->id)
            //->latest()  
            ->first()
            ->id;
    }

    public function handle()
    {
        //consulta
        $consult = PaymentController::consult((int)$this->id);
    }
}
