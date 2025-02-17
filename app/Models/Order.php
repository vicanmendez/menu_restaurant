<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'order_type',
        'items',
        'total',
        'subtotal',
        'status',
        'special_instructions'
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}