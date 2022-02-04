<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('isAdmin', function ($user) {
            return $user->rol == 'admin';
        });
        Gate::define('isJde', function ($user) {
            return $user->rol == 'jde';
        });
        Gate::define('isTecnico', function ($user) {
            return $user->rol == 'tecnico';
        });
        Gate::define('isOperador', function ($user) {
            return $user->rol == 'operador';
        });
    }
}
