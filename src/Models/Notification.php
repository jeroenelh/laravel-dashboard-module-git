<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int $id
 * @property string $class
 * @property array $objects
 * @property string $title
 * @property string $message
 * @property string $type
 * @method static Notification create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class Notification extends Model
{
    protected $table = 'notifications';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'class',
        'objects',
        'title',
        'message',
        'type',
        'avatar',
    ];

    protected $casts = [
        'objects' => 'json',
    ];
}
