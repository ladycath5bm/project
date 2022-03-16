<?php 

namespace App\Services\Payments\PlacetoPay;

use App\Models\Order;
use Illuminate\Http\Client;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Contracts\GatewayContract;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Payments\PlacetoPay\Auth;
use League\CommonMark\Reference\Reference;
use App\Services\Payments\PlacetoPay\Buyer;
use Illuminate\Support\Collection;
use PharIo\Manifest\Url;
use PHPUnit\Framework\Constraint\JsonMatches;

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
        $this->reference = Order::latest()->first()->reference++;
        $this->auth = Auth::make();
        $this->buyer = [];
        $this->payment = Payment::make($this->reference, $this->items);
        $this->url = 'https://dev.placetopay.com/redirection/api/session/';
        $this->returnURL = '/consult';
        $this->cancelUrl = '/cart/index';
    }
    public function createRequest(Request $request)
    {
        $order = new Order();
        $order->status = 'CREATED';
        $this->buyer = Buyer::make($request);
        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+1 hour')),
                'returnUrl' => url($this->returnURL),
                'cancelUrl' => url($this->cancelUrl),
                'ipAddress' => '127.0.0.1',
                'userAgent' => 'Chrome/51.0.2704.103 Safari/537.36',
        ];
        //dd($dat);
        $response = Http::acceptJson()->post(url($this->url), $dat);
        //dd($response->json());
        //crear action para order
        
        $order->customerName = $dat['buyer']['name'];
        $order->customerDocument = $dat['buyer']['document'];
        $order->customerEmail = $dat['buyer']['email'];
        $order->requestId = $response['requestId'];
        $order->reference = $this->reference;
        $order->total = $request['total'];
        
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