<?php

namespace Microit\DashboardModuleGit\Events;

use Microit\DashboardModuleGit\Models\Branch;
use Microit\DashboardModuleGit\Models\PullRequest;
use Microit\DashboardModuleGit\Models\User;
use Microit\DashboardNotifications\NotificationTagValue;

class PullRequestEvent extends Event
{
    public function __construct(
        public PullRequest $pullRequest,
        public User $user
    ) {
        parent::__construct(['pull_request' => $this->pullRequest, 'user' => $this->user]);
        $fromBranch = $this->pullRequest->fromBranch();
        $toBranch = $this->pullRequest->toBranch();

        $this->avatar = $this->user->avatar;

        $this->notificationTagValues[] = new NotificationTagValue('git', 'user', $this->user->id);
        $this->notificationTagValues[] = new NotificationTagValue('git', 'repository', $this->pullRequest->repository->id);

        if ($fromBranch instanceof Branch) {
            $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $fromBranch->id);
        }

        if ($toBranch instanceof Branch) {
            $this->notificationTagValues[] = new NotificationTagValue('git', 'branch', $toBranch->id);
        }
    }
}
