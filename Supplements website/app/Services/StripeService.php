<?php

namespace App\Services;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function retrievePaymentIntent($id)
    {
        return PaymentIntent::retrieve($id);
    }
}
