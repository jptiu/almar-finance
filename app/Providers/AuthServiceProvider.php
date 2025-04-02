<?php

namespace App\Providers;

use App\Models\SupplyRequest;
use App\Models\User;
use App\Policies\SupplyRequestPolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        SupplyRequest::class => SupplyRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();

        // $gate = app(Gate::class);
        
        // $gate->define('admin_access', function ($user) {
        //     return $user->hasRole('admin');
        // });

        // $gate->define('branch_access', function ($user) {
        //     // existing code for branch_access gate definition
        // });
    }
}
