<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
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
    ];

    protected $casts = [
        'objects' => 'json',
    ];
}
