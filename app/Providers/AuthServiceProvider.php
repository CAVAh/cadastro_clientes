<?php

namespace App\Providers;

use App\User;
use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::define('create-pais', 'App\Policies\PaisPolicy@create');

        if (Schema::hasTable('permissions')) {
            $permissions = Permission::with('roles')->get();

            foreach ($permissions as $permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }

            Gate::before(function (User $user) {
                if ($user->isAdmin()) {
                    return true;
                }

                return null;
            });
        }
    }
}
