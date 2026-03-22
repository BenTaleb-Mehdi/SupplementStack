<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Product;

class CheckoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_checkout_flow_with_stripe()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 50,
            'stock' => 10,
            'is_active' => true
        ]);

        $this->browse(function (Browser $browser) use ($user, $product) {
            $browser->loginAs($user)
                    ->visit('/products')
                    // Add product to cart (assuming there is an "Add to Cart" button)
                    ->press('Add to Cart') 
                    ->visit('/checkout')
                    ->assertSee('Checkout')
                    
                    // Fill required fields
                    ->type('shipping_address', '123 Test Street')
                    ->type('phone', '555-0123')
                    
                    // Select Stripe (assuming radio button or similar)
                    ->radio('payment_method', 'stripe')
                    
                    // Interact with Stripe Element
                    // Note: Stripe Elements are in iframes. We need to switch to the iframe.
                    ->withinFrame('iframe[name^="__privateStripeFrame"]', function ($browser) {
                        $browser->type('cardnumber', '4242 4242 4242 4242')
                                ->type('exp-date', '12/24')
                                ->type('cvc', '123')
                                ->type('postal', '12345');
                    })
                    
                    ->press('Pay')
                    ->waitForRoute('checkout.success')
                    ->assertSee('Payment Successful');
        });
    }
}
