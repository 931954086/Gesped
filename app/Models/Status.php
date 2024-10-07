<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc',
        // Adicione outros campos conforme necessário
    ];
 // Defina explicitamente o nome da tabela
 protected $table = 'statuses';

    // Relacionamento com a tabela users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}