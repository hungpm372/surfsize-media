<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'method_name', 'description', 'code', 'method_logo'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
