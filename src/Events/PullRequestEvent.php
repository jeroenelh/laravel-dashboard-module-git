<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;
use Microit\DashboardNotifications\NotificationTagValue;

class PullRequestEvent extends Event
{
    public function __construct(
        public readonly PullRequest $pullRequest,
        public readonly User $user
    ) {
        parent::__construct(['pull_request' => $this->pullRequest, 'user' => $this->user]);

        $this->avatar = $this->user->avatar;

        $this->notificationTagValues[] = new NotificationTagValue('git', 'username', $this->user->name);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'repository', $this->pullRequest->repository->name);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $this->pullRequest->from_branch->name);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $this->pullRequest->to_branch->name);
    }
}
