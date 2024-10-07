<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = [];

    /*
    public function users()
    {
        return $this->belongsToMany(User::class);
    }*/

    public function users()
    {
        return $this->belongsToMany(User::class, 'permission_user', 'permission_id', 'user_id');
    }

    public function getPermission(string $permission):Permission
    {
       $permissions = Cache::rememberForever('permissions', function (){
        return self::all();
       });
       return self::getAllFromCache()->where('permission', $permission)->first();
    }

    /** @var Colleticons */
    public static function getAllFromCache(): Collection
    {
        $permissions = Cache::rememberForever('permissions', function (){
            return self::all();
        });
        return $permissions;
    }


    public static function existsOnCache(string $permission)
    {
        return self::getAllFromCache()->where('permission', $permission)->isNotEmpty();
    }
    
}
