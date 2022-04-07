<?php

namespace App\Services\Payments\PlacetoPay;

use App\Actions\Custom\CreateOrderAction;
use App\Contracts\GatewayContract;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PharIo\Manifest\Url;

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
        $this->returnURL = '/consult/';
        $this->cancelUrl = '/orders/cancel/';
    }

    public function createRequest(Request $request)
    {
        $this->buyer = Buyer::make($request);
        $order = (new CreateOrderAction())->create($this->buyer, $this->reference);
        $order->description = $this->payment['description'];

        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+15 min')),
                'returnUrl' => url($this->returnURL . $order->id),
                //'returnUrl' => url($this->returnURL . $order->id),
                'cancelUrl' => url($this->cancelUrl . $order->id),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
        //dd($dat);
        $response = Http::acceptJson()->post(url($this->url), $dat);
        //dd($response->json());

        $order->requestId = $response['requestId'];
        $order->processUrl = $response['processUrl'];
        $order->total = $this->payment['amount']['total'];
        $order->save();

        return $response->json();
    }

    public static function getRequestInformation(string $requestId): ClientResponse
    {
        //dd($requestId);
        $url = url('https://dev.placetopay.com/redirection/api/session/' . $requestId);
        $data = [
            'auth' => Auth::make(),
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
