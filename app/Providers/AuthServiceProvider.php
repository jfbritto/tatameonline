<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('root', function ($user) {

            if(auth()->user()->isRoot)
                return true;
            
            return false;
 
        });

        Gate::define('admin', function ($user) {

            if(auth()->user()->isAdmin)
                return true;
            
            return false;
 
        });

        Gate::define('instructor', function ($user) {

            if(auth()->user()->isInstructor)
                return true;
            
            return false;
 
        });

        Gate::define('student', function ($user) {

            if(auth()->user()->isStudent)
                return true;
            
            return false;
 
        });
    }
}
