<?php

namespace App\Services\Payments\PlacetoPay;

use App\Actions\Custom\CreateOrderAction;
use App\Actions\Custom\UpdateOrderAction;
use App\Contracts\GatewayContract;
use App\Http\Controllers\OrderController;
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
        //$this->reference = Order::latest()->first()->reference + 1;
        $this->auth = Auth::make();
        //$this->buyer = [];
        //$this->payment = Payment::make($this->reference);
        $this->url = 'https://dev.placetopay.com/redirection/api/session/';
        $this->returnURL = '/consult/';
        $this->cancelUrl = '/orders/cancel/';
    }

    public function createRequest(Order $order)//Request $request)
    {
        $buyer = Buyer::make($order);
        $payment = Payment::make($order->reference);
        //$order = (new CreateOrderAction())->create($this->buyer, $this->reference);

        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $buyer,
                'payment' => $payment,
                'expiration' => date('c', strtotime('+15 min')),
                'returnUrl' => url($this->returnURL . $order->id),
                'cancelUrl' => url($this->cancelUrl . $order->id),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
        $response = Http::acceptJson()->post(url($this->url), $dat);
        

        $order = (new UpdateOrderAction)->update($order, $payment, $response['requestId'], $response['processUrl']);

        //$order->description = $this->payment['description'];
        //$order->requestId = $response['requestId'];
        //$order->processUrl = $response['processUrl'];
        //$order->total = $this->payment['amount']['total'];
        //$order->save();
        //dd($response->json());
        return $response->json();
    }

    public static function getRequestInformation(string $requestId): ClientResponse
    {
        $url = url('https://dev.placetopay.com/redirection/api/session/' . $requestId);
        $data = [
            'auth' => Auth::make(),
        ];

        $response = Http::post($url, $data);
        return $response;
    }

    public function pay(Request $request): array
    {
        $order = OrderController::store($request);
        $response = $this->createRequest($order);
        return $response;
    }
}
