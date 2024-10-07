<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    { // $user = auth()->user();

        if (env('APP_ENV') !== 'production') {
            $url = FacadesRequest::url();
            $chek = strstr($url, "http://");
            if ($chek) {
                $newUrl = str_replace("http", "https", $url);
                header("Location:" .$newUrl);
            }
        }
   
        Gate::before(function (User $user, $ability) {
            return $user->hasPermissionTo($ability);
        });

        //parent::boot();

        /*
        Gate::define('admin', function ($user) {
            return $user->hasPermissionTo('admin'); // Ou qualquer lógica que determine se o usuário é um administrador
        });

        // Gate para 'user'
        Gate::define('user', function ($user) {
            // Lógica para verificar se o usuário tem permissão 'user'
            // Exemplo: return $user->hasPermissionTo('user');
           // return true; // ou qualquer outra lógica desejada
        });

        // Gate para 'manage-user'
        Gate::define('manage-user', function ($user) {
            // Lógica para verificar se o usuário tem permissão 'manage-user'
            // Exemplo: return $user->hasPermissionTo('manage-user');
            return true; // ou qualquer outra lógica desejada
        });
        */
    }
}
