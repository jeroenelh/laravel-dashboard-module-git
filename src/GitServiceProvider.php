<?php

namespace Microit\DashboardModuleGit;

use Illuminate\Support\ServiceProvider;
use Microit\DashboardModuleGit\Models\Branch;
use Microit\DashboardModuleGit\Models\Repository;
use Microit\DashboardModuleGit\Models\User;
use Microit\DashboardNotifications\HasNotificationTags;
use Microit\DashboardNotifications\NotificationTag;

class GitServiceProvider extends ServiceProvider
{
    use HasNotificationTags;

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');

        $this->registerNotificationTag(new NotificationTag('Git', 'user', 'model', User::class));
        $this->registerNotificationTag(new NotificationTag('Git', 'repository', 'model', Repository::class));
        $this->registerNotificationTag(new NotificationTag('Git', 'branch', 'model', Branch::class));
    }

    public function register(): void
    {
    }
}
