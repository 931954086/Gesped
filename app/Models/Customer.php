<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'nif',
        'gender',
        'house',
        'street',
        'town',
        'state',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
