<?php

namespace App\Actions\Custom;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Constants\OrderStatus;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrderAction
{
    public function create(array $data): Order
    {
        return DB::transaction(function() use ($data) {
            $order = new Order();
            $order->status = OrderStatus::CREATED;
            $order->reference = $this->createReference();
            $order->customerName = $data['name'];
            $order->customerDocument = $data['document'];
            $order->customerEmail = $data['email'];
            $order->customerPhone = $data['mobile'];
            $order->customerAddress = $data['address'];
            $order->customer()->associate(auth()->id());
            $order->save();

            $order->products()->attach($this->createPivoteData());

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
                'price' => (float) $product->price,
                'subtotal' =>  (float) $product->qty * $product->price,
            ];         
            Product::find($product->id)->decrement('stock', $product->qty);
        }

        return $data;
    }
}
