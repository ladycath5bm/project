<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'type' => 'products',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'code' => $this->resource->code,
                'price' => $this->resource->price,
                'description' => $this->resource->description,
                'discount' => $this->resource->discount,
                'stock' => $this->resource->stock,
                'status' => $this->resource->status,
            ],
            'links' => [
                'self' => route('api.products.show', $this->resource),
            ],
        ];
    }
}
