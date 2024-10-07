<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'price', 
        'desce',
        'qtd',
        'qtd_min',
        'image',
        'brand',
        'category_id',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
