<?php 

namespace App\Services\Payments\PlacetoPay;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;

class Buyer 
{
    public static function make(Request $request): array 
    {
        return [
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
        ];
    }
}
