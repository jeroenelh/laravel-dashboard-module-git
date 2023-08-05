<?php

namespace Microit\DashboardModuleGit;

use Illuminate\Support\ServiceProvider;
use Microit\DashboardNotifications\HasNotificationTags;
use Microit\DashboardNotifications\NotificationTag;

class GitServiceProvider extends ServiceProvider
{
    use HasNotificationTags;

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/');

        $this->registerNotificationTag(new NotificationTag('Git', 'username', 'string'));
        $this->registerNotificationTag(new NotificationTag('Git', 'repository', 'string'));
        $this->registerNotificationTag(new NotificationTag('Git', 'branch', 'string'));
    }

    public function register(): void
    {
    }
}
