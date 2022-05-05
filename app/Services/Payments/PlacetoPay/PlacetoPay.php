<?php

namespace App\Services\Payments\PlacetoPay;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Contracts\GatewayContract;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Actions\Custom\UpdateOrderAction;
use Illuminate\Http\Client\Response as ClientResponse;

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

    protected function createRequest(Order $order): Response
    {
        $data = $this->getData($order);
        $response = Http::acceptJson()->post(url($this->url), $data); //$dat);

        if ($response->successful()) {
            $order = (new UpdateOrderAction())->update($order, $data['payment'], $response['requestId'], $response['processUrl']);
        }
        return $response;
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

    public function pay(Order $order): Response
    {
        return $this->createRequest($order);
    }

    private function getData(Order $order): array
    {
        $this->buyer = Buyer::make($order);
        $this->payment = Payment::make($order);

        return [
                'locale' => 'es_CO',
                'auth' => $this->auth,
                'buyer' => $this->buyer,
                'payment' => $this->payment,
                'expiration' => date('c', strtotime('+45 min')),
                'returnUrl' => route('complete', ['reference' => $order->reference]),
                'cancelUrl' => route('cancel', $order),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
    }
}
