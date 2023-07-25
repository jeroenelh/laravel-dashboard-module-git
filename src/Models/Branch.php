<?php

namespace Microit\DashboardModuleGit\Models;

class Branch
{
    public function __construct(
        public readonly string $name,
        public readonly Repository $repository,
    ) {
    }
}
