<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('admin-permission','App\Policies\AdminPolicy@access');
        Gate::define('peserta-permission','App\Policies\PesertaPolicy@access');
        Gate::define('super.admin-permission', 'App\Policies\AdminPolicy@superadmin');
        Gate::define('adminblk-permission', 'App\Policies\AdminPolicy@adminblk');
        Gate::define('adminperusahaan-permission', 'App\\Policies\AdminPolicy@adminperusahaan');
    }
}
