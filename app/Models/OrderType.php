<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    use HasFactory;

    // Atributos que podem ser atribuídos em massa.
    protected $fillable = [
        'name', 
        'description',
    ];

    // Definindo as relações do modelo.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
