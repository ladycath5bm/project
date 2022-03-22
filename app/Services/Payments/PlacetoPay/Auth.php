<?php 

namespace App\Services\Payments\PlacetoPay;

class Auth  
{
    private string $login;
    private string $key;

    public function __construct()
    {
        $this->login = config('payments.gateways.placetopay.login');
        $this->tranKey = config('payments.gateways.placetopay.key');
    }

    public function generateNonce(): string
    {
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        
        return $nonce;
    }

    public function generateTranKey(string $nonce, string $seed): string 
    {
        return base64_encode(sha1($nonce . $seed . $this->tranKey, true));
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public static function make(): array
    {
        $auth = new Auth();
        $nonce = $auth->generateNonce();
        $seed = date('c');

        return [
            'login' => $auth->getLogin(),
            'tranKey' => $auth->generateTranKey($nonce, $seed),
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }
}
