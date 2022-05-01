<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'quantity',
        'purchase_price',
        'sale_price',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('order_id', 'product_id', 'qte', 'price');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}