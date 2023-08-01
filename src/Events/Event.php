<?php

namespace Microit\DashboardModuleGit\Events;

use Illuminate\Queue\SerializesModels;
use Microit\DashboardModuleGit\Models\Notification;

class Event
{
    use SerializesModels;

    public readonly array $objects;

    public function __construct()
    {
        $this->objects = func_get_args();
    }

    public function notify(): Notification
    {
        return Notification::create([
           'class' => __CLASS__,
           'objects' => $this->objects,
           'title' => null,
           'message' => null,
           'type' => null,
        ]);
    }
}
