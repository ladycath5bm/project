<?php

namespace App\Listeners;

use App\Events\ProductVisited;
use App\Models\ProductVisit;
use UAParser\Parser;

class AddProductVisit
{
    // aqui se podría inicializar el model en el cosntruct

    public function handle(ProductVisited $event): void
    {
        $userAgent = Parser::create()->parse($event->userAgent);

        ProductVisit::create([
            'product_id' => $event->product->getRouteKey(),
            'ip' => $event->ip,
            'os' => $userAgent->os->toString(),
            'browser' => $userAgent->ua->toString(),
        ]);
    }
}
