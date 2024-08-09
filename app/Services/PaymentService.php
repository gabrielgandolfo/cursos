<?php

namespace App\Services;
use PagarMe\Client;
class PaymentService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->client = new Client(env('PAGARME_API_KEY'));
    }

    public function charge($amount, $paymentMethod, $cardHash, $customer, $billing, $items)
    {
        return $this->client->transactions()->create([
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'card_hash' => $cardHash,
            'customer' => $customer,
            'billing' => $billing,
            'items' => $items,
        ]);
    }
}
