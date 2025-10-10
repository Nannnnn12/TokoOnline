<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'slug',
        'description',
        'purchase_price',
        'sell_price',
        'stock',
        'status',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
