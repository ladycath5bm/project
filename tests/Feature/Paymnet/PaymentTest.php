<?php

namespace Tests\Feature\Paymnet;

use App\Constants\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private string $processUrl;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'custom']);
        $this->user = User::factory()->create()->assignRole('custom');
        $this->processUrl = 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a';
    }

    public function testCreateSessionWebcheckout()
    {
        $order = $this->dataProvider();

        $processUrl = $this->processUrl;

        Http::fake(function () use ($processUrl) {
            return Http::response(json_encode([
                    'status' => [
                        'status' => 'OK',
                        'reason' => 'PC',
                        'message' => 'La petición se ha procesado correctamente',
                        'date' => '2021-11-30T15:08:27-05:00',
                    ],
                    'requestId' => 1,
                    'processUrl' => $processUrl,
            ]), 200);
        });

        $data = [
          'name' => $order->customer_name,
          'document' => $order->customer_document,
          'email' => $order->customer_email,
          'mobile' => $order->customer_phone,
          'address' => $order->customer_address,
        ];        
        
        $response = $this->actingAs($this->user)->get(route('payments.pay', $order));
      
        $response->assertRedirect($processUrl);

        $this->assertDatabaseCount('orders', 1);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'reference' => $order->reference,
            'customer_name' => $order->customer_name,
            'customer_email' => $order->customer_email,
            'status' => OrderStatus::CREATED,
        ]);
    }

    public function testConsultSessionWebCheckoutApproved()
    {
        $order = $this->dataProvider();

        Http::fake(function () {
            return Http::response(json_encode([
                    'requestId' => 1,
                    'status' => [
                      'status' => 'APPROVED',
                      'reason' => '00',
                      'message' => 'La petición ha sido aprobada exitosamente',
                      'date' => '2021-11-30T15:49:47-05:00',
                    ],
                    'request' => [
                      'locale' => 'es_CO',
                      'payer' => [
                        'document' => '1033332222',
                        'documentType' => 'CC',
                        'name' => 'Name',
                        'surname' => 'LastName',
                        'email' => 'dnetix1@app.com',
                        'mobile' => '3111111111',
                        'address' => [
                          'postalCode' => '12345',
                        ],
                    ],
                      'payment' => [
                        'reference' => '1122334455',
                        'description' => 'Prueba',
                        'amount' => [
                          'currency' => 'USD',
                          'total' => 1000,
                        ],
                        'allowPartial' => false,
                        'subscribe' => false,
                    ],
                      'returnUrl' => 'https://redirection.test/home',
                      'ipAddress' => '127.0.0.1',
                      'userAgent' => 'PlacetoPay Sandbox',
                      'expiration' => '2021-12-30T00:00:00-05:00',
                    ],
                    'payment' => [
                      [
                        'status' => [
                          'status' => 'APPROVED',
                          'reason' => '00',
                          'message' => 'Aprobada',
                          'date' => '2021-11-30T15:49:36-05:00',
                        ],
                      ],
                    ],
                    'subscription' => null,
            ]), 200);
        });

        $response = $this->actingAs($this->user)->get(route('payments.complete', $order->reference));

        $response->assertRedirect(route('orders.show', $order));
        
        $this->assertDatabaseHas('orders', [
          'id' => $order->id,
          'status' => OrderStatus::APPROVED,
        ]);
    }

    public function testConsultSessionWebCheckoutPending()
    {
        $order = $this->dataProvider();

        Http::fake(function () {
            return Http::response(json_encode([
                'requestId' => 1,
                'status' => [
                  'status' => 'PENDING',
                  'reason' => 'PT',
                  'message' => 'La petición se encuentra pendiente',
                  'date' => '2021-11-30T15:45:57-05:00',
                ],
                'request' => [
                  'locale' => 'es_CO',
                  'payer' => [
                    'document' => '1033332222',
                    'documentType' => 'CC',
                    'name' => 'Name',
                    'surname' => 'lastName',
                    'email' => 'dnetix1@app.com',
                    'mobile' => '3111111111',
                    'address' => [
                      'postalCode' => '12345',
                    ],
                  ],
                  'payment' => [
                    'reference' => '1122334455',
                    'description' => 'Prueba',
                    'amount' => [
                      'currency' => 'USD',
                      'total' => 1000,
                    ],
                    'allowPartial' => false,
                    'subscribe' => false,
                  ],
                  'returnUrl' => 'https://dnetix.co/p2p/client',
                  'ipAddress' => '127.0.0.1',
                  'userAgent' => 'PlacetoPay Sandbox',
                  'expiration' => '2021-12-30T00:00:00-05:00',
                ],
                'payment' => null,
                'subscription' => null,
            ]), 200);
        });

        $response = $this->actingAs($this->user)->get(route('payments.complete', $order->reference));

        $response->assertRedirect(route('orders.show', $order));
        $this->assertDatabaseHas('orders', [
          'id' => $order->id,
          'status' => OrderStatus::PENDING,
        ]);
    }

    public function testConsultSessionWebCheckoutRejected()
    {
        $order = $this->dataProvider();

        Http::fake(function () {
            return Http::response(json_encode([
            'requestId' => 1,
            'status' => [
              'status' => 'REJECTED',
              'reason' => 'XN',
              'message' => 'Se ha rechazado la petición',
              'date' => '2021-11-30T16:44:24-05:00',
            ],
            'request' => [
              'locale' => 'es_CO',
              'payer' => [
                'document' => '1033332222',
                'documentType' => 'CC',
                'name' => 'Name',
                'surname' => 'LastName',
                'email' => 'dnetix@app.com',
                'mobile' => '31111111111',
                'address' => [
                  'postalCode' => '12345',
                ],
              ],
              'payment' => [
                'reference' => '331122',
                'description' => 'Reference',
                'amount' => [
                  'currency' => 'USD',
                  'total' => 500,
                ],
                'allowPartial' => false,
                'subscribe' => false,
                'dispersion' => [
                  [
                    'reference' => '331122',
                    'description' => 'Reference',
                    'amount' => [
                      'currency' => 'USD',
                      'total' => 200,
                    ],
                    'allowPartial' => false,
                    'subscribe' => false,
                    'agreement' => '26',
                    'agreementType' => 'AIRLINE',
                  ],
                  [
                    'reference' => '331122',
                    'description' => 'Reference',
                    'amount' => [
                      'currency' => 'USD',
                      'total' => 300,
                    ],
                    'allowPartial' => false,
                    'subscribe' => false,
                    'agreementType' => 'MERCHANT',
                  ],
                ],
              ],
              'returnUrl' => 'https://redirection.test/home',
              'ipAddress' => '127.0.0.1',
              'userAgent' => 'PlacetoPay Sandbox',
              'expiration' => '2021-12-30T00:00:00-05:00',
            ],
            'payment' => [
              [
                'status' => [
                  'status' => 'REJECTED',
                  'reason' => '65',
                  'message' => '65',
                  'date' => '2021-11-30T16:22:19-05:00',
                ],
              ],
            ],
            'subscription' => null,
          ]), 200);
        });

        $response = $this->actingAs($this->user)->get(route('payments.complete', $order->reference));

        $response->assertRedirect(route('orders.show', $order));
        $this->assertDatabaseHas('orders', [
          'id' => $order->id,
          'status' => OrderStatus::REJECTED,
        ]);
    }

    public function dataProvider(): Order
    {
        $order = Order::factory()->create();
        $order->request_id = 1;
        $order->process_url = $this->processUrl;
        $order->save();

        $product = Product::factory()->create();
        
        Cart::add($product->id, $product->name, 1, $product->price, [
          'code' => $product->code,
          'discount' => $product->discount,
          'stock' => $product->stock
        ]);

        $order->products()->attach($product->id, [
        'quantity' => 1,
        'price' => $product->price,
        'subtotal' => $product->price,
      ]);

        return $order;
    }
}
