<?php

namespace Microit\DashboardModuleGit\Models;

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }
}
