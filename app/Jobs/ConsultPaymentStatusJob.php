<?php

namespace App\Jobs;

use App\Http\Controllers\PaymentController;
use App\Services\Payments\PlacetoPay\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConsultPaymentStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $responseTransaction;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        //consulta
        $consult = PaymentController::consult();
    }
}
