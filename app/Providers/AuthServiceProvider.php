<?php

namespace App\Providers;
use App\Models\Admin;
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

        Gate::define('check-permissions', function (Admin $admin,$permission) {
            if($admin->role == 'suber_admin'){
                return true;
            }else{
                $checkAdmin = $admin->permissions->firstWhere('name',$permission);
                if($checkAdmin){
                            return true;
                        }else{
                            return false;
                        }
            }
        });
    }
}
