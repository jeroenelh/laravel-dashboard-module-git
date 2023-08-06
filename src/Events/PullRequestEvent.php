<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\Branch;
use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;
use Microit\DashboardNotifications\Event;
use Microit\DashboardNotifications\NotificationTagValue;

class PullRequestEvent extends Event
{
    protected Branch $fromBranch;

    protected Branch $toBranch;

    public function __construct(
        public PullRequest $pullRequest,
        public User $user
    ) {
        parent::__construct(['pull_request' => $this->pullRequest, 'user' => $this->user]);

        $this->avatar = $this->user->avatar;
        $this->fromBranch = $this->pullRequest->fromBranch();
        $this->toBranch = $this->pullRequest->toBranch();

        $this->notificationTagValues();
    }

    private function notificationTagValues(): void
    {
        $this->notificationTagValues[] = new NotificationTagValue('git', 'user', $this->user->id, $this->user->source);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'repository', $this->pullRequest->repository->id, $this->pullRequest->repository->source);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $this->fromBranch->id, $this->fromBranch->source);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $this->toBranch->id, $this->toBranch->source);
    }
}
