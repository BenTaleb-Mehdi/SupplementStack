<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

// Create a test order with delivery information
$order = Order::create([
    'user_id' => 1,
    'total_amount' => 150.00,
    'payment_type' => 'cod',
    'payment_status' => 'pending',
    'shipping_address' => '456 Avenue Mohammed V, Rabat, Morocco',
    'phone' => '+212 6 99 88 77 66',
    'notes' => 'Please call before delivery. Deliver between 2PM-5PM',
]);

// Add a sample order item
$product = Product::first();
if ($product) {
    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 2,
        'price' => $product->price,
        'subtotal' => $product->price * 2,
    ]);
}

echo "✅ Test order created successfully!\n";
echo "Order ID: {$order->id}\n";
echo "Phone: {$order->phone}\n";
echo "Address: {$order->shipping_address}\n";
echo "Notes: {$order->notes}\n";
echo "\nNow view this order in the admin panel to see the delivery information!\n";
