<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
    {
        Gate::define('viewAnySoftDeleted', function (User $user) {
            return $user->role->name === 'Admin';
        });

        Gate::define('viewSoftDeleted', function (User $user) {
            return $user->role->name === 'Admin';
        });

        Gate::define('restoreSoftDeleted', function (User $user) {
            return $user->role->name === 'Admin';
        });

        Gate::define('isPatient', function (User $user) {
            return $user->role->name === 'Patient';
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->role->name === 'Admin';
        });
    }
}
