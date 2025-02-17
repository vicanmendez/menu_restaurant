<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'image_main',
        'additional_images', 'is_special', 'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_special' => 'boolean',
        'is_available' => 'boolean',
        'additional_images' => 'array'
    ];
}