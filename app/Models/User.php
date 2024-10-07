<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'email',
        'password',
        'image', 
        'status_id',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /*
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }*/

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /*public function permissions():BelongsToMany
    {
       return $this->belongsToMany(Permission::class);
    }*/

    public function givePermissionTo(string $permission):void
    {
        $perm = Permission::query()->firstOrCreate(compact('permission'));
        $this->permissions()->attach($perm);
    }

    public function revokePermissionTo(string $permission): void
    {
        $this->permissions()->detach($permission);
    }

    public function hasPermissionTo(string $permission):bool
    {
        return $this->permissions()->where('permission', $permission)->exists();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
    //osvaldoventura931@gmail.com  pas app wgwxjilhbnkkcmeo

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id');
    }

    // Exemplo de método para verificar se o usuário é administrador
    public function isAdmin()
    {
        return $this->permissions()->where('permission', 'admin')->exists();
    }
}
