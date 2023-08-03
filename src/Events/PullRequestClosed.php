<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestClosed extends Event
{
    public function __construct(
        public readonly PullRequest $pullRequest,
        public readonly User $user
    ) {
        parent::__construct(['pull_request' => $this->pullRequest, 'user' => $this->user]);
    }
}
