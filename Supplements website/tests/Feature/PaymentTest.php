<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Services\StripeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Setup a user
        $this->user = User::factory()->create();
    }

    public function test_payment_updates_order_status_to_paid()
    {
        // 1. Setup Data
        $product = Product::factory()->create([
            'price' => 100,
            'stock' => 10
        ]);

        // 2. Simulate Cart Session
        $cart = [
            $product->id => 1
        ];
        
        // 3. Mock StripeService
        $mockInstance = new \stdClass();
        $mockInstance->status = 'succeeded';
        $mockInstance->amount = 10000; // cents
        $mockInstance->metadata = (object) [
            'cart_items' => json_encode($cart),
            'user_id' => $this->user->id
        ];

        $this->mock(StripeService::class, function ($mock) use ($mockInstance) {
            $mock->shouldReceive('retrievePaymentIntent')
                ->once()
                ->with('pi_test_12345')
                ->andReturn($mockInstance);
        });

        // 4. Send Request
        $response = $this->actingAs($this->user)
            ->withSession(['cart' => $cart])
            ->postJson(route('payment.confirm'), [
                'payment_intent_id' => 'pi_test_12345',
                'shipping_address' => '123 Test St, Test City',
                'phone' => '1234567890',
                'notes' => 'Test Order'
            ]);

        // 5. Assertions
        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'payment_status' => 'paid',
            'total_amount' => 100,
            'shipping_address' => '123 Test St, Test City'
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        // Verify stock deduction
        $this->assertEquals(9, $product->fresh()->stock);
    }
}
