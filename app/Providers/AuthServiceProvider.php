<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / permissions services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('superAdmin') ? true : null;
        });

        Gate::define('assign-role', function (User $user, $role) {
                return  $role !== 'superAdmin' && $user->hasRole('admin');
        });

        Gate::define('create-role', function (User $user, $role) {
            return $role !== 'superAdmin' && $user->hasRole('admin');
        });

        Gate::define('delete-role', function (User $user, $role) {
            return $role !== 'superAdmin' && $user->hasRole('admin');
        });

        Gate::define('revoke-role', function (User $user, $role) {
            return $role !== 'superAdmin' && $user->hasRole('admin');
        });

        Gate::define('edit-role', function (User $user, $role) {
            return $role !== 'superAdmin' && $user->hasRole('admin');
        });

        Gate::define('view-roles', function (User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('view-user-roles', function (User $user) {
            return $user->hasRole('admin');
        });
    }
}
