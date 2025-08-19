<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'status'
    ];

    // customer relationship
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    // product relationship
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
