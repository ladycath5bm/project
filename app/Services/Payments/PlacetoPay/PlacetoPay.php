<?php

namespace App\Services\Payments\PlacetoPay;

use App\Actions\Custom\UpdateOrderAction;
use App\Contracts\GatewayContract;
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

    public function __construct()
    {
        $this->auth = Auth::make();
        $this->url = config('payments.gateways.placetopay.url');
    }

    protected function createRequest(Order $order)
    {
        $this->buyer = Buyer::make($order);
        $this->payment = Payment::make($order);

        $dat = [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+45 min')),
                'returnUrl' => route('orders.show', $order),
                'cancelUrl' => route('cancel', $order),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];

        $response = Http::acceptJson()->post(url($this->url), $dat);

        if ($response->successful()) {
            $order = (new UpdateOrderAction())->update($order, $this->payment, $response['requestId'], $response['processUrl']);
        }
        return $response->json();
    }

    public static function getRequestInformation(string $requestId): ClientResponse
    {
        $url = url(config('payments.gateways.placetopay.url') . $requestId);
        $data = [
            'auth' => Auth::make(),
        ];

        $response = Http::post($url, $data);
        return $response;
    }

    public function pay(Order $order): array
    {
        return $this->createRequest($order);
    }
}
