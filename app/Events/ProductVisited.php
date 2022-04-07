<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductVisited
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Product $product;
    public string $ip;
    public string $userAgent;

    public function __construct(Product $product, string $ip, string $userAgent)
    {
        $this->product = $product;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }
}
