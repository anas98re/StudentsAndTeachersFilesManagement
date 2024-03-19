<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\employee;
use App\Policies\EmployeePolicy;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // employee::class => EmployeePolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
    }
}
