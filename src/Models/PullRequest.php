<?php

namespace Microit\DashboardModuleGit\Models;

class PullRequest
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $number,
        public readonly string $state,
        public readonly Repository $repository,
        public readonly User $user,
        public readonly Branch $fromBranch,
        public readonly Branch $toBranch,
    ) {
    }
}
