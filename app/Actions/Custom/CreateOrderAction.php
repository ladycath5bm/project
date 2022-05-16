<?php

namespace App\Actions\Custom;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Constants\OrderStatus;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderGenerated;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;

class CreateOrderAction
{
    public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = new Order();
            $order->status = OrderStatus::CREATED;
            $order->reference = $this->createReference();
            $order->customer_name = $data['name'];
            $order->customer_document = $data['document'];
            $order->customer_email = $data['email'];
            $order->customer_phone = $data['mobile'];
            $order->customer_address = $data['address'];
            $order->total = Cart::subtotal();
            $order->customer()->associate(auth()->id());
            $order->save();

            $order->products()->attach($this->createPivoteData());

            Cart::destroy();

            $order->customer->notify(new NewOrderGenerated($order));
            
            Notification::route('nexmo', $order->customer_phone)
                ->notify(new NewOrderGenerated($order));

            return $order;
        });
    }

    private function createReference(): string
    {
        return date('ymd') . strtoupper(Str::random(6));
    }

    private function createPivoteData(): array
    {
        $data = [];

        foreach (Cart::content() as $product) {
            $data[$product->id] = [
                'quantity' => $product->qty,
                'price' => (float)$product->price,
                'subtotal' =>  (float)$product->qty * $product->price,
            ];
            Product::find($product->id)->decrement('stock', $product->qty);
        }

        return $data;
    }
}
