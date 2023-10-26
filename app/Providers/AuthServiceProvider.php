<?php

namespace App\Providers;

use App\Models\User\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /**
         * Implicitly grant "Super Admin" role all permissions
         * This works in the app by using gate-related functions like auth()->user->can() and @can()
         */
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Role::SUPER_ADMIN) ? true : null;
        });
    }
}
