<?php

namespace Microit\DashboardModuleGit\Events;

use Illuminate\Queue\SerializesModels;
use Microit\DashboardNotifications\Models\Notification;
use Microit\DashboardNotifications\NotificationTagValue;

class Event
{
    use SerializesModels;

    protected ?string $title = null;

    protected ?string $message = null;

    protected ?string $type = null;

    protected ?string $avatar = null;

    protected array $notificationTagValues = [];

    public function __construct(public readonly array $objects)
    {
    }

    public function notify(): Notification
    {
        $notification = Notification::create([
           'class' => get_called_class(),
           'objects' => $this->objects,
           'title' => $this->title,
           'message' => $this->message,
           'type' => $this->type,
           'avatar' => $this->avatar,
        ]);

        /** @var NotificationTagValue $notificationTagValue */
        foreach ($this->notificationTagValues as $notificationTagValue) {
            if (is_null($notificationTagValue->model)) {
                continue;
            }

            \Microit\DashboardNotifications\Models\NotificationTagValue::create([
                'tag_id' => $notificationTagValue->model,
                'notification_id' => $notification->id,
                'value' => $notificationTagValue->value,
            ]);
        }

        return $notification;
    }
}
