<?php

namespace App\Providers;

use App\Models\TherapySchedule;
use App\Models\TherapySession;
use App\Policies\TherapySessionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        BlogPost::class => BlogPostPolicy::class,
        TherapySession::class => TherapySessionPolicy::class,
        TherapySchedule::class => TherapySchedulePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}