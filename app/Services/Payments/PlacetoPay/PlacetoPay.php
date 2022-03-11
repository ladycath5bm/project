<?php 

namespace App\Services\Payments\PlacetoPay;

use App\Services\Payments\PlacetoPay\Buyer;
use App\Models\Order;
use Illuminate\Http\Client;
use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;
use App\Contracts\GatewayContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Services\Payments\PlacetoPay\Auth;
use League\CommonMark\Reference\Reference;
use PHPUnit\Framework\Constraint\JsonMatches;

class PlacetoPay implements GatewayContract
{
    public function createRequest(Request $request)
    {
        $reference = 12345;
        $auth = Auth::make();
        $buyer = Buyer::buyer($request);
        $url = url('https://dev.placetopay.com/redirection/api/session/');
        $returnURL = url('/consult');

        $dat = [
                'locale' => 'es_CO',
                'auth' => $auth,
                'buyer' => $buyer,
                'payment' => [
                    'reference' => $reference,
                    'description' => 'mi primer pago C:',
                    'amount' => [
                        'currency' => 'COP',
                        'total' => 123400,
                    ],
                    'allowPartial' => false,
                ],
                'expiration' => date('c', strtotime('+1 hour')),
                'returnUrl' => $returnURL,
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'Chrome/51.0.2704.103 Safari/537.36',
        ];
        //dd($dat);
        $response = Http::acceptJson()->post($url, $dat);
        //dd($response->json());
        $order = new Order();
        $order->customerName = $dat['buyer']['name'];
        $order->customerDocument = $dat['buyer']['document'];
        $order->customerEmail = $dat['buyer']['email'];
        $order->reference = $response['requestId'];
        $order->total = $request['total'];
        $order->status = 'Created';
        $order->save();
        //dd($order);
        
        return $response->json();
    }

    public static function getRequestInformation(string $reference)
    {
        //dd($requestId);
        $url = url('https://dev.placetopay.com/redirection/api/session/' . $reference);
        $data = [
            'auth' => Auth::make()
        ];

        $response = Http::post($url, $data);
        //dd($response->json());
        return $response->json();
    }

    public function pay(Request $request): array
    {
        //return "Estamos pagandpo usando placetopay Key: {$this->tranKey}";
        $response = $this->createRequest($request);
        return $response;
        //return redirect()->away($response['processUrl']); 
    }

}