<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestClosed extends Event
{
    public function __construct(
        PullRequest $order,
        User $user
    ) {
        parent::__construct(func_get_args());
    }
}
