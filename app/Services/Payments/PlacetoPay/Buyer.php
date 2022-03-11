<?php 

namespace App\Services\Payments\PlacetoPay;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

class Buyer 
{
    public static function buyer(Request $request): array 
    {
        return [
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'address' => $request->address,
        ];
    }
}
