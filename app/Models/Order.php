<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'status',
        'user_id',
        'customer_id',
        'order_type_id',
        'company_id',
    ];

 // Relacionamento com Customer


 // Relacionamento com User (caso tenha)
 /*
public function customer()
{
     return $this->belongsTo(Customer::class);
}
 
 
public function user()
{
   return $this->belongsTo(User::class);
}
*/
 // Relacionamento com os itens da fatura
 public function items()
 {
     return $this->hasMany(OrderItem::class);
 }

 public function orderItems()
 {
     return $this->hasMany(OrderItem::class);
 }
 public function user()
 {
     return $this->belongsTo(User::class, 'user_id');
 }

 public function customer()
 {
     return $this->belongsTo(Customer::class, 'customer_id');
 }

 public function opinions()
 {
     return $this->hasMany(Opinion::class);
 }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}