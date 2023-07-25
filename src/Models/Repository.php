<?php

namespace Microit\DashboardModuleGit\Models;

class Repository
{
    public function __construct(
        public readonly string $id,
        public readonly string $user,
        public readonly string $name,
        public readonly bool $isPublic,
    ) {
    }
}
