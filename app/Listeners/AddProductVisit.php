<?php

namespace App\Listeners;

use UAParser\Parser;
use App\Models\ProductVisit;
use App\Events\ProductVisited;

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
