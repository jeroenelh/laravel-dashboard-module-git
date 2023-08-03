<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;

class PullRequestEdited extends Event
{
    public function __construct(
        public readonly PullRequest $pullRequest,
        public readonly User $user
    ) {
        parent::__construct(['pull_request' => $this->pullRequest, 'user' => $this->user]);
        $this->title = 'Pull request closed';
        $this->message = sprintf('%s edited pull request %s', $this->user->name, $this->pullRequest->title);
        $this->avatar = $this->user->avatar;
    }
}
