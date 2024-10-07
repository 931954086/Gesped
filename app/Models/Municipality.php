<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'province_id',
        'created_at',
        'updated_at'
    ];

    // No modelo Municipality
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
