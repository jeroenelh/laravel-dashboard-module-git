<?php

namespace Microit\DashboardModuleGit\Models;

use Carbon\Carbon;

class PullRequestApprove
{
    public function __construct(
        public readonly int $id,
        public readonly string $state,
        public readonly PullRequest $pullRequest,
        public readonly User $user,
        public readonly Carbon $submittedAt
    ) {
    }
}
