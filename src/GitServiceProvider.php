<?php

namespace Microit\DashboardModuleGit;

use Illuminate\Support\ServiceProvider;

class GitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');
    }

    public function register(): void
    {
    }
}
