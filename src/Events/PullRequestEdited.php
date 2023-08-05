<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestEdited extends PullRequestEvent
{
    public function __construct(
        public PullRequest $pullRequest,
        public User $user
    ) {
        parent::__construct($this->pullRequest, $this->user);
        $this->title = 'Pull request closed';
        $this->message = sprintf('%s edited pull request %s', $this->user->name, $this->pullRequest->title);
    }
}
