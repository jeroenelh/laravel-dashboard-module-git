<?php

namespace Microit\DashboardModuleGit\Events;

use Illuminate\Queue\SerializesModels;
use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestOpened
{
    use SerializesModels;

    public function __construct(
        public readonly PullRequest $order,
        public readonly User $user
    ) {
    }
}
