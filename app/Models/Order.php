<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_document',
        'customer_phone',
        'customer_address',
        'transactions',
        'reference',
        'request_id',
        'process_url',
        'total',
        'status',
        'description',
        'customer_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'quantity', 'subtotal');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
