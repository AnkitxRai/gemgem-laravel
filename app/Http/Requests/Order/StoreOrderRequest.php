<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:50',
            'customer_email' => 'required|email',
            'product_name' => 'required|string|max:50',
            'product_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,cancelled',
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => "Customer name is required.",
            'product_name.required' => "Product name is required.",
            'product_price.required' => "Product price is required.",
            'status.in' => "Order status can be pending, paid, or cancelled.",
        ];
    }
}
