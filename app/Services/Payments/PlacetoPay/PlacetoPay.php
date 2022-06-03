<?php

namespace App\Services\Payments\PlacetoPay;

use App\Actions\Custom\UpdateOrderAction;
use App\Contracts\GatewayContract;
use App\Models\Order;
use Illuminate\Http\Client\Response;
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

    protected function createRequest(Order $order): Response
    {
        $data = $this->getData($order);
        $response = Http::acceptJson()->post(url($this->url . 'session/'), $data);

        if ($response->successful()) {
            $order = (new UpdateOrderAction())->update($order, $data['payment'], $response['requestId'], $response['processUrl']);
        }
        return $response;
    }

    public static function getRequestInformation(string $requestId): ClientResponse
    {
        $url = url(config('payments.gateways.placetopay.url') . 'session/'. $requestId);
        $data = [
            'auth' => Auth::make(),
        ];

        $response = Http::acceptJson()->post($url, $data);
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
                'expiration' => date('c', strtotime('+70 min')),
                'returnUrl' => route('payments.complete', ['reference' => $order->reference]),
                'cancelUrl' => route('payments.cancel', $order),
                'ipAddress' => app(Request::class)->getClientIp(),
                'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];
    }

    public static function reversePayment(int $internalReference)
    {
        $url = url(config('payments.gateways.placetopay.url') . 'reverse/');

        $data = [
            'auth' => Auth::make(),
            'internalReference' => $internalReference
        ];

        $response = Http::acceptJson()->post($url, $data);
        return $response;
    }
}
