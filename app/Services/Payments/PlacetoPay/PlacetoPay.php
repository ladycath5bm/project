<?php

namespace App\Services\Payments\PlacetoPay;

use App\Actions\Custom\UpdateOrderAction;
use App\Contracts\GatewayContract;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlacetoPay implements GatewayContract
{
    protected array $auth;
    protected array $buyer;
    protected array $payment;
    protected string $url;
    protected string $returnURL;
    protected string $cancelUrl;

    public function __construct()
    {
        $this->auth = Auth::make();
        $this->url = 'https://dev.placetopay.com/redirection/api/session/';
        $this->returnURL = '/pay/consult/';
        $this->cancelUrl = '/pay/cancel/';
    }

    public function createRequest(Order $order)
    {
        $this->buyer = Buyer::make($order);
        $this->payment = Payment::make($order->reference);
        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+15 min')),
                'returnUrl' => url($this->returnURL . $order->id),
                'cancelUrl' => url($this->cancelUrl . $order->id),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
        $response = Http::acceptJson()->post(url($this->url), $dat);

        $order = (new UpdateOrderAction())->update($order, $this->payment, $response['requestId'], $response['processUrl']);

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
