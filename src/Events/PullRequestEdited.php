<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestEdited extends Event
{
    public function __construct(
        public readonly PullRequest $order,
        public readonly User $user
    ) {
        parent::__construct(func_get_args());
    }
}
