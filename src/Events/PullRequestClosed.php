<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestClosed extends PullRequestEvent
{
    public function __construct(
        public readonly PullRequest $pullRequest,
        public readonly User $user
    ) {
        parent::__construct($this->pullRequest, $this->user);
        $this->title = 'Pull request closed';
        $this->message = sprintf('%s closed pull request %s', $this->user->name, $this->pullRequest->title);
    }
}
