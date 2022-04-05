<?php 

namespace App\Services\Payments\PlacetoPay;

use App\Models\Order;
use PharIo\Manifest\Url;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Custom\CreateOrderAction;
use App\Contracts\GatewayContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Payments\PlacetoPay\Auth;
use App\Services\Payments\PlacetoPay\Buyer;
use PHPUnit\Framework\Constraint\JsonMatches;
use Illuminate\Http\Client\Response as ClientResponse;

class PlacetoPay implements GatewayContract
{
    protected Collection $items;
    protected int $reference;
    protected array $auth;
    protected array $buyer;
    protected array $payment;
    protected string $url;
    protected string $returnURL;
    protected string $cancelUrl;

    public function __construct()
    {
        $this->items = Cart::content(auth()->user()->id);
        $this->reference = Order::latest()->first()->reference + 1;
        $this->auth = Auth::make();
        $this->buyer = [];
        $this->payment = Payment::make($this->reference, $this->items);
        $this->url = 'https://dev.placetopay.com/redirection/api/session/';
        $this->returnURL = '/consult';
        $this->cancelUrl = '/orders/cancel/';
    }
    
    public function createRequest(Request $request)
    {
        $this->buyer = Buyer::make($request);
        $order = (new CreateOrderAction)->create($this->buyer, $this->reference);
        $order->description = $this->payment['description'];

        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+15 min')),
                'returnUrl' => url($this->returnURL),
                //'returnUrl' => url($this->returnURL . $order->id),
                'cancelUrl' => url($this->cancelUrl . $order->id),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
        //dd($dat);
        $response = Http::acceptJson()->post(url($this->url), $dat);
        //dd($response->json());
        
        $order->requestId = $response['requestId'];
        $order->total = $this->payment['amount']['total'];
        $order->save();
        
        return $response->json();
    }

    public static function getRequestInformation(string $requestId): ClientResponse
    {
        //dd($requestId);
        $url = url('https://dev.placetopay.com/redirection/api/session/' . $requestId);
        $data = [
            'auth' => Auth::make()
        ];

        $response = Http::post($url, $data);
        //dd($response->json());
        return $response;
    }

    public function pay(Request $request): array
    {
        $response = $this->createRequest($request);
        return $response;
        //return redirect()->away($response['processUrl']); 
    }

}
