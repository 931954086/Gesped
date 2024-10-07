<?php

namespace App\Models;

use App\Models\Departament;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'description',
        'site',
        'email',
        'nif'
    ];

    public function departments()
    {
        return $this->hasMany(Departament::class);
    }
}
