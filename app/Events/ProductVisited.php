<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductVisited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
