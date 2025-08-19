<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::with('customer', 'product')->get();
        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request) {
        $customer = Customer::firstOrCreate(
        [ 
            'email' => $request->customer_email,
        ],
        [
            'name' => $request->customer_name,
            'status' => true
        ]);

        $product = Product::create([
            'name' => $request->product_name,
            'price' => $request->product_price,
            'status' => true
        ]);

        if ($customer && $product) {
            $order = Order::create([
                'customer_id' => $customer->id,
                'product_id' => $product->id,
                'status' => $request->status
            ]);


            return response()->json([
                'message' => "order created successfully.",
                'order' => $order->load(['customer', 'product'])
            ], 201);
        }

    }
}
