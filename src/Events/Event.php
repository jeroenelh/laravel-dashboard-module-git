<?php

namespace Microit\DashboardModuleGit\Events;

use Illuminate\Queue\SerializesModels;
use Microit\DashboardModuleGit\Models\Notification;

class Event
{
    use SerializesModels;

    protected ?string $title = null;

    protected ?string $message = null;

    protected ?string $type = null;

    protected ?string $avatar = null;

    public function __construct(public readonly array $objects)
    {
    }

    public function notify(): Notification
    {
        return Notification::create([
           'class' => get_called_class(),
           'objects' => $this->objects,
           'title' => $this->title,
           'message' => $this->message,
           'type' => $this->type,
           'avatar' => $this->avatar,
        ]);
    }
}
