<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * list orders
     */
    public function index() {
        $orders = Order::with('customer', 'product')->get();
        return response()->json($orders);
    }


    /**
     * Store orders
     */
    public function store(StoreOrderRequest $request) {
        DB::beginTransaction();
        try {
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
            }
            DB::commit();

            if ($order) {
                return response()->json([
                    'message' => "order created successfully.",
                    'order' => $order->load(['customer', 'product'])
                ], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();
                return response()->json([
                    'message' => "order creation failed.",
                    'error' => $e->getMessage(),
                ], 500);
        }
    }

    /**
     * Update order status
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => "Order status updated successfully",
            'order' => $order->load(['customer', 'product'])
        ]);
    }
}
