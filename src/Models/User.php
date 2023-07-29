<?php

namespace Microit\DashboardModuleGit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static User create(array $array)
 * @method static Builder where(string $string, mixed $name)
 */
class User extends Model
{
    protected $table = 'git_users';

    public const SOURCE = 'unknown';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id',
        'source',
        'name',
    ];

    protected $attributes = [
        'source' => 'unkown',
    ];

    public static function fromAttributes(array $attributes): self
    {
        /** @var User|null $object */
        $object = self::where('id', $attributes['id'])
                    ->where('source', get_called_class()::SOURCE)
                    ->first();

        if (is_null($object)) {
            $object = self::create([
                'id' => $attributes['id'],
                'name' => $attributes['name'],
                'source' => get_called_class()::SOURCE,
            ]);
        }

        return $object;
    }
}
