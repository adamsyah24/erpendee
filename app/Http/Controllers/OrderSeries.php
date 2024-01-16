<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderSeries extends Controller
{
    public function showOrderSeries($orderId)
    {
        // Retrieve the Order model by ID including the 'client' relationship
        $order = \App\Models\Order::with('client')->findOrFail($orderId);

        // Access 'client_slug' from the loaded 'client' relationship
        $clientSlug = $order->client->client_slug;

        // Pass 'clientSlug' to the 'order-series' view
        return view('tables.columns.order-series', ['clientSlug' => $clientSlug]);
    }
}
