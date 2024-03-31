<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_detail', 'order_id', 'product_id')->withTimestamps()->withPivot('order_detail_quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'order_id', 'id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
